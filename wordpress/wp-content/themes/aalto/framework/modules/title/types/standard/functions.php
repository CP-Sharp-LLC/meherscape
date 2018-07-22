<?php

if ( ! function_exists( 'aalto_edge_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function aalto_edge_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'aalto' );
		
		return $type;
	}
	
	add_filter( 'aalto_edge_title_type_global_option', 'aalto_edge_set_title_standard_type_for_options' );
	add_filter( 'aalto_edge_title_type_meta_boxes', 'aalto_edge_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'aalto_edge_set_title_standard_type_as_default_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function aalto_edge_set_title_standard_type_as_default_options( $type ) {
		$type = 'standard';
		
		return $type;
	}
	
	add_filter( 'aalto_edge_default_title_type_global_option', 'aalto_edge_set_title_standard_type_as_default_options' );
}