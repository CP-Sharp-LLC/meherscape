<?php

class AaltoEdgeSideAreaOpener extends AaltoEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_side_area_opener',
			esc_html__( 'Edge Side Area Opener', 'aalto' ),
			array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'aalto' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__( 'Side Area Opener Color', 'aalto' ),
				'description' => esc_html__( 'Define color for side area opener', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__( 'Side Area Opener Hover Color', 'aalto' ),
				'description' => esc_html__( 'Define hover color for side area opener', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__( 'Side Area Opener Margin', 'aalto' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'aalto' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Side Area Opener Title', 'aalto' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$holder_styles = array();
		
		if ( ! empty( $instance['icon_color'] ) ) {
			$holder_styles[] = 'color: ' . $instance['icon_color'] . ';';
		}
		if ( ! empty( $instance['widget_margin'] ) ) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		
		<a class="edgtf-side-menu-button-opener edgtf-icon-has-hover" <?php echo aalto_edge_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ); ?> href="javascript:void(0)" <?php aalto_edge_inline_style( $holder_styles ); ?>>
			<span class="edgtf-side-menu-icon">
        		<span class="edgtf-line"></span>
				<span class="edgtf-line"></span>
				<span class="edgtf-line"></span>
        	</span>
		</a>
	<?php }
}