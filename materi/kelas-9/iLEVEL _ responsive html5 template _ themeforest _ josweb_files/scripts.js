/***************************************************
		MENU
***************************************************/
	jQuery( document ).ready( function( $ ) {
	
		$('body').addClass('js');
		  var $menu = $('#menu'),
		  	  $menulink = $('.menu-link'),
		  	  $menuTrigger = $('.has-submenu > a');

		$menulink.click(function(e) {
			e.preventDefault();
			$menulink.toggleClass('active');
			$menu.toggleClass('active');
		});

		$menuTrigger.click(function(e) {
			e.preventDefault();
			var $this = $(this);
			$this.toggleClass('active').next('ul').toggleClass('active');
		});
		
/***************************************************
		TOOLTIP & POPOVER
***************************************************/
$("[rel=tooltip]").tooltip();
$("[data-rel=tooltip]").tooltip();

/***************************************************
		CAROUSEL - STOP AUTO CYCLE
***************************************************/
 $('.carousel').carousel({
    interval: false});

/***************************************************
		HOVERS
***************************************************/
	$(".hover_colour").on('mouseover',function(){
			var info=$(this).find("img");
			info.stop().animate({opacity:0.1},500);
		}
	);
	$(".hover_colour").on('mouseout',function(){
			var info=$(this).find("img");
			info.stop().animate({opacity:1},800);
		}
	);
	
/***************************************************
		BACK TO TOP LINK
***************************************************/
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go-top').fadeIn(200);
				} else {
					$('.go-top').fadeOut(200);
				}
			});
			
			// Animate the scroll to top
			$('.go-top').click(function(event) {
				event.preventDefault();
				
				$('html, body').animate({scrollTop: 0}, 300);
			})
		});	

/***************************************************
	QUOTES
***************************************************/		
/*
 * jquery.cbpQTRotator.min.js v1.0.0 - http://www.codrops.com - Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
*/
(function(c,b,e){var d=b.Modernizr;c.CBPQTRotator=function(f,g){this.$el=c(g);this._init(f)};c.CBPQTRotator.defaults={speed:700,easing:"ease",interval:8000};c.CBPQTRotator.prototype={_init:function(f){this.options=c.extend(true,{},c.CBPQTRotator.defaults,f);this._config();this.$items.eq(this.current).addClass("cbp-qtcurrent");if(this.support){this._setTransition()}this._startRotator()},_config:function(){this.$items=this.$el.children("div.cbp-qtcontent");this.itemsCount=this.$items.length;this.current=0;this.support=d.csstransitions;if(this.support){this.$progress=c('<span class="cbp-qtprogress"></span>').appendTo(this.$el)}},_setTransition:function(){setTimeout(c.proxy(function(){this.$items.css("transition","opacity "+this.options.speed+"ms "+this.options.easing)},this),25)},_startRotator:function(){if(this.support){this._startProgress()}setTimeout(c.proxy(function(){if(this.support){this._resetProgress()}this._next();this._startRotator()},this),this.options.interval)},_next:function(){this.$items.eq(this.current).removeClass("cbp-qtcurrent");this.current=this.current<this.itemsCount-1?this.current+1:0;this.$items.eq(this.current).addClass("cbp-qtcurrent")},_startProgress:function(){setTimeout(c.proxy(function(){this.$progress.css({transition:"width "+this.options.interval+"ms linear",width:"100%"})},this),25)},_resetProgress:function(){this.$progress.css({transition:"none",width:"0%"})},destroy:function(){if(this.support){this.$items.css("transition","none");this.$progress.remove()}this.$items.removeClass("cbp-qtcurrent").css({position:"relative","z-index":100,"pointer-events":"auto",opacity:1})}};var a=function(f){if(b.console){b.console.error(f)}};c.fn.cbpQTRotator=function(g){if(typeof g==="string"){var f=Array.prototype.slice.call(arguments,1);this.each(function(){var h=c.data(this,"cbpQTRotator");if(!h){a("cannot call methods on cbpQTRotator prior to initialization; attempted to call method '"+g+"'");return}if(!c.isFunction(h[g])||g.charAt(0)==="_"){a("no such method '"+g+"' for cbpQTRotator instance");return}h[g].apply(h,f)})}else{this.each(function(){var h=c.data(this,"cbpQTRotator");if(h){h._init()}else{h=c.data(this,"cbpQTRotator",new c.CBPQTRotator(g,this))}})}return this}})(jQuery,window);

/***************************************************
	SKILLS
***************************************************/	
 setTimeout(function(){
 $('.progress .bar').each(function() {
            var me = $(this);
            var perc = me.attr("data-percentage");
			 var current_perc = 0;
			var progress = setInterval(function() {
                if (current_perc>=perc) {
                    clearInterval(progress);
                } else {
                    current_perc +=1;
                    me.css('width', (current_perc)+'%');
                }
				me.text((current_perc)+'%');
			}, 20);
		});
	},300);
	
	$('.bar-percentage[data-percentage]').each(function () {
  var progress = $(this);
  var percentage = Math.ceil($(this).attr('data-percentage'));
  $({countNum: 0}).animate({countNum: percentage}, {
    duration: 2000,
    easing:'linear',
    step: function() {
      // What todo on every count
      var pct = Math.floor(this.countNum) + '%';
      progress.text(pct) && progress.siblings().children().css('width',pct);
    }
  });
});
/***************************************************
	EXPANDING GALLERY
***************************************************/	
	/*
	SuperBox v1.0.0
	by Todd Motto: http://www.toddmotto.com
	Latest version: https://github.com/toddmotto/superbox
	Copyright 2013 Todd Motto
	Licensed under the MIT license
	http://www.opensource.org/licenses/mit-license.php
	SuperBox, the lightbox reimagined. Fully responsive HTML5 image galleries.
*/
;(function(e){e.fn.SuperBox=function(t){var n=e('<div class="superbox-show"></div>');var r=e('<img src="" class="superbox-current-img">');var i=e('<div class="superbox-close"></div>');n.append(r).append(i);return this.each(function(){e(".superbox-list").click(function(){var t=e(this).find(".superbox-img");var i=t.data("img");r.attr("src",i);if(e(".superbox-current-img").css("opacity")==0){e(".superbox-current-img").animate({opacity:1})}if(e(this).next().hasClass("superbox-show")){n.toggle()}else{n.insertAfter(this).css("display","block")}e("html, body").animate({scrollTop:n.position().top-t.width()},"medium")});e(".superbox").on("click",".superbox-close",function(){e(".superbox-current-img").animate({opacity:0},200,function(){e(".superbox-show").slideUp()})})})}})(jQuery);

/***************************************************
		PRETTYPHOTO
***************************************************/
$('a[data-rel]').each(function() {
$(this).attr('rel', $(this).attr('data-rel')).removeAttr('data-rel');
});
$("a[rel^='prettyPhoto']").prettyPhoto();
jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
overlay_gallery: false, social_tools: false,  deeplinking: false
});

	