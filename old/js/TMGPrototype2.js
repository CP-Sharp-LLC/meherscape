(function($){
 $.fn.TMGPrototype2=function(o){ 
        
    var getObject = {
        destination: $('body')
    ,   controls: true
    ,   thumbListcontrols: true
    ,   scrollStep: 100
    ,   autoPlay: false
    }
    $.extend(getObject, o); 
    
	var 
        _this = $(this)
    ,   _window = $(window)
    ,   setsList = $('.sets', this)
    ,   thumbnailSrcArray = []
    ,   previewSrcArray = []
    ,   setNamesArray = []
    ,   currSet = 0
    ,   currImg = 0
    ,   urlThumb
    ,   urlPreview
    ,   isPreviewLoading = false
    ,   isPreviewAnimate = false
    ,   isListDrag = false
    ,   tmpValue
    ,   tmpResizeVal
    ,   leftWW
    ,   _thumbListWidth = 0
    ,   autoSwitchObj
    ,   hintHiden = false
    ,   mainHidden = false
    ,   thumbsOffset = 0
    ;

    var 
        _previewHolder
    ,   _previewSpinner
    ,   _topImg
    ,   _bottomImg
    ,   _categoryList
    ,   _thumbnailHolder
    ,   _thumbnailControls
    ,   _thumbnailList
    ,   _controlsHolder
    ,   _hintObject
    ,   _openSwitherBtn
    ;
       
///////////////////////////// INIT /////////////////////////////////////////////////////////
	init();
	function init(){
        var
            setName 
        ;

        //  data parser
        $('>li', setsList).each(
            function(indI){
                setNamesArray.push($(this).attr("data-setName"));
                thumbnailSrcArray.push([]);
                previewSrcArray.push([]);
                $('>ul >li', this).each(
                    function(indJ){
                        urlThumb = $(this).attr("data-srcThumbnail");
                        thumbnailSrcArray[indI].push(urlThumb)
                        urlPreview = $(this).attr("data-srcPreview");
                        previewSrcArray[indI].push(urlPreview)
                    }
                )
            }
        )

        console.log(previewSrcArray);

        //  preview build
        getObject.destination.append("<div id='previewHolder'><img id='topImg' src='' alt=''><img id='bottomImg' src='' alt=''></div>");
        _previewHolder = $('#previewHolder');
        getObject.destination.append("<div id='previewSpiner'><span></span></div>");
        _previewSpinner = $('#previewSpiner');
        _previewHolder.css({position:'fixed', width:'100%', height:'100%', 'z-index':-1});
        _topImg = $('#previewHolder #topImg');
        _bottomImg = $('#previewHolder #bottomImg');
        _topImg.css({position:'absolute', 'z-index':2});
        _bottomImg.css({position:'absolute', 'z-index':1});

        //  control build
        getObject.destination.append("<div id='controlHolder'><div class='_prevButton'></div><div class='_nextButton'></div></div>");
        _controlsHolder = $('#controlHolder');

        if(getObject.controls){
            _controlsHolder.css({display:'block'});
        }else{
            _controlsHolder.css({display:'none'});
        }

        //  categoryList build
        _this.append("<ul id='categoryList'></ul>");
        _categoryList = $('#categoryList');
        _categoryList.css({'list-style':'none', margin:0});

        $(">li", setsList).each(function(index){
            urlThumb = thumbnailSrcArray[index][0];
            setName = setNamesArray[index];
            _categoryList.append('<li><img src='+urlThumb+' alt=""><div class="setName"><span>'+setName+'</span></div></li>'); 
        })
        
        //  currThumbList build
        _this.append("<div id='ThumbnailHolder'></div>");
        _thumbnailHolder = $('#ThumbnailHolder');
        _thumbnailHolder.append("<ul class='ThumbnailList'></ul>");
        _thumbnailList = $('#ThumbnailHolder > .ThumbnailList');
        _thumbnailList.css({'list-style':'none', margin:0});

        //  ThumbList controls
        if(getObject.thumbListcontrols){
            _this.append("<div id='thumbListcontrols'><div class='leftButton'></div><div class='rightButton'></div><div>");

            _thumbnailControls = $('#thumbListcontrols');
        }

        //  ThumbList controls
        _this.append("<div id='openSwitherBtn'><span></span></div>");
        _openSwitherBtn = $('#openSwitherBtn');

        // hint build
        _thumbnailHolder.append("<div class='userHint'></div>");
        _hintObject = $('.userHint', _thumbnailHolder);

        setSwitcher(0);

        
        _thumbnailHolder.delay(500).slideUp(0);
        _thumbnailControls.slideUp(0);
        _categoryList.css({left:-246});
        
        

        setsList.remove();
        addEventsFunction();

        if(getObject.autoPlay){
            autoSwitch(5000);
        }      
	}//end init  

    //////////////////////////    addEvents    /////////////////////////////////////////////
    function addEventsFunction(){
        $(window).resize(
            function(){
                mainResizeFunction();
            }
        ).trigger('resize');

        $('>li', _categoryList).click(
            function(){
                if($(this).index() !== currSet){
                    setSwitcher($(this).index());
                }   
            }
        )

        $('._prevButton', _controlsHolder).click(
            function(){
                if(!isPreviewLoading && !isPreviewAnimate){
                    $('>li', _thumbnailList).eq(currImg).removeClass('active');

                    if(currImg > 0){
                        currImg--;
                    }else{
                        currImg = $('>li', _thumbnailList).length-1;
                    }
    
                    $('>li', _thumbnailList).eq(currImg).addClass('active');
                    urlPreview = previewSrcArray[currSet][currImg+1];
                    _changePreview(urlPreview, 500);
                }
            }
        )
        $('._nextButton', _controlsHolder).click(
            function(){
                if(!isPreviewLoading && !isPreviewAnimate){
                    $('>li', _thumbnailList).eq(currImg).removeClass('active');

                    if(currImg < $('>li', _thumbnailList).length-1){
                        currImg++;
                    }else{
                        currImg = 0;
                    }
    
                    $('>li', _thumbnailList).eq(currImg).addClass('active');
                    urlPreview = previewSrcArray[currSet][currImg+1];
                    _changePreview(urlPreview, 500);
                }
            }
        )

        if(getObject.thumbListcontrols){
            $('.leftButton', _thumbnailControls).click(
                function(){
                    thumbsOffset += getObject.scrollStep;

                    if(thumbsOffset>0){
                        thumbsOffset = 0;
                    }

                    _thumbnailList.stop().animate({left:thumbsOffset},{duration:300});
                }
            )

            $('.rightButton', _thumbnailControls).click(
                function(){
                    thumbsOffset -= getObject.scrollStep;

                    leftWW = Math.abs(thumbsOffset) + _thumbnailHolder.width(); 
                    if(leftWW > _thumbListWidth){
                       thumbsOffset = -1*(_thumbListWidth - _thumbnailHolder.width());
                    }

                    _thumbnailList.stop().animate({left:thumbsOffset},{duration:300});
                }
            )
        }

        _openSwitherBtn.click(
            function(){
                if(!mainHidden){
                    mainHidden = true;
                    $(this).addClass('show_state');

                    visibleState();
                }else{
                    mainHidden = false;
                    $(this).removeClass('show_state');

                    hiddenState();
                }
            }
        )

    }
    //---------------------- open ---------------------------//
    function visibleState(){
        _categoryList.stop().animate({left:60}, 500, 'easeOutCubic', function(){
            _thumbnailHolder.stop().slideDown(300);
            _thumbnailControls.stop().slideDown(300);
        });

        $('._nextButton', _controlsHolder).stop().fadeTo(300, 0, function(){ $(this).css({display:'none'}); });
        $('._prevButton', _controlsHolder).stop().fadeTo(300, 0, function(){ $(this).css({display:'none'}); });
    }
    //---------------------- close --------------------------//
    function hiddenState(){
        _thumbnailControls.stop().slideUp(300);
        _thumbnailHolder.stop().slideUp(300, function(){
            _categoryList.stop().animate({left:-246}, 500, 'easeInCubic');
        })
        $('._nextButton', _controlsHolder).css({display:'block'}).stop().fadeTo(300, 1);
        $('._prevButton', _controlsHolder).css({display:'block'}).stop().fadeTo(300, 1);
    }
    //-------------------- auto switch ----------------------//
    function autoSwitch(_duration){
        autoSwitchObj = setInterval(
            function(){
                $('>li', _thumbnailList).eq(currImg).removeClass('active');
                if(currImg < $('>li', _thumbnailList).length-1){
                    currImg++;
                }else{
                    currImg = 0;
                }
                $('>li', _thumbnailList).eq(currImg).addClass('active');
                urlPreview = previewSrcArray[currSet][currImg+1];
                _changePreview(urlPreview, 500);
            }
            , _duration
        )
    }
    //------------------- thumb list drag -------------------//
    thumbDragEvent(_thumbnailList);

    function thumbDragEvent(dragList){
        dragList.draggable({
            axis: "x"
            ,drag: function( event, ui ) {
                hintListener();

                if(dragList.width() < _thumbnailHolder.width()){
                    dragList.stop().animate(
                            {left:0},{
                                duration:300
                            });
                   return false;
                }        
                
                if(dragList.position().left>0){
                    dragList.stop().animate(
                        {left:0},{
                            duration:300
                        });
                    return false;
                }

                leftWW = Math.abs(dragList.position().left) + _thumbnailHolder.width(); 
                if(leftWW > _thumbListWidth){
                    $(this).stop().animate(
                        {left:-1*(_thumbListWidth - _thumbnailHolder.width())},{
                            duration:300
                        }
                    );
                    return false;
                }    
            }
            ,start: function( event, ui ) {
                isListDrag = true;
                dragList.addClass("grabbing");   
            }
            ,stop: function( event, ui ) {
                dragList.removeClass("grabbing");
                setTimeout(function(){isListDrag = false;},10);

                thumbsOffset = dragList.position().left;



            }
        })//end drag
    }
    
    //-------------------------------------------------------//
    function thumbClickEvent(currThumb){
        if(!isListDrag){
            //if(!isPreviewLoading && !isPreviewAnimate){
            if(!isPreviewLoading){
                if(currThumb.index()!==currImg){
                    $('>li', _thumbnailList).eq(currImg).removeClass('active');
                    currImg = currThumb.index();
                    $('>li', _thumbnailList).eq(currImg).addClass('active');

                    urlPreview = previewSrcArray[currSet][currImg+1];
                    _changePreview(urlPreview, 500);
                }
            }
        }
        //isListDrag = false;
    }
    //------------------- setSwitcher -------------------//
    function setSwitcher(currIndex){
        
        $('>li', _categoryList).eq(currSet).removeClass('currSet');
        currSet = currIndex;
        $('>li', _categoryList).eq(currSet).addClass('currSet');
        
        tmpValue = $(">li", _categoryList).eq(currIndex).position().top;
        _thumbnailHolder.stop().animate({top:tmpValue}, 400, 'easeOutCubic');
        _thumbnailControls.stop().animate({top:tmpValue}, 400, 'easeOutCubic');

        urlPreview = previewSrcArray[currSet][0];
        _changePreview(urlPreview, 500);
        thumbnailListBuilder(currSet);

        //_window.trigger('resize');

    }// end setSwitcher

    function thumbnailListBuilder(currIndex){
        _thumbnailList.empty();
        _thumbListWidth = 0;
        for(var i=1; i<thumbnailSrcArray[currIndex].length; i++){
            _thumbnailList.append('<li><span class="_overItem"></span><img src='+thumbnailSrcArray[currIndex][i]+' alt=""></li>')
            tmpValue = $('> li:last',_thumbnailList).find('img');
            tmpValue.fadeTo(0, 0);
            tmpValue.bind('load', function(){
                $(this).unbind('load');
                $(this).fadeTo(500, 1);
                _thumbListWidth += $(this).width();
                
                $(_thumbnailList).css({width:_thumbListWidth});

                hintListener();

                if(getObject.thumbListcontrols){
                    thumbListControlsListener();
                }
            });

            $('> li:last',_thumbnailList).click(
                function(){
                    thumbClickEvent($(this));      
                }
            )
        }

        
        
        currImg = -1;
        $(_thumbnailList).css({left:0});
    }
    //------------------- change preview img-------------------//
    function _changePreview(_currURL, fadeDuration){
        _previewSpinner.css({display:'block'}).stop().fadeTo(300, 1);
        _topImg.fadeTo(0, 0,
            function(){
                _topImg.attr('src', "").attr('src', _currURL);
                isPreviewLoading = true;
                isPreviewAnimate = true;
                _topImg.bind('load', function(){
                    _previewSpinner.stop().fadeTo(300, 0, function(){
                        $(this).css({display:'none'});
                    });

                    $(this).unbind('load');
                    $(this).fadeTo(fadeDuration, 1, function(){
                       _bottomImg.attr('src', "").attr('src', _currURL); 
                       isPreviewAnimate = false;
                    });

                    isPreviewLoading = false;
                    previewResize();
                });
            }
        )
    }//end change preview img
    //------------------- zoom animate -------------------//
    
    //----------------------------------------------------//
    function previewResize(){
            var 
                prevImgWidth
            ,   prevImgHeight
            ,   prevImgLeft
            ,   prevImgTop
            ,   imageRatio
            ,   windowRatio
            ,   newImgWidth
            ,   newImgHeight
            ;

            if(!isPreviewLoading){
                prevImgWidth = $('>img', _previewHolder).width();
                prevImgHeight = $('>img', _previewHolder).height();

                imageRatio = prevImgHeight/prevImgWidth;
                windowRatio = $(window).height()/$(window).width();

                if(windowRatio > imageRatio){
                    newImgWidth = "auto";
                    newImgHeight = $(window).height();
                }else{
                    newImgWidth = $(window).width();
                    newImgHeight = "auto";
                }

                $('>img', _previewHolder).css({width:newImgWidth, height:newImgHeight}) 
                prevImgLeft = Math.round(($(window).width() - $('>img', _previewHolder).width())/2);
                prevImgTop = Math.round(($(window).height() - $('>img', _previewHolder).height())/2);
                $('>img', _previewHolder).css({left:prevImgLeft, top:prevImgTop})   
            }
        }

        //------------------- window resize function -------------------//
        function mainResizeFunction(){
            previewResize();

                /*thumblist resize*/
                if(_thumbListWidth > _thumbnailHolder.width()){
                    leftWW = Math.abs(_thumbnailList.position().left) + _thumbnailHolder.width();
                    if(leftWW >= _thumbListWidth){
                        transDelta = _thumbListWidth - _thumbnailHolder.width();
                        _thumbnailList.css({left:-transDelta});
                    }

                }else{ 
                    _thumbnailList.css({left:0});
                }

                /*controlsHolder reposition*/
                //if(getObject.controls){
                //    _controlsHolder.css({top:(_window.height()/2)-(_controlsHolder.height()/2)+70}); 
                //}

                hintListener();
                if(getObject.thumbListcontrols){
                    thumbListControlsListener();
                }

                tmpResizeVal = $(window).width() - _thumbnailHolder.offset().left - 22;
                _thumbnailHolder.width(tmpResizeVal);
        }
        //end window resizefunction

        function thumbListControlsListener(){
            if(_thumbListWidth > _thumbnailHolder.width()){
                $('.leftButton', _thumbnailControls).css({display:"block"});
                $('.rightButton', _thumbnailControls).css({display:"block"});
            }else{
                $('.leftButton', _thumbnailControls).css({display:"none"});
                $('.rightButton', _thumbnailControls).css({display:"none"});
            }
        }

        function hintListener(){
            if(Math.abs(_thumbnailList.position().left)>40){
                hintHiden = true;
                _hintObject.slideUp();
            }
            if(!hintHiden){
                if(_thumbListWidth > _thumbnailHolder.width()){
                    _hintObject.slideDown();
                }else{
                    _hintObject.slideUp();
                } 
            }
            
        }
////////////////////////////////////////////////////////////////////////////////////////////              
	}
})(jQuery)