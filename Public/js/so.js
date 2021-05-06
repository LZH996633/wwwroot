$(function(){
	$(".hdewmct").hover(function(){
		$(this).find(".pic").stop(true,true).slideDown();
	},function(){
		$(this).find(".pic").stop(true,true).slideUp("fast")
	})
	$(".searchmt .jzsea i").hover(function(){
		$(this).parent().find("ul").stop(true,true).fadeIn();
	},function(){
		$(this).parent().find("ul").stop(true,true).fadeOut()
	})
	
	$(".searchmt .downlop span").click(function(e){
		if($(this).parent().find("ul").css("display")=="block")
		{
			$(this).parent().find("ul").stop(true,true).slideUp("fast");
			$(this).find("em").removeClass("on")
		}else
		{
			e.stopPropagation(); 
			$(this).parent().find("ul").stop(true,true).slideDown();
			$(this).find("em").addClass("on")
		}
		
	})
	$(".searchmt .downlop ul li").click(function(){
		$(this).parent().parent().find("span i").text($(this).text());
		$(this).parent().parent().find("span em").removeClass("on");
		$(this).parent().stop(true,true).slideUp("fast");
	})
	$(document).click(function() {
		if ($(".searchmt .downlop ul").css("display")=="block"){
		$(".searchmt .downlop ul").stop(true,true).slideUp();
		$(".searchmt .downlop span em").removeClass("on");
		} 
		});
	$(".searchmt .downlop ul").click(function (e) { 
		e.stopPropagation();
		}); 
	$(".sxpart").click(
		function(){
			if($(this).find("ul").css('display')=="none"){
				$(".sxpart .title").removeClass("on");
				$(".sxpart ul").hide();
				$(this).find(".title").addClass("on");
				//$(this).find("ul").slideDown();
			}else{
				$(".sxpart .title").removeClass("on");
				$(".sxpart ul").hide();
			}
		})
		$(".sxpart").hover(
			function(){return;},
			function(){
				$(".sxpart .title").removeClass("on");
				$(".sxpart ul").hide();
		})

})

var scrollFunc = function (e) {
    var direct = 0;
    e = e || window.event;
    if (e.wheelDelta) {             
        if (e.wheelDelta > 0) { 
           $(".dthd").addClass("on");
        }
        if (e.wheelDelta < 0) { 
            $(".dthd").removeClass("on"); 
        }
    } else if (e.detail) {  
        if (e.detail> 0) {
             $(".dthd").addClass("on"); 
        }
        if (e.detail< 0) {
             $(".dthd").removeClass("on");
        }
    }
    
}
if (document.addEventListener) {
    document.addEventListener('DOMMouseScroll', scrollFunc, false);
}
window.onmousewheel = document.onmousewheel = scrollFunc; 





