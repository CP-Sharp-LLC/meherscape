<?php

namespace EdgeCore\CPT\Shortcodes\InfoBoxes;

use EdgeCore\Lib;

class InfoBoxes implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'edgtf_info_boxes';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					"name"                    => esc_html__( 'Edge Info Boxes', 'edge-core' ),
					"base"                    => $this->base,
					'as_parent'               => array( 'only' => 'edgtf_info_boxes_item' ),
					'is_container'            => true,
					"category"                => esc_html__( 'by EDGE', 'edge-core' ),
					"icon"                    => "icon-wpb-info-boxes extended-custom-icon",
					"show_settings_on_create" => true,
					"js_view"                 => 'VcColumnView',
					"params"                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-core' ) => '',
								esc_html__( 'Three', 'edge-core' )   => '3',
								esc_html__( 'Four', 'edge-core' )    => '4',
							),
							'save_always' => true,
							'description' => esc_html__( 'Default value is Four', 'edge-core' )
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
			'number_of_columns'   => ''
		);

		$params       = shortcode_atts( $default_atts, $atts );

		$params['content']   = $content;
		$params['holder_classes']     = $this->getHolderClasses( $params );

		$output = edgtf_core_get_shortcode_module_template_part( 'templates/info-boxes', 'info-boxes', '', $params );

		return $output;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		$number_of_columns   = $params['number_of_columns'];

		switch ($number_of_columns):
			case '3':
				$holderClasses[] = 'edgtf-ib-three-columns';
				break;
			case '4':
				$holderClasses[] = 'edgtf-ib-four-columns';
				break;
			default:
				$holderClasses[] = 'edgtf-ib-four-columns';
				break;
		endswitch;

		return implode( ' ', $holderClasses );
	}
}