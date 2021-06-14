<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <title>Personal Management Center</title>
    <script language="javascript" type="text/javascript" src="__JS__/jquery.min.js"></script>
    <script src="__JS__/layer.js" type="text/javascript"></script>

    <link href="__CS__/user.css" rel="stylesheet" type="text/css">
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
	
	
    <script src="__JS__/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="__JS__/jquery.1.9.1.min.js"></script>
    <script src="__JS__/jquery.placeholder.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="__JS__/ajaxfileupload.js" charset="UTF-8"></script>
    <script src="__JS__/tips.js" type="text/javascript"></script>
    <script type="text/javascript" src="__JS__/user.js"></script>
    <script type="text/javascript" src="__JS__/jquery.wluarmx.js"></script>
    <script src="__JS__/html5shiv.js"></script>
    <script src="__JS__/respond.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            layer.config({
                extend: 'extend/layer.ext.js'

            });
        })
    </script>
<?php
?>
</head>

<body bgcolor="#f6f9fc" class="pr">
    <div class="header normaltop">
    <div class="wrap clearfix">
        <div class="logo fl"><a href="<?php echo U('Index/index');?>"><img src="<?php echo ($logo["ad_pic"]); ?>"></a></div>
        <div class="nav fl"></div>
        <div class="subnav fl clearfix"><i><a href="<?php echo U('Index/index');?>" >Home page</a></i>
            <div class="downnav fl"> <em><a href="javascript:;">Classification</a></em>
                <div class="fixedw">
                    <div class="plfs">
                    <div class="plf">
                    <ul>
                        <?php if(is_array($Cates)): $i = 0; $__LIST__ = $Cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
                             <?php if($_COOKIE['cid'] == $list['cid']): ?><a href="<?php echo U('Model/index',array('cid'=>$list['cid']));?>" class="active" target="_blank"><?php echo ($list["name"]); ?></a>
                                <?php else: ?>
                                 <a href="<?php echo U('Model/index',array('cid'=>$list['cid']));?>"  target="_blank"><?php echo ($list["name"]); ?></a><?php endif; ?>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                </div>
                </div>
            </div>
        </div>
        <div class="navbarauser fr">

<span class="fr"><div class="login">
    <a href="javascript:void(0);" class="logina">Log in</a> <a href="javascript:void(0);" class="zcy">Registered</a>
</div>

<div class="logout">

    <div class="hduserinfo">
	       &nbsp;<a href="<?php echo U('Service/materialupload', array('pid'=>1));?>">Upload</a>&nbsp;
	<a href="javascript:void(0);" onclick="qiandao()">Sign in</a>
        <img id="img_in" class="logout1" src="__IMG__/useravatar.png" onerror="this.src='__IMG__/useravatar.png'" />
        <a href="<?php echo U('Service/index');?>" target="_blank"><i class="myName"></i></a>
    </div>
    <dl id="userinfo">
        <dd> <a href="<?php echo U('Service/index');?>" target="_blank">Personal center</a></dd>
		
	        <dd> <a href="<?php echo U('Service/main');?>" target="_blank">Member centre</a></dd>	
		
		
        <dd><a href="<?php echo U('Service/index');?>" onclick="chanPage('StationMsg')" target="_blank">Inbox(<?php echo ($new_chat); ?>)</a></dd>
        <dd><a href="#" id="logout">Sign out</a></dd>
    </dl>
</div>

    <script type="text/javascript">
                   function chanPage(action){
                document.cookie="action="+action+";path=/";
                document.cookie="action_status=1;path=/";


            }


    </script>
