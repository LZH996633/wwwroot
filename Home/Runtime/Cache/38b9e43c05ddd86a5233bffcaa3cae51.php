<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
     <title><?php echo ($tip_info['name']); ?></title>

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
	
	

</head>

<?php
 ?>














<body>


<h1 id="seodw">LOGO-AE Video Material Download Platform</h1>
<!--Public head-->
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


<div class="clearfix"></div>

<div class="aomainlit wrap">
    <div class="wbmap">
        <a href="<?php echo U('Index/index');?>">Home page</a><i>></i><a href="<?php echo U('Model/index',array('cid'=>$tip_info['cid']));?>"><?php echo ($tip_info["name"]); ?></a>
        <?php if($tip_show): ?>&gt;<i>Filter：</i>
            <?php if(is_array($tip_show)): $i = 0; $__LIST__ = $tip_show;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tips): $mod = ($i % 2 );++$i;?><ins><?php echo ($tips["name"]); ?><a href="<?php echo U('Model/index',array('tip_clear'=>$tips['id']));?>" title="Delete this item"></a></ins>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
            <?php if(isset($_COOKIE['select'])): ?>&gt;<i>Filter：</i>
                <?php if(is_array($tip)): $i = 0; $__LIST__ = $tip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tips): $mod = ($i % 2 );++$i;?><ins><?php echo ($tips["name"]); ?><a href="<?php echo U('Model/index',array('tip_clear'=>$tips['url'],'cid'=>$_COOKIE['cateid']));?>" title="Delete this item"></a></ins>&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; endif; ?>

    </div>
    <div class="listmains" >
        <ul>
        <?php if(is_array($sort)): $i = 0; $__LIST__ = $sort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
			<!--
			<label><?php echo ($list["name"]); ?>：</label>
         -->     
			  <span>
                    <?php if( in_array($list['id'],$sort_show)): ?><a href="<?php echo U('Model/index',array($list['kind']=>$list['id']));?>"  class="active">All</a>
                        <?php else: ?>
                        <a href="<?php echo U('Model/index',array($list['kind']=>$list['id']));?>" >All</a><?php endif; ?>

                        <!--<?php echo U('Model/index',array('cid'=>$cates['cid']));?>-->
						<?php if(is_array($list['son'])): $i = 0; $__LIST__ = $list['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list_son): $mod = ($i % 2 );++$i; if(in_array($list_son['id'],$tip_head_show)): ?><a href="<?php echo U('Model/index',array($list_son['kind']=>$list_son['id']));?>" class="active"><?php echo ($list_son["name"]); ?></a>
                                <?php else: ?>
                                <a href="<?php echo U('Model/index',array($list_son['kind']=>$list_son['id']));?>" ><?php echo ($list_son["name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</span><i>More</i>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>




        </ul>
    </div>
</div>
<div class="indcaselist">
    <input id="i" value="<?php echo ($tip_index); ?>" type="hidden" />

    <script language="JavaScript">


        head.ready('jquery',function(){

            var i = $('input#i').val();

            $('.order a').eq(i).addClass('active')
        })
    </script>
    <div class="wrap order-option">
        <div class="fl order">

          <a href="<?php echo U('Model/index',array('order'=>'recom','index'=>'0'));?>"><span>Recommend</span></a>
                <a href="<?php echo U('Model/index',array('order'=>'opus_updatetime','index'=>'1'));?>">Up to date</a>

            <a href="<?php echo U('Model/index',array('order'=>'down','index'=>'2'));?>">Download</a><ins class="ins"></ins>
            <a href="<?php echo U('Model/index',array('order'=>'price','index'=>'3'));?>">Price</a><ins class="ins1"></ins>
        </div>
        <div class="fr option">
            <div class="sxpart o3">

                <div class="title">Color system<i></i></div>
                <ul class="skmain none pa" style="background-color: gainsboro">
                    <?php if(is_array($sort_color['son'])): $i = 0; $__LIST__ = $sort_color['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$color): $mod = ($i % 2 );++$i;?><li class="" style="background-color:<?php echo ($color["name"]); ?>"><a href="<?php echo U('Model/index',array($color['kind']=>$color['id']));?>" title="<?php echo ($color["name"]); ?>"><?php echo ($color["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
            <div class="sxpart o1">
                <div class="title">Resolution<i></i></div>
                <ul class="namesd pa none" >
                 <?php if(is_array($sort_software['son'])): $i = 0; $__LIST__ = $sort_software['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$software): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Model/index',array($software['kind']=>$software['id']));?>"><?php echo ($software["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
            <div class="sxpart o2">
                <div class="title">Type<i></i></div>
                <ul class="proportion none pa" >
                    <?php if(is_array($sort_type['son'])): $i = 0; $__LIST__ = $sort_type['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Model/index',array($type['kind']=>$type['id']));?>"><?php echo ($type["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
            <div class="sxpart o3">
                <div class="title">Proportion<i></i></div>
                <ul class="proportion none pa">
                    <?php if(is_array($sort_scale['son'])): $i = 0; $__LIST__ = $sort_scale['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$scale): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Model/index',array('scale'=>$scale['id']));?>"><?php echo ($scale["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>

            <?php if($is_half == half): ?><input type="button" value="查看全部" id="zkzq" style="width:100px;height:32px;line-height:32px;color:#1abd9b;background:#f1f1f1;border:none;cursor:pointer"/>   

            <?php else: ?> 

            <input type="button" value="Free zone" id="zkzq" style="width:100px;height:32px;line-height:32px;color:#1abd9b;background:#f1f1f1;border:none;cursor:pointer"/><?php endif; ?>
        </div>
    </div>


    <div class="wrap">
        <div class="cont">
            <div class="clearfix" id="container">

         <?php if(is_array($OpusList)): $i = 0; $__LIST__ = $OpusList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl class="items pr">
                    <a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">

                       
                    <div style="position:relative;">     
						
					<video id="video" poster="<?php echo ($list["opus_pic_big"]); ?>" onmouseover="videoPlayback()" onmouseout="videoStopped()" muted="muted" width="280" height="150" style="width:100%; height=100%;vertical-align:top; object-fit: fill">
                            <source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
                             </video>
						
			
			<div style="position:absolute; z-index:2; left:165px; top:130px;font-size:15px;color:#fff;">

　　　             <?php echo ($list["sjs"]); ?>

　　                   </div>

                              </div>			
						
						<img  class="lazy" src="<?php echo ($list["opus_pic_cons"]); ?>" lazy-src="<?php echo ($list["opus_pic_cons"]); ?>" height=150 style="vertical-align:top" >
						
						
					
                        <div class="upscr"></div>
                        <div class="downscr"></div>
                        </a>
                    <dd style="text-align:center;font-size:16px;"><p><a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank" ><?php echo ($list["opus_title"]); ?></a></p></dd>
                   <!-- <dd><span><ins><img src="__IMG__/indicos1.png"><?php echo ($list["down"]); ?></ins><i><img src="__IMG__/indicos2.png"><?php echo ($list["oext_favorite"]); ?></i><em></em></span></dd> -->
                    <!--Free logo-->
                    <?php if($list['is_half'] == '1'): ?><div style="position:absolute; z-index:2; left:170px; top:3px;font-size:15px;color:#fff;">

                            　　　             free
                            
                            　　                   </div><?php endif; ?>
                    <!--Test display-->
                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
            <div id="pages">
                <?php if($count == 0): ?><h2 style="text-align:center;margin-bottom:40px">No works under this filter</h2>
                    <?php else: ?>
                <a class="a1"><?php echo ($count); ?>pieces</a>

              <?php echo ($page); endif; ?>
            </div>
        </div>

    </div>
</div>



<script type="text/javascript">

 var speed = 10;//Set speed

        //Mouse in
        function videoPlayback() {
            //Get video tags
            var e = window.event;
            var obj = e.srcElement;
            obj.playbackRate = speed;//Change speed
            obj.play();

        }
         
        //Mouse away
        function videoStopped() {
            //Get video tags
            var e = window.event;
            var obj = e.srcElement;
            //Stop play
            obj.pause();
            obj.currentTime = 0;   //Go back to the beginning when you stop broadcasting
        }




</script>








<script>
    head.load("__JS__/ppt.js");
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

<script>
    head.ready('jquery',function(){
        $(".gotop").click(function(event){
            $('html,body').animate({scrollTop:0}, 500);
            return false;
        });
        $(window).scroll(function () {
            if($(window).scrollTop()>=100) {
                $(".gotop").fadeIn();
            }else {
                $(".gotop").fadeOut();
            }
        });
    });
</script>


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


<div class="graybg"></div>

</body>
</html>