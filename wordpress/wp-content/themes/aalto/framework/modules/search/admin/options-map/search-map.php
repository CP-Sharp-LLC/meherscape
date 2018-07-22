<?php

if ( ! function_exists( 'aalto_edge_get_search_types_options' ) ) {
    function aalto_edge_get_search_types_options() {
        $search_type_options = apply_filters( 'aalto_edge_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'aalto_edge_search_options_map' ) ) {
	function aalto_edge_search_options_map() {
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'aalto' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = aalto_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'aalto' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		aalto_edge_add_admin_field( array(
			'name'          => 'search_page_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Layout', 'aalto' ),
			'default_value' => 'in-grid',
			'description'   => esc_html__( 'Set layout. Default is in grid.', 'aalto' ),
			'parent'        => $search_page_panel,
			'options'       => array(
				'in-grid'    => esc_html__( 'In Grid', 'aalto' ),
				'full-width' => esc_html__( 'Full Width', 'aalto' )
			)
		) );
		
		aalto_edge_add_admin_field( array(
			'name'          => 'search_page_sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'aalto' ),
			'description'   => esc_html__( "Choose a sidebar layout for search page", 'aalto' ),
			'default_value' => 'no-sidebar',
			'options'       => aalto_edge_get_custom_sidebars_options(),
			'parent'        => $search_page_panel
		) );
		
		$aalto_custom_sidebars = aalto_edge_get_custom_sidebars();
		if ( count( $aalto_custom_sidebars ) > 0 ) {
			aalto_edge_add_admin_field( array(
				'name'        => 'search_custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'aalto' ),
				'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'aalto' ),
				'parent'      => $search_page_panel,
				'options'     => $aalto_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
		
		$search_panel = aalto_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'aalto' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'aalto' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'aalto' ),
				'options'       => aalto_edge_get_search_types_options()
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'linear_icons',
				'label'         => esc_html__( 'Search Icon Pack', 'aalto' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'aalto' ),
				'options'       => aalto_edge_icon_collections()->getIconCollectionsExclude( array( 'linea_icons' ) )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'aalto' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'aalto' ),
			)
		);
		
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'aalto' ),
				'description'   => esc_html__( 'Set size for icon', 'aalto' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = aalto_edge_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'aalto' ),
				'description' => esc_html__( 'Define color style for icon', 'aalto' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = aalto_edge_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'aalto' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);
		
		$enable_search_icon_text_group = aalto_edge_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'aalto' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'aalto' )
			)
		);
		
		$enable_search_icon_text_row = aalto_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'aalto' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'aalto' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = aalto_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'aalto' ),
				'default_value' => '',
				'options'       => aalto_edge_get_text_transform_array()
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'aalto' ),
				'default_value' => '-1',
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'aalto' ),
				'default_value' => '',
				'options'       => aalto_edge_get_font_style_array(),
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'aalto' ),
				'default_value' => '',
				'options'       => aalto_edge_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = aalto_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'aalto' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_search_options_map', 16 );
}