<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<title><?php echo ($OpusDetail["opus_title"]); ?></title>
	<script language="javascript" type="text/javascript" src="__JS__/jquery.min.js"></script>
	<script src="__JS__/login.js" type="text/javascript"></script>
	<script src="__JS__/layer.js" type="text/javascript"></script>
	<script src="__JS__/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="__JS__/tips.js" type="text/javascript"></script>
	<script src="__JS__/jquery.lazyload.mini.js"></script>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($key); ?> ">
<meta name="description" content="<?php echo ($des); ?> "/>
<link rel="shortcut icon" href="__IMG__/favicon.ico" >
<!--Homepage interception-->
<link href="__CS__/ppts.css" rel="stylesheet" type="text/css">
<link href="__CS__/layer.css" rel="stylesheet" type="text/css">
<link href="__CS__/video/1555.css" rel="stylesheet" type="text/css">
<link href="__CS__/video/video-js.min.css" rel="stylesheet">
<script type="text/javascript" src="__JS__/video/vue.js"></script>
<script type="text/javascript" src="__JS__/video/video.min.js"></script>
<script type="text/javascript" src="__JS__/head.min.js" data-headjs-load="__JS__/init.js"></script>



	<script type="text/javascript" src="__JS__/jquery.min.js"></script>
	
	
	<link type="text/css" href="__CS__/loading.css" rel="stylesheet">
</head>

<body>

<div class="down-header mb-40 clearfix header">
	<div class="wrap">
		<div class="down-header-left fl"><a class="" href="javascript:history.back()" style="-webkit-text-fill-color: white">Back to material details page</a></div>

		<div class="is_login down-header-right font-color fr">
			<a href='javascript:void(0);' class="logina" style="color:#FFFFFF;">Log in</a>/
			<a href='javascript:void(0);' class="zcy" style="color:#FFFFFF;">Registered</a>
		</div>

		<div class="islogin down-header-right font-color fr" style="display: none">
			<a href="<?php echo U('Service/index');?>" style="color:#FFFFFF;">Member Centre</a>&nbsp;|&nbsp;
			<a href="<?php echo U('Public/login_out');?>" style="color:#FFFFFF;">Sign out</a>

		</div>
		<div class="down-header-mid font-color">Material download page</div>
	</div>
</div>
<div class="wrap mb-20 clearfix">
	<div class="downinfo-left fl">
		<input type="hidden" id="down_id" value="<?php echo ($OpusDetail["opus_id"]); ?>">
		<img src="<?php echo ($OpusDetail["opus_pic"]); ?>" title="" />
		<img src="<?php echo ($OpusDetail["opus_pic_cons"]); ?>" title="" />
	</div>
	<div class="downinfo-right fr">
		<div class="title mb-20"><a href="#" target="_blank"><?php echo ($OpusDetail["opus_title"]); ?>Material download</a></div>
		<div class="scinfo mb-20">
			<label>Material format：</label>
			<span>
				<?php echo ($OpusDetail["tip_software"]); ?>	</span>
			<label>Material type：</label>
			<span>
				<?php echo ($OpusDetail["tip_type"]); ?>	</span>
		<!--	<label>File size：</label>
			<span>
				<?php echo ($OpusDetail["opus_size"]); ?> MB			</span>-->
		</div>
		<?php if($OpusDetail["is_half"] == 0): ?><div class="userinfo mb-20">List price：<i class="amount"><?php echo ($OpusDetail["price"]); ?> </i>gold coins</a></div>
		<?php else: ?>
			<div class="userinfo mb-20">
				This material is free, you only need to download this material
				<i class="amount"><?php echo ($half_price); ?>gold coins</i>
				
			</div><?php endif; ?>


		<div class="down">&nbsp;&nbsp;<a class="pay_down fl download" href="javascript:void (0);" >Download now</a></div>
	</div>
</div>