<input type="hidden" value="<?php echo ($SiteUrl); ?>" id="SiteUrl"/>
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

            if (msg.islogin) {

                $('.login').hide();
                $('#amount').html(msg.amount);
                if (msg.avar) {
                    $("#img_in").attr('src',msg.avar);
                }
                if (t >= 7 && t < 12) {
                    welcome += "Good morning，"
                } else if (t >= 12 && t <= 13) {
                    welcome += "Good afternoon，"
                } else if (t > 13 && t <= 17) {
                    welcome += "Good afternoon，"
                } else {
                    welcome += "Good evening，"
                }
               // $('.myName').html(welcome + msg.nickname);
			   $('.myName').html( msg.nickname);
                $('.login').hide();
                $('.logout').show();
            } else {

                $('.login').show();
                $('.logout').hide();
            }
        },
        error: function(msg) {

        }
    });
        $(".logout").hover(function() {
            $("#userinfo").show();
        }, function() {
            $("#userinfo").hide();
        });


    });
</script>
<!--Inquire-->
<script type="text/javascript">
        head.ready('jquery',function() {
            var SiteUrl = $('#SiteUrl').val();


            $(".search").keydown(function(e) {
                // Enter key event

                if(e.which == 13) {

                    go_search($(this).val());
                }
            });

            function go_search(q){

                if(q==''){
                    //alert('Keyword cannot be empty！');
                    $(".search").focus();
                    return false;
                }

                q=stripscript(q);

               window.location.href = "/index.php/search/index?search="+q;
           }
            function stripscript(s) {
                var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？%]")
                var rs = "";
                for (var i = 0; i < s.length; i++) {
                    rs = rs + s.substr(i, 1).replace(pattern, '');
                }
                return rs;
            }

});


	
		/* Sign in*/
		
	        function qiandao() {
			
            $.getJSON('/index.php/Ajax/qiandao', '', function (data) {
                if (data.status == '0') {
                    layer.msg(data.msg, {
                        icon: 4,
                        time: 5000 //2 seconds to close (if not configured, the default is 3 seconds)
                    })
                }
                else if (data.status == '2') {
                    $("#tall").val(data.tall);
                    $("#low").val(data.low);

				      layer.msg(data.msg, {
                        icon: 4,
                        time: 5000 //2 seconds to close (if not configured, the default is 3 seconds)
                   })
               }


            })
        }
			
		
		



    </script>
</span>

       <div class="formgroup fr clearfix">
                <input class="webtxt search"  placeholder="Press enter to search" name='search' data-name="original-font-color"  type="search">
                <input type="button" class="webtns" value=" " />
       </div>

        </div>
    </div>
</div>


	
	<div class="header1 normaltop1"">

    <div class="wrap clearfix">

		
		
		<div class="notification-bar">
		<p>
		<?php if($msg == 0): ?><a href="javascript:void(0);" data-value="StationMsg" class="chanView detail list-style-blue"> You have&nbsp;0&nbsp;Unread messages &nbsp;(&nbsp;Always pay attention to official reminders and deal with information prompts immediately...&nbsp;)</a><span class="shut" action-type="shut" action-data="nid=0&amp;name=message"></span>
		<?php else: ?>



	<a href="javascript:void(0);" data-value="StationMsg" class="chanView detail list-style-blue">
		You have<?php echo ($msg); ?>unread message(<?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input name="title" type="text" style="border:none; line-height:35px; background:#fff; color: #555; cursor:pointer" size="50" value="<?php echo ($vo["chat_content"]); ?>" maxlength="15"  onkeyup="javascript:setShowLength(this, 15, 'cost_tpl_title_length');"  disabled /><?php endforeach; endif; else: echo "" ;endif; ?>...)
	</a>	
	<span class="shut" action-type="shut" action-data="nid=0&amp;name=message"></span><?php endif; ?>
		</p>
		</div>
        
		
		<div class="subnav fl clearfix">
		
		<i onmouseover="display()"  onmouseout="disappear()" ><a style="color:red;" href="<?php echo U('Service/index');?>" class="active">User Centre</a></i>
        <i onmouseover="display()"  onmouseout="disappear()" ><a href="javascript:void(0);" class="chanView" data-value="Down_Upload">Download record</a></i>
		<i onmouseover="display()"  onmouseout="disappear()" ><a href="javascript:void(0);" class="chanView" data-value="CollectFocus">Favorites</a></i>
		<i onmouseover="display()"  onmouseout="disappear()" ><a href="javascript:void(0);" class="chanView" data-value="ModifyData">Account modification</a></i>
       <i onmouseover="display()"  onmouseout="disappear()" ><a href="javascript:void(0);" class="chanView" data-value="StationMsg">Personal message</a></i>
	   




        </div>
		
		
	
		

		
		
		

    </div>


