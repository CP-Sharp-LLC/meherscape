<?php

if ( ! function_exists( 'aalto_edge_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function aalto_edge_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_woocommerce_dropdown_cart_widget' );
}