<div class="indcaselist">
	<div class="wrap">
		<div class="cont index_hot">
		<!--	<p>Recommended in the same category：</p>   -->
			<?php if(is_array($SameList)): $i = 0; $__LIST__ = $SameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl>
					<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">
					
					
					
						<video id="video" poster="<?php echo ($list["opus_pic_big"]); ?>" onmouseover="videoPlayback()" onmouseout="videoStopped()" muted="muted" loop='loop' width="250" height="130">
                        <source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
                         </video>
						 
						 <!--
						<img class="lazy" src="<?php echo ($list["opus_pic"]); ?>" lazy-src="<?php echo ($list["opus_pic"]); ?>" style="display: inline;">
						-->
						
						
					
					<div class="upscr"></div>
					
					
					</a>
					<dd style="text-align:center;font-size:16px;"><a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank" ><?php echo ($list["opus_title"]); ?></a></dd>
					<!--<dd><span><ins><img src="__IMG__/indicos1.png"><?php echo ($list["down"]); ?></ins><i><img src="__IMG__/indicos2.png"><?php echo ($list["oext_favorite"]); ?></i><em></em></span></dd>  -->
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		
		<div>
		<ul style="padding-bottom:100px">
		&nbsp;
		</ul>
		</div>
		
		
	</div>
</div>


<div class="ctkmain4 none" id="yd_login">
	<ul>
		<li><label>Verification code：</label><input type="text" id="verify" class="webtxt" />
			<input  type="button" value="发送验证码"  class="webtn sendsms"/></li>
	</ul>
	<p>Note: Dear, since you are a remote login user, in order to protect your account security, you need to send a verification code</p>
</div>

<link  href="__CS__/loginout.css" rel="stylesheet"  type="text/css">



<style>
	.gt_holder.popup .gt_mask {background-color:#000;  opacity: 0.2;z-index: 99999;}
</style>
<div class="logintk aoaoanim aoaolayer">
	<div class="loginf">
		<div class="closed"></div>
		<ul class="tabbtn clearfix">
			<li class="current logina">log in</li>
			<li class="cz zcy">Registered</li>
		</ul>
		<div class="tabcon">
			<div class="sublist clearfix">
				<form method="post" action="<?php echo U('Public/login');?>"   onsubmit="return save_username(this)" >
					<div class="zcform fl">
						<ul>
							<li class="clearfix pr"><input type="text" class="webtxt"  name="username" id="log_username" placeholder="Username or email address"><span id="utip" class="onShow"></span></li>
							<li class="clearfix pr"><input type="password" class="webtxt" name="password" id="log_password" placeholder="Password"><span id="ptip" class="onShow"></span></li>

							<li class="clearfix pr"><input type="checkbox" value="2592000" name="cookie_time" id="cookietime" checked><label for="chd">Remember me</label><i class="forget">
								<a href="<?php echo U('Public/ForgetShow');?>" target="_blank">Forgot password?</a></i></li>
							<li class="clearfix pr"><input value="Log in" name="dosubmit" id="dosubmit" type="submit" class="webtn" style="width:150px">

								
								</li>
						</ul>
						<input type="hidden" name="forward" class="forward" value=""/>
					<!--	<script language='javascript'>
							var currentUrl = this.location.href;
							$(".forward").val(currentUrl);
						</script>-->
					</div>
				</form>

			</div>
		</div>
	</div>
	<div class="zcf none">
		<div class="closed"></div>
		<ul class="tabbtn clearfix">
			<li class="dl logina">Log in</li>
			<li class="current zcy">Registered</li>
		</ul>
		<div class="tabcon">
			<div class="sublist">
				<div class="zcform">
					<form method="post" action="<?php echo U('Public/register');?>"  id="down_form" name="myform" >
						<ul>
							<li class="clearfix pr"><input type="text" name="username" id="username" class="webtxt" placeholder="Enter your user name"><span id="usernameTip" class="onShow"></span></li>
							<li class="clearfix pr"><input type="password" name="password" id="password" class="webtxt" placeholder="Password"><span id="passwordTip" class="onShow"></span></li>
							<li class="clearfix pr"><input type="password" name="pwdconfirm" id="pwdconfirm" class="webtxt" placeholder="Enter the password again"><span id="pwdconfirmTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="text" id="email" name="email" class="webtxt" placeholder="Enter email"><span id="emailTip" class="onShow"></span><span><a href="javascript:void(0);"  id="btnsd1" onclick=""/>Send email verification</a></span> </li>							
							<li class="clearfix pr"><input type="checkbox" name='protocol' id="protocol" checked="checked"><label for="protocol"><a href="#l" target="_blank" >Read and agree to the "User Service Agreement"</a></label><span id="protocoltip" class="onShow"></span></li>
							<li class="clearfix pr"><input type="submit"  value="Registered" class="webtn" style="width:150px">
							</li>
						</ul>
						<input type="hidden" name="forward" class="forward" value=""/>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">



        //Mouse in
        function videoPlayback(){
            //Get video tags
			var e = window.event ;
			var obj = e.srcElement ;
              obj.play();
         }
         
        //Mouse away
         function videoStopped(){
             //Get video tags			
			var a = window.event ;
			var obj = a.srcElement ;
             //Stop play
			obj.pause();
			obj.currentTime=0;   //Go back to the beginning when you stop broadcasting
         }
   

btnsd1.onclick = function() { 

  var oInpa = document.getElementById("email").value;

if(oInpa==""){
alert("Email not entered..");
}else{
alert("Email verification has been sent, please check..");


//$('#imgbt').attr('style','display:block')	;	

$.getJSON('/index.php/Ajax/Renzhengemil?emil='+ oInpa,function (data) {
 if(data.status==1){
  layer.msg(data.msg,{time:1000});
  }else{
   layer.msg(data.msg,{time:1000})
   }
  });


}





		
}

</script>



<script language='javascript'>


    head.ready('formvalidator',function(){
        var SiteUrl = $('#SiteUrl').val();

        head.load('__JS__/checkform_loginout.js');

        $(".forward").val(SiteUrl);

    });
    function Oauth(i)
    {
        var url="";

        $(".logintk").hide();
        $(".graybg").hide();

        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: 0.5,
            area: ['55%', '65%'],
            content: url, //iframe的url
            end:function(){
                window.location.reload();

            }
        });


    }

