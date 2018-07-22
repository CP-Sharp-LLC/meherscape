<?php

/*** Post Settings ***/

if ( ! function_exists( 'aalto_edge_map_post_meta' ) ) {
	function aalto_edge_map_post_meta() {
		
		$post_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'aalto' ),
				'name'  => 'post-meta'
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'aalto' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'aalto' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => aalto_edge_get_custom_sidebars_options( true )
			)
		);
		
		$aalto_custom_sidebars = aalto_edge_get_custom_sidebars();
		if ( count( $aalto_custom_sidebars ) > 0 ) {
			aalto_edge_add_meta_box_field( array(
				'name'        => 'edgtf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'aalto' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'aalto' ),
				'parent'      => $post_meta_box,
				'options'     => aalto_edge_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'aalto' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'aalto' ),
				'parent'      => $post_meta_box
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'aalto' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'aalto' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'aalto' ),
					'large-width'        => esc_html__( 'Large Width', 'aalto' ),
					'large-height'       => esc_html__( 'Large Height', 'aalto' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'aalto' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'aalto' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'aalto' ),
					'large-width' => esc_html__( 'Large Width', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'aalto' ),
				'parent'        => $post_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array()
			)
		);

		do_action('aalto_edge_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_post_meta', 20 );
}
