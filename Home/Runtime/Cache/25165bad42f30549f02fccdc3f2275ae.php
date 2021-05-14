<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
	
	<title><?php echo ($title); ?></title>
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

				<input class="webtxt search" name="search" placeholder="Please enter keywords, keywords" data-name="original-font-color"
					type="text">
				<input type="submit" class="webtn" value="" />
			</form>
		</div>
		
<div  style="width: 738px; height: 41px; overflow: hidden; position: absolute;top: 485px; left: 50%; margin-left: -372px; z-index: 999;">
	
<a href="<?php echo U('Search/index', array('search'=>'Title'));?>" title="Title">Title</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'Technology'));?>" title="Technology">Technology</a>&nbsp;
&nbsp;<a href="<?php echo U('Search/index', array('search'=>'Ink and wash'));?>" title="Ink and wash">Ink and wash</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'Particle'));?>" title="Particle">Particle</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'Map'));?>" title="Map">Map</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'Countdown'));?>" title="Countdown">Countdown</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'logo'));?>" title="logo">logo</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'Text'));?>" title="Text">Text</a>&nbsp;
<a href="<?php echo U('Search/index', array('search'=>'Flash'));?>" title="Flash">Flash</a>&nbsp;
<a href="<?php echo U('Search/index');?>" title="More">More></a>
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
	<h2 class="section-title">Good at creation</h2>
	<p class="section-des">From every designer's pursuit of the ultimate</p>
	
	

	</section>


<div class="indcaselist12">
		<div class="wrap">
			<div class="contmain">
			
			

				
				
				<div class="cont">

					<!--                             Popular of the week starts                                -->



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

											　　　 <?php echo ($list1["down"]); ?>download
											
				<span style="padding-left:280px">							
				<?php if($list1["opus_source"] == 0): else: ?>
                     Original<?php endif; ?>				
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
				<h2 class="section-title">Real-time update, extremely fast download</h2><!-- Data to be filled --><p class="section-des">This week, 3,524 pieces of illegal content were intercepted, and 21,693 pieces of designer work were put on the shelves</p>
				</div>
				
				
						  
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a href="<?php echo U('Model/index',array('cid'=>3));?>" target="_blank">AE template</a></span>
				

				
					
					<!--<em><a href="<?php echo U('Model/index',array('cid'=>$info['cid']));?>" target="_blank">see more</a></em>-->
				</div>
				<div class="cont">

					<div class="tabct clearfix index_hot">

						<?php if(is_array($home_NewList)): $i = 0; $__LIST__ = $home_NewList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><!--                             Latest release   begin                                -->



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
                     Recommend<?php endif; ?>				
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
												<li>Designer:<?php echo ($list["user_nickname"]); ?></li>
												<li>Classification:<?php echo ($list["name"]); ?></li>
												<li>Resolution:1920×1080</li>
												<li>Download:<?php echo ($list["down"]); ?></li>
												<li>Selling price:<?php echo ($list["price"]); ?>Gold</li>
												<li>Time:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							
							
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>


						<!--                             Latest release   jieshu                                -->


					</div>







					<div class="tabct clearfix none">


					</div>
					
					<p style="padding-bottom:5px">	</p>	
					
					
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<!------------------------------3D model------Category------------------------------>
			  	<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>5));?>" target="_blank">Pr template</a></span>
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
                                      Recommend<?php endif; ?>				
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
												<li>Designer:<?php echo ($list["user_nickname"]); ?></li>
												<li>Classification:<?php echo ($list["name"]); ?></li>
												<li>Resolution:1920×1080</li>
												<li>Download:<?php echo ($list["down"]); ?></li>
												<li>Selling price:<?php echo ($list["price"]); ?>Gold</li>
												<li>Time:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
						<p style="padding-bottom:5px">	</p>			

				</div>			
				
		
				
				
				
		
				<!------------------------------Da Vinci template------Category------------------------------>
			  	<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>2));?>" target="_blank">Da Vinci template</a></span>
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
                                      Recommend<?php endif; ?>				
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
												<li>Designer:<?php echo ($list["user_nickname"]); ?></li>
												<li>Classification:<?php echo ($list["name"]); ?></li>
												<li>Resolution:1920×1080</li>
												<li>Download:<?php echo ($list["down"]); ?></li>
												<li>Selling price:<?php echo ($list["price"]); ?>Gold</li>
												<li>Time:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
					<p style="padding-bottom:5px">	</p>				

				</div>							
				
	


	
				
			<!------------------------------pr template------Category------------------------------>

			  	<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>4));?>" target="_blank">Vertical template area</a></span>
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
                                      Recommend<?php endif; ?>				
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
												<li>Designer:<?php echo ($list["user_nickname"]); ?></li>
												<li>Classification:<?php echo ($list["name"]); ?></li>
												<li>Resolution:1920×1080</li>
												<li>Download:<?php echo ($list["down"]); ?></li>
												<li>Selling price:<?php echo ($list["price"]); ?>Gold</li>
												<li>Time:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
									
              <p style="padding-bottom:5px">	</p>
				</div>				
				
				
	

				
			<!------------------------------edius template------Category------------------------------template------Category------------------------------>

			  
					<div class="title clearfix tabtitle">
			
					<span><li class="list-style5"></li></span><span style="margin-top:-10px"><a style="color: #555" href="<?php echo U('Model/index',array('cid'=>6));?>" target="_blank">Video material</a></span>
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
                                      Recommend<?php endif; ?>				
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
												<li>Designer:<?php echo ($list["user_nickname"]); ?></li>
												<li>Classification:<?php echo ($list["name"]); ?></li>
												<li>Resolution:1920×1080</li>
												<li>Download:<?php echo ($list["down"]); ?></li>
												<li>Selling price:<?php echo ($list["price"]); ?>Gold</li>
												<li>Time:<?php  echo substr($list['opus_updatetime'],0,10) ?></li>
											</ul>
										</div>
							
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>


					<div class="tabct clearfix none">


					</div>
					<p style="padding-bottom:5px">	</p>			

				</div>				
				
                <div class="btng">              

               <a href="<?php echo U('Model/index',array('cid'=>1));?>" class="btngen btn-green" target="_blank">More latest recommendations</a>

	
				</div>
				




				
				
				
				
				
			</div>
		</div>
		

				
	</div>



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




	<script type="text/javascript">
		head.load(SiteUrl.value + '/Public' + '/js/index.js');
	</script>

	<div class="clearfix"></div>

	
<div class="footer">
    <div class="ftnemu">
        <div class="wrap clearfix">
            <div class="navmain clearfix fl">
                <dl>
                    <dt><img src="__IMG__/ftico1.png">about Us</dt>
                    <dd><a href="<?php echo U('Single/aboutUS',array('show'=>'0'));?>" target="_blank">Website Introduction</a></dd>

                    <dd><a href="<?php echo U('Single/aboutUS',array('show'=>'1'));?>" target="_blank">Contact us</a></dd>
                </dl>
                <dl>
                    <dt><img src="__IMG__/ftico3.png">I am a member</dt>
                    <dd><a href="<?php echo U('Service/index');?>" onclick="chan_Page('ToBeSeller')" target="_blank">become member</a></dd>

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