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