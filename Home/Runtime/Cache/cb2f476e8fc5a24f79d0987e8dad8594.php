<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
    <title>Member Management Center</title>
    <script language="javascript" type="text/javascript" src="__JS__/jquery.min.js"></script>
    <script src="__JS__/layer.js" type="text/javascript"></script>

    <link  href="__CS__/user.css" rel="stylesheet"  type="text/css">
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
        $(document).ready(function(){
            layer.config({
                extend: 'extend/layer.ext.js'

            });
        })
    </script>

<?php
 $pid = I('pid'); if($pid!=''){ cookie('pid',$pid); } $cid = $_COOKIE['pid']; $cate = M('classify'); $cate_list = $cate->where(array('pid'=>'1','type'=>array('neq','half')))->select(); ?>	
	
	
<style>	
.input-file{
    display: inline-block;
    position: relative;
    overflow: hidden;
    text-align: center;
    width: auto;
    background-color: #2c7;
    border: solid 1px #ddd;
    border-radius: 4px;
    padding: 10px 18px;
    font-size: 22px;
    font-weight: normal;
    line-height: 38px;
    color: #fff;
    text-decoration: none;
}

.sa-file{
    display: inline-block;
    position: relative;
    overflow: hidden;
    text-align: center;
    width: auto;
    background-color: #fff;
    border: solid 0px #ddd;
    border-radius: 4px;
    padding: 10px 16px;
    font-size: 20px;
    font-weight: normal;
    line-height: 38px;
    color: #000;
    text-decoration: none;
}

.sa-file1{
    display: inline-block;
    position: relative;
    overflow: hidden;
    text-align: center;
    width: auto;
    background-color: #fff;
    border: solid 0px #ddd;
    border-radius: 4px;
    padding: 10px 16px;
    font-size: 20px;
    font-weight: normal;
    line-height: 38px;
    color: #000;
    text-decoration: none;
}



.input-file input[type="file"] {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 14px;
    background-color: #fff;
    transform: translate(-300px, 0px) scale(4);
    height: 40px;
    opacity: 0;
    filter: alpha(opacity=0);
 }	
 
 
.send_btn {
    display: inline-block;
    display: none;
    float: right;
    /* margin-top: 20px; */
    padding: 7px 20px;
    font-size: 22px;
    color: white;
    margin-right: 330px;
    background: #0091f2;
    border: 1px solid transparent;
    border-radius: 2px;
    /* text-align: center; */
    cursor: pointer;
}
 
.send_btn1 {
    display: inline-block;
    display: none;
    float: right;
    /* margin-top: 20px; */
    padding: 7px 20px;
    font-size: 22px;
    color: white;
    margin-right: 330px;
    background: #0091f2;
    border: 1px solid transparent;
    border-radius: 2px;
    /* text-align: center; */
    cursor: pointer;
}
 
         #file_box {
            min-width: 600px;
            min-height: 300px;
            border: 1px solid #0091f2;
            border-radius: 10px;
            display: inline-block;
            background: #EEE;
            overflow: hidden;
            z-index: 999999;
        }

        #speed {
            width: 0;
            height: 100%;
            background: #0091f2;
            color: white;
            text-align: center;
            line-height: 20px;
            font-size: 16px;
        }

 
 
 
    </style>	
	
	
</head>
<body bgcolor="#efefef" class="pr">
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















    <div class="rtcnt fr">

   <div class="part1 clearfix">
   
   
   
   
   


