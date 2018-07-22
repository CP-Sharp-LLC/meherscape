<?php

if ( ! function_exists( 'edgtf_core_map_portfolio_settings_meta' ) ) {
	function edgtf_core_map_portfolio_settings_meta() {
		$meta_box = aalto_edge_add_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'edge-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		aalto_edge_add_meta_box_field( array(
			'name'        => 'edgtf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'edge-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'edge-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'edge-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'edge-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'edge-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'edge-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'edge-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'edge-core' ),
                'split-screen'      => esc_html__( 'Portfolio Split Screen','edge-core'),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'edge-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'edge-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'edge-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'edge-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'edge-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'edge-core' )
			),
			'args'        => array(
				'dependence' => true,
				'show'       => array(
					''                  => '',
					'huge-images'       => '',
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
                    'split-screen'      => '',
					'gallery'           => '#edgtf_edgtf_gallery_type_meta_container',
					'small-gallery'     => '#edgtf_edgtf_gallery_type_meta_container',
					'masonry'           => '#edgtf_edgtf_masonry_type_meta_container',
					'small-masonry'     => '#edgtf_edgtf_masonry_type_meta_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide'       => array(
					''                  => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'huge-images'       => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'images'            => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'small-images'      => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'slider'            => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'small-slider'      => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
                    'split-screen'      => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'gallery'           => '#edgtf_edgtf_masonry_type_meta_container',
					'small-gallery'     => '#edgtf_edgtf_masonry_type_meta_container',
					'masonry'           => '#edgtf_edgtf_gallery_type_meta_container',
					'small-masonry'     => '#edgtf_edgtf_gallery_type_meta_container',
					'custom'            => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container',
					'full-width-custom' => '#edgtf_edgtf_gallery_type_meta_container, #edgtf_edgtf_masonry_type_meta_container'
				)
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_gallery_type_meta_container',
				'hidden_property' => 'edgtf_portfolio_single_template_meta',
				'hidden_values'   => array(
					'huge-images',
					'images',
					'small-images',
					'slider',
					'small-slider',
                    'split-screen',
					'masonry',
					'small-masonry',
					'custom',
					'full-width-custom'
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'edge-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => array(
					''      => esc_html__( 'Default', 'edge-core' ),
					'two'   => esc_html__( '2 Columns', 'edge-core' ),
					'three' => esc_html__( '3 Columns', 'edge-core' ),
					'four'  => esc_html__( '4 Columns', 'edge-core' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'edge-core' ),
				'default_value' => '',
				'options'       => aalto_edge_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_masonry_type_meta_container',
				'hidden_property' => 'edgtf_portfolio_single_template_meta',
				'hidden_values'   => array(
					'huge-images',
					'images',
					'small-images',
					'slider',
					'small-slider',
                    'split-screen',
					'gallery',
					'small-gallery',
					'custom',
					'full-width-custom'
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'edge-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => array(
					''      => esc_html__( 'Default', 'edge-core' ),
					'two'   => esc_html__( '2 Columns', 'edge-core' ),
					'three' => esc_html__( '3 Columns', 'edge-core' ),
					'four'  => esc_html__( '4 Columns', 'edge-core' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'edge-core' ),
				'default_value' => '',
				'options'       => aalto_edge_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'edge-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'edge-core' ),
				'parent'        => $meta_box,
				'options'       => aalto_edge_get_yes_no_select_array()
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'edge-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'edge-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'edge-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'edge-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'edge-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'edge-core' ),
				'parent'      => $meta_box
			)
		);

		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_short_description',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Short Description', 'edge-core' ),
				'description' => esc_html__( 'Enter short description that is used for portfolio fullscreen slider', 'edge-core' ),
				'parent'      => $meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'edge-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'edge-core' ),
				'default_value' => 'default',
				'parent'        => $meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'edge-core' ),
					'large-width'        => esc_html__( 'Large Width', 'edge-core' ),
					'large-height'       => esc_html__( 'Large Height', 'edge-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'edge-core' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'edge-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'edge-core' ),
				'default_value' => 'default',
				'parent'        => $meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'edge-core' ),
					'large-width' => esc_html__( 'Large Width', 'edge-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'edge-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'edge-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'edgtf_core_map_portfolio_settings_meta', 41 );
}