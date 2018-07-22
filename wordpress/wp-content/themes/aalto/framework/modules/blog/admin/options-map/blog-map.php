<?php

if ( ! function_exists( 'aalto_edge_get_blog_list_types_options' ) ) {
	function aalto_edge_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'aalto_edge_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'aalto_edge_blog_options_map' ) ) {
	function aalto_edge_blog_options_map() {
		$blog_list_type_options = aalto_edge_get_blog_list_types_options();
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'aalto' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = aalto_edge_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'aalto' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'aalto' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'aalto' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'aalto' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => aalto_edge_get_custom_sidebars_options(),
			)
		);
		
		$aalto_custom_sidebars = aalto_edge_get_custom_sidebars();
		if ( count( $aalto_custom_sidebars ) > 0 ) {
			aalto_edge_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'aalto' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'aalto' ),
					'parent'      => $panel_blog_lists,
					'options'     => aalto_edge_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'aalto' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'aalto' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'aalto' ),
					'full-width' => esc_html__( 'Full Width', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'aalto' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'aalto' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'aalto' ),
					'three' => esc_html__( '3 Columns', 'aalto' ),
					'four'  => esc_html__( '4 Columns', 'aalto' ),
					'five'  => esc_html__( '5 Columns', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'aalto' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'aalto' ),
				'default_value' => 'normal',
				'options'       => aalto_edge_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'aalto' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'aalto' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'aalto' ),
					'original' => esc_html__( 'Original', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'aalto' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'aalto' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'aalto' ),
					'load-more'       => esc_html__( 'Load More', 'aalto' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'aalto' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'aalto' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'aalto' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = aalto_edge_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'aalto' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'aalto' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => aalto_edge_get_custom_sidebars_options()
			)
		);
		
		if ( count( $aalto_custom_sidebars ) > 0 ) {
			aalto_edge_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'aalto' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'aalto' ),
					'parent'      => $panel_blog_single,
					'options'     => aalto_edge_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'aalto' ),
				'parent'        => $panel_blog_single,
				'options'       => aalto_edge_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'aalto' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'no'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'aalto' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'aalto' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'aalto' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'aalto' ),
				'parent'        => $panel_blog_single,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_blog_single_navigation_container'
				)
			)
		);
		
		$blog_single_navigation_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'edgtf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_single,
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'aalto' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'aalto' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages', 'aalto' ),
				'parent'        => $panel_blog_single,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_blog_single_author_info_container'
				)
			)
		);
		
		$blog_single_author_info_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'edgtf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_single,
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'aalto' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'aalto' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'aalto_edge_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_blog_options_map', 13 );
}