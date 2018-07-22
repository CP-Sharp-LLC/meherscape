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