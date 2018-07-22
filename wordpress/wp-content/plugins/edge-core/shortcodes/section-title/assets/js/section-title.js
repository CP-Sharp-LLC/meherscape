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