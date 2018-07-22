<?php
namespace EdgeCore\CPT\Shortcodes\Accordion;

use EdgeCore\Lib;

class Accordion implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_accordion';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Edge Accordion', 'edge-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'edgtf_accordion_tab' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'                    => 'icon-wpb-accordion extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'style',
							'heading'    => esc_html__( 'Style', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Accordion', 'edge-core' ) => 'accordion',
								esc_html__( 'Toggle', 'edge-core' )    => 'toggle'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'content_width',
							'heading'    => esc_html__( 'Content Width', 'edge-core' ),
							'value'      => array(
								esc_html__( 'In Grid', 'edge-core' )    => 'in-grid',
								esc_html__( 'Full Width', 'edge-core' ) => 'full-width',
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Title Skin', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Default', 'edge-core' ) => '',
								esc_html__( 'Light', 'edge-core' )   => 'light',
								esc_html__( 'Dark', 'edge-core' )   => 'dark',
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'    => '',
			'title'           => '',
			'style'           => 'accordion',
			'content_width'   => 'in-grid',
			'skin'			  => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['content']        = $content;
		
		$output = edgtf_core_get_shortcode_module_template_part( 'templates/accordion-holder-template', 'accordions', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holder_classes = array( 'edgtf-ac-default' );
		
		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = $params['style'] == 'toggle' ? 'edgtf-toggle' : 'edgtf-accordion';
		$holder_classes[] = ! empty( $params['content_width'] ) ? 'edgtf-' . esc_attr( $params['content_width'] ) : '';
		$holder_classes[] = ! empty( $params['skin'] ) ? 'edgtf-' . esc_attr( $params['skin'] ) . '-skin' : '';
		
		return implode( ' ', $holder_classes );
	}
}
