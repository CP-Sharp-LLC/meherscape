(function($) {
    "use strict";

    var sidearea = {};
    edgtf.modules.sidearea = sidearea;

    sidearea.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSideArea();
	    edgtfSideAreaScroll();
    }
	
	/**
	 * Show/hide side area
	 */
	function edgtfSideArea() {
		var wrapper = $('.edgtf-wrapper'),
			sideMenuButtonOpen = $('a.edgtf-side-menu-button-opener'),
			cssClass = 'edgtf-right-side-menu-opened';
		
		wrapper.prepend('<div class="edgtf-cover"/>');
		
		$('a.edgtf-side-menu-button-opener, a.edgtf-close-side-menu').click( function(e) {
			e.preventDefault();
			
			if(!sideMenuButtonOpen.hasClass('opened')) {
				sideMenuButtonOpen.addClass('opened');
				edgtf.body.addClass(cssClass);
				
				$('.edgtf-wrapper .edgtf-cover').click(function() {
					edgtf.body.removeClass('edgtf-right-side-menu-opened');
					sideMenuButtonOpen.removeClass('opened');
				});
				
				var currentScroll = $(window).scrollTop();
				$(window).scroll(function() {
					if(Math.abs(edgtf.scroll - currentScroll) > 400){
						edgtf.body.removeClass(cssClass);
						sideMenuButtonOpen.removeClass('opened');
					}
				});
			} else {
				sideMenuButtonOpen.removeClass('opened');
				edgtf.body.removeClass(cssClass);
			}
		});
	}
	
	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function edgtfSideAreaScroll(){
		var sideMenu = $('.edgtf-side-menu');
		
		if(sideMenu.length){
			sideMenu.niceScroll({
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

})(jQuery);
