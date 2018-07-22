<?php

/*** Child Theme Function  ***/

function aalto_edge_child_theme_enqueue_scripts() {
	
	$parent_style = 'aalto_edge_default_style';
	
	wp_enqueue_style('aalto_edge_child_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action( 'wp_enqueue_scripts', 'aalto_edge_child_theme_enqueue_scripts' );