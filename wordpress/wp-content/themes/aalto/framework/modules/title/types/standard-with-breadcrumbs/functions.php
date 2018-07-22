<?php

if ( ! function_exists( 'aalto_edge_set_title_standard_with_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set standard with breadcrumbs title type value for title options map and meta boxes
	 */
	function aalto_edge_set_title_standard_with_breadcrumbs_type_for_options( $type ) {
		$type['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrumbs', 'aalto' );
		
		return $type;
	}
	
	add_filter( 'aalto_edge_title_type_global_option', 'aalto_edge_set_title_standard_with_breadcrumbs_type_for_options' );
	add_filter( 'aalto_edge_title_type_meta_boxes', 'aalto_edge_set_title_standard_with_breadcrumbs_type_for_options' );
}