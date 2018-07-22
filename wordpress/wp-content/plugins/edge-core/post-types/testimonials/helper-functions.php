<?php

if ( ! function_exists( 'edgtf_core_testimonials_meta_box_functions' ) ) {
	function edgtf_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'aalto_edge_meta_box_post_types_save', 'edgtf_core_testimonials_meta_box_functions' );
	add_filter( 'aalto_edge_meta_box_post_types_remove', 'edgtf_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'edgtf_core_register_testimonials_cpt' ) ) {
	function edgtf_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'EdgeCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'edgtf_core_filter_register_custom_post_types', 'edgtf_core_register_testimonials_cpt' );
}