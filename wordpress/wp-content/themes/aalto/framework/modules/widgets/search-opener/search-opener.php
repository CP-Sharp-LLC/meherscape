<?php

class AaltoEdgeSearchOpener extends AaltoEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_search_opener',
			esc_html__( 'Edge Search Opener', 'aalto' ),
			array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'aalto' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_size',
				'title'       => esc_html__( 'Icon Size (px)', 'aalto' ),
				'description' => esc_html__( 'Define size for search icon', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_color',
				'title'       => esc_html__( 'Icon Color', 'aalto' ),
				'description' => esc_html__( 'Define color for search icon', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_hover_color',
				'title'       => esc_html__( 'Icon Hover Color', 'aalto' ),
				'description' => esc_html__( 'Define hover color for search icon', 'aalto' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_margin',
				'title'       => esc_html__( 'Icon Margin', 'aalto' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'aalto' )
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'show_label',
				'title'       => esc_html__( 'Enable Search Icon Text', 'aalto' ),
				'description' => esc_html__( 'Enable this option to show search text next to search icon in header', 'aalto' ),
				'options'     => aalto_edge_get_yes_no_select_array()
			)
		);
	}
	
	public function widget( $args, $instance ) {
		global $aalto_edge_options, $aalto_edge_IconCollections;
		
		$search_type_class = 'edgtf-search-opener edgtf-icon-has-hover';
		$styles            = array();
		$show_search_text  = $instance['show_label'] == 'yes' || $aalto_edge_options['enable_search_icon_text'] == 'yes' ? true : false;
		
		if ( ! empty( $instance['search_icon_size'] ) ) {
			$styles[] = 'font-size: ' . intval( $instance['search_icon_size'] ) . 'px';
		}
		
		if ( ! empty( $instance['search_icon_color'] ) ) {
			$styles[] = 'color: ' . $instance['search_icon_color'] . ';';
		}
		
		if ( ! empty( $instance['search_icon_margin'] ) ) {
			$styles[] = 'margin: ' . $instance['search_icon_margin'] . ';';
		}
		?>
		
		<a <?php aalto_edge_inline_attr( $instance['search_icon_hover_color'], 'data-hover-color' ); ?> <?php aalto_edge_inline_style( $styles ); ?> <?php aalto_edge_class_attribute( $search_type_class ); ?> href="javascript:void(0)">
            <span class="edgtf-search-opener-wrapper">
                <?php if ( isset( $aalto_edge_options['search_icon_pack'] ) ) {
	                $aalto_edge_IconCollections->getSearchIcon( $aalto_edge_options['search_icon_pack'], false );
                } ?>
	            <?php if ( $show_search_text ) { ?>
		            <span class="edgtf-search-icon-text"><?php esc_html_e( 'Search', 'aalto' ); ?></span>
	            <?php } ?>
            </span>
		</a>
	<?php }
}