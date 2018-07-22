<?php

class AaltoEdgeRawHTMLWidget extends AaltoEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_raw_html_widget',
			esc_html__( 'Edge Raw HTML Widget', 'aalto' ),
			array( 'description' => esc_html__( 'Add raw HTML holder to widget areas', 'aalto' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Extra Class Name', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'aalto' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'widget_grid',
				'title'   => esc_html__( 'Widget Grid', 'aalto' ),
				'options' => array(
					''     => esc_html__( 'Full Width', 'aalto' ),
					'auto' => esc_html__( 'Auto', 'aalto' )
				)
			),
			array(
				'type'  => 'textarea',
				'name'  => 'content',
				'title' => esc_html__( 'Content', 'aalto' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$extra_class   = array();
		$extra_class[] = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$extra_class[] = ! empty( $instance['widget_grid'] ) && $instance['widget_grid'] === 'auto' ? 'edgtf-grid-auto-width' : '';
		?>
		
		<div class="widget edgtf-raw-html-widget <?php echo esc_attr( implode( ' ', $extra_class ) ); ?>">
			<?php
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			if ( ! empty( $instance['content'] ) ) {
				echo wp_kses_post( $instance['content'] );
			}
			?>
		</div>
		<?php
	}
}