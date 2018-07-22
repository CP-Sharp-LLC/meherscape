<?php

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'aalto_edge_map_blog_meta' ) ) {
	function aalto_edge_map_blog_meta() {
		$edgtf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$edgtf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'aalto' ),
				'name'  => 'blog_meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'aalto' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'aalto' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgtf_blog_categories
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'aalto' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'aalto' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgtf_blog_categories,
				'args'        => array( "col_width" => 3 )
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'aalto' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'aalto' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'aalto' ),
					'in-grid'    => esc_html__( 'In Grid', 'aalto' ),
					'full-width' => esc_html__( 'Full Width', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'aalto' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'aalto' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''      => esc_html__( 'Default', 'aalto' ),
					'two'   => esc_html__( '2 Columns', 'aalto' ),
					'three' => esc_html__( '3 Columns', 'aalto' ),
					'four'  => esc_html__( '4 Columns', 'aalto' ),
					'five'  => esc_html__( '5 Columns', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'aalto' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'aalto' ),
				'options'     => aalto_edge_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'aalto' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'aalto' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'aalto' ),
					'fixed'    => esc_html__( 'Fixed', 'aalto' ),
					'original' => esc_html__( 'Original', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'aalto' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'aalto' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'aalto' ),
					'standard'        => esc_html__( 'Standard', 'aalto' ),
					'load-more'       => esc_html__( 'Load More', 'aalto' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'aalto' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'edgtf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'aalto' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'aalto' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_blog_meta', 30 );
}