<div class="rtmain" xmlns="http://www.w3.org/1999/html">
    <div class="hdtitle clearfix">
        <ul class="fl clearfix">
            <?php if($info): ?><li class="on"><a href="javascript:void(0)">Edit works</a></li>
                <?php else: ?><li class="on"><a href="javascript:void(0)">Upload work</a></li><?php endif; ?>

        </ul>
    </div>

        <div class="ulfroms">

            
    <div class="upload-des">
        <ul class="upload-des-list">
            <li class="list-style-blue">To upload packaged files such as AE template, video material package, etc., please click "Add template/compressed package", you need to add two files of compressed package and preview video at the same time</li>
            <li class="list-style-blue">If the account is full of 10 materials that have not been submitted for review, the upload will stop, and the "start" can continue after submitting for review</li>
            <li class="list-style-blue">After uploading the material, please complete the material information as soon as possible, only the material with the information filled in will be reviewed</li>
            <li class="list-style-blue">Please ensure that the work is original and the video is clear. Uploading illegal content will affect the account weight and reduce the material ranking


			</li>
        </ul>

    </div>
			
			

             <div style="padding-bottom:30px"></div>
			
			 
            <div class="wordlist clearfix yuan">
			
			
			

				

				
				
				
		    <form action="" method="" enctype="multipart/form-data">

<a class="input-file input-fileup" href="JavaScript:void(0)">
         + Upload source files<input size="100" type="file" id="File" class="File" name="file" onchange="FileChangeFn1(event)">
		
</a>
<label id="file_size" class="sa-file1"></label> 
<button type="button" name="file" id="a-file" class="send_btn" onclick="UploadFileFn()">Start upload</button>
<div class="fileerrorTip1"></div>
<div class="showFileName1"></div>		



        <div class="clear"></div>
       </form>			
							
		
				
				
			
				
				
	    <form action="" method="" enctype="multipart/form-data">

<a class="input-file input-fileup1" href="JavaScript:void(0)">
         + Upload preview video<input size="100"  type="file" id="File1" class="File" name="file" onchange="FileChangeFn(event)">
		
</a>
<label id="file_size1" class="sa-file"></label> 

<button type="button" name="file" id="a-file" class="send_btn1" onclick="UploadFileFns()">Start upload</button>
<div class="fileerrorTip12"></div>
<div class="showFileName12"></div>		



        

        <div class="clear"></div>
       </form>	

				 
				 </div>
                			

				
            </div>
	

            <div  id="imgbt" style="width:200px; height:160px;display:none">    <!--4Figure preview shows the control frame-->
	
				<li>
                   <a href="javascript:;" onClick="$('#yulan1').click();"> <img id="img1" width="280" height="160" src="<?php echo ($info["opus_pic_big"]); ?>" style="display:none" BORDER=0></a>
				   <img id="img2" width="280" height="160" src="<?php echo ($info["opus_pic_big"]); ?>" style="display:none" BORDER=0>
				   
                </div>
               <div id="yulan1_sTip" style="display:none"></div>

                <input type="file" id="yulan" name="file"  style="display:none"  onchange="ajaxFileUpload('yulan')">


                <input type="file" id="yulan1" name="file"  style="display:none"  onchange="ajaxFileUpload('yulan1')">

         
           
			
			
			 <div  id="imgb" style="width:100%; height:100px; background-color:#F5F5F5; text-align:center; ">    <!--Upload display control frame-->
	
                <p id="pid" style="padding-top:30px;">No upload tasks yet..</p>
  
			          <div class="speed_box">
                  <div id="speed"></div>
  
                       </div>
			  
			  
			  
			  
			</div>

		     <div id="btnsd1" class="btnsd1" style="padding-left:230px; padding-top:30px; display:none" >&nbsp;<input value="Submit works" type="submit" class="pay-btn1" onclick=""/>
			 </div>	

    <form action="<?php echo U('Service/MaterialUploads');?>" method="post" id="up_form" target="_blank">
  <div class="ulfroms">			 
			            <ul class="formsd biaoti" style="display:none">
			
                <li><label>Title of Work：</label><input type="text" class="webtxt"  id="opus_title" name="opus_title" value="<?php echo ($info["opus_title"]); ?>"><span style="line-height:34px;margin-left:10px;"></span></li>
                <li><label>The price of the work：</label><input type="text" class="webtxt"  id="opus_price" name="opus_price" value="<?php echo ($info["price"]); ?>"><span style="line-height:34px;margin-left:10px;">Gold</span></li>
                <li><label>The Gold coins of the work：</label><input type="text" class="webtxt"  id="opus_prices" name="opus_prices" value="<?php echo ($info["prices"]); ?>"><span style="line-height:34px;margin-left:10px;">Gold coins</span></li>
                <li><label>Search tags：</label><input type="text" class="webtxt"  id="opus_keyword" name="opus_keyword" value="<?php echo ($info["opus_keyword"]); ?>"><span style="line-height:34px;margin-left:10px;"></span></li>

                <li><label>Belonging to the column：</label>
                   <select style="width:200px;height:30px;" name="cate" id="cate">
                       <?php if($edit_cate): ?><option value="<?php echo ($edit_cate["path"]); ?>-<?php echo ($edit_cate["cid"]); ?>" ><?php echo ($edit_cate["name"]); ?></option><?php endif; ?>
                      <?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["path"]); ?>-<?php echo ($list["cid"]); ?>" ><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>
                    

                      
                    
                    </li>





