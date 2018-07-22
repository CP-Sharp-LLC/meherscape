<?php

if ( ! function_exists( 'aalto_edge_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function aalto_edge_register_blog_list_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_blog_list_widget' );
}