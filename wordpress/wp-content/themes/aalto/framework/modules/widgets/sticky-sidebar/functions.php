<?php

if(!function_exists('aalto_edge_register_sticky_sidebar_widget')) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function aalto_edge_register_sticky_sidebar_widget($widgets) {
		$widgets[] = 'AaltoEdgeStickySidebar';
		
		return $widgets;
	}
	
	add_filter('aalto_edge_register_widgets', 'aalto_edge_register_sticky_sidebar_widget');
}