<?php

if ( ! function_exists( 'aalto_edge_map_sidebar_meta' ) ) {
	function aalto_edge_map_sidebar_meta() {
		$edgtf_sidebar_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'aalto_edge_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'aalto' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'aalto' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'aalto' ),
				'parent'      => $edgtf_sidebar_meta_box,
                'options'       => aalto_edge_get_custom_sidebars_options( true )
			)
		);
		
		$edgtf_custom_sidebars = aalto_edge_get_custom_sidebars();
		if ( count( $edgtf_custom_sidebars ) > 0 ) {
			aalto_edge_add_meta_box_field(
				array(
					'name'        => 'edgtf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'aalto' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'aalto' ),
					'parent'      => $edgtf_sidebar_meta_box,
					'options'     => $edgtf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_sidebar_meta', 31 );
}