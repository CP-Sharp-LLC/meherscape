<?php
namespace EdgeCore\CPT\Shortcodes\Separator;

use EdgeCore\Lib;

class Separator implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_separator';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Edge Separator', 'edge-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'                    => 'icon-wpb-separator extended-custom-icon',
					'show_settings_on_create' => true,
					'class'                   => 'wpb_vc_separator',
					'custom_markup'           => '<div></div>',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'type',
							'heading'    => esc_html__( 'Type', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Normal', 'edge-core' )     => 'normal',
								esc_html__( 'Full Width', 'edge-core' ) => 'full-width',
                                esc_html__( 'Vertical', 'edge-core' ) => 'vertical'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'position',
							'heading'    => esc_html__( 'Position', 'edge-core' ),
							'value'      => array(
								esc_html__( 'Center', 'edge-core' ) => 'center',
								esc_html__( 'Left', 'edge-core' )   => 'left',
								esc_html__( 'Right', 'edge-core' )  => 'right'
							),
							'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'edge-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'border_style',
							'heading'     => esc_html__( 'Style', 'edge-core' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-core' ) => '',
								esc_html__( 'Dashed', 'edge-core' )  => 'dashed',
								esc_html__( 'Solid', 'edge-core' )   => 'solid',
								esc_html__( 'Dotted', 'edge-core' )  => 'dotted'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'width',
							'heading'    => esc_html__( 'Width (px or %)', 'edge-core' ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'height',
                            'heading'    => esc_html__( 'Height (px or %)', 'edge-core' ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'vertical' ) )
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'thickness',
							'heading'    => esc_html__( 'Thickness (px)', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'top_margin',
							'heading'    => esc_html__( 'Top Margin (px or %)', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_margin',
							'heading'    => esc_html__( 'Bottom Margin (px or %)', 'edge-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'  => '',
			'type'          => '',
			'position'      => 'center',
			'color'         => '',
			'border_style'  => '',
			'width'         => '',
            'height'        => '',
			'thickness'     => '',
			'top_margin'    => '',
			'bottom_margin' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		
		$html = edgtf_core_get_shortcode_module_template_part( 'templates/separator-template', 'separator', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['position'] ) ? 'edgtf-separator-' . $params['position'] : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-separator-' . $params['type'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( $params['color'] !== '' ) {
			$styles[] = 'border-color: ' . $params['color'];
		}
		
		if ( $params['border_style'] !== '' ) {
			$styles[] = 'border-style: ' . $params['border_style'];
		}
		
		if ( $params['width'] !== '' ) {
			if ( aalto_edge_string_ends_with( $params['width'], '%' ) || aalto_edge_string_ends_with( $params['width'], 'px' ) ) {
				$styles[] = 'width: ' . $params['width'];
			} else {
				$styles[] = 'width: ' . aalto_edge_filter_px( $params['width'] ) . 'px';
			}
		}

        if ( $params['height'] !== '' ) {
            if ( aalto_edge_string_ends_with( $params['height'], '%' ) || aalto_edge_string_ends_with( $params['height'], 'px' ) ) {
                $styles[] = 'height: ' . $params['height'];
            } else {
                $styles[] = 'height: ' . aalto_edge_filter_px( $params['height'] ) . 'px';
            }
        }
		
		if ( $params['thickness'] !== '' ) {

		    if($params['type'] !== 'vertical') {
                $styles[] = 'border-bottom-width: ' . aalto_edge_filter_px( $params['thickness'] ) . 'px';
            } else {
                $styles[] = 'border-left-width: ' . aalto_edge_filter_px( $params['thickness'] ) . 'px';
            }
		}
		
		if ( $params['top_margin'] !== '' ) {
			if ( aalto_edge_string_ends_with( $params['top_margin'], '%' ) || aalto_edge_string_ends_with( $params['top_margin'], 'px' ) ) {
				$styles[] = 'margin-top: ' . $params['top_margin'];
			} else {
				$styles[] = 'margin-top: ' . aalto_edge_filter_px( $params['top_margin'] ) . 'px';
			}
		}
		
		if ( $params['bottom_margin'] !== '' ) {
			if ( aalto_edge_string_ends_with( $params['bottom_margin'], '%' ) || aalto_edge_string_ends_with( $params['bottom_margin'], 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $params['bottom_margin'];
			} else {
				$styles[] = 'margin-bottom: ' . aalto_edge_filter_px( $params['bottom_margin'] ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
}
