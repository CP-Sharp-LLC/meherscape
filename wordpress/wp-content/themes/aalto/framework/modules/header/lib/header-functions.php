<?php
use AaltoEdge\Modules\Header\Lib;

if(!function_exists('aalto_edge_get_header_type_options')) {
	/**
	 * This function collect all header types values and forward them to header factory file for further processing
	 */
	function aalto_edge_get_header_type_options() {
		do_action('aalto_edge_before_header_function_init');
		
		$header_types_option = apply_filters('aalto_edge_register_header_type_class', $header_types_option = array());
		
		return $header_types_option;
	}
}

if(!function_exists('aalto_edge_set_default_logo_height_for_header_types')) {
	/**
	 * This function set default logo area height for header types
	 */
	function aalto_edge_set_default_logo_height_for_header_types() {
		$logo_height_meta = aalto_edge_filter_px( aalto_edge_options()->getOptionValue( 'logo_area_height' ) );
		$logo_height      = !empty($logo_height_meta) ? intval( $logo_height_meta ) : 116;
		
		return apply_filters('aalto_edge_set_default_logo_height_value_for_header_types', $logo_height);
	}
}

if(!function_exists('aalto_edge_set_default_menu_height_for_header_types')) {
	/**
	 * This function set default menu area height for header types
	 */
	function aalto_edge_set_default_menu_height_for_header_types() {
		$menu_height_meta = aalto_edge_filter_px( aalto_edge_options()->getOptionValue( 'menu_area_height' ) );
		$menu_height      = !empty($menu_height_meta) ? intval( $menu_height_meta ) : 116;
		
		return apply_filters('aalto_edge_set_default_menu_height_value_for_header_types', $menu_height);
	}
}

if(!function_exists('aalto_edge_set_default_mobile_menu_height_for_header_types')) {
	/**
	 * This function set default mobile menu area height for header types
	 */
	function aalto_edge_set_default_mobile_menu_height_for_header_types() {
		$mobile_menu_height_meta = aalto_edge_filter_px( aalto_edge_options()->getOptionValue( 'mobile_header_height' ) );
		$mobile_menu_height      = !empty($mobile_menu_height_meta) ? intval( $mobile_menu_height_meta ) : 70;
		
		return apply_filters('aalto_edge_set_default_mobile_menu_height_value_for_header_types', $mobile_menu_height);
	}
}

if(!function_exists('aalto_edge_set_header_object')) {
	/**
	 * This function is used to instance header type object
	 */
    function aalto_edge_set_header_object() {
    	$header_type = aalto_edge_get_meta_field_intersect('header_type', aalto_edge_get_page_id());
	    $header_types_option = aalto_edge_get_header_type_options();
	    
        $object = Lib\HeaderFactory::getInstance()->build($header_type, $header_types_option);

        if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
            $header_connector = new Lib\AaltoEdgeHeaderConnector($object);
            $header_connector->connect($object->getConnectConfig());
        }
    }

    add_action('wp', 'aalto_edge_set_header_object', 1);
}