<div class="wordlist clearfix">
    <u style="padding-left:190px; font-size:16px;" >
        <label>Free to convert to gold coins：</label>
            <?php if($info['is_half'] == 1): ?><input type="checkbox" id="is_half" name="is_half" checked></li>
                <?php else: ?><input type="checkbox" id="is_half" name="is_half"></li><?php endif; ?>
            &nbsp;
            <label>Transparent channel：</label>
<?php if($info['is_typ'] == 1): ?><input type="checkbox" id="is_type" name="is_type" checked></li>
    <?php else: ?><input type="checkbox" id="is_type" name="is_type"></li><?php endif; ?>
&nbsp;
<label>Seamless loop：</label>
<?php if($info['is_typ1'] == 1): ?><input type="checkbox" id="is_type1" name="is_type1" checked></li>
    <?php else: ?><input type="checkbox" id="is_type1" name="is_type1"></li><?php endif; ?>
</u>
</div>



					
					
                 </ul> 

            <?php if($info): ?><input type="hidden" name="edit" value="true">
                <input type="hidden" name="opus_id" value="<?php echo ($info["opus_id"]); ?>"><?php endif; ?>

			
 <input type="hidden" id="yuanjian_s" name="yuanjian" value="<?php echo ($info["opus_source"]); ?>">			
				
    <input type="hidden" id="zhanshi_s" name="zhanshi" value="<?php echo ($info["opus_pic"]); ?>">	
	
   <input type="hidden" id="yulan_s" name="yulan" value="<?php echo ($info["opus_pic_big"]); ?>">	

                <input type="hidden" id="yulan1_s" name="yulan1" value="<?php echo ($info["opus_pic_big"]); ?>">
   
	</div>	
	
	
	<div class="btnsd" style="display:none"><input value="Submit review" type="submit" class="pay-btn" /></div>
	
    </form>
    <form action="<?php echo U('Upload/upload');?>" method="post" enctype="multipart/form-data" id="j-uploadFile-form" style="position: absolute;left: -9999px;top: -9999px;" target="j-uploadFile-iframe"></form>
    <iframe id="j-uploadFile-iframe" name="j-uploadFile-iframe" style="position: absolute;left: -9999px;top: -9999px;"></iframe>
</div>





   </div>

</div>

</div>





