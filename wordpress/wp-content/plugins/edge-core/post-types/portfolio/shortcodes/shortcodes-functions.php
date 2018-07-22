<?php

if ( ! function_exists( 'edgtf_core_enqueue_scripts_for_portfolio_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function edgtf_core_enqueue_scripts_for_portfolio_shortcodes() {
		wp_enqueue_script( 'swiper', EDGE_CORE_CPT_URL_PATH . '/portfolio/assets/js/plugins/swiper.min.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'aalto_edge_enqueue_third_party_scripts', 'edgtf_core_enqueue_scripts_for_portfolio_shortcodes' );
}

if ( ! function_exists( 'edgtf_core_include_portfolio_shortcodes' ) ) {
	function edgtf_core_include_portfolio_shortcodes() {
		include_once EDGE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list.php';
		include_once EDGE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-project-info.php';
		include_once EDGE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-slider.php';
		include_once EDGE_CORE_CPT_PATH . '/portfolio/shortcodes/fullscreen-portfolio-grid.php';
		include_once EDGE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-fullscreen-slider.php';
		include_once EDGE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-section.php';
	}
	
	add_action( 'edgtf_core_action_include_shortcodes_file', 'edgtf_core_include_portfolio_shortcodes' );
}

if ( ! function_exists( 'edgtf_core_add_portfolio_shortcodes' ) ) {
	function edgtf_core_add_portfolio_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioList',
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioProjectInfo',
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioSlider',
			'EdgeCore\CPT\Shortcodes\Portfolio\FullscreenPortfolioGrid',
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioFullscreenSlider',
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioSection'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'edgtf_core_filter_add_vc_shortcode', 'edgtf_core_add_portfolio_shortcodes' );
}

if ( ! function_exists( 'edgtf_core_set_portfolio_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio list shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function edgtf_core_set_portfolio_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio';
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-project-info';
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-slider';
		$shortcodes_icon_class_array[] = '.icon-wpb-fullscreen-portfolio-grid';
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-fullscreen-slider';
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-section';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'edgtf_core_filter_add_vc_shortcodes_custom_icon_class', 'edgtf_core_set_portfolio_list_icon_class_name_for_vc_shortcodes' );
}