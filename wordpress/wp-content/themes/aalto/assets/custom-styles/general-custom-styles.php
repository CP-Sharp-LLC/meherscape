<?php

if(!function_exists('aalto_edge_design_styles')) {
    /**
     * Generates general custom styles
     */
    function aalto_edge_design_styles() {
	    $font_family = aalto_edge_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && aalto_edge_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo aalto_edge_dynamic_css( $font_family_selector, array( 'font-family' => aalto_edge_get_font_option_val( $font_family ) ) );
	    }

		$first_main_color = aalto_edge_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
                'a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                '.edgtf-comment-holder .edgtf-comment-text .comment-edit-link:hover',
                '.edgtf-comment-holder .edgtf-comment-text .comment-reply-link:hover',
                '.edgtf-comment-holder .edgtf-comment-text .replay:hover',
                '.edgtf-comment-holder .edgtf-comment-text #cancel-comment-reply-link:hover',
                '.edgtf-owl-slider .owl-nav .owl-next:hover',
                '.edgtf-owl-slider .owl-nav .owl-prev:hover',
                'footer .widget ul li a:hover',
                'footer .widget #wp-calendar tfoot a:hover',
                'footer .widget.widget_search .input-holder button:hover',
                '.edgtf-side-menu .widget ul li a:hover',
                '.edgtf-side-menu .widget #wp-calendar tfoot a:hover',
                '.edgtf-side-menu .widget.widget_search .input-holder button:hover',
                '.wpb_widgetised_column .widget.widget_search .input-holder button:hover',
                'aside.edgtf-sidebar .widget.widget_search .input-holder button:hover',
                '.widget.widget_rss .edgtf-widget-title .rsswidget:hover',
                '.widget.widget_search button:hover',
                '.edgtf-page-footer .widget a:hover',
                '.edgtf-side-menu .widget a:hover',
                '.edgtf-page-footer .widget.widget_rss .edgtf-footer-widget-title .rsswidget:hover',
                '.edgtf-side-menu .widget.widget_rss .edgtf-footer-widget-title .rsswidget:hover',
                '.edgtf-page-footer .widget.widget_search button:hover',
                '.edgtf-side-menu .widget.widget_search button:hover',
                '.edgtf-page-footer .widget.widget_tag_cloud a:hover',
                '.edgtf-side-menu .widget.widget_tag_cloud a:hover',
                '.widget.widget_search .input-holder button:hover',
                '.widget.widget_edgtf_twitter_widget .edgtf-twitter-widget.edgtf-twitter-slider li .edgtf-tweet-text a:hover',
                '.widget.widget_edgtf_twitter_widget .edgtf-twitter-widget.edgtf-twitter-standard li .edgtf-tweet-text a:hover',
                'body .pp_pic_holder a.pp_arrow_next:hover',
                'body .pp_pic_holder a.pp_arrow_previous:hover',
                'body .pp_pic_holder a.pp_close:hover',
                '.edgtf-main-menu .menu-item-language .submenu-languages a:hover',
                '.edgtf-blog-holder article .edgtf-post-info-top>div a:hover',
                '.edgtf-author-description .edgtf-author-description-text-holder .edgtf-author-name a:hover',
                '.edgtf-author-description .edgtf-author-description-text-holder .edgtf-author-social-icons a:hover',
                '.edgtf-bl-standard-pagination ul li.edgtf-bl-pag-active a',
                '.edgtf-blog-pagination ul li a.edgtf-pag-active',
                '.edgtf-blog-single-navigation .edgtf-blog-single-next:hover',
                '.edgtf-blog-single-navigation .edgtf-blog-single-prev:hover',
                '.edgtf-blog-list-holder .edgtf-bli-info>div a:hover',
                '.edgtf-blog-list-holder.edgtf-bl-minimal .edgtf-post-info-date a:hover',
                '.edgtf-blog-list-holder.edgtf-bl-simple .edgtf-bli-content .edgtf-post-info-date a:hover',
                '.edgtf-main-menu ul li a:hover',
                '.edgtf-main-menu>ul>li.edgtf-active-item>a',
                '.edgtf-drop-down .second .inner ul li.current-menu-ancestor>a',
                '.edgtf-drop-down .second .inner ul li.current-menu-item>a',
                '.edgtf-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a',
                '.edgtf-drop-down .wide .second .inner>ul>li.current-menu-item>a',
                '.edgtf-header-vertical .edgtf-vertical-menu ul li a:hover',
                '.edgtf-header-vertical .edgtf-vertical-menu ul li.current-menu-ancestor>a',
                '.edgtf-header-vertical .edgtf-vertical-menu ul li.current-menu-item>a',
                '.edgtf-header-vertical .edgtf-vertical-menu ul li.current_page_item>a',
                '.edgtf-header-vertical .edgtf-vertical-menu ul li.edgtf-active-item>a',
                '.edgtf-light-header .edgtf-page-header>div:not(.edgtf-sticky-header):not(.fixed) .edgtf-fullscreen-menu-opener.edgtf-fm-opened',
                'nav.edgtf-fullscreen-menu ul li ul li.current-menu-ancestor>a',
                'nav.edgtf-fullscreen-menu ul li ul li.current-menu-item>a',
                'nav.edgtf-fullscreen-menu>ul>li.edgtf-active-item>a',
                '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid>ul>li.edgtf-active-item>a',
                '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid>ul>li.edgtf-active-item>h6',
                '.edgtf-mobile-header .edgtf-mobile-nav ul li a:hover',
                '.edgtf-mobile-header .edgtf-mobile-nav ul li h6:hover',
                '.edgtf-mobile-header .edgtf-mobile-nav ul ul li.current-menu-ancestor>a',
                '.edgtf-mobile-header .edgtf-mobile-nav ul ul li.current-menu-ancestor>h6',
                '.edgtf-mobile-header .edgtf-mobile-nav ul ul li.current-menu-item>a',
                '.edgtf-mobile-header .edgtf-mobile-nav ul ul li.current-menu-item>h6',
                '.edgtf-search-page-holder .edgtf-search-page-form .edgtf-form-holder .edgtf-search-submit:hover',
                '.edgtf-search-cover .edgtf-search-close a:hover',
                '.edgtf-fullscreen-search-holder .edgtf-search-submit:hover',
                '.edgtf-slide-from-header-bottom-holder .edgtf-form-holder .edgtf-search-submit:hover',
                '.edgtf-side-menu-button-opener:hover',
                '.edgtf-title-holder.edgtf-breadcrumbs-type .edgtf-breadcrumbs a:hover',
                '.edgtf-title-holder.edgtf-standard-with-breadcrumbs-type .edgtf-breadcrumbs a:hover',
                '.edgtf-ptf-list-showcase-meta-item.active .edgtf-portfolio-list-holder.edgtf-pl-scrollable .edgtf-ptf-meta-item-title a:hover',
                '.edgtf-pl-standard-pagination ul li.edgtf-pl-pag-active a',
                '.edgtf-portfolio-list-holder.edgtf-pl-gallery-info-bottom.edgtf-pl-skin-light .edgtf-pli-text .edgtf-pli-category-holder a:hover',
                '.edgtf-portfolio-list-holder.edgtf-pl-gallery-info-center.edgtf-pl-skin-light .edgtf-pli-text .edgtf-pli-category-holder a:hover',
                '.edgtf-portfolio-list-holder.edgtf-pl-gallery-shader-info.edgtf-pl-skin-light .edgtf-pli-text .edgtf-pli-category-holder a:hover',
                '.edgtf-team.info-hover .edgtf-icon-shortcode .edgtf-icon-element:hover',
                '.edgtf-team-single-holder .edgtf-position .edgtf-icon-shortcode a:hover',
                '.edgtf-team-single-holder .edgtf-position .edgtf-icon-shortcode i:hover',
                '.edgtf-team-single-holder .edgtf-position .edgtf-icon-shortcode span:hover',
                '.edgtf-full-screen-image-slider .edgtf-fsis-slider .owl-dots .owl-dot.active',
                '.edgtf-full-screen-image-slider .edgtf-fsis-slider .owl-dots .owl-dot:hover',
                '.edgtf-social-share-holder.edgtf-list li a:hover',
                '.edgtf-social-share-holder.edgtf-dropdown .edgtf-social-share-dropdown-opener:hover',
                '.edgtf-tabs.edgtf-tabs-simple .edgtf-tabs-nav li.ui-state-active a',
                '.edgtf-tabs.edgtf-tabs-simple .edgtf-tabs-nav li.ui-state-hover a',
                '.edgtf-tabs.edgtf-tabs-vertical .edgtf-tabs-nav li.ui-state-active a',
                '.edgtf-tabs.edgtf-tabs-vertical .edgtf-tabs-nav li.ui-state-hover a',
                '.edgtf-twitter-list-holder.edgtf-twitter-list-boxed .edgtf-tweet-text a:hover',
                '.edgtf-twitter-list-holder.edgtf-twitter-list-boxed .edgtf-twitter-profile a:hover',
            );

            $woo_color_selector = array();
            if(aalto_edge_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.edgtf-woocommerce-page table.cart tr.cart_item td.product-remove a:hover',
                    '.edgtf-woocommerce-page .woocommerce-error>a:hover',
                    '.edgtf-woocommerce-page .woocommerce-info>a:hover',
                    '.edgtf-woocommerce-page .woocommerce-message>a:hover',
                    '.edgtf-woocommerce-page .woocommerce-info .showcoupon:hover',
                    '.woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-minus:hover',
                    '.woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-plus:hover',
                    'div.woocommerce .edgtf-quantity-buttons .edgtf-quantity-minus:hover',
                    'div.woocommerce .edgtf-quantity-buttons .edgtf-quantity-plus:hover',
                    '.edgtf-woocommerce-page .edgtf-content table.group_table a:hover',
                    '.edgtf-woo-single-page .edgtf-single-product-summary .product_meta>span a:hover',
                    '.edgtf-woo-single-page .edgtf-single-product-summary .product_meta>span span:hover',
                    '.edgtf-woo-single-page .edgtf-single-product-summary .edgtf-woo-social-share-holder .edgtf-social-share-holder.edgtf-list ul li a:hover',
                    '.widget.woocommerce.widget_product_search .woocommerce-product-search button:hover',
                    '.edgtf-product-info .edgtf-pi-add-to-cart .edgtf-btn.edgtf-btn-solid.edgtf-dark-skin:hover',
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

	        $color_important_selector = array(
                '.edgtf-btn.edgtf-btn-simple:not(.edgtf-btn-custom-hover-color):hover',
	        );

            $background_color_selector = array(
                '.edgtf-st-loader .pulse',
                '.edgtf-st-loader .double_pulse .double-bounce1',
                '.edgtf-st-loader .double_pulse .double-bounce2',
                '.edgtf-st-loader .cube',
                '.edgtf-st-loader .rotating_cubes .cube1',
                '.edgtf-st-loader .rotating_cubes .cube2',
                '.edgtf-st-loader .stripes>div',
                '.edgtf-st-loader .wave>div',
                '.edgtf-st-loader .two_rotating_circles .dot1',
                '.edgtf-st-loader .two_rotating_circles .dot2',
                '.edgtf-st-loader .five_rotating_circles .container1>div',
                '.edgtf-st-loader .five_rotating_circles .container2>div',
                '.edgtf-st-loader .five_rotating_circles .container3>div',
                '.edgtf-st-loader .atom .ball-1:before',
                '.edgtf-st-loader .atom .ball-2:before',
                '.edgtf-st-loader .atom .ball-3:before',
                '.edgtf-st-loader .atom .ball-4:before',
                '.edgtf-st-loader .clock .ball:before',
                '.edgtf-st-loader .mitosis .ball',
                '.edgtf-st-loader .lines .line1',
                '.edgtf-st-loader .lines .line2',
                '.edgtf-st-loader .lines .line3',
                '.edgtf-st-loader .lines .line4',
                '.edgtf-st-loader .fussion .ball',
                '.edgtf-st-loader .fussion .ball-1',
                '.edgtf-st-loader .fussion .ball-2',
                '.edgtf-st-loader .fussion .ball-3',
                '.edgtf-st-loader .fussion .ball-4',
                '.edgtf-st-loader .wave_circles .ball',
                '.edgtf-st-loader .pulse_circles .ball',
                '.edgtf-comment-form #submit_comment:hover',
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.edgtf-owl-slider .owl-dots .owl-dot.active span',
                '.edgtf-owl-slider .owl-dots .owl-dot:hover span',
                '#edgtf-back-to-top>span:not(.edgtf-btn-lines):hover',
                '.edgtf-dropcaps.edgtf-circle',
                '.edgtf-dropcaps.edgtf-square',
                '.edgtf-icon-shortcode.edgtf-circle',
                '.edgtf-icon-shortcode.edgtf-dropcaps.edgtf-circle',
                '.edgtf-icon-shortcode.edgtf-square',
                '.edgtf-process-holder .edgtf-process-circle',
                '.edgtf-process-holder .edgtf-process-line',
                '#multiscroll-nav ul li a.active',
            );

            $woo_background_color_selector = array();
            if(aalto_edge_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-page .edgtf-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    '.woocommerce-page .edgtf-content a.added_to_cart:hover',
                    '.woocommerce-page .edgtf-content a.button:hover',
                    '.woocommerce-page .edgtf-content button[type=submit]:not(.edgtf-woo-search-widget-button):hover',
                    '.woocommerce-page .edgtf-content input[type=submit]:hover',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    'div.woocommerce a.added_to_cart:hover',
                    'div.woocommerce a.button:hover',
                    'div.woocommerce button[type=submit]:not(.edgtf-woo-search-widget-button):hover',
                    'div.woocommerce input[type=submit]:hover',
                    '.edgtf-plc-holder .edgtf-plc-item .edgtf-plc-add-to-cart.edgtf-default-skin .added_to_cart:hover',
                    '.edgtf-plc-holder .edgtf-plc-item .edgtf-plc-add-to-cart.edgtf-default-skin .button:hover',
                    '.edgtf-plc-holder .edgtf-plc-item .edgtf-plc-add-to-cart.edgtf-dark-skin .added_to_cart:hover',
                    '.edgtf-plc-holder .edgtf-plc-item .edgtf-plc-add-to-cart.edgtf-dark-skin .button:hover',
                    '.edgtf-plc-holder .edgtf-plc-item .edgtf-plc-add-to-cart.edgtf-light-skin .added_to_cart:hover',
                    '.edgtf-plc-holder .edgtf-plc-item .edgtf-plc-add-to-cart.edgtf-light-skin .button:hover',
                    '.edgtf-pl-holder .edgtf-pli-inner .edgtf-pli-text-inner .edgtf-pli-add-to-cart.edgtf-dark-skin .added_to_cart:hover',
                    '.edgtf-pl-holder .edgtf-pli-inner .edgtf-pli-text-inner .edgtf-pli-add-to-cart.edgtf-dark-skin .button:hover',
                    '.edgtf-pl-holder .edgtf-pli-inner .edgtf-pli-text-inner .edgtf-pli-add-to-cart.edgtf-light-skin .added_to_cart:hover',
                    '.edgtf-pl-holder .edgtf-pli-inner .edgtf-pli-text-inner .edgtf-pli-add-to-cart.edgtf-light-skin .button:hover',
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $background_color_important_selector = array(
                '.edgtf-404-page .edgtf-page-not-found .edgtf-btn.edgtf-btn-light-style .edgtf-btn-lines',
                '.edgtf-404-page .edgtf-page-not-found .edgtf-btn.edgtf-btn-light-style:hover',
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-with-crosshair):not(.edgtf-btn-custom-hover-bg):hover',
                '.edgtf-price-table .edgtf-pt-inner ul li.edgtf-pt-button .edgtf-btn:hover',
            );

            $border_color_selector = array(
                '.edgtf-st-loader .pulse_circles .ball',
                '.edgtf-owl-slider .owl-dots .owl-dot.active span',
                '.edgtf-owl-slider .owl-dots .owl-dot:hover span',
                '#edgtf-back-to-top>span:not(.edgtf-btn-lines)',
                '#edgtf-back-to-top>span:not(.edgtf-btn-lines):hover',
                '.select2-container--default .select2-search--dropdown .select2-search__field:focus',
                '#multiscroll-nav ul li a.active',
                '.woocommerce-page .edgtf-content input[type=email]:focus',
                '.woocommerce-page .edgtf-content input[type=tel]:focus',
                '.woocommerce-page .edgtf-content input[type=password]:focus',
                '.woocommerce-page .edgtf-content input[type=text]:focus',
                '.woocommerce-page .edgtf-content textarea:focus',
                'div.woocommerce input[type=email]:focus',
                'div.woocommerce input[type=tel]:focus',
                'div.woocommerce input[type=password]:focus',
                'div.woocommerce input[type=text]:focus',
                'div.woocommerce textarea:focus',
            );

            $border_color_important_selector = array(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-with-crosshair):not(.edgtf-btn-custom-border-hover):hover',
            );

            echo aalto_edge_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo aalto_edge_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo aalto_edge_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
            echo aalto_edge_dynamic_css($background_color_important_selector, array('background-color' => $first_main_color.'!important'));
	        echo aalto_edge_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
            echo aalto_edge_dynamic_css($border_color_important_selector, array('border-color' => $first_main_color.'!important'));
        }
	
	    $page_background_color = aalto_edge_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
			    'body',
			    '.edgtf-content',
			    '.edgtf-container'
		    );
		    echo aalto_edge_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }
	
	    $selection_color = aalto_edge_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo aalto_edge_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo aalto_edge_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }

	    $pattern_background_styles = array();
        if ( aalto_edge_options()->getOptionValue( 'default_pattern_image' ) !== "" ) {
            $pattern_background_styles['background-image'] = 'url(' . aalto_edge_options()->getOptionValue( 'default_pattern_image' ) . ') !important';
            $pattern_background_selector = array (
                '.edgtf-comment-form #submit_comment',
                '.edgtf-custom-form input.wpcf7-submit',
                '.edgtf-blog-holder.edgtf-blog-single article.format-link .edgtf-post-content',
                '.edgtf-blog-holder.edgtf-blog-single article.format-quote .edgtf-post-content',
                '.edgtf-blog-holder article.format-link',
                '.edgtf-blog-holder article.format-quote',
                '.edgtf-bl-alternating .edgtf-bli-content',
                '.edgtf-portfolio-list-holder.edgtf-pl-scrollable.edgtf-ptf-hovered .edgtf-ptf-list-showcase-preview-item a:after',
                '.edgtf-portfolio-project-info .edgtf-portfolio-project-info-aalto-type .edgtf-ppi-table-holder:after',
                '.edgtf-ps-navigation',
                '.edgtf-team.info-hover .edgtf-team-bg',
                '.edgtf-testimonials .edgtf-testimonial-text-holder .edgtf-testimonial-title',
                '.edgtf-price-table .edgtf-pt-inner ul li.edgtf-pt-prices',
                '.edgtf-price-table .edgtf-pt-inner ul li.edgtf-pt-button .edgtf-btn',
                '.edgtf-tabs.edgtf-tabs-standard .edgtf-tabs-nav li.ui-state-active a',
                '.edgtf-tabs.edgtf-tabs-standard .edgtf-tabs-nav li.ui-state-hover a',
                '.edgtf-tabs.edgtf-tabs-boxed .edgtf-tabs-nav li.ui-state-active a',
                '.edgtf-tabs.edgtf-tabs-boxed .edgtf-tabs-nav li.ui-state-hover a',
                '.edgtf-woo-single-page .woocommerce-tabs ul.tabs > li:hover a',
                '.edgtf-woo-single-page .woocommerce-tabs ul.tabs > li.active a',
                '.woocommerce-page .edgtf-content a.button',
                '.woocommerce-page .edgtf-content a.added_to_cart',
                '.woocommerce-page .edgtf-content input[type="submit"]',
                '.woocommerce-page .edgtf-content button[type="submit"]:not(.edgtf-woo-search-widget-button)',
                '.woocommerce-page .edgtf-content .wc-forward:not(.added_to_cart):not(.checkout-button)',
                'div.woocommerce a.button',
                'div.woocommerce a.added_to_cart',
                'div.woocommerce input[type="submit"]',
                'div.woocommerce button[type="submit"]:not(.edgtf-woo-search-widget-button)',
                'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button)',
            );

            echo aalto_edge_dynamic_css( $pattern_background_selector, $pattern_background_styles );
        }
	
	    $preload_background_styles = array();
	
	    if ( aalto_edge_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . aalto_edge_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }
	
	    echo aalto_edge_dynamic_css( '.edgtf-preload-background', $preload_background_styles );
    }

    add_action('aalto_edge_style_dynamic', 'aalto_edge_design_styles');
}

