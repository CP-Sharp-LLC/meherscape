<?php

namespace EdgeCore\CPT\Shortcodes\VideoButton;

use EdgeCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_video_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Video Button', 'edge-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'                      => 'icon-wpb-video-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'video_link',
							'heading'    => esc_html__( 'Video Link', 'edge-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image',
							'heading'     => esc_html__( 'Video Image', 'edge-core' ),
							'description' => esc_html__( 'Select image from media library', 'edge-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'play_button_color',
							'heading'    => esc_html__( 'Play Button Color', 'edge-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'play_button_size',
							'heading'    => esc_html__( 'Play Button Size (px)', 'edge-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_image',
							'heading'     => esc_html__( 'Play Button Custom Image', 'edge-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'edge-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_hover_image',
							'heading'     => esc_html__( 'Play Button Custom Hover Image', 'edge-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'edge-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_size'        => '',
			'play_button_image'       => '',
			'play_button_hover_image' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['play_button_styles'] = $this->getPlayButtonStyles( $params );
		
		$html = edgtf_core_get_shortcode_module_template_part( 'templates/video-button', 'video-button', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getPlayButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['play_button_color'] ) ) {
			$styles[] = 'color: ' . $params['play_button_color'];
		}
		
		if ( ! empty( $params['play_button_size'] ) ) {
			$styles[] = 'font-size: ' . aalto_edge_filter_px( $params['play_button_size'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}