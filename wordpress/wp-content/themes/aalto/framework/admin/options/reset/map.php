<?php

if ( ! function_exists( 'aalto_edge_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function aalto_edge_reset_options_map() {
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'aalto' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = aalto_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'aalto' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'aalto' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_reset_options_map', 100 );
}