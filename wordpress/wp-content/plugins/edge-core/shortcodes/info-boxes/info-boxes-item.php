<?php
namespace EdgeCore\CPT\Shortcodes\InfoBoxes;

use EdgeCore\Lib;

class InfoBoxesItem implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_info_boxes_item';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Info Boxes Item', 'edge-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'                      => 'icon-wpb-info-boxes-item extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'edgtf_info_boxes' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Background Image', 'edge-core' ),
							'description' => esc_html__( 'Select image from media library', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'edge-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_bg_color',
							'heading'    => esc_html__( 'Title Front Background Color', 'edge-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'edge-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'edge-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'edge-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link', 'edge-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'arrow_color',
							'heading'    => esc_html__( 'Link Color', 'edge-core' ),
							'dependency' => array( 'element' => 'link', 'not_empty' => true )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'image'               => '',
			'title'               => '',
			'title_tag'           => 'h4',
			'title_bg_color'      => '',
			'title_color'         => '',
			'title_top_margin'    => '',
			'text'                => '',
			'text_color'          => '',
			'text_top_margin'     => '',
			'link'                => '',
			'arrow_color'         => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_inner_classes']= $this->getHolderInnerClasses( $params );
		$params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['title_front_styles'] = $this->getTitleFrontStyles( $params );
		$params['text_styles']        = $this->getTextStyles( $params );
		$params['button_params']      = $this->getButtonParams( $params );
		$params['image']              = $this->getImageUrl( $params );
		
		$html = edgtf_core_get_shortcode_module_template_part( 'templates/info-boxes-item', 'info-boxes', '', $params );
		
		return $html;
	}
	
	private function getHolderInnerClasses( $params ) {
		$holderInnerClasses = array();
		
		$holderInnerClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderInnerClasses );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getTitleFrontStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( ! empty( $params['title_bg_color'] ) ) {
			$styles[] = 'background-color: ' . $params['title_bg_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getButtonParams( $params ) {
		$button_params = array();
		$button_params['type'] = 'simple';
		$button_params['enable_arrow'] = 'yes';
		$button_params['show_text_on_hover'] = 'yes';
		$button_params['text'] = esc_html__('More','edge-core');

		if ( ! empty( $params['link'] ) ) {
			$button_params['link'] = $params['link'];
		}

		if ( ! empty( $params['arrow_color'] ) ) {
			$button_params['color'] = $params['arrow_color'];
		}

		return $button_params;
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . aalto_edge_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	private function getImageUrl( $params ) {
		$styles = array();

		if ( ! empty( $params['image'] ) ) {
			$styles[] = 'background-image:url(' . wp_get_attachment_url($params['image']) . ')';
		}

		return implode( ';', $styles );
	}
}