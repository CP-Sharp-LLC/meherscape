<?php

if ( ! function_exists( 'aalto_edge_map_post_video_meta' ) ) {
	function aalto_edge_map_post_video_meta() {
		$video_post_format_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'aalto' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'aalto' ),
				'description'   => esc_html__( 'Choose video type', 'aalto' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'aalto' ),
					'self'            => esc_html__( 'Self Hosted', 'aalto' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#edgtf_edgtf_video_self_hosted_container',
						'self'            => '#edgtf_edgtf_video_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#edgtf_edgtf_video_embedded_container',
						'self'            => '#edgtf_edgtf_video_self_hosted_container'
					)
				)
			)
		);
		
		$edgtf_video_embedded_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'edgtf_video_embedded_container',
				'hidden_property' => 'edgtf_video_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$edgtf_video_self_hosted_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'edgtf_video_self_hosted_container',
				'hidden_property' => 'edgtf_video_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'aalto' ),
				'description' => esc_html__( 'Enter Video URL', 'aalto' ),
				'parent'      => $edgtf_video_embedded_container,
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'aalto' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'aalto' ),
				'parent'      => $edgtf_video_self_hosted_container,
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'aalto' ),
				'description' => esc_html__( 'Enter video image', 'aalto' ),
				'parent'      => $edgtf_video_self_hosted_container,
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_post_video_meta', 22 );
}