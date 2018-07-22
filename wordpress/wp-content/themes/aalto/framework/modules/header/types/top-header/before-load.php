<?php

if ( ! function_exists( 'aalto_edge_set_show_dep_options_for_top_header' ) ) {
	/**
	 * This function is used to show this header type specific containers/panels for admin options when another header type is selected
	 */
	function aalto_edge_set_show_dep_options_for_top_header( $show_dep_options ) {
		$show_dep_options[] = '#edgtf_top_header_container';
		
		return $show_dep_options;
	}
	
	// show top header container for global options
	add_filter( 'aalto_edge_show_dep_options_for_header_box', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_centered', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_divided', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_minimal', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_standard', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_standard_extended', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_tabbed', 'aalto_edge_set_show_dep_options_for_top_header' );
	
	// show top header container for meta boxes
	add_filter( 'aalto_edge_show_dep_options_for_header_box_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_centered_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_divided_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_minimal_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_standard_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_standard_extended_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
	add_filter( 'aalto_edge_show_dep_options_for_header_tabbed_meta_boxes', 'aalto_edge_set_show_dep_options_for_top_header' );
}

if ( ! function_exists( 'aalto_edge_set_hide_dep_options_for_top_header' ) ) {
	/**
	 * This function is used to hide this header type specific containers/panels for admin options when another header type is selected
	 */
	function aalto_edge_set_hide_dep_options_for_top_header( $hide_dep_options ) {
		$hide_dep_options[] = '#edgtf_top_header_container';
		
		return $hide_dep_options;
	}
	
	// hide top header container for global options
	add_filter( 'aalto_edge_hide_dep_options_for_header_top_menu', 'aalto_edge_set_hide_dep_options_for_top_header' );
	add_filter( 'aalto_edge_hide_dep_options_for_header_vertical', 'aalto_edge_set_hide_dep_options_for_top_header' );
	add_filter( 'aalto_edge_hide_dep_options_for_header_vertical_closed', 'aalto_edge_set_hide_dep_options_for_top_header' );
	add_filter( 'aalto_edge_hide_dep_options_for_header_vertical_compact', 'aalto_edge_set_hide_dep_options_for_top_header' );
	
	// hide top header container for meta boxes
	add_filter( 'aalto_edge_hide_dep_options_for_header_top_menu_meta_boxes', 'aalto_edge_set_hide_dep_options_for_top_header' );
	add_filter( 'aalto_edge_hide_dep_options_for_header_vertical_meta_boxes', 'aalto_edge_set_hide_dep_options_for_top_header' );
	add_filter( 'aalto_edge_hide_dep_options_for_header_vertical_closed_meta_boxes', 'aalto_edge_set_hide_dep_options_for_top_header' );
	add_filter( 'aalto_edge_hide_dep_options_for_header_vertical_compact_meta_boxes', 'aalto_edge_set_hide_dep_options_for_top_header' );
}