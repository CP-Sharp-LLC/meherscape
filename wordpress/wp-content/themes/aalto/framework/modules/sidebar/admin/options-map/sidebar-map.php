<?php

if ( ! function_exists( 'aalto_edge_sidebar_options_map' ) ) {
	function aalto_edge_sidebar_options_map() {
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'aalto' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = aalto_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'aalto' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		aalto_edge_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'aalto' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'aalto' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => aalto_edge_get_custom_sidebars_options()
		) );
		
		$aalto_custom_sidebars = aalto_edge_get_custom_sidebars();
		if ( count( $aalto_custom_sidebars ) > 0 ) {
			aalto_edge_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'aalto' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'aalto' ),
				'parent'      => $sidebar_panel,
				'options'     => $aalto_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_sidebar_options_map', 9 );
}