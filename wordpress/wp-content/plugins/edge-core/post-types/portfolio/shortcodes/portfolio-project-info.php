<?php

namespace EdgeCore\CPT\Shortcodes\Portfolio;

use EdgeCore\Lib;

class PortfolioProjectInfo implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_portfolio_project_info';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Portfolio project id filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_project_info_project_id_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio project id render
		add_filter( 'vc_autocomplete_edgtf_portfolio_project_info_project_id_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Edge Portfolio Project Info', 'edge-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'     => 'icon-wpb-portfolio-project-info extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'project_id',
							'heading'     => esc_html__( 'Selected Project', 'edge-core' ),
							'settings'    => array(
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'project_info_type',
							'heading'     => esc_html__( 'Project Info Type', 'edge-core' ),
							'value'       => array(
							    esc_html__('Aalto Project Info', 'edge-core') => 'aalto-project-info',
								esc_html__( 'Title', 'edge-core' )          => 'title',
								esc_html__( 'Category', 'edge-core' )       => 'category',
								esc_html__( 'Tag', 'edge-core' )            => 'tag',
								esc_html__( 'Author', 'edge-core' )         => 'author',
								esc_html__( 'Date', 'edge-core' )           => 'date',
								esc_html__( 'Featured Image', 'edge-core' ) => 'image'
							),
							'admin_label' => true
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'project_info_layout',
                            'heading'     => esc_html__( 'Project Title Tag', 'edge-core' ),
                            'value'      => array(
                                esc_html__( 'Info Right', 'edge-core' )  => 'info-right',
                                esc_html__( 'Info Left', 'edge-core' ) => 'info-left',
                            ),
                            'description' => esc_html__( 'Choose desired layout', 'edge-core' ),
                            'dependency'  => array( 'element' => 'project_info_type', 'value' => array( 'aalto-project-info' ) )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_bg_color',
                            'heading'    => esc_html__( 'Mask Color', 'edge-core' ),
                            'dependency'  => array( 'element' => 'project_info_type', 'value' => array( 'aalto-project-info' ) ),
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'project_info_title_type_tag',
							'heading'     => esc_html__( 'Project Title Tag', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'description' => esc_html__( 'Set title tag for project title element', 'edge-core' ),
							'dependency'  => array( 'element' => 'project_info_type', 'value' => array( 'title' ) )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'project_info_title_break_words',
                            'heading'     => esc_html__( 'Position of Line Break', 'edge-core' ),
                            'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'edge-core' ),
                            'dependency'  => array( 'element' => 'project_info_type', 'value' => array( 'aalto-project-info' ) ),
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'project_info_title',
							'heading'     => esc_html__( 'Project Info Label', 'edge-core' ),
							'description' => esc_html__( 'Add project info label before project info element/s', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'project_info_title_tag',
							'heading'    => esc_html__( 'Project Info Label Tag', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'dependency' => array( 'element' => 'project_info_title', 'not_empty' => true )
						),
				        array(
				    	    'type'        => 'dropdown',
				    	    'param_name'  => 'enable_appear_animation',
				    	    'heading'     => esc_html__( 'Enable Appear Animation', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
				        	'group'       => esc_html__( 'Additional Features', 'edge-core' )
				        ),
						array(
				        	'type'        => 'dropdown',
				        	'param_name'  => 'enable_parallax_animation',
				        	'heading'     => esc_html__( 'Enable Parallax Animation', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
				        	'description' => esc_html__( 'Enabling this option will trigger parallax scrolling effect for images.', 'edge-core' ),
				        	'group'       => esc_html__( 'Additional Features', 'edge-core' )
				        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'project_id'                  => '',
			'project_info_type'           => 'aalto-project-info',
            'project_info_layout'         => 'info-right',
            'title_bg_color'              => '',
			'project_info_title_type_tag' => 'h3',
            'project_info_title_break_words'   => '',
			'project_info_title'          => '',
			'project_info_title_tag'      => 'h3',
			'enable_parallax_animation'	  => 'yes',
			'enable_appear_animation'	  => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$project_info_type                     = ! empty( $params['project_info_type'] ) ? $params['project_info_type'] : $args['project_info_type'];
		$params['project_id']                  = ! empty( $params['project_id'] ) ? $params['project_id'] : get_the_ID();
		$params['project_info_title_type_tag'] = ! empty( $params['project_info_title_type_tag'] ) ? $params['project_info_title_type_tag'] : $args['project_info_title_type_tag'];
		$project_info_title_tag                = ! empty( $params['project_info_title_tag'] ) ? $params['project_info_title_tag'] : $args['project_info_title_tag'];
	    $params['holder_classes'] = $this->getHolderClasses($params);
		
		$html = '<div class="'. esc_attr($params['holder_classes']) .'">';
		
		if ( ! empty( $project_info_title ) ) {
			$html .= '<' . esc_attr( $project_info_title_tag ) . ' class="edgtf-ppi-label">' . esc_html( $project_info_title ) . '</' . esc_attr( $project_info_title_tag ) . '>';
		}
		
		switch ( $project_info_type ) {
            case 'aalto-project-info':
                $params['this_object'] = $this;
                $html .= edgtf_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-project-info', '', $params );
                break;
			case 'title':
				$html .= $this->getItemTitleHtml( $params );
				break;
			case 'category':
				$html .= $this->getItemCategoryHtml( $params );
				break;
			case 'tag':
				$html .= $this->getItemTagHtml( $params );
				break;
			case 'author':
				$html .= $this->getItemAuthorHtml( $params );
				break;
			case 'date':
				$html .= $this->getItemDateHtml( $params );
				break;
			case 'image':
				$html .= $this->getItemImageHtml( $params );
				break;
			default:
				$html .= $this->getItemTitleHtml( $params );
				break;
		}
		
		$html .= '</div>';
		
		return $html;
	}

	public function getHolderClasses ($params) {
		$classes = array('edgtf-portfolio-project-info');

        if ($params['enable_appear_animation'] == 'yes') {
        	$classes[] = 'edgtf-appear-fx';
        }

        if ($params['enable_parallax_animation'] == 'yes') {
        	$classes[] = 'edgtf-parallax-fx';
        }

        return implode(' ', $classes);
	}
	
	public function getItemTitleHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$title      = get_the_title( $project_id );
		$title_tag  = $params['project_info_title_type_tag'];
        $title_break_words = str_replace( ' ', '', $params['project_info_title_break_words'] );

        $mask_color = '#fff';

        if ( ! empty( $params['title_bg_color'] ) ) {
            $mask_color = $params['title_bg_color'];
        }

        $mask_color_style = 'background-color: '. $mask_color;
		
		if ( ! empty( $title ) ) {
            $split_title = explode( ' ', $title );
            if ( ! empty( $title_break_words ) ) {
                if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
                    $split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
                }
            }
            $title = implode( ' ', $split_title );
            $html = '<div class="edgtf-ppi-title-holder  edgtf-ppi-square">';
            $html .= '<div class="edgtf-ppi-square-holder">';
            $html .= '<span class="line-top"></span>';
            $html .= '<span class="line-right"></span>';
            $html .= '<span class="line-bottom"></span>';
            $html .= '<span class="line-left"></span>';
            $html .= '<span class="line-mask" style="'. esc_attr($mask_color_style).'"></span>';
            $html .= '<div class="edgtf-ppi-title-inner">';
            $html .= '<div class="edgtf-ppi-title-wrap">';
			$html .= '<' . esc_attr( $title_tag ) . ' itemprop="name" class="edgtf-ppi-title entry-title">';
				$html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . wp_kses($title, array('br' => true, 'span' => array('class' => true))) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
		}
		
		return $html;
	}

    public function getItemExcerptHtml( $params ) {
        $html       = '';
        $project_id = $params['project_id'];
        $excerpt      = get_the_excerpt( $project_id );

        if ( ! empty( $excerpt ) ) {
        	$html = '<div class="edgtf-ppi-excerpt-wrap">';
            $html .= '<p itemprop="description" class="edgtf-ppi-excerpt">'. esc_html($excerpt) . '</p>';
            $html .='</div>';
        }

        return $html;
    }
	
	public function getItemCategoryHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$categories = wp_get_post_terms( $project_id, 'portfolio-category' );
		
		if ( ! empty( $categories ) ) {
			$html = '<div class="edgtf-ppi-category">';
			foreach ( $categories as $cat ) {
				$html .= '<a itemprop="url" class="edgtf-ppi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}
	
	public function getItemTagHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$tags       = wp_get_post_terms( $project_id, 'portfolio-tag' );
		
		if ( ! empty( $tags ) ) {
			$html = '<div class="edgtf-ppi-tag">';
			foreach ( $tags as $tag ) {
				$html .= '<a itemprop="url" class="edgtf-ppi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}
	
	public function getItemAuthorHtml( $params ) {
		$html         = '';
		$project_id   = $params['project_id'];
		$project_post = get_post( $project_id );
		$autor_id     = $project_post->post_author;
		$author       = get_the_author_meta( 'display_name', $autor_id );
		
		if ( ! empty( $author ) ) {
			$html = '<div class="edgtf-ppi-author">' . esc_html( $author ) . '</div>';
		}
		
		return $html;
	}
	
	public function getItemDateHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$date       = get_the_time( get_option( 'date_format' ), $project_id );
		
		if ( ! empty( $date ) ) {
			$html = '<div class="edgtf-ppi-date">' . esc_html( $date ) . '</div>';
		}
		
		return $html;
	}

    public function getParallaxData( $params ) {
	    $data = array();

    	if ($params['enable_parallax_animation'] === 'yes') {
		    $y_absolute = rand(-50, -100);
    	    $smoothness = 20; //1 is for linear, non-animated parallax

    	    $data['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
    	}

    	return $data;
    }

    public function getParallaxDataReverse( $params ) {
	    $data = array();

    	if ($params['enable_parallax_animation'] === 'yes') {
		    $y_absolute = rand(40, 60);
    	    $smoothness = 20; //1 is for linear, non-animated parallax

    	    $data['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
    	}

    	return $data;
    }
	
	public function getItemImageHtml( $params ) {

        $html = '';
        $img_ids = array();
        $project_id = $params['project_id'];

        $thumb1 = get_post_thumbnail_id($project_id, 'full');
        if($thumb1) {
            $img_ids[] = $thumb1;
        }

        if(!empty($img_ids)) :
            foreach($img_ids as $image_id) {
                $media                = array();
                $media['title']       = get_the_title($image_id);
                $media['image_src']   = wp_get_attachment_image_src($image_id, 'full');
                $html .= '<div class="edgtf-ppi-image-holder" '.aalto_edge_get_inline_attrs($this -> getParallaxData($params)).'>';
                $html .= '<img class="edgtf-ppi-image edgtf-first" src="'.$media['image_src'][0].'" alt="'.$media['title'].'" />';
                $html .= '</div>';
            }
        endif;

        return $html;
	}

    public function getItemSecondImageHtml( $params ) {

        $html = '';
        $img_ids = array();
        $project_id = $params['project_id'];

        $thumb2 = get_post_meta($project_id, 'portfolio_second_featured_image', true);
        if($thumb2) {
            $img_ids[] = aalto_edge_get_attachment_id_from_url($thumb2);
        }

        if(!empty($img_ids)) :
            foreach($img_ids as $image_id) {
                $media                = array();
                $media['title']       = get_the_title($image_id);
                $media['image_src']   = wp_get_attachment_image_src($image_id, 'full');
                $html .= '<div class="edgtf-ppi-image-holder" '.aalto_edge_get_inline_attrs($this -> getParallaxDataReverse($params)).'>';
                $html .= '<img class="edgtf-ppi-image edgtf-second" src="'.$media['image_src'][0].'" alt="'.$media['title'].'" />';
                $html .= '</div>';
            }
        endif;

        return $html;
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
}