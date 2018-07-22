<?php
namespace EdgeCore\CPT\Shortcodes\LinkSection;

use EdgeCore\Lib;

class LinkSection implements Lib\ShortcodeInterface {
    private $base;
    private $linkSection;

    function __construct() {
        $this->base           = 'edgtf_link_section';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Edge Link Section', 'edge-core' ),
                    'base'                      => $this->getBase(),
                    'icon'                      => 'icon-wpb-link-section extended-custom-icon',
                    'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
	                    array(
		                    'type'       => 'textfield',
		                    'param_name' => 'title',
		                    'heading'    => esc_html__( 'Title', 'edge-core' )
	                    ),
	                    array(
		                    'type'       => 'colorpicker',
		                    'param_name' => 'title_color',
		                    'heading'    => esc_html__( 'Title Color', 'edge-core' ),
		                    'dependency' => array( 'element' => 'title', 'not_empty' => true )
	                    ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title_break_words',
                            'heading'     => esc_html__( 'Position of Line Break', 'edge-core' ),
                            'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'edge-core' ),
                            'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
                        ),
                        array(
                            'type' => 'param_group',
                            'heading' => esc_html__('Single Link', 'edge-core'),
                            'param_name' => 'single_link',
                            'value' => '',
                            'params' => array(
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link',
                                    'heading'    => esc_html__( 'Link', 'edge-core' )
                                ),
                                array(
                                    'type'       => 'dropdown',
                                    'param_name' => 'target',
                                    'heading'    => esc_html__( 'Target', 'edge-core' ),
                                    'value'      => array_flip( aalto_edge_get_link_target_array() ),
                                    'dependency' => array( 'element' => 'link', 'not_empty' => true )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link_text',
                                    'heading'    => esc_html__( 'Link Text', 'edge-core' ),
                                    'dependency' => array( 'element' => 'link', 'not_empty' => true )
                                ),
                            )
                        ),
	                    array(
		                    'type'       => 'colorpicker',
		                    'param_name' => 'link_color',
		                    'heading'    => esc_html__( 'Link Color', 'edge-core' )
	                    ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_appear_animation',
                            'heading'     => esc_html__( 'Enable Appear Animation', 'edge-core' ),
                            'value'      => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
                            'group'       => esc_html__( 'Additional Features', 'edge-core' )
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
        	'title'              => '',
        	'title_color'        => '',
            'title_break_words'  => '',
            'single_link'        => '',
            'link_color'         => '',
            'enable_appear_animation' => 'yes'
        );
        $params = shortcode_atts( $args, $atts );

        //Link Section Data
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['single_link'] = $this->getSingleLinkParams($params);
        $params['link_styles'] = $this->getLinkStyle($params);
	    $params['title_styles'] = $this->getTitleStyle($params);


        if(!empty($params['title'])) {
            if(!empty($params['title_break_words'])) {
                $title_break_words = str_replace( ' ', '', $params['title_break_words'] );
                $split_title = explode( ' ', $params['title'] );
                if ( ! empty( $title_break_words ) ) {
                    if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
                        $split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
                    }
                }
                $params['title'] = implode( ' ', $split_title );
            }
        }

        $html = edgtf_core_get_shortcode_module_template_part( 'templates/link-section', 'link-section', '', $params );

        return $html;
    }

    public function getHolderClasses($params){
        $classes = array();

        if ($params['enable_appear_animation'] == 'yes') {
            $classes[] = 'edgtf-appear-fx';
        }

        return implode(' ', $classes);
    }

	private function getTitleStyle($params) {

		$title_style = array();

		if(!empty($params['title_color'])) {
			$title_style[] = 'color:'.$params['title_color'];
		}

		return implode('; ', $title_style);
	}

    /**
     * Add wanted params for link section
     *
     * @param $params
     * @return array
     */
    private function getSingleLinkParams($params) {
        $single_link = json_decode(urldecode($params['single_link']), true);
        $single_items = array();

        foreach ($single_link as $single_link_item) {

            $single_items[] = $single_link_item;
        }

        return $single_items;

    }

    private function getLinkStyle($params) {

        $link_style = array();

        if(!empty($params['link_color'])) {
            $link_style[] = 'color:'.$params['link_color'];
        }

        return implode('; ', $link_style);
    }
}