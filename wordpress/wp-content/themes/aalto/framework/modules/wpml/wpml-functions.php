<?php

if ( ! function_exists( 'aalto_edge_disable_wpml_css' ) ) {
	function aalto_edge_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'aalto_edge_disable_wpml_css' );
}