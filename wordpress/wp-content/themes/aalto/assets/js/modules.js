(function($) {
    "use strict";

    window.edgtf = {};
    edgtf.modules = {};

    edgtf.scroll = 0;
    edgtf.window = $(window);
    edgtf.document = $(document);
    edgtf.windowWidth = $(window).width();
    edgtf.windowHeight = $(window).height();
    edgtf.body = $('body');
    edgtf.html = $('html, body');
    edgtf.htmlEl = $('html');
    edgtf.menuDropdownHeightSet = false;
    edgtf.defaultHeaderStyle = '';
    edgtf.minVideoWidth = 1500;
    edgtf.videoWidthOriginal = 1280;
    edgtf.videoHeightOriginal = 720;
    edgtf.videoRatio = 1.61;

    edgtf.edgtfOnDocumentReady = edgtfOnDocumentReady;
    edgtf.edgtfOnWindowLoad = edgtfOnWindowLoad;
    edgtf.edgtfOnWindowResize = edgtfOnWindowResize;
    edgtf.edgtfOnWindowScroll = edgtfOnWindowScroll;

    edgtf.transitionEnd = transitionEventEnd();
    edgtf.animationEnd = animationEventEnd();

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfBrowserDetection();
        edgtf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(edgtf.body.hasClass('edgtf-dark-header')){ edgtf.defaultHeaderStyle = 'edgtf-dark-header';}
        if(edgtf.body.hasClass('edgtf-light-header')){ edgtf.defaultHeaderStyle = 'edgtf-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtf.windowWidth = $(window).width();
        edgtf.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        edgtf.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case edgtf.body.hasClass('edgtf-grid-1300'):
            edgtf.boxedLayoutWidth = 1350;
            break;
        case edgtf.body.hasClass('edgtf-grid-1200'):
            edgtf.boxedLayoutWidth = 1250;
            break;
        case edgtf.body.hasClass('edgtf-grid-1000'):
            edgtf.boxedLayoutWidth = 1050;
            break;
        case edgtf.body.hasClass('edgtf-grid-800'):
            edgtf.boxedLayoutWidth = 850;
            break;
        default :
            edgtf.boxedLayoutWidth = 1150;
            break;
    }

    function transitionEventEnd() {
        var el = document.createElement('transitionDetector'),
            transEndEventNames = {
                'WebkitTransition' : 'webkitTransitionEnd',// Saf 6, Android Browser
                'MozTransition'    : 'transitionend',      // only for FF < 15
                'transition'       : 'transitionend'       // IE10, Opera, Chrome, FF 15+, Saf 7+
            };

        for(var t in transEndEventNames){
            if( el.style[t] !== undefined ){
                return transEndEventNames[t];
            }
        }
    }

    function animationEventEnd(){
        var el = document.createElement("animationDetector");

        var animations = {
            "animation"      : "animationend",
            "OAnimation"     : "oAnimationEnd",
            "MozAnimation"   : "animationend",
            "WebkitAnimation": "webkitAnimationEnd"
        }

        for (var t in animations){
            if (el.style[t] !== undefined){
              return animations[t];
            }
        }
    }

    /*
    * Browser detection
    */
    function edgtfBrowserDetection() {
        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
            isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor),
            isIE = window.navigator.userAgent.indexOf("MSIE ");
        
        if (isChrome) {
            edgtf.body.addClass('edgtf-chrome');
        }
        if (isSafari) {
            edgtf.body.addClass('edgtf-safari');
        }
        if (isIE > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            edgtf.body.addClass('edgtf-ms-explorer');
        }
    }

})(jQuery);
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
(function($) {
    'use strict';

    var like = {};
    
    like.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function edgtfOnDocumentReady() {
        edgtfLikes();
    }

    function edgtfLikes() {
        $(document).on('click','.edgtf-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'aalto_edge_like',
                likes_id: id,
                type: type
            };

            var like = $.post(edgtfGlobalVars.vars.edgtfAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
    "use strict";

    var blogListSC = {};
    edgtf.modules.blogListSC = blogListSC;

    blogListSC.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blogListSC.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blogListSC.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).scroll(edgtfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitBlogListMasonry();
        edgtfAlternatingListAnimation();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogListShortcodePagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtfOnWindowScroll() {
        edgtfInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init blog list shortcode masonry layout
     */
    function edgtfInitBlogListMasonry() {
        var holder = $('.edgtf-blog-list-holder.edgtf-bl-masonry');

        if(holder.length){
            holder.each(function(){
                var thisHolder = $(this),
                    masonry = thisHolder.find('.edgtf-blog-list');

                masonry.waitForImages(function() {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.edgtf-bl-item',
                        percentPosition: true,
                        packery: {
                            gutter: '.edgtf-bl-grid-gutter',
                            columnWidth: '.edgtf-bl-grid-sizer'
                        }
                    });

                    masonry.css('opacity', '1');
                });
            });
        }
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function edgtfInitBlogListShortcodePagination(){
        var holder = $('.edgtf-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.edgtf-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.edgtf-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - edgtfGlobalVars.vars.edgtfAddForAdminBar;

            if(!thisHolder.hasClass('edgtf-bl-pag-infinite-scroll-started') && edgtf.scroll + edgtf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.edgtf-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('edgtf-bl-pag-standard-blog-list')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll')) {
                thisHolder.addClass('edgtf-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.edgtf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('edgtf-bl-pag-standard-blog-list')) {
                    loadingItem.addClass('edgtf-showing edgtf-standard-pag-trigger');
                    thisHolder.addClass('edgtf-bl-pag-standard-blog-list-animate');
                } else {
                    loadingItem.addClass('edgtf-showing');
                }

                var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'aalto_edge_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('edgtf-bl-pag-standard-blog-list')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('edgtf-bl-pag-standard-blog-list')) {
                            edgtfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('edgtf-bl-masonry')){
                                    edgtfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    edgtfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                                        edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('edgtf-bl-masonry')){
                                    edgtfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    edgtfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                                        edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('edgtf-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.edgtf-blog-pag-load-more').hide();
            }
        };

        var edgtfInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.edgtf-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.edgtf-bl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.edgtf-bl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.edgtf-bl-pag-next a');

            standardPagNumericItem.removeClass('edgtf-bl-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('edgtf-bl-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var edgtfInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
            thisHolder.removeClass('edgtf-bl-pag-standard-blog-list-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                    edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var edgtfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
            thisHolder.removeClass('edgtf-bl-pag-standard-blog-list-animate');
            thisHolderInner.html(responseHtml);
        };

        var edgtfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('edgtf-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                    edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var edgtfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgtf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('edgtf-bl-pag-standard-blog-list')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('edgtf-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

    function edgtfAlternatingListAnimation() {
        var items = $('.edgtf-bl-alternating.edgtf-show-info-on-appear .edgtf-bl-item');

        if(items.length && !edgtf.htmlEl.hasClass('touch')){
            items.appear(function(){
                var item = $(this);

                setTimeout(function(){
                    item.addClass('edgtf-appear');
                }, parseInt(item.index() % 2 ? 1 : item.index()) * 240);
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var blogChequered = {};
    edgtf.modules.blogChequered = blogChequered;

    blogChequered.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).load(edgtfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogChequered();
        edgtfInitBlogChequeredLoadMore();
    }

    /**
     *  Init Blog Chequered
     */
    function edgtfInitBlogChequered(){
        var container = $('.edgtf-blog-holder.edgtf-blog-chequered');
        var masonry = container.children('.edgtf-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.edgtf-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }

    function edgtfInitBlogChequeredLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogChequered();
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var blogMasonryGallery = {};
    edgtf.modules.blogMasonryGallery = blogMasonryGallery;

    blogMasonryGallery.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blogMasonryGallery.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blogMasonryGallery.edgtfOnWindowResize = edgtfOnWindowResize;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitBlogMasonryGallery();
        edgtfInitBlogMasonryGalleryAppearLoadMore();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogMasonryGalleryAppear();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtfOnWindowResize() {
        edgtfInitBlogMasonryGallery();
    }

    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function edgtfInitBlogMasonryGallery() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.edgtf-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.edgtf-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                edgtfInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function edgtfInitBlogMasonryGalleryAppear() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgtf-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('edgtf-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

            });
        }
    }

    function edgtfInitBlogMasonryGalleryAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogMasonryGalleryAppear();
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var blogNarrow = {};
    edgtf.modules.blogNarrow = blogNarrow;

    blogNarrow.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).load(edgtfOnWindowLoad);


    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogNarrowAppear();
        edgtfInitBlogNarrowAppearLoadMore();
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function edgtfInitBlogNarrowAppear() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgtf-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('edgtf-appeared');
                    },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

            });
        }
    }

    function edgtfInitBlogNarrowAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogNarrowAppear();
        });
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    edgtf.modules.blog = blog;

    blog.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blog.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blog.edgtfOnWindowResize = edgtfOnWindowResize;
    blog.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitAudioPlayer();
        edgtfInitBlogMasonry();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
	    edgtfInitBlogPagination().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfInitBlogMasonry();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
	    edgtfInitBlogPagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function edgtfInitAudioPlayer() {
        var players = $('audio.edgtf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function edgtfResizeBlogItems(size,container){

        if(container.hasClass('edgtf-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edgtf-post-size-default'),
                largeWidthMasonryItem = container.find('.edgtf-post-size-large-width'),
                largeHeightMasonryItem = container.find('.edgtf-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.edgtf-post-size-large-width-height');

			if (edgtf.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function edgtfInitBlogMasonry() {
	    var holder = $('.edgtf-blog-holder.edgtf-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.edgtf-blog-holder-inner'),
                    size = thisHolder.find('.edgtf-blog-masonry-grid-sizer').width();
			    
                edgtfResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.edgtf-blog-masonry-grid-gutter',
						    columnWidth: '.edgtf-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
				
				    setTimeout(function() {
					    masonry.isotope('layout');
				    }, 800);
                });
		    });
	    }
    }
	
	/**
	 * Initializes blog pagination functions
	 */
	function edgtfInitBlogPagination(){
		var holder = $('.edgtf-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edgtf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			if(!thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll-started') && edgtf.scroll + edgtf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.edgtf-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('edgtf-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edgtf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('edgtf-showing');
				
				var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'aalto_edge_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtfGlobalVars.vars.edgtfAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('edgtf-blog-type-masonry')){
								edgtfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                edgtfResizeBlogItems(thisHolderInner.find('.edgtf-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								edgtfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								edgtfInitAudioPlayer();
								edgtf.modules.common.edgtfOwlSlider();
								edgtf.modules.common.edgtfFluidVideo();
                                edgtf.modules.common.edgtfInitSelfHostedVideoPlayer();
                                edgtf.modules.common.edgtfSelfHostedVideoSize();
								
								if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
									edgtf.modules.common.edgtfStickySidebarWidget().reInit();
								}

                                // Trigger event.
                                $( document.body ).trigger( 'blog_list_load_more_trigger' );

							}, 400);
						});
						
						if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('edgtf-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edgtf-blog-pag-load-more').hide();
			}
		};
		
		var edgtfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgtf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgtf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgtf-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    edgtf.modules.headerMinimal = headerMinimal;
	
	headerMinimal.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function edgtfFullscreenMenu() {
	    var popupMenuOpener = $( 'a.edgtf-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".edgtf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edgtf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edgtf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edgtf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edgtf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.edgtf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(edgtf.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edgtf.windowHeight);
            });

            if (edgtf.body.hasClass('edgtf-fade-push-text-right')) {
                cssClass = 'edgtf-push-nav-right';
                fadeRight = true;
            } else if (edgtf.body.hasClass('edgtf-fade-push-text-top')) {
                cssClass = 'edgtf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('edgtf-fm-opened')) {
                    popupMenuOpener.addClass('edgtf-fm-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-fade-out').addClass('edgtf-fullscreen-menu-opened edgtf-fullscreen-fade-in');
                    edgtf.body.removeClass(cssClass);
                    edgtf.modules.common.edgtfDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('edgtf-fm-opened');
                            edgtf.body.removeClass('edgtf-fullscreen-menu-opened edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                            edgtf.body.addClass(cssClass);
                            edgtf.modules.common.edgtfEnableScroll();
                            
                            $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('edgtf-fm-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-menu-opened edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                    edgtf.body.addClass(cssClass);
                    edgtf.modules.common.edgtfEnableScroll();
                    
                    $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent();

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint', function() {
			                popupMenuHolderOuter.getNiceScroll().resize();
		                });
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(menuItemWithChild.length === 1) {
			                thisItemParent.removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                popupMenuHolderOuter.getNiceScroll().resize();
				                submenu.slideDown(400, 'easeInOutQuint', function() {
					                popupMenuHolderOuter.getNiceScroll().resize();
				                });
			                });
		                } else {
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                popupMenuHolderOuter.getNiceScroll().resize();
				                submenu.slideDown(400, 'easeInOutQuint', function() {
					                popupMenuHolderOuter.getNiceScroll().resize();
				                });
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which == 1) {
                        popupMenuOpener.removeClass('edgtf-fm-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                        edgtf.body.addClass(cssClass);
                        $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    edgtf.modules.headerVertical = headerVertical;
	
	headerVertical.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var edgtfVerticalMenu = function() {
	    var verticalMenuObject = $('.edgtf-vertical-menu-area');
	
	    /**
	     * Resizes vertical area. Called whenever height of navigation area changes
	     * It first check if vertical area is scrollable, and if it is resizes scrollable area
	     */
	    var resizeVerticalArea = function () {
		    if (verticalAreaScrollable()) {
			    verticalMenuObject.getNiceScroll().resize();
		    }
	    };
	
	    /**
	     * Checks if vertical area is scrollable (if it has edgtf-with-scroll class)
	     *
	     * @returns {bool}
	     */
	    var verticalAreaScrollable = function () {
		    return verticalMenuObject.hasClass('edgtf-with-scroll');
	    };
	
	    /**
	     * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
	     */
	    var initNavigation = function () {
		    var verticalNavObject = verticalMenuObject.find('.edgtf-vertical-menu');
		
		    dropdownClickToggle();
		
		    /**
		     * Initializes click toggle navigation type. Works the same for touch and no-touch devices
		     */
		    function dropdownClickToggle() {
			    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
			
			    menuItems.each(function () {
				    var elementToExpand = $(this).find(' > .second, > ul');
				    var menuItem = this;
				    var dropdownOpener = $(this).find('> a');
				    var slideUpSpeed = 'fast';
				    var slideDownSpeed = 'slow';
				
				    dropdownOpener.on('click tap', function (e) {
					    e.preventDefault();
					    e.stopPropagation();
					
					    if (elementToExpand.is(':visible')) {
						    $(menuItem).removeClass('open');
						    elementToExpand.slideUp(slideUpSpeed, function () {
							    resizeVerticalArea();
						    });
					    } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('edgtf-vertical-menu')) {
						    $(this).parent().parent().children().removeClass('open');
						    $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed, function () {
							    resizeVerticalArea();
						    });
					    } else {
						
						    if (!$(this).parents('li').hasClass('open')) {
							    menuItems.removeClass('open');
							    menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    if ($(this).parent().parent().children().hasClass('open')) {
							    $(this).parent().parent().children().removeClass('open');
							    $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed, function () {
							    resizeVerticalArea();
						    });
					    }
				    });
			    });
		    }
	    };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.edgtf-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.edgtf-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if(edgtf.body.hasClass('edgtf-header-vertical-closed')) {
                        initHiddenVerticalArea();
                    }
                }
            }
        };
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var mobileHeader = {};
	edgtf.modules.mobileHeader = mobileHeader;
	
	mobileHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function edgtfOnDocumentReady() {
		edgtfInitMobileNavigation();
		edgtfMobileHeaderBehavior();
	}
	
	function edgtfInitMobileNavigation() {
		var navigationOpener = $('.edgtf-mobile-header .edgtf-mobile-menu-opener'),
			navigationHolder = $('.edgtf-mobile-header .edgtf-mobile-nav'),
			dropdownOpener = $('.edgtf-mobile-nav .mobile_arrow, .edgtf-mobile-nav h6, .edgtf-mobile-nav a.edgtf-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('edgtf-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('edgtf-mobile-menu-opened');
				}
			});
		}
		

		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				$(this).on('tap click', function (e) {
					var thisItem = $(this),
						thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');

						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('edgtf-opened');
						} else {
							thisItemParent.addClass('edgtf-opened');

							if(thisItemParentSiblingsWithDrop.length === 0) {
								submenu.slideDown(400, 'easeInOutQuint');
							} else {
								thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('edgtf-opened');
								thisItemParent.siblings().removeClass('edgtf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							}
						}
					}
				});
			});
		}
		
		$('.edgtf-mobile-nav a, .edgtf-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("edgtf-mobile-menu-opened");
			}
		});
	}
	
	function edgtfMobileHeaderBehavior() {
		var mobileHeader = $('.edgtf-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.edgtf-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (edgtf.body.hasClass('edgtf-content-is-behind-header') && mobileHeaderHeight > 0 && edgtf.windowWidth <= 1024) {
			$('.edgtf-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (edgtf.body.hasClass('edgtf-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('edgtf-animate-mobile-header');
				} else {
					mobileHeader.removeClass('edgtf-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('edgtf-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.edgtf-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    edgtf.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    if(edgtf.windowWidth > 1024) {
		    edgtfHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgtfHeaderBehaviour() {
        var header = $('.edgtf-page-header'),
	        stickyHeader = $('.edgtf-sticky-header'),
            fixedHeaderWrapper = $('.edgtf-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.edgtf-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.edgtf-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - edgtfGlobalVars.vars.edgtfAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-up'):
                edgtf.modules.stickyHeader.behaviour = 'edgtf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(edgtfGlobalVars.vars.edgtfTopBarHeight) + parseInt(edgtfGlobalVars.vars.edgtfLogoAreaHeight) + parseInt(edgtfGlobalVars.vars.edgtfMenuAreaHeight) + parseInt(edgtfGlobalVars.vars.edgtfStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edgtf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
                        edgtf.body.removeClass('edgtf-sticky-header-appear');
                    } else {
                        edgtf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    edgtf.body.addClass('edgtf-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-down-up'):
                edgtf.modules.stickyHeader.behaviour = 'edgtf-sticky-header-on-scroll-down-up';

                if(edgtfPerPageVars.vars.edgtfStickyScrollAmount !== 0){
                    edgtf.modules.stickyHeader.stickyAppearAmount = parseInt(edgtfPerPageVars.vars.edgtfStickyScrollAmount);
                } else {
                    edgtf.modules.stickyHeader.stickyAppearAmount = parseInt(edgtfGlobalVars.vars.edgtfTopBarHeight) + parseInt(edgtfGlobalVars.vars.edgtfLogoAreaHeight) + parseInt(edgtfGlobalVars.vars.edgtfMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(edgtf.scroll < edgtf.modules.stickyHeader.stickyAppearAmount) {
                        edgtf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
	                    edgtf.body.removeClass('edgtf-sticky-header-appear');
                    }else{
                        edgtf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    edgtf.body.addClass('edgtf-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edgtf.body.hasClass('edgtf-fixed-on-scroll'):
                edgtf.modules.stickyHeader.behaviour = 'edgtf-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(edgtf.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                edgtf.body.removeClass('edgtf-fixed-header-appear');
		                fixedMenuArea.css({'height': fixedMenuAreaHeight + 'px'});
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                edgtf.body.addClass('edgtf-fixed-header-appear');
		                fixedMenuArea.css({'height': (fixedMenuAreaHeight - 30) + 'px'});
		                header.css('margin-bottom', (fixedMenuAreaHeight - 30) + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	edgtf.modules.header = header;
	
	header.edgtfSetDropDownMenuPosition     = edgtfSetDropDownMenuPosition;
	header.edgtfSetDropDownWideMenuPosition = edgtfSetDropDownWideMenuPosition;
	
	header.edgtfOnDocumentReady = edgtfOnDocumentReady;
	header.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(document).ready(edgtfOnDocumentReady);
	$(window).load(edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfSetDropDownMenuPosition();
		edgtfDropDownMenu();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function edgtfSetDropDownMenuPosition() {
		var menuItems = $('.edgtf-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = edgtf.windowWidth - menuItemPosition;
				
				if (edgtf.body.hasClass('edgtf-boxed')) {
					menuItemFromLeft = edgtf.boxedLayoutWidth - (menuItemPosition - (edgtf.windowWidth - edgtf.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function edgtfSetDropDownWideMenuPosition(){
		var menuItems = $(".edgtf-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
				var menuItemSubMenu = $(menuItems[i]).find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(edgtf.body.hasClass('edgtf-boxed')) {
						var boxedWidth = $('.edgtf-boxed .edgtf-wrapper .edgtf-wrapper-inner').outerWidth();
						left_position = left_position - (edgtf.windowWidth - boxedWidth) / 2;
						
						menuItemSubMenu.css('left', -left_position);
						menuItemSubMenu.css('width', boxedWidth);
					} else {
						menuItemSubMenu.css('left', -left_position);
						menuItemSubMenu.css('width', edgtf.windowWidth);
					}
				}
			});
		}
	}
	
	function edgtfDropDownMenu() {
		var menu_items = $('.edgtf-drop-down > ul > li');
		
		menu_items.each(function(i) {
			if($(menu_items[i]).find('.second').length > 0) {
				var thisItem = $(menu_items[i]),
					dropDownSecondDiv = thisItem.find('.second');
				
				if(thisItem.hasClass('wide')) {
					//set columns to be same height - start
					var tallest = 0,
						dropDownSecondItem = $(this).find('.second > .inner > ul > li');
					
					dropDownSecondItem.each(function() {
						var thisHeight = $(this).height();
						if(thisHeight > tallest) {
							tallest = thisHeight;
						}
					});
					
					dropDownSecondItem.css('height', ''); // delete old inline css - via resize
					dropDownSecondItem.height(tallest);
					//set columns to be same height - end
				}
				
				if(!edgtf.menuDropdownHeightSet) {
					thisItem.data('original_height', dropDownSecondDiv.height() + 'px');
					dropDownSecondDiv.height(0);
				}
				
				if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					thisItem.on("touchstart mouseenter", function() {
						dropDownSecondDiv.css({
							'height': thisItem.data('original_height'),
							'overflow': 'visible',
							'visibility': 'visible',
							'opacity': '1'
						});
					}).on("mouseleave", function() {
						dropDownSecondDiv.css({
							'height': '0px',
							'overflow': 'hidden',
							'visibility': 'hidden',
							'opacity': '0'
						});
					});
				} else {
					if(edgtf.body.hasClass('edgtf-dropdown-animate-height')) {
						var config = {
						    interval: 0,
						    over: function() {
						        setTimeout(function() {
						            dropDownSecondDiv.addClass('edgtf-drop-down-start');
						            dropDownSecondDiv.css({
						                'visibility': 'visible',
						                'height': '0px',
						            });
						            dropDownSecondDiv.css('opacity', '1');
						            dropDownSecondDiv.stop().animate({
						                'height': $(menu_items[i]).data('original_height')
						            }, 350, 'easeInOutCubic', function() {
						                dropDownSecondDiv.css('overflow', 'visible');
						            });
						        }, 100);
						    },
						    timeout: 100,
						    out: function() {
						        dropDownSecondDiv.stop().animate({
						            'height': '0px',
						            'opacity': 0,
						        }, 0, function() {
						            dropDownSecondDiv.css({
						                'overflow': 'hidden',
						                'visibility': 'hidden'
						            });
						        });
						        dropDownSecondDiv.removeClass('edgtf-drop-down-start');
						    }
						};
						thisItem.hoverIntent(config);
					} else {
						var config = {
							interval: 0,
							over: function() {
								setTimeout(function() {
									dropDownSecondDiv.addClass('edgtf-drop-down-start');
									dropDownSecondDiv.stop().css({'height': thisItem.data('original_height')});
								}, 150);
							},
							timeout: 150,
							out: function() {
								dropDownSecondDiv.stop().css({'height': '0px'});
								dropDownSecondDiv.removeClass('edgtf-drop-down-start');
							}
						};
						thisItem.hoverIntent(config);
					}
				}
			}
		});
		
		$('.edgtf-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which == 1){
				var $this = $(this);
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		edgtf.menuDropdownHeightSet = true;
	}
	
})(jQuery);
(function($) {
    "use strict";

    var searchCoversHeader = {};
    edgtf.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchCoversHeader();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchCoversHeader() {
        if ( edgtf.body.hasClass( 'edgtf-search-covers-header' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.click(function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchFormHeight,
                        searchFormHeaderHolder = $('.edgtf-page-header'),
                        searchFormTopHeaderHolder = $('.edgtf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.edgtf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.edgtf-mobile-header'),
                        searchForm = $('.edgtf-search-cover'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.edgtf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.edgtf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.edgtf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.edgtf-mobile-header').length;

                    searchForm.removeClass('edgtf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormHeight = edgtfGlobalVars.vars.edgtfTopBarHeight;
                        searchFormTopHeaderHolder.find('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                        searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormHeight = edgtfGlobalVars.vars.edgtfStickyHeaderHeight;
                        searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormHeight = searchFormMobileHeaderHolder.children('.edgtf-mobile-header-inner').outerHeight();
                        } else {
                            searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                        }

                        searchFormMobileHeaderHolder.find('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else {
                        searchFormHeight = searchFormHeaderHolder.outerHeight();
                        searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');
                    }

                    if (searchForm.hasClass('edgtf-is-active')) {
                        searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                    }

                    searchForm.find('.edgtf-search-close').click(function (e) {
                        e.preventDefault();
                        searchForm.stop(true).fadeOut(450);
                    });

                    searchForm.blur(function () {
                        searchForm.stop(true).fadeOut(450);
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(450);
                    });
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchFullscreen = {};
    edgtf.modules.searchFullscreen = searchFullscreen;

    searchFullscreen.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchFullscreen();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchFullscreen() {
        if ( edgtf.body.hasClass( 'edgtf-fullscreen-search' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {

                var searchHolder = $('.edgtf-fullscreen-search-holder'),
                    searchClose = $('.edgtf-fullscreen-search-close'),
                    searchOpenerPosition = searchOpener.offset();

                //place close icon on opener icon's place if necessary
                // searchClose.css('top',searchOpenerPosition.top);
                // searchClose.css('right', edgtf.windowWidth - searchOpenerPosition.left - searchOpener.width());

                searchOpener.click(function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('edgtf-animate')) {
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-out');
                        edgtf.body.removeClass('edgtf-search-fade-in');
                        searchHolder.removeClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        }, 300);

                        edgtf.modules.common.edgtfEnableScroll();
                    } else {
                        edgtf.body.addClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                        edgtf.body.removeClass('edgtf-search-fade-out');
                        searchHolder.addClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').focus();
                        }, 900);

                        edgtf.modules.common.edgtfDisableScroll();
                    }

                    searchClose.click(function (e) {
                        e.preventDefault();
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                        edgtf.body.addClass('edgtf-search-fade-out');
                        searchHolder.removeClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        }, 300);

                        edgtf.modules.common.edgtfEnableScroll();
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".edgtf-form-holder-inner");

                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                            e.preventDefault();
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            searchHolder.removeClass('edgtf-animate');

                            setTimeout(function () {
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            }, 300);

                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) { //KeyCode for ESC button is 27
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            searchHolder.removeClass('edgtf-animate');

                            setTimeout(function () {
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            }, 300);

                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });
                });

                //Text input focus change
                var inputSearchField = $('.edgtf-fullscreen-search-holder .edgtf-search-field'),
                    inputSearchLine = $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line');

                inputSearchField.focus(function () {
                    inputSearchLine.css('width', '100%');
                });

                inputSearchField.blur(function () {
                    inputSearchLine.css('width', '0');
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchSlideFromHB = {};
    edgtf.modules.searchSlideFromHB = searchSlideFromHB;

    searchSlideFromHB.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchSlideFromHB();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchSlideFromHB() {
        if ( edgtf.body.hasClass( 'edgtf-slide-from-header-bottom' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {
                //Check for type of search
                searchOpener.click(function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchIconPosition = parseInt(edgtf.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

                    if (edgtf.body.hasClass('edgtf-boxed') && edgtf.windowWidth > 1024) {
                        searchIconPosition -= parseInt((edgtf.windowWidth - $('.edgtf-boxed .edgtf-wrapper .edgtf-wrapper-inner').outerWidth()) / 2);
                    }

                    var searchFormHeaderHolder = $('.edgtf-page-header'),
                        searchFormTopOffset = '100%',
                        searchFormTopHeaderHolder = $('.edgtf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.edgtf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.edgtf-mobile-header'),
                        searchForm = $('.edgtf-slide-from-header-bottom-holder'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.edgtf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.edgtf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.edgtf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.edgtf-mobile-header').length;

                    searchForm.removeClass('edgtf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormTopHeaderHolder.find('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + edgtfGlobalVars.vars.edgtfAddForAdminBar;
                        searchFormHeaderHolder.children('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormTopOffset = edgtfGlobalVars.vars.edgtfStickyHeaderHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar;
                        searchFormHeaderHolder.children('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormTopOffset = searchFormMobileHeaderHolder.children('.edgtf-mobile-header-inner').outerHeight() + edgtfGlobalVars.vars.edgtfAddForAdminBar;
                        }
                        searchFormMobileHeaderHolder.find('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else {
                        searchFormHeaderHolder.children('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');
                    }

                    if (searchForm.hasClass('edgtf-is-active')) {
                        searchForm.css({
                            'right': searchIconPosition,
                            'top': searchFormTopOffset
                        }).stop(true).slideToggle(300, 'easeOutBack');
                    }

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) { //KeyCode for ESC button is 27
                            searchForm.stop(true).fadeOut(0);
                        }
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(0);
                    });
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var sidearea = {};
    edgtf.modules.sidearea = sidearea;

    sidearea.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSideArea();
	    edgtfSideAreaScroll();
    }
	
	/**
	 * Show/hide side area
	 */
	function edgtfSideArea() {
		var wrapper = $('.edgtf-wrapper'),
			sideMenuButtonOpen = $('a.edgtf-side-menu-button-opener'),
			cssClass = 'edgtf-right-side-menu-opened';
		
		wrapper.prepend('<div class="edgtf-cover"/>');
		
		$('a.edgtf-side-menu-button-opener, a.edgtf-close-side-menu').click( function(e) {
			e.preventDefault();
			
			if(!sideMenuButtonOpen.hasClass('opened')) {
				sideMenuButtonOpen.addClass('opened');
				edgtf.body.addClass(cssClass);
				
				$('.edgtf-wrapper .edgtf-cover').click(function() {
					edgtf.body.removeClass('edgtf-right-side-menu-opened');
					sideMenuButtonOpen.removeClass('opened');
				});
				
				var currentScroll = $(window).scrollTop();
				$(window).scroll(function() {
					if(Math.abs(edgtf.scroll - currentScroll) > 400){
						edgtf.body.removeClass(cssClass);
						sideMenuButtonOpen.removeClass('opened');
					}
				});
			} else {
				sideMenuButtonOpen.removeClass('opened');
				edgtf.body.removeClass(cssClass);
			}
		});
	}
	
	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function edgtfSideAreaScroll(){
		var sideMenu = $('.edgtf-side-menu');
		
		if(sideMenu.length){
			sideMenu.niceScroll({
				scrollspeed: 60,
				mousescrollstep: 40,
				cursorwidth: 0,
				cursorborder: 0,
				cursorborderradius: 0,
				cursorcolor: "transparent",
				autohidemode: false,
				horizrailenabled: false
			});
		}
	}

})(jQuery);

(function($) {
    "use strict";

    var title = {};
    edgtf.modules.title = title;

    title.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function edgtfParallaxTitle() {
		var parallaxBackground = $('.edgtf-title-holder.edgtf-bg-parallax');
		
		if (parallaxBackground.length > 0 && edgtf.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('edgtf-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(edgtf.scroll * parallaxRate),
				adminBarHeight = edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - edgtf.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(edgtf.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - edgtf.scroll + 'px auto'});
				}
			});
		}
	}

})(jQuery);

(function($) {
    'use strict';

    var woocommerce = {};
    edgtf.modules.woocommerce = woocommerce;

    woocommerce.edgtfOnDocumentReady = edgtfOnDocumentReady;
    woocommerce.edgtfOnWindowLoad = edgtfOnWindowLoad;
    woocommerce.edgtfOnWindowResize = edgtfOnWindowResize;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitQuantityButtons();
        edgtfInitSelect2();
	    edgtfInitSingleProductLightbox();
        edgtfInitProductListFilter().init();
        edgtfAddingToCart();
        edgtfAddingToWishlist();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfInitProductListMasonryShortcode();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function edgtfInitQuantityButtons() {
		$(document).on('click', '.edgtf-quantity-minus, .edgtf-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.edgtf-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('edgtf-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function edgtfInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.edgtf-woocommerce-page .edgtf-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function edgtfInitSingleProductLightbox() {
		var item = $('.edgtf-woo-single-page.edgtf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof edgtf.modules.common.edgtfPrettyPhoto === "function") {
				edgtf.modules.common.edgtfPrettyPhoto();
			}
		}
	}
	
	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function edgtfInitProductListMasonryShortcode() {
		var container = $('.edgtf-pl-holder.edgtf-masonry-layout .edgtf-pl-outer');
		
		if (container.length) {
			container.each(function () {
				var thisContainer = $(this);
				
				thisContainer.waitForImages(function () {
					thisContainer.isotope({
						itemSelector: '.edgtf-pli',
						resizable: false,
						masonry: {
							columnWidth: '.edgtf-pl-sizer',
							gutter: '.edgtf-pl-gutter'
						}
					});
					
					setTimeout(function () {
						if (typeof edgtf.modules.common.edgtfInitParallax === "function") {
							edgtf.modules.common.edgtfInitParallax();
						}
					}, 1000);
					
					thisContainer.isotope('layout').css('opacity', 1);
				});
			});
		}
	}

    function edgtfInitProductListFilter(){
        var productList = $('.edgtf-pl-holder');
        var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.edgtf-pl-categories a, .edgtf-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
        }

        //used for replacing content after ajax call
        var edgtfReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var edgtfReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.edgtf-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var edgtfReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

        var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.edgtf-pl-outer');

            var loadData = edgtf.modules.common.getLoadMoreData(thisProductList),
                loader = thisProductList.find('.edgtf-prl-loading');

            //store parameters in global object
            edgtfReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

            loader.fadeIn();

            var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadData, 'edgtf_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

                    thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('edgtf-masonry-layout')) {
                            edgtfReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            edgtfReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        edgtfAddingToCart();
                        edgtfAddingToWishlist();
                    });

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(edgtf.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }

        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.edgtf-pl-ordering-outer h6'), thisProductList.find('.edgtf-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.edgtf-pl-categories-label'),thisProductList.find('.edgtf-pl-categories-label').next('ul'));
                    });
                }
            },

        }
    }

    function edgtfAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.click(function(){
                $(this).text(edgtfGlobalVars.vars.edgtfAddingToCartLabel);
            });
        }
    }

    function edgtfAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.click(function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.edgtf-pli').length) {
                    wishlistItem = wishlistButton.closest('.edgtf-pli');            // product list shortcode
                } else if (wishlistButton.closest('.edgtf-plc-item').length) {
                    wishlistItem = wishlistButton.closest('.edgtf-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('edgtf-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('edgtf-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('edgtf-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('edgtf-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	edgtf.modules.accordions = accordions;
	
	accordions.edgtfInitAccordions = edgtfInitAccordions;
	
	
	accordions.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function edgtfInitAccordions(){
		var accordion = $('.edgtf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this),
					widthHolder = thisAccordion.find('.edgtf-accordion-width');

				if (thisAccordion.hasClass('edgtf-in-grid')){
					widthHolder.each(function () {
						var thisWidthHolder = $(this);

						thisWidthHolder.addClass('edgtf-grid');
					});
				}

				if(thisAccordion.hasClass('edgtf-accordion')){
					thisAccordion.accordion({
						animate: "easeOutQuad",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content",
						activate: function(event, ui){
							var reinitButtons = ui.newPanel.find('.edgtf-btn.edgtf-btn-text-on-hover');

							reinitButtons.each(function(){
								var thisButton = $(this);

								thisButton.removeClass('edgtf-btn-initialized');
								thisButton.css('width','auto');
								thisButton.find('.edgtf-btn-arrow').css('position','relative');

								edgtf.modules.button.edgtfReinitButton();
							});
						}
					});
				}

				if(thisAccordion.hasClass('edgtf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.edgtf-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(500, 'easeOutQuad' , function(e){
								edgtf.modules.common.edgtfInitParallax();
								
								var reinitButtons = thisTitle.next().find('.edgtf-btn.edgtf-btn-text-on-hover');

								reinitButtons.each(function(){
									var thisButton = $(this);

									thisButton.removeClass('edgtf-btn-initialized');
									thisButton.css('width','auto');
									thisButton.find('.edgtf-btn-arrow').css('position','relative');

									edgtf.modules.button.edgtfReinitButton();
								});
							});
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	edgtf.modules.animationHolder = animationHolder;
	
	animationHolder.edgtfInitAnimationHolder = edgtfInitAnimationHolder;
	
	
	animationHolder.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgtfInitAnimationHolder(){
		var elements = $('.edgtf-grow-in, .edgtf-fade-in-down, .edgtf-element-from-fade, .edgtf-element-from-left, .edgtf-element-from-right, .edgtf-element-from-top, .edgtf-element-from-bottom, .edgtf-flip-in, .edgtf-x-rotate, .edgtf-z-rotate, .edgtf-y-translate, .edgtf-fade-in, .edgtf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	edgtf.modules.button = button;
	
	button.edgtfButton = edgtfButton;
	button.edgtfReinitButton = edgtfReinitButton;
	
	
	button.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfButton().init();
	}

	function edgtfReinitButton(){
		edgtfButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var edgtfButton = function() {
		//all buttons on the page
		var buttons = $('.edgtf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button unveiling animation
		 * @param button current button
		 */
		var buttonUnveiling = function(button) {
			var btnWidth = button.outerWidth(),
				btnText = button.find('.edgtf-btn-text'),
				btnTextWidth = btnText.outerWidth(),
				deltaWidth = Math.round(btnWidth - btnTextWidth),
				btnArrow = button.find('.edgtf-btn-arrow');

			if (!button.hasClass('edgtf-btn-initialized')) {

				button.css('width', deltaWidth);
				btnArrow.css('position', 'absolute'); //wait for calcs to change positioning

				button.mouseenter(function(){
					button.css('width', btnWidth);
				});

				button.mouseleave(function(){
					button.css('width', deltaWidth);
				});

				button.addClass('edgtf-btn-initialized');
			}

		}

		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
					});
					buttons.filter('.edgtf-btn-text-on-hover').each(function(){
						buttonUnveiling($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	edgtf.modules.countdown = countdown;
	
	countdown.edgtfInitCountdown = edgtfInitCountdown;
	
	
	countdown.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function edgtfInitCountdown() {
		var countdowns = $('.edgtf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth != month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	edgtf.modules.counter = counter;
	
	counter.edgtfInitCounter = edgtfInitCounter;
	
	
	counter.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function edgtfInitCounter() {
		var counterHolder = $('.edgtf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edgtf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edgtf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	edgtf.modules.customFont = customFont;
	
	customFont.edgtfCustomFontResize = edgtfCustomFontResize;
	customFont.edgtfCustomFontTypeOut = edgtfCustomFontTypeOut;
	
	
	customFont.edgtfOnDocumentReady = edgtfOnDocumentReady;
	customFont.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(document).ready(edgtfOnDocumentReady);
	$(window).load(edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function edgtfCustomFontResize() {
		var holder = $('.edgtf-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1280') !== 'undefined' && thisItem.data('font-size-1280') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1280') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1280') !== 'undefined' && thisItem.data('line-height-1280') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1280') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1280px) {.edgtf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.edgtf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.edgtf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function edgtfCustomFontTypeOut() {
		var edgtfTyped = $('.edgtf-cf-typed');
		
		if (edgtfTyped.length) {
			edgtfTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.edgtf-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.edgtf-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.edgtf-cf-typed-1').text(),
					string_2 = thisTyped.find('.edgtf-cf-typed-2').text(),
					string_3 = thisTyped.find('.edgtf-cf-typed-3').text(),
					string_4 = thisTyped.find('.edgtf-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	edgtf.modules.elementsHolder = elementsHolder;
	
	elementsHolder.edgtfInitElementsHolderResponsiveStyle = edgtfInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function edgtfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.edgtf-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.edgtf-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('680-768') !== 'undefined' && thisItem.data('680-768') !== false) {
						ipadPortrait = thisItem.data('680-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1281px) and (max-width: 1600px) {.edgtf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1280px) {.edgtf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.edgtf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.edgtf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
				if (typeof edgtf.modules.common.edgtfOwlSlider === "function") {
					edgtf.modules.common.edgtfOwlSlider();

					var owlCarousels = $('.edgtf-owl-slider');
					owlCarousels.each(function(){
						$(this).data('owl.carousel').onResize();
					});
				}
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var fullScreenImageSlider = {};
	edgtf.modules.fullScreenImageSlider = fullScreenImageSlider;
	
	
	fullScreenImageSlider.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(window).load(edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfInitFullScreenImageSlider();
	}
	
	/**
	 * Init Full Screen Image Slider Shortcode
	 */
	function edgtfInitFullScreenImageSlider() {
		var holder = $('.edgtf-fsis-slider');
		
		if (holder.length) {
			holder.each(function () {
				var sliderHolder = $(this),
					mainHolder = sliderHolder.parent(),
					prevThumbNav = mainHolder.children('.edgtf-fsis-prev-nav'),
					nextThumbNav = mainHolder.children('.edgtf-fsis-next-nav'),
					maskHolder = mainHolder.children('.edgtf-fsis-slider-mask');
				
				mainHolder.addClass('edgtf-fsis-is-init');
				
				edgtfImageBehavior(sliderHolder);
				edgtfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, -1); // -1 is arbitrary value because 0 can be index of item
				
				sliderHolder.on('drag.owl.carousel', function () {
					setTimeout(function () {
						if (!maskHolder.hasClass('edgtf-drag') && !mainHolder.hasClass('edgtf-fsis-active')) {
							maskHolder.addClass('edgtf-drag');
						}
					}, 200);
				});
				
				sliderHolder.on('dragged.owl.carousel', function () {
					setTimeout(function () {
						if (maskHolder.hasClass('edgtf-drag')) {
							maskHolder.removeClass('edgtf-drag');
						}
					}, 300);
				});
				
				sliderHolder.on('translate.owl.carousel', function (e) {
					edgtfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, e.item.index);
				});
				
				sliderHolder.on('translated.owl.carousel', function () {
					edgtfImageBehavior(sliderHolder);
					
					setTimeout(function () {
						maskHolder.removeClass('edgtf-drag');
					}, 300);
				});
			});
		}
	}
	
	function edgtfImageBehavior(sliderHolder) {
		var activeItem = sliderHolder.find('.owl-item.active'),
			imageHolder = sliderHolder.find('.edgtf-fsis-item');
		
		imageHolder.removeClass('edgtf-fsis-content-image-init');
		
		edgtfResetImageBehavior(sliderHolder);
		
		if (activeItem.length) {
			var activeImageHolder = activeItem.find('.edgtf-fsis-item'),
				activeItemImage = activeImageHolder.children('.edgtf-fsis-image');
			
			setTimeout(function () {
				activeImageHolder.addClass('edgtf-fsis-content-image-init');
			}, 100);
			
			activeItemImage.off().on('mouseenter', function () {
				activeImageHolder.addClass('edgtf-fsis-image-hover');
			}).on('mouseleave', function () {
				activeImageHolder.removeClass('edgtf-fsis-image-hover');
			}).on('click', function () {
				if (activeImageHolder.hasClass('edgtf-fsis-active-image')) {
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('edgtf-fsis-active');
					activeImageHolder.removeClass('edgtf-fsis-active-image');
				} else {
					sliderHolder.trigger('stop.owl.autoplay');
					sliderHolder.parent().addClass('edgtf-fsis-active');
					activeImageHolder.addClass('edgtf-fsis-active-image');
				}
			});
			
			//Close on escape
			$(document).keyup(function (e) {
				if (e.keyCode === 27) { //KeyCode for ESC button is 27
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('edgtf-fsis-active');
					activeImageHolder.removeClass('edgtf-fsis-active-image');
				}
			});
		}
	}
	
	function edgtfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, itemIndex) {
		var activeItem = itemIndex === -1 ? sliderHolder.find('.owl-item.active') : $(sliderHolder.find('.owl-item')[itemIndex]),
			prevItemImage = activeItem.prev().find('.edgtf-fsis-image').css('background-image'),
			nextItemImage = activeItem.next().find('.edgtf-fsis-image').css('background-image');
		
		if (prevItemImage.length) {
			prevThumbNav.css({'background-image': prevItemImage});
		}
		
		if (nextItemImage.length) {
			nextThumbNav.css({'background-image': nextItemImage});
		}
	}
	
	function edgtfResetImageBehavior(sliderHolder) {
		var imageHolder = sliderHolder.find('.edgtf-fsis-item');
		
		if (imageHolder.length) {
			imageHolder.removeClass('edgtf-fsis-active-image');
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	edgtf.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.edgtfInitFullScreenSections = edgtfInitFullScreenSections;
	
	
	fullScreenSections.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function edgtfInitFullScreenSections(){
		var fullScreenSections = $('.edgtf-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.edgtf-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.edgtf-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('edgtf-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';
				
				var defaultHeaderStyle = '';
				if (edgtf.body.hasClass('edgtf-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (edgtf.body.hasClass('edgtf-dark-header')) {
					defaultHeaderStyle = 'dark';
				}
				
				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}
				
				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';
				
				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.edgtf-fss-item',
					scrollingSpeed: 1200,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.edgtf-fss-nav-holder').css('visibility','visible');
						}
						
						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});
				
				setResposniveData(thisFullScreenSections);
				
				if(enableNavigation) {
					thisFullScreenSections.find('#edgtf-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});
					
					thisFullScreenSections.find('#edgtf-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + default_header_style + '-header');
		} else {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#edgtf-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#edgtf-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.edgtf-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1280px) {.edgtf-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.edgtf-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.edgtf-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var fullscreenCarousel = {};
    edgtf.modules.fullscreenCarousel = fullscreenCarousel;

    fullscreenCarousel.edgtfInitFullscreenCarousel = edgtfInitFullscreenCarousel;

    fullscreenCarousel.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitFullscreenCarousel();
    }

    /**
     * Init Fullscreen Carousel shortcode
     */
    function edgtfInitFullscreenCarousel() {
        var fullscreenCarousels = $('.edgtf-fullscreen-carousel-holder');

        if (fullscreenCarousels.length) {
            fullscreenCarousels.each(function(){
                var fullscreenCarousel = $(this),
                    items = fullscreenCarousel.find('.edgtf-fsc-item'),
                    images = fullscreenCarousel.find('.edgtf-fcs-item-image'),
                    nextTrigger = fullscreenCarousel.find('.edgtf-fsc-next-trigger'),
                    mouseXBuffer;

                //fullscreen calcs
                var fullscreenCalcs = function() {
                    var heightVal = edgtf.windowHeight - fullscreenCarousel.offset().top;

                    if (edgtf.body.hasClass('edgtf-paspartu-enabled')) {
                        var passepartoutSize = parseInt($('.edgtf-wrapper').css('padding-top'));

                        heightVal -= passepartoutSize;
                    }

                    fullscreenCarousel.css('height', heightVal);
                }

                //item classes setup
                var prepItems = function() {
                    items.first().addClass('edgtf-active').find('> div').css('transition','none');
                    fullscreenCarousel.css('visibility','visible');
                    setTimeout(function(){
                        items.filter('.edgtf-active').next().addClass('edgtf-next');
                    }, 200);
                }

                //slideshow logic start
                var startAnimating = function() {
                    fullscreenCarousel.addClass('edgtf-animating');
                }

                var endAnimating = function() {
                    updateNav();

                    items.filter('.edgtf-active').one(edgtf.transitionEnd,function(){
                        fullscreenCarousel.removeClass('edgtf-animating');
                    });
                }

                var changeItem = function() {
                    startAnimating(); //before change

                    var nextIndex;

                    //loop
                    if (items.filter('.edgtf-active').data('index') < items.length) { 
                        nextIndex = items.filter('.edgtf-active').next().data('index') - 1;
                    } else {
                        nextIndex = 0;
                    }

                    items.find('> div').removeAttr('style');
                    items.removeClass('edgtf-remove');
                    items.filter('.edgtf-active').addClass('edgtf-remove');
                    items.removeClass('edgtf-active edgtf-next');
                    items.eq(nextIndex).addClass('edgtf-active');
                    if (nextIndex < items.length - 1) {
                        items.filter('.edgtf-active').next().addClass('edgtf-next');
                    } else {
                        items.first().addClass('edgtf-next');
                    }

                    endAnimating(); //after change
                }
                //slideshow logic end

                //change on click
                var slideshowTrigger = function() {
                    nextTrigger.on('click', function(e){
                        if (!fullscreenCarousel.hasClass('edgtf-animating')) {
                            changeItem();         
                        }           
                    });

                    nextTrigger.on('mouseenter', function(){
                        fullscreenCarousel.addClass('edgtf-peek');
                    }).on('mouseleave', function(){
                        fullscreenCarousel.removeClass('edgtf-peek');
                    });
                }

                //change on scroll
                var slideshowScroll = function() {
                    if (fullscreenCarousel.hasClass('edgtf-fsc-slide-on-scroll') && !edgtf.htmlEl.hasClass('touch')) {
                        var delta = 0;

                        fullscreenCarousel.mousewheel(function(e) {
                            e.preventDefault();

                            if (!fullscreenCarousel.hasClass('edgtf-animating')) {
                                if (e.deltaY < 0) {
                                    delta = -1;
                                } else {
                                    delta = 1;
                                }

                                if (delta == -1 ) {
                                    changeItem();
                                }
                            }
                        });

                        fullscreenCarousel.on('wheel', function() { return false; });
                    }
                }

                //update indicators
                var updateNav = function() {
                    if (fullscreenCarousel.hasClass('edgtf-fsc-with-progress-indicator')) {
                        var bullets = fullscreenCarousel.find('.edgtf-fsc-indicator-bullet'), 
                            activeIndex = items.filter('.edgtf-active').data('index') - 1;

                        bullets.removeClass('edgtf-active');
                        bullets.eq(activeIndex).addClass('edgtf-active');
                    }
                }

                //init
                fullscreenCarousel.waitForImages(function(){
                    fullscreenCalcs();
                    prepItems();
                    slideshowTrigger();
                    slideshowScroll();
                    updateNav();
                });

                $(window).resize(function(){
                    fullscreenCalcs();
                });
            });
        }
    }
})(jQuery);

(function($) {
	'use strict';
	
	var googleMap = {};
	edgtf.modules.googleMap = googleMap;
	
	googleMap.edgtfShowGoogleMap = edgtfShowGoogleMap;
	
	
	googleMap.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function edgtfShowGoogleMap(){
		var googleMap = $('.edgtf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var predefinedStyle = false;
				if(typeof element.data('predefined-style') !== 'undefined' && element.data('predefined-style') === 'yes') {
					predefinedStyle = true;
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "edgtf-map-"+ uniqueId;
				
				edgtfInitializeGoogleMap(predefinedStyle, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function edgtfInitializeGoogleMap(predefinedStyle, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}

		var mapStyles = [];
		if(predefinedStyle) {
			mapStyles = [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e9e9e9"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dedede"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "saturation": 36
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                }
            ];
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(predefinedStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'edgtf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}


		
		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Edge Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgtf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('edgtf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			edgtfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function edgtfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	edgtf.modules.icon = icon;
	
	icon.edgtfIcon = edgtfIcon;
	
	
	icon.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgtfIcon = function() {
		var icons = $('.edgtf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('edgtf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.edgtf-icon-animation-holder').addClass('edgtf-icon-animation-show');
				}, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.edgtf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	edgtf.modules.iconListItem = iconListItem;
	
	iconListItem.edgtfInitIconList = edgtfInitIconList;
	
	
	iconListItem.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var edgtfInitIconList = function() {
		var iconList = $('.edgtf-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('edgtf-appeared');
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';
	
	var imageGallery = {};
	edgtf.modules.imageGallery = imageGallery;
	
	imageGallery.edgtfInitImageGalleryMasonry = edgtfInitImageGalleryMasonry;
	
	
	imageGallery.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(window).load(edgtfOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function edgtfInitImageGalleryMasonry(){
		var holder = $('.edgtf-image-gallery.edgtf-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edgtf-ig-masonry');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgtf-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.edgtf-ig-grid-gutter',
							columnWidth: '.edgtf-ig-grid-sizer'
						}
					});
					
					setTimeout(function() {
						masonry.isotope('layout');
						edgtf.modules.common.edgtfInitParallax();
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var infoBox = {};
    edgtf.modules.infoBox = infoBox;

    infoBox.edgtfInfoBoxAnimation = edgtfInfoBoxAnimation;
    infoBox.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInfoBoxAnimation();
    }

    /**
     * Init info box animation
     */
    function edgtfInfoBoxAnimation(){
        var items = $('.edgtf-info-boxes-holder');

        if(items.length && edgtf.htmlEl.hasClass('touch')){
            items.on('click', function(){
                $(this).toggleClass('edgtf-ib-touch-anim');
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';
	
	var linkSection = {};
	edgtf.modules.linkSection = linkSection;
	
	linkSection.edgtfLinkSectionAnimation = edgtfLinkSectionAnimation;
	linkSection.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfLinkSectionAnimation();
	}
	
	/**
	 * Init link section animation
	 */
	function edgtfLinkSectionAnimation(){
		var items = $('.edgtf-link-section-holder.edgtf-appear-fx');

		if(items.length && !edgtf.htmlEl.hasClass('touch')){
			items.appear(function(){
			 	$(this).addClass('edgtf-appear');
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	edgtf.modules.pieChart = pieChart;
	
	pieChart.edgtfInitPieChart = edgtfInitPieChart;
	
	
	pieChart.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function edgtfInitPieChart() {
		var pieChartHolder = $('.edgtf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.edgtf-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 4,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.edgtf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var process = {};
	edgtf.modules.process = process;
	
	process.edgtfInitProcess = edgtfInitProcess;
	
	
	process.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function edgtfInitProcess() {
		var holder = $('.edgtf-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('edgtf-process-appeared');
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	edgtf.modules.progressBar = progressBar;
	
	progressBar.edgtfInitProgressBars = edgtfInitProgressBars;
	
	
	progressBar.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function edgtfInitProgressBars(){
		var progressBar = $('.edgtf-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function(i) {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.edgtf-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBarContent.css('width', '0%');

				thisBar.appear(function() {
					setTimeout(function(){
						thisBarContent.css({'width': percentage+'%'});
						edgtfInitToCounterProgressBar(thisBar, percentage);
					}, i * 100);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function edgtfInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.edgtf-pb-percent');
		
		if(percent.length) {
			percent.each(function(i) {
				var thisPercent = $(this);

				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 1000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';
	
	var sectionTitle = {};
	edgtf.modules.sectionTitle = sectionTitle;
	
	sectionTitle.edgtfSectionTitleAnimation = edgtfSectionTitleAnimation;
	sectionTitle.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfSectionTitleAnimation();
	}
	
	/**
	 * Init section title animation
	 */
	function edgtfSectionTitleAnimation(){
		var items = $('.edgtf-st-square.edgtf-appear-fx');

		if(items.length && !edgtf.htmlEl.hasClass('touch')){
			items.appear(function(){
			 	$(this).addClass('edgtf-appear');
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	edgtf.modules.tabs = tabs;
	
	tabs.edgtfInitTabs = edgtfInitTabs;
	
	
	tabs.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgtfInitTabs(){
		var tabs = $('.edgtf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edgtf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edgtf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.edgtf-tabs a.edgtf-external-link').unbind('click');
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	edgtf.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.edgtfInitVerticalSplitSlider = edgtfInitVerticalSplitSlider;
	
	
	verticalSplitSlider.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function edgtfInitVerticalSplitSlider() {
		var slider = $('.edgtf-vertical-split-slider');
		
		if (slider.length) {
			if (edgtf.body.hasClass('edgtf-vss-initialized')) {
				edgtf.body.removeClass('edgtf-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(edgtf.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (edgtf.body.hasClass('edgtf-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (edgtf.body.hasClass('edgtf-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.edgtf-vss-ms-section',
				leftSelector: '.edgtf-vss-ms-left',
				rightSelector: '.edgtf-vss-ms-right',
				afterRender: function () {
					edgtfCheckVerticalSplitSectionsForHeaderStyle($('.edgtf-vss-ms-left .edgtf-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					edgtf.body.addClass('edgtf-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="edgtf-vss-responsive"></div>'),
						leftSide = slider.find('.edgtf-vss-ms-left > div'),
						rightSide = slider.find('.edgtf-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.edgtf-vss-responsive .edgtf-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'edgtf-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof edgtf.modules.animationHolder.edgtfInitAnimationHolder === "function") {
						edgtf.modules.animationHolder.edgtfInitAnimationHolder();
					}
					
					if (typeof edgtf.modules.button.edgtfButton === "function") {
						edgtf.modules.button.edgtfButton().init();
					}
					
					if (typeof edgtf.modules.elementsHolder.edgtfInitElementsHolderResponsiveStyle === "function") {
						edgtf.modules.elementsHolder.edgtfInitElementsHolderResponsiveStyle();
					}
					
					if (typeof edgtf.modules.googleMap.edgtfShowGoogleMap === "function") {
						edgtf.modules.googleMap.edgtfShowGoogleMap();
					}
					
					if (typeof edgtf.modules.icon.edgtfIcon === "function") {
						edgtf.modules.icon.edgtfIcon().init();
					}
					
					if (typeof edgtf.modules.progressBar.edgtfInitProgressBars === "function") {
						edgtf.modules.progressBar.edgtfInitProgressBars();
					}
				},
				onLeave: function (index, nextIndex) {
					edgtfIntiScrollAnimation(slider, nextIndex);
					edgtfCheckVerticalSplitSectionsForHeaderStyle($($('.edgtf-vss-ms-left .edgtf-vss-ms-section')[$(".edgtf-vss-ms-left .edgtf-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (edgtf.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (edgtf.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	function edgtfIntiScrollAnimation(slider, nextIndex) {
		
		if (slider.hasClass('edgtf-vss-scrolling-animation')) {
			
			if (nextIndex > 1 && !slider.hasClass('edgtf-vss-scrolled')) {
				slider.addClass('edgtf-vss-scrolled');
			} else if (nextIndex === 1 && slider.hasClass('edgtf-vss-scrolled')) {
				slider.removeClass('edgtf-vss-scrolled');
			}
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function edgtfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + default_header_style + '-header');
		} else {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header');
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    edgtf.modules.portfolio = portfolio;

    portfolio.edgtfOnDocumentReady = edgtfOnDocumentReady;
    portfolio.edgtfOnWindowLoad = edgtfOnWindowLoad;
    portfolio.edgtfOnWindowResize = edgtfOnWindowResize;
    portfolio.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
    	edgtfPortfolioSection();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitPortfolioMasonry();
        edgtfInitPortfolioFilter();
        initPortfolioSingleMasonry();
        edgtfInitPortfolioListAnimation();
	    edgtfInitPortfolioPagination().init();
        edgtfPortfolioSingleFollow().init();
        edgtfPortfolioFullscreenGrid();
        edgtfPortfolioFullscreenGridSize();
        edgtfPortfolioFullscreenSlider();
		edgtfPortfolioScrollableList().init();
		edgtfPortfolioScrollableScroll();
		edgtfPortfolioSingleStick().init();
        edgtfPortfolioProjectAnimation();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtfOnWindowResize() {
        edgtfInitPortfolioMasonry();
        edgtfPortfolioFullscreenGridSize();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtfOnWindowScroll() {
	    edgtfInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgtfInitPortfolioListAnimation(){
        var portList = $('.edgtf-portfolio-list-holder.edgtf-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.edgtf-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('edgtf-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('edgtf-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function edgtfInitPortfolioMasonry(){
        var portList = $('.edgtf-portfolio-list-holder.edgtf-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.edgtf-pl-inner'),
                    size = thisPortList.find('.edgtf-pl-grid-sizer').width();
                
                edgtfResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.edgtf-pl-grid-gutter',
                        columnWidth: '.edgtf-pl-grid-sizer'
                    }
                });
                
                setTimeout(function () {
	                edgtf.modules.common.edgtfInitParallax();
                }, 600);

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Portfolio Items
     */
    function edgtfResizePortfolioItems(size,container){
        if(container.hasClass('edgtf-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edgtf-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.edgtf-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.edgtf-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.edgtf-pl-masonry-large-width-height');

            if (edgtf.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function edgtfInitPortfolioFilter(){
        var filterHolder = $('.edgtf-portfolio-list-holder .edgtf-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.edgtf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.edgtf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('edgtf-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.edgtf-pl-filter:first').addClass('edgtf-pl-current');
	            
	            if(thisPortListHolder.hasClass('edgtf-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.edgtf-pl-filter').click(function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.edgtf-pl-filter').removeClass('edgtf-pl-current');
                    thisFilter.addClass('edgtf-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                edgtfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.edgtf-pl-inner').isotope({ filter: filterValue });
	                    edgtf.modules.common.edgtfInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function edgtfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.edgtf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edgtf_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.edgtf-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('edgtf-showing edgtf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
                                edgtfResizePortfolioItems(thisPortListInner.find('.edgtf-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('edgtf-showing edgtf-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    edgtfInitPortfolioListAnimation();
	                                edgtf.modules.common.edgtfInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('edgtf-showing edgtf-filter-trigger');
                            edgtfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function edgtfInitPortfolioPagination(){
		var portList = $('.edgtf-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.edgtf-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.edgtf-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			if(!thisPortList.hasClass('edgtf-pl-infinite-scroll-started') && edgtf.scroll + edgtf.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.edgtf-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('edgtf-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('edgtf-pl-pag-infinite-scroll')) {
				thisPortList.addClass('edgtf-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.edgtf-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages == 0){
				if(thisPortList.hasClass('edgtf-pl-pag-standard')) {
					loadingItem.addClass('edgtf-showing edgtf-standard-pag-trigger');
					thisPortList.addClass('edgtf-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('edgtf-showing');
				}
				
				var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edgtf_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtfGlobalVars.vars.edgtfAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('edgtf-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('edgtf-pl-pag-standard')) {
							edgtfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edgtf-pl-masonry')){
									edgtfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edgtf-pl-gallery') && thisPortList.hasClass('edgtf-pl-has-filter')) {
									edgtfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgtfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edgtf-pl-masonry')){
								    if(pagedLink == 1) {
                                        edgtfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        edgtfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('edgtf-pl-gallery') && thisPortList.hasClass('edgtf-pl-has-filter') && pagedLink != 1) {
									edgtfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgtfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('edgtf-pl-infinite-scroll-started')) {
							thisPortList.removeClass('edgtf-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.edgtf-pl-load-more-holder').hide();
			}
		};
		
		var edgtfInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.edgtf-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edgtf-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edgtf-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edgtf-pl-pag-next a');
			
			standardPagNumericItem.removeClass('edgtf-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edgtf-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgtfInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            edgtfResizePortfolioItems(thisPortListInner.find('.edgtf-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
			thisPortList.removeClass('edgtf-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgtfInitPortfolioListAnimation();
				edgtf.modules.common.edgtfInitParallax();
			}, 600);
		};
		
		var edgtfInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
			thisPortList.removeClass('edgtf-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			edgtfInitPortfolioListAnimation();
			edgtf.modules.common.edgtfInitParallax();
		};
		
		var edgtfInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
            edgtfResizePortfolioItems(thisPortListInner.find('.edgtf-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgtf-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgtfInitPortfolioListAnimation();
				edgtf.modules.common.edgtfInitParallax();
			}, 600);
		};
		
		var edgtfInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgtf-showing');
			thisPortListInner.append(responseHtml);
			edgtfInitPortfolioListAnimation();
			edgtf.modules.common.edgtfInitParallax();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edgtf-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edgtf-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edgtf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edgtf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}
	
	var edgtfPortfolioSingleFollow = function() {
		var info = $('.edgtf-follow-portfolio-info .edgtf-portfolio-single-holder .edgtf-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.edgtf-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .edgtf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0;
		}
		
		var infoHolderPosition = function() {
			if(info.length) {
				if (mediaHolderHeight > infoHolderHeight) {
					if(edgtf.scroll > infoHolderOffset) {
						var marginTop = edgtf.scroll - infoHolderOffset + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight;
						// if scroll is initially positioned below mediaHolderHeight
						if(marginTop + infoHolderHeight > mediaHolderHeight){
							marginTop = mediaHolderHeight - infoHolderHeight;
						}
						info.stop().css({
							'transform': 'translate3d(0px, ' + marginTop + ' px, 0px)'
						});
					}
				}
			}
		};
		
		var recalculateInfoHolderPosition = function() {
			if (info.length) {
				if(mediaHolderHeight > infoHolderHeight) {
					if(edgtf.scroll > infoHolderOffset) {
						
						if(edgtf.scroll + headerHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar + infoHolderHeight + 50 < infoHolderOffset + mediaHolderHeight) { //50 to prevent mispositioning
							
							//Calculate header height if header appears
							if ($('.header-appear, .edgtf-fixed-wrapper').length) {
								headerHeight = $('.header-appear, .edgtf-fixed-wrapper').height();
							}
							info.stop().css({
								'transform': 'translate3d(0px, ' + (edgtf.scroll - infoHolderOffset + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight) + 'px, 0px)'
							});
							//Reset header height
							headerHeight = 0;
						}
						else{
							info.stop().css({
								'transform': 'translate3d(0px, ' + (mediaHolderHeight - infoHolderHeight) + 'px, 0px)'
							});
						}
					} else {
						info.stop().css({
							'transform': 'translate3d(0,0,0)'
						});
					}
				}
			}
		};
		
		return {
			init : function() {
				infoHolderPosition();
				$(window).scroll(function(){
					recalculateInfoHolderPosition();
				});
			}
		};
	};
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.edgtf-portfolio-single-holder .edgtf-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.edgtf-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.edgtf-ps-grid-gutter',
                    columnWidth: '.edgtf-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

	function edgtfPortfolioFullscreenGrid(){
		var fullscreenGrid = $('.edgtf-fullscreen-portfolio-grid-holder');

		if (fullscreenGrid.length){
			fullscreenGrid.each(function () {
				var thisGrid = $(this),
					articles = thisGrid.find('.edgtf-fpg-item'),
					articlesLink = thisGrid.find('.edgtf-fpgi-link'),
					articlesImages = thisGrid.find('.edgtf-fpg-image-holder .edgtf-image-url-holder-inner');


				articles.eq(0).addClass('hovered');
				articlesImages.eq(0).addClass('hovered');

				//remove first click when on touch devices - go to link on second click
            	if(edgtf.htmlEl.hasClass('touch')){
					articlesLink.eq(0).addClass('active');

					articlesLink.each(function () {
						var link = $(this);

						link.on('click', function(e){
							if (!link.hasClass('active')) {
								e.preventDefault();
								articlesLink.removeClass('active');
								link.addClass('active');
							}

						});
					});
				}

				articles.each(function(e){
					var thisArticle = $(this);

					thisArticle.on('mouseover', function () {

						var imageHolder = articlesImages.eq(e);

						if (!thisArticle.hasClass('hovered')){
							thisArticle.siblings().removeClass('hovered');
							imageHolder.siblings().removeClass('hovered');

							thisArticle.addClass('hovered');
							imageHolder.addClass('hovered');
						}
					});
				});

			});
		}
	}

	function edgtfPortfolioFullscreenGridSize(){
		var fullscreenGrid = $('.edgtf-fullscreen-portfolio-grid-holder');

		if (fullscreenGrid.length){
			fullscreenGrid.each(function () {
				var thisGrid = $(this),
					thisGridHeight,
					articlesHolder = thisGrid.find('.edgtf-fpg-holder-inner'),
					articles = thisGrid.find('.edgtf-fpg-item'),
					columns,
					postsNumber,
					numberOfRows,
					articleHeight,
                    mobileHeaderHeight = $('.edgtf-mobile-header').height();


            	if(edgtf.htmlEl.hasClass('touch')){
            		thisGrid.css('height','calc(100vh - '+mobileHeaderHeight+'px)');
            	}

            	thisGridHeight = thisGrid.height();

				if (typeof thisGrid.data('col-number') !== 'undefined' && thisGrid.data('col-number') !== ''){
					columns = thisGrid.data('col-number');
				}

				if (typeof thisGrid.data('number-of-posts') !== 'undefined' && thisGrid.data('number-of-posts') !== ''){
					postsNumber = thisGrid.data('number-of-posts');
				}

				if (edgtf.windowWidth <= 480){
					columns = 1;
				} else if (edgtf.windowWidth <= 768){
					if (columns > 2){
						columns = 2;
					}
				}

				if (postsNumber !== 0){
					numberOfRows = Math.ceil(postsNumber/columns);
				}

				articleHeight = thisGridHeight/numberOfRows;

				if (edgtf.windowWidth <= 480){
					articleHeight = 'auto';
				}

				articles.each(function(e){
					var thisArticle = $(this);

					thisArticle.height(articleHeight);
				});

				//2px is for rounding of px
				if (articlesHolder.height() > thisGridHeight + 2){
					thisGrid.css('height','auto');
				}

				thisGrid.css('opacity',1);

			});
		}
	}

	function edgtfPortfolioFullscreenSlider(){
		var fullscreenSliders = $('.edgtf-portfolio-fullscreen-slider-holder');

		if (fullscreenSliders.length){
			fullscreenSliders.each(function () {
				var thisSlider = $(this),
					articles = thisSlider.find('.edgtf-pfs-item'),
					articlesLink = thisSlider.find('.edgtf-pfs-link'),
					articlesImages = thisSlider.find('.edgtf-pfs-image-holder .edgtf-pfs-image-holder-item'),
					articlesHolder = thisSlider.find('.edgtf-pfs-articles-holder'),
                    swiperInstance = thisSlider.find('.swiper-container'),
                    direction = 'vertical',
                    loop = false,
                    wheel = true,
                    slideSpeed = 600,
                    slidesOffsetBefore = 0,
                    mobileHeaderHeight = $('.edgtf-mobile-header').height();


				articles.eq(0).addClass('hovered');
				articlesImages.eq(0).addClass('hovered');

				//remove first click when on touch devices - go to link on second click
            	if(edgtf.htmlEl.hasClass('touch')){
					articlesLink.eq(0).addClass('active');

					articlesLink.each(function () {
						var link = $(this);

						link.on('click', function(e){
							if (!link.hasClass('active')) {
								e.preventDefault();
								articlesLink.removeClass('active');
								link.addClass('active');
							}
						});
					});
				}

				articles.each(function(e){
					var thisArticle = $(this);

					thisArticle.on('mouseover', function () {
						var imageHolder = articlesImages.eq(e);

						if (!thisArticle.hasClass('hovered')){
							thisArticle.siblings().removeClass('hovered');
							imageHolder.siblings().removeClass('hovered');

							thisArticle.addClass('hovered');
							imageHolder.addClass('hovered');
						}
					});
				});

            	if(edgtf.htmlEl.hasClass('touch')){
            		thisSlider.css('height','calc(100vh - '+mobileHeaderHeight+'px)');
            	}

            	slidesOffsetBefore = -edgtf.windowHeight * 0.3;

				if(edgtf.windowWidth <= 1300) {
					slidesOffsetBefore = -edgtf.windowHeight * 0.6;
				}

                if(edgtf.windowWidth <= 1025) {
                    slidesOffsetBefore = -edgtf.windowHeight * 0.3;
                }

                if (edgtf.htmlEl.hasClass('touch')) {

                    articles.each(function(){
                        $(this).css('min-height', $(this).outerHeight());
                    })
                }

                //sliders
                var swiperSlider = new Swiper(swiperInstance, {
                    loop: loop,
                    initialSlide: 0,
                    slidesOffsetBefore: slidesOffsetBefore,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    speed: slideSpeed,
                    direction: direction,
                    mousewheelControl: wheel,
                    preventClicks: true,
                    preventClicksPropagation: false,
                    onInit: function() {
                        thisSlider.addClass('edgtf-initialized');
                    },
                    onSlideChangeEnd: function(slider) {
                        var lastSlide = articlesHolder.find('.edgtf-pfs-item').last();

                        if (lastSlide.offset().top + lastSlide.height() <= edgtf.windowHeight) {
                            slider.lockSwipeToNext();
                        } else {
                            slider.unlockSwipeToNext();
                        }
                    }
                });

			});
		}
	}

    var edgtfPortfolioScrollableList = function(){
        var scrollableList = $('.edgtf-pl-scrollable');
        var header = '';
        if($('.edgtf-fixed-wrapper').length){
            header = '.edgtf-page-header .fixed';
        }else{
            header = '.edgtf-page-header .header-appear';
        }

        scrollableList.addClass('edgtf-ptf-hovered');

        var edgtfPortfolioScrollPosition = function(scrollableHolder){
            var thisMeta = scrollableHolder.find('.edgtf-ptf-list-showcase-meta'),
                thisMetaInner = thisMeta.find('.edgtf-ptf-list-showcase-meta-inner');
            thisMetaInner.css({
                'left': thisMeta.offset().left,
                'width': thisMeta.width()
            });
        };

        var edgtfPortfolioScrollFix = function(scrollableHolder){
            var thisMeta = scrollableHolder.find('.edgtf-ptf-list-showcase-meta'),
                thisMetaInner = thisMeta.find('.edgtf-ptf-list-showcase-meta-inner'),
                thisMetaInnerHeight = thisMetaInner.height(),
                thisPreview = scrollableHolder.find('.edgtf-ptf-list-showcase-preview'),
                thisPreviewOffsetTop = thisPreview.offset().top,
                thisPreviewOffsetBottom = thisPreview.offset().top + thisPreview.height(),
                topPosition = $(header).height() + edgtfGlobalVars.vars.edgtfAddForAdminBar;

            if (thisPreviewOffsetTop <= edgtf.scroll + topPosition && thisPreviewOffsetBottom > edgtf.scroll){
                if (!thisMeta.hasClass('edgtf-fix-meta')){
                    thisMeta.addClass('edgtf-fix-meta');
                    edgtfPortfolioScrollPosition(scrollableHolder);
                }
                if (thisPreviewOffsetBottom < edgtf.scroll + topPosition + thisMetaInnerHeight){
                    thisMeta.addClass('edgtf-fix-bottom');
                    thisMetaInner.css('top',thisPreviewOffsetBottom - (edgtf.scroll + thisMetaInnerHeight));
                }
                else{
                    thisMeta.removeClass('edgtf-fix-bottom');
                    thisMetaInner.css('top',topPosition);
                }
            }
            else{
                thisMeta.removeClass('edgtf-fix-meta');
                thisMeta.removeClass('edgtf-fix-bottom');
            }
        };


        var edgtfProjectsListHover = function(scrollableHolder){
            var thisMeta = scrollableHolder.find('.edgtf-ptf-list-showcase-meta'),
                thisMetaHolder = scrollableHolder.find('.edgtf-ptf-list-showcase-meta-items-holder'),
                thisPreviewHolder = scrollableHolder.find('.edgtf-ptf-list-showcase-preview'),
                thisMetaChildren = thisMetaHolder.find('.edgtf-ptf-list-showcase-meta-item'),
                thisPreviewChildren = thisPreviewHolder.find('.edgtf-ptf-list-showcase-preview-item'),
                thisMetaLink = thisMetaHolder.find('.edgtf-ptf-meta-item-title a'),
                projectNum = 1;

            thisMetaChildren.first().addClass('active');
            thisPreviewChildren.first().addClass('active');

            thisPreviewChildren.on('mouseenter',function () {
                projectNum = $(this).index();
                var currentProject = $(this);


                thisMetaChildren.removeClass('active');
                thisPreviewChildren.removeClass('active');
                thisMetaChildren.clearQueue();
                thisMetaChildren.eq(projectNum).addClass('active');
                currentProject.addClass('active');
            });

            thisMetaChildren.on('click touch',function () {
                projectNum = $(this).index();
                var currentProject = $(this);
                var currentPreview = thisPreviewChildren.eq(projectNum);
                var currentScroll = currentPreview.offset().top - edgtf.windowHeight/2 + currentPreview.height()/2;
                var scrollFromTop = thisMeta.offset().top - $(header).height();


                thisMetaChildren.removeClass('active');
                thisPreviewChildren.removeClass('active');
                thisPreviewChildren.clearQueue();
                currentProject.addClass('active');
                currentPreview.addClass('active');

                if (projectNum == 0){
                    edgtf.html.stop().animate({scrollTop: scrollFromTop}, 1200, 'easeOutExpo');
                }
                else{
                    edgtf.html.stop().animate({scrollTop: currentScroll}, 1200, 'easeOutExpo');
                }
            });

            thisMetaLink.on('click touch',function (e) {
                var thisLink = $(this);

                if (!thisLink.parents('.edgtf-ptf-list-showcase-meta-item').hasClass('active')){
                    e.preventDefault();
                }
            });

            scrollableHolder.on('mouseleave',function () {
                thisMetaChildren.removeClass('active');
                thisPreviewChildren.removeClass('active');
            });

        };

        return {

            init : function() {
                if (scrollableList.length && edgtf.windowWidth > 768){
                    scrollableList.each(function () {
                        var thisScrollable = $(this);
                        edgtfProjectsListHover(thisScrollable);
                        edgtfPortfolioScrollFix(thisScrollable);
                        edgtfPortfolioScrollPosition(thisScrollable);
                        $(window).scroll(function(){
                            edgtfPortfolioScrollFix(thisScrollable);
                        });
                        $(window).resize(function(){
                            edgtfPortfolioScrollPosition(thisScrollable);
                        });
                    });
                }
            }

        };
    };

    /*
     **  Smooth scroll functionality for Portfolio List Scrollable
     */
    function edgtfPortfolioScrollableScroll(){

        var metaShowcase = $('.edgtf-ptf-list-showcase-meta-inner');

        if(metaShowcase.length){
            metaShowcase.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }
    }


	function edgtfPortfolioSection(){
		var portfolioSections = $('.edgtf-portfolio-section-holder');

		if (portfolioSections.length){
			portfolioSections.each(function () {
				var thisSection = $(this),
					articles = thisSection.find('.edgtf-section-item'),
					articlesLink = thisSection.find('.edgtf-section-link'),
					articlesImages = thisSection.find('.edgtf-portfolio-section-image-holder .edgtf-image-url-holder-inner');


				articles.eq(0).addClass('hovered');
				articlesImages.eq(0).addClass('hovered');

				//remove first click when on touch devices - go to link on second click
            	if(edgtf.htmlEl.hasClass('touch')){
					articlesLink.eq(0).addClass('active');

					articlesLink.each(function () {
						var link = $(this);

						link.on('click', function(e){
							if (!link.hasClass('active')) {
								e.preventDefault();
								articlesLink.removeClass('active');
								link.addClass('active');
							}

						});
					});
				}

				articles.each(function(e){
					var thisArticle = $(this);

					thisArticle.on('mouseover', function () {

						var imageHolder = articlesImages.eq(e);

						if (!thisArticle.hasClass('hovered')){
							thisArticle.siblings().removeClass('hovered');
							imageHolder.siblings().removeClass('hovered');

							thisArticle.addClass('hovered');
							imageHolder.addClass('hovered');
						}
					});
				});

			});
		}
	}

	/* Portfolio Single Split*/
	var edgtfPortfolioSingleStick = function(){
		var portfolioSplit = $('.edgtf-portfolio-single-holder.edgtf-ps-split-screen-layout');
		var info = $('.edgtf-portfolio-single-holder.edgtf-ps-split-screen-layout .edgtf-ps-info-holder');
		if (info.length && edgtf.htmlEl.hasClass('no-touch')) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = info.outerHeight() + 100, //30 is some default margin
				mediaHolder = $('.edgtf-ps-image').parent(),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.edgtf-page-header'),
				fixedHeader = header.find('.edgtf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				fixedHeaderHeight = (fixedHeader.length) ? fixedHeader.height() : 0,
				infoHolderOffsetAfterScroll = headerHeight;

		}

		var infoWidth = function() {
			if(info.length && edgtf.htmlEl.hasClass('no-touch')){
				info.css('width',info.width());
			}
		};


		var initInfoHolder = function(){
			if(info.length && edgtf.htmlEl.hasClass('no-touch')){
				var stickyActive = header.find('.edgtf-sticky-header');
				if (stickyActive.length){
					if (!stickyActive.hasClass('header-appear')){
						var headerVisible = (headerHeight - edgtf.scroll) > 0 ? true : false;
						if (headerVisible){
							infoHolderOffsetAfterScroll = edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight - 5; // 5 is designer wishes
						}
						else{
							infoHolderOffsetAfterScroll = 24;
						}
					}
					else{
						infoHolderOffsetAfterScroll = edgtfGlobalVars.vars.edgtfStickyHeaderTransparencyHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar;
					}
				}
				else if (fixedHeader.length){
					infoHolderOffsetAfterScroll = edgtfGlobalVars.vars.edgtfAddForAdminBar + fixedHeaderHeight;
				}
				if(info.length && mediaHolderHeight > infoHolderHeight && edgtf.htmlEl.hasClass('no-touch')) {
					info.css('top',infoHolderOffsetAfterScroll+'px');
				}
			}
		};

		var calcInfoHolderPosition = function(){
			if(info.length && edgtf.htmlEl.hasClass('no-touch')){
				infoHolderHeight = info.outerHeight() + 30;
				mediaHolderHeight = mediaHolder.height();

				if(mediaHolderHeight > infoHolderHeight && edgtf.htmlEl.hasClass('no-touch')) {
					if (fixedHeader.length){
						headerHeight = fixedHeaderHeight;
					}
					if(edgtf.scroll >= infoHolderOffset - headerHeight - edgtfGlobalVars.vars.edgtfAddForAdminBar){
						if (info.css('position') !== 'fixed'){
							info.css('position','fixed');
							if (edgtf.scroll > 0) {
								info.addClass('edgtf-animating');
								info.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
									info.removeClass('edgtf-animating');
								});
							}
						}
					} else {
						info.css('position','static');
					}

					if(infoHolderOffset+mediaHolderHeight<=edgtf.scroll+infoHolderHeight + infoHolderOffsetAfterScroll){
						info.stop().css('margin-top',infoHolderOffset + mediaHolderHeight - edgtf.scroll - infoHolderHeight - infoHolderOffsetAfterScroll+'px');
					} else {
						info.css('margin-top','0');
					}
				}
				if (!info.hasClass('edgtf-appeared')){
					info.addClass('edgtf-appeared');
				}
			}
			else if (edgtf.htmlEl.hasClass('touch')){
				if (!info.hasClass('edgtf-appeared')){
					info.addClass('edgtf-appeared');
				}
			}
		};

		return {
			init: function(){
				if (portfolioSplit.length){
					infoWidth();
					calcInfoHolderPosition();
					initInfoHolder();
					$(window).scroll(function(){
						calcInfoHolderPosition();
						initInfoHolder();
					});
					$(window).resize(function(){
						initInfoHolder();
						calcInfoHolderPosition();
					});
				}
			}
		};
	};

    /**
     * Init ptf project animation
     */
    function edgtfPortfolioProjectAnimation(){
        var items = $('.edgtf-portfolio-project-info.edgtf-appear-fx');
        
        if(items.length && !edgtf.htmlEl.hasClass('touch')){
            items.appear(function(){
                $(this).addClass('edgtf-appear');
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';
	
	var team = {};
	edgtf.modules.team = team;
	
	team.edgtfTeamAnimation = edgtfTeamAnimation;
	
	
	team.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfTeamAnimation();
	}
	
	/**
	 * Init team animation
	 */
	function edgtfTeamAnimation(){
		var items = $('.edgtf-show-info-on-appear .edgtf-team');
		
		if(items.length && !edgtf.htmlEl.hasClass('touch')){
			items.appear(function(){
				var item = $(this);

				setTimeout(function(){
					item.addClass('edgtf-appear');
				}, parseInt(item.index() % 2 ? 1 : item.index()) * 240);
			});
		}
	}

})(jQuery);
(function ($) {
    'use strict';

    var testimonialsSlider = {};
    edgtf.modules.testimonialsSlider = testimonialsSlider;


    testimonialsSlider.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).load(edgtfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitTestimonialsSlider();
    }

    /**
     * Init Testimonials Slider Shortcode
     */
    function edgtfInitTestimonialsSlider() {
        var testimonial = $('.edgtf-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                thisTestimonial.waitForImages(function() {
                    thisTestimonial.css('visibility','visible');
                });

                var auto = true;
                var controlNav = true;
                var directionNav = false;
                var animationSpeed = 800;
                var responsive;
                var slidesToShow = 1;

                if(typeof thisTestimonial.data('enable-autoplay') !== 'undefined' && thisTestimonial.data('enable-autoplay') === 'no' ) {
                    auto = false;
                }

                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }
                if(typeof thisTestimonial.data('enable-navigation') !== 'undefined' && thisTestimonial.data('enable-navigation') === 'no') {
                    controlNav = false;
                }


                slidesToShow = 3;

                responsive = [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ];

                thisTestimonial.slick({
                    infinite: true,
                    autoplay: auto,
                    speed: animationSpeed,
                    slidesToShow : slidesToShow,
                    arrows: directionNav,
                    dots: controlNav,
                    easing: 'easeOutQuart',
                    dotsClass: 'edgtf-slick-dots',
                    adaptiveHeight: true,
                    prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
                    customPaging: function(slider, i) {
                        return '<span class="edgtf-slick-dot-inner"></span>';
                    },
                    responsive: responsive
                });

            });

        }
    }
})(jQuery);