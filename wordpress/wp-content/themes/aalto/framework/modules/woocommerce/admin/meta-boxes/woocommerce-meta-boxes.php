<?php

if(!function_exists('aalto_edge_map_woocommerce_meta')) {
    function aalto_edge_map_woocommerce_meta() {
        $woocommerce_meta_box = aalto_edge_add_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'aalto'),
                'name' => 'woo_product_meta'
            )
        );

        aalto_edge_add_meta_box_field(array(
            'name'        => 'edgtf_product_featured_image_size',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Product List Shortcode', 'aalto'),
            'description' => esc_html__('Choose image layout when it appears in Edge Product List - Masonry layout shortcode', 'aalto'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'edgtf-woo-image-normal-width' => esc_html__('Default', 'aalto'),
                'edgtf-woo-image-large-width'  => esc_html__('Large Width', 'aalto')
            )
        ));

        aalto_edge_add_meta_box_field(
            array(
                'name'          => 'edgtf_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'aalto'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'aalto'),
                'parent'        => $woocommerce_meta_box,
                'options'       => aalto_edge_get_yes_no_select_array()
            )
        );
    }
	
    add_action('aalto_edge_meta_boxes_map', 'aalto_edge_map_woocommerce_meta', 99);
}