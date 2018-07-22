<?php

if ( ! function_exists( 'aalto_edge_register_raw_html_widget' ) ) {
	/**
	 * Function that register raw html widget
	 */
	function aalto_edge_register_raw_html_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeRawHTMLWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_raw_html_widget' );
}