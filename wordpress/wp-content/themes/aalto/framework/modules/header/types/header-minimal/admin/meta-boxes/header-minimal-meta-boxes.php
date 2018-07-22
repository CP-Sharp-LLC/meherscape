<?php

if ( ! function_exists( 'aalto_edge_get_hide_dep_for_header_minimal_area_meta_boxes' ) ) {
    function aalto_edge_get_hide_dep_for_header_minimal_area_meta_boxes() {
        $hide_dep_options = apply_filters( 'aalto_edge_header_minimal_hide_meta_boxes', $hide_dep_options = array() );

        return $hide_dep_options;
    }
}

if ( ! function_exists( 'aalto_edge_header_minimal_meta_options_map' ) ) {
    function aalto_edge_header_minimal_meta_options_map( $header_meta_box ) {
        $hide_dep_options = aalto_edge_get_hide_dep_for_header_minimal_area_meta_boxes();

        $header_minimal_meta_container = aalto_edge_add_admin_container(
            array(
                'parent'          => $header_meta_box,
                'name'            => 'header_minimal_container',
                'hidden_property' => 'edgtf_header_type_meta',
                'hidden_values'   => $hide_dep_options
            )
        );

        aalto_edge_add_admin_section_title(
            array(
                'parent' => $header_minimal_meta_container,
                'name'   => 'header_minimal_style',
                'title'  => esc_html__( 'Minimal Header', 'aalto' )
            )
        );

        aalto_edge_add_meta_box_field(
            array(
                'name'          => 'edgtf_menu_position_header_full_screen_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Full Screen Menu Opener Position', 'aalto' ),
                'description'   => esc_html__( 'Choose the position of fullscreen menu opener button', 'aalto' ),
                'parent'        => $header_minimal_meta_container,
                'default_value' => '',
                'options' => array(
                    '' => '',
                    'fullscreen-opener-right' => esc_html__('Right', 'aalto'),
                    'fullscreen-opener-left' => esc_html__('Left', 'aalto'),
                )
            )
        );
    }

    add_action( 'aalto_edge_additional_header_area_meta_boxes_map', 'aalto_edge_header_minimal_meta_options_map', 10, 1 );
}