<?php

if ( ! function_exists( 'aalto_edge_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function aalto_edge_register_social_icon_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_social_icon_widget' );
}