<?php

if ( ! function_exists( 'aalto_edge_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function aalto_edge_register_separator_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_separator_widget' );
}