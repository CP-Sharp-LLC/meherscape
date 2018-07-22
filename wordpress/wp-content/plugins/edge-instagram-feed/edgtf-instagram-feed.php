<?php
/*
Plugin Name: Edge Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Edge Themes
Version: 1.0
*/
define('EDGE_INSTAGRAM_FEED_VERSION', '1.0');
define('EDGE_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('EDGE_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if(!function_exists('edgtf_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function edgtf_instagram_feed_text_domain() {
        load_plugin_textdomain('edge-instagram-feed', false, EDGE_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'edgtf_instagram_feed_text_domain');
}