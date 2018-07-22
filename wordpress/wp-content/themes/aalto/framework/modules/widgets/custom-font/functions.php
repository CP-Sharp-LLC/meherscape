<?php

if ( ! function_exists( 'aalto_edge_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function aalto_edge_register_custom_font_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_custom_font_widget' );
}