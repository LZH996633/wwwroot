<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
	
	<title><?php echo ($title); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($key); ?> ">
<meta name="description" content="<?php echo ($des); ?> "/>
<link rel="shortcut icon" href="__IMG__/favicon.ico" >
<!--首页截取-->
<link href="__CS__/ppts.css" rel="stylesheet" type="text/css">
<link href="__CS__/layer.css" rel="stylesheet" type="text/css">
<link href="__CS__/video/1555.css" rel="stylesheet" type="text/css">
<link href="__CS__/video/video-js.min.css" rel="stylesheet">
<script type="text/javascript" src="__JS__/video/vue.js"></script>
<script type="text/javascript" src="__JS__/video/video.min.js"></script>
<script type="text/javascript" src="__JS__/head.min.js" data-headjs-load="__JS__/init.js"></script>
<!--    <link href="https://static.vjshi.com/dist/css/utils_cccb1876.css" rel="stylesheet">  -->
<!--	<link href="https://static.vjshi.com/dist/css/total-commons_01e5d0e5.css" rel="stylesheet">
	<link href="https://static.vjshi.com/dist/css/hero-commons_73cdd22e.css" rel="stylesheet">
	<link href="https://static.vjshi.com/dist/css/hero_user_buyer_buyrecord_d8bb49a8.css" rel="stylesheet">
	
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>

	-->
	<script type="text/javascript" src="__JS__/jquery.min.js"></script>
	
	

	<style type="text/css">
		


		
	
		
		
	</style>

	<script type="text/javascript" language="javascript">

		function display(key) {

			$(".box").css('display', 'none');


			$(".box").eq(key).css('display', 'block');


		}
		
		
		function disappear() {
			$(".box").css('display', 'none');

		}

		
		
		function displays(key) {

			$(".box1").css('display', 'none');


			$(".box1").eq(key).css('display', 'block');


		}
		function disappears() {
			$(".box1").css('display', 'none');

		}	
		
		
		
		
		function displays1(key) {

			$(".box2").css('display', 'none');


			$(".box2").eq(key).css('display', 'block');


		}
		function disappears1() {
			$(".box2").css('display', 'none');

		}	
	


		function displays2(key) {

			$(".box3").css('display', 'none');


			$(".box3").eq(key).css('display', 'block');


		}
		function disappears2() {
			$(".box3").css('display', 'none');

		}


		function displays3(key) {

			$(".box4").css('display', 'none');


			$(".box4").eq(key).css('display', 'block');


		}
		function disappears3() {
			$(".box4").css('display', 'none');

		}


		function displays4(key) {

			$(".box5").css('display', 'none');


			$(".box5").eq(key).css('display', 'block');


		}
		function disappears4() {
			$(".box5").css('display', 'none');

		}



	

	</script>




</head>

<body>
	<h1 id="seodw">鹿酷-AE视频素材下载平台</h1>
	<!--公共头部-->
	<div class="header normaltop">
    <div class="wrap clearfix">
        <div class="logo fl"><a href="<?php echo U('Index/index');?>"><img src="<?php echo ($logo["ad_pic"]); ?>"></a></div>
        <div class="nav fl"></div>
        <div class="subnav fl clearfix"><i><a href="<?php echo U('Index/index');?>" >首页</a></i>
            <div class="downnav fl"> <em><a href="javascript:;">分类</a></em>
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
    <a href="javascript:void(0);" class="logina">登录</a> <a href="javascript:void(0);" class="zcy">注册</a>
</div>

