<?php

if ( ! function_exists( 'aalto_edge_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function aalto_edge_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'aalto' ),
				'description'   => esc_html__( 'Default Sidebar', 'aalto' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgtf-widget-title-holder"><h4 class="edgtf-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'aalto_edge_register_sidebars', 1 );
}

if ( ! function_exists( 'aalto_edge_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates AaltoEdgeSidebar object
	 */
	function aalto_edge_add_support_custom_sidebar() {
		add_theme_support( 'AaltoEdgeSidebar' );
		
		if ( get_theme_support( 'AaltoEdgeSidebar' ) ) {
			new AaltoEdgeSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'aalto_edge_add_support_custom_sidebar' );
}