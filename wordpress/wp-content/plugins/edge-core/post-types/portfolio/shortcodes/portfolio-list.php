<?php

namespace EdgeCore\CPT\Shortcodes\Portfolio;

use EdgeCore\Lib;

class PortfolioList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_portfolio_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Portfolio category filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_list_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio category render
		add_filter( 'vc_autocomplete_edgtf_portfolio_list_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_list_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_edgtf_portfolio_list_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
		
		//Portfolio tag filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_list_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio tag render
		add_filter( 'vc_autocomplete_edgtf_portfolio_list_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Edge Portfolio List', 'edge-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'     => 'icon-wpb-portfolio extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Portfolio List Template', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Gallery', 'edge-core' ) => 'gallery',
								esc_html__( 'Masonry', 'edge-core' ) => 'masonry',
                                esc_html__('Scrollable List', 'edge-core') => 'scrollable'
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_type',
							'heading'    => esc_html__( 'Click Behavior', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Open portfolio single page on click', 'edge-core' )   => '',
								esc_html__( 'Open gallery in Pretty Photo on click', 'edge-core' ) => 'gallery',
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-core' ) => '',
								esc_html__( 'One', 'edge-core' )     => '1',
								esc_html__( 'Two', 'edge-core' )     => '2',
								esc_html__( 'Three', 'edge-core' )   => '3',
								esc_html__( 'Four', 'edge-core' )    => '4',
								esc_html__( 'Five', 'edge-core' )    => '5'
							),
							'description' => esc_html__( 'Default value is Three', 'edge-core' ),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Portfolios Per Page', 'edge-core' ),
							'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'edge-core' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Original', 'edge-core' )  => 'full',
								esc_html__( 'Square', 'edge-core' )    => 'square',
								esc_html__( 'Landscape', 'edge-core' ) => 'landscape',
								esc_html__( 'Portrait', 'edge-core' )  => 'portrait',
								esc_html__( 'Medium', 'edge-core' )    => 'medium',
								esc_html__( 'Large', 'edge-core' )     => 'large'
							),
							'description' => esc_html__( 'Set image proportions for your portfolio list.', 'edge-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery', 'scrollable' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_fixed_proportions',
							'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Set predefined image proportions for your masonry portfolio list. This option will apply image proportions you set in Portfolio Single page - dimensions for masonry option.', 'edge-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Portfolio List', 'edge-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'edge-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'edge-core' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'edge-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Portfolio List', 'edge-core' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_style',
							'heading'    => esc_html__( 'Item Style', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Standard - Shader', 'edge-core' )                 => 'standard-shader',
								esc_html__( 'Standard - Switch Featured Images', 'edge-core' ) => 'standard-switch-images',
								esc_html__( 'Gallery - Simple Shader', 'edge-core' )           => 'gallery-simple-shader',
								esc_html__( 'Gallery - Shader with Info', 'edge-core' )        => 'gallery-shader-info',
								esc_html__( 'Gallery - Info Box Center', 'edge-core' )			=> 'gallery-info-center',
								esc_html__( 'Gallery - Info Box Bottom', 'edge-core' )			=> 'gallery-info-bottom'
							),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_skin',
							'heading'    => esc_html__( 'Item Skin', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Dark', 'edge-core' )  => 'dark',
								esc_html__( 'Light', 'edge-core' ) => 'light'
							),
							'dependency' => array('element' => 'item_style', 'value' => array('standard-shader','gallery-simple-shader','gallery-shader-info','gallery-info-center','gallery-info-bottom')),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_title',
							'heading'    => esc_html__( 'Enable Title', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_text_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_category',
							'heading'    => esc_html__( 'Enable Category', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_count_images',
							'heading'    => esc_html__( 'Enable Number of Images', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
							'dependency' => array( 'element' => 'item_type', 'value' => array( 'gallery' ) ),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_excerpt',
							'heading'    => esc_html__( 'Enable Excerpt', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Content Layout', 'edge-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'edge-core' ),
							'description' => esc_html__( 'Number of characters', 'edge-core' ),
							'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Content Layout', 'edge-core' )
						),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Additional Data','edge-core'),
                            'param_name' => 'additional_data',
                            'value' => array(
                                esc_html__( 'Show Year', 'edge-core' ) => 'year',
                                esc_html__( 'Show Type', 'edge-core' ) => 'type',
                            ),
                            'description' => '',
                            'group' => esc_html__( 'Content Layout', 'edge-core' ),
                            'dependency' => array('element' => 'type', 'value' => array('scrollable'))
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Show 3 Featured Images','edge-core'),
                            'param_name' => 'three_images',
                            'value' => array(
                                esc_html__('Yes','edge-core' ) => 'yes',
                                esc_html__('No','edge-core' ) => 'no',
                            ),
                            'admin_label' => true,
                            'description' => '',
                            'group' => esc_html__('Query and Layout Options','edge-core' ),
                            'dependency' => array('element' => 'type', 'value' => array('scrollable'))
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'pagination_type',
							'heading'    => esc_html__( 'Pagination Type', 'edge-core' ),
							'value'      => array(
								esc_html__( 'None', 'edge-core' )            => 'no-pagination',
								esc_html__( 'Standard', 'edge-core' )        => 'standard',
								esc_html__( 'Load More', 'edge-core' )       => 'load-more',
								esc_html__( 'Infinite Scroll', 'edge-core' ) => 'infinite-scroll'
							),
							'group'      => esc_html__( 'Additional Features', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'load_more_top_margin',
							'heading'    => esc_html__( 'Load More Top Margin (px or %)', 'edge-core' ),
							'dependency' => array( 'element' => 'pagination_type', 'value' => array( 'load-more' ) ),
							'group'      => esc_html__( 'Additional Features', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter',
							'heading'    => esc_html__( 'Enable Category Filter', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Additional Features', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter_order_by',
							'heading'    => esc_html__( 'Filter Order By', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Name', 'edge-core' )  => 'name',
								esc_html__( 'Count', 'edge-core' ) => 'count',
								esc_html__( 'Id', 'edge-core' )    => 'id',
								esc_html__( 'Slug', 'edge-core' )  => 'slug'
							),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter_text_transform',
							'heading'    => esc_html__( 'Filter Text Transform', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'filter_bottom_margin',
							'heading'    => esc_html__( 'Filter Bottom Margin (px or %)', 'edge-core' ),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_article_animation',
							'heading'     => esc_html__( 'Enable Article Animation', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Enabling this option you will enable appears animation for your portfolio list items', 'edge-core' ),
							'group'       => esc_html__( 'Additional Features', 'edge-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'                     => 'gallery',
			'item_type'                => '',
			'number_of_columns'        => '3',
			'space_between_items'      => 'normal',
			'number_of_items'          => '-1',
			'image_proportions'        => 'full',
			'enable_fixed_proportions' => 'no',
			'enable_image_shadow'      => 'no',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'item_style'               => 'standard-shader',
			'item_skin'                => 'dark',
			'enable_title'             => 'yes',
			'title_tag'                => 'h4',
			'title_text_transform'     => '',
			'enable_category'          => 'yes',
			'enable_count_images'      => 'yes',
			'enable_excerpt'           => 'no',
			'excerpt_length'           => '20',
            'additional_data'          => 'year',
            'three_images'             => 'yes',
			'pagination_type'          => 'no-pagination',
			'load_more_top_margin'     => '',
			'filter'                   => 'no',
			'filter_order_by'          => 'name',
			'filter_text_transform'    => '',
			'filter_bottom_margin'     => '',
			'enable_article_animation' => 'no',
			'portfolio_slider_on'      => 'no',
			'enable_loop'              => 'yes',
			'enable_autoplay'          => 'yes',
			'slider_speed'             => '5000',
			'slider_speed_animation'   => '600',
			'enable_navigation'        => 'yes',
            'out_navigation'           => 'yes',
			'navigation_skin'          => '',
			'enable_pagination'        => 'yes',
			'pagination_skin'          => '',
			'pagination_position'      => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;
		
		$additional_params['holder_data']          = $this->getHolderData( $params, $additional_params );
		$additional_params['holder_classes']       = $this->getHolderClasses( $params, $args );
		$additional_params['holder_inner_classes'] = $this->getHolderInnerClasses( $params );
		
		$params['this_object'] = $this;
		
		$html = edgtf_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-holder', $params['type'], $params, $additional_params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['portfolio-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	public function getHolderData( $params, $additional_params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_results           = $additional_params['query_results'];
		$params['max_num_pages'] = $query_results->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next_page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( $value );
			}
		}
		
		return $dataString;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['type'] ) ? 'edgtf-pl-' . $params['type'] : 'edgtf-pl-' . $args['type'];
		$classes[] = ! empty( $params['space_between_items'] ) ? 'edgtf-' . $params['space_between_items'] . '-space' : 'edgtf-' . $args['space_between_items'] . '-space';
		
		$number_of_columns = $params['number_of_columns'];
		switch ( $number_of_columns ):
			case '1':
				$classes[] = 'edgtf-pl-one-column';
				break;
			case '2':
				$classes[] = 'edgtf-pl-two-columns';
				break;
			case '3':
				$classes[] = 'edgtf-pl-three-columns';
				break;
			case '4':
				$classes[] = 'edgtf-pl-four-columns';
				break;
			case '5':
				$classes[] = 'edgtf-pl-five-columns';
				break;
			default:
				$classes[] = 'edgtf-pl-three-columns';
				break;
		endswitch;
		
		$classes[] = ! empty( $params['item_style'] ) ? 'edgtf-pl-' . $params['item_style'] : '';
		$classes[] = ! empty( $params['item_skin'] ) ? 'edgtf-pl-skin-' . $params['item_skin'] : '';
		$classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'edgtf-pl-images-fixed' : '';
		$classes[] = $params['enable_image_shadow'] === 'yes' ? 'edgtf-pl-has-shadow' : '';
		$classes[] = $params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no' ? 'edgtf-pl-no-content' : '';
		$classes[] = ! empty( $params['pagination_type'] ) ? 'edgtf-pl-pag-' . $params['pagination_type'] : '';
		$classes[] = $params['filter'] === 'yes' ? 'edgtf-pl-has-filter' : '';
		$classes[] = $params['enable_article_animation'] === 'yes' ? 'edgtf-pl-has-animation' : '';
		$classes[] = ! empty( $params['navigation_skin'] ) ? 'edgtf-nav-' . $params['navigation_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_skin'] ) ? 'edgtf-pag-' . $params['pagination_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_position'] ) ? 'edgtf-pag-' . $params['pagination_position'] : '';
        $classes[] = $params['three_images'] === 'yes' ? 'edgtf-three-images-scrollable' : '';
		
		return implode( ' ', $classes );
	}
	
	public function getHolderInnerClasses( $params ) {
		$classes = array();
		
		$classes[] = $params['portfolio_slider_on'] === 'yes' ? 'edgtf-owl-slider edgtf-pl-is-slider' : '';

        if($params['portfolio_slider_on'] === 'yes') {
            if($params['enable_navigation'] === 'yes') {
                if($params['out_navigation'] === 'yes') {
                    $classes[] = 'edgtf-pl-slider-nav-out';
                }
            }
        }
		
		return implode( ' ', $classes );
	}
	
	public function getArticleClasses( $params ) {
		$classes = array();
		
		$type       = $params['type'];
		$item_style = $params['item_style'];
		
		if ( get_post_meta( get_the_ID(), "edgtf_portfolio_featured_image_meta", true ) !== "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'edgtf-pl-has-switch-image';
		} elseif ( get_post_meta( get_the_ID(), "edgtf_portfolio_featured_image_meta", true ) === "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'edgtf-pl-no-switch-image';
		}
		
		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
		$masonry_size     = get_post_meta( get_the_ID(), 'edgtf_portfolio_masonry_' . $image_proportion . '_dimensions_meta', true );
		
		$classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'edgtf-pl-masonry-' . esc_attr( $masonry_size ) : '';
		
		$article_classes = get_post_class( $classes );
		
		return implode( ' ', $article_classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) && $params['type'] == 'gallery' ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'aalto_edge_landscape';
					break;
				case 'portrait':
					$thumb_size = 'aalto_edge_portrait';
					break;
				case 'square':
					$thumb_size = 'aalto_edge_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		if ( $params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes' ) {
			$fixed_image_size = get_post_meta( get_the_ID(), 'edgtf_portfolio_masonry_fixed_dimensions_meta', true );
			
			switch ( $fixed_image_size ) {
				case 'default' :
					$thumb_size = 'aalto_edge_square';
					break;
				case 'large-width':
					$thumb_size = 'aalto_edge_landscape';
					break;
				case 'large-height':
					$thumb_size = 'aalto_edge_portrait';
					break;
				case 'large-width-height':
					$thumb_size = 'aalto_edge_huge';
					break;
				default :
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getSwitchFeaturedImage() {
		$featured_image_meta = get_post_meta( get_the_ID(), 'edgtf_portfolio_featured_image_meta', true );
		
		$featured_image = ! empty( $featured_image_meta ) ? esc_url( $featured_image_meta ) : '';
		
		return $featured_image;
	}
	
	public function getLoadMoreStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['load_more_top_margin'] ) ) {
			$margin = $params['load_more_top_margin'];
			
			if ( aalto_edge_string_ends_with( $margin, '%' ) || aalto_edge_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin;
			} else {
				$styles[] = 'margin-top: ' . aalto_edge_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterCategories( $params ) {
		$cat_id = 0;
		
		if ( ! empty( $params['category'] ) ) {
			$top_category = get_term_by( 'slug', $params['category'], 'portfolio-category' );
			
			if ( isset( $top_category->term_id ) ) {
				$cat_id = $top_category->term_id;
			}
		}
		
		$order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';
		
		$args = array(
			'taxonomy' => 'portfolio-category',
			'child_of' => $cat_id,
			'orderby'  => $params['filter_order_by'],
			'order'    => $order
		);
		
		$filter_categories = get_terms( $args );
		
		return $filter_categories;
	}
	
	public function getFilterHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_bottom_margin'] ) ) {
			$margin = $params['filter_bottom_margin'];
			
			if ( aalto_edge_string_ends_with( $margin, '%' ) || aalto_edge_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin;
			} else {
				$styles[] = 'margin-bottom: ' . aalto_edge_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['filter_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getItemLink() {
		$portfolio_link_meta = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( get_the_ID() );
		
		return apply_filters( 'aalto_edge_portfolio_external_link', $portfolio_link );
	}
	
	public function getItemLinkTarget() {
		$portfolio_link_meta   = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link_target = ! empty( $portfolio_link_meta ) ? '_blank' : '_self';
		
		return apply_filters( 'aalto_edge_portfolio_external_link_target', $portfolio_link_target );
	}
	
	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'edge-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {
				
				$portfolio_category_slug  = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;
				
				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'edge-core' ) . ': ' . $portfolio_category_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'edge-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'edge-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {
				
				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;
				
				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'edge-core' ) . ': ' . $portfolio_title;
				}
				
				$portfolio_id_display = esc_html__( 'Id', 'edge-core' ) . ': ' . $portfolio_id;
				
				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'edge-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {
				
				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;
				
				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'edge-core' ) . ': ' . $portfolio_tag_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}

    /**
     * Generates images for scrollable and row portfolio list
     *
     * @return array
     */
    public function getItemImages($params){
        $html = array();
        $img_ids = array();
        $id = get_the_id();

        $thumb1 = get_post_thumbnail_id($id);
        if($thumb1) {
            $img_ids[] = $thumb1;
        }

        $thumb2 = get_post_meta($id, 'portfolio_second_featured_image', true);
        if($thumb2) {
            $img_ids[] = aalto_edge_get_attachment_id_from_url($thumb2);
        }

        $scrollable_three_images = true;
        if ($params['three_images'] == 'no'){
            $scrollable_three_images = false;
        }

        $thumb3 = get_post_meta($id, 'portfolio_third_featured_image', true);
        if($thumb3 && $scrollable_three_images) {
            $img_ids[] = aalto_edge_get_attachment_id_from_url($thumb3);
        }

        if(!empty($img_ids)) :
            foreach($img_ids as $image_id) {
                $media                = array();
                $media['title']       = get_the_title($image_id);
                $media['image_src']   = wp_get_attachment_image_src($image_id, $params['thumb_size']);
                $html[] = '<img src="'.$media['image_src'][0].'" alt="'.$media['title'].'" />';
            }
        endif;

        return $html;
    }
}