</script>
<!--back to the top-->
<script type="text/javascript">
	head.ready('jquery',function(){
		$(".gotop").click(function(event){
			$('html,body').animate({scrollTop:0},500);return false;});
		$(window).scroll(function () {
			if($(window).scrollTop()>=100) {
				$(".gotop").fadeIn();
			}else {
				$(".gotop").fadeOut();
			}
		});});
</script>
<!--Product download-->
<script type="text/javascript">
	//download
	$(".download").click(function(){
       var opus_id = $("#down_id").val();

		$.getJSON("/index.php/Ajax/download?opus_id="+opus_id+"&t="+ $.now(),function(data){
			if(data.status==1){
			  /*  layer.msg('sdfsd',{icon:4});*/
				layer.confirm(data.msg, {
					btn: ["download","cancel"],
					title:"Material download confirmation",
					icon: 4
				},function () {
					 $.getJSON("/index.php/Ajax/pay?opus_id="+opus_id+"&t="+ $.now(),function (data) {
						 var url =data.down_url;
						 var sta = data.status;
						 if(sta=='2'){
                             layer.confirm('Download link：'+"<a href="+data.url+" target='_blank'>"+data.url+"</a><br>password："+data.pass, {
                                 btn: ["determine"],
                                 icon: 1
                             });
						 }else{
                             layer.confirm(data.msg, {
                                 btn: ["Download"],
                                 icon: 1
                             }, function(){
                                 down(url);
                                 layer.msg('Download completed');
                             });
						 }

					  });
					}
				);
			}
			/*Prompt information*/
			else if(data.status==-1){
				layer.msg(data.msg,{icon: 2,time: 1000});
			}
			/*Not logged in*/
			else if(data.status==0){
				$(".graybg").show();
				layer.msg(data.msg,{icon: 2,time: 1000},function () {
					$(".logintk").show();
					$(".loginf").show();
					$(".zcf").hide();
				});
			}
			else if(data.status==2){
                var url =data.down_url;
                layer.confirm("click to download",{
                    btn: ["download"],
                    icon: 1,
                    title:data.msg
                },function () {
                    down(url);
                    layer.msg('Download completed',{time:2000});

                });

            }
            else if(data.status==3){
                var url =data.url;
                var pass = data.pass;
                layer.confirm('Download link：'+"<a href="+url+" target='_blank'>"+url+"</a><br>Password："+pass, {
                    btn: ["determine"],
                    icon: 1,
					title:data.msg
                });

            }
		});
	});
