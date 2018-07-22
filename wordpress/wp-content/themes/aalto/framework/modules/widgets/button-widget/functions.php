<?php

if ( ! function_exists( 'aalto_edge_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function aalto_edge_register_button_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_button_widget' );
}