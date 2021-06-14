<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html5>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>





    <link rel="stylesheet" type="text/css" href="__CS__/demo/styles/index.css" />
    <link rel="stylesheet" type="text/css" href="__CS__/demo/styles/prism.css" />

    


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
	
	
    <title><?php echo ($OpusDetail["opus_title"]); ?></title>
	
	
	
    <style type="text/css">
 

		

#div1{background: #FFF; color: #000; padding: 83px; font-size: 13px; border-width: 10px; border-radius: 10px; width:850px; display:none; position:absolute;}
#div2{background:#FFF;color: #FFF; border:3px solid #1abd9b; width:850px;display:none; position:absolute;}
















    </style>


</head>

<body>


    <h1 id="seodw">LOGO-AE video material download platform</h1>
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



    <div class="wrap pptdetails">
        <div class="webmap">
            <em><img src="__IMG__/wzbg.gif"></em><a href="<?php echo U('Index/index');?>">Home page</a>><a
                href="<?php echo U('Model/index');?>">Video material</a>><i><?php echo ($OpusDetail['opus_title']); ?></i>
        </div>

        <div id="click1" class="clearfix showinfo">
		

		
		
		
            <div class="leftcnt fl">

            


                <div class="pics">

                    <video style="padding-top: -20px; width:100%; height:405px; object-fit: fill"
                        controlsList="nodownload" oncontextmenu="return false" controls>
                        
                        <source src="<?php echo ($OpusDetail["opus_video"]); ?>" type="video/mp4">
                        <object data="<?php echo ($OpusDetail["opus_video"]); ?>" width="720" height="405">
                        </object>
                    </video>
                    <div class="title">
                        <!-- <h1><?php echo ($OpusDetail["opus_title"]); ?></h1> -->
                        <span><i class="view" id="hits"><?php echo ($OpusDetail["oext_views"]); ?></i>
                            <i class="down" id="Down">Download：<?php echo ($OpusDetail["down"]); ?> </i>
                            <!-- <i class="down" id="Down">Comment：<?php echo ($coment); ?> </i>-->
                                 <i class="collection"
                                 id="favorite">Favorites：<?php echo ($OpusDetail["oext_favorite"]); ?></i><i class="down" id="Down"><a
                                     href="<?php echo ($OpusDetail["opus_video"]); ?>" rel="external nofollow"
                                     download="web-001.mp4">Download sample</a></i>

                             <li class="quality-checker-wrap">
                                 &nbsp; &nbsp;&nbsp;
                                 &nbsp; &nbsp;
                                 &nbsp; &nbsp;
                                 <!--
                                 <input class="btn2" type="button" value="" style="width:85px;height:28px;border:none;background:url(__IMG__/weixin_l24.png)"/>
                                 -->
								<a href="<?php echo ($OpusDetail["opus_pic_big"]); ?>" title="Since the system randomly extracts any frame for image quality detection, blurring may occur" target="_blank"><font size="3">Image quality inspection</font></a>
                            </li>
                            
                        </span>
                    </div>
					

                    <div class="pics">
                        <div style="padding-top: 10px">
                            <img src="<?php echo ($OpusDetail["opus_pic_cons"]); ?>" onerror="this.src='__IMG__/con-img1.png'" alt="" />
                        </div>
						    <div style="padding-top: 10px"> 
							 <?php if(is_array($OpusSearch)): $i = 0; $__LIST__ = $OpusSearch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><span style="font-size:16px"> <?php echo ($list); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                  </div>
					
						


                </div>





            </div>
            <div class="rightct fr">

                <div class="prodinfo">
                    <dl>
                        <dt>Selling price：

						<?php if($OpusDetail["is_half"] == 0): ?><em id="readpoint"><?php echo ($OpusDetail["price"]); ?>&nbsp;Gold</em>
						<?php else: ?>
						<em id="readpoint"><?php echo ($OpusDetail["prices"]); ?>&nbsp;gold coins</em><?php endif; ?>
						&nbsp;&nbsp;<font color="#1abd9b"
                                id="bjzq"></font>
