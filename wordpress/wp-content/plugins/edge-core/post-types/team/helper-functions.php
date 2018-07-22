<?php

if ( ! function_exists( 'edgtf_core_team_meta_box_functions' ) ) {
	function edgtf_core_team_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'aalto_edge_meta_box_post_types_save', 'edgtf_core_team_meta_box_functions' );
	add_filter( 'aalto_edge_meta_box_post_types_remove', 'edgtf_core_team_meta_box_functions' );
}

if ( ! function_exists( 'edgtf_core_team_scope_meta_box_functions' ) ) {
	function edgtf_core_team_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'aalto_edge_set_scope_for_meta_boxes', 'edgtf_core_team_scope_meta_box_functions' );
}

if ( ! function_exists( 'edgtf_core_team_enqueue_meta_box_styles' ) ) {
	function edgtf_core_team_enqueue_meta_box_styles() {
		global $post;
		
		if ( $post->post_type == 'team-member' ) {
			wp_enqueue_style( 'edgtf-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'aalto_edge_enqueue_meta_box_styles', 'edgtf_core_team_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'edgtf_core_register_team_cpt' ) ) {
	function edgtf_core_register_team_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'EdgeCore\CPT\Team\TeamRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'edgtf_core_filter_register_custom_post_types', 'edgtf_core_register_team_cpt' );
}

if ( ! function_exists( 'edgtf_core_get_single_team' ) ) {
	/**
	 * Loads holder template for doctor single
	 */
	function edgtf_core_get_single_team() {
		$team_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => aalto_edge_sidebar_layout(),
			'position'       => get_post_meta( $team_member_id, 'edgtf_team_member_position', true ),
			'birth_date'     => get_post_meta( $team_member_id, 'edgtf_team_member_birth_date', true ),
			'email'          => get_post_meta( $team_member_id, 'edgtf_team_member_email', true ),
			'phone'          => get_post_meta( $team_member_id, 'edgtf_team_member_phone', true ),
			'address'        => get_post_meta( $team_member_id, 'edgtf_team_member_address', true ),
			'education'      => get_post_meta( $team_member_id, 'edgtf_team_member_education', true ),
			'resume'         => get_post_meta( $team_member_id, 'edgtf_team_member_resume', true ),
			'social_icons'   => edgtf_core_single_team_social_icons( $team_member_id ),
		);
		
		edgtf_core_get_cpt_single_module_template_part( 'templates/single/holder', 'team', '', $params );
	}
}

if ( ! function_exists( 'edgtf_core_single_team_social_icons' ) ) {
	function edgtf_core_single_team_social_icons( $id ) {
		$social_icons = array();
		
		for ( $i = 1; $i < 6; $i ++ ) {
			$team_icon_pack = get_post_meta( $id, 'edgtf_team_member_social_icon_pack_' . $i, true );
			if ( $team_icon_pack !== '' ) {
				$team_icon_collection = aalto_edge_icon_collections()->getIconCollection( get_post_meta( $id, 'edgtf_team_member_social_icon_pack_' . $i, true ) );
				$team_social_icon     = get_post_meta( $id, 'edgtf_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true );
				$team_social_link     = get_post_meta( $id, 'edgtf_team_member_social_icon_' . $i . '_link', true );
				$team_social_target   = get_post_meta( $id, 'edgtf_team_member_social_icon_' . $i . '_target', true );
				
				if ( $team_social_icon !== '' ) {
					$team_icon_params                                 = array();
					$team_icon_params['icon_pack']                    = $team_icon_pack;
					$team_icon_params[ $team_icon_collection->param ] = $team_social_icon;
					$team_icon_params['link']                         = ! empty( $team_social_link ) ? $team_social_link : '';
					$team_icon_params['target']                       = ! empty( $team_social_target ) ? $team_social_target : '_self';
					
					$social_icons[] = aalto_edge_execute_shortcode( 'edgtf_icon', $team_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'edgtf_core_get_team_category_list' ) ) {
	function edgtf_core_get_team_category_list( $category = '' ) {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns' => $number_of_columns
		);
		
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}
		
		$html = aalto_edge_execute_shortcode( 'edgtf_team_list', $params );
		
		print $html;
	}
}

if ( ! function_exists( 'edgtf_core_add_team_to_search_types' ) ) {
	function edgtf_core_add_team_to_search_types( $post_types ) {
		$post_types['team-member'] = 'Team Member';
		
		return $post_types;
	}
	
	add_filter( 'aalto_edge_search_post_type_widget_params_post_type', 'edgtf_core_add_team_to_search_types' );
}