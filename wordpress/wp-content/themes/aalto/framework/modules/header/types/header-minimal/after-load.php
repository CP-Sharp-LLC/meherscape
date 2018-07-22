<?php

if ( ! function_exists( 'aalto_edge_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function aalto_edge_header_minimal_full_screen_menu_body_class( $classes ) {
		$classes[] = 'edgtf-' . aalto_edge_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( aalto_edge_check_is_header_type_enabled( 'header-minimal', aalto_edge_get_page_id() ) ) {
		add_filter( 'body_class', 'aalto_edge_header_minimal_full_screen_menu_body_class' );
	}
}

if ( ! function_exists( 'aalto_edge_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function aalto_edge_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => aalto_edge_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		aalto_edge_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( aalto_edge_check_is_header_type_enabled( 'header-minimal', aalto_edge_get_page_id() ) ) {
		add_action( 'aalto_edge_after_wrapper_inner', 'aalto_edge_get_header_minimal_full_screen_menu', 40 );
	}
}

if ( ! function_exists( 'aalto_edge_header_minimal_mobile_menu_module' ) ) {
    /**
     * Function that edits module for mobile menu
     *
     * @param $module - default module value
     *
     * @return string name of module
     */
    function aalto_edge_header_minimal_mobile_menu_module( $module ) {
        return 'header/types/header-minimal';
    }

    if ( aalto_edge_check_is_header_type_enabled( 'header-minimal', aalto_edge_get_page_id() ) ) {
        add_filter('aalto_edge_mobile_menu_module', 'aalto_edge_header_minimal_mobile_menu_module');
    }
}

if ( ! function_exists( 'aalto_edge_header_minimal_mobile_menu_slug' ) ) {
    /**
     * Function that edits slug for mobile menu
     *
     * @param $slug - default slug value
     *
     * @return string name of slug
     */
    function aalto_edge_header_minimal_mobile_menu_slug( $slug ) {
        return 'minimal';
    }

    if ( aalto_edge_check_is_header_type_enabled( 'header-minimal', aalto_edge_get_page_id() ) ) {
        add_filter('aalto_edge_mobile_menu_slug', 'aalto_edge_header_minimal_mobile_menu_slug');
    }
}