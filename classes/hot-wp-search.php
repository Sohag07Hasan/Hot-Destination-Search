<?php
/*
 * creates a widget area for search feature
 * */

class hot_wp_search{
	
	/* contains the hooks */
	static function init(){
		add_action('widgets_init', array(get_class(), 'register_search_widget_area'));
		add_action('wp_enqueue_scripts', array(get_class(), 'enqueue_scripts'));
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
}