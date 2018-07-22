<?php

if ( ! function_exists( 'aalto_edge_map_post_audio_meta' ) ) {
	function aalto_edge_map_post_audio_meta() {
		$audio_post_format_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'aalto' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'aalto' ),
				'description'   => esc_html__( 'Choose audio type', 'aalto' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'aalto' ),
					'self'            => esc_html__( 'Self Hosted', 'aalto' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#edgtf_edgtf_audio_self_hosted_container',
						'self'            => '#edgtf_edgtf_audio_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#edgtf_edgtf_audio_embedded_container',
						'self'            => '#edgtf_edgtf_audio_self_hosted_container'
					)
				)
			)
		);
		
		$edgtf_audio_embedded_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'edgtf_audio_embedded_container',
				'hidden_property' => 'edgtf_audio_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$edgtf_audio_self_hosted_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'edgtf_audio_self_hosted_container',
				'hidden_property' => 'edgtf_audio_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'aalto' ),
				'description' => esc_html__( 'Enter audio URL', 'aalto' ),
				'parent'      => $edgtf_audio_embedded_container,
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'aalto' ),
				'description' => esc_html__( 'Enter audio link', 'aalto' ),
				'parent'      => $edgtf_audio_self_hosted_container,
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_post_audio_meta', 23 );
}