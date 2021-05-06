
function tab(thisObj,Num){
	if(thisObj.className == "active")return;
	var tabObj = thisObj.parentNode.id;
	var tabList = document.getElementById(tabObj).getElementsByTagName("li");
	for(i=0; i <tabList.length; i++)
	{
	  if (i == Num)
	  {
	   thisObj.className = "active"; 
		  document.getElementById(tabObj+"_cont"+i).style.display = "block";
	  }else{
	   tabList[i].className = "normal"; 
	   document.getElementById(tabObj+"_cont"+i).style.display = "none";
	  }
	} 
}
function scrollpic(obj){
	var scrollObj;
	var currentTop = 0;
		$(obj).children('div:eq(2)').mousemove(function () {
			clearInterval(scrollObj);
			scrollObj = setInterval(function () {
				var mainH = $(obj).children('div:eq(0)').children().height();			
				if (currentTop + mainH > $(obj).height())
				{
					currentTop--;
					currentTop--;
					$(obj).children('div:eq(0)').css('top', currentTop);
				}
				
			}, 10);
		}).mouseleave(function () {
			clearInterval(scrollObj);
		}).css('margin-top', $(obj).height() / 2);

		$(obj).children('div:eq(1)').mouseover(function () {
			clearInterval(scrollObj);
			
			scrollObj = setInterval(function () {
				var mainH = $(obj).children('div:eq(0)').children().height();
				
				if (currentTop < 0) {
					currentTop++;
					currentTop++;
				
					$(obj).children('div:eq(0)').css('top', currentTop);
				}
			}, 10);
		}).mouseleave(function () {
			clearInterval(scrollObj);
		});	
}


$(function(){
	//充值
	$(".ltnav li").each(function(i){		
		$(this).hover(function(){
			$(this).addClass("active");
			$(this).next().addClass("active");			
			$(this).find("i a").addClass("active");			
		},function(){
			$(this).removeClass("active");
			$(this).next().removeClass("active");			
			$(this).find("i a").removeClass("active");
		});
	});
	//全选 #allcheck 全选对象  .checkon 单个对象
	$("#allcheck").on("click",function(){
		if($(this).attr('checked')=="checked"){
			$(".checkon").attr("checked","checked");		
		}else{
			$(".checkon").removeAttr("checked");
			
		}
	});
	
});


