<?php

if ( ! function_exists( 'edgtf_core_map_testimonials_meta' ) ) {
	function edgtf_core_map_testimonials_meta() {
		$testimonial_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'edge-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'edge-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'edge-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'edge-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'edge-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'edge-core' ),
				'description' => esc_html__( 'Enter author name', 'edge-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'edge-core' ),
				'description' => esc_html__( 'Enter author job position', 'edge-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'edgtf_core_map_testimonials_meta', 95 );
}