<?php

class AaltoEdgeButtonWidget extends AaltoEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_button_widget',
			esc_html__( 'Edge Button Widget', 'aalto' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'aalto' ) )
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
					'solid'   => esc_html__( 'Solid', 'aalto' ),
					'outline' => esc_html__( 'Outline', 'aalto' ),
					'simple'  => esc_html__( 'Simple', 'aalto' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'aalto' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'aalto' ),
					'medium' => esc_html__( 'Medium', 'aalto' ),
					'large'  => esc_html__( 'Large', 'aalto' ),
					'huge'   => esc_html__( 'Huge', 'aalto' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'aalto' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'aalto' ),
				'default' => esc_html__( 'Button Text', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'aalto' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'aalto' ),
				'options' => aalto_edge_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'aalto' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'aalto' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'aalto' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'aalto' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'aalto' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'aalto' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget edgtf-button-widget">';
			echo do_shortcode( "[edgtf_button $params]" ); // XSS OK
		echo '</div>';
	}
}