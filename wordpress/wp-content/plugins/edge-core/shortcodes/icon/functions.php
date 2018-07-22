<?php

if ( ! function_exists( 'edgtf_core_add_icon_shortcodes' ) ) {
	function edgtf_core_add_icon_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Icon\Icon'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'edgtf_core_filter_add_vc_shortcode', 'edgtf_core_add_icon_shortcodes' );
}

if ( ! function_exists( 'edgtf_core_set_icon_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for icon shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function edgtf_core_set_icon_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-icon';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'edgtf_core_filter_add_vc_shortcodes_custom_icon_class', 'edgtf_core_set_icon_icon_class_name_for_vc_shortcodes' );
}