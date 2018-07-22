<?php

if ( ! function_exists( 'aalto_edge_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function aalto_edge_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'AaltoEdge\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'aalto_edge_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function aalto_edge_init_register_header_minimal_type() {
		add_filter( 'aalto_edge_register_header_type_class', 'aalto_edge_register_header_minimal_type' );
	}
	
	add_action( 'aalto_edge_before_header_function_init', 'aalto_edge_init_register_header_minimal_type' );
}

if ( ! function_exists( 'aalto_edge_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function aalto_edge_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'aalto' );
		
		return $menus;
	}
	
	if ( aalto_edge_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'aalto_edge_register_headers_menu', 'aalto_edge_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'aalto_edge_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function aalto_edge_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_above',
				'name'          => esc_html__( 'Fullscreen Menu Top', 'aalto' ),
				'description'   => esc_html__( 'This widget area is rendered above full screen menu', 'aalto' ),
				'before_widget' => '<div class="%2$s edgtf-fullscreen-menu-above-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="edgtf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_below',
				'name'          => esc_html__( 'Fullscreen Menu Bottom', 'aalto' ),
				'description'   => esc_html__( 'This widget area is rendered below full screen menu', 'aalto' ),
				'before_widget' => '<div class="%2$s edgtf-fullscreen-menu-below-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="edgtf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( aalto_edge_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'aalto_edge_register_header_minimal_full_screen_menu_widgets' );
	}
}