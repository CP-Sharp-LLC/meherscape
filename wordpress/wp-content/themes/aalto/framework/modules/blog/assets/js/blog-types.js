(function($) {
    "use strict";

    var blogChequered = {};
    edgtf.modules.blogChequered = blogChequered;

    blogChequered.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).load(edgtfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogChequered();
        edgtfInitBlogChequeredLoadMore();
    }

    /**
     *  Init Blog Chequered
     */
    function edgtfInitBlogChequered(){
        var container = $('.edgtf-blog-holder.edgtf-blog-chequered');
        var masonry = container.children('.edgtf-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.edgtf-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }

    function edgtfInitBlogChequeredLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogChequered();
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var blogMasonryGallery = {};
    edgtf.modules.blogMasonryGallery = blogMasonryGallery;

    blogMasonryGallery.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blogMasonryGallery.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blogMasonryGallery.edgtfOnWindowResize = edgtfOnWindowResize;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitBlogMasonryGallery();
        edgtfInitBlogMasonryGalleryAppearLoadMore();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogMasonryGalleryAppear();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtfOnWindowResize() {
        edgtfInitBlogMasonryGallery();
    }

    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function edgtfInitBlogMasonryGallery() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.edgtf-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.edgtf-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                edgtfInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function edgtfInitBlogMasonryGalleryAppear() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgtf-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('edgtf-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

            });
        }
    }

    function edgtfInitBlogMasonryGalleryAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogMasonryGalleryAppear();
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var blogNarrow = {};
    edgtf.modules.blogNarrow = blogNarrow;

    blogNarrow.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).load(edgtfOnWindowLoad);


    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogNarrowAppear();
        edgtfInitBlogNarrowAppearLoadMore();
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function edgtfInitBlogNarrowAppear() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgtf-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('edgtf-appeared');
                    },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

            });
        }
    }

    function edgtfInitBlogNarrowAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogNarrowAppear();
        });
    }

})(jQuery);