<script type="text/javascript" language="javascript">


		function display() {

		//	$(".box").css('display', 'block');
          // popup($("#box8"));

		//	$(".box").css('display', 'block');
    document.getElementById('box8').style.display='block' ;

		}
		
		
		function disappear() {
			$(".box8").css('display', 'none');

		}
		
	
		
		
</script>		



<script>
	var oDiv = document.getElementById('css'); //Get this div element
	oDiv.style.background-image = '';   //Set its background to empty, so there is no background image
</script>





    <!--Left menu tab-->
    <script type="text/javascript">
        $(document).ready(function () {
            var SiteUrl = $('#SiteUrl').val();
            $('.ltnav li').click(function () {
                var i = $(this).index() + 2;
                $('.home a').attr('class', '');
                $(this).attr('style', 'border-left:-300px solid #59ba39;')
                    .children("i").children("a")
                    .attr('style', 'color:#6bc85c;background:url(' + SiteUrl + '/Public/images/ltnavico' + i + 'h.png) no-repeat 36px center;')
                    .parent().parent().siblings()
                    .attr('style', '')
                    .children("i").children("a").attr('style', '')

            })
        })

    </script>
    <!--Asynchronous call-->
    <script type="text/javascript">
        $(document).ready(function () {
            var action_show = $("#action").val();
            if (action_show != '') {
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/index.php/Service/Ajax?action=" + action_show + "&b=" + Math.random(),
                    dataType: "html",
                    data: '',
                    cache: false,

                    success: function (msg) {

                        var show = $('.rtcnt');
                        show.text('');
                        show.prepend(msg)
                    },
                    error: function (msg) {
                        ////alert(msg.status)
                    }
                })
            }
            //var SiteUrl = $('#SiteUrl').val();

            $('.chanView').click(function () {

                var action = $(this).attr('data-value');

                

                $.ajax({
                    type: "get",
                    async: true,
                    url: "/index.php/Service/"+action+"?action=" + action + "&b=" + Math.random(),
                    dataType: "html",
                    data: '',
                    cache: false,

                    success: function (msg) {

                        var show = $('.rtcnt');
                        show.text('');
                        show.prepend(msg)
                    },
                    error: function (msg) {
                        ////alert(msg.status)
                    }
                })
            });
        })

    </script>











    <div class="clearfix">
        <input type="hidden" id="action" value="<?php echo ($action); ?>">
    </div>
    <div class="pcimain clearfix wrap ">
	

		
		
        <div class="rtcnt fr">

            <div class="part1 clearfix">
                <div class="cont fl">
				
				
				
                    <div class="zprt1">
					
					
					
                        <div class="clearfix">
						

						
						
                            <div class="pic"><img id='service_img' src="<?php echo ($user_pic); ?>"
                                    onerror="this.src='__IMG__/useravatar.png'"></div>
                            <div class="cont">                            
                          <div class="name "><i>&nbsp;&nbsp;&nbsp;HI!&nbsp; <a href="javascript:;"
                                            class="tipstool defaultcolor updatenickname"
                                            title="Click to modify nickname"><?php echo ($nickname); ?></a><!--（username：<?php echo ($user_name); ?>）--></i>


	
                                            <li><span style="font-size:15px">&nbsp;&nbsp;<?php echo ($gold_coins); ?>&nbsp;gold coins&nbsp;&nbsp;<a href="javascript:void(0);" onclick="qiandao()">Sign in</a></span></li>
										
											
											</div>
                               




								

							   <div class="info">
							   <span class="welcome">Good afternoon</span>

                                </div>
								
								
								
								
								
                            </div>
                        </div>

		
										
										
										
										
                    </div>

					
					
					
					
					
					
					
                </div>
				
		
				
				
				
            </div>

        </div>
		
		
		
		
		
		
		
		

    </div>
	
	
     
