<?php

namespace EdgeCore\CPT\Shortcodes\ProductList;

use EdgeCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_product_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Product List', 'aalto' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list extended-custom-icon',
					'category'                  => esc_html__( 'by EDGE', 'aalto' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'aalto' ),
							'value'       => array(
								esc_html__( 'Standard', 'aalto' ) => 'standard',
								esc_html__( 'Masonry', 'aalto' )  => 'masonry'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Product Info Position', 'aalto' ),
							'value'       => array(
								esc_html__( 'Info On Image Hover', 'aalto' ) => 'info-on-image',
								esc_html__( 'Info Below Image', 'aalto' )    => 'info-below-image'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'aalto' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'aalto' ),
							'value'       => array(
								esc_html__( 'One', 'aalto' )   => '1',
								esc_html__( 'Two', 'aalto' )   => '2',
								esc_html__( 'Three', 'aalto' ) => '3',
								esc_html__( 'Four', 'aalto' )  => '4',
								esc_html__( 'Five', 'aalto' )  => '5',
								esc_html__( 'Six', 'aalto' )   => '6'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'aalto' ),
							'value'       => array_flip( aalto_edge_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'show_category_filter',
							'heading'     => esc_html__('Show Category Filter', 'aalto'),
							'value'       => array_flip( aalto_edge_get_yes_no_select_array(false, false)),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'category_values',
							'heading'     => esc_html__('Enter Category Values', 'aalto'),
							'description' => esc_html__('Separate values (category slugs) with a comma', 'aalto'),
							'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'show_all_item_in_filter',
							'heading'     => esc_html__('Show "All" Item in Filter', 'aalto'),
							'value'       => array_flip(aalto_edge_get_yes_no_select_array(false, true)),
							'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'aalto' ),
							'value'       => array_flip( aalto_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'aalto' ),
							'value'       => array_flip( aalto_edge_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'taxonomy_to_display',
							'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'aalto' ),
							'value'       => array(
								esc_html__( 'Category', 'aalto' ) => 'category',
								esc_html__( 'Tag', 'aalto' )      => 'tag',
								esc_html__( 'Id', 'aalto' )       => 'id'
							),
							'save_always' => true,
							'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'aalto' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'taxonomy_values',
							'heading'     => esc_html__( 'Enter Taxonomy Values', 'aalto' ),
							'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'aalto' ),
							'value'      => array(
								esc_html__( 'Default', 'aalto' )        => '',
								esc_html__( 'Original', 'aalto' )       => 'full',
								esc_html__( 'Square', 'aalto' )         => 'square',
								esc_html__( 'Landscape', 'aalto' )      => 'landscape',
								esc_html__( 'Portrait', 'aalto' )       => 'portrait',
								esc_html__( 'Medium', 'aalto' )         => 'medium',
								esc_html__( 'Large', 'aalto' )          => 'large',
								esc_html__( 'Shop Catalog', 'aalto' )   => 'shop_catalog',
								esc_html__( 'Shop Single', 'aalto' )    => 'shop_single',
								esc_html__( 'Shop Thumbnail', 'aalto' ) => 'shop_thumbnail'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_title',
							'heading'    => esc_html__( 'Display Title', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'aalto' ),
							'value'      => array(
								esc_html__( 'Default', 'aalto' ) => 'default',
								esc_html__( 'Light', 'aalto' )   => 'light',
								esc_html__( 'Dark', 'aalto' )    => 'dark'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_category',
							'heading'    => esc_html__( 'Display Category', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'group'      => esc_html__( 'Product Info', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'aalto' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'aalto' ),
							'description' => esc_html__( 'Number of characters', 'aalto' ),
							'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_rating',
							'heading'    => esc_html__( 'Display Rating', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_button',
							'heading'    => esc_html__( 'Display Button', 'aalto' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'aalto' ),
							'value'      => array(
								esc_html__( 'Default', 'aalto' ) => 'default',
								esc_html__( 'Light', 'aalto' )   => 'light',
								esc_html__( 'Dark', 'aalto' )    => 'dark'
							),
							'dependency' => array( 'element' => 'display_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'aalto' ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'info_bottom_text_align',
							'heading'    => esc_html__( 'Product Info Text Alignment', 'aalto' ),
							'value'      => array(
								esc_html__( 'Default', 'aalto' ) => '',
								esc_html__( 'Left', 'aalto' )    => 'left',
								esc_html__( 'Center', 'aalto' )  => 'center',
								esc_html__( 'Right', 'aalto' )   => 'right'
							),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'aalto' ),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'aalto' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                    => 'standard',
			'info_position'           => 'info-below-image',
			'number_of_posts'         => '8',
			'number_of_columns'       => '4',
			'space_between_items'     => 'normal',
			'orderby'                 => 'date',
			'order'                   => 'ASC',
			'taxonomy_to_display'     => 'category',
			'taxonomy_values'         => '',
			'image_size'              => 'full',
			'display_title'           => 'yes',
			'product_info_skin'       => '',
			'title_tag'               => 'h4',
			'title_transform'         => '',
			'display_category'        => 'yes',
			'display_excerpt'         => 'no',
			'excerpt_length'          => '20',
			'display_rating'          => 'no',
			'display_price'           => 'yes',
			'display_button'          => 'yes',
			'button_skin'             => 'default',
			'shader_background_color' => '',
			'info_bottom_text_align'  => '',
			'info_bottom_margin'      => '',
			'show_category_filter'    => 'no',
			'category_values' 	  	  => '',
			'show_all_item_in_filter' => 'yes'
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['class_name']     = 'pli';
		$params['type']           = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['info_position']  = ! empty( $params['info_position'] ) ? $params['info_position'] : $default_atts['info_position'];
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['categories_filter_list'] = $this->getProductCategoriesList($params);
		$params['holder_data'] 			  = $this->getHolderData($params);

		$params['category'] = ''; //used for ajax calling in category filter
		$params['meta_key'] = ''; //used for ajax calling in category filter
		
		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		
		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;
		
		$params['this_object'] = $this;
		
		$html = aalto_edge_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list', $params['type'], $params, $additional_params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-' . $params['type'] . '-layout' : 'edgtf-' . $default_atts['type'] . '-layout';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'edgtf-' . $params['space_between_items'] . '-space' : 'edgtf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = $this->getColumnNumberClass( $params );
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'edgtf-' . $params['info_position'] : 'edgtf-' . $default_atts['info_position'];
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'edgtf-product-info-' . $params['product_info_skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getColumnNumberClass( $params ) {
		$columnsNumber = '';
		$columns       = $params['number_of_columns'];
		
		switch ( $columns ) {
			case 1:
				$columnsNumber = 'edgtf-one-column';
				break;
			case 2:
				$columnsNumber = 'edgtf-two-columns';
				break;
			case 3:
				$columnsNumber = 'edgtf-three-columns';
				break;
			case 4:
				$columnsNumber = 'edgtf-four-columns';
				break;
			case 5:
				$columnsNumber = 'edgtf-five-columns';
				break;
			case 6:
				$columnsNumber = 'edgtf-six-columns';
				break;
			default:
				$columnsNumber = 'edgtf-four-columns';
				break;
		}
		
		return $columnsNumber;
	}
	
	public function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' && $params['show_category_filter'] == 'no') {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' && $params['show_category_filter'] == 'no') {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' && $params['show_category_filter'] == 'no') {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['post__in'] = $ids;
		}

		//used for ajax calling in category filter
		if($params['show_category_filter'] == 'yes'){
			if($params['category_values'] !== '' && $params['category'] == '') {
				$queryArray['product_cat'] = $params['category_values'];
			}else {
				$queryArray['product_cat'] = $params['category'];
			}
		}
		
		return $queryArray;
	}
	
	public function getItemClasses( $params ) {
		$itemClasses = array();
		
		$image_size_meta = get_post_meta( get_the_ID(), 'edgtf_product_featured_image_size', true );
		if ( ! empty( $image_size_meta ) ) {
			$itemClasses[] = $image_size_meta;
		}
		
		return implode( ' ', $itemClasses );
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getShaderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getTextWrapperStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}
		
		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . aalto_edge_filter_px( $params['info_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	/**
	 * Return product categories
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductCategoriesList($params) {
		$category_html = '';

		if($params['show_category_filter'] == 'yes') {
			$taxonomy = 'product_cat';
			$orderby = 'name';
			$show_count = 0;      // 1 for yes, 0 for no
			$pad_counts = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no
			$title = '';
			$empty = 0;
			$parent = 0;

			$args = array(
				'taxonomy' => $taxonomy,
				'orderby' => $orderby,
				'show_count' => $show_count,
				'pad_counts' => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li' => $title,
				'hide_empty' => $empty,
				'parent' => $parent
			);

			$all_categories_string = '';
			if($params['category_values'] == ''){

				$all_categories = get_categories($args);

			}else{
				$all_categories = array();
				$categories = explode(',',$params['category_values']);
				foreach ($categories as $cat){
					$all_categories[] = get_term_by( 'slug', $cat, 'product_cat' );
					$all_categories_string .= $cat.',';
				}
			}

			if($params['show_all_item_in_filter'] == 'yes') {
				$category_html .= '<li><a class="edgtf-no-smooth-transitions active" data-category="' . $all_categories_string . '" href="#">' . esc_html__('All', 'aalto') . '</a></li>';
			}
			foreach ($all_categories as $cat) {
				$category_html .= '<li><a class="edgtf-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';

				$termchildren = get_term_children( $cat->term_id, 'product_cat' );

				if(!empty($termchildren)){
					foreach ( $termchildren as $child ) {
						$cat = get_term_by( 'id', $child, 'product_cat' );
						$category_html .= '<li><a class="edgtf-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($child, 'product_cat') . '">' . $cat->name . '</a></li>';
					}
				}
			}
		}

		return $category_html;
	}

	/**
	 * Generates data attributes array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderData($params){
		$dataString = '';
		unset($params['categories_filter_list'], $params['ordering_filter_list'], $params['pricing_filter_list'] );
		foreach ($params as $key => $value) {
			if($value !== '') {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-'.$new_key.'="'.esc_attr($value).'"';
			}
		}

		return $dataString;
	}
}