<?php

if ( ! function_exists( 'aalto_edge_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function aalto_edge_search_body_class( $classes ) {
		$classes[] = 'edgtf-fullscreen-search';
		$classes[] = 'edgtf-search-fade';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_search_body_class' );
}

if ( ! function_exists( 'aalto_edge_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function aalto_edge_get_search() {
		aalto_edge_load_search_template();
	}
	
	add_action( 'aalto_edge_before_page_header', 'aalto_edge_get_search' );
}

if ( ! function_exists( 'aalto_edge_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function aalto_edge_load_search_template() {
        aalto_edge_get_module_template_part( 'types/fullscreen/templates/fullscreen', 'search' );
	}
}