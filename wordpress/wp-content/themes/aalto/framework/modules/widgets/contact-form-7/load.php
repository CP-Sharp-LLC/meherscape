<?php

if ( aalto_edge_contact_form_7_installed() ) {
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_cf7_widget' );
}

if ( ! function_exists( 'aalto_edge_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function aalto_edge_register_cf7_widget( $widgets ) {
		$widgets[] = 'AaltoEdgeContactForm7Widget';
		
		return $widgets;
	}
}