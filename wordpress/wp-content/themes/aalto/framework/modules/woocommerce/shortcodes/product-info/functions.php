<?php

if ( ! function_exists( 'aalto_edge_add_product_info_shortcode' ) ) {
	function aalto_edge_add_product_info_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\ProductInfo\ProductInfo',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	if ( aalto_edge_core_plugin_installed() ) {
		add_filter( 'edgtf_core_filter_add_vc_shortcode', 'aalto_edge_add_product_info_shortcode' );
	}
}

if ( ! function_exists( 'aalto_edge_add_product_info_into_shortcodes_list' ) ) {
	function aalto_edge_add_product_info_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'edgtf_product_info';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'aalto_edge_woocommerce_shortcodes_list', 'aalto_edge_add_product_info_into_shortcodes_list' );
}