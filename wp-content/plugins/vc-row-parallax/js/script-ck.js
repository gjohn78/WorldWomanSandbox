jQuery(document).ready(function($){"use strict";if($(".gambit_parallax_enable_smooth_scroll").length>0){"undefined"==typeof $.easing.easeOutQuint&&$.extend(jQuery.easing,{easeOutQuint:function(t,a,e,r,n){return r*((a=a/n-1)*a*a*a*a+1)+e}});var t=!1,a=$(document).height()-$(window).height(),e=$(window).scrollTop();$(window).bind("scroll",function(){t===!1&&(e=$(this).scrollTop())}),$(document).bind("DOMMouseScroll mousewheel",function(r,n){return n=n||-r.originalEvent.detail/3||r.originalEvent.wheelDelta/120,t=!0,e=Math.min(a,Math.max(0,parseInt(e-120*n))),$(-1!==navigator.userAgent.indexOf("AppleWebKit")?"body":"html").stop().animate({scrollTop:e+"px"},1600,"easeOutQuint",function(){t=!1}),!1})}$("div.bg-parallax").each(function(){if("undefined"!=typeof $(this).attr("data-row-span")){var t=parseInt($(this).attr("data-row-span"));if(!isNaN(t)&&0!==t){var a=$(this).nextAll(".wpb_row");a.splice(0,1),a.splice(t),a.each(function(){$(this).prev().is(".bg-parallax")&&$(this).prev().remove(),$(this).addClass("bg-parallax-parent").css({backgroundImage:"",backgroundColor:"transparent"});var t="";"undefined"!=typeof $(this).attr("style")&&(t=$(this).attr("style")+";"),$(this).attr("style",t+"background-image: none !important; background-color: transparent !important;")})}}}),$("div.bg-parallax").each(function(){var t=$(this).next();"contain"===t.css("backgroundSize")&&t.css("backgroundSize","cover"),$(this).css({backgroundImage:t.css("backgroundImage"),backgroundRepeat:t.css("backgroundRepeat"),backgroundSize:t.css("backgroundSize"),backgroundColor:t.css("backgroundColor")}).prependTo(t.addClass("bg-parallax-parent")).scrolly2().trigger("scroll"),t.css({backgroundImage:"",backgroundRepeat:"",backgroundSize:"",backgroundColor:""});var a="";"undefined"!=typeof t.attr("style")&&(a=t.attr("style")+";"),t.attr("style",a+"background-image: none !important; background-color: transparent !important;"),("up"===$(this).attr("data-direction")||"down"===$(this).attr("data-direction"))&&$(this).css("backgroundAttachment","fixed")}),$(window).resize(function(){setTimeout(function(){var $=jQuery;$("div.bg-parallax").each(function(){if("undefined"!=typeof $(this).attr("data-break-parents")){var t=parseInt($(this).attr("data-break-parents"));if(!isNaN(t)){for(var a=$(this).parent(),e=a,r=0;t>r&&!e.is("html");r++)e=e.parent();var n=e.width()+parseInt(e.css("paddingLeft"))+parseInt(e.css("paddingRight")),s=-(a.offset().left-e.offset().left);s>0&&(s=0),$(this).addClass("broke-out").css({width:n,left:s}).parent().addClass("broke-out")}}}),$("div.bg-parallax").each(function(){if("undefined"!=typeof $(this).attr("data-row-span")){var t=parseInt($(this).attr("data-row-span"));if(!isNaN(t)&&0!==t){var a=$(this).parent(".wpb_row"),e=$(this).parent(".wpb_row").nextAll(".wpb_row");e.splice(t);var r=0;r+=parseInt(a.css("marginBottom")),e.each(function(){r+=$(this).height()+parseInt($(this).css("paddingTop"))+parseInt($(this).css("paddingBottom"))+parseInt($(this).css("marginTop"))}),$(this).css("height","calc(100% + "+r+"px)")}}}),$(document).trigger("scroll")},1)}),jQuery(window).trigger("resize")});