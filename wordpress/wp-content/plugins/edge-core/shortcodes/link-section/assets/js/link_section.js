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