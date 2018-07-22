<?php
namespace EdgeCore\CPT\Shortcodes\BlogList;

use EdgeCore\Lib;

class BlogList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Category filter
		add_filter( 'vc_autocomplete_edgtf_blog_list_category_callback', array( &$this, 'blogCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Category render
		add_filter( 'vc_autocomplete_edgtf_blog_list_category_render', array( &$this, 'blogCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name'                      => esc_html__( 'Edge Blog List', 'aalto' ),
				'base'                      => $this->base,
				'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
				'category'                  => esc_html__( 'by EDGE', 'aalto' ),
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'type',
						'heading'     => esc_html__( 'Type', 'aalto' ),
						'value'       => array(
							esc_html__( 'Standard', 'aalto' ) => 'standard',
							esc_html__( 'Boxed', 'aalto' )    => 'boxed',
							esc_html__( 'Masonry', 'aalto' )  => 'masonry',
							esc_html__( 'Simple', 'aalto' )   => 'simple',
							esc_html__( 'Minimal', 'aalto' )  => 'minimal',
							esc_html__( 'Alternating', 'aalto' )  => 'alternating'
						),
						'save_always' => true
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__( 'Number of Posts', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'number_of_columns',
						'heading'    => esc_html__( 'Number of Columns', 'aalto' ),
						'value'      => array(
							esc_html__( 'One', 'aalto' )   => '1',
							esc_html__( 'Two', 'aalto' )   => '2',
							esc_html__( 'Three', 'aalto' ) => '3',
							esc_html__( 'Four', 'aalto' )  => '4',
							esc_html__( 'Five', 'aalto' )  => '5'
						),
						'dependency' => Array( 'element' => 'type', 'value' => array( 'standard', 'boxed', 'masonry' ) )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'space_between_items',
						'heading'     => esc_html__( 'Space Between Items', 'aalto' ),
						'value'       => array_flip( aalto_edge_get_space_between_items_array() ),
						'save_always' => true,
						'dependency'  => array( 'element' => 'type', 'value'   => array( 'standard', 'boxed', 'masonry' ) )
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
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__( 'Category', 'aalto' ),
						'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__( 'Image Size', 'aalto' ),
						'value'      => array(
							esc_html__( 'Original', 'aalto' )  => 'full',
							esc_html__( 'Square', 'aalto' )    => 'aalto_edge_square',
							esc_html__( 'Landscape', 'aalto' ) => 'aalto_edge_landscape',
							esc_html__( 'Portrait', 'aalto' )  => 'aalto_edge_portrait',
							esc_html__( 'Thumbnail', 'aalto' ) => 'thumbnail',
							esc_html__( 'Medium', 'aalto' )    => 'medium',
							esc_html__( 'Large', 'aalto' )     => 'large'
						),
						'save_always' => true,
						'dependency'  => Array( 'element' => 'type', 'value' => array( 'standard', 'boxed', 'masonry' ) )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_tag',
						'heading'    => esc_html__( 'Title Tag', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_title_tag( true ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_transform',
						'heading'    => esc_html__( 'Title Text Transform', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_text_transform_array( true ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__( 'Text Length', 'aalto' ),
						'description' => esc_html__( 'Number of characters', 'aalto' ),
						'dependency'  => Array( 'element' => 'type', 'value'   => array( 'standard', 'boxed', 'masonry', 'simple','alternating' ) ),
						'group'       => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_image',
						'heading'    => esc_html__( 'Enable Post Info Image', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'boxed', 'masonry' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_section',
						'heading'    => esc_html__( 'Enable Post Info Section', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'boxed', 'masonry','alternating' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_author',
						'heading'    => esc_html__( 'Enable Post Info Author', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_date',
						'heading'    => esc_html__( 'Enable Post Info Date', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_category',
						'heading'    => esc_html__( 'Enable Post Info Category', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_comments',
						'heading'    => esc_html__( 'Enable Post Info Comments', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_like',
						'heading'    => esc_html__( 'Enable Post Info Like', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_share',
						'heading'    => esc_html__( 'Enable Post Info Share', 'aalto' ),
						'value'      => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'pagination_type',
						'heading'    => esc_html__( 'Pagination Type', 'aalto' ),
						'value'      => array(
							esc_html__( 'None', 'aalto' )            => 'no-pagination',
							esc_html__( 'Standard', 'aalto' )        => 'standard-blog-list',
							esc_html__( 'Load More', 'aalto' )       => 'load-more',
							esc_html__( 'Infinite Scroll', 'aalto' ) => 'infinite-scroll'
						),
						'group'      => esc_html__( 'Additional Features', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'blog_skin',
						'heading'    => esc_html__( 'Blog Skin', 'aalto' ),
						'value'      => array(
							esc_html__( 'Default', 'aalto' ) => 'default',
							esc_html__( 'Light', 'aalto' )   => 'light'
						),
						'group'      => esc_html__( 'Additional Features', 'aalto' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'content_border_type',
						'heading'    => esc_html__( 'Content Border Type', 'aalto' ),
						'value'      => array(
							esc_html__( 'Pattern', 'aalto' ) => 'pattern',
							esc_html__( 'Solid', 'aalto' )   => 'solid'
						),
					    'dependency' => Array( 'element' => 'type', 'value' => 'alternating'),
						'group'      => esc_html__( 'Additional Features', 'aalto' )
					),
					array(
					    'type'       => 'colorpicker',
					    'param_name' => 'content_border_color',
					    'heading'    => esc_html__( 'Content Border Color', 'aalto' ),
					    'dependency' => Array( 'element' => 'content_border_type', 'value' => 'solid'),
					    'group'      => esc_html__( 'Additional Features', 'aalto' )
					),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'blog_alternating_box_color',
                        'heading'    => esc_html__( 'Blog Alternating Content Background Color', 'aalto' ),
                        'value'      => '',
                        'dependency' => Array( 'element' => 'type', 'value' => 'alternating'),
                        'group'      => esc_html__( 'Additional Features', 'aalto' )
                    ),
	                array(
	            	    'type'        => 'dropdown',
	            	    'param_name'  => 'show_info_on_appear',
	            	    'heading'     => esc_html__( 'Show Info on Appear', 'aalto' ),
	        			'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
	            	    'save_always' => true,
	            	    'dependency' => Array( 'element' => 'type', 'value' => 'alternating'),
	                	'group'       => esc_html__( 'Additional Features', 'aalto' )
	                ),
	                array(
	                	'type'        => 'dropdown',
	                	'param_name'  => 'enable_parallax_animation',
	                	'heading'     => esc_html__( 'Enable Parallax Animation', 'aalto' ),
	        			'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
	                	'description' => esc_html__( 'Enabling this option will trigger parallax scrolling effect for each article.', 'aalto' ),
	                	'dependency' => Array( 'element' => 'type', 'value' => 'alternating'),
	                	'group'       => esc_html__( 'Additional Features', 'aalto' )
	                ),
				)
			)
		);
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                  => 'standard',
			'number_of_posts'       => '-1',
			'number_of_columns'     => '3',
			'space_between_items'   => 'normal',
			'category'              => '',
			'orderby'               => 'title',
			'order'                 => 'ASC',
			'image_size'            => 'full',
			'title_tag'             => 'h4',
			'title_transform'       => '',
			'excerpt_length'        => '30',
			'post_info_section'     => 'yes',
			'post_info_image'       => 'yes',
			'post_info_author'      => 'yes',
			'post_info_date'        => 'yes',
			'post_info_category'    => 'yes',
			'post_info_comments'    => 'no',
			'post_info_like'        => 'no',
			'post_info_share'       => 'no',
			'pagination_type'       => 'no-pagination',
			'blog_skin'             => '',
            'blog_alternating_box_color' => '',
            'content_border_type'	=> '',
            'content_border_color'	=> '',
            'show_info_on_appear' 	=> 'yes',
            'enable_parallax_animation' => 'yes'
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;
		
		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['module']         = 'list';
        $params['content_styles']    = $this->getContentStyles( $params );
        $params['content_inner_styles']    = $this->getContentInnerStyles( $params );
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;
		
		$params['this_object'] = $this;
		
		ob_start();
		
		aalto_edge_get_module_template_part( 'shortcodes/blog-list/holder', 'blog', $params['type'], $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;
	}
	
	public function getHolderClasses( $params, $default_atts ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-bl-' . $params['type'] : 'edgtf-bl-' . $default_atts['type'];
		$holderClasses[] = $this->getColumnNumberClass( $params['number_of_columns'] );
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'edgtf-' . $params['space_between_items'] . '-space' : 'edgtf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'edgtf-bl-pag-' . $params['pagination_type'] : 'edgtf-bl-pag-' . $default_atts['pagination_type'];
		$holderClasses[] = ! empty( $params['blog_skin'] ) ? $params['blog_skin'] .'-skin' : '';

		if ($params['type'] == 'alternating' && $params['show_info_on_appear'] == 'yes') {
			$holderClasses[] = 'edgtf-show-info-on-appear';
		}

		if ($params['type'] == 'alternating' && $params['enable_parallax_animation'] == 'yes') {
			$holderClasses[] = 'edgtf-bl-has-parallax-scroll';
		}

		
		return implode( ' ', $holderClasses );
	}
	
	public function getColumnNumberClass( $params ) {
		switch ( $params ) {
			case 1:
				$classes = 'edgtf-bl-one-column';
				break;
			case 2:
				$classes = 'edgtf-bl-two-columns';
				break;
			case 3:
				$classes = 'edgtf-bl-three-columns';
				break;
			case 4:
				$classes = 'edgtf-bl-four-columns';
				break;
			case 5:
				$classes = 'edgtf-bl-five-columns';
				break;
			default:
				$classes = 'edgtf-bl-three-columns';
				break;
		}
		
		return $classes;
	}
	
	public function getHolderData( $params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_result = $params['query_result'];
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( $value );
			}
		}
		
		return $dataString;
	}
	
	public function generateQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $queryArray;
	}

	public function getArticleData( $params ) {
		$articleInnerData = array();

		if ($params['enable_parallax_animation'] === 'yes' && $params['type'] === 'alternating') {
		    $y_absolute = rand(-40, -80);
		    $smoothness = 20; //1 is for linear, non-animated parallax

		    $articleInnerData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}

		return $articleInnerData;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}

	public function getContentStyles($params) {
	    $style = '';

        if(!empty($params['content_border_color']) && $params['content_border_type'] == 'solid') {
            $style .= 'background-image: none;';
            $style .= 'background-color:'.$params['content_border_color'].';';
        }

        return $style;
    }

	public function getContentInnerStyles($params) {
	    $style = '';

        if(!empty($params['blog_alternating_box_color'])) {
            $style = 'background-color:'.$params['blog_alternating_box_color'].';';
        }

        return $style;
    }

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'aalto' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {
				
				$category_slug = $category->slug;
				$category_title = $category->name;
				
				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'aalto' ) . ': ' . $category_title;
				}
				
				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}