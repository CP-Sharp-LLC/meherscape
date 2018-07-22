<?php

if ( ! function_exists( 'aalto_edge_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function aalto_edge_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'AaltoEdge\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'aalto_edge_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function aalto_edge_init_register_header_standard_type() {
		add_filter( 'aalto_edge_register_header_type_class', 'aalto_edge_register_header_standard_type' );
	}
	
	add_action( 'aalto_edge_before_header_function_init', 'aalto_edge_init_register_header_standard_type' );
}