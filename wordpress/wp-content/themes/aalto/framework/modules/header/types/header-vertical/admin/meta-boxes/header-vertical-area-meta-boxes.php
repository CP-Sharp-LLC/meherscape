<?php

if ( ! function_exists( 'aalto_edge_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function aalto_edge_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'aalto_edge_header_vertical_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'aalto_edge_header_vertical_area_meta_options_map' ) ) {
	function aalto_edge_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = aalto_edge_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'hidden_property' => 'edgtf_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'aalto' )
			)
		);
		
		$aalto_custom_sidebars = aalto_edge_get_custom_sidebars();
		if ( count( $aalto_custom_sidebars ) > 0 ) {
			aalto_edge_add_meta_box_field(
				array(
					'name'        => 'edgtf_custom_vertical_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area in Vertical area', 'aalto' ),
					'description' => esc_html__( 'Choose custom widget area to display in vertical menu"', 'aalto' ),
					'parent'      => $header_vertical_area_meta_container,
					'options'     => $aalto_custom_sidebars
				)
			);
		}
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'aalto' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'aalto' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'aalto' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'aalto' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'aalto' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'aalto' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'aalto' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => aalto_edge_get_yes_no_select_array()
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'aalto' ),
				'description'   => esc_html__( 'Set border on vertical area', 'aalto' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => aalto_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgtf_vertical_header_border_container',
						'no'  => '#edgtf_vertical_header_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgtf_vertical_header_border_container'
					)
				)
			)
		);
		
		$vertical_header_border_container = aalto_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'hidden_property' => 'edgtf_vertical_header_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'aalto' ),
				'description' => esc_html__( 'Choose color of border', 'aalto' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'aalto' ),
				'description'   => esc_html__( 'Set content in vertical center', 'aalto' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => aalto_edge_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'aalto_edge_additional_header_area_meta_boxes_map', 'aalto_edge_header_vertical_area_meta_options_map', 10, 1 );
}