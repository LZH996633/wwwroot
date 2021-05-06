head.ready('imgload', function() {
    $('img.lazy').imglazyload({
        event: 'scroll',
        attr: 'lazy-src'
    });
    $(function() {
        $(".scrollpic").each(function() {
            scrollpic($(this));
        });
    });
    $(".aomainlit .listmains li i").click(function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass('active').text("更多");
           /* $(this).parent().find("span").animate({
                height: "42px",
            }, 5000);*/
        } else {
            $(this).addClass('active').text("收起");
            $(this).parent().find("span").css({
                height: "auto"
            });
        }
    });      

	$(".sxpart").click(
	function(){
		if($(this).find("ul").css('display')=="none"){
			$(".sxpart .title").removeClass("active");
			$(".sxpart ul").slideUp();
			$(this).find(".title").addClass("active");
			$(this).find("ul").slideDown();
		}else{
			$(".sxpart .title").removeClass("active");
			$(".sxpart ul").slideUp();
		}
	})
	$(".sxpart").hover(
		function(){return;},
		function(){
			$(".sxpart .title").removeClass("active");
			$(".sxpart ul").slideUp();
	})
});
head.ready('masonry', function() {
	var container = document.querySelector('#container');
	$(function(){

	var msnry = new Masonry( container, {
	  itemSelector: '.items',
	  singleMode: false, // 宽度固定不计算，由css控制
	    
	});



	});
	window.onresize= function(){
	var msnry = new Masonry( container, {
	  itemSelector: '.items',
	  singleMode: false, // 宽度固定不计算，由css控制
	    
	});
	}
});
function scrollpic(obj) {
    var scrollObj;
    var currentTop = 0;
    $(obj).children('div:eq(2)').mousemove(function() {
        clearInterval(scrollObj);
        scrollObj = setInterval(function() {
            var mainH = $(obj).children('div:eq(0)').children().height();
            if (currentTop + mainH > $(obj).height()) {
                currentTop--;
                currentTop--;
                $(obj).children('div:eq(0)').css('top', currentTop);
            }
        }, 10);
    }).mouseleave(function() {
        clearInterval(scrollObj);
    }).css('margin-top', $(obj).height() / 2);
    $(obj).children('div:eq(1)').mouseover(function() {
        clearInterval(scrollObj);
        scrollObj = setInterval(function() {
            var mainH = $(obj).children('div:eq(0)').children().height();
            if (currentTop < 0) {
                currentTop++;
                currentTop++;
                $(obj).children('div:eq(0)').css('top', currentTop);
            }
        }, 10);
    }).mouseleave(function() {
        clearInterval(scrollObj);
    });
}