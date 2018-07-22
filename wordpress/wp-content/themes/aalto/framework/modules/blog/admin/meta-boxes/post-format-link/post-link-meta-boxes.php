<?php

if ( ! function_exists( 'aalto_edge_map_post_link_meta' ) ) {
	function aalto_edge_map_post_link_meta() {
		$link_post_format_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'aalto' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'aalto' ),
				'description' => esc_html__( 'Enter link', 'aalto' ),
				'parent'      => $link_post_format_meta_box,
			
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_post_link_meta', 24 );
}