<?php

class AaltoEdgeSeparatorWidget extends AaltoEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_separator_widget',
			esc_html__( 'Edge Separator Widget', 'aalto' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'aalto' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'aalto' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'aalto' ),
					'full-width' => esc_html__( 'Full Width', 'aalto' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'aalto' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'aalto' ),
					'left'   => esc_html__( 'Left', 'aalto' ),
					'right'  => esc_html__( 'Right', 'aalto' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'aalto' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'aalto' ),
					'dashed' => esc_html__( 'Dashed', 'aalto' ),
					'dotted' => esc_html__( 'Dotted', 'aalto' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'aalto' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget edgtf-separator-widget">';
			echo do_shortcode( "[edgtf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}