<?php

if ( ! function_exists( 'aalto_edge_search_opener_icon_size' ) ) {
	function aalto_edge_search_opener_icon_size() {
		$icon_size = aalto_edge_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo aalto_edge_dynamic_css( '.edgtf-search-opener', array(
				'font-size' => aalto_edge_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_search_opener_icon_size' );
}

if ( ! function_exists( 'aalto_edge_search_opener_icon_colors' ) ) {
	function aalto_edge_search_opener_icon_colors() {
		$icon_color       = aalto_edge_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = aalto_edge_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo aalto_edge_dynamic_css( '.edgtf-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo aalto_edge_dynamic_css( '.edgtf-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_search_opener_icon_colors' );
}

if ( ! function_exists( 'aalto_edge_search_opener_text_styles' ) ) {
	function aalto_edge_search_opener_text_styles() {
		$item_styles = aalto_edge_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.edgtf-search-icon-text'
		);
		
		echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = aalto_edge_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo aalto_edge_dynamic_css( '.edgtf-search-opener:hover .edgtf-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_search_opener_text_styles' );
}