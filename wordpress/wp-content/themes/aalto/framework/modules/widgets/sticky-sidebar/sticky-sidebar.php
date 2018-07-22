<?php
class AaltoEdgeStickySidebar extends AaltoEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_sticky_sidebar',
			esc_html__('Edge Sticky Sidebar Widget', 'aalto'),
			array( 'description' => esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar.', 'aalto'))
		);
		
		$this->setParams();
	}
	
	protected function setParams() {}
	
	public function widget( $args, $instance ) {
		echo '<div class="widget edgtf-widget-sticky-sidebar"></div>';
	}
}
