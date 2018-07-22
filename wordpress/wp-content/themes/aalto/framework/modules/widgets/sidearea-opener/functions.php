<?php

if ( ! function_exists( 'aalto_edge_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function aalto_edge_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_sidearea_opener_widget' );
}