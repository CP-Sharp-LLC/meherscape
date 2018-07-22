(function($) {
    'use strict';

    var infoBox = {};
    edgtf.modules.infoBox = infoBox;

    infoBox.edgtfInfoBoxAnimation = edgtfInfoBoxAnimation;
    infoBox.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInfoBoxAnimation();
    }

    /**
     * Init info box animation
     */
    function edgtfInfoBoxAnimation(){
        var items = $('.edgtf-info-boxes-holder');

        if(items.length && edgtf.htmlEl.hasClass('touch')){
            items.on('click', function(){
                $(this).toggleClass('edgtf-ib-touch-anim');
            });
        }
    }

})(jQuery);