<?php

if ( ! function_exists( 'aalto_edge_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function aalto_edge_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_image_gallery_widget' );
}