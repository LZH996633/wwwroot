<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html5>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>





    <link rel="stylesheet" type="text/css" href="__CS__/demo/styles/index.css" />
    <link rel="stylesheet" type="text/css" href="__CS__/demo/styles/prism.css" />

    


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
	
	
    <title><?php echo ($OpusDetail["opus_title"]); ?></title>
	
	
	
    <style type="text/css">
 

		

#div1{background: #FFF; color: #000; padding: 83px; font-size: 13px; border-width: 10px; border-radius: 10px; width:850px; display:none; position:absolute;}
#div2{background:#FFF;color: #FFF; border:3px solid #1abd9b; width:850px;display:none; position:absolute;}
















    </style>


</head>

<body>
    <!--[if lte IE 10]>
        <div style="text-align:center;background: #fce9cf none repeat scroll 0 0;    border: 1px solid #fbdeb6;    color: #915808;    font-size: 12px;    padding: 8px 12px;    position: relative;">
            您正在使用IE低级浏览器，为了您的账号安全和更好的产品体验，<br />强烈建议您立即 <a class="blue" href="http://windows.microsoft.com/zh-cn/internet-explorer/download-ie" target="_blank">升级IE浏览器</a> 或者用更快更安全的 <a class="blue" href="https://www.baidu.com/s?ie=UTF-8&wd=%E8%B0%B7%E6%AD%8C%E6%B5%8F%E8%A7%88%E5%99%A8" target="_blank">谷歌浏览器Chrome</a> 。
        </div>
        <![endif]-->

    <h1 id="seodw">鹿酷-AE视频素材下载平台</h1>
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



    <div class="wrap pptdetails">
        <div class="webmap">
            <em><img src="__IMG__/wzbg.gif"></em><a href="<?php echo U('Index/index');?>">首页</a>><a
                href="<?php echo U('Model/index');?>">视频素材</a>><i><?php echo ($OpusDetail['opus_title']); ?></i>
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
                            <i class="down" id="xiazai">下载：<?php echo ($OpusDetail["down"]); ?> </i>
                            <i class="down" id="xiazai">评论：<?php echo ($coment); ?> </i>
                                <i class="collection"
                                id="favorite">收藏：<?php echo ($OpusDetail["oext_favorite"]); ?></i><i class="down" id="xiazai"><a
                                    href="<?php echo ($OpusDetail["opus_video"]); ?>" rel="external nofollow"
                                    download="web-001.mp4">下载小样</a></i>

                            <li class="quality-checker-wrap"> 
                                &nbsp; &nbsp;&nbsp;<input class="btn1" type="button" value="投诉举报"/>
								
                                &nbsp; &nbsp;
								<!--
								<input class="btn2" type="button" value="" style="width:85px;height:28px;border:none;background:url(__IMG__/weixin_l24.png)"/>
								-->
								<a href="<?php echo ($OpusDetail["opus_pic_big"]); ?>" title="由于系统随机提取任意帧作为画质检测，可能会出现模糊现象" target="_blank"><font size="3">画质检测</font></a>
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
					
						
		             <div id="div1" style="width: 700px;background-color: #fff; background-clip: padding-box;border-radius: 3px;outline: 0;">
					 
                    <div class="snd-dialog-header"> 
					<h5 class="snd-dialog-title" node-dype="title">反馈工单</h5>
					</div>
					
					<!--
					addok页
$sex=$_POST["sex"];   sex  就是 input type="radio"   的 名字   模块 判断 是否post传送过来值

-->
					
				<div class="snd-dialog-body" node-dype="content">	
					
				<div class="user-ticket">
			   <h3 class change-class >
			   <span>对象：【原创】梦幻写意唯美粒子蝴蝶婚礼舞台背景  类型：视频素材<span>
			   </h3>
			   
			  <div class="reason">
		                    <form method="post" onsubmit="return  check_form();">
						<ul>	
						<li>
					<label class="form-radio">
                    <input type="radio" name="sex" id="title" value="0" onClick="selectTag('请填写与此素材重复的另一个素材的链接或ID')" checked />
					<span class="form-radio-text">与站内素材重复</span>
                   </label>
