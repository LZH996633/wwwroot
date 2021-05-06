head.ready('imgload', function() {
    $('img.lazy').imglazyload({
        event: 'scroll',
        attr: 'lazy-src'
    });
});
// head.ready('jquery', function() {
// var ie6 = /msie 6/i.test(navigator.userAgent), pptright = $(".rightct"), st;
// 	pptright.attr("otop", pptright.offset().top);
// 	var maxhei = 0,
// 		hei= $(".rightct").height();
//
// 	if(window.parent!= window && $.browser.msie) {
//
// 	    	maxhei = $(".caselist").offset().top+document.documentElement.scrollTop;
//
// 	}else{
//
// 	    	maxhei = $(".caselist").offset().top;
//
// 	}
// 	$(window).scroll(function() {
// 		st = Math.max(document.body.scrollTop || document.documentElement.scrollTop);
//
// 		if (st >= parseInt(pptright.attr("otop")) && st < maxhei-hei ) {
//
// 			if (ie6) {
// 				pptright.css({
// 					position:"absolute",
// 					top:st
// 				});
// 			} else if (pptright.css("position") != "fixed")
// 				{
// 					pptright.css({
// 					position:"fixed",
// 					top:"82px",
// 					});
// 					$(".rightct").addClass("active")
// 					$(".rightct").removeClass("active1");
// 				}
//
// 		}else if(st > maxhei-hei)
// 		{
// 			$(".rightct").removeClass("active");
// 			$(".rightct").addClass("active1");
// 			pptright.css({
// 					position:"absolute",
// 					bottom:0,
// 					right:0,
// 					top:"auto",
// 					"z-index":999
// 					});
//
// 		}
// 		else if (pptright.css("position") != "static")
// 			{
// 			 pptright.css({
// 				position:"static"
// 			});
// 			$(".rightct").removeClass("active");
// 			}
// 	});
//
// });

     /*收藏操作*/
    function favorite(opus_id,seller_id) {
	var SiteUrl = $('#SiteUrl').val();
		var n=parseInt($("#favorite").text());

		if($(".sc").text()=="收藏"){
			
			$.getJSON(SiteUrl+'/index.php/Ajax/Favor?fa_id='+opus_id+"&"+Math.random()+'&seller_id='+seller_id, function(data){

				if(data.status==1)	{
					 layer.msg("收藏成功！",{icon:1,time:1000},function(){
						$("#favorite").html(n+1);
						$(".sc").html("已收藏");
					 });				
				}
				else if(data.status==-1){
					 layer.msg("请登录后收藏!",{icon:1,time:1000},function(){
						$(".logintk").show();
						$(".graybg").show();
					 });
				}
				else if(data.status==-3) {
					layer.msg("不能收藏自己的模板!",{icon:2,time:2000});
				   
				}
				else {
					layer.msg("收藏失败!",{icon:1,time:2000});
			   
				}
			});
		}else{
				
			layer.confirm('确认取消收藏吗?', {icon: 3, title:'取消收藏'}, function(index){		  
			
				$.getJSON(SiteUrl+'/index.php/Ajax/Favor?fa_id='+opus_id+"&"+Math.random(), function(data){
                  if(data.status==2){
						 layer.msg("收藏已取消！",{icon:1,time:1000},function(){
							$("#favorite").html(n-1);
							$(".sc").html("收藏");
						 });
					}else {
						layer.msg("取消收藏失败!",{icon:1,time:2000});
				   
					}
				});
			});
		}
	}
	/*关注操作*/
	function follow(seller_id) {
		var SiteUrl = $('#SiteUrl').val();
		if($(".follow").text()=="关注"){
			$.getJSON(SiteUrl+'/index.php/Ajax/Focus?seller_id='+seller_id+"&"+Math.random(), function(data){
				
				if(data.status==1)	{
					 layer.msg("关注成功！",{icon:1,time:1000},function(){						
						$(".follow").html("已关注");					 });				
				}
				else if(data.status==-1){
					 layer.msg("请登录后关注!",{icon:1,time:1000},function(){
						$(".logintk").show();
						$(".graybg").show();
					 });
				} else if(data.status==-3) {
					layer.msg("不能关注自己!",{icon:2,time:2000});
			   
				} else {
					layer.msg("关注失败!",{icon:1,time:2000});
			   
				}
			});
		}else{
				
			layer.confirm('确认取消关注吗?', {icon: 3, title:'取消关注'}, function(index){		  
			
				$.getJSON(SiteUrl+'/index.php/Ajax/Focus?seller_id='+seller_id+"&"+Math.random(), function(data)
				{
					if(data.status==2){
						 layer.msg("关注已取消！",{icon:1,time:1000},function(){							
							$(".follow").html("关注");
						 });
					}else {
						layer.msg("取消关注失败!",{icon:1,time:2000});
				   
					}
				});
			});
		}
	}