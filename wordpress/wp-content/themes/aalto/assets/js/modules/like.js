(function($) {
    'use strict';

    var like = {};
    
    like.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function edgtfOnDocumentReady() {
        edgtfLikes();
    }

    function edgtfLikes() {
        $(document).on('click','.edgtf-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'aalto_edge_like',
                likes_id: id,
                type: type
            };

            var like = $.post(edgtfGlobalVars.vars.edgtfAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);