<div class="logout">

    <div class="hduserinfo">
	       &nbsp;&nbsp;&nbsp; <a href="<?php echo U('Service/materialupload', array('pid'=>1));?>">上传</a>&nbsp;&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="qiandao()">签到</a>&nbsp;&nbsp;&nbsp;
        <img id="img_in" class="logout1" src="__IMG__/useravatar.png" onerror="this.src='__IMG__/useravatar.png'" />
        <a href="<?php echo U('Service/index');?>" target="_blank"><i class="myName"></i></a>
    </div>
    <dl id="userinfo">
        <dd> <a href="<?php echo U('Service/index');?>" target="_blank">个人中心</a></dd>
		
	        <dd> <a href="<?php echo U('Service/main');?>" target="_blank">会员中心</a></dd>	
		
		
        <dd><a href="<?php echo U('Service/index');?>" onclick="chanPage('StationMsg')" target="_blank">收件箱(<?php echo ($new_chat); ?>)</a></dd>
        <dd><a href="#" id="logout">退出</a></dd>
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
                    welcome += "上午好，"
                } else if (t >= 12 && t <= 13) {
                    welcome += "中午好，"
                } else if (t > 13 && t <= 17) {
                    welcome += "下午好，"
                } else {
                    welcome += "晚上好，"
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
            ////alert(msg.status);
             //alert("ajax安全设置错误\n\n Internet选项->安全->自定义级别->选择'通过域访问数据源'为启用。保存后重启浏览器即可");
        }
    });
        $(".logout").hover(function() {
            $("#userinfo").show();
        }, function() {
            $("#userinfo").hide();
        });


    });
</script>
<!--查询-->
<script type="text/javascript">
        head.ready('jquery',function() {
            var SiteUrl = $('#SiteUrl').val();


            $(".search").keydown(function(e) {
                // 回车键事件

                if(e.which == 13) {

                    go_search($(this).val());
                }
            });

            function go_search(q){

                if(q==''){
                    //alert('关键词不能为空！');
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


	
		/* 签到*/
		
	        function qiandao() {
			
            $.getJSON('/index.php/Ajax/qiandao', '', function (data) {
                if (data.status == '0') {
                    layer.msg(data.msg, {
                        icon: 4,
                        time: 5000 //2秒关闭（如果不配置，默认是3秒）
                    })
                }
                else if (data.status == '2') {
                    $("#tall").val(data.tall);
                    $("#low").val(data.low);

				      layer.msg(data.msg, {
                        icon: 4,
                        time: 5000 //2秒关闭（如果不配置，默认是3秒）
                   })
               }


            })
        }
			
		
		



    </script>
</span>

       <div class="formgroup fr clearfix">
                <input class="webtxt search"  placeholder="按回车搜索" name='search' data-name="original-font-color"  type="search">
                <input type="button" class="webtns" value=" " />
       </div>

        </div>
    </div>
</div>



	<div class="clearfix"></div>

	<div class="indsbanner">
	
	<div class="banners">
	
    <div class="wrap">
    </div>
	
	<!--
		<div class="flexslider">

			<ul class="slides">
				<?php if(is_array($ad_list)): $i = 0; $__LIST__ = $ad_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li style="background:url(<?php echo ($list["ad_pic"]); ?>) center no-repeat;">
						<a href="#" target="_blank"><?php echo ($list["ad_title"]); ?></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
		
			<div  style="width: 738px; height: 41px; overflow: hidden; position: absolute;top: 175px; left: 50%; margin-left: -372px; z-index: 999;">
	
			<li><span style="font-size:36px;color:#000;opacity: .85;">视频设计师的自留地</span></li>

		</div>	
		-->
		
		<div class="searchmain">
			<form action="<?php echo U('Search/index');?>" method="post">

				<input class="webtxt search" name="search" placeholder="请输入关键字、关键词" data-name="original-font-color"
					type="text">
				<input type="submit" class="webtn" value="" />
			</form>
		</div>
		
<div  style="width: 738px; height: 41px; overflow: hidden; position: absolute;top: 485px; left: 50%; margin-left: -372px; z-index: 999;">
	
<a href="<?php echo U('Search/index', array('search'=>'片头'));?>" title="片头">片头</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'科技'));?>" title="科技">科技</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'我和我的祖国'));?>" title="我和我的祖国">我和我的祖国</a>
&nbsp;<a href="<?php echo U('Search/index', array('search'=>'水墨'));?>" title="水墨">水墨</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'粒子'));?>" title="粒子">粒子</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'地图'));?>" title="地图">地图</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'倒计时'));?>" title="倒计时">倒计时</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'酒吧开场'));?>" title="酒吧开场">酒吧开场</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'logo'));?>" title="logo">logo</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'党建'));?>" title="党建">党建</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'文字'));?>" title="文字">文字</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'党政'));?>" title="党政">党政</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'星空'));?>" title="星空">星空</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'快闪'));?>" title="快闪">快闪</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'党旗'));?>" title="党旗">党旗</a>&nbsp;&nbsp;
<a href="<?php echo U('Search/index');?>" title="更多">更多></a>
</div>		
		
		
		
		
		
		
	</div>
	</div>
	
	




	
	<section class="site-advantage white-section">
	<div class="site-advantage-wrap">
	<div class="site-advantage-item">
