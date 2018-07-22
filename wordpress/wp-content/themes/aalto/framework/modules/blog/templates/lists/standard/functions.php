<?php

if ( ! function_exists( 'aalto_edge_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function aalto_edge_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'aalto' );
		
		return $templates;
	}
	
	add_filter( 'aalto_edge_register_blog_templates', 'aalto_edge_register_blog_standard_template_file' );
}

if ( ! function_exists( 'aalto_edge_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function aalto_edge_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'aalto' );
		
		return $options;
	}
	
	add_filter( 'aalto_edge_blog_list_type_global_option', 'aalto_edge_set_blog_standard_type_global_option' );
}