function down(url){
	location.href = url;
}
</script>
<script type="text/javascript">
	var times = 120;
	var isinerval;
	function CountDown(classid) {
		if (--times < 1) {
			$(classid).val("Send the verification code").attr("disabled", false).css({'background-color':'#1abd9b'});
			clearInterval(isinerval);
			return;
		}
		$(classid).val(" Resend after "+times+" seconds");

	}
	$(function(){
		layer.config({
			extend: 'extend/layer.ext.js'
		});
		$(".sendsms").click(function(){
			$.post("index.php?m=sms&c=index&a=sendsms&t="+ $.now(),{type:15},function(data){
				data=filtescript(data);
				if(data.status==1){
					layer.msg("Verification code sent",{icon: 1,time: 2000},function(){
						times=120;
						$(".sendsms").attr("disabled", true).css({'background-color':'#A9A9A9'});
						isinerval = setInterval("CountDown('.sendsms')", 1000);
					});
				}else{
					layer.msg(data.msg,{icon: 2,time: 2000});
				}
			});
		});

	});

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
		$(".scrollpic").each(function(){
			scrollpic($(this));

		});
	});

	function filtescript(data){
		var result=data.replace(/<script.*?>.*?<\/script>/ig, '');
		return JSON.parse(result);
	}

</script>
<div class="graybg"></div>
<!--Login form verification-->
<script type="text/javascript">
	function save_username(form) {
		if(form.log_username.value==''){
			$("#utip").attr("class","onError").html("Username or email cannot be empty");
			form.log_username.focus();
			return false;
		}
		if(form.log_password.value==''){
			$("#ptip").html("password can not be blank").attr("class","onError");
			form.log_password.focus();
			return false;
		}
	}
</script>
<!--The login interface pops up-->
<script type="text/javascript">
	$(".logina").click(function(){
		$(".logintk").slideDown();
		$(".graybg").fadeIn();
		$(".loginf").show();
		$(".zcf").hide();
	});
	$(".zcy").click(function(){
		$(".logintk").slideDown();
		$(".graybg").fadeIn();
		$(".loginf").hide();
		$(".zcf").show();
	});
	$(".graybg,.closed").click(function(){
		$(".logintk").slideUp();
		$(".graybg").fadeOut();
	});
</script>
<!--Login status-->
<script type="text/javascript">
	head.ready('jquery',function(){

		var SiteUrl = $('#SiteUrl').val();

		$("#logout").attr('href', "/index.php/public/login_out");


		$.ajax({
			type: "get",
			async: true,
			url: "/index.php/public/getlogininfo",
			dataType: "json",
			data: '',

			success: function(msg) {

				var d = new Date();
				var t = d.getHours();
				var welcome = "";
				// var img_url="http://avatar.bihu20.com/";
				if (msg.islogin) {

					$('.is_login').hide();
					$('.islogin').show();

			}},
			error: function(msg) {
				////alert(msg.status);
				//alert("ajax security settings error\n\n Internet options->Safety->Custom level->Select "Access data source through domain" to enable. Restart the browser after saving");
			}
		});
	});
