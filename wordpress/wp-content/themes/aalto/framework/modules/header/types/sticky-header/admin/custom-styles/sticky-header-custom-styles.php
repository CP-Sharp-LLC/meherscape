<?php

if ( ! function_exists( 'aalto_edge_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function aalto_edge_sticky_header_styles() {
		$background_color        = aalto_edge_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = aalto_edge_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = aalto_edge_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = aalto_edge_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array( 'background-color' => aalto_edge_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = aalto_edge_filter_px( $header_height ) . 'px';
			
			echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header', array( 'height' => $height ) );
			echo aalto_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		// sticky menu style
		
		$menu_item_styles = aalto_edge_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li > a'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = aalto_edge_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li:hover > a',
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li.edgtf-active-item > a'
		);
		
		echo aalto_edge_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_sticky_header_styles' );
}