<script>

        //When the file is selected
        function FileChangeFn(event) {
         //   $('.opst_txt').text('Reselect file');
            $('.send_btn1').show();
            var event = event || window.event,
                dom = '',
                file = $("#File1").get(0).files[0],
                otype = file.type || 'Get failed',
                osize = file.size / 1054000,
                ourl = window.URL.createObjectURL(file); //Temporary file address
            $('#file_type1').text("Choose upload file type：" + otype);
            $('#file_size1').text("Upload file size, total" + osize.toFixed(2) + "MB。");
            pid.innerHTML = '<span style="color: red">Ready to upload</span>';
            console.log("file type：" + otype); //file type
            console.log("File size：" + osize); //File size

            if ('video/mp4' == otype || 'video/avi' == otype || 'video/mov' == otype || 'video/MOV' == otype) {
			 $('.send_btn1').show();
                dom = '<video id="video" width="100%" height="100%" controls="controls" autoplay="autoplay" src=' + ourl + '></video>';
            }

            $('#file_box').html(dom);
        };

        var uploadUrl = 'http://127.0.0.1/index.php/Upload/upload';

        //Investigate the attachment upload situation, this method is executed once every 0.05-0.1 seconds
        function OnProgRess(event) {
            var event = event || window.event;
            console.log(event);  //Event object
         //   console.log("Already uploaded：" + event.loaded); //Uploaded size (uploaded size, after uploading, it will be equal to the total size of attachments)
            //console.log(event.total);  //Total size of attachments (fixed)
            var loaded = Math.floor(100 * (event.loaded / event.total)); //Percentage already uploaded  
            $("#speed").html(loaded + "%").css("width", loaded + "%");
        };

        //Start uploading files
        function UploadFileFns() {

            $('.speed_box').show();
            var File = $("#File1").get(0).files[0]; //input file tag

            pid.innerHTML = '<span style="color: red">Uploading.. Please don\'t click the button arbitrarily!</span>';

            var formData = new FormData(); //Create FormData object
            var xhr = $.ajaxSettings.xhr(); //Create and return the callback function of the XMLHttpRequest object (the method in $.ajax in jQuery)
            formData.append("file", File); //Will upload the name attribute name (note: it must be the same as the name in the file element), and append the file element to the FormData object


			  if ($("#speed").html()=="100%") {
			            pid.innerHTML = '<span style="color: red">Please wait a moment to start image processing..</span>';
               }	

			   
            $.ajax({
                type: "POST",
                url: uploadUrl, // Backend server upload address
                data: formData, // formData
                cache: false, // Whether to cache
                async: true, // Whether to execute asynchronously
                processData: false, // Whether to process the sent data (must be false to avoid jQuery's default processing of formdata)
                contentType: false, // Whether to set the Content-Type request header
                xhr: function () {
                    if (OnProgRess && xhr.upload) {
                        xhr.upload.addEventListener("progress", OnProgRess, false);
                        return xhr;
                    }
                },
                success: function (returndata) {


                    returndata=JSON.parse(returndata);
                   // console.log(returndata);
                    if (returndata.error == 0) {								
                    //  layer.msg(data.msg,{time:1000});
					   alert(returndata.message);
                        $("#speed").html("Uploaded successfully");
            pid.innerHTML = '<span style="color: red">No upload tasks yet..</span>';	

						if(returndata.video1){
                                $('#yulan_s').attr('value',returndata.img);
                                $('#yulan1_s').attr('value',returndata.img5);
                                $('#zhanshi_s').attr('value',returndata.video1);
                                $('#img1').attr('src',returndata.img5);
								 $('.btnsd1').attr('style','display:block')
                             }
							   
							   
							//   else if(returndata.img8){ 
							//   $('#img1').attr('src',returndata.img8);
							//   $('#yulan1_s').attr('value',returndata.img8);
							//   $('#img1').attr('style','display:none')

							//  }  
			
                    } else if (returndata.error == 6) {
                        alert(returndata.message);
            pid.innerHTML = '<span style="color: red">Duplicate file, please re-select file！</span>';						
                    } else {
                        alert(returndata.message);
                    }
                    //   } catch (e) {
                    //alert('Upload failed, please try again!');
                    //   }
                    //  }


                },
                error: function (returndata) {
                    $("#speed").html("upload failed");
                    console.log(returndata)
                    alert('Please configure the background service correctly！');
                }
            });



        };
    </script>	








