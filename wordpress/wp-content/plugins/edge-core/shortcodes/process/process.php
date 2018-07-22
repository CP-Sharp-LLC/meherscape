<?php
namespace EdgeCore\CPT\Shortcodes\Process;

use EdgeCore\Lib;

class Process implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_process';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Edge Process', 'edge-core' ),
					'base'            => $this->base,
					'icon'            => 'icon-wpb-process extended-custom-icon',
					'category'        => esc_html__( 'by EDGE', 'edge-core' ),
					'as_parent'       => array( 'only' => 'edgtf_process_item' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number Of Columns', 'edge-core' ),
							'value'       => array(
								esc_html__( '2 Columns', 'edge-core' ) => 'two',
								esc_html__( '3 Columns', 'edge-core' ) => 'three',
								esc_html__( '4 Columns', 'edge-core' ) => 'four'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Default None', 'edge-core' ) => '',
								esc_html__( 'Below 1280px', 'edge-core' ) => '1280',
								esc_html__( 'Below 1024px', 'edge-core' ) => '1024',
								esc_html__( 'Below 768px', 'edge-core' )  => '768',
								esc_html__( 'Below 680px', 'edge-core' )  => '680',
								esc_html__( 'Below 480px', 'edge-core' )  => '480'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'edge-core' ),
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
			'number_of_columns'    => 'three',
			'switch_to_one_column' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['number_of_items'] = $this->getNumberOfItems( $params['number_of_columns'] );
		$params['content']         = $content;
		
		$html = edgtf_core_get_shortcode_module_template_part( 'templates/process-template', 'process', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgtf-' . $params['number_of_columns'] . '-columns' : 'edgtf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'edgtf-responsive-' . $params['switch_to_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getNumberOfItems( $params ) {
		$number = 3;
		
		switch ($params) {
			case 'two':
				$number = 2;
				break;
			case 'three':
				$number = 3;
				break;
			case 'four':
				$number = 4;
				break;
		}
		
		return $number;
	}
}
