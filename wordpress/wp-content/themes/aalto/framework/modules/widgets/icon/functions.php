<?php

if ( ! function_exists( 'aalto_edge_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function aalto_edge_register_icon_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_icon_widget' );
}