<script type="text/javascript">
    head.ready('formvalidator',function(){

      $.formValidator.initConfig({autotip:true,formid:"up_form",onerror:function(msg){}});
     $("#opus_title").formValidator({onshow:"Please use concise, clear headlines",onfocus:"Enter the name of the work",oncorrect:" Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});
        $("#opus_price").formValidator({onshow:"Price",onfocus:"Please enter the price",oncorrect:"Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});
      $("#opus_keyword").formValidator({onshow:"This item is used to search for works, please fill in short words, separated by (-)",onfocus:"Add keywords separated by (-)",oncorrect:"Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});
       if($('.opus_method').eq(0).attr('checked')=='checked'){
            $("#yuanjian_s").formValidator({onshow:"，stand by 'rar', 'zip' format，The volume is less than 300MB",onfocus:"Use concise titles",oncorrect:"Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});
        }
    // $("#zhanshi_s").formValidator({onshow:"Waiting to upload, support'flv','mov','mp4' format",onfocus:"Use concise titles",oncorrect:"Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});
	 
  //   $("#yulan1_s").formValidator({onshow:"Waiting to upload, support'flv','mov','mp4' format",onfocus:"Use concise titles"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"})    
       if($('.opus_method').eq(1).attr('checked')=='checked'){
             $("#down_url").formValidator({onshow:"File download link",onfocus:"Fill in the link",oncorrect:"Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});

       }

        // $("#cate").formValidator({onshow:"Owned column, required",onfocus:"Select Category",oncorrect:"Filled"}).regexValidator({regexp:"notempty",datatype:"enum",onerror:"Required"});





    });
</script>



<script>
        $(function(){
            $(".input-fileup").on("change","input[type='file']",function(){
                var filePath=$(this).val();
                if(filePath.indexOf("rar")!=-1 || filePath.indexOf("zip")!=-1){
                    $(".fileerrorTip1").html("").hide();
                    var arr=filePath.split('\\');
                    var fileName=arr[arr.length-1];
                    $(".showFileName1").html(fileName);
               //     $(".fileerrorTip1").html("").hide();	

				
                }else{
                    $(".showFileName1").html("");
                    $(".fileerrorTip1").html("The type of the file you uploaded is incorrect. The source code is in rar zip format!").show();
                    return false
                }
            })
			
			
            $(".input-fileup1").on("change","input[type='file']",function(){
                var filePath=$(this).val();
                if(filePath.indexOf("mp4")!=-1 || filePath.indexOf("mov")!=-1  || filePath.indexOf("avi")!=-1){
                    $(".fileerrorTip1").html("").hide();
                    var arr=filePath.split('\\');
                    var fileName=arr[arr.length-1];
                    $(".showFileName12").html(fileName);
                    $(".fileerrorTip12").html("").hide();					
                }else{
                    $(".showFileName12").html("");
                    $(".fileerrorTip12").html("Your uploaded work is incorrectly in mp4 mov avi format!").show();
                    return false
                }
            })
						
			
			
			
        })
    </script>



	

    <script>

        //When the file is selected
        function FileChangeFn1(event) {
            $('.opst_txt').text('Reselect file');
            $('.send_btn').show();
            var event = event || window.event,
                dom = '',
                file = $("#File").get(0).files[0],
                otype = file.type || 'Get failed',
                osize = file.size / 1054000,
                ourl = window.URL.createObjectURL(file); //Temporary file address
            $('#file_type').text("Choose upload file type：" + otype);
            $('#file_size').text("Upload file size, total" + osize.toFixed(2) + "MB。");
            pid.innerHTML = '<span style="color: red">Ready to upload</span>';
            console.log("File type：" + otype); //file type
            console.log("File size：" + osize); //File size

            if ('video/mp4' == otype || 'video/avi' == otype || 'video/x-msvideo' == otype) {
                dom = '<video id="video" width="100%" height="100%" controls="controls" autoplay="autoplay" src=' + ourl + '></video>';
            }
            if ('audio/mp3' == otype || 'audio/wav' == otype || 'audio/x-m4a' == otype) {
                dom = '<audio id="audio" width="100%" height="100%" controls="controls" autoplay="autoplay" loop="loop" src=' + ourl + ' ></audio>';
            }
            if ('image/jpeg' == otype || 'image/png' == otype || 'image/gif' == otype) {
                dom = '<img id="photo" width="100%" height="100%" alt="I am an image file" src=' + ourl + ' title="" />';
            }
            $('#file_box').html(dom);
        };

        var uploadUrl = 'http://127.0.0.1/index.php/Upload/upload';

        //Investigate the attachment upload situation, this method is executed once every 0.05-0.1 seconds
        function OnProgRess(event) {
            var event = event || window.event;
            //console.log(event);  //Event object
            console.log("Already uploaded：" + event.loaded); //Uploaded size (uploaded size, after uploading, it will be equal to the total size of attachments)
            //console.log(event.total);  //Total size of attachments (fixed)
            var loaded = Math.floor(100 * (event.loaded / event.total)); //Percentage already uploaded  
            $("#speed").html(loaded + "%").css("width", loaded + "%");
        };

        //Start uploading files
        function UploadFileFn() {

            $('.speed_box').show();
            var File = $("#File").get(0).files[0]; //input file tags

            pid.innerHTML = '<span style="color: red">Uploading.. Please do not click the button arbitrarily!！</span>';

            var formData = new FormData(); //Create FormData object
            var xhr = $.ajaxSettings.xhr(); //Create and return the callback function of the XMLHttpRequest object (the method in $.ajax in jQuery)
            formData.append("file", File); //Will upload the name attribute name (note: it must be the same as the name in the file element), and append the file element to the FormData object

    //  var xhrs = formData.append("file", File);
          //  console.log(xhrs);

            $.ajax({
                type: "POST",
                url: uploadUrl, // Backend server upload address
                data: formData, // formData data
                cache: false, // Whether to cache
                async: true, // Whether to execute asynchronously
                processData: false, // Whether to process the sent data (must be false to avoid jQuery's default processing of formdata)
                contentType: false, // Whether to set the Content-Type request header
                xhr: function () {
                    if (OnProgRess && xhr.upload) {
                        xhr.upload.addEventListener("progress", OnProgRess, false);
                        return xhr;
                    }
                },
                success: function (returndata) {


                    returndata=JSON.parse(returndata);

                    if (returndata.error == 0) {

					   alert(returndata.message);

                        $("#speed").html("Uploaded successfully");
            pid.innerHTML = '<span style="color: red">No upload tasks yet..</span>';							
					 $('#yuanjian_s').attr('value',returndata.filePath);
						
                    } else if (returndata.error == 6) {
                        alert(returndata.message);
            pid.innerHTML = '<span style="color: red">Duplicate file, please re-select file！</span>';								
                    } else {
                        alert(returndata.message);
                    }
                    //   } catch (e) {
                    //alert('Upload failed, please try again!');
                    //   }
                    //  }


                },
                error: function (returndata) {
                    $("#speed").html("upload failed");
                    console.log(returndata)
                    alert('Please configure the background service correctly！');
                }
            });



        };
    </script>



























  <?php if($info['opus_fileurl']): ?><script type="text/javascript">

        $('.yuan').attr('style','display:none');
        $('.down_url').attr('style','display:block')
    </script>

    <?php else: ?>
    <script type="text/javascript">

        $('.yuan').attr('style','display:block');
        $('.down_url').attr('style','display:none')
    </script><?php endif; ?>
<!--File way-->
<script type="text/javascript">

  $('.opus_method').click(function () {
      var i =  $(this).index();

        if(i=='1'){
            $('.yuan').attr('style','display:block')
            $('.down_url').attr('style','display:none')
        }if(i=='2'){

            $('.down_url').attr('style','display:block')
            $('.yuan').attr('style','display:none')
        }

    })
	
$(function(){
//var btn = document.getElementById("btn"); 

//General method 
btnsd1.onclick = function() { 

alert("Entering the submission page, please confirm the operation..");
$('#imgbt').attr('style','display:block')				
$('#img1').attr('style','display:block')
$('.biaoti').attr('style','display:block')
$('.btnsd').attr('style','display:block')
$('.yuan').attr('style','display:none');
$('#yuanjian_sTip').attr('style','display:none');
$('.yuan').attr('style','display:none');
$('#yuanjian_sTip').attr('style','display:none');
//$('#yulan1_sTip').attr('style','display:block')	
 $('.btnsd1').attr('style','display:none')
}

  yuanjian.onchange = function() { 

//alert("Uploading, please confirm the operation..");
//$('#imgbt').attr('style','display:block')		
ajaxFileUpload('yuanjian')		
 pid.innerHTML = '<span style="color: red">uploading</span>';
 $('#jiance').attr('src','__IMG__/s002.gif');
}

  zhanshi.onchange = function() { 

ajaxFileUpload('zhanshi')		
 pid.innerHTML = '<span style="color: red">uploading</span>';
 $('#jiance').attr('src','__IMG__/s002.gif');
 $('.btnsd1').attr('style','display:block')
}

  yulan1.onchange = function() { 

ajaxFileUpload('yulan1')		
 pid.innerHTML = '<span style="color: red">uploading</span>';
 $('#jiance').attr('src','__IMG__/s002.gif');
 $('.btnsd1').attr('style','display:block')
}


 })	






 
	
</script>

































<script type="text/javascript">
   function ajaxFileUpload(name){

               var oInp = $('#'+name);
               var oNewInp = oInp.clone(true);
               var oForm = $('#j-uploadFile-form');
               var oIframe = $('#j-uploadFile-iframe');
               oInp.before(oNewInp);

               oInp.removeAttr('id').removeAttr('class').appendTo(oForm);

               oIframe.on('load', function(e){
                   oIframe.off('load');
                   var sRet = this.contentWindow.document.body.innerHTML;
                   oForm.empty();
                   if (sRet && sRet.length) {
                       try {
                           var oRet = $.parseJSON(sRet);
                           if (oRet.error == 0) {
                           // $('#yulan_s').val(oRet.img);

                               $('#yuanjian_s').attr('value',oRet.filePath);
                            //  if($('#yuanjian_s').attr('value',oRet.filePath)!=""){
							   
							 
                               pid.innerHTML = 'No upload tasks yet..';
                               $('#jiance').attr('src','__IMG__/s001.png');
							//  }

							$('#yuanjian_sTip').html('<span style="color: red">upload completed</span>');
							
							
							   
							  if(oRet.video1){
                                $('#yulan_s').attr('value',oRet.img);
                                $('#yulan1_s').attr('value',oRet.img5);
                                $('#zhanshi_s').attr('value',oRet.video1);
                                $('#img1').attr('src',oRet.img5);
							   pid.innerHTML = 'No upload tasks yet..';
                               $('#jiance').attr('src','__IMG__/s001.png');
                               }else if(oRet.img8){ 
							   $('#img1').attr('src',oRet.img8);
							   $('#yulan1_s').attr('value',oRet.img8);
							   $('#img2').attr('style','display:block')
							   $('#img1').attr('style','display:none')
							   pid.innerHTML = 'No upload tasks yet..';
                               $('#jiance').attr('src','__IMG__/s001.png');
							  }  

                               layer.msg(oRet.message);

                               /*$('#'+name).attr('src',oRet.filePath);
                               $("#img_in").attr('src',oRet.filePath);
                               $("#service_img").attr('src',oRet.filePath)*/
                           } else if(oRet.error == 6) {
                               layer.msg(oRet.message);
							   pid.innerHTML = 'No upload tasks yet..';
                               $('#jiance').attr('src','__IMG__/s001.png');
							    $('.btnsd1').attr('style','display:none')
                           }
                       } catch (e) {
                           //alert('Upload failed, please try again!');
                       }
                   }
               });

               oForm.submit();


   }

</script>