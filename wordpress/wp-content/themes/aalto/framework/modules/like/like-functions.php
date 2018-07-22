<?php

if ( ! function_exists( 'aalto_edge_like' ) ) {
	/**
	 * Returns AaltoEdgeLike instance
	 *
	 * @return AaltoEdgeLike
	 */
	function aalto_edge_like() {
		return AaltoEdgeLike::get_instance();
	}
}

function aalto_edge_get_like() {
	
	echo wp_kses( aalto_edge_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}