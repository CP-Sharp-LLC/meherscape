<?php

if ( ! function_exists( 'aalto_edge_map_footer_meta' ) ) {
	function aalto_edge_map_footer_meta() {
		
		$footer_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'aalto_edge_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'aalto' ),
				'name'  => 'footer_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Footer for this Page', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'aalto' ),
				'parent'        => $footer_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'aalto' ),
				'parent'        => $footer_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array()
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'aalto' ),
				'parent'        => $footer_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_footer_meta', 70 );
}