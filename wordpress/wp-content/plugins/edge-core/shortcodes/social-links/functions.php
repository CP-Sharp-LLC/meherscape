<?php

if ( ! function_exists( 'edgtf_core_add_social_links_shortcodes' ) ) {
    function edgtf_core_add_social_links_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\SocialLinks\SocialLinks'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'edgtf_core_filter_add_vc_shortcode', 'edgtf_core_add_social_links_shortcodes' );
}

if ( ! function_exists( 'edgtf_core_set_social_links_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for social links shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgtf_core_set_social_links_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-social-links';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'edgtf_core_filter_add_vc_shortcodes_custom_icon_class', 'edgtf_core_set_social_links_icon_class_name_for_vc_shortcodes' );
}


if ( ! function_exists( 'edgtf_core_set_info_boxes_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for image with text shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgtf_core_set_info_boxes_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-info-boxes';
        $shortcodes_icon_class_array[] = '.icon-wpb-info-boxes-item';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'edgtf_core_filter_add_vc_shortcodes_custom_icon_class', 'edgtf_core_set_info_boxes_icon_class_name_for_vc_shortcodes' );
}