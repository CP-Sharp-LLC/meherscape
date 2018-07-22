<?php

if ( ! function_exists( 'aalto_edge_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function aalto_edge_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'edgtf-container';
		$params_list['inner']  = 'edgtf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'aalto_edge_blog_holder_params', 'aalto_edge_get_blog_holder_params' );
}

if ( ! function_exists( 'aalto_edge_get_blog_holder_classes' ) ) {
	/**
	 * Function that generates blog holder classes for blog page
	 */
	function aalto_edge_get_blog_holder_classes( $classes ) {
		$sidebar_classes   = array();
		$sidebar_classes[] = 'edgtf-grid-large-gutter';
		
		return implode( ' ', $sidebar_classes );
	}
	
	add_filter( 'aalto_edge_blog_holder_classes', 'aalto_edge_get_blog_holder_classes' );
}

if ( ! function_exists( 'aalto_edge_blog_part_params' ) ) {
	function aalto_edge_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h3';
		$part_params['link_tag']  = 'h4';
		$part_params['quote_tag'] = 'h4';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'aalto_edge_blog_part_params', 'aalto_edge_blog_part_params' );
}