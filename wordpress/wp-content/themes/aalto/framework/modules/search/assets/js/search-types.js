(function($) {
    "use strict";

    var searchCoversHeader = {};
    edgtf.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchCoversHeader();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchCoversHeader() {
        if ( edgtf.body.hasClass( 'edgtf-search-covers-header' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.click(function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchFormHeight,
                        searchFormHeaderHolder = $('.edgtf-page-header'),
                        searchFormTopHeaderHolder = $('.edgtf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.edgtf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.edgtf-mobile-header'),
                        searchForm = $('.edgtf-search-cover'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.edgtf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.edgtf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.edgtf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.edgtf-mobile-header').length;

                    searchForm.removeClass('edgtf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormHeight = edgtfGlobalVars.vars.edgtfTopBarHeight;
                        searchFormTopHeaderHolder.find('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                        searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormHeight = edgtfGlobalVars.vars.edgtfStickyHeaderHeight;
                        searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormHeight = searchFormMobileHeaderHolder.children('.edgtf-mobile-header-inner').outerHeight();
                        } else {
                            searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                        }

                        searchFormMobileHeaderHolder.find('.edgtf-search-cover').addClass('edgtf-is-active');

                    } else {
                        searchFormHeight = searchFormHeaderHolder.outerHeight();
                        searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');
                    }

                    if (searchForm.hasClass('edgtf-is-active')) {
                        searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                    }

                    searchForm.find('.edgtf-search-close').click(function (e) {
                        e.preventDefault();
                        searchForm.stop(true).fadeOut(450);
                    });

                    searchForm.blur(function () {
                        searchForm.stop(true).fadeOut(450);
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(450);
                    });
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchFullscreen = {};
    edgtf.modules.searchFullscreen = searchFullscreen;

    searchFullscreen.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchFullscreen();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchFullscreen() {
        if ( edgtf.body.hasClass( 'edgtf-fullscreen-search' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {

                var searchHolder = $('.edgtf-fullscreen-search-holder'),
                    searchClose = $('.edgtf-fullscreen-search-close'),
                    searchOpenerPosition = searchOpener.offset();

                //place close icon on opener icon's place if necessary
                // searchClose.css('top',searchOpenerPosition.top);
                // searchClose.css('right', edgtf.windowWidth - searchOpenerPosition.left - searchOpener.width());

                searchOpener.click(function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('edgtf-animate')) {
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-out');
                        edgtf.body.removeClass('edgtf-search-fade-in');
                        searchHolder.removeClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        }, 300);

                        edgtf.modules.common.edgtfEnableScroll();
                    } else {
                        edgtf.body.addClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                        edgtf.body.removeClass('edgtf-search-fade-out');
                        searchHolder.addClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').focus();
                        }, 900);

                        edgtf.modules.common.edgtfDisableScroll();
                    }

                    searchClose.click(function (e) {
                        e.preventDefault();
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                        edgtf.body.addClass('edgtf-search-fade-out');
                        searchHolder.removeClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        }, 300);

                        edgtf.modules.common.edgtfEnableScroll();
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".edgtf-form-holder-inner");

                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                            e.preventDefault();
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            searchHolder.removeClass('edgtf-animate');

                            setTimeout(function () {
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            }, 300);

                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) { //KeyCode for ESC button is 27
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            searchHolder.removeClass('edgtf-animate');

                            setTimeout(function () {
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            }, 300);

                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });
                });

                //Text input focus change
                var inputSearchField = $('.edgtf-fullscreen-search-holder .edgtf-search-field'),
                    inputSearchLine = $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line');

                inputSearchField.focus(function () {
                    inputSearchLine.css('width', '100%');
                });

                inputSearchField.blur(function () {
                    inputSearchLine.css('width', '0');
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchSlideFromHB = {};
    edgtf.modules.searchSlideFromHB = searchSlideFromHB;

    searchSlideFromHB.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchSlideFromHB();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchSlideFromHB() {
        if ( edgtf.body.hasClass( 'edgtf-slide-from-header-bottom' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {
                //Check for type of search
                searchOpener.click(function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchIconPosition = parseInt(edgtf.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

                    if (edgtf.body.hasClass('edgtf-boxed') && edgtf.windowWidth > 1024) {
                        searchIconPosition -= parseInt((edgtf.windowWidth - $('.edgtf-boxed .edgtf-wrapper .edgtf-wrapper-inner').outerWidth()) / 2);
                    }

                    var searchFormHeaderHolder = $('.edgtf-page-header'),
                        searchFormTopOffset = '100%',
                        searchFormTopHeaderHolder = $('.edgtf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.edgtf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.edgtf-mobile-header'),
                        searchForm = $('.edgtf-slide-from-header-bottom-holder'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.edgtf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.edgtf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.edgtf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.edgtf-mobile-header').length;

                    searchForm.removeClass('edgtf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormTopHeaderHolder.find('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + edgtfGlobalVars.vars.edgtfAddForAdminBar;
                        searchFormHeaderHolder.children('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormTopOffset = edgtfGlobalVars.vars.edgtfStickyHeaderHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar;
                        searchFormHeaderHolder.children('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormTopOffset = searchFormMobileHeaderHolder.children('.edgtf-mobile-header-inner').outerHeight() + edgtfGlobalVars.vars.edgtfAddForAdminBar;
                        }
                        searchFormMobileHeaderHolder.find('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');

                    } else {
                        searchFormHeaderHolder.children('.edgtf-slide-from-header-bottom-holder').addClass('edgtf-is-active');
                    }

                    if (searchForm.hasClass('edgtf-is-active')) {
                        searchForm.css({
                            'right': searchIconPosition,
                            'top': searchFormTopOffset
                        }).stop(true).slideToggle(300, 'easeOutBack');
                    }

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) { //KeyCode for ESC button is 27
                            searchForm.stop(true).fadeOut(0);
                        }
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(0);
                    });
                });
            }
        }
	}

})(jQuery);
