<?php
/*
 * creates a widget area for search feature
 * */

class hot_wp_search{
	
	//taxonomies
	static $taxonomies = array(
		
		'destination' => array(
			'p' => 'Destinations',
			's' => 'Destination'
		),
		
		'trip_type' => array(
			'p' => 'Trip Types',
			's' => 'Trip Type'
		),
		
		'species' => array(
			'p' => 'Fish Species',
			's' => 'Fish Species'
		),
		
		'lake' => array(
			'p' => 'Lakes',
			's' => 'Lake'
		),
		
		'duration' => array(
			'p' => 'Durations',
			's' => 'Duration'
		),
		
		'price' => array(
			'p' => 'Price Ranges',
			's' => 'Price Range'
		)
	);
	
	
	
	/* contains the hooks */
	static function init(){
		add_action('widgets_init', array(get_class(), 'register_search_widget_area'));
		add_action('wp_enqueue_scripts', array(get_class(), 'enqueue_scripts'));
		
		//register the custom taxonomies
		add_action('init', array(get_class(), 'register_search_taxonomies'));
		
		//add custom templates
		add_filter('template_include', array(get_class(), 'include_new_template'));
		
		add_filter('wp_title', array(get_class(), 'filter_the_title'), 10, 3);
	}
	
	//register a new widget area to accommodate the search widget
	static function register_search_widget_area(){
		register_sidebar( array(
			'name' => 'Hot Search' ,
			'id' => 'hotsearch',
			'description' =>  'Advanced Search beside user 1 widget',
			'before_widget' => '<div  class="widget widget_hotsearch" >',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle widgettitle_hotsearch" >',
			'after_title' => '</h3>'
		));
		
		if(class_exists('widget_hot_search')){
			register_widget( 'widget_hot_search' );
		}
	}
	
	
	/* enqueue the jsavasctipt and css */
	static function enqueue_scripts(){
		self::include_css();
		self::include_js();
	}
	
	
	//css
	static function include_css(){
		wp_register_style('wp-hot-search-widget', self::get_plugin_url('css/widget-area.css'));
		wp_enqueue_style('wp-hot-search-widget');
	}
	
	//js
	static function include_js(){
	}
	
	
	//get plguins url
	static function get_plugin_url($location = ''){
		return HOTWPSEARCH_URL . $location;
	}
	
	
	
	/*
	 * registers all the 6 custom taxonomies
	 * */
	static function register_search_taxonomies(){
		foreach(self::$taxonomies as $key => $taxonomy){
			$labels = array(
				'name' => $taxonomy['p'],
				's_name' => $taxonomy['s'],
				'search_items' => 'Search ' . $taxonomy['s'],
				'all_items' => 'All ' . $taxonomy['p'],
				'parent_item' => 'Parent ' . $taxonomy['s'],
				'parent_item_colon' => 'Parent ' . $taxonomy['s'],
				'edit_item' => 'Edit ' . $taxonomy['s'],
				'update_item' => 'Update ' . $taxonomy['s'],
				'add_new_item' => 'Add New ' . $taxonomy['s'],
				'new_item_name' => 'New ' . $taxonomy['s'],
				'menu_name' => $taxonomy['p']			
			
 			);
 			
 			$args = array(
 				'hierarchical' => true,
			    'labels' => $labels,
			    'show_ui' => true,
			    'query_var' => true,
			    'rewrite' => true,
 			);
 			
 			register_taxonomy($key, array('post', 'page'), $args);
		}
	}
	
	
	
	/*
	 Include a new Template to show the search results
	 */
	static function include_new_template($template){
		
		if(strstr($_SERVER["REQUEST_URI"], 'query-results') && isset($_GET['pt'])){
			$template = self::get_query_resulsts_template();
		}
		
		return $template;
	}
	
	
	//returns the query results templates
	static function get_query_resulsts_template(){
		return HOTWPSEARCH_DIR . '/templates/query-results.php';
	}
	
	
	//filter the title
	static function filter_the_title($title, $separation, $seplocation){
	if(strstr($_SERVER["REQUEST_URI"], 'query-results') && isset($_GET['pt'])){
			$title = 'Search results with multiple taxonomies';
		}
		return $title;
	}
	
	
	
	/*
	 * return the queries
	 * */
	static function get_serach_posts_or_page(){
		
		switch ($_GET['pt']){
			case 1 :
				$post_type = 'page';
				break;
			case 2 :
				$post_type = 'post';
				break;
			default: 
				$post_type = array('post', 'page');
				break;
		}
		
		$tax_query = array();
		foreach(self::$taxonomies as $slug => $taxonomy){
			if(!empty($_GET[$slug]) && strlen($_GET[$slug]>0)){
				$tax_query[] = array(
					'taxonomy' => $slug,
					'field' => id,
					'terms' => array($_GET[$slug])
				);
			}
		}
		
		$args = array(
			'post_type' => $post_type,
			'tax_query' => $tax_query
		);

		$args['tax_query']['relation'] = 'AND';
		
		//var_dump($args);
		
		return new WP_Query($args);
		
	}
	
	
}