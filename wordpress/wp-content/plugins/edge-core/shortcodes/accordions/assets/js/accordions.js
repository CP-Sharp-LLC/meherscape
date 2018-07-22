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