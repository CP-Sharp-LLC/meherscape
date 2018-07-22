<?php

if ( ! function_exists( 'aalto_edge_register_simple_social_links_widget' ) ) {
    /**
     * Function that register simple social links widget
     */
    function aalto_edge_register_simple_social_links_widget( $widgets ) {
        $widgets[] = 'AaltoEdgeSimpleSocialLinksWidget';

        return $widgets;
    }

    add_filter( 'aalto_edge_register_widgets', 'aalto_edge_register_simple_social_links_widget' );
}