<p style="higher:100px;">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


	</section>
	
	

	

	
	
	<section class="slider-container common-section">
	<h2 class="section-title">精工创作</h2>
	<p class="section-des">源自每一位设计师对极致的追求</p>
	
	

	</section>


<div class="indcaselist12">
		<div class="wrap">
			<div class="contmain">
			
			

				
				
				<div class="cont">

					<!--                             一周热门 开始                                -->



					<div class="tabct clearfix">
						

								<?php if(is_array($home_HotList0)): $i = 0; $__LIST__ = $home_HotList0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list1): $mod = ($i % 2 );++$i;?><dl>






								<a href="<?php echo U('Model/model',array('cid'=>$list1['opus_id']));?>" target="blank">

									<div style="position:relative;">

										<video id="video" poster="<?php echo ($list1["opus_pic"]); ?>" onmouseover="videoPlayback()"
											onmouseout="videoStopped()" muted="muted" muted="muted"
											width="380" height="200" style=" border-radius: 3px; width:100%; height=100%; object-fit: fill">
											<source src="<?php echo ($list1["opus_video"]); ?>" type="video/mp4">
										</video>
										　　 <div
											style="position:absolute; z-index:2; left:-30px; top:180px;font-size:15px;color:#fff;">

											　　　 <?php echo ($list1["down"]); ?>下载
											
				<span style="padding-left:280px">							
				<?php if($list1["opus_source"] == 0): else: ?>
                     原创<?php endif; ?>				
				</span>							

											　　 </div>
									</div>




									<div class="upscr"></div>

									<div class="downscr1"
										style="margin-top: -10px;text-align:center;padding-bottom:5px;font-size:16px; color:#424242;">
										<a href="<?php echo U('Model/model',array('cid'=>$list1['opus_id']));?>" class="title"
											target="_blank"><?php echo ($list1["opus_title"]); ?></a>

									</div>
								</a>


							</dl><?php endforeach; endif; else: echo "" ;endif; ?>

					</div>











				</div>
			</div>
		</div>
	</div>


















	<div class="indcaselist">
		<div class="wrap">
			<div class="contmain">
				<div class="title clearfix tabtitle">
				
				<div class="slider-container">
				<h2 class="section-title">实时更新，极速下载</h2><!-- 待填写数据 --><p class="section-des">鹿酷本周拦截3524件违规内容，上架21693件设计师作品</p>
				</div>
				
				
						  
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a href="<?php echo U('Model/index',array('cid'=>3));?>" target="_blank">AE模板</a></span>
				

				
					
					<!--<em><a href="<?php echo U('Model/index',array('cid'=>$info['cid']));?>" target="_blank">查看更多</a></em>-->
				</div>
				<div class="cont">

					<div class="tabct clearfix index_hot">

						<?php if(is_array($home_NewList)): $i = 0; $__LIST__ = $home_NewList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><!--                             最新发布   开始                                -->



							<dl>
								<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">



									<div style="position:relative;">

										<video id="video" poster="<?php echo ($list["opus_pic"]); ?>" onmouseover="videoPlayback()"
											onmouseout="videoStopped()" muted="muted" muted="muted" loop='loop'
											width="280" height="160" style="border-radius: 3px; width:100%; height=100%; object-fit: fill">
											<source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
										</video>
										　　 <div onmouseover="displays(<?php echo ($key); ?>)" onmouseout="disappears()"
											style="position:absolute; z-index:2; left:-30px; top:140px;font-size:15px;color:#fff;">

											　　　 <?php echo ($list["sjs"]); ?>
															<span style="padding-left:185px">							
				<?php if($list["recom"] == 0): else: ?>
                     荐<?php endif; ?>				
				</span>	

											　　 </div>
									</div>

									<div class="upscr"></div>

									<div class="downscr" onmouseover="displays(<?php echo ($key); ?>)" onmouseout="disappears()" style="margin-top: -10px;text-align:center;padding-bottom:5px;font-size:16px; color:#424242;">

										<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank"><?php echo ($list["opus_title"]); ?></a>

									</div>






								</a>


							
				                        <div id="box1" class="box1">
										<div class="tri_rig1"></div>
										<div class="tri_rig01"></div>

											<ul>
												<li>设计师:<?php echo ($list["user_nickname"]); ?></li>
												<li>分类:<?php echo ($list["name"]); ?></li>
												<li>分辨率:1920×1080</li>
												<li>下载:<?php echo ($list["down"]); ?></li>
												<li>售价:<?php echo ($list["price"]); ?>元</li>
												<li>时间:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							
							
							
							</dl>
							<!--  

				 --><?php endforeach; endif; else: echo "" ;endif; ?>


						<!--                             最新发布   jieshu                                -->


					</div>







					<div class="tabct clearfix none">


					</div>
					
					<p style="padding-bottom:5px">	</p>	
					
					
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<!------------------------------3D模型------类目------------------------------>
			  	<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>5));?>" target="_blank">Pr模板</a></span>
				</div>
			  
			  

				<div class="cont">
					<div class="tabct clearfix index_hot">

						<?php if(is_array($home_NewLists)): $i = 0; $__LIST__ = $home_NewLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl>
								<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">



									<div style="position:relative;">

										<video id="video" poster="<?php echo ($list["opus_pic"]); ?>" onmouseover="videoPlayback()"
											onmouseout="videoStopped()" muted="muted" muted="muted" loop='loop'
											width="280" height="160" style="border-radius: 3px; width:100%; height=100%; object-fit: fill">
											<source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
										</video>
										　　 <div onmouseover="displays1(<?php echo ($key); ?>)" onmouseout="disappears1()" style="position:absolute; z-index:2; left:-30px; top:140px;font-size:15px;color:#fff;">

											　　　 <?php echo ($list["sjs1"]); ?>
															<span style="padding-left:185px">							
				                      <?php if($list["recom"] == 0): else: ?>
                                      荐<?php endif; ?>				
			                                            	</span>	

											　　 </div>
									</div>

									<div class="upscr"></div>

									<div class="downscr" onmouseover="displays1(<?php echo ($key); ?>)" onmouseout="disappears1()" style="margin-top: -10px;text-align:center;padding-bottom:5px;font-size:16px; color:#424242;">

										<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank"><?php echo ($list["opus_title"]); ?></a>

									</div>


								</a>


							
				                        <div id="box2" class="box2">
										<div class="tri_rig2"></div>
										<div class="tri_rig02"></div>

											<ul>
												<li>设计师:<?php echo ($list["user_nickname1"]); ?></li>
												<li>分类:<?php echo ($list["name1"]); ?></li>
												<li>分辨率:1920×1080</li>
												<li>下载:<?php echo ($list["down"]); ?></li>
												<li>售价:<?php echo ($list["price"]); ?>元</li>
												<li>时间:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
						<p style="padding-bottom:5px">	</p>			

				</div>			
				
		
				
				
				
		
				<!------------------------------达芬奇模板------类目------------------------------>
			  	<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>2));?>" target="_blank">达芬奇模板</a></span>
				</div>
			  

				<div class="cont">
					<div class="tabct clearfix index_hot">

						<?php if(is_array($home_NewLists1)): $i = 0; $__LIST__ = $home_NewLists1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl>
								<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">



									<div style="position:relative;">

										<video id="video" poster="<?php echo ($list["opus_pic"]); ?>" onmouseover="videoPlayback()"
											onmouseout="videoStopped()" muted="muted" muted="muted" loop='loop'
											width="280" height="160" style="border-radius: 3px; width:100%; height=100%; object-fit: fill">
											<source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
										</video>
										　　 <div
											onmouseover="displays2(<?php echo ($key); ?>)" onmouseout="disappears2()" style="position:absolute; z-index:2; left:-30px; top:140px;font-size:15px;color:#fff;">

											　　　 <?php echo ($list["sjs1"]); ?>
															<span style="padding-left:185px">							
				                      <?php if($list["recom"] == 0): else: ?>
                                      荐<?php endif; ?>				
			                                            	</span>	

											　　 </div>
									</div>

									<div class="upscr"></div>

									<div class="downscr" onmouseover="displays2(<?php echo ($key); ?>)" onmouseout="disappears2()" style="margin-top: -10px;text-align:center;padding-bottom:5px;font-size:16px; color:#424242;">

										<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank"><?php echo ($list["opus_title"]); ?></a>

									</div>


								</a>


							
				                        <div id="box3" class="box3">
										<div class="tri_rig3"></div>
										<div class="tri_rig03"></div>

											<ul>
												<li>设计师:<?php echo ($list["user_nickname1"]); ?></li>
												<li>分类:<?php echo ($list["name1"]); ?></li>
												<li>分辨率:1920×1080</li>
												<li>下载:<?php echo ($list["down"]); ?></li>
												<li>售价:<?php echo ($list["price"]); ?>元</li>
												<li>时间:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
					<p style="padding-bottom:5px">	</p>				

				</div>							
				
	


	
				
			<!------------------------------pr模板------类目------------------------------>

			  	<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>4));?>" target="_blank">竖幅模板专区（手机）</a></span>
				</div>

				<div class="cont">
					<div class="tabct clearfix index_hot">

						<?php if(is_array($home_NewLists2)): $i = 0; $__LIST__ = $home_NewLists2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl>
								<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">



									<div style="position:relative;">

										<video id="video" poster="<?php echo ($list["opus_pic"]); ?>" onmouseover="videoPlayback()"
											onmouseout="videoStopped()" muted="muted" muted="muted" loop='loop'
											width="280" height="160" style="border-radius: 3px; width:100%; height=100%; object-fit: fill">
											<source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
										</video>
										　　 <div onmouseover="displays3(<?php echo ($key); ?>)" onmouseout="disappears3()"
											style="position:absolute; z-index:2; left:-30px; top:140px;font-size:15px;color:#fff;">

											　　　 <?php echo ($list["sjs1"]); ?>
															<span style="padding-left:185px">							
				                      <?php if($list["recom"] == 0): else: ?>
                                      荐<?php endif; ?>				
			                                            	</span>	

											　　 </div>
									</div>

									<div class="upscr"></div>

									<div class="downscr" onmouseover="displays3(<?php echo ($key); ?>)" onmouseout="disappears3()" style="margin-top: -10px;text-align:center;padding-bottom:5px;font-size:16px; color:#424242;">

										<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank"><?php echo ($list["opus_title"]); ?></a>

									</div>


								</a>


							
				                        <div id="box4" class="box4">
										<div class="tri_rig4"></div>
										<div class="tri_rig04"></div>

											<ul>
												<li>设计师:<?php echo ($list["user_nickname1"]); ?></li>
												<li>分类:<?php echo ($list["name1"]); ?></li>
												<li>分辨率:1920×1080</li>
												<li>下载:<?php echo ($list["down"]); ?></li>
												<li>售价:<?php echo ($list["price"]); ?>元</li>
												<li>时间:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
									
              <p style="padding-bottom:5px">	</p>
				</div>				
				
				
	

				
			<!------------------------------edius模板------类目------------------------------模板------类目------------------------------>

			  
					<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>6));?>" target="_blank">视频素材</a></span>
				</div>
				<div class="cont">
					<div class="tabct clearfix index_hot">

						<?php if(is_array($home_NewLists3)): $i = 0; $__LIST__ = $home_NewLists3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl>
								<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">



									<div style="position:relative;">

										<video id="video" poster="<?php echo ($list["opus_pic"]); ?>" onmouseover="videoPlayback()"
											onmouseout="videoStopped()" muted="muted" muted="muted" loop='loop'
											width="280" height="160" style="border-radius: 3px; width:100%; height=100%; object-fit: fill">
											<source src="<?php echo ($list["opus_video"]); ?>" type="video/mp4">
										</video>
										　　 <div onmouseover="displays4(<?php echo ($key); ?>)" onmouseout="disappears4()"
											style="position:absolute; z-index:2; left:-30px; top:140px;font-size:15px;color:#fff;">

											　　　 <?php echo ($list["sjs1"]); ?>
															<span style="padding-left:185px">							
				                      <?php if($list["recom"] == 0): else: ?>
                                      荐<?php endif; ?>				
			                                            	</span>	

											　　 </div>
									</div>

									<div class="upscr"></div>

									<div class="downscr" onmouseover="displays4(<?php echo ($key); ?>)" onmouseout="disappears4()" style="margin-top: -10px;text-align:center;padding-bottom:5px;font-size:16px; color:#424242;">

										<a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank"><?php echo ($list["opus_title"]); ?></a>

									</div>


								</a>


							
				                        <div id="box5" class="box5">
										<div class="tri_rig5"></div>
										<div class="tri_rig05"></div>

											<ul>
												<li>设计师:<?php echo ($list["user_nickname1"]); ?></li>
												<li>分类:<?php echo ($list["name1"]); ?></li>
												<li>分辨率:1920×1080</li>
												<li>下载:<?php echo ($list["down"]); ?></li>
												<li>售价:<?php echo ($list["price"]); ?>元</li>
												<li>时间:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
					<p style="padding-bottom:5px">	</p>			

				</div>				
				
                <div class="btng">              

               <a href="<?php echo U('Model/index',array('cid'=>1));?>" class="btngen btn-green" target="_blank">更多最新推荐</a>

	
				</div>
				




				
				
				
				
				
			</div>
		</div>
		

				
	</div>



