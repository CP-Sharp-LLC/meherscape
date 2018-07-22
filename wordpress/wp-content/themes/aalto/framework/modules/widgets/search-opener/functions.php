<?php

if ( ! function_exists( 'aalto_edge_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function aalto_edge_register_search_opener_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_search_opener_widget' );
}