<?php

if ( ! function_exists( 'aalto_edge_get_hide_dep_for_header_standard_options' ) ) {
	function aalto_edge_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'aalto_edge_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'aalto_edge_header_standard_map' ) ) {
	function aalto_edge_header_standard_map( $parent ) {
		$hide_dep_options = aalto_edge_get_hide_dep_for_header_standard_options();
		
		aalto_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'aalto' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'aalto' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'aalto' ),
					'left'   => esc_html__( 'Left', 'aalto' ),
					'center' => esc_html__( 'Center', 'aalto' )
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'aalto_edge_additional_header_menu_area_options_map', 'aalto_edge_header_standard_map' );
}