<div class="rightcolumn">
    <ul>
        <li class="li1"><a href="<?php echo U('Service/index');?>" target="_blank"><em></em><i>查看</i></a></li>
        <li class="li2">
            <a href="javascript:;"><em></em><i>咨询</i></a>
            <div class="zxmain" style="display: none;">
                <i class="arrowrg"></i>
                <dl>
                    <dd>咨询电话:<br><i><?php echo ($Contact_phone); ?></i></dd>
                    <dd><span>
					<a id="QQ_con" href="javascript:void(0);"><img border="0" src="__IMG__/button_111.gif" alt="" title="联系客服" align="absmiddle"></a></span></dd>
                    <dd>工作时间:<br></dd>
                    <dd><?php echo ($Work_time); ?></dd>
                </dl>
            </div>
        </li>
        <li class="li3"><a href="<?php echo U('Service/index');?>" onclick="chanPage('Recharge')" target="_blank"><em></em><i>充值</i></a></li>
        <!--<li class="li4">
            <a href="#"><em></em><i>微信</i></a>
            <div class="zxmain">
                <i class="arrowrg"></i>
                <div class="pic"><img src="__IMG__/ewm.png" style="max-width:100%"></div>
            </div>
        </li>-->
    </ul>
    <div class="gotop none">
        <a href="javascript:;" title="返回顶部"><em>返回顶部</em></a>
    </div>
