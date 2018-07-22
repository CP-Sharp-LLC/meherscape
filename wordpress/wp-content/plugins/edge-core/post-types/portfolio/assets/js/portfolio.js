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