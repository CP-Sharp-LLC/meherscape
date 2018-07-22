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
		$classes[] = 'edgtf-search-covers-header';
		
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
	
	add_action( 'aalto_edge_before_page_header_html_close', 'aalto_edge_get_search' );
	add_action( 'aalto_edge_before_mobile_header_html_close', 'aalto_edge_get_search' );
}

if ( ! function_exists( 'aalto_edge_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function aalto_edge_load_search_template() {
		$search_icon       = '';
		$search_icon_close = '';
		
		$search_in_grid   = aalto_edge_options()->getOptionValue( 'search_in_grid' ) == 'yes' ? true : false;
		$search_icon_pack = aalto_edge_options()->getOptionValue( 'search_icon_pack' );
		
		if ( ! empty( $search_icon_pack ) ) {
			$search_icon       = aalto_edge_icon_collections()->getSearchIcon( $search_icon_pack, true );
			$search_icon_close = aalto_edge_icon_collections()->getSearchClose( $search_icon_pack, true );
		}
		
		$parameters = array(
			'search_in_grid'    => $search_in_grid,
			'search_icon'       => $search_icon,
			'search_icon_close' => $search_icon_close
		);
		
		aalto_edge_get_module_template_part( 'types/covers-header/templates/covers-header', 'search', '', $parameters );
	}
}