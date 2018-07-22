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