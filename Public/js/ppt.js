// JavaScript Document

head.ready('imgload', function() {
    $('img.lazy').imglazyload({
        event: 'scroll',
        attr: 'lazy-src'
    });
    
    $(".aomainlit .listmains li i").click(function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass('active').text("更多");
            $(this).parent().find("span").animate({
                height: "42px",
            }, 10);
	     $(this).parent().removeClass('on');
        } else {
	    $(".aomainlit .listmains li i").removeClass('active').text("更多");           
	    $(".aomainlit .listmains li span").css("height","42px");
	    $(this).addClass('active').text("收起");
            $(this).parent().find("span").css({
                height: "auto",
            });
	    $(".aomainlit .listmains li").removeClass('on');
	     
	     
	    $(this).parent().addClass('on');
        }
    });      
    
    
    $("#zkzq").click(function(){
    	if($(this).val()=="免费专区"){

		window.location.href="/index.php/model/index?cid=3";

	}else if($(this).val()=="查看全部"){
			window.location.href="/index.php/model/index?cid=2";
		
	}
    });
	$(".sxpart").click(

	function(){
		if($(this).find("ul").css('display')=="none"){
			$(".sxpart .title").removeClass("active");
			/*修改部分*/
			//$(".sxpart ul").slideUp();
			$(this).find(".title").addClass("active");
			//$(this).find("ul").slideDown();
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