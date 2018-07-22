<?php
namespace EdgeCore\CPT\Shortcodes\SocialLinks;

use EdgeCore\Lib;

class SocialLinks implements Lib\ShortcodeInterface {
    private $base;
    private $socialNetworks;

    function __construct() {
        $this->base           = 'edgtf_social_links';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Edge Social Links', 'edge-core' ),
                    'base'                      => $this->getBase(),
                    'icon'                      => 'icon-wpb-social-links extended-custom-icon',
                    'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
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
                            'heading'    => esc_html__( 'Link Color', 'edge-core' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link_font_size',
                            'heading'    => esc_html__( 'Font Size', 'edge-core' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link_margin',
                            'heading'    => esc_html__( 'Margin around link', 'edge-core' ),
                            'description' => esc_html__('Enter margin in top right bottom left format','edge-core'),
                        ),
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'single_link'        => '',
            'link_color'         => '',
            'link_font_size'     => '',
            'link_margin'        => '',
        );
        $params = shortcode_atts( $args, $atts );

        //Social Links Data
        $params['single_link'] = $this->getSingleLinkParams($params);
        $params['link_styles'] = $this->getLinkStyle($params);

        $html = edgtf_core_get_shortcode_module_template_part( 'templates/social-links', 'social-links', '', $params );

        return $html;
    }

    /**
     * Add wanted params for social links
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

        if(!empty($params['link_font_size'])) {
            $link_style[] = 'font-size:'.$params['link_font_size'];
        }

        if(!empty($params['link_margin'])) {
            $link_style[] = 'margin:'.$params['link_margin'];
        }

        return implode('; ', $link_style);
    }
}