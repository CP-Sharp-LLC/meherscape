<?php

if ( ! function_exists( 'aalto_edge_get_title_types_meta_boxes' ) ) {
	function aalto_edge_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'aalto_edge_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'aalto' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'aalto_edge_map_title_meta' ) ) {
	function aalto_edge_map_title_meta() {
		$title_type_meta_boxes = aalto_edge_get_title_types_meta_boxes();
		
		$title_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'aalto_edge_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'aalto' ),
				'name'  => 'title_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'aalto' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'aalto' ),
				'parent'        => $title_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '',
						'no'  => '#edgtf_edgtf_show_title_area_meta_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '#edgtf_edgtf_show_title_area_meta_container',
						'no'  => '',
						'yes' => '#edgtf_edgtf_show_title_area_meta_container'
					)
				)
			)
		);
		
			$show_title_area_meta_container = aalto_edge_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'edgtf_show_title_area_meta_container',
					'hidden_property' => 'edgtf_show_title_area_meta',
					'hidden_value'    => 'no'
				)
			);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'aalto' ),
						'description'   => esc_html__( 'Choose title type', 'aalto' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'aalto' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'aalto' ),
						'options'       => aalto_edge_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'aalto' ),
						'description' => esc_html__( 'Set a height for Title Area', 'aalto' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'aalto' ),
						'description' => esc_html__( 'Choose a background color for title area', 'aalto' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'aalto' ),
						'description' => esc_html__( 'Choose an Image for title area', 'aalto' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'aalto' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'aalto' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'aalto' ),
							'hide'                => esc_html__( 'Hide Image', 'aalto' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'aalto' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'aalto' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'aalto' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'aalto' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'aalto' )
						)
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'aalto' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'aalto' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'aalto' ),
							'header_bottom' => esc_html__( 'From Bottom of Header', 'aalto' ),
							'window_top'    => esc_html__( 'From Window Top', 'aalto' )
						)
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'aalto' ),
						'options'       => aalto_edge_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'aalto' ),
						'description' => esc_html__( 'Choose a color for title text', 'aalto' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'aalto' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'aalto' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'aalto' ),
						'options'       => aalto_edge_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'aalto' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'aalto' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'aalto_edge_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_title_meta', 60 );
}