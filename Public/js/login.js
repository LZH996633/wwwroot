if (($.browser.msie)&&($.browser.version == "6.0")){
	try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
}
$(function(){
	$('#usernav li').hover(function(){
		$(this).addClass('current')
		},function(){
		$(this).removeClass('current')	
			})
	$('#netnav,#imgnav').hover(function(){},function(){$(this).hide()})
	$('#messageshow').hover(function(){},function(){$(this).hide()})
	$('#netnav dd,#imgnav dd').hover(function(){
				$(this).addClass('current')
				},function(){
				$(this).removeClass('current')
				})	
	$('body').click(function(){
			$('#showmenu').hide()
		})
	})
	
function showpup(id,idmove,noborder){
				var idleft=($(document).width()-$(id).innerWidth())/2,height=$("body").innerHeight(),idtop=$(document).scrollTop()+(document.documentElement.clientHeight-$(id).height())/2;
				if(idtop<20){
					idtop =20;
				}
				var idciv0w=$(id).innerWidth()+16,idciv0h=$(id).innerHeight()+16;
				if (($.browser.msie)&&($.browser.version == "6.0")){
				var idciv0=$("<iframe id='boderdiv' frameborder='0' class='boderdiv123' style='width:"+idciv0w+"px;height:"+idciv0h+"px;background-color:#000;position:absolute;z-index:30;filter:Alpha(opacity=220);opacity:0.2;'></iframe>");
				}else{
					var idciv0=$("<div id='boderdiv' frameborder='0' class='boderdiv123' style='width:"+idciv0w+"px;height:"+idciv0h+"px;background-color:#000;position:absolute;z-index:30;filter:Alpha(opacity=20);opacity:0.2;'></div>");
	
				}
				var idciv1=$("<div id='bgdiv' class='bgdiv123' style='width:100%;height:"+height+"px;background-color:#000;position:absolute;left:0;top:0;z-index:20;filter:Alpha(opacity=30);opacity:0.3;'></div>");
				$(id).show().after(idciv1).after(idciv0);
				if(noborder){
					$('.boderdiv123').hide()
				}
				$("#boderdiv").offset({top:idtop-7,left:idleft-7});
				
				$(id).offset({top:idtop,left:idleft});
				if(idmove){
					move(id,idmove)
					move("#boderdiv",idmove)					
					}
	}


function hidepup(id){
		$(id).hide();
		$('.boderdiv123,.bgdiv123,.divScrollBar').remove()
	
	}
function move(id,idmove){
	$(idmove).mousedown(function(e){
		var ex=e.pageX,ey=e.pageY,leftw=$(id).offset().left,toph=$(id).offset().top;
		$('body').mousemove(function(e){
			var ew=e.pageX-ex+leftw,eh=e.pageY-ey+toph;
			$(id).offset({top:eh,left:ew})
			})
		})
	$(idmove).mouseup(function(e){
		$('body').unbind('mousemove');
		})
}


