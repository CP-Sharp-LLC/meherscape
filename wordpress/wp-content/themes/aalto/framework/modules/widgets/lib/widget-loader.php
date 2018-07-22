<?php

if ( ! function_exists( 'aalto_edge_register_widgets' ) ) {
	function aalto_edge_register_widgets() {
		$widgets = apply_filters( 'aalto_edge_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'aalto_edge_register_widgets' );
}