</dt>
<?php if($OpusDetail["is_half"] == 0): ?><a href="<?php echo U('Model/loading',array('opus_id'=>$OpusDetail['opus_id']));?>"style="    color: #fff;background-color: #02d4b1;display: block; margin: 20px 0;width: 300px; height: 56px;line-height: 56px;padding: 0;border-radius: 5px;font-size: 18px;text-align: center;
">Material download</a>
<?php else: ?>
 <a href="<?php echo U('Model/loading',array('opus_id'=>$OpusDetail['opus_id']));?>"style="    color: #fff;background-color: #02d4b1;display: block; margin: 20px 0;width: 300px; height: 56px;line-height: 56px;padding: 0;border-radius: 5px;font-size: 18px;text-align: center;
    ">Free download</a><?php endif; ?>





                        <dd>Video type: <?php echo ($OpusDetail["tip_style"]); ?></dd>
                        <dd>Audio: for reference only</dd>						
						<dd>Upload date: <?php echo ($OpusDetail["opus_createtime"]); ?></dd>
                    </dl>
                    <div class="btns bdsharebuttonbox">,

                        <a href="javascript:favorite(<?php echo ($OpusDetail["opus_id"]); ?>,<?php echo ($OpusDetail["user_id"]); ?>);" class="sc"
                            id="showsc">Favorites</a>
                        <!-- <a href="javascript:share();" class="share bds_more" data-cmd="more" >share it</a>-->
                        <script type="text/javascript">
                            function share() {
                                $('#share').attr('style', 'display:block');
                            }
                        </script>

                    </div>
                    <div class="jiathis_style_24x24 fr" id='share' style="display: none">
                        <a class="jiathis_button_qzone"></a>
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_tqq"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_renren"></a>
                        <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis"
                            target="_blank"></a>
                        <a class="jiathis_counter_style"></a>
                    </div>
                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                </div>
				                <div class="userinfo">
                    <dl class="clearfix">
                        <dt><img src="<?php echo ($UserInfo["user_pic"]); ?>" onerror="this.src='__IMG__/nophoto.gif'"></dt>
                        <dd><b><?php echo ($UserInfo["user_nickname"]); ?></b><a href="javascript:follow(<?php echo ($UserInfo["user_id"]); ?>);"
                                class="gz follow" id="follow">Follow</a></dd>
                        <dd><i>Number of Works：<?php echo ($OpusCount); ?> </i><a
                                href="<?php echo U('Single/personal',array('user_id'=>$UserInfo['user_id']));?>" target="_blank"
                                class="kj">【Homepage】</a></dd>
								<dd><i style="padding-left:72px;color: #44a0d5;">Verified </i></dd>

                    </dl>
                </div>
				<!--
                <div class="hotword">

                    <div class="words">
                        <?php if(is_array($OpusSearch)): $i = 0; $__LIST__ = $OpusSearch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Search/index',array('search'=>$list));?>" target="_blank"><?php echo ($list); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
				-->
            </div>
        </div>


        <div class="caselist">
            <!-- <div class="titles">related suggestion</div>-->
            <div class="contlist">
                <div class="caselistcnt clearfix">

                    <?php if(is_array($SameList)): $i = 0; $__LIST__ = array_slice($SameList,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl class="items pr">
                            <a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">

                                <dt class="scrollpic listheight">
                                    


                     <div style="position:relative;">

                                        <video id="video" poster="<?php echo ($list["opus_pic_big"]); ?>" onmouseover="videoPlayback()"
                                            onmouseout="videoStopped()" muted="muted" muted="muted" loop='loop' width="280" height="160" style="width:100%; height=100%; object-fit: fill">
                                            <source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
                                        </video>


　　                       <div style="position:absolute; z-index:2; left:140px; top:140px;font-size:15px;color:#fff;">

　　　               <?php  echo substr($list['opus_updatetime'],0,10) ?>

　　                   </div>

                              </div>






                                        <div class="pic"></div>
                                        <div class="upscr"></div>
                                        <div class="downscr"></div>
                                </dt>
                            </a>
                            <dd style="text-align:center;font-size:16px;">
                                <p><a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title"
                                        target="_blank"><?php echo ($list["opus_title"]); ?></a></p>
                            </dd>
                            <!-- <dd><span><ins><img src="__IMG__/indicos1.png"><?php echo ($list["down"]); ?></ins><i><img src="__IMG__/indicos2.png"><?php echo ($list["oext_favorite"]); ?></i><em><?php  echo substr($list['opus_updatetime'],0,10) ?></em></span></dd>
                                       Half price sign-->
                            <?php if($list['is_half'] == 1): ?><img class="pa" style="left:0;top:0;z-index:10" src="__IMG__/bjicos.png" /><?php endif; ?>
                        </dl><?php endforeach; endif; else: echo "" ;endif; ?>
               

            </div>
        </div>
    </div>


	
	
    <!----->





    </div>
    <input type="hidden" value="<?php echo ($OpusDetail["opus_id"]); ?>" id="opus_id">
    <input type="hidden" value="<?php echo ($UerInfo["user_id"]); ?>" id="seller_id">






	








    <!--Check status-->
	    <script src="__JS__/tips.js" type="text/javascript"></script>

    <script type="text/javascript" src="__JS__/jquery.reveal.js"></script>
    <script src="__JS__/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript" src="__JS__/jquery.min.js"></script>
	<script type="text/javascript" src="__JS__/blowup.min.js"></script>
    <script type="text/javascript" src="__CS__/demo/scripts/prism.js"></script>
    <script type="text/javascript">


        var speed = 10;//Set speed

        //var vdo = document.getElementById("Id of the video");//Get id
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



        $(document).ready(function () {
		
       
     //   return false;
            $(".demo-img").blowup({
                //background : "#FFFFFF"
            });

        });
	 </script>	
		

	

	
	
	
	
	
	
	

    <!--Collection status-->
    <script type="text/javascript">
        head.ready('jquery', function () {
            var SiteUrl = $('#SiteUrl').val();
            var opus_id = $('#opus_id').val();

            $.getJSON(SiteUrl + '/index.php/Ajax/FavorJudge?fa_id=' + opus_id + "&" + Math.random(), function (data) {
                if (data.judge == 'true') {
                    $(".sc").html("Collected");
                } else {
                    $(".sc").html("Favorites");
                }
            });
        })




    </script>
    <!--Follow state-->
    <script type="text/javascript">
        head.ready('jquery', function () {
            var SiteUrl = $('#SiteUrl').val();
            var seller_id = $('#seller_id').val();
            $.getJSON(SiteUrl + '/index.php/Ajax/FocusJudge?seller_id=' + seller_id + "&" + Math.random(), function (data) {
                if (data.judge == 'true') {
                    $(".gz").html("Followed");
                } else {
                    $(".gz").html("Follow");
                }
            });
        })
    </script>
    <script type="text/javascript">
        head.load('__JS__/show.js', function () { });

    </script>





<Script type="text/javascript">


function popup(popupName){	
	_windowHeight = $(".wrap").height();//Get the current window height
	_windowWidth = $(".wrap").width();//Get the current window width
	_popupHeight = popupName.height();//获取弹出层高度
	_popupWeight = popupName.width();//Get the height of the pop-up layer
	_posiTop = (_windowHeight - _popupHeight)/10;
	_posiLeft = (_windowWidth - _popupWeight)/8;
	popupName.css({"left": _posiLeft + "px","top":_posiTop + "px","display":"block"});//Set position
}	


function popups(popupName){	

	popupName.css({"left": _posiLeft + "px","top":_posiTop + "px","display":"none"});//Set position
}	
	
	

$(function(){



	$(".btn1").click(function(){
		popup($("#div1"));
	//	popups($("#div2"));
	});

//	$("#click1").click(function(){
	//	popups($("#div1"));
	//});

	$(".btn2").click(function(){
	//	popup($("#div2"));
		popups($("#div1"));
	});
	

	
});
 



function   Lock_CheckForm(theForm){

//div2.style.display='none';
div1.style.display='none';
return   false;

}

	
//Hide the pop-up layer when you click outside the pop-up batch settings
//$(document).click(function(event){
	//$('#div2').css('display','none');
//	div2.style.display='none';
//});
 

 $(window).resize(); 
 
 </script>











    <script type="text/javascript">
        function edit(action, id) {
            $.ajax({
                type: "get",
                async: true,
                url: "/index.php/Service/" + action + " ?action=" + action + '&opus_id=' + id,
                dataType: "html",
                data: '',

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