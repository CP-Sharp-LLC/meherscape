<?php

if ( ! function_exists( 'aalto_edge_map_content_bottom_meta' ) ) {
	function aalto_edge_map_content_bottom_meta() {
		
		$content_bottom_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'aalto_edge_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_bottom_meta' ),
				'title' => esc_html__( 'Content Bottom', 'aalto' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'aalto' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'aalto' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''   => '#edgtf_edgtf_show_content_bottom_meta_container',
						'no' => '#edgtf_edgtf_show_content_bottom_meta_container'
					),
					'show'       => array(
						'yes' => '#edgtf_edgtf_show_content_bottom_meta_container'
					)
				)
			)
		);
		
		$show_content_bottom_meta_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'edgtf_show_content_bottom_meta_container',
				'hidden_property' => 'edgtf_enable_content_bottom_area_meta',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'aalto' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'aalto' ),
				'options'       => aalto_edge_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'aalto' ),
				'options'       => aalto_edge_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'edgtf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'aalto' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'aalto' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_content_bottom_meta', 71 );
}