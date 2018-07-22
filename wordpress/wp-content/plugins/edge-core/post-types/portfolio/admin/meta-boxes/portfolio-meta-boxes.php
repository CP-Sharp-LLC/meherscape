<?php

if ( ! function_exists( 'edgtf_core_map_portfolio_meta' ) ) {
	function edgtf_core_map_portfolio_meta() {
		global $aalto_edge_Framework;
		
		$edgtf_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$edgtf_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$edgtfPortfolioImages = new AaltoEdgeMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'edge-core' ), '', '', 'portfolio_images' );
		$aalto_edge_Framework->edgtfMetaBoxes->addMetaBox( 'portfolio_images', $edgtfPortfolioImages );
		
		$edgtf_portfolio_image_gallery = new AaltoEdgeMultipleImages( 'edgtf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'edge-core' ), esc_html__( 'Choose your portfolio images', 'edge-core' ) );
		$edgtfPortfolioImages->addChild( 'edgtf-portfolio-image-gallery', $edgtf_portfolio_image_gallery );
		
		//Portfolio Images/Videos 2
		
		$edgtfPortfolioImagesVideos2 = new AaltoEdgeMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images/Videos (single upload)', 'edge-core' ) );
		$aalto_edge_Framework->edgtfMetaBoxes->addMetaBox( 'portfolio_images_videos2', $edgtfPortfolioImagesVideos2 );
		
		$edgtf_portfolio_images_videos2 = new AaltoEdgeImagesVideosFramework( '', '' );
		$edgtfPortfolioImagesVideos2->addChild( 'edgtf_portfolio_images_videos2', $edgtf_portfolio_images_videos2 );
		
		//Portfolio Additional Sidebar Items
		
		$edgtfAdditionalSidebarItems = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'edge-core' ),
				'name'  => 'portfolio_properties'
			)
		);
		
		$edgtf_portfolio_properties = aalto_edge_add_options_framework(
			array(
				'label'  => esc_html__( 'Portfolio Properties', 'edge-core' ),
				'name'   => 'edgtf_portfolio_properties',
				'parent' => $edgtfAdditionalSidebarItems
			)
		);

        //Portfolio Second Featured Image

        $edgtSecondPortfolioFeaturedImage =  aalto_edge_add_meta_box(array(
            'scope' => array('portfolio-item'),
            'title' => esc_html__('Second Featured image','edge-core'),
            'name' => 'second-featured-image',
            'context' => 'side',
            'priority' => 'low',
        ));

        aalto_edge_add_meta_box_field(
            array(
                'name'        	=> 'portfolio_second_featured_image',
                'type'        	=> 'image',
                'label'       	=> '',
                'description' 	=> esc_html__('Only for Row and Scrollable Portfolio List Types','edge-core'),
                'parent'      	=> $edgtSecondPortfolioFeaturedImage,
            )
        );

     //Portfolio Third Featured Image

        $edgtThirdPortfolioFeaturedImage = aalto_edge_add_meta_box(array(
            'scope' => array('portfolio-item'),
            'title' => 'Third Featured image',
            'name' => 'third-featured-image',
            'context' => 'side',
            'priority' => 'low',
        ));

        aalto_edge_add_meta_box_field(
            array(
                'name'        	=> 'portfolio_third_featured_image',
                'type'        	=> 'image',
                'label'       	=> '',
                'description' 	=> esc_html__('Only for Row and Scrollable Portfolio List Types','edge-core'),
                'parent'      	=> $edgtThirdPortfolioFeaturedImage,
            )
        );
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'edgtf_core_map_portfolio_meta', 40 );
}