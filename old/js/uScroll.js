//0.2.2
;(function($){	
	$.fn.uScroll=function(o){
		return this.each(function(){
			var th=$(this)
				,_=th.data('uScroll')||{
					pos:{}
					,tracks:{}
					,delta:{}
					,tdelta:{}
					,opt:{
						axis:'y'
						,lay:'inside'
						,styles:true
						,step:40
						,btn:'+.scroll-btns a'
						,track:$(document.createElement('track')).addClass('_track').css({display:'block'})
						,shuttle:$(document.createElement('shuttle')).addClass('_shuttle').css({display:'block'})
						,width:30
						,height:'auto'
						,overflow:'hidden'
						,cursor:'auto'
						,duration:300
						,easing:'linear'
						,clickable:true
						,mousewheel:false
						,forceOnTrack:false
					}
					,fu:{
						renderTrack:function(){
							var axis=_.opt.axis
								,shu
								,opt=$.extend({},_.opt)
							_.cntnr
								&&_.cntnr
									.css({
										overflow:'hidden'
									})
									.cssDefaults({
										"position?static":'relative'										
									})
							if(_.tracks[axis]&&_.tracks[axis].remove)
								_.tracks[axis].remove()							
							_.tracks[axis]=_.opt.track.clone().css({position:'absolute'}).data({opt:opt})
							if(_.opt.lay=='inside')
								_.tracks[axis]
									.appendTo(_.me)									
							if(_.opt.lay=='outside')
								_.tracks[axis]
									.appendTo(_.me.parent())
							
							_.tracks[axis]
								.addClass('_'+_.opt.lay)
								.addClass('_axis-'+axis)
							opt.pt=parseInt(_.tracks[axis].css('padding-top'))
							opt.pl=parseInt(_.tracks[axis].css('padding-left'))
							opt.pr=parseInt(_.tracks[axis].css('padding-right'))
							opt.pb=parseInt(_.tracks[axis].css('padding-bottom'))

							if(_.opt.lay=='inside'&&axis=='y'&&_.tracks[axis].css('height')=='0px')
								_.tracks[axis].outerHeight(_.me.outerHeight())
							if(_.opt.lay=='inside'&&axis=='x'&&_.tracks[axis].css('width')=='0px')
								_.tracks[axis].outerWidth(_.me.outerWidth())
								
							if(axis=='y'&&_.tracks[axis].css('width')=='0px')
								_.tracks[axis].width(30)
							if(axis=='x'&&_.tracks[axis].css('height')=='0px')
								_.tracks[axis].height(30)
							
							shu=_.opt.shuttle.clone().css({position:'absolute'}).appendTo(_.tracks[axis])
							opt.shuttle=shu
							opt.track=_.tracks[axis]							
							
							if(axis=='y')								
								shu
									.cssDefaults({
										"width?0,0px,auto":_.opt.width
										,"height?0,0px,auto":_.tracks[axis].outerHeight()*_.me.outerHeight()/_.cntnr.outerHeight()
										,"left?0,0px,auto":0
										,"top?0,0px,auto":opt.pt||0
									})							
							if(axis=='x')									
								shu
									.cssDefaults({
										"width?0,0px,auto":_.tracks[axis].outerWidth()*_.me.outerWidth()/_.cntnr.outerWidth()
										,"height?0,0px,auto":_.opt.width
										,"left?0,0px,auto":opt.pl||0
										,"top?0,0px,auto":0
									})								
							_.delta[axis]=_.cntnr[axis=='y'?'outerHeight':'outerWidth']()-_.me[axis=='y'?'outerHeight':'outerWidth']()
							_.tdelta[axis]=(_.tracks[axis][axis=='y'?'outerHeight':'outerWidth']()-(axis=='y'?(opt.pt+opt.pb):(opt.pl+opt.pr)))-shu[axis=='y'?'outerHeight':'outerWidth']()
							_.pos[axis]=-_.cntnr.prop(axis=='y'?'offsetTop':'offsetLeft')/_.delta[axis]
							_.fu.moveTrack(axis,shu,false)
							_.fu.dragInit(shu,axis)
							if(_.opt.mousewheel&&$.fn.mousewheel)
								_.fu.mousewheel(shu)
							if(_.opt.clickable)
								_.fu.clicks(axis,shu)
							_.fu.btns()							
						}						
						,dragInit:function(shu,axis){
							var opt=_.tracks[axis].data('opt')
							shu
								.css(axis=='y'?'top':'left',_.pos[axis]*_.delta[axis]+opt.pt)
								.dragg({
									axis:axis
									,calcPadding:true
									,cursor:_.opt.cursor
									,containment:_.tracks[axis]
									,drag:function(){
										shu.stop()
										if(axis=='y')
											_.pos[axis]=(shu.prop('offsetTop')-opt.pt)/_.tdelta[axis]
										else
											_.pos[axis]=(shu.prop('offsetLeft')-opt.pl)/_.tdelta[axis]
										_.pos[axis]=_.pos[axis]<0?0:_.pos[axis]>1?1:_.pos[axis]										
										_.fu.move(axis,false)										
									}
								})
						}						
						,btns:function(){
							var btns=$(_.opt.btn,_.me)
							function init(){
								var th=$(this)
									th
										.click(function(){
											_.fu.str(th.data('type'))											
											return false
										})
							}
							if(btns.length)								
								btns.each(init)
							else								
								$(_.opt.btn).each(init)
						}
						,mousewheel:function(shu){
							var obj={}
								,axis=_.opt.axis
							obj.step=_.opt.step
							_.tracks[axis]
								.on('mouseenter',function(){
									if(_.opt.forceOnTrack)
										obj.step=_.opt.step*_.opt.forceOnTrack									
								})
								.on('mouseleave',function(){
									obj.step=_.opt.step
								})
							
							_.me.add(_.tracks[axis])
								.mousewheel(function(e,d){									
									_.pos[axis]+=~d?-obj.step/_.delta[axis]:obj.step/_.delta[axis]
									_.pos[axis]=_.pos[axis]<0?0:_.pos[axis]>1?1:_.pos[axis]
									_.fu.move(axis,true)
									_.fu.moveTrack(axis,shu)
									return false
								})							
						}
						,clicks:function(axis,shu){
							shu.on('mousedown',function(){
								return false
							})
							
							_.tracks[axis]
								.on('mousedown',function(e){
									var th=$(this)
										,opt=th.data('opt')
										,crd=th.offset()
										,ml=e.pageX-crd.left
										,mt=e.pageY-crd.top
										,pos=0									
									pos=axis=='y'?(mt-opt.pt)/th.height():(ml-opt.pl)/th.width()
									pos=pos<0?0:pos>1?1:pos
									_.pos[axis]=pos
									_.fu.move(axis,true)
									_.fu.moveTrack(axis,shu)									
									return false
								})
								.on('mouseup',function(){
									var th=$(this)
										,opt=th.data('opt')
									_.cntnr.stop()
									_.tracks[axis].data('opt').shuttle.stop()
									if(axis=='y')
										_.pos[axis]=(shu.prop('offsetTop')-opt.pt)/_.tdelta[axis]
									else
										_.pos[axis]=(shu.prop('offsetLeft')-opt.pl)/_.tdelta[axis]
								})								
						}
						,move:function(axis,animate){
							var crd={}							
							crd[axis=='y'?'top':'left']=-_.pos[axis]*_.delta[axis]							
							if(animate)
								_.cntnr
									.stop()
									.animate(crd,{
										duration:_.opt.duration
										,easing:_.opt.easing
									})
							else
								_.cntnr
									.stop()
									.css(crd)									
						}
						,moveTrack:function(axis,shu){							
							var crd={}
								,opt=_.tracks[axis].data('opt')
							crd[axis=='y'?'top':'left']=_.pos[axis]*_.tdelta[axis]+opt[axis=='y'?'pt':'pl']							
							shu=shu||opt.shuttle
							if(shu&&shu.stop)
								shu
									.stop()
									.animate(crd,{
										duration:_.opt.duration
										,easing:_.opt.easing
									})
						}
						,str:function(o){
							var axis=_.opt.axis
							if(o=='scrollDown')
								_.pos[axis]+=_.opt.step/_.delta[axis]
								,_.pos[axis]=_.pos[axis]<0?0:_.pos[axis]>1?1:_.pos[axis]
								,_.fu.move(axis,true)
								,_.fu.moveTrack(axis)
							if(o=='scrollUp')
								_.pos[axis]-=_.opt.step/_.delta[axis]
								,_.pos[axis]=_.pos[axis]<0?0:_.pos[axis]>1?1:_.pos[axis]
								,_.fu.move(axis,true)
								,_.fu.moveTrack(axis)
						}
					}
					,init:function(){
						_.init.ready=true
						_.me.data({uScroll:_})
						if(typeof _.opt.init=='function')
							_.opt.init()						
						_.me
							.css({
								overflow:_.opt.overflow
							})							
					}
				}			
			_.me=th
				.cssDefaults({
					"position?static":'relative'
				})
			_.cntnr=$('>div',_.me)
			if(typeof o=='object')
				$.extend(_.opt,o)
				,_.fu.renderTrack()
			if(typeof o=='string')
				_.fu.str(o)
			if(!_.init.ready)
				_.init()
		})
	}
	
	$.fn.cssDefaults=function(o){
		return this.each(function(){
			if(typeof o!='object')
				return false
			var th=$(this)
			$.each(o,function(k,v){
				var style=k.split('?')
					,que=style[1].split(',')
					,i,l
					,currCSS
				style=style[0]
				currCSS=th.css(style)				
				for(i=0,l=que.length;i<l;i++)
					if(currCSS==que[i])
						th.css(style,v)			
			})
		})
	}
})(jQuery)
;(function($){
	var hasTouch='ontouchstart' in window && !(/hp-tablet/gi).test(navigator.appVersion)
	
	$.fn.dragg=function(o){
		return this.each(function(){
			var th=$(this)				
				,body=$('body')
				,hld
				,sx,xy,csx,csy
				,mix,miy,max,may
				,cont
				,pd
				,startEv=hasTouch?'touchstart':'mousedown'
				,moveEv=hasTouch?'touchmove':'mousemove'
				,endEv=hasTouch?'touchend touchcancel':'mouseup'
			
			o=$.extend(true,{
				axis:'xy'				
				,containment:false
				,cursor:'auto'
				,calcPadding:false
				,start:function(){}
				,end:function(){}
				,drag:function(){}
			},o)
			
			if(o.containment){
				cont=o.containment				
				if(cont=='parent')
					cont=th.parent()
				if(typeof cont=='string')
					cont=$(cont)
				if(cont.prop)
					max=cont.prop('offsetWidth')-th.prop('offsetWidth')-parseInt(cont.css('paddingRight'))
					,may=cont.prop('offsetHeight')-th.prop('offsetHeight')-parseInt(cont.css('paddingBottom'))
					,mix=parseInt(cont.css('paddingLeft'))
					,miy=parseInt(cont.css('paddingTop'))				
			}
			
			function start(e){				
				hld=true
				e=hasTouch?e.originalEvent.touches[0]:e
				
				sx=~o.axis.indexOf('x')?e.pageX:false
				sy=~o.axis.indexOf('y')?e.pageY:false
				
				th
					.css({
						left:csx=th.prop('offsetLeft')
						,top:csy=th.prop('offsetTop')
					})
				o.start()
				return false
			}
			
			function end(e){
				if(!hld)
					return false
				hld=false
				
				th
					.css({
						cursor:'auto'
					})
				o.end()
			}
			
			function drag(e){
				if(!hld)
					return false
				var x,y
				
				e=hasTouch?e.originalEvent.touches[0]:e
				
				x=sx?csx+(e.pageX-sx):csx
				y=sy?csy+(e.pageY-sy):csy
				
				if(cont)
					x=x<mix?mix:x>max?max:x
					,y=y<miy?miy:y>may?may:y
				
				th
					.css({
						left:x
						,top:y
						,cursor:o.cursor
					})
				o.drag()
			}
			
			th.on(startEv,function(e){
				start(e)
				return false
			})
			body.on(endEv,function(e){
				end(e)
			})
			body.on(moveEv,function(e){
				drag(e)
			})
		})
	}
})(jQuery)