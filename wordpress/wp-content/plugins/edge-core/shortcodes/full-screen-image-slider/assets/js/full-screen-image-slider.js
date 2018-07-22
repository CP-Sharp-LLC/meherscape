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