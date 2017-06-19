function include(url){document.write('<script type="text/javascript" src="'+url+'"></script>')}

include('js/jquery.cookie.js');
include('js/jquery.easing.1.3.js');
include('js/uScroll.js');
include('js/jquery.mousewheel.min.js');


if(!FJSCore.mobile){
    document.write('<link rel="stylesheet" href="css/non-responsive.css">')

    include('js/TMGPrototype2.js');
    include('js/jquery-ui-1.10.3.custom.min.js');
    include('js/jquery.ui.touch-punch.js');
    include('js/jquery.fullscreen-0.3.5.min.js');

}else{
    //------ photoswipe scripts -------//
    include('js/klass.min.js');
    include('js/code.photoswipe.jquery-3.0.5.js');  


}

var
    pageHeight
,   pageResizeVal  
,   tmpResizeVal  
,   _windows = $(window)
,   _splashState = true  
,   iteration = 9
,   counter = 0
,   semiSwither = 1
,   _hint_interval
;    


$(function(){
    
    if(FJSCore.tablet){
        $('body .fullScreen').css({display:"none"});
    }
    
    if(FJSCore.mobile){
        $('body').css({'min-width':'inherit'});   
        $('body').css({'min-height':'inherit'});   

        $('#mobile-navigation > option').eq(0).remove();
        $('#mobile-navigation > option').eq(0).attr({"value":"folio"})

        //$('#mobile-header h1 a').attr({"href":"folio"})
        tmpVal = $('#mobile-header h1 a').attr("href");
        tmpVal+='folio';
        $('#mobile-header h1 a').attr({"href":tmpVal})

        FJSCore.defState="folio";
    }

    $(FJSCore).on('changeState',function(){
            if(FJSCore.state==""){
                _splashState = true;
                $('.contentCover').stop().delay(300).animate({opacity:0}, 800, "easeOutCubic",
                    function(){
                        $('.contentCover').css({display:"none"});
                    }
                );
                
                $('#controlHolder').css({display:"block"}).fadeTo(300, 1);
            }else{
                _splashState = false;
                $('.contentCover').css({display:"block"}).stop().animate({opacity:1}, 800, "easeOutCubic");
                $('#controlHolder').stop().fadeTo(300, 0, function(){ $(this).css({display:"none"}); });
            } 
    })

    $('#content')
        .on('show','>*',function(e,d){
            $.when(d.elements)
                .then(function(){
                    if(!d.curr.hasClass('_active')){
                        d.curr                      
                            .stop()
                            .css(
                                {
                                    display:'block',
                                    top:-$(window).outerHeight()*2
                                }
                            )
                            .delay(200)
                            .animate(
                                {
                                    top:0
                                },
                                {
                                    duration:0 
                                    ,complete:function(){
                                        d.curr.addClass('_active');
                                        pageComplete();
                                    }
                                    ,step:function(){
                                        
                                    }
                                }
                               
                            )
                    }
                    
                })          
        })
        .on('hide','>*',function(e,d){
            $(this)
                .stop()
                .animate({
                    top: $(window).outerHeight()
                },{
                    duration:600
                    ,complete:function(){
                        $(this).css({top:-$(window).outerHeight(), display:'none'}); 
                        $(this).removeClass('_active');
                    }
                })
        })	

        function pageComplete(){
            $(window).trigger('resize');

            $('.scroll1').uScroll({mousewheel:true, step:100}); 
        }

        ////////////////////////////////////////////////////////////////////////
        $(document)
            .on('show','#mobile-content>*',function(e,d){                   
                $(".folioList > li").click(
                    function(){
                        var instance = $(".photoSwipe1 a", this).photoSwipe()
                        instance.show(0);
                    }
                )
            })              
            .on('hide','#mobile-content>*',function(e,d){})

       // $('#mainNav > ul').find(">li").each(function(){
       //     $("> a", this).append("<div class='_area'></div><div class='_overPlane'></div>"); 
       // })
})
/*---------------------- end ready -------------------------------*/

