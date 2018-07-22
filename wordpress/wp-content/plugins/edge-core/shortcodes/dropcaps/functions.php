<?php

if ( ! function_exists( 'edgtf_core_add_dropcaps_shortcodes' ) ) {
	function edgtf_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'edgtf_core_filter_add_vc_shortcode', 'edgtf_core_add_dropcaps_shortcodes' );
}