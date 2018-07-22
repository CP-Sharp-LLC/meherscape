<?php

if ( ! function_exists( 'aalto_edge_map_post_quote_meta' ) ) {
	function aalto_edge_map_post_quote_meta() {
		$quote_post_format_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'aalto' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'aalto' ),
				'description' => esc_html__( 'Enter Quote text', 'aalto' ),
				'parent'      => $quote_post_format_meta_box,
			
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'aalto' ),
				'description' => esc_html__( 'Enter Quote author', 'aalto' ),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_post_quote_meta', 25 );
}