$(window).load(function(){  
    $("#webSiteLoader").delay(1000).animate({opacity:0}, 600, "easeInCubic", function(){
        $("#webSiteLoader").remove();
    });  

    if(!FJSCore.mobile){
        //----- desktop scripts ------//
        //-------------------- fullscreen ---------------------//
        if(($.browser.msie) && ($.browser.version == 9)){
            $('body .fullScreen').css({display:"none"})
        }
        // open in fullscreen
        $('body .fullScreen .stateFalse').click(function() {
            $('body').fullscreen();
        });
        // exit fullscreen
        $('body .fullScreen .stateTrue').click(function() {
            $.fullscreen.exit();
            return false;
        });
        // document's event
        $(document).bind('fscreenchange', function(e, state, elem) {
            // if we currently in fullscreen mode
            if ($.fullscreen.isFullScreen()) {
                $('.fullScreen .stateFalse').css({display:'none'});
                $('.fullScreen .stateTrue').css({display:'block'});
            } else {
                $('.fullScreen .stateFalse').css({display:'block'});
                $('.fullScreen .stateTrue').css({display:'none'});
            }
        });

        $('#TMGPrototype2').TMGPrototype2({});

        _showtime();
    }else{
         //----- mobile scripts ------//
        $('#mobile-header>*').wrapAll('<div class="container"></div>');
        $('#mobile-footer>*').wrapAll('<div class="container"></div>');

    
    }

    function _showtime(){
        var _delay = 1000; 
        $("header h1").css({top:-200}).stop().delay(_delay).animate({top:0}, 500, "easeOutCubic"); 
        $("header #mainNav").css({top:-400}).stop().delay(_delay+=500).animate({top:0}, 800, "easeOutCubic"); 
        $("footer .copyright").css({bottom:-100}).stop().delay(_delay).animate({bottom:0}, 800, "easeOutCubic"); 
        $("#openSwitherBtn").css({left:-30}).stop().delay(_delay).animate({left:0}, 800, "easeOutCubic"); 
        $("#controlHolder").fadeTo(0, 0, function(){ $(this).delay(_delay).fadeTo(500, 1); });
        $(".fullScreen").css({top:-50}).stop().delay(_delay+=300).animate({top:35}, 800, "easeOutCubic"); 
    }
    

     //-------- added ------------//
    _hint = $('#openSwitherBtn');
    _hint_interval = setInterval(
        function(){
            if(semiSwither==1){
                _hint.addClass('hint_state');
            }else{
                _hint.removeClass('hint_state');
            }
            semiSwither*=-1;

                if(counter<iteration){
                    counter++;
                }else{
                    clearInterval(_hint_interval);
                }
        },
        500
    )


    $(window).resize(
        function(){
            baseResizeFunction();
        }
    ).trigger('resize');

    function baseResizeFunction(){
        pageHeight = $('#content > div._active > ._innerBlock').height();
        pageResizeVal = $(window).height()/2-pageHeight/2;
        if(pageResizeVal < 150){pageResizeVal=150;}
        $('#content > div._active > ._innerBlock').css({"margin-top": pageResizeVal});

        tmpResizeVal = $('body').height()/2 - $('#TMGPrototype2').height()/2;
        $('#TMGPrototype2').css({top:tmpResizeVal+30});

        $('#controlHolder').css({top:($('body').height()/2)+30});

        if($(window).height()<800){
            $('header h1').css({height: 80});
            $('header h1 a').css({margin: '16px 0 0 0'});
            $('header #mainNav').css({margin: '15px 0 0 0'});
            $('footer .copyright').css({'margin-bottom': '5px'});
        }else{
            $('header h1').css({height: 160});
            $('header h1 a').css({margin: '56px 0 0 0'});
            $('header #mainNav').css({margin: '56px 0 0 0'});
            $('footer .copyright').css({'margin-bottom': '30px'});
        }
    }

    $(window).trigger('afterload');
});

