<?php
namespace EdgeCore\CPT\Shortcodes\Team;

use EdgeCore\Lib;

class TeamList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgtf_team_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Team category filter
	    add_filter( 'vc_autocomplete_edgtf_team_list_category_callback', array( &$this, 'teamCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Team category render
	    add_filter( 'vc_autocomplete_edgtf_team_list_category_render', array( &$this, 'teamCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Team selected projects filter
	    add_filter( 'vc_autocomplete_edgtf_team_list_selected_projects_callback', array( &$this, 'teamIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Team selected projects render
	    add_filter( 'vc_autocomplete_edgtf_team_list_selected_projects_render', array( &$this, 'teamIdAutocompleteRender', ), 10, 1 ); // Render exact team. Must return an array (label,value)
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Edge Team List', 'edge-core' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
				    'icon'                      => 'icon-wpb-team-list extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
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
						    'description' => esc_html__( 'Default value is Three', 'edge-core' )
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
						    'heading'     => esc_html__( 'Number of team members per page', 'edge-core' ),
						    'description' => esc_html__( 'Set number of items for your team list. Enter -1 to show all.', 'edge-core' ),
						    'value'       => '-1'
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Team List', 'edge-core' ),
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
						    'type'        => 'dropdown',
						    'param_name'  => 'orderby',
						    'heading'     => esc_html__('Order By', 'edge-core'),
						    'value'       => array_flip(aalto_edge_get_query_order_by_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'order',
						    'heading'    => esc_html__('Order', 'edge-core'),
						    'value'      => array_flip(aalto_edge_get_query_order_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'team_member_layout',
						    'heading'     => esc_html__( 'Team Member Layout', 'edge-core' ),
						    'value'       => array(
								esc_html__( 'Info Bellow', 'edge-core' ) => 'info-bellow',
								esc_html__( 'Info on Side', 'edge-core' ) => 'info-hover',
						    ),
						    'save_always' => true,
						    'group'       => esc_html__( 'Content Layout', 'edge-core' )
					    ),
					    array(
						    'type'        => 'attach_image',
						    'param_name'  => 'image_bg_pattern',
						    'heading'     => esc_html__( 'Background Image Pattern', 'edge-core' ),
						    'description' => esc_html__( 'Select image from media library', 'edge-core' ),
						    'dependency'  => array( 'element' => 'team_member_layout', 'value' => 'info-hover' ),
						    'group'       => esc_html__( 'Content Layout', 'edge-core' )
					    ),
				        array(
				    	    'type'        => 'dropdown',
				    	    'param_name'  => 'show_info_on_appear',
				    	    'heading'     => esc_html__( 'Show Info on Appear', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
				    	    'save_always' => true,
						    'dependency'  => array( 'element' => 'team_member_layout', 'value' => 'info-hover' ),
				        	'group'       => esc_html__( 'Additional Features', 'edge-core' )
				        ),
				        array(
				        	'type'        => 'dropdown',
				        	'param_name'  => 'enable_parallax_animation',
				        	'heading'     => esc_html__( 'Enable Parallax Animation', 'edge-core' ),
							'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
				        	'description' => esc_html__( 'Enabling this option will trigger parallax scrolling effect for each article.', 'edge-core' ),
						    'dependency'  => array( 'element' => 'team_member_layout', 'value' => 'info-hover' ),
				        	'group'       => esc_html__( 'Additional Features', 'edge-core' )
				        ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'team_skin',
						    'heading'     => esc_html__( 'Team Member Skin', 'edge-core' ),
						    'value'       => array(
							    esc_html__( 'Default', 'edge-core' ) => '',
							    esc_html__( 'Dark', 'edge-core' ) => 'dark-skin',
						    ),
						    'save_always' => true,
						    'group'       => esc_html__( 'Content Layout', 'edge-core' )
					    ),
				    )
			    )
		    );
	    }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'number_of_columns'     => '2',
            'space_between_items'   => 'normal',
	        'number_of_items'       => '4',
            'category'              => '',
            'selected_projects'     => '',
	        'tag'                   => '',
            'orderby'               => 'date',
            'order'                 => 'ASC',
	        'team_member_layout'    => 'info-hover',
	        'team_slider'           => 'no',
	        'slider_navigation'	    => 'no',
	        'slider_pagination'	    => 'no',
	        'image_bg_pattern'      => '',
	        'show_info_on_appear'	=> 'yes', 
	        'enable_parallax_animation' => 'yes',
	        'team_skin'             => ''
        );
		$params = shortcode_atts($args, $atts);
	
	    /***
	     * @params query_results
	     * @params holder_data
	     * @params holder_classes
	     */
		$additional_params = array();
	    
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);
	    $additional_params['query_results'] = $query_results;

	    $additional_params['holder_classes'] = $this->getHolderClasses($params);
	    $additional_params['inner_classes']  = $this->getInnerClasses($params);
	    $additional_params['data_attrs']     = $this->getDataAttribute($params);
	    $params['bg_image']                  = $this->getBgImage( $params );
	    $params['skin']                      = $this->getHolderSkin( $params );
	
	    $params['this_object'] = $this;
	    
	    $html = edgtf_core_get_cpt_shortcode_module_template_part('team', 'team-holder', '', $params, $additional_params);

        return $html;
	}

	private function getHolderSkin($params){
    	$holderSkin = array();

		$holderSkin[] = ! empty( $params['team_skin'] ) ? $params['team_skin'] : '';

		return implode( ' ', $holderSkin );
	}

	private function getBgImage( $params ) {
		$image = array();

		if ( ! empty( $params['image_bg_pattern'] ) ) {
			$image[] = 'background-image: url(' . wp_get_attachment_url( $params['image_bg_pattern'] ) . ')';
		}
		return implode( ';', $image );
	}

	/**
    * Generates team list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'team-member',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['team-category'] = $params['category'];
		}

		$project_ids = null;
		if (!empty($params['selected_projects'])) {
			$project_ids = explode(',', $params['selected_projects']);
			$query_array['post__in'] = $project_ids;
		}

		return $query_array;
	}

	/**
    * Generates team holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses($params){
		$classes = array();

		$number_of_columns   = $params['number_of_columns'];

        $classes[] = !empty($params['space_between_items']) ? 'edgtf-'.$params['space_between_items'].'-space' : 'edgtf-normal-space';

        if($params['team_slider'] !== 'yes') {
            switch ($number_of_columns):
                case '1':
                    $classes[] = 'edgtf-tl-one-columns';
                    break;
                case '2':
                    $classes[] = 'edgtf-tl-two-columns';
                    break;
                case '3':
                    $classes[] = 'edgtf-tl-three-columns';
                    break;
                case '4':
                    $classes[] = 'edgtf-tl-four-columns';
                    break;
                case '5':
                    $classes[] = 'edgtf-tl-five-columns';
                    break;
                default:
                    $classes[] = 'edgtf-tl-three-columns';
                    break;
            endswitch;
        } else {
            $classes[] = 'edgtf-tl-slider';
        }

        if ($params['team_member_layout'] == 'info-hover' && $params['show_info_on_appear'] == 'yes') {
        	$classes[] = 'edgtf-show-info-on-appear';
        }

        if ($params['team_member_layout'] == 'info-hover' && $params['enable_parallax_animation'] == 'yes') {
        	$classes[] = 'edgtf-tl-has-parallax-scroll';
        }

        return implode(' ', $classes);
	}
	
	/**
	 * Generates team inner classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getInnerClasses($params){
		$classes = array();
		
		if($params['team_slider'] === 'yes') {
			$classes[] = 'edgtf-owl-slider';
		}
		
		return implode(' ', $classes);
	}

    /**
     * Return Team Slider data attribute
     *
     * @param $params
     *
     * @return array
     */

    private function getDataAttribute($params) {
        $data_attrs = array();
	
	    $data_attrs['data-number-of-items']   = !empty($params['number_of_columns']) ? $params['number_of_columns'] : '3';
	    $data_attrs['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $data_attrs['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $data_attrs;
    }


    public function getParallaxData( $params ) {
    	$itemData = array();

    	if ($params['enable_parallax_animation'] === 'yes' && $params['team_member_layout'] == 'info-hover') {
		    $y_absolute = rand(-30, -40);
    	    $smoothness = 40; //1 is for linear, non-animated parallax

    	    $itemData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
    	}

    	return $itemData;
    }

    public function getParallaxDataReverse( $params ) {
    	$itemData = array();

    	if ($params['enable_parallax_animation'] === 'yes' && $params['team_member_layout'] == 'info-hover') {
		    $y_absolute = rand(20, 40);
    	    $smoothness = 20; //1 is for linear, non-animated parallax

    	    $itemData['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
    	}

    	return $itemData;
    }

	public function getTeamSocialIcons($id) {
		$social_icons = array();

		for($i = 1; $i < 6; $i++) {
			$team_icon_pack = get_post_meta($id, 'edgtf_team_member_social_icon_pack_'.$i, true);
			if($team_icon_pack) {
				$team_icon_collection = aalto_edge_icon_collections()->getIconCollection(get_post_meta($id, 'edgtf_team_member_social_icon_pack_' . $i, true));
				$team_social_icon = get_post_meta($id, 'edgtf_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true);
				$team_social_link = get_post_meta($id, 'edgtf_team_member_social_icon_' . $i . '_link', true);
				$team_social_target = get_post_meta($id, 'edgtf_team_member_social_icon_' . $i . '_target', true);

				if ($team_social_icon !== '') {

					$team_icon_params = array();
					$team_icon_params['icon_pack'] = $team_icon_pack;
					$team_icon_params[$team_icon_collection->param] = $team_social_icon;
					$team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
					$team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';

					$social_icons[] = aalto_edge_execute_shortcode('edgtf_icon', $team_icon_params);
				}
			}
		}

		return $social_icons;
	}

	/**
	 * Filter team categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function teamCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS team_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'team-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['team_category_title'] ) > 0 ) ? esc_html__( 'Category', 'edge-core' ) . ': ' . $value['team_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find team category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function teamCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get team category
			$team_category = get_term_by( 'slug', $query, 'team-category' );
			if ( is_object( $team_category ) ) {

				$team_category_slug = $team_category->slug;
				$team_category_title = $team_category->name;

				$team_category_title_display = '';
				if ( ! empty( $team_category_title ) ) {
					$team_category_title_display = esc_html__( 'Category', 'edge-core' ) . ': ' . $team_category_title;
				}

				$data          = array();
				$data['value'] = $team_category_slug;
				$data['label'] = $team_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter teams by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function teamIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$team_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'team-member' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $team_id > 0 ? $team_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'edge-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'edge-core' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find team by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function teamIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get team
			$team = get_post( (int) $query );
			if ( ! is_wp_error( $team ) ) {

				$team_id = $team->ID;
				$team_title = $team->post_title;

				$team_title_display = '';
				if ( ! empty( $team_title ) ) {
					$team_title_display = ' - ' . esc_html__( 'Title', 'edge-core' ) . ': ' . $team_title;
				}

				$team_id_display = esc_html__( 'Id', 'edge-core' ) . ': ' . $team_id;

				$data          = array();
				$data['value'] = $team_id;
				$data['label'] = $team_id_display . $team_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}