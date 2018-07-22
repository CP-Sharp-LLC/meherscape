<?php
if ( ! function_exists( 'aalto_edge_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function aalto_edge_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'aalto' ),
				'description'   => esc_html__( 'Side Area', 'aalto' ),
				'before_widget' => '<div id="%1$s" class="widget edgtf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'aalto_edge_register_side_area_sidebar' );
}

if ( ! function_exists( 'aalto_edge_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function aalto_edge_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'edgtf_side_area_opener' ) ) {
			
			$classes[] = 'edgtf-side-menu-slide-from-right';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_side_menu_body_class' );
}

if ( ! function_exists( 'aalto_edge_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function aalto_edge_get_side_area() {
		
		if ( is_active_widget( false, false, 'edgtf_side_area_opener' ) ) {
			
			aalto_edge_get_module_template_part( 'templates/sidearea', 'sidearea' );
		}
	}
	
	add_action( 'aalto_edge_after_body_tag', 'aalto_edge_get_side_area', 10 );
}