&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="form-radio">
				   <input type="radio" name="sex" id="title1" value="1" onClick="selectTag('请描写此素材违规情况，如：含商业水印、含广告信息、含违法信息等')"/>
				   <span class="form-radio-text">内容违规</span>
                </label>
				&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="form-radio">
				   <input type="radio" name="sex" id="title2" class="title11"  value="3" onClick="selectTag('请填写你的反馈内容！')"/>
				   <span class="form-radio-text">侵权</span>
                </label>
&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="sex" id="title3" value="2" onClick="selectTag('请填写你的反馈内容！')"/>其他
				   </li>
					</ul>
							 </div>
			<div id="tips" class="tips" style="display: none;">	
         <h4>温馨提示</h4>			
			<div class="content"><p>
	如您发现该设计师侵犯您的权利，为了便于我们尽快为您处理，请及时将以下信息发送至邮箱：<span>admin@vjshi.com</span></p><p>
	1，侵权素材链接或ID
</p><p>
	2，初步的作品权利证明材料
</p><p>
	3，权利人信息及联系方式
</p><p>
	VJshi网一直致力于保护原创作品，感谢您参与平台内容治理，我们将尽快回复及处理您的邮件
</p><p><br></p><p>
	VJshi网为保护原创作品采取的措施：
</p><p>
	1，加强审核培训，严格把好审核关
</p><p>
	2，建立信用系统，扶持优质设计师，打击失信设计师 <a href="http://help.vjshi.com/manual/37.html" target="_blank">查看信用系统规则</a></p><p>
	3，提供畅通的投诉渠道及快速处理机制
</p><p>
	4，开发基于图像识别的视频查重系统，杜绝被投诉过的内容再次上传
</p></div>				 
							 
	</div>						 
							 
							 
							 
							 
							 
							 
                        <div class="forms">
                            <ul>
			  
                                <li><textarea maxlength="255" class="form-control __web-inspector-hide-shortcut__"  id="content"  placeholder="请填写与此素材重复的另一个素材的链接或ID" ></textarea></li>
								
                                <li><input type="button" id="webtn" class="webtn" value="提  交" onclick="check_form()"></li>
                            </ul>
							
							

                        </div>
                    </form>	   
			      
			     </div>
			    </div>
			   
			   
			   
			   <li>
                <a href=JavaScript:; onclick="Lock_CheckForm(this);">点这里关闭本窗口</a>			
			    </li>
                    

					</div>	

                </div>





            </div>
            <div class="rightct fr">

                <div class="prodinfo">
                    <dl>
                        <dt>售价：

						<?php if($OpusDetail["is_half"] == 0): ?><em id="readpoint"><?php echo ($OpusDetail["price"]); ?>&nbsp;元</em>
						<?php else: ?>
						<em id="readpoint"><?php echo ($OpusDetail["prices"]); ?>&nbsp;L币</em><?php endif; ?>
						&nbsp;&nbsp;<font color="#1abd9b"
                                id="bjzq"></font>