</script>
<!--Registration form verification-->
<script type="text/javascript">
	head.ready('formvalidator',function(){

		$.formValidator.initConfig({autotip:true,formid:"down_form",onerror:function(msg){}});

		$("#username")
				.formValidator({
					onshow:"please enter user name",
					onfocus:"3-20 characters, beginning with a letter, consisting of numbers, letters or underscores"})
				.inputValidator({
					min:3,max:20,onerror:"User name is between 3-20 characters"})
				.regexValidator({regexp:"username",datatype:"enum",onerror:"wrong format"}).ajaxValidator({
			type : "get",
			url :"/index.php/public/check_name",
			data :"",
			datatype : "json",
			async:'false',
			success : function(data){

				if( data.status == 'true') {

					return true;
				} else {
					return false;
				}
			},
			buttons: $("#dosubmit"),
			onerror : "Registration is forbidden or user name already exists",
			onwait : "Verifying"
		});
		$("#password")
				.formValidator({onshow:"Please enter the password",onfocus:"6-20 characters, composed of numbers, letters or underscores"})
				.inputValidator({min:6,max:20,onerror:"Password is between 6-20 characters"})
				.ajaxValidator({
					type : "get",
					url : "/index.php/public/check_pass",
					data :"",
					datatype : "json",
					async:'false',
					success : function(data){

						if( data.status == 'true'  ) {
							return true;
						} else {
							return false;
						}
					},
					buttons: $("#dosubmit"),
					onerror : "There are special characters in the password",
					onwait : "Verifying"
				});
		$("#pwdconfirm")
				.formValidator({onshow:"Please enter a repeat password",onfocus:"Repeat password between 6-20 characters"})
				.inputValidator({min:6,max:20,onerror:"Repeat password between 6-20 characters"})
				.compareValidator({desid:"password",operateor:"=",onerror:"Passwords are not the same"});
		$("#email")
				.formValidator({onshow:"please input your email",onfocus:"please input your email"})
				.regexValidator({regexp:"email",datatype:"enum",onerror:"E-mail format is incorrect"})
				.ajaxValidator({
					type : "get",
					url : "/index.php/public/check_email",
					data :"",
					datatype : "json",
					async:'false',
					success : function(data){

						if( data.status == 'true' ) {
							return true;
						} else {
							return false;
						}
					},
					buttons: $("#dosubmit"),
					onerror : "Registration is forbidden or the mailbox already exists",
					onwait : "Verifying"
				});
		$("#code").formValidator({onshow:" 2131231",onfocus:" ",onerror:" "}).regexValidator({regexp:"code",datatype:"enum",onerror:"Verification code error"}).functionValidator({
			fun: function (val) {

				if ($(".gt_ajax_tip").hasClass("gt_success")) {

					$("#codeTip").hide();
					return true;

				}
				$(".gt_ajax_tip").addClass("gt_fail");
				return false;
			},
			onerror:" "

		});
		$(":checkbox[name='protocol']").formValidator({tipid:"protocoltip",onshow:" ",onfocus:" "}).inputValidator({min:1,onerror:"{L('Please check and agree')}"});




	});

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".tipstool").poshytip({className: "tips-black",showTimeout: 1,alignTo: "target",alignX: "center",offsetY: 5,allowTipHover: false});

		/*$('.flexslider').flexslider({
			directionNav: true,
			pauseOnAction: false,
			pauseOnHover:true,
			animationLoop: true
		});*/
         /*关闭窗口*/
		$(".fkmains .closed").click(function(){
			$(".graybg").fadeOut();
			$(".fkmains").hide("fast")
		});
		 /*支付平台*/
		$(".zftle a").click(function(){
			$(".zftle a").removeClass("on");
			$(this).addClass("on");
			if($(this).attr("data-online")=="1"){
				$("input[name=pay_type]").val($(".zfstyle .on").attr("data-value"));
				$(".zf1style").addClass("none");
				$(".zfstyle").removeClass("none");
			}else{
				$("input[name=pay_type]").val("30");
				$(".zf1style").removeClass("none");
				$(".zfstyle").addClass("none");
			}
		});
		$(".fkmains .contm .zfstyle li,.fkmains .contm .tcul li").click(function(){
			$(this).addClass("on").append('<div class="icon"><img src="http://ss.ppt20.com/images/ppdt/tureico.png"></div>').siblings().removeClass("on").children('.icon').remove();
			$(this).parent().find("input").val($(this).attr("data-value"));
			//alert($(this).parent().attr('class'));
			if($(this).parent().attr('class')=="tcul clearfix"){
				$("#amount").html($(this).attr("data-value"));
			}
		});
	});
	/*提交表单*/
	function dosubmit(){
		$(".graybg").fadeOut();
		$(".fkmains").hide("fast");
		$("#pay_form").submit();
		layer.confirm("Please complete the payment on the payment page。", {
			btn: ["I have paid","Problem with payment"],
			icon: 7,
			title:"Account recharge waiting for payment"
		}, function(){
			window.location.reload();
			layer.close();
		}, function(){
			window.open("/index.php?m=pay&c=deposit");
			layer.close();
		});

	}

</script>


<div class="rightcolumn">
    <ul>
        <li class="li1"><a href="<?php echo U('Service/index');?>" target="_blank"><em></em><i>View</i></a></li>
        <li class="li2">
            <a href="javascript:;"><em></em><i>Advisor</i></a>
            <div class="zxmain" style="display: none;">
                <i class="arrowrg"></i>
                <dl>
                    <dd>support hotline:<br><i><?php echo ($Contact_phone); ?></i></dd>
                    <dd><span>
					<a id="QQ_con" href="javascript:void(0);"><img border="0" alt="" title="Customer service" align="absmiddle"></a></span></dd>
                    <dd>operating hours:<br></dd>
                    <dd><?php echo ($Work_time); ?></dd>
                </dl>
            </div>
        </li>


    </ul>
    <div class="gotop noneBack to top
        <a href="javascript:;" title="Back to top"><em>Back to top</em></a>
    </div>
</div>

<!--<div class="chatrob">
    <a href="#" target="blank"><img src="" style="border:none;"></a>
</div>-->


</body>
</html>