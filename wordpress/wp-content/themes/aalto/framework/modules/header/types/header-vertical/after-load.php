<?php

if ( ! function_exists( 'aalto_edge_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function aalto_edge_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( aalto_edge_check_is_header_type_enabled( 'header-vertical', aalto_edge_get_page_id() ) ) {
		add_filter( 'aalto_edge_allow_sticky_header_behavior', 'aalto_edge_disable_behaviors_for_header_vertical' );
		add_filter( 'aalto_edge_allow_content_boxed_layout', 'aalto_edge_disable_behaviors_for_header_vertical' );
	}
}