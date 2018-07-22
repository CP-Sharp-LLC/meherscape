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