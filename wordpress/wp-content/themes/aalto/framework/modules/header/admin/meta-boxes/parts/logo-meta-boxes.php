<?php

if ( ! function_exists( 'aalto_edge_logo_meta_box_map' ) ) {
	function aalto_edge_logo_meta_box_map() {
		
		$logo_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'aalto_edge_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'aalto' ),
				'name'  => 'logo_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'aalto' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'aalto' ),
				'parent'      => $logo_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'aalto' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'aalto' ),
				'parent'      => $logo_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'aalto' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'aalto' ),
				'parent'      => $logo_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'aalto' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'aalto' ),
				'parent'      => $logo_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'aalto' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'aalto' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_logo_meta_box_map', 47 );
}