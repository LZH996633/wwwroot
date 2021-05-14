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

		if($(".sc").text()=="Favorites"){
			
			$.getJSON(SiteUrl+'/index.php/Ajax/Favor?fa_id='+opus_id+"&"+Math.random()+'&seller_id='+seller_id, function(data){

				if(data.status==1)	{
					 layer.msg("Collection success！",{icon:1,time:1000},function(){
						$("#favorite").html(n+1);
						$(".sc").html("Collected");
					 });				
				}
				else if(data.status==-1){
					 layer.msg("Please log in to bookmark!",{icon:1,time:1000},function(){
						$(".logintk").show();
						$(".graybg").show();
					 });
				}
				else if(data.status==-3) {
					layer.msg("Cannot bookmark my own template!",{icon:2,time:2000});
				   
				}
				else {
					layer.msg("Collection failed!",{icon:1,time:2000});
			   
				}
			});
		}else{
				
			layer.confirm('Are you sure to uncollect??', {icon: 3, title:'Unfavorite'}, function(index){
			
				$.getJSON(SiteUrl+'/index.php/Ajax/Favor?fa_id='+opus_id+"&"+Math.random(), function(data){
                  if(data.status==2){
						 layer.msg("Collection canceled！",{icon:1,time:1000},function(){
							$("#favorite").html(n-1);
							$(".sc").html("Favorites");
						 });
					}else {
						layer.msg("Failed to unfavorite!",{icon:1,time:2000});
				   
					}
				});
			});
		}
	}
	/*关注操作*/
	function follow(seller_id) {
		var SiteUrl = $('#SiteUrl').val();
		if($(".follow").text()=="attention"){
			$.getJSON(SiteUrl+'/index.php/Ajax/Focus?seller_id='+seller_id+"&"+Math.random(), function(data){
				
				if(data.status==1)	{
					 layer.msg("Subscribed！",{icon:1,time:1000},function(){
						$(".follow").html("Followed");					 });
				}
				else if(data.status==-1){
					 layer.msg("Please log in and follow!",{icon:1,time:1000},function(){
						$(".logintk").show();
						$(".graybg").show();
					 });
				} else if(data.status==-3) {
					layer.msg("Can't pay follow to yourself!",{icon:2,time:2000});
			   
				} else {
					layer.msg("Follow failed!",{icon:1,time:2000});
			   
				}
			});
		}else{
				
			layer.confirm('Confirm Unfollow it?', {icon: 3, title:'unsubscribe'}, function(index){
			
				$.getJSON(SiteUrl+'/index.php/Ajax/Focus?seller_id='+seller_id+"&"+Math.random(), function(data)
				{
					if(data.status==2){
						 layer.msg("Follow has been cancelled！",{icon:1,time:1000},function(){
							$(".follow").html("Attention");
						 });
					}else {
						layer.msg("Unfollow failed!",{icon:1,time:2000});

					}
				});
			});
		}
	}