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
