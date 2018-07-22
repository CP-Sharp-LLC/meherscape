<?php

if ( ! function_exists( 'aalto_edge_include_mobile_header_menu' ) ) {
	function aalto_edge_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'aalto' );
		
		return $menus;
	}
	
	add_filter( 'aalto_edge_register_headers_menu', 'aalto_edge_include_mobile_header_menu' );
}

if ( ! function_exists( 'aalto_edge_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function aalto_edge_register_mobile_header_areas() {
		if ( aalto_edge_is_responsive_on() ) {
			register_sidebar(
				array(
					'id'            => 'edgtf-right-from-mobile-logo',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'aalto' ),
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'aalto' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-right-from-mobile-logo">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'aalto_edge_register_mobile_header_areas' );
}

if ( ! function_exists( 'aalto_edge_mobile_header_class' ) ) {
	function aalto_edge_mobile_header_class( $classes ) {
		$classes[] = 'edgtf-default-mobile-header';
		
		$classes[] = 'edgtf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_mobile_header_class' );
}

if ( ! function_exists( 'aalto_edge_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function aalto_edge_get_mobile_header( $slug = '', $module = '' ) {
		if ( aalto_edge_is_responsive_on() ) {
			$mobile_menu_title = aalto_edge_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title
			);

            $module = apply_filters('aalto_edge_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('aalto_edge_mobile_menu_slug', '');

            aalto_edge_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'aalto_edge_after_wrapper_inner', 'aalto_edge_get_mobile_header', 20 );
}

if ( ! function_exists( 'aalto_edge_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function aalto_edge_get_mobile_logo() {
		$show_logo_image = aalto_edge_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$mobile_logo_image = aalto_edge_get_meta_field_intersect( 'logo_image_mobile', aalto_edge_get_page_id() );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : aalto_edge_get_meta_field_intersect( 'logo_image', aalto_edge_get_page_id() );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = aalto_edge_get_image_dimensions( $logo_image );
			
			$logo_height = '';
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_height'     => $logo_height,
				'logo_styles'     => $logo_styles
			);
			
			aalto_edge_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'aalto_edge_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function aalto_edge_get_mobile_nav() {
		aalto_edge_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'cityrama_edgtf_mobile_header_per_page_js_var' ) ) {
    function cityrama_edgtf_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['edgtfMobileHeaderHeight'] = aalto_edge_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'cityrama_edgtf_per_page_js_vars', 'cityrama_edgtf_mobile_header_per_page_js_var' );
}