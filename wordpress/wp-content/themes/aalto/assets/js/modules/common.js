(function($) {
	"use strict";

    var common = {};
    edgtf.modules.common = common;

    common.edgtfFluidVideo = edgtfFluidVideo;
    common.edgtfEnableScroll = edgtfEnableScroll;
    common.edgtfDisableScroll = edgtfDisableScroll;
    common.edgtfOwlSlider = edgtfOwlSlider;
    common.edgtfInitParallax = edgtfInitParallax;
    common.edgtfInitSelfHostedVideoPlayer = edgtfInitSelfHostedVideoPlayer;
    common.edgtfSelfHostedVideoSize = edgtfSelfHostedVideoSize;
    common.edgtfPrettyPhoto = edgtfPrettyPhoto;
	common.edgtfStickySidebarWidget = edgtfStickySidebarWidget;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;

    common.edgtfOnDocumentReady = edgtfOnDocumentReady;
    common.edgtfOnWindowLoad = edgtfOnWindowLoad;
    common.edgtfOnWindowResize = edgtfOnWindowResize;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfIconWithHover().init();
	    edgtfDisableSmoothScrollForMac();
	    edgtfInitAnchor().init();
	    edgtfInitBackToTop();
	    edgtfBackButtonShowHide();
	    edgtfInitSelfHostedVideoPlayer();
	    edgtfSelfHostedVideoSize();
	    edgtfFluidVideo();
	    edgtfOwlSlider();
	    edgtfPreloadBackgrounds();
	    edgtfPrettyPhoto();
	    edgtfSearchPostTypeWidget();
	    edgtfScrollToContent();
        edgtfSmoothTransition();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
	    edgtfInitParallax();
	    edgtfStickySidebarWidget().init();
	    edgtfParallaxElements();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfSelfHostedVideoSize();
    }
	
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function edgtfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && edgtf.body.hasClass('edgtf-smooth-scroll')) {
			edgtf.body.removeClass('edgtf-smooth-scroll');
		}
	}
	
	function edgtfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', edgtfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = edgtfWheel;
		document.onkeydown = edgtfKeydown;
	}
	
	function edgtfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', edgtfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function edgtfWheel(e) {
		edgtfPreventDefaultValue(e);
	}
	
	function edgtfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				edgtfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function edgtfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var edgtfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			var headers = $('.edgtf-main-menu, .edgtf-mobile-nav, .edgtf-fullscreen-menu');
			
			headers.each(function(){
				var currentHeader = $(this);
				
				if (anchor.parents(currentHeader).length) {
					currentHeader.find('.edgtf-active-item').removeClass('edgtf-active-item');
					anchor.parent().addClass('edgtf-active-item');
					
					currentHeader.find('a').removeClass('current');
					anchor.addClass('current');
				}
			});
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			var anchorData = $('[data-edgtf-anchor]'),
				anchorElement,
				siteURL = window.location.href.split('#')[0];
			
			if (siteURL.substr(-1) !== '/') {
				siteURL += '/';
			}
			
			anchorData.waypoint( function(direction) {
				if(direction === 'down') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("edgtf-anchor");
					} else {
						anchorElement = $(this).data("edgtf-anchor");
					}
				
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: '50%' });
			
			anchorData.waypoint( function(direction) {
				if(direction === 'up') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("edgtf-anchor");
					} else {
						anchorElement = $(this).data("edgtf-anchor");
					}
					
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
			
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-edgtf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('.edgtf-main-menu a, .edgtf-mobile-nav a, .edgtf-fullscreen-menu a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-edgtf-anchor="' + hash + '"]') : '';
			
			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - edgtfGlobalVars.vars.edgtfAddForAdminBar;
				
				if(anchor.length) {
					anchor.each(function(){
						var thisAnchor = $(this);
						
						if(thisAnchor.attr('href').indexOf(hash) > -1) {
							setActiveState(thisAnchor);
						}
					});
				}
				
				edgtf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {
			
			if (edgtf.modules.stickyHeader.behaviour === 'edgtf-sticky-header-on-scroll-down-up') {
				edgtf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > edgtf.modules.header.stickyAppearAmount);
			}
			
			if (edgtf.modules.stickyHeader.behaviour === 'edgtf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > edgtf.scroll)) {
					edgtf.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = edgtf.modules.stickyHeader.isStickyVisible ? edgtfGlobalVars.vars.edgtfStickyHeaderTransparencyHeight : edgtfPerPageVars.vars.edgtfHeaderTransparencyHeight;
			
			if (edgtf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			edgtf.document.on("click", ".edgtf-main-menu a, .edgtf-fullscreen-menu a, .edgtf-btn, .edgtf-anchor, .edgtf-mobile-nav a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-edgtf-anchor="' + hash + '"]') : '';
				
				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - edgtfGlobalVars.vars.edgtfAddForAdminBar;
					
					setActiveState(anchor);
					
					edgtf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});
					return false;
				}
			});
		};
		
		return {
			init: function () {
				if ($('[data-edgtf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).load(function () {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};
	
	function edgtfInitBackToTop() {
		var backToTopButton = $('#edgtf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			edgtf.html.animate({scrollTop: 0}, edgtf.window.scrollTop() / 5, 'easeOutExpo');
		});
	}
	
	function edgtfBackButtonShowHide() {
		edgtf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;
			
			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}
			
			if (d < 1e3) {
				edgtfToTopButton('off');
			} else {
				edgtfToTopButton('on');
			}
		});
	}
	
	function edgtfToTopButton(a) {
		var b = $("#edgtf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}
	
	function edgtfInitSelfHostedVideoPlayer() {
		var players = $('.edgtf-self-hosted-video');
		
		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function edgtfSelfHostedVideoSize(){
		var selfVideoHolder = $('.edgtf-self-hosted-video-holder .edgtf-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.edgtf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / edgtf.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function edgtfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function edgtfSmoothTransition() {

		if (edgtf.body.hasClass('edgtf-smooth-page-transitions')) {

			//check for preload animation
			if (edgtf.body.hasClass('edgtf-smooth-page-transitions-preloader')) {
				var loader = $('body > .edgtf-smooth-transition-loader.edgtf-mimic-ajax');

				var hidePreloader = function() {
				    var aaltoSpinner = $('.edgtf-aalto-spinner');

				    if (aaltoSpinner.length) {
				        aaltoSpinner.addClass('edgtf-hide');
				        aaltoSpinner.find('.edgtf-aalto-spinner-title-inner').one(edgtf.animationEnd, function() { 
				            loader.addClass('edgtf-remove');
				            loader.one(edgtf.transitionEnd, function() { 
					            loader.fadeOut(300);
				            });
				        });
				    } else {
				        loader.fadeOut(300);
				    }
				}   

				var removePreloader = function() {
				    hidePreloader();
				    $(window).bind("pageshow", function(event) {
				        if (event.originalEvent.persisted) {
				            hidePreloader();
				        }
				    });
				}

				//check for metabox slider and then for content slider
				if ($('.edgtf-slider').length) {
					var revSlider = $('.edgtf-slider .rev_slider');
				} else {
					var revSlider = $('#edgtf-main-rev-slider .rev_slider');
				}
				
				if (revSlider.length) {
				    revSlider.bind('revolution.slide.onchange', function(e, data) {
				        removePreloader();
				        console.log('rev-start');
				    });
				} else {
				    $(window).load(function(){
				        removePreloader();
				    });
				}
			}

			//check for fade out animation
			if (edgtf.body.hasClass('edgtf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.click(function (e) {
					var a = $(this);

					if ((a.parents('.edgtf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) && // check if it is an anchor aiming for a different page
						a.closest('.edgtf-ptf-list-showcase-meta-item').hasClass('active')
					) {
						e.preventDefault();
						$('.edgtf-wrapper-inner').fadeOut(800, 'easeOutExpo', function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'edgtf-preload-background' class
	 */
	function edgtfPreloadBackgrounds(){
		var preloadBackHolder = $('.edgtf-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('edgtf-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('edgtf-preload-background'); }); //make sure that edgtf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function edgtfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

    function edgtfSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.edgtf-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.edgtf-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.edgtf-post-type-search-results'),
                    searchLoading = thisSearch.find('.edgtf-search-loading'),
                    searchIcon = thisSearch.find('.edgtf-search-icon');

                searchLoading.addClass('edgtf-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function() {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('edgtf-hidden');
                    searchIcon.addClass('edgtf-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('edgtf-hidden');
                            searchIcon.removeClass('edgtf-hidden');
                        } else {
                            var ajaxData = {
                                action: 'aalto_edge_search_post_types',
                                term: searchTerm,
                                postType: postType
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status === 'success') {
                                        searchLoading.addClass('edgtf-hidden');
                                        searchIcon.removeClass('edgtf-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('edgtf-hidden');
                                    searchIcon.removeClass('edgtf-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('edgtf-hidden');
                    searchIcon.removeClass('edgtf-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgtfIconWithHover = function() {
		//get all icons on page
		var icons = $('.edgtf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function edgtfInitParallax(){
		var parallaxHolder = $('.edgtf-parallax-row-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					image = parallaxElement.data('parallax-bg-image'),
					speed = parallaxElement.data('parallax-bg-speed') * 0.4,
					height = 0;
				
				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}
				
				parallaxElement.css({'background-image': 'url('+image+')'});
				
				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}
	
	/*
	 **  Init sticky sidebar widget
	 */
	function edgtfStickySidebarWidget(){
		var sswHolder = $('.edgtf-widget-sticky-sidebar'),
			headerHolder = $('.edgtf-page-header'),
			headerHeight = headerHolder.length ? headerHolder.outerHeight() : 0,
			widgetTopOffset = 0,
			widgetTopPosition = 0,
			sidebarHeight = 0,
			sidebarWidth = 0,
			objectsCollection = [];
		
		function addObjectItems() {
			if (sswHolder.length) {
				sswHolder.each(function () {
					var thisSswHolder = $(this),
						mainSidebarHolder = thisSswHolder.parents('aside.edgtf-sidebar'),
						widgetiseSidebarHolder = thisSswHolder.parents('.wpb_widgetised_column'),
						sidebarHolder = '',
						sidebarHolderHeight = 0;
					
					widgetTopOffset = thisSswHolder.offset().top;
					widgetTopPosition = thisSswHolder.position().top;
					sidebarHeight = 0;
					sidebarWidth = 0;
					
					if (mainSidebarHolder.length) {
						sidebarHeight = mainSidebarHolder.outerHeight();
						sidebarWidth = mainSidebarHolder.outerWidth();
						sidebarHolder = mainSidebarHolder;
						sidebarHolderHeight = mainSidebarHolder.parent().parent().outerHeight();
						
						var blogHolder = mainSidebarHolder.parent().parent().find('.edgtf-blog-holder');
						if (blogHolder.length) {
							sidebarHolderHeight -= parseInt(blogHolder.css('marginBottom'));
						}
					} else if (widgetiseSidebarHolder.length) {
						sidebarHeight = widgetiseSidebarHolder.outerHeight();
						sidebarWidth = widgetiseSidebarHolder.outerWidth();
						sidebarHolder = widgetiseSidebarHolder;
						sidebarHolderHeight = widgetiseSidebarHolder.parents('.vc_row').outerHeight();
					}
					
					objectsCollection.push({
						'object': thisSswHolder,
						'offset': widgetTopOffset,
						'position': widgetTopPosition,
						'height': sidebarHeight,
						'width': sidebarWidth,
						'sidebarHolder': sidebarHolder,
						'sidebarHolderHeight': sidebarHolderHeight
					});
				});
			}
		}
		
		function initStickySidebarWidget() {
			
			if (objectsCollection.length) {
				$.each(objectsCollection, function (i) {
					var thisSswHolder = objectsCollection[i]['object'],
						thisWidgetTopOffset = objectsCollection[i]['offset'],
						thisWidgetTopPosition = objectsCollection[i]['position'],
						thisSidebarHeight = objectsCollection[i]['height'],
						thisSidebarWidth = objectsCollection[i]['width'],
						thisSidebarHolder = objectsCollection[i]['sidebarHolder'],
						thisSidebarHolderHeight = objectsCollection[i]['sidebarHolderHeight'];
					
					if (edgtf.body.hasClass('edgtf-fixed-on-scroll')) {
						var fixedHeader = $('.edgtf-fixed-wrapper.fixed');
						
						if (fixedHeader.length) {
							headerHeight = fixedHeader.outerHeight() + edgtfGlobalVars.vars.edgtfAddForAdminBar;
						}
					} else if (edgtf.body.hasClass('edgtf-no-behavior')) {
						headerHeight = edgtfGlobalVars.vars.edgtfAddForAdminBar;
					}
					
					if (edgtf.windowWidth > 1024 && thisSidebarHolder.length) {
						var sidebarPosition = -(thisWidgetTopPosition - headerHeight),
							sidebarHeight = thisSidebarHeight - thisWidgetTopPosition - 40; // 40 is bottom margin of widget holder
						
						//move sidebar up when hits the end of section row
						var rowSectionEndInViewport = thisSidebarHolderHeight + thisWidgetTopOffset - headerHeight - thisWidgetTopPosition - edgtfGlobalVars.vars.edgtfTopBarHeight;
						
						if ((edgtf.scroll >= thisWidgetTopOffset - headerHeight) && thisSidebarHeight < thisSidebarHolderHeight) {
							if (thisSidebarHolder.hasClass('edgtf-sticky-sidebar-appeared')) {
								thisSidebarHolder.css({'top': sidebarPosition + 'px'});
							} else {
								thisSidebarHolder.addClass('edgtf-sticky-sidebar-appeared').css({
									'position': 'fixed',
									'top': sidebarPosition + 'px',
									'width': thisSidebarWidth,
									'margin-top': '-10px'
								}).animate({'margin-top': '0'}, 200);
							}
							
							if (edgtf.scroll + sidebarHeight >= rowSectionEndInViewport) {
								var absBottomPosition = thisSidebarHolderHeight - sidebarHeight + sidebarPosition - headerHeight;
								
								thisSidebarHolder.css({
									'position': 'absolute',
									'top': absBottomPosition + 'px'
								});
							} else {
								if (thisSidebarHolder.hasClass('edgtf-sticky-sidebar-appeared')) {
									thisSidebarHolder.css({
										'position': 'fixed',
										'top': sidebarPosition + 'px'
									});
								}
							}
						} else {
							thisSidebarHolder.removeClass('edgtf-sticky-sidebar-appeared').css({
								'position': 'relative',
								'top': '0',
								'width': 'auto'
							});
						}
					} else {
						thisSidebarHolder.removeClass('edgtf-sticky-sidebar-appeared').css({
							'position': 'relative',
							'top': '0',
							'width': 'auto'
						});
					}
				});
			}
		}
		
		return {
			init: function () {
				addObjectItems();
				
				initStickySidebarWidget();
				
				$(window).scroll(function () {
					initStickySidebarWidget();
				});
			},
			reInit: initStickySidebarWidget
		};
	}

    /**
     * Init Owl Carousel
     */
    function edgtfOwlSlider() {
        var sliders = $('.edgtf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
	                slideItemsNumber = slider.children().length,
	                numberOfItems = 1,
	                loop = true,
	                autoplay = true,
	                autoplayHoverPause = false,
	                sliderSpeed = 5000,
	                sliderSpeedAnimation = 600,
	                margin = 0,
	                responsiveMargin = 0,
	                responsiveMargin1 = 0,
	                stagePadding = 0,
	                stagePaddingEnabled = false,
	                center = false,
	                autoWidth = false,
	                animateInClass = false, // keyframe css animation
	                animateOutClass = false, // keyframe css animation
	                navigation = true,
	                pagination = false,
	                sliderIsPortfolio = !!slider.hasClass('edgtf-pl-is-slider'),
	                sliderDataHolder = sliderIsPortfolio ? slider.parent() : slider;  // this is condition for portfolio slider
	
	            if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsPortfolio) {
		            numberOfItems = slider.data('number-of-items');
	            }
	            if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsPortfolio) {
		            numberOfItems = sliderDataHolder.data('number-of-columns');
	            }
	            if (sliderDataHolder.data('enable-loop') === 'no') {
		            loop = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay') === 'no') {
		            autoplay = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'yes') {
		            autoplayHoverPause = true;
	            }
	            if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
		            sliderSpeed = sliderDataHolder.data('slider-speed');
	            }
	            if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
		            sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
	            }
	            if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
		            if (sliderDataHolder.data('slider-margin') === 'no') {
			            margin = 0;
		            } else {
			            margin = sliderDataHolder.data('slider-margin');
		            }
	            } else {
		            if(slider.parent().hasClass('edgtf-huge-space')) {
			            margin = 60;
		            } else if (slider.parent().hasClass('edgtf-large-space')) {
			            margin = 50;
		            } else if (slider.parent().hasClass('edgtf-medium-space')) {
			            margin = 40;
		            } else if (slider.parent().hasClass('edgtf-normal-space')) {
			            margin = 30;
		            } else if (slider.parent().hasClass('edgtf-small-space')) {
			            margin = 20;
		            } else if (slider.parent().hasClass('edgtf-tiny-space')) {
			            margin = 10;
		            }
	            }
	            if (sliderDataHolder.data('slider-padding') === 'yes') {
		            stagePaddingEnabled = true;
		            stagePadding = parseInt(slider.outerWidth() * 0.28);
		            margin = 50;
	            }
	            if (sliderDataHolder.data('enable-center') === 'yes') {
		            center = true;
	            }
	            if (sliderDataHolder.data('enable-auto-width') === 'yes') {
		            autoWidth = true;
	            }
	            if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
		            animateInClass = sliderDataHolder.data('slider-animate-in');
	            }
	            if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
		            animateOutClass = sliderDataHolder.data('slider-animate-out');
	            }
	            if (sliderDataHolder.data('enable-navigation') === 'no') {
		            navigation = false;
	            }
	            if (sliderDataHolder.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }
	            
	            if(navigation && pagination) {
		            slider.addClass('edgtf-slider-has-both-nav');
	            }
	
	            if (slideItemsNumber <= 1) {
		            loop       = false;
		            autoplay   = false;
		            navigation = false;
		            pagination = false;
	            }
	
	            var responsiveNumberOfItems1 = 1,
		            responsiveNumberOfItems2 = 2,
		            responsiveNumberOfItems3 = 3,
		            responsiveNumberOfItems4 = numberOfItems;
	
	            if (numberOfItems < 3) {
		            responsiveNumberOfItems2 = numberOfItems;
		            responsiveNumberOfItems3 = numberOfItems;
	            }
	
	            if (numberOfItems > 4) {
		            responsiveNumberOfItems4 = 4;
	            }
	
	            if (stagePaddingEnabled || margin > 30) {
		            responsiveMargin = 20;
		            responsiveMargin1 = 30;
	            }
	
	            if (margin > 0 && margin <= 30) {
		            responsiveMargin = margin;
		            responsiveMargin1 = margin;
	            }
	
	            slider.owlCarousel({
		            items: numberOfItems,
		            loop: loop,
		            autoplay: autoplay,
		            autoplayHoverPause: autoplayHoverPause,
		            autoplayTimeout: sliderSpeed,
		            smartSpeed: sliderSpeedAnimation,
		            margin: margin,
		            stagePadding: stagePadding,
		            center: center,
		            autoWidth: autoWidth,
		            animateIn: animateInClass,
		            animateOut: animateOutClass,
		            dots: pagination,
		            nav: navigation,
		            navText: [
			            '<span class="edgtf-prev-icon icon-arrows-left"></span>',
			            '<span class="edgtf-next-icon icon-arrows-right"></span>'
		            ],
		            responsive: {
			            0: {
				            items: responsiveNumberOfItems1,
				            margin: responsiveMargin,
				            stagePadding: 0,
				            center: false,
				            autoWidth: false
			            },
			            681: {
				            items: responsiveNumberOfItems2,
				            margin: responsiveMargin1
			            },
			            769: {
				            items: responsiveNumberOfItems3,
				            margin: responsiveMargin1
			            },
			            1025: {
				            items: responsiveNumberOfItems4
			            },
			            1281: {
				            items: numberOfItems
			            }
		            },
		            onInitialize: function () {
			            slider.css('visibility', 'visible');
			            edgtfInitParallax();
		            },
		            onDrag: function (e) {
			            if (edgtf.body.hasClass('edgtf-smooth-page-transitions-fadeout')) {
				            var sliderIsMoving = e.isTrigger > 0;
				
				            if (sliderIsMoving) {
					            slider.addClass('edgtf-slider-is-moving');
				            }
			            }
		            },
		            onDragged: function () {
			            if (edgtf.body.hasClass('edgtf-smooth-page-transitions-fadeout') && slider.hasClass('edgtf-slider-is-moving')) {
				
				            setTimeout(function () {
					            slider.removeClass('edgtf-slider-is-moving');
				            }, 500);
			            }
		            }
                });
            });
        }
    }


     /**
     * Init Parallax Items - parallax holder shortcode, team list shortcode etc.
     */
	function edgtfParallaxElements() {
		var parallaxIntances = $('.edgtf-parallax-holder, \
									.edgtf-tl-has-parallax-scroll, \
									.edgtf-bl-has-parallax-scroll, \
									.edgtf-portfolio-project-info.edgtf-parallax-fx'
								);

		if (parallaxIntances.length && !edgtf.htmlEl.hasClass('touch')) {
		    ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
		}
     }

    /*
    * Slide to content on scroll - one scroll to page content
    */
    function edgtfScrollToContent() {
        if (edgtf.body.hasClass('edgtf-scroll-to-content') && !edgtf.htmlEl.hasClass('touch')) {
         	var sliderHolder = $('.edgtf-slider'),
	         	sliderHolderHeight = sliderHolder.height(),
	         	sliderHolderOffset = sliderHolder.offset().top,
	         	sliderArea = sliderHolderHeight - sliderHolderOffset,
             	scrollTarget = sliderHolderHeight + sliderHolderOffset,
	         	revSlider = sliderHolder.find('.rev_slider'),
 	            scrollingForward = false,
 			    pageJump = false,
 	            reInitOneScroll = false,
 			    normalScroll = true,
	         	set = false;

             var edgtfScrollHandler = function() {
             	if  ($(window).scrollTop() < sliderArea) {
             		normalScroll = false;
             	}

                function edgtfScrollTo() {
                 	pageJump = true;
                 	$('html, body').animate({
                 		scrollTop: scrollTarget
                 	}, 1000, 'easeInOutQuint', function() {
                 		pageJump = false;
                 		normalScroll = true;
                 	});
                }

                //update values
                $(window).scroll(function(){
                	if (edgtf.scroll < sliderArea) {
                	    reInitOneScroll = true;

            	    	if (scrollingForward) {
            	    		normalScroll = false;
            	    	}
                	}
                });


			    //wheel handle
			    window.addEventListener('wheel', function(event) {
			    	if (edgtf.scroll < sliderArea) {
			        	var wheelScroll = event.deltaY;

				        if (wheelScroll > 0) {
				            scrollingForward = true;
				        } else {
				            scrollingForward = false;
				        }

				        if (!pageJump && !normalScroll) {
				            if (scrollingForward) {
				                event.preventDefault();
				                edgtfScrollTo();
				            }
				        } else {
				        	if (!normalScroll) {
				        	    event.preventDefault();
				        	}
				            if (normalScroll && !scrollingForward && reInitOneScroll) {
				                pageJump = false;
				                normalScroll = false;
				                event.preventDefault();
				            }	
					    }
					}

					if (pageJump) {
						event.preventDefault();
					}
			    }); 

                 //scrollbar click
                 $(document).on('mousedown', function(event){
                     if( $(window).outerWidth() <= event.pageX ){
                         if ($(window).scrollTop() == sliderHolderOffset) {
                             event.preventDefault();
                             edgtfScrollTo();
                         }
                     }
                 });
             }

             //prevent mousewheel scroll
             window.addEventListener('wheel', function (event) {
                 if (!set) {
                     event.preventDefault();
                 }
             });

             //prevent scrollbar scroll
             window.addEventListener('scroll', function () {
                 if (!set) {
                    $(window).scrollTop(sliderHolderOffset);
                 }
             })  

             //update slider height and offset
             var updateCoordinates = function() {
             	sliderHolderHeight = sliderHolder.height();
             	sliderHolderOffset = sliderHolder.offset().top;
             	sliderArea = sliderHolderHeight - sliderHolderOffset;
             	scrollTarget = sliderHolderHeight + sliderHolderOffset;
             }

             //init
            if (revSlider.length) {
                revSlider.bind('revolution.slide.onchange', function(e, data) {
                 	set = true;
                 	edgtfScrollHandler();
            	});
            } else {
                $(window).load(function(){
                    set = true;
                    edgtfScrollHandler();
                });   
           	}

           	$(window).resize(function(){
				updateCoordinates();
           	});
        }
    }

})(jQuery);