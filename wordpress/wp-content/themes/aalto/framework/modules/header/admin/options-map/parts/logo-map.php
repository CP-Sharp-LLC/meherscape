<?php

if ( ! function_exists( 'aalto_edge_logo_options_map' ) ) {
	function aalto_edge_logo_options_map() {
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'aalto' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = aalto_edge_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'aalto' ),
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#edgtf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);
		
		$hide_logo_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value'    => 'yes'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'aalto' ),
				'parent'        => $hide_logo_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'aalto' ),
				'parent'        => $hide_logo_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'aalto' ),
				'parent'        => $hide_logo_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'aalto' ),
				'parent'        => $hide_logo_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'aalto' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_logo_options_map', 2 );
}