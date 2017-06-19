/*
core

*/

;(function($){
	window.FJSCore={
		local:location.protocol=="file:"	
		,basepath:location.pathname.slice(0,location.pathname.lastIndexOf('/')+1)	
		,defState:''
		,defStateMobileText:'/'
		,ajaxFolder:"/ajax/"
		,modules:{}
	}
	
	include('js/history.js?redirect=true&basepath='+FJSCore.basepath)

	if(FJSCore.mobile=device.mobile())
		document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0"/>')
		
	if(FJSCore.tablet=device.tablet())
		document.write('<meta name="viewport" content="width=device-width"/>')

})(jQuery);

!function($){
	var win=$(window)
		,doc=$(document)
		,Core=window.FJSCore
		,$Core=$(Core)
		
	doc
		.on('changeLocation',function(e,d){
			if(d===Core.state)
				return false			
			if(!Core.local)
				history.pushState(d,d,Core.basepath+d)
			if((''+d).indexOf('#')===-1)
				Core.state=d
				,Core.hash=''
			else
				Core.state=d.slice(0,d.indexOf('#'))
				,Core.hash=location.hash.slice(1)
			
			$Core.trigger('changeState',Core.state)
		})
		.on('click','a[href^="/"],a[href^="./"]',function(e){			
			var href=$(this).attr('href').replace(Core.basepath,'').replace(/^\.\//,'')
			doc.trigger('changeLocation',href)
			e.preventDefault()
			return false
		})
		
	win		
		.on('popstate afterload',function(){
			popstate()
		})
		
	function popstate(){		
		var search=location.search.slice(1)
			,state=(!FJSCore.local?location.pathname.slice(location.pathname.lastIndexOf('/')+1):FJSCore.defState)||FJSCore.defState
			,hash=location.hash.slice(1)
		
		state=search?state+'?'+search:state
		
		if(Core.state!==state){
			Core.state=state
			Core.hash=hash			
			$Core.trigger('changeState',Core.state)
		}
	}
		
	// $Core.on('changeState',function(e,d){
		// console.log(d)
	// })

	
	$(function(){
		Core.ajaxOverlay=$('<div id="ajax-overlay"><div/></div>').hide()
		Core.globOverlay=$('#glob-overlay')
		Core.ajaxOverlay
			.appendTo('#glob-wrap')
			
		Core.globOverlay.add(Core.ajaxOverlay)			
			.on('show',function(){
				$(this).fadeIn()
			})
			.on('hide',function(){
				$(this).fadeOut()
			})
			
		win.on('afterload',function(){
			$.when(Core.globOverlay.trigger('hide'))
				.then(function(){
					$('body').removeClass('overlaid')
				})
		})
	})
	
	FJSCore.prepareLoaded=function(root){
		$('a[href^="/"]',root).each(function(){
			var $this=$(this)
			$this.attr({href:FJSCore.basepath+$this.attr('href').slice(1)})
		})
		
		FJSCore.modules.search&&FJSCore.modules.search()		
	}
	
	$(function(){
		FJSCore.prepareLoaded()
		$('.mobile-only').remove()
	})
		
	$('html').addClass(FJSCore.mobile?'mobile':FJSCore.tablet?'tablet desktop':'desktop')
	
}(window.jQuery);

!function($){
	$(function follows(){
		FJSCore.modules.follows=follows
		$('[data-follow]').not('[data-follow="location"],[data-follow="hash"]')
			.each(function(){
				var $this=$(this)
					,follow=$this.data('follow')
				$(follow).on('changeState',function(e,d){
					$this.trigger('changeState',d)
				})
			})
		$('[data-follow="location"]')
			.each(function(){
				var $this=$(this)
				$(window.FJSCore)
					.on('changeState',function(e,d){
						$this.trigger('changeState',d)						
					})
			})
		$('[data-follow="hash"]')
			.each(function(){
				var $this=$(this)
				$(window.FJSCore)
					.on('changeState',function(e,d){
						if(window.FJSCore.hash)
							$this.trigger('changeHashState',window.FJSCore.hash)
					})
			})
	})
}(window.jQuery);

!function($){
	$(function(){
		var opt={
			elementsPath:'>ul>li'
			,activeClass:'active'
		}
		$('[data-type="navigation"]').each(function(){
			var th=$(this)
				,data=$.extend({},opt,th.data('options'))
			
			data.elements=$(data.elementsPath,th)
				
			th
				.data({navigation:data})
				.on('changeState',function(e,d){					
					data.elements.each(function(){
						var th=$(this)
							,a=$('a',th)						
						if(a.attr('href').replace(FJSCore.basepath,'')===d)
							th.addClass(data.activeClass)
						else
							th.removeClass(data.activeClass)
					})			
				})
			
		})
	})
}(window.jQuery);

!function($){
	$(function switcher(){
		var opt={
			elementsPath:'>div'			
		}
		,xhr
		
		FJSCore.modules.switcher=switcher
		
		$.ajaxSetup({
			type: "get",
			cache:false,
			async:true,
			accepts: "html",
			dataType: "html",
			isLocal:true,
			crossDomain:false
		})
		
		$('[data-type="switcher"]').each(function(){
			var $this=$(this)
				,flags=$this.data('flags')||''
				,data=$.extend({},opt,$this.data('options'))
				,show,hide
			
			data.elements=$(data.elementsPath,$this)
									
			$this
				.data({switcher:data})
				.on('changeState',function(e,d){
					show=$()
					hide=$()
					
					if(isExternal(d)&&~flags.indexOf('ajax')){
						var url=FJSCore.basepath+FJSCore.ajaxFolder.slice(1)+d						
						
						if(xhr)xhr.abort()
						
						FJSCore.ajaxOverlay.trigger('show')
						
						try{
							xhr=$.get(url,function(html){
								var ajaxPage=$('<div class="ajax-page"/>').attr({'data-url':FJSCore.state})
								show=show.add(ajaxPage)
								hide=hide.add($(data.elementsPath,$this))
								ajaxPage
									.html(html)
									.hide()
									.appendTo($this)
								
								data.elements=data.elements.add(ajaxPage)
								FJSCore.prepareLoaded(ajaxPage)
								
								show_hide_actions()							
							})
							xhr.error(function(e){								
								$(document).trigger('changeLocation','404.html')
							})
							$.when(xhr)
								.then(function(){
									FJSCore.ajaxOverlay.trigger('hide')
								})
						}catch(e){console.log(e)}
					}else{
						data.elements.each(function(){
							var $this=$(this)
							if($this.data('id')===d)
								show=show.add($this)
							else
								hide=hide.add($this)
						})
						show_hide_actions()
					}
					
					function show_hide_actions(){						
						hide=hide.not(':hidden')
						data.prev=data.curr
						data.curr=show
						
						hide.trigger('hide',data)
						
						if(show.length!==0)
							show.trigger('show',data)
						
						$.when(data.elements)
							.then(function(){
								data.elements.filter('.ajax-page:hidden').remove()
							})						
					}				
				})
			
			
		})
		
		$('[data-source]')
			.each(function(){
				var $this=$(this)
					,url=location.href.slice(0,location.href.lastIndexOf('/'))+'/ajax/'+$this.data('source')
				
				$this
					.on('show',function(e,d){						
						if(!$this.data('loaded')){
							if(xhr)xhr.abort()
							e.stopPropagation()							
							FJSCore.ajaxOverlay.trigger('show')							
							xhr=$.get(url,function(data){
								$this
									.html(data)
									.data('loaded',true)
									.trigger('show',d)
								FJSCore.prepareLoaded($this)								
							})
							$.when(xhr)
								.then(function(){									
									FJSCore.ajaxOverlay.trigger('hide')
								})
						}									
					})
			})
		
		$('[data-type="switcher"][data-follow="location"]').each(function(){
			var $this=$(this)
			FJSCore.internalIds=(FJSCore.internalIds||$()).add($this.data('switcher').elements)
		})
		
		FJSCore.internalIds=FJSCore.internalIds.map(function(){return $(this).data('id')})
		
		function isExternal(url){
			var external=true,i=0,l=FJSCore.internalIds.length
			for(i=0;i<l;i++)				
				if(FJSCore.internalIds[i]===url)
					external=false
			if(external&&url==='')
				external=false
			return external
		}
		
	})
}(window.jQuery);


!function($){
	if(FJSCore.mobile)
		$(function(){
			var desktop_wrap=$('#glob-wrap')
				,mobile_wrap=$('<div id="mobile-wrap"/>')
				,header=$('<div id="mobile-header"/>')
				,content=$('<div id="mobile-content" data-type="switcher" data-follow="location" data-flags="ajax"/>')
				,footer=$('<div id="mobile-footer"/>')
				,select_menu=$('<select id="mobile-navigation"/>')
				,navigation_holder=$('[data-type="navigation"][data-follow="location"]').eq(0)
				,content_holders=$('[data-type="switcher"][data-follow="location"]')
				,pages_collection=$()
				,notForMobileClass=".desktop-only"
				
			
			$('h1').eq(0)
				.appendTo(header)
				
			select_menu.append('<option value="'+FJSCore.defState.slice(1)+'">'+FJSCore.defStateMobileText+'</option>')
			
			navigation_holder.data('navigation').elements.each(function(){
				var a=$('a',this)
				select_menu.append('<option value='+a.attr('href').replace(FJSCore.basepath,'')+'>'+a.html()+'</option>')				
			})
			
			select_menu
				.appendTo(header)
				
			content_holders
				.each(function(){
					var $this=$(this)					
					pages_collection=pages_collection.add($this.data('switcher').elements)
				})
				
			pages_collection
				.hide()
				.appendTo(content)
				
			$('footer .copyright,.follow-links')
				.appendTo(footer)
				
		
			mobile_wrap
				.append(header)
				.append(content)
				.append(footer)
			mobile_wrap.find(notForMobileClass).remove()
			mobile_wrap.appendTo($('body').html(''))
			
			FJSCore.modules.switcher()
			FJSCore.modules.follows()
			
			select_menu.on('change',function(){				
				$(document).trigger('changeLocation',select_menu.val())
			})
			
			$('.follow-links')
				.click(function(e,d){
					var $this=$(this)
						,h=$('a',$this).outerHeight()
					$('>li',this)
						.stop()
						.animate({
							height:h
						})
					e.stopPropagation()
				})
			$('.follow-links a').click(function(e,d){
				var href=$(this).attr('href').replace(FJSCore.basepath,'')			
				$(document).trigger('changeLocation',href)
				$('.follow-links>li')
					.stop()
					.animate({
						height:0
					})
				return false
			})
			
			$(document).on('click',':not(".follow-links")',function(){
				$('.follow-links>li')
					.stop()
					.animate({
						height:0
					})
			})
			
			$(FJSCore).on('changeState',function(e,d){
				select_menu.val(FJSCore.state)
			})
			
			$(document)
				.on('show','#mobile-content>*',function(e,d){					
					$(this).show()
				})				
				.on('hide','#mobile-content>*',function(e,d){
					$(this).hide()
				})
				
		})	
}(window.jQuery);


!function($){
if(!FJSCore.mobile)
	$(function longScroller(){
		var map=[]
		,names=[]
		,scrollHolder=$('[data-follow="location"][data-type="switcher"][data-behavior="scroll"]')
		,items=scrollHolder.children()
		,$scrollable=$('html,body')
		,scrollable=$scrollable[0]
		,scroll_duration=1400
		,Core=window.FJSCore
		,$Core=$(Core)
		,doc=$(document)
		,win=$(window)
		,currentLocation
		,n=0,tmr
	
	FJSCore.modules.longScroller=longScroller
	
	if(items.length!==0){
		items
			.each(function(n){
				map[n]=this.offsetTop
				names[n]=$(this).data('id')
			})
		
		
		function onresize(){
			items
				.each(function(n){
					map[n]=this.offsetTop
				})
			$scrollable.stop()			
			if(scrollHolder.data('switcher').curr&&scrollHolder.data('switcher').curr.length!==0)
				$scrollable
						.stop()
						.animate({
							scrollTop:scrollHolder.data('switcher').curr.prop('offsetTop')
						},{
							duration:scroll_duration
						})				
		}
		
		win
			.on('load afterload',function(){
				onresize()
			})
			.resize(function(){
				n++
				clearTimeout(tmr)
				tmr=setTimeout(function(){
					if(n>1)
						onresize()
					n=0
				},100)
			})
		onresize()
		
		longScroller.blockScrollCalc=false
		
		win
			.on('scroll',function(){
				if(longScroller.blockScrollCalc)
					return false
					
				var i=0
				
				while(map[i++]-win.height()/2<=win.scrollTop()){}
				
				if(Core.state!==undefined&&names[i-2]!==Core.state)					
					doc.trigger('changeLocation',currentLocation=names[i-2])
			})
			.on('mousewheel',function(){
				$scrollable.stop()
			})
			
		items
			.on('show',function(e,d){				
				if(Core.state!==currentLocation)
					scrollHolder.trigger('scrollstart')
					,$scrollable
						.stop()						
						.animate({
							scrollTop:d.curr.prop('offsetTop')
						},{
							duration:scroll_duration
							// ,step:function(){
								// scrollHolder.trigger('scrollstep')
							// }
						})
					,$.when($scrollable)
						.then(function(){
							scrollHolder.trigger('scrollend')
						})
			})
		}
	})
	
}(window.jQuery);


!function($){
	$(function(){
		FJSCore.modules.search=search
		search()
		function search(root){
			$('form[data-type="ajax"]',root)
				.each(function(){
					var $this=$(this)
					$this.submit(function(){
						var get=$('[name]',$this).map(function(){
							return $(this).attr('name')+'='+$(this).val()
						}).toArray().join('&')
						
						$(document).trigger('changeLocation',$this.attr('action').slice(2)+'?'+get)
						
						return false
					})
				})
		}
	})
}(window.jQuery);


// !function($){}(window.jQuery);


function include(src){document.write('<script src="'+src+'" type="text/javascript"></script>')}