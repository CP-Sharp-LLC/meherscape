<?php

if ( ! function_exists( 'aalto_edge_sidearea_options_map' ) ) {
	function aalto_edge_sidearea_options_map() {
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => esc_html__( 'Side Area', 'aalto' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$side_area_panel = aalto_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Side Area', 'aalto' ),
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);
		
		$side_area_icon_style_group = aalto_edge_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'side_area_icon_style_group',
				'title'       => esc_html__( 'Side Area Icon Style', 'aalto' ),
				'description' => esc_html__( 'Define styles for Side Area icon', 'aalto' )
			)
		);
		
		$side_area_icon_style_row1 = aalto_edge_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row1'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_color',
				'label'  => esc_html__( 'Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'aalto' )
			)
		);
		
		$side_area_icon_style_row2 = aalto_edge_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row2',
				'next'   => true
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_color',
				'label'  => esc_html__( 'Close Icon Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_hover_color',
				'label'  => esc_html__( 'Close Icon Hover Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => esc_html__( 'Side Area Width', 'aalto' ),
				'description'   => esc_html__( 'Enter a width for Side Area', 'aalto' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'color',
				'name'        => 'side_area_background_color',
				'label'       => esc_html__( 'Background Color', 'aalto' ),
				'description' => esc_html__( 'Choose a background color for Side Area', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'text',
				'name'        => 'side_area_padding',
				'label'       => esc_html__( 'Padding', 'aalto' ),
				'description' => esc_html__( 'Define padding for Side Area in format top right bottom left', 'aalto' ),
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'selectblank',
				'name'          => 'side_area_aligment',
				'default_value' => '',
				'label'         => esc_html__( 'Text Alignment', 'aalto' ),
				'description'   => esc_html__( 'Choose text alignment for side area', 'aalto' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'aalto' ),
					'left'   => esc_html__( 'Left', 'aalto' ),
					'center' => esc_html__( 'Center', 'aalto' ),
					'right'  => esc_html__( 'Right', 'aalto' )
				)
			)
		);
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_sidearea_options_map', 15 );
}