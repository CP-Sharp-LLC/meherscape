<?php

if ( ! function_exists( 'aalto_edge_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function aalto_edge_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'aalto' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'aalto' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'aalto_edge_additional_title_area_meta_boxes', 'aalto_edge_breadcrumbs_title_type_options_meta_boxes' );
}