</dt>
<?php if($OpusDetail["is_half"] == 0): ?><a href="<?php echo U('Model/loading',array('opus_id'=>$OpusDetail['opus_id']));?>"style="    color: #fff;background-color: #02d4b1;display: block; margin: 20px 0;width: 300px; height: 56px;line-height: 56px;padding: 0;border-radius: 5px;font-size: 18px;text-align: center;
">素材下载</a>
<?php else: ?>
 <a href="<?php echo U('Model/loading',array('opus_id'=>$OpusDetail['opus_id']));?>"style="    color: #fff;background-color: #02d4b1;display: block; margin: 20px 0;width: 300px; height: 56px;line-height: 56px;padding: 0;border-radius: 5px;font-size: 18px;text-align: center;
    ">免费下载</a><?php endif; ?>





                        <dd>视频类型: <?php echo ($OpusDetail["tip_style"]); ?></dd>
                        <dd>音频: 仅供参考 禁止商用</dd>						
						<dd>上传日期: <?php echo ($OpusDetail["opus_createtime"]); ?></dd>
                    </dl>
                    <div class="btns bdsharebuttonbox">,

                        <a href="javascript:favorite(<?php echo ($OpusDetail["opus_id"]); ?>,<?php echo ($OpusDetail["user_id"]); ?>);" class="sc"
                            id="showsc">收藏</a>
                        <!-- <a href="javascript:share();" class="share bds_more" data-cmd="more" >分享</a>-->
                        <script type="text/javascript">
                            function share() {
                                $('#share').attr('style', 'display:block');
                            }
                        </script>
                        <!--
                   <script type="text/javascript">
                        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","weixin","renren"],"viewText":"分享到：","viewSize":"16"}};
                        with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/__JS__/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                    </script>
                    -->
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
                                class="gz follow" id="follow">关注</a></dd>
                        <dd><i>空间作品数：<?php echo ($OpusCount); ?> </i><a
                                href="<?php echo U('Single/personal',array('user_id'=>$UserInfo['user_id']));?>" target="_blank"
                                class="kj">【TA的空间】</a></dd>
								<dd><i style="padding-left:72px;color: #44a0d5;">实名认证 </i></dd>

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
            <!-- <div class="titles">相关推荐</div>-->
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
                                       半价标识-->
                            <?php if($list['is_half'] == 1): ?><img class="pa" style="left:0;top:0;z-index:10" src="__IMG__/bjicos.png" /><?php endif; ?>
                        </dl><?php endforeach; endif; else: echo "" ;endif; ?>
               

            </div>
        </div>
    </div>


	
	
    <!----->





    </div>
    <input type="hidden" value="<?php echo ($OpusDetail["opus_id"]); ?>" id="opus_id">
    <input type="hidden" value="<?php echo ($UerInfo["user_id"]); ?>" id="seller_id">






	








    <!--检查状态-->
	    <script src="__JS__/tips.js" type="text/javascript"></script>

    <script type="text/javascript" src="__JS__/jquery.reveal.js"></script>
    <script src="__JS__/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript" src="__JS__/jquery.min.js"></script>
	<script type="text/javascript" src="__JS__/blowup.min.js"></script>
    <script type="text/javascript" src="__CS__/demo/scripts/prism.js"></script>
    <script type="text/javascript">
      //  var el = window.document.body;//声明一个变量，默认值为body
     //   window.document.body.onmouseover = function (event) {
     //       el = event.target;//鼠标每经过一个元素，就把该元素赋值给变量el
      //      console.log('当前鼠标在', el, '元素上');//在控制台中打印该变量
     //   }

        var speed = 10;//设置速度

        //var vdo = document.getElementById("视频的id");//获取id
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



        $(document).ready(function () {
		
       
     //   return false;
            $(".demo-img").blowup({
                //background : "#FFFFFF"
            });

        });
	 </script>	
		

	

	
	
	
	
	
	
	

    <!--收藏状态-->
    <script type="text/javascript">
        head.ready('jquery', function () {
            var SiteUrl = $('#SiteUrl').val();
            var opus_id = $('#opus_id').val();

            $.getJSON(SiteUrl + '/index.php/Ajax/FavorJudge?fa_id=' + opus_id + "&" + Math.random(), function (data) {
                if (data.judge == 'true') {
                    $(".sc").html("已收藏");
                } else {
                    $(".sc").html("收藏");
                }
            });
        })




    </script>
    <!--关注状态-->
    <script type="text/javascript">
        head.ready('jquery', function () {
            var SiteUrl = $('#SiteUrl').val();
            var seller_id = $('#seller_id').val();
            $.getJSON(SiteUrl + '/index.php/Ajax/FocusJudge?seller_id=' + seller_id + "&" + Math.random(), function (data) {
                if (data.judge == 'true') {
                    $(".gz").html("已关注");
                } else {
                    $(".gz").html("关注");
                }
            });
        })
    </script>
    <script type="text/javascript">
        head.load('__JS__/show.js', function () { });

    </script>





<Script type="text/javascript">


function popup(popupName){	
	_windowHeight = $(".wrap").height();//获取当前窗口高度
	_windowWidth = $(".wrap").width();//获取当前窗口宽度
	_popupHeight = popupName.height();//获取弹出层高度
	_popupWeight = popupName.width();//获取弹出层宽度
	_posiTop = (_windowHeight - _popupHeight)/10;
	_posiLeft = (_windowWidth - _popupWeight)/8;
	popupName.css({"left": _posiLeft + "px","top":_posiTop + "px","display":"block"});//设置position
}	


function popups(popupName){	

	popupName.css({"left": _posiLeft + "px","top":_posiTop + "px","display":"none"});//设置position
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

	
//点击弹出的批量设置以外的地方时隐藏弹出层
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

    <div class="graybg"></div>
</body>

</html>