<div class="footer">
    <div class="ftnemu">
        <div class="wrap clearfix">
            <div class="navmain clearfix fl">
                <dl>
                    <dt><img src="__IMG__/ftico1.png">About Us</dt>
                    <dd><a href="<?php echo U('Single/aboutUS',array('show'=>'0'));?>" target="_blank">Website Introduction</a></dd>

                    <dd><a href="<?php echo U('Single/aboutUS',array('show'=>'1'));?>" target="_blank">Contact us</a></dd>
                </dl>
                <dl>
                    <dt><img src="__IMG__/ftico3.png">I am a member</dt>
                    <dd><a href="<?php echo U('Service/index');?>" onclick="chan_Page('ToBeSeller')" target="_blank">Become member</a></dd>

                    <dd><a href="<?php echo U('Service/materialupload', array('pid'=>1));?>" onclick="chan_Page('MaterialUpload')" target="_blank">Upload material</a></dd>
                </dl>
			</div>
            <div class="ftel fr">
                <b><?php echo ($Contact_phone); ?></b><i><?php echo ($Work_time); ?></i><a id="QQ_cha" title="Customer Service" href="javascript:void(0)">Customer Service</a>
            </div>
        </div>
    </div>
    <input type="hidden" id="qq_ch" value="<?php echo ($Contact_QQ); ?>">
    <script type="text/javascript">
        head.ready('jquery',function () {
            $('#QQ_cha').click(function () {
                var qq = $('#qq_ch').val();
                layer.confirm(qq,
                        {title:'Contact QQ &nbsp;:',btn:['Shut down']}
                )
            })
        })

    </script>
     <script type="text/javascript">
        function chan_Page(action){
            document.cookie="action="+action+";path=/";
            document.cookie="action_status=1;path=/";
         }
    </script>
    <div class="copyright" style="height: 30px;">
        <div class="wrap" >
            <p><a href="#" target="_blank"><strong><?php echo ($title); ?>&nbsp;&nbsp;<!--<?php echo ($key_show); ?>--></strong></a></p>
               <p>  record number：<?php echo ($icp); ?></p>


        </div>
    </div>
</div>
<link  href="__CS__/loginout.css" rel="stylesheet"  type="text/css">

