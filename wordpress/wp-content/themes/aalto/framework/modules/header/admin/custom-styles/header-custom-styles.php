<?php

foreach ( glob( EDGE_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'aalto_edge_header_menu_area_styles' ) ) {
	/**
	 * Generates styles for menu area
	 */
	function aalto_edge_header_menu_area_styles() {
		
		$background_color              = aalto_edge_options()->getOptionValue( 'menu_area_background_color' );
		$background_color_transparency = aalto_edge_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_area_height              = aalto_edge_options()->getOptionValue( 'menu_area_height' );
		$menu_area_shadow              = aalto_edge_options()->getOptionValue( 'menu_area_shadow' );
		$border                        = aalto_edge_options()->getOptionValue( 'menu_area_border' );
		$border_color                  = aalto_edge_options()->getOptionValue( 'menu_area_border_color' );
        $padding                       = aalto_edge_options()->getOptionValue( 'menu_area_padding' );
		
		$menu_area_in_grid                  = aalto_edge_options()->getOptionValue( 'menu_area_in_grid' );
		$background_color_grid              = aalto_edge_options()->getOptionValue( 'menu_area_grid_background_color' );
		$background_color_transparency_grid = aalto_edge_options()->getOptionValue( 'menu_area_grid_background_transparency' );
		$menu_area_shadow_grid              = aalto_edge_options()->getOptionValue( 'menu_area_in_grid_shadow' );
		$border_grid                        = aalto_edge_options()->getOptionValue( 'menu_area_in_grid_border' );
		$border_color_grid                  = aalto_edge_options()->getOptionValue( 'menu_area_in_grid_border_color' );
		
		$menu_area_styles = array();
		
		if ( $background_color !== '' ) {
			$menu_area_background_color        = $background_color;
			$menu_area_background_transparency = 1;
			
			if ( $background_color_transparency !== '' ) {
				$menu_area_background_transparency = $background_color_transparency;
			}
			
			$menu_area_styles['background-color'] = aalto_edge_rgba_color( $menu_area_background_color, $menu_area_background_transparency );
		}
		
		if ( $menu_area_height !== '' ) {
			$menu_area_styles['height'] = aalto_edge_filter_px( $menu_area_height ) . 'px !important';
		}
		
		if ( $menu_area_shadow == 'yes' ) {
			$menu_area_styles['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
		}
		
		if ( $border == 'yes' ) {
			$header_border_color = $border_color;
			
			if ( $header_border_color !== '' ) {
				$menu_area_styles['border-bottom'] = '1px solid ' . $header_border_color;
			}
		}

        if ( $padding !== '' ) {
            if ( !aalto_edge_string_ends_with($padding,'%') ){
                $padding_filtered = aalto_edge_filter_px($padding). 'px';
            } else {
                $padding_filtered = $padding;
            }

            echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-vertical-align-containers, .edgtf-sticky-header .edgtf-sticky-holder .edgtf-vertical-align-containers', array('padding' => '0 '.$padding_filtered) );
        }
		
		echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-menu-area', $menu_area_styles );
		
		$menu_area_grid_styles = array();
		
		if ( $menu_area_in_grid == 'yes' && $background_color_grid !== '' ) {
			$menu_area_grid_background_color        = $background_color_grid;
			$menu_area_grid_background_transparency = 1;
			
			if ( $background_color_transparency_grid !== '' ) {
				$menu_area_grid_background_transparency = $background_color_transparency_grid;
			}
			
			$menu_area_grid_styles['background-color'] = aalto_edge_rgba_color( $menu_area_grid_background_color, $menu_area_grid_background_transparency );
		}
		
		if ( $menu_area_shadow_grid == 'yes' ) {
			$menu_area_grid_styles['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
		}
		
		if ( $menu_area_in_grid == 'yes' && $border_grid == 'yes' ) {
			
			$header_gird_border_color = $border_color_grid;
			
			if ( $header_gird_border_color !== '' ) {
				$menu_area_grid_styles['border-bottom'] = '1px solid ' . $header_gird_border_color;
			}
		}
		
		echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-menu-area .edgtf-grid .edgtf-vertical-align-containers', $menu_area_grid_styles );
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_header_menu_area_styles' );
}

if ( ! function_exists( 'aalto_edge_header_logo_area_styles' ) ) {
	/**
	 * Generates styles for menu area
	 */
	function aalto_edge_header_logo_area_styles() {
		
		$background_color              = aalto_edge_options()->getOptionValue( 'logo_area_background_color' );
		$background_color_transparency = aalto_edge_options()->getOptionValue( 'logo_area_background_transparency' );
		$logo_area_height              = aalto_edge_options()->getOptionValue( 'logo_area_height' );
		$border                        = aalto_edge_options()->getOptionValue( 'logo_area_border' );
		$border_color                  = aalto_edge_options()->getOptionValue( 'logo_area_border_color' );
		
		$logo_area_in_grid                  = aalto_edge_options()->getOptionValue( 'logo_area_in_grid' );
		$background_color_grid              = aalto_edge_options()->getOptionValue( 'logo_area_grid_background_color' );
		$background_color_transparency_grid = aalto_edge_options()->getOptionValue( 'logo_area_grid_background_transparency' );
		$border_grid                        = aalto_edge_options()->getOptionValue( 'logo_area_in_grid_border' );
		$border_color_grid                  = aalto_edge_options()->getOptionValue( 'logo_area_in_grid_border_color' );
		
		$logo_area_styles = array();
		
		if ( $background_color !== '' ) {
			$logo_area_background_color        = $background_color;
			$logo_area_background_transparency = 1;
			
			if ( $background_color_transparency !== '' ) {
				$logo_area_background_transparency = $background_color_transparency;
			}
			
			$logo_area_styles['background-color'] = aalto_edge_rgba_color( $logo_area_background_color, $logo_area_background_transparency );
		}
		
		if ( $logo_area_height !== '' ) {
			$logo_area_styles['height'] = aalto_edge_filter_px( $logo_area_height ) . 'px !important';
		}
		
		if ( $border == 'yes' ) {
			$header_border_color = $border_color;
			
			if ( $header_border_color !== '' ) {
				$logo_area_styles['border-bottom'] = '1px solid ' . $header_border_color;
			}
		}
		
		echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-logo-area', $logo_area_styles );
		
		$logo_area_grid_styles = array();
		
		if ( $logo_area_in_grid == 'yes' && $background_color_grid !== '' ) {
			$logo_area_grid_background_color        = $background_color_grid;
			$logo_area_grid_background_transparency = 1;
			
			if ( $background_color_transparency_grid !== '' ) {
				$logo_area_grid_background_transparency = $background_color_transparency_grid;
			}
			
			$logo_area_grid_styles['background-color'] = aalto_edge_rgba_color( $logo_area_grid_background_color, $logo_area_grid_background_transparency );
		}
		
		if ( $logo_area_in_grid == 'yes' && $border_grid == 'yes' ) {
			
			$header_gird_border_color = $border_color_grid;
			
			if ( $header_gird_border_color !== '' ) {
				$logo_area_grid_styles['border-bottom'] = '1px solid ' . $header_gird_border_color;
			}
		}
		
		echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-logo-area .edgtf-grid .edgtf-vertical-align-containers', $logo_area_grid_styles );
		
		if ( aalto_edge_options()->getOptionValue( 'logo_wrapper_padding_header_centered' ) !== '' ) {
			echo aalto_edge_dynamic_css( '.edgtf-header-centered .edgtf-logo-area .edgtf-logo-wrapper', array( 'padding' => aalto_edge_options()->getOptionValue( 'logo_wrapper_padding_header_centered' ) ) );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_header_logo_area_styles' );
}

if ( ! function_exists( 'aalto_edge_main_menu_styles' ) ) {
	/**
	 * Generates styles for main menu
	 */
	function aalto_edge_main_menu_styles() {
		
		// main menu 1st level style
		
		$menu_item_styles = aalto_edge_get_typography_styles( 'menu' );
		$padding          = aalto_edge_options()->getOptionValue( 'menu_padding_left_right' );
		$margin           = aalto_edge_options()->getOptionValue( 'menu_margin_left_right' );
		
		if ( ! empty( $padding ) ) {
			$menu_item_styles['padding'] = '0 ' . aalto_edge_filter_px( $padding ) . 'px';
		}
		if ( ! empty( $margin ) ) {
			$menu_item_styles['margin'] = '0 ' . aalto_edge_filter_px( $margin ) . 'px';
		}
		
		$menu_item_selector = array(
			'.edgtf-main-menu > ul > li > a'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		$hover_color = aalto_edge_options()->getOptionValue( 'menu_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.edgtf-main-menu > ul > li > a:hover'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
		
		$active_color = aalto_edge_options()->getOptionValue( 'menu_activecolor' );
		
		$menu_item_active_styles = array();
		if ( ! empty( $active_color ) ) {
			$menu_item_active_styles['color'] = $active_color;
		}
		
		$menu_item_active_selector = array(
			'.edgtf-main-menu > ul > li.edgtf-active-item > a'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_active_selector, $menu_item_active_styles );
		
		$light_hover_color = aalto_edge_options()->getOptionValue( 'menu_light_hovercolor' );
		
		$menu_item_light_hover_styles = array();
		if ( ! empty( $light_hover_color ) ) {
			$menu_item_light_hover_styles['color'] = $light_hover_color;
		}
		
		$menu_item_light_hover_selector = array(
			'.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li > a:hover'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_light_hover_selector, $menu_item_light_hover_styles );
		
		$light_active_color = aalto_edge_options()->getOptionValue( 'menu_light_activecolor' );
		
		$menu_item_light_active_styles = array();
		if ( ! empty( $light_active_color ) ) {
			$menu_item_light_active_styles['color'] = $light_active_color;
		}
		
		$menu_item_light_active_selector = array(
			'.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li.edgtf-active-item > a'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_light_active_selector, $menu_item_light_active_styles );
		
		$dark_hover_color = aalto_edge_options()->getOptionValue( 'menu_dark_hovercolor' );
		
		$menu_item_dark_hover_styles = array();
		if ( ! empty( $dark_hover_color ) ) {
			$menu_item_dark_hover_styles['color'] = $dark_hover_color;
		}
		
		$menu_item_dark_hover_selector = array(
			'.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li > a:hover'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_dark_hover_selector, $menu_item_dark_hover_styles );
		
		$dark_active_color = aalto_edge_options()->getOptionValue( 'menu_dark_activecolor' );
		
		$menu_item_dark_active_styles = array();
		if ( ! empty( $dark_active_color ) ) {
			$menu_item_dark_active_styles['color'] = $dark_active_color;
		}
		
		$menu_item_dark_active_selector = array(
			'.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li.edgtf-active-item > a'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_dark_active_selector, $menu_item_dark_active_styles );
		
		// main menu 2nd level style
		
		$dropdown_menu_item_styles = aalto_edge_get_typography_styles( 'dropdown' );
		
		$dropdown_menu_item_selector = array(
			'.edgtf-drop-down .second .inner > ul > li > a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_menu_item_selector, $dropdown_menu_item_styles );
		
		$dropdown_hover_color = aalto_edge_options()->getOptionValue( 'dropdown_hovercolor' );
		
		$dropdown_menu_item_hover_styles = array();
		if ( ! empty( $dropdown_hover_color ) ) {
			$dropdown_menu_item_hover_styles['color'] = $dropdown_hover_color . ' !important';
		}
		
		$dropdown_menu_item_hover_selector = array(
			'.edgtf-drop-down .second .inner > ul > li > a:hover',
			'.edgtf-drop-down .second .inner > ul > li.current-menu-ancestor > a',
			'.edgtf-drop-down .second .inner > ul > li.current-menu-item > a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_menu_item_hover_selector, $dropdown_menu_item_hover_styles );
		
		// main menu 2nd level wide style
		
		$dropdown_wide_menu_item_styles = aalto_edge_get_typography_styles( 'dropdown_wide' );
		
		$dropdown_wide_menu_item_selector = array(
			'.edgtf-drop-down .wide .second .inner > ul > li > a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_wide_menu_item_selector, $dropdown_wide_menu_item_styles );
		
		$dropdown_wide_hover_color = aalto_edge_options()->getOptionValue( 'dropdown_wide_hovercolor' );
		
		$dropdown_wide_menu_item_hover_styles = array();
		if ( ! empty( $dropdown_wide_hover_color ) ) {
			$dropdown_wide_menu_item_hover_styles['color'] = $dropdown_wide_hover_color . ' !important';
		}
		
		$dropdown_wide_menu_item_hover_selector = array(
			'.edgtf-drop-down .wide .second .inner > ul > li > a:hover',
			'.edgtf-drop-down .wide .second .inner > ul > li.current-menu-ancestor > a',
			'.edgtf-drop-down .wide .second .inner > ul > li.current-menu-item > a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_wide_menu_item_hover_selector, $dropdown_wide_menu_item_hover_styles );
		
		// main menu 3rd level style
		
		$dropdown_menu_item_styles_thirdlvl = aalto_edge_get_typography_styles( 'dropdown', '_thirdlvl' );
		
		$dropdown_menu_item_selector_thirdlvl = array(
			'.edgtf-drop-down .second .inner ul li ul li a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_menu_item_selector_thirdlvl, $dropdown_menu_item_styles_thirdlvl );
		
		$dropdown_hover_color_thirdlvl = aalto_edge_options()->getOptionValue( 'dropdown_hovercolor_thirdlvl' );
		
		$dropdown_menu_item_hover_styles_thirdlvl = array();
		if ( ! empty( $dropdown_hover_color_thirdlvl ) ) {
			$dropdown_menu_item_hover_styles_thirdlvl['color'] = $dropdown_hover_color_thirdlvl . ' !important';
		}
		
		$dropdown_menu_item_hover_selector_thirdlvl = array(
			'.edgtf-drop-down .second .inner ul li ul li a:hover',
			'.edgtf-drop-down .second .inner ul li ul li.current-menu-ancestor > a',
			'.edgtf-drop-down .second .inner ul li ul li.current-menu-item > a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_menu_item_hover_selector_thirdlvl, $dropdown_menu_item_hover_styles_thirdlvl );
		
		// main menu 3rd level wide style
		
		$dropdown_wide_menu_item_styles_thirdlvl = aalto_edge_get_typography_styles( 'dropdown_wide', '_thirdlvl' );
		
		$dropdown_wide_menu_item_selector_thirdlvl = array(
			'.edgtf-drop-down .wide .second .inner ul li ul li a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_wide_menu_item_selector_thirdlvl, $dropdown_wide_menu_item_styles_thirdlvl );
		
		$dropdown_wide_hover_color_thirdlvl = aalto_edge_options()->getOptionValue( 'dropdown_wide_hovercolor_thirdlvl' );
		
		$dropdown_wide_menu_item_hover_styles_thirdlvl = array();
		if ( ! empty( $dropdown_wide_hover_color_thirdlvl ) ) {
			$dropdown_wide_menu_item_hover_styles_thirdlvl['color'] = $dropdown_wide_hover_color_thirdlvl . ' !important';
		}
		
		$dropdown_wide_menu_item_hover_selector_thirdlvl = array(
			'.edgtf-drop-down .wide .second .inner ul li ul li a:hover',
			'.edgtf-drop-down .wide .second .inner ul li ul li.current-menu-ancestor > a',
			'.edgtf-drop-down .wide .second .inner ul li ul li.current-menu-item > a'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_wide_menu_item_hover_selector_thirdlvl, $dropdown_wide_menu_item_hover_styles_thirdlvl );
		
		// main menu dropdown holder style
		
		$dropdown_top_position = aalto_edge_options()->getOptionValue( 'dropdown_top_position' );
		
		$dropdown_styles = array();
		if ( $dropdown_top_position !== '' ) {
			$dropdown_styles['top'] = $dropdown_top_position . '%';
		}
		
		$dropdown_selector = array(
			'.edgtf-page-header .edgtf-drop-down .second'
		);
		
		echo aalto_edge_dynamic_css( $dropdown_selector, $dropdown_styles );

        $dropdown_background_color_selector = array(
            '.edgtf-drop-down .narrow .second .inner ul',
            '.edgtf-drop-down .wide .second .inner'
        );
        $dropdown_background_styles = array();

        $dropdown_background_color = aalto_edge_options()->getOptionValue( 'dropdown_background_color' );
        if ( $dropdown_background_color !== '' ) {
            $dropdown_background_transparency = aalto_edge_options()->getOptionValue( 'dropdown_background_transparency' );
            if ( $dropdown_background_transparency === '' ) {
                $dropdown_background_transparency = '1';
            }

            $dropdown_background_styles['background-color'] = aalto_edge_rgba_color( $dropdown_background_color, $dropdown_background_transparency );
        }

        echo aalto_edge_dynamic_css( $dropdown_background_color_selector, $dropdown_background_styles );
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_main_menu_styles' );
}