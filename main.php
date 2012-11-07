<?php 
/**
Plugin Name: Hot Wordpress Search
Plugin URI: http://d2830852.u330.bassonline.us/
Description: Creates a widget for advanced search
Author: Mahibul Hasan
Version: 1.0.0
Author URI: http://sohag07hasan.elance.com
*/

define("HOTWPSEARCH_DIR", dirname(__FILE__));
define("HOTWPSEARCH_FILE", __FILE__);
define("HOTWPSEARCH_URL", plugins_url('/', __FILE__));

include HOTWPSEARCH_DIR . '/classes/hot-wp-search.php';
hot_wp_search::init();

include HOTWPSEARCH_DIR . '/classes/search-widget.php';