</div>
<input type="hidden" value="<?php echo ($Contact_QQ); ?>" id="qq_co"/>
<script type="text/javascript">
    head.ready('jquery',function () {
        $('#QQ_con').click(function () {
            var qq = $('#qq_co').val();
            layer.confirm(qq,
                    {title:'联系 QQ &nbsp;:',btn:['关闭']}
            )
        })
    })

</script>
<!--<div class="chatrob">
    <a href="#" target="blank"><img src="" style="border:none;"></a>
</div>-->

<script>
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
    $(".rightcolumn li").hover(function(){
                $(this).find(".zxmain").show();
            },
            function(){
                $(this).find(".zxmain").hide();
            })

</script>


				

	<script type="text/javascript">


		var speed = 10;//设置速度

		//鼠标移进去
		function videoPlayback() {
			//获取视频标签
			var e = window.event;
			var obj = e.srcElement;
			obj.playbackRate = speed;//改变速度
			obj.play();

		}

		//鼠标离开
		function videoStopped() {
			//获取视频标签			
			var e = window.event;
			var obj = e.srcElement;
			//停止播放
			obj.pause();
			obj.currentTime = 0;   //停止播时回到开始
		}


	</script>




	<script type="text/javascript">
		head.load(SiteUrl.value + '/Public' + '/js/index.js');
	</script>

	<div class="clearfix"></div>

	
