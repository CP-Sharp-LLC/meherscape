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