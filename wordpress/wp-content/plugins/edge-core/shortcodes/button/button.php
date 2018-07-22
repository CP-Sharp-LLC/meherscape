<?php
namespace EdgeCore\CPT\Shortcodes\Button;

use EdgeCore\Lib;

class Button implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Button', 'edge-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'                      => 'icon-wpb-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'edge-core' ),
								'value'       => array(
									esc_html__( 'Solid', 'edge-core' )   => 'solid',
									esc_html__( 'Simple', 'edge-core' )  => 'simple'
								),
								'admin_label' => true
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'show_crosshair',
								'heading'     => esc_html__( 'Show Crosshair', 'edge-core' ),
								'value'       => array_flip( aalto_edge_get_yes_no_select_array( false, true ) ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'size',
								'heading'    => esc_html__( 'Size', 'edge-core' ),
								'value'      => array(
									esc_html__( 'Default', 'edge-core' ) => '',
									esc_html__( 'Small', 'edge-core' )   => 'small',
									esc_html__( 'Medium', 'edge-core' )  => 'medium',
									esc_html__( 'Large', 'edge-core' )   => 'large',
									esc_html__( 'Huge', 'edge-core' )    => 'huge'
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text',
								'heading'     => esc_html__( 'Text', 'edge-core' ),
								'value'       => esc_html__( 'Button Text', 'edge-core' ),
								'save_always' => true,
								'admin_label' => true
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'enable_arrow',
								'heading'     => esc_html__( 'Show Arrow', 'edge-core' ),
								'value'       => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
								'description' => esc_html__( 'This option counteracts with Icon Pack option.', 'edge-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'simple' ) )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'show_text_on_hover',
								'heading'     => esc_html__( 'Show Text On Hover', 'edge-core' ),
								'value'       => array_flip( aalto_edge_get_yes_no_select_array( false ) ),
								'dependency' => array( 'element' => 'enable_arrow', 'value' => array( 'yes' ) )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'link',
								'heading'    => esc_html__( 'Link', 'edge-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'target',
								'heading'     => esc_html__( 'Link Target', 'edge-core' ),
								'value'       => array_flip( aalto_edge_get_link_target_array() ),
								'save_always' => true
							)
						),
						aalto_edge_icon_collections()->getVCParamsArray( array(), '', true ),
						array(
							array(
								'type'       => 'colorpicker',
								'param_name' => 'color',
								'heading'    => esc_html__( 'Color', 'edge-core' ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_color',
								'heading'    => esc_html__( 'Hover Color', 'edge-core' ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'background_color',
								'heading'    => esc_html__( 'Background Color', 'edge-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'background_image',
								'heading'    => esc_html__( 'Background Image', 'edge-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_background_color',
								'heading'    => esc_html__( 'Hover Background Color', 'edge-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'crosshair_color',
								'heading'    => esc_html__( 'Crosshair Color', 'edge-core' ),
								'dependency' => array( 'element' => 'show_crosshair', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'font_size',
								'heading'    => esc_html__( 'Font Size (px)', 'edge-core' ),
								'group'      => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'font_weight',
								'heading'     => esc_html__( 'Font Weight', 'edge-core' ),
								'value'       => array_flip( aalto_edge_get_font_weight_array( true ) ),
								'save_always' => true,
								'group'       => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'text_transform',
								'heading'     => esc_html__( 'Text Transform', 'edge-core' ),
								'value'       => array_flip( aalto_edge_get_text_transform_array( true ) ),
								'save_always' => true
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'margin',
								'heading'     => esc_html__( 'Margin', 'edge-core' ),
								'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'edge-core' ),
								'group'       => esc_html__( 'Design Options', 'edge-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'padding',
								'heading'     => esc_html__( 'Button Padding', 'edge-core' ),
								'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'edge-core' ),
								'dependency'  => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'       => esc_html__( 'Design Options', 'edge-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '_self',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'crosshair_color'        => '#999',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => 'capitalize',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array(),
			'background_image'       => '',
			'enable_arrow'           => '',
			'show_text_on_hover'     => '',
			'show_crosshair'         => 'yes'
		);
		$default_atts = array_merge( $default_atts, aalto_edge_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		if ( $params['html_type'] !== 'input' ) {
			$iconPackName   = aalto_edge_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			$params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
		}
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		$params['bg_styles']           = $this->getBgStyles( $params );
		$params['border_styles']           = $this->getBorderStyles( $params );

		return edgtf_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . aalto_edge_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}

		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'] ;
		}
		
		return $styles;
	}
	
	private function getButtonDataAttr( $params ) {
		$data = array();
		
		if ( ! empty( $params['hover_color'] ) ) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'edgtf-btn',
			'edgtf-btn-' . $params['size'],
			'edgtf-btn-' . $params['type']
		);
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$buttonClasses[] = 'edgtf-btn-custom-hover-bg';
		}
		
		if ( ! empty( $params['hover_color'] ) ) {
			$buttonClasses[] = 'edgtf-btn-custom-hover-color';
		}
		
		if ( ! empty( $params['icon'] ) ) {
			$buttonClasses[] = 'edgtf-btn-icon';
		}
		
		if ( ! empty( $params['custom_class'] ) ) {
			$buttonClasses[] = esc_attr( $params['custom_class'] );
		}
		
		if ( $params['show_crosshair'] == 'yes' && $params['type'] == 'solid') {
			$buttonClasses[] = 'edgtf-btn-with-crosshair';
		}
		
		if ( $params['enable_arrow'] == 'yes' && $params['type'] == 'simple') {
			$buttonClasses[] = 'edgtf-btn-with-arrow';

			if ($params['show_text_on_hover'] == 'yes') {
				$buttonClasses[] = 'edgtf-btn-text-on-hover';
			}
		}

		if (!empty($params['background_image'])) {
			$buttonClasses[] = 'edgtf-btn-with-background-image';
		}

		return $buttonClasses;
	}

	private function getBgStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
		}

		return $styles;
	}

	private function getBorderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['crosshair_color'] ) ) {
			$styles[] = 'background-color: ' . $params['crosshair_color'];
		}

		return $styles;
	}
}