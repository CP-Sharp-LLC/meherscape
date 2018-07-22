<?php

if ( ! function_exists( 'aalto_edge_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function aalto_edge_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-child-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != '' ) {
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_theme_version_class' );
}

if ( ! function_exists( 'aalto_edge_boxed_class' ) ) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function aalto_edge_boxed_class( $classes ) {
		$allow_boxed_layout = true;
		$allow_boxed_layout = apply_filters( 'aalto_edge_allow_content_boxed_layout', $allow_boxed_layout );
		
		if ( $allow_boxed_layout && aalto_edge_get_meta_field_intersect( 'boxed' ) === 'yes' ) {
			$classes[] = 'edgtf-boxed';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_boxed_class' );
}

if ( ! function_exists( 'aalto_edge_paspartu_class' ) ) {
	/**
	 * Function that adds classes on body for paspartu layout
	 */
	function aalto_edge_paspartu_class( $classes ) {
		$id = aalto_edge_get_page_id();
		
		//is paspartu layout turned on?
		if ( aalto_edge_get_meta_field_intersect( 'paspartu', $id ) === 'yes' ) {
			$classes[] = 'edgtf-paspartu-enabled';
			
			if ( aalto_edge_get_meta_field_intersect( 'disable_top_paspartu', $id ) === 'yes' ) {
				$classes[] = 'edgtf-top-paspartu-disabled';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_paspartu_class' );
}

if ( ! function_exists( 'aalto_edge_page_smooth_scroll_class' ) ) {
	/**
	 * Function that adds classes on body for page smooth scroll
	 */
	function aalto_edge_page_smooth_scroll_class( $classes ) {
		//is smooth scroll enabled enabled?
		if ( aalto_edge_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' ) {
			$classes[] = 'edgtf-smooth-scroll';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_page_smooth_scroll_class' );
}

if ( ! function_exists( 'aalto_edge_smooth_page_transitions_class' ) ) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function aalto_edge_smooth_page_transitions_class( $classes ) {
		$id = aalto_edge_get_page_id();
		
		if ( aalto_edge_get_meta_field_intersect( 'smooth_page_transitions', $id ) == 'yes' ) {
			$classes[] = 'edgtf-smooth-page-transitions';
			
			if ( aalto_edge_get_meta_field_intersect( 'page_transition_preloader', $id ) == 'yes' ) {
				$classes[] = 'edgtf-smooth-page-transitions-preloader';
			}
			
			if ( aalto_edge_get_meta_field_intersect( 'page_transition_fadeout', $id ) == 'yes' ) {
				$classes[] = 'edgtf-smooth-page-transitions-fadeout';
			}
			
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_smooth_page_transitions_class' );
}

if ( ! function_exists( 'aalto_edge_content_initial_width_body_class' ) ) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function aalto_edge_content_initial_width_body_class( $classes ) {
		$initial_content_width = aalto_edge_get_meta_field_intersect( 'initial_content_width', aalto_edge_get_page_id() );
		
		if ( ! empty( $initial_content_width ) ) {
			$classes[] = $initial_content_width;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_content_initial_width_body_class' );
}

if ( ! function_exists( 'aalto_edge_set_content_behind_header_class' ) ) {
	function aalto_edge_set_content_behind_header_class( $classes ) {
		$id = aalto_edge_get_page_id();
		
		if ( get_post_meta( $id, 'edgtf_page_content_behind_header_meta', true ) === 'yes' ) {
			$classes[] = 'edgtf-content-is-behind-header';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'aalto_edge_set_content_behind_header_class' );
}

if(!function_exists('aalto_edge_slide_to_content')) {
    /**
     * Function that adds classes on body for one scroll slide to content
     */
    function aalto_edge_slide_to_content($classes) {
        $id =  aalto_edge_get_page_id();

        if(get_post_meta($id, 'edgtf_page_scroll_to_content_meta', true) == 'yes' && get_post_meta($id, 'edgtf_page_slider_meta', true) !== '') {
            $classes[] = 'edgtf-scroll-to-content';
        }

        return $classes;
    }

    add_filter('body_class', 'aalto_edge_slide_to_content');
}