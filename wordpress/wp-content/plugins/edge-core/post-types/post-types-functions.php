<?php

if ( ! function_exists( 'edgtf_core_include_custom_post_types_files' ) ) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function edgtf_core_include_custom_post_types_files() {
		if ( edgtf_core_theme_installed() ) {
			foreach ( glob( EDGE_CORE_CPT_PATH . '/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action( 'after_setup_theme', 'edgtf_core_include_custom_post_types_files', 1 );
}

if ( ! function_exists( 'edgtf_core_include_custom_post_types_meta_boxes' ) ) {
	/**
	 * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function edgtf_core_include_custom_post_types_meta_boxes() {
		if ( edgtf_core_theme_installed() ) {
			foreach ( glob( EDGE_CORE_CPT_PATH . '/*/admin/meta-boxes/*.php' ) as $meta_boxes_map ) {
				include_once $meta_boxes_map;
			}
		}
	}
	
	add_action( 'aalto_edge_before_meta_boxes_map', 'edgtf_core_include_custom_post_types_meta_boxes' );
}

if ( ! function_exists( 'edgtf_core_include_custom_post_types_global_options' ) ) {
	/**
	 * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function edgtf_core_include_custom_post_types_global_options() {
		if ( edgtf_core_theme_installed() ) {
			foreach ( glob( EDGE_CORE_CPT_PATH . '/*/admin/options/*.php' ) as $global_options ) {
				include_once $global_options;
			}
		}
	}
	
	add_action( 'aalto_edge_before_options_map', 'edgtf_core_include_custom_post_types_global_options', 1 );
}