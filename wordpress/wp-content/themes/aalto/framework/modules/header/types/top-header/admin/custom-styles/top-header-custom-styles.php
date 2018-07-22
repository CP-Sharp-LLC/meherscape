<?php

if ( ! function_exists( 'aalto_edge_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function aalto_edge_header_top_bar_styles() {
		$top_header_height = aalto_edge_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo aalto_edge_dynamic_css( '.edgtf-top-bar', array( 'height' => aalto_edge_filter_px( $top_header_height ) . 'px' ) );
			echo aalto_edge_dynamic_css( '.edgtf-top-bar .edgtf-logo-wrapper a', array( 'max-height' => aalto_edge_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo aalto_edge_dynamic_css( '.edgtf-top-bar-background', array( 'height' => aalto_edge_get_top_bar_background_height() . 'px' ) );
		
		if ( aalto_edge_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.edgtf-top-bar .edgtf-grid .edgtf-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = aalto_edge_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = aalto_edge_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = aalto_edge_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo aalto_edge_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = aalto_edge_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = aalto_edge_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( aalto_edge_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = aalto_edge_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = aalto_edge_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo aalto_edge_dynamic_css( '.edgtf-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( aalto_edge_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo aalto_edge_dynamic_css( '.edgtf-top-bar', $top_bar_styles );
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_header_top_bar_styles' );
}