<style>
    .gt_holder.popup .gt_mask {background-color:#000;  opacity: 0.2;z-index: 99999;}
</style>

<div class="logintk aoaoanim aoaolayer" >
    <div class="loginf">
        <div class="closed"></div>
        <ul class="tabbtn clearfix">
            <li class="current">Log in</li>
            <li class="cz">Registered</li>
        </ul>
        <div class="tabcon">
            <div class="sublist clearfix">
                <form action="<?php echo U('Public/login');?>" method="post" onsubmit="return save_username(this)">
                    <div class="zcform fl">
                        <ul>
                            <li class="clearfix pr"><input type="text" class="webtxt" name='username' id="log_username" placeholder="username or email address"><span id="utip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="password" class="webtxt" name='password' id="log_password" placeholder="Password"><span id="ptip" class="onShow"></span></li>

                            <li class="clearfix pr"><input type="checkbox"  name="cookie_time" id="cookietime" checked>
                                <label for="chd">Remember me</label><i class="forget"><a href="<?php echo U('Public/ForgetShow');?>" target="_blank">Forgot password?</a></i></li>
                            <li class="clearfix pr"><input value="Log in" name="dosubmit" id="dosubmit" type="submit" class="webtn" style="width:150px">
							
									
									</li>
                      </ul>

                        <input type="hidden" name="forward"  class="forward" value="" />


                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="zcf none">
        <div class="closed"></div>
        <ul class="tabbtn clearfix">
            <li class="dl">Log in</li>
            <li class="current">Registered</li>
        </ul>
        <div class="tabcon">
            <div class="sublist">
                <div class="zcform">
                    <form method="post" action="<?php echo U('Public/register');?>"  id="myform" name="myform" >
                        <ul>
                            <li class="clearfix pr"><input type="text" id="username" name="username" class="webtxt" placeholder="Enter your user name"><span id="usernameTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="password" id="password" name="password" class="webtxt" placeholder="Password"><span id="passwordTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="password" id="pwdconfirm" name="pwdconfirm" class="webtxt" placeholder="Enter the password again"><span id="pwdconfirmTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="text" id="email" name="email" class="webtxt" placeholder="Enter email"><span id="emailTip" class="onShow"></span><span><a href="javascript:void(0);"  id="btnsd1" onclick=""/>Send email verification</a></span> </li>
                            <li class="clearfix pr"><input type="text" id="emailword" name="emailword" class="webtxt" placeholder="Enter confirmation code"><span id="emailwordTip" class="onShow"></span></li>

                            <li class="clearfix pr"><input type="checkbox" id="protocol" checked="checked"><label for="protocol"><a href="<?php echo U('Single/agreement');?>" target="_blank" >Read and agree to the "User Service Agreement"</a></label><span id="protocoltip" class="onShow"></span></li>

                            <li class="clearfix pr">
                                <input type="submit"  value="registered" class="webtn" style="width:150px">

								</li>
                        </ul>
                        <input type="hidden" name="forward"  class="forward" value=""/>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<script language='javascript'>



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

    head.ready('formvalidator',function(){
        var SiteUrl = $('#SiteUrl').val();

        head.load('__JS__/checkform_loginout.js');

        $(".forward").val(SiteUrl);

    });

</script>



    <!--withdraw-->
    <script type="text/javascript">
        function withdrawal() {
            $.getJSON('/index.php/Ajax/withdrawal', '', function (data) {
                if (data.status == '0') {
                    layer.msg(data.msg, {
                        icon: 4,
                        time: 3000 //2 seconds to close (if not configured, the default is 3 seconds)
                    })
                }
                else if (data.status == '2') {
                    $("#tall").val(data.tall);
                    $("#low").val(data.low);
                    $("#coin").val(data.coin);
                    layer.open({
                        type: 1,
                        title: 'Apply for withdrawal',
                        content: $('#tixian'),
                        area: ['500px', '345px']
                    });
                }


            })
        }
		
		
		
        /* submit*/
        function tijiao() {

            var cash = $("#cash").val();
            var account = $("#account").val();

            var account_bank = $("#account_bank").val();
            var account_name = $("#account_name").val();


            if (cash == '' || account == '' || account_name == '' || account_bank == '') {
                layer.msg('Please enter complete！', { icon: 5 })
            } else {

                layer.closeAll();
                $.getJSON('/index.php/Ajax/do_withdrawal?cash=' + cash + '&acc=' + account + '&bank=' + account_bank + "&name=" + account_name, function (data) {
                    if (data.status == '0') {
                        layer.msg(data.msg, { icon: 5 })
                    } else if (data.status == '1') {
                        layer.msg(data.msg, { icon: 1 });

                    }
                });

            }



        }
        /* cancel*/
        function quxiao() {
            layer.closeAll();
        }
        /* Amount*/
        function panduan_cash() {
            $('#tijiao').attr('onclick', '');
            var cash = $("#cash").val();
            var coin = $("#coin").val();
            var tall = $("#tall").val();
            var low = $("#low").val();
            var account = $("#account").val();


            var tip_1 = $("#tip_1").val('0');
            var tip_2 = $("#tip_2").val();
            if (account) {
                tip_2 = 1;
            }
            if (!isNaN(cash)) {
                if (cash - coin > 0) {
                    layer.msg('Insufficient balance！', { icon: 7 });
                } else {
                    if (cash - low >= 0) {
                        if (cash - tall <= 0) {
                            tip_1 = '1';
                            $("#tip_1").val('1');
                            var sum = parseInt(tip_1) + parseInt(tip_2);
                            if (sum == 2) {
                                $('#tijiao').attr('onclick', 'tijiao()')
                            }

                        } else {
                            layer.msg('The maximum limit is' + tall + "￥", { icon: 7 });
                        }
                    } else {
                        layer.msg('The minimum limit is' + low + "￥", { icon: 7 });
                    }
                }
            } else {
                layer.msg('Please key in numbers！', { icon: 5 })
            }
        }
        /*Account*/
        function panduan_acc() {
            var account = $("#account").val();
            var tip_1 = $("#tip_1").val();
            var tip_2 = $("#tip_2").val('0');

            $('#tijiao').attr('onclick', '');

            if (!isNaN(account)) {
                tip_2 = '1';
                $("#tip_2").val('1');
                var sum = parseInt(tip_1) + parseInt(tip_2);
                if (sum == 2) {

                    $('#tijiao').attr('onclick', 'tijiao()')
                }
            } else {
                layer.msg('Please key in numbers！', { icon: 5 })
            }
        }
		
		
		
		
		/* Sign in*/
		
	        function qiandao() {
			
            $.getJSON('/index.php/Ajax/qiandao', '', function (data) {
                if (data.status == '0') {
                    layer.msg(data.msg, {
                        icon: 4,
                        time: 5000 //2 seconds to close (if not configured, the default is 3 seconds)
                    })
                }
                else if (data.status == '2') {
                    $("#tall").val(data.tall);
                    $("#low").val(data.low);

				      layer.msg(data.msg, {
                        icon: 4,
                        time: 5000 //2 seconds to close (if not configured, the default is 3 seconds)
                   })
               }


            })
        }
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    </script>
    <!--change username-->
    <script type="text/javascript">
        $(document).ready(function () {

            $(".smlb").wmx({ width: "248", height: "341", interval: 4500, selected: "seleted", deriction: "left" });
            $(".updatenickname").click(function () {
                var nickname = $(this).text();
                layer.prompt({
                    title: 'Modify user nickname',
                    formType: 0,
                    value: nickname,
                    info: 'Note: The nickname is between 2-20 characters (no special characters are allowed)'
                }, function (value) {

                    $.post('/index.php/Ajax/ModifyNick?t=' + Math.random(), { nickname: value }, function (data) {

                        if (data.status == 1) {
                            layer.msg(data.msg, { time: 1000 }, function () {
                                $(".updatenickname").html(value);
                            });
                        }
                        else {
                            layer.msg(data.msg, { time: 2000 }, function () {
                                $(".updatenickname").click();
                            });

                        }
                    }, 'json');
                });
            });
        });

    </script>
    <!--Left menu tab-->
    <script type="text/javascript">
        $(document).ready(function () {
            var SiteUrl = $('#SiteUrl').val();
            $('.ltnav li').click(function () {
                var i = $(this).index() + 2;
                $('.home a').attr('class', '');
                $(this).attr('style', 'border-left:-300px solid #59ba39;')
                    .children("i").children("a")
                    .attr('style', 'color:#6bc85c;background:url(' + SiteUrl + '/Public/images/ltnavico' + i + 'h.png) no-repeat 36px center;')
                    .parent().parent().siblings()
                    .attr('style', '')
                    .children("i").children("a").attr('style', '')

            })
        })

    </script>
    <!--Asynchronous call-->
    <script type="text/javascript">
        $(document).ready(function () {
            var action_show = $("#action").val();
            if (action_show != '') {
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/index.php/Service/Ajax?action=" + action_show + "&b=" + Math.random(),
                    dataType: "html",
                    data: '',
                    cache: false,

                    success: function (msg) {

                        var show = $('.rtcnt');
                        show.text('');
                        show.prepend(msg)
                    },
                    error: function (msg) {
                        ////alert(msg.status)
                    }
                })
            }
            //var SiteUrl = $('#SiteUrl').val();

            $('.chanView').click(function () {

                var action = $(this).attr('data-value');

                

                $.ajax({
                    type: "get",
                    async: true,
                    url: "/index.php/Service/"+action+"?action=" + action + "&b=" + Math.random(),
                    dataType: "html",
                    data: '',
                    cache: false,

                    success: function (msg) {

                        var show = $('.rtcnt');
                        show.text('');
                        show.prepend(msg)
                    },
                    error: function (msg) {
                        ////alert(msg.status)
                    }
                })
            });
        })

    </script>

    <!--时间问候-->
    <script type="text/javascript">
        $(document).ready(function () {
            var d = new Date();
            var t = d.getHours();
            var welcome = "";

            if (t >= 7 && t < 12) {
                welcome += "Good morning!"
            } else if (t >= 12 && t <= 13) {
                welcome += "Good afternoon!"
            } else if (t > 13 && t <= 17) {
                welcome += "Good afternoon!"
            } else {
                welcome += "Good evening!"
            }
            $('.welcome').html(welcome);
        })


    </script>
    <div id="tixian" style="display: none">
        <div>
            <br>
            <input type="hidden" id="tip_1" value='0'>
            <input type="hidden" id="tip_2" value='0'>
            &nbsp; &nbsp; &nbsp;Minimum withdrawal：<input type="text" id="low" style="height: 20px;width: 60px"
                disabled>￥&nbsp;Maximum withdrawal：<input type="text" id="tall" style="height: 20px;width: 60px" disabled>￥
            &nbsp;Account Balance：<input type="text" id='coin' style="height: 20px;width: 90px" disabled>￥<br><br>
            &nbsp; &nbsp; &nbsp;Withdrawal Amount：<input type="text" id="cash" style="height: 20px;width: 60px"
                onchange="panduan_cash()">￥<br><br>
            &nbsp; &nbsp; &nbsp;Account Bank：&nbsp; <input type="text" value="<?php echo ($acc_info["acct_name"]); ?>" id="account_bank"
                style="height: 20px;width: 150px"><br><br>

            &nbsp; &nbsp; &nbsp;Account name： &nbsp; &nbsp; <input type="text" value="<?php echo ($acc_info["acct_name"]); ?>" id="account_name"
                style="height: 20px;width: 150px"><br><br>
            &nbsp; &nbsp; &nbsp;account number： &nbsp; &nbsp; <input type="text" value="<?php echo ($acc_info["acct_account"]); ?>" id="account"
                style="height: 20px;width: 150px" onchange="panduan_acc()"><br><br>
            <!--      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<input type="radio" name="method">Wechat&nbsp;-->
            &nbsp; &nbsp; &nbsp;submit application：<a href="javascript:void(0)" id="tijiao" onclick="tijiao()">&nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<span style="font-size: 20px;">submit</span></a> &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp;&nbsp;<a onclick="quxiao()" href="javascript:void (0)">&nbsp;&nbsp; &nbsp;<span
                    style="font-size: 20px;">cancel</span></a>
        </div>

    </div>
</body>
<script>
    try {
        var pageInfoTmp = JSON.parse('{"total":"0","size":10,"currentPage":1,"pageUrl":"https://www.vjshi.com/Buyer/buyrecord?p={page}"}')
        var pageInfo = {
            current: pageInfoTmp.currentPage,
            countPerPage: pageInfoTmp.size,
            totalItem: pageInfoTmp.total,
            url: pageInfoTmp.pageUrl
        }
    } catch (error) {
        var pageInfo = {
            current: 1,
            countPerPage: 1,
            totalItem: 0
        }
    }

</script>
</html>