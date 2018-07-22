<?php

if ( ! function_exists( 'edgtf_core_map_team_single_meta' ) ) {
	function edgtf_core_map_team_single_meta() {
		
		$meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => 'team-member',
				'title' => esc_html__( 'Team Member Info', 'edge-core' ),
				'name'  => 'team_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Position', 'edge-core' ),
				'description' => esc_html__( 'The members\'s role within the team', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_birth_date',
				'type'        => 'date',
				'label'       => esc_html__( 'Birth date', 'edge-core' ),
				'description' => esc_html__( 'The members\'s birth date', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_email',
				'type'        => 'text',
				'label'       => esc_html__( 'Email', 'edge-core' ),
				'description' => esc_html__( 'The members\'s email', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Phone', 'edge-core' ),
				'description' => esc_html__( 'The members\'s phone', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Address', 'edge-core' ),
				'description' => esc_html__( 'The members\'s addres', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_education',
				'type'        => 'text',
				'label'       => esc_html__( 'Education', 'edge-core' ),
				'description' => esc_html__( 'The members\'s education', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_resume',
				'type'        => 'file',
				'label'       => esc_html__( 'Resume', 'edge-core' ),
				'description' => esc_html__( 'Upload members\'s resume', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		for ( $x = 1; $x < 6; $x ++ ) {
			
			$social_icon_group = aalto_edge_add_admin_group(
				array(
					'name'   => 'edgtf_team_member_social_icon_group' . $x,
					'title'  => esc_html__( 'Social Link ', 'edge-core' ) . $x,
					'parent' => $meta_box
				)
			);
			
			$social_row1 = aalto_edge_add_admin_row(
				array(
					'name'   => 'edgtf_team_member_social_icon_row1' . $x,
					'parent' => $social_icon_group
				)
			);
			
			AaltoEdgeIconCollections::get_instance()->getIconsMetaBoxOrOption(
				array(
					'label'            => esc_html__( 'Icon ', 'edge-core' ) . $x,
					'parent'           => $social_row1,
					'name'             => 'edgtf_team_member_social_icon_pack_' . $x,
					'defaul_icon_pack' => '',
					'type'             => 'meta-box',
					'field_type'       => 'simple'
				)
			);
			
			$social_row2 = aalto_edge_add_admin_row(
				array(
					'name'   => 'edgtf_team_member_social_icon_row2' . $x,
					'parent' => $social_icon_group
				)
			);
			
			aalto_edge_add_meta_box_field(
				array(
					'type'            => 'textsimple',
					'label'           => esc_html__( 'Link', 'edge-core' ),
					'name'            => 'edgtf_team_member_social_icon_' . $x . '_link',
					'hidden_property' => 'edgtf_team_member_social_icon_pack_' . $x,
					'hidden_value'    => '',
					'parent'          => $social_row2
				)
			);
			
			aalto_edge_add_meta_box_field(
				array(
					'type'            => 'selectsimple',
					'label'           => esc_html__( 'Target', 'edge-core' ),
					'name'            => 'edgtf_team_member_social_icon_' . $x . '_target',
					'options'         => aalto_edge_get_link_target_array(),
					'hidden_property' => 'edgtf_team_member_social_icon_' . $x . '_link',
					'hidden_value'    => '',
					'parent'          => $social_row2
				)
			);
		}
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'edgtf_core_map_team_single_meta', 46 );
}