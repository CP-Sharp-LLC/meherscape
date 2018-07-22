<?php

if ( ! function_exists( 'aalto_edge_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function aalto_edge_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'aalto' );

        return $search_type_options;
    }

    add_filter( 'aalto_edge_search_type_global_option', 'aalto_edge_set_search_fullscreen_global_option' );
}