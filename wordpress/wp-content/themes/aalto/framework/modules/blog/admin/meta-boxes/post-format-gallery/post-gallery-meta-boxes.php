<?php

if ( ! function_exists( 'aalto_edge_map_post_gallery_meta' ) ) {
	
	function aalto_edge_map_post_gallery_meta() {
		$gallery_post_format_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'aalto' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		aalto_edge_add_multiple_images_field(
			array(
				'name'        => 'edgtf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'aalto' ),
				'description' => esc_html__( 'Choose your gallery images', 'aalto' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_post_gallery_meta', 21 );
}