if ( ! function_exists( 'aalto_edge_content_styles' ) ) {
	function aalto_edge_content_styles() {
		$content_style = array();
		
		$padding_top = aalto_edge_options()->getOptionValue( 'content_top_padding' );
		if ( $padding_top !== '' ) {
			$content_style['padding-top'] = aalto_edge_filter_px( $padding_top ) . 'px';
		}
		
		$content_selector = array(
			'.edgtf-content .edgtf-content-inner > .edgtf-full-width > .edgtf-full-width-inner',
		);
		
		echo aalto_edge_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_top_in_grid = aalto_edge_options()->getOptionValue( 'content_top_padding_in_grid' );
		if ( $padding_top_in_grid !== '' ) {
			$content_style_in_grid['padding-top'] = aalto_edge_filter_px( $padding_top_in_grid ) . 'px';
		}
		
		$content_selector_in_grid = array(
			'.edgtf-content .edgtf-content-inner > .edgtf-container > .edgtf-container-inner',
		);
		
		echo aalto_edge_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_content_styles' );
}

if ( ! function_exists( 'aalto_edge_h1_styles' ) ) {
	function aalto_edge_h1_styles() {
		$margin_top    = aalto_edge_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = aalto_edge_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = aalto_edge_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = aalto_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = aalto_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_h1_styles' );
}

if ( ! function_exists( 'aalto_edge_h2_styles' ) ) {
	function aalto_edge_h2_styles() {
		$margin_top    = aalto_edge_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = aalto_edge_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = aalto_edge_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = aalto_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = aalto_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_h2_styles' );
}

if ( ! function_exists( 'aalto_edge_h3_styles' ) ) {
	function aalto_edge_h3_styles() {
		$margin_top    = aalto_edge_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = aalto_edge_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = aalto_edge_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = aalto_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = aalto_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_h3_styles' );
}

if ( ! function_exists( 'aalto_edge_h4_styles' ) ) {
	function aalto_edge_h4_styles() {
		$margin_top    = aalto_edge_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = aalto_edge_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = aalto_edge_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = aalto_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = aalto_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_h4_styles' );
}

if ( ! function_exists( 'aalto_edge_h5_styles' ) ) {
	function aalto_edge_h5_styles() {
		$margin_top    = aalto_edge_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = aalto_edge_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = aalto_edge_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = aalto_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = aalto_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_h5_styles' );
}

if ( ! function_exists( 'aalto_edge_h6_styles' ) ) {
	function aalto_edge_h6_styles() {
		$margin_top    = aalto_edge_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = aalto_edge_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = aalto_edge_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = aalto_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = aalto_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_h6_styles' );
}

if ( ! function_exists( 'aalto_edge_text_styles' ) ) {
	function aalto_edge_text_styles() {
		$item_styles = aalto_edge_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo aalto_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_text_styles' );
}

if ( ! function_exists( 'aalto_edge_link_styles' ) ) {
	function aalto_edge_link_styles() {
		$link_styles      = array();
		$link_color       = aalto_edge_options()->getOptionValue( 'link_color' );
		$link_font_style  = aalto_edge_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = aalto_edge_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = aalto_edge_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo aalto_edge_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_link_styles' );
}

if ( ! function_exists( 'aalto_edge_link_hover_styles' ) ) {
	function aalto_edge_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = aalto_edge_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = aalto_edge_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo aalto_edge_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo aalto_edge_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'aalto_edge_style_dynamic', 'aalto_edge_link_hover_styles' );
}

if ( ! function_exists( 'aalto_edge_smooth_page_transition_styles' ) ) {
	function aalto_edge_smooth_page_transition_styles( $style ) {
		$id            = aalto_edge_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = aalto_edge_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.edgtf-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= aalto_edge_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = aalto_edge_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
			$spinner_style['color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.edgtf-st-loader .edgtf-rotate-circles > div',
			'.edgtf-st-loader .pulse',
			'.edgtf-st-loader .double_pulse .double-bounce1',
			'.edgtf-st-loader .double_pulse .double-bounce2',
			'.edgtf-st-loader .cube',
			'.edgtf-st-loader .rotating_cubes .cube1',
			'.edgtf-st-loader .rotating_cubes .cube2',
			'.edgtf-st-loader .stripes > div',
			'.edgtf-st-loader .wave > div',
			'.edgtf-st-loader .two_rotating_circles .dot1',
			'.edgtf-st-loader .two_rotating_circles .dot2',
			'.edgtf-st-loader .five_rotating_circles .container1 > div',
			'.edgtf-st-loader .five_rotating_circles .container2 > div',
			'.edgtf-st-loader .five_rotating_circles .container3 > div',
			'.edgtf-st-loader .atom .ball-1:before',
			'.edgtf-st-loader .atom .ball-2:before',
			'.edgtf-st-loader .atom .ball-3:before',
			'.edgtf-st-loader .atom .ball-4:before',
			'.edgtf-st-loader .clock .ball:before',
			'.edgtf-st-loader .mitosis .ball',
			'.edgtf-st-loader .lines .line1',
			'.edgtf-st-loader .lines .line2',
			'.edgtf-st-loader .lines .line3',
			'.edgtf-st-loader .lines .line4',
			'.edgtf-st-loader .fussion .ball',
			'.edgtf-st-loader .fussion .ball-1',
			'.edgtf-st-loader .fussion .ball-2',
			'.edgtf-st-loader .fussion .ball-3',
			'.edgtf-st-loader .fussion .ball-4',
			'.edgtf-st-loader .wave_circles .ball',
			'.edgtf-st-loader .pulse_circles .ball',
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= aalto_edge_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$spinner_color_style = array();
		if ( ! empty( $spinner_color ) ) {
			$spinner_color_style['color'] = $spinner_color;
		}
		
		$spinner_color_selectors = array(
			'.edgtf-aalto-spinner .edgtf-aalto-spinner-title .edgtf-aalto-spinner-title-inner'
		);
		
		if ( ! empty( $spinner_color_style ) ) {
			$current_style .= aalto_edge_dynamic_css( $spinner_color_selectors, $spinner_color_style );
		}
		
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'aalto_edge_add_page_custom_style', 'aalto_edge_smooth_page_transition_styles' );
}