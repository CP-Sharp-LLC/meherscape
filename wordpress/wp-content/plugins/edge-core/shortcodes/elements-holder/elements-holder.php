<?php
namespace EdgeCore\CPT\Shortcodes\ElementsHolder;

use EdgeCore\Lib;

class ElementsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_elements_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Edge Elements Holder', 'edge-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-elements-holder extended-custom-icon',
					'category'  => esc_html__( 'by EDGE', 'edge-core' ),
					'as_parent' => array( 'only' => 'edgtf_elements_holder_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'holder_full_height',
							'heading'     => esc_html__( 'Enable Holder Full Height', 'edge-core' ),
							'value'       => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'edge-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'border_image',
							'heading'    => esc_html__( 'Border Image', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'border_image_slice',
							'heading'    => esc_html__( 'Border Image Slice', 'edge-core' ),
							'dependency' => array('element' => 'border_image', 'not_empty' => true)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'border_width',
							'heading'    => esc_html__( 'Border Width', 'edge-core' ),
							'dependency' => array('element' => 'border_image', 'not_empty' => true)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Columns', 'edge-core' ),
							'value'       => array(
								esc_html__( '1 Column', 'edge-core' )  => 'one-column',
								esc_html__( '2 Columns', 'edge-core' ) => 'two-columns',
								esc_html__( '3 Columns', 'edge-core' ) => 'three-columns',
								esc_html__( '4 Columns', 'edge-core' ) => 'four-columns',
								esc_html__( '5 Columns', 'edge-core' ) => 'five-columns',
								esc_html__( '6 Columns', 'edge-core' ) => 'six-columns'
							),
							'save_always' => true
						),
						array(
							'type'       => 'checkbox',
							'param_name' => 'items_float_left',
							'heading'    => esc_html__( 'Items Float Left', 'edge-core' ),
							'value'      => array( 'Make Items Float Left?' => 'yes' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-core' )      => '',
								esc_html__( 'Below 1280px', 'edge-core' ) => '1280',
								esc_html__( 'Below 1024px', 'edge-core' ) => '1024',
								esc_html__( 'Below 768px', 'edge-core' )  => '768',
								esc_html__( 'Below 680px', 'edge-core' )  => '680',
								esc_html__( 'Below 480px', 'edge-core' )  => '480',
								esc_html__( 'Never', 'edge-core' )        => 'never'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'edge-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'alignment_one_column',
							'heading'     => esc_html__( 'Choose Alignment In Responsive Mode', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-core' ) => '',
								esc_html__( 'Left', 'edge-core' )    => 'left',
								esc_html__( 'Center', 'edge-core' )  => 'center',
								esc_html__( 'Right', 'edge-core' )   => 'right'
							),
							'description' => esc_html__( 'Alignment When Items are in One Column', 'edge-core' ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'holder_full_height'   => 'no',
			'background_color'     => '',
			'border_image_slice'	 => '',
			'border_image'			 => '',
			'border_width'			 => '',
			'number_of_columns'    => 'one-column',
			'items_float_left'     => '',
			'switch_to_one_column' => '',
			'alignment_one_column' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_classes = $this->getHolderClasses( $params );
		$holder_styles  = $this->getHolderStyles( $params );
		
		$html = '<div ' . aalto_edge_get_class_attribute( $holder_classes ) . ' ' . aalto_edge_get_inline_attr( $holder_styles, 'style' ) . '>';
			$html .= do_shortcode( $content );
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'edgtf-elements-holder' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['holder_full_height'] === 'yes' ? 'edgtf-eh-full-height' : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgtf-' . $params['number_of_columns'] : '';
		$holderClasses[] = $params['items_float_left'] !== '' ? 'edgtf-ehi-float' : '';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'edgtf-responsive-mode-' . $params['switch_to_one_column'] : 'edgtf-responsive-mode-768';
		$holderClasses[] = ! empty( $params['alignment_one_column'] ) ? 'edgtf-one-column-alignment-' . $params['alignment_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['border_image'] ) ) {
			$border_slice = '25%';
			if ( $params['border_image_slice'] !== '' ){
				$border_slice = $params['border_image_slice'];
			}

			$styles[] = 'border-image: url(' . wp_get_attachment_url( $params['border_image'] ) . ') '.$border_slice.' repeat';

			$styles[] = 'border-style: solid';

			if ( $params['border_width'] !== '' ) {
				$styles[] = 'border-width:'.aalto_edge_filter_px($params['border_width']).'px';
			} else {
				$styles[] = 'border-width: 20px';
			}
		}
		
		
		return implode( ';', $styles );
	}
}