<div class="footer">
    <div class="ftnemu">
        <div class="wrap clearfix">
            <div class="navmain clearfix fl">
                <dl>
                    <dt><img src="__IMG__/ftico1.png">关于我们</dt>
                    <dd><a href="<?php echo U('Single/aboutUS',array('show'=>'0'));?>" target="_blank">网站介绍</a></dd>
                   <!-- <dd><a href="#" target="_blank">版权声明</a></dd>-->
                    <dd><a href="<?php echo U('Single/aboutUS',array('show'=>'1'));?>" target="_blank">联系我们</a></dd>
                </dl>
                <dl>
                    <dt><img src="__IMG__/ftico2.png">我要充值</dt>
                    <!--<dd><a href="<?php echo U('Service/index');?>" target="_blank">用户中心</a></dd>-->
                    <dd><a href="<?php echo U('Service/index');?>" onclick="chan_Page('AccountDetail')" target="_blank">账户明细</a></dd>
                    <dd><a href="<?php echo U('Service/index');?>" onclick="chan_Page('Recharge')" target="_blank">账户充值</a></dd>
                </dl>
                <dl>
                    <dt><img src="__IMG__/ftico3.png">我是会员</dt>
                    <dd><a href="<?php echo U('Service/index');?>" onclick="chan_Page('ToBeSeller')" target="_blank">成为会员</a></dd>
                    <!--<dd><a href="#" target="_blank">卖家必读</a></dd>-->
                    <dd><a href="<?php echo U('Service/materialupload', array('pid'=>1));?>" onclick="chan_Page('MaterialUpload')" target="_blank">上传素材</a></dd>
                </dl>
      <!--          <dl>
                    <dt><img src="__IMG__/ftico4.png">发现</dt>
                    <dd><a href="#" target="_blank">推广赚钱</a></dd>
                    <dd><a href="#" target="_blank">热销精品</a></dd>
                    <dd><a href="#" target="_blank">加入我们</a></dd>
                </dl>-->
            </div>
            <div class="ftel fr">
                <b><?php echo ($Contact_phone); ?></b><i><?php echo ($Work_time); ?></i><a id="QQ_cha" title="联系客服" href="javascript:void(0)">联系客服</a>
            </div>
        </div>
    </div>
    <input type="hidden" id="qq_ch" value="<?php echo ($Contact_QQ); ?>">
    <script type="text/javascript">
        head.ready('jquery',function () {
            $('#QQ_cha').click(function () {
                var qq = $('#qq_ch').val();
                layer.confirm(qq,
                        {title:'联系 QQ &nbsp;:',btn:['关闭']}
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
               <p>  备案号：<?php echo ($icp); ?></p>


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
            <li class="current">登录</li>
            <li class="cz">注册</li>
        </ul>
        <div class="tabcon">
            <div class="sublist clearfix">
                <form action="<?php echo U('Public/login');?>" method="post" onsubmit="return save_username(this)">
                    <div class="zcform fl">
                        <ul>
                            <li class="clearfix pr"><input type="text" class="webtxt" name='username' id="log_username" placeholder="用户名或邮箱"><span id="utip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="password" class="webtxt" name='password' id="log_password" placeholder="密码"><span id="ptip" class="onShow"></span></li>

                            <li class="clearfix pr"><input type="checkbox"  name="cookie_time" id="cookietime" checked>
                                <label for="chd">记住我</label><i class="forget"><a href="<?php echo U('Public/ForgetShow');?>" target="_blank">忘记密码?</a></i></li>
                            <li class="clearfix pr"><input value="登录" name="dosubmit" id="dosubmit" type="submit" class="webtn" style="width:150px">
							
									
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
            <li class="dl">登录</li>
            <li class="current">注册</li>
        </ul>
        <div class="tabcon">
            <div class="sublist">
                <div class="zcform">
                    <form method="post" action="<?php echo U('Public/register');?>"  id="myform" name="myform" >
                        <ul>
                            <li class="clearfix pr"><input type="text" id="username" name="username" class="webtxt" placeholder="输入用户名"><span id="usernameTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="password" id="password" name="password" class="webtxt" placeholder="密码"><span id="passwordTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="password" id="pwdconfirm" name="pwdconfirm" class="webtxt" placeholder="再次输入密码"><span id="pwdconfirmTip" class="onShow"></span></li>
                            <li class="clearfix pr"><input type="text" id="email" name="email" class="webtxt" placeholder="输入邮箱"><span id="emailTip" class="onShow"></span><span><a href="javascript:void(0);"  id="btnsd1" onclick=""/>发送邮箱验证</a></span> </li>
                            <li class="clearfix pr"><input type="text" id="emailword" name="emailword" class="webtxt" placeholder="输入验证码"><span id="emailwordTip" class="onShow"></span></li>

                            <li class="clearfix pr"><input type="checkbox" id="protocol" checked="checked"><label for="protocol"><a href="<?php echo U('Single/agreement');?>" target="_blank" >阅读并同意《用户服务协议》</a></label><span id="protocoltip" class="onShow"></span></li>

                            <li class="clearfix pr">
                                <input type="submit"  value="注册" class="webtn" style="width:150px">

								</li>
                        </ul>
                        <input type="hidden" name="forward"  class="forward" value=""/>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!--第三方登录-->
<input type="hidden" value="<?php echo ($qq_login); ?>" id="qq_login">
<input type="hidden" value="<?php echo ($wechat_login); ?>" id="wechat_login">

<script language='javascript'>



btnsd1.onclick = function() { 

  var oInpa = document.getElementById("email").value;

if(oInpa==""){
alert("邮箱未输入..");
}else{
alert("邮箱验证已发送，请注意查收..");


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
    function Oauth(i)
    {
        var url="";
        if(i==1){
          url =  $("#qq_login").val();

               var title='QQ登录';
          // location.href = "/index.php/Login/QQ_login"
        }else if(i==0){

            url= $("#wechat_login").val();
            var title="微信登录";

        }else if(i==3){
            url = "<?php echo U('Public/phone');?>";
            var title = '手机登录'
        }
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


	<script type="text/javascript">
		head.ready('jquery', function () {
			$(".tabtitle span i").click(function () {
				$(this).addClass('on').siblings().removeClass('on');
				var i = $(this).index();
				var con = $(this).parent('span').parent('.tabtitle').next();
				con.children('.tabct').eq(i).show().siblings().hide();
			})

		});



	</script>
	<div class="graybg"></div>
</body>

</html>