<?php

if ( ! function_exists( 'aalto_edge_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function aalto_edge_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'aalto_edge_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'aalto_edge_header_standard_meta_map' ) ) {
	function aalto_edge_header_standard_meta_map( $parent ) {
		$hide_dep_options = aalto_edge_get_hide_dep_for_header_standard_meta_boxes();
		
		aalto_edge_add_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'edgtf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'aalto' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'aalto' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'aalto' ),
					'left'   => esc_html__( 'Left', 'aalto' ),
					'right'  => esc_html__( 'Right', 'aalto' ),
					'center' => esc_html__( 'Center', 'aalto' )
				),
				'hidden_property' => 'edgtf_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'aalto_edge_additional_header_area_meta_boxes_map', 'aalto_edge_header_standard_meta_map' );
}