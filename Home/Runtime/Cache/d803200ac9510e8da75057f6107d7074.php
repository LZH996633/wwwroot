<?php if (!defined('THINK_PATH')) exit();?>    <title>Information modification-avatar modification</title>

    <div class="rtmain">

        <div class="uspictm clearfix">
            <div class="title">
                <ul class="clearfix">
                    <li id="fit" class="on"><a href="javascript:void (0)">Avatar management</a></li>
                    <li><a href="javascript:void (0)">Password</a></li>
			
                </ul>
            </div>
            <div class="list_show">
                <div class="lists">
                <div class="memo clearfix" >
                <div class="clearfix fl" style="margin-bottom:20px">
                    <div id="myContent" style="border:1px solid;width: 500px;height: 400px;background: url(__IMG__/header.png) no-repeat center ">
                        <form action="" method="post" id="head_img" style="position:relative" enctype="multipart/form-data">
                            <input type="hidden" class="inp" name="ad_pic" id="j-pic-url" readonly>
                            <input type="file" name ="file" id="j-file" style="width:227px; height:64px; opacity:0; position:absolute; left:120px; z-index:999; top:160px;">
                        </form>
   <div style="position:absolute;height:150px;width:200px;border: dashed 1px;margin-top: 10px;margin-left: 150px;overflow: hidden">
       <img id ="yulan" src="<?php echo ($info["user_pic"]); ?>" onerror="this.src='__IMG__/useravatar.png'" style="clear: both; display: block; margin:auto">
   </div>

                    </div>
             </div>
                <ul class="clearfix fl" id="avatarlist" style="margin-left:150px;" >
                    <li>
                        <img src="__IMG__/nophoto.gif" height="144" width="144" onerror="__IMG__/nophoto.gif"><br />
                        Avatar180 x 180					</li>
                    <li>
                        <img src="__IMG__/nophoto.gif" height="72" width="72" onerror="__IMG__/nophoto.gif"><br />
                        Avatar90 x 90					</li>
                    <li>
                        <img src="__IMG__/nophoto.gif" height="36" width="36" onerror="__IMG__/nophoto.gif"><br />
                        Avatar45 x 45					</li>
                    <li>
                        <img src="__IMG__/nophoto.gif" height="24" width="24" onerror="__IMG__/nophoto.gif"><br />
                        Avatar30 x 30					</li>
                </ul>
            </div>
                </div>
                <div class="lists" style="display: none;">
                    <div class="contms">
                        <form id="myform" action="<?php echo U('Service/ModifyPass');?>" method="post">
                            <dl>
                                <dt>Your login name：<i><?php echo ($info["user_name"]); ?></i>，The password can be 6-20 English letters, numbers and "_", but the underscore cannot be at the end.</dt>

                                <dd><label>Old password：</label><span><input type="password" name="password" id="password" class="webtxt" placeholder=""></span><div id="passwordTip" ></div></dd>

                                <dd><label>New password：</label><span><input type="password" name="new_password" id="newpassword" class="webtxt" placeholder=""></span><div id="newpasswordTip" ></div></dd>
                                <dd><label>Repeat new password：</label><span><input type="password" id="renewpassword" class="webtxt" placeholder=""></span><div id="renewpasswordTip" ></div></dd>

                                <dd><input type="submit"  id="do_submit" class="webtn" value="Save"></dd>
                            </dl>
                        </form>
                    </div>
                </div>

                <div class="lists" style="display: none;">

                </div>
            </div>
        </div>
    </div>
    <form action="<?php echo U('Upload/uploads');?>" method="post" enctype="multipart/form-data" id="j-uploadFile-form" style="position: absolute;left: -9999px;top: -9999px;" target="j-uploadFile-iframe"></form>
    <iframe id="j-uploadFile-iframe" name="j-uploadFile-iframe" style="position: absolute;left: -9999px;top: -9999px;"></iframe>
    <script>
        $(function(){
            $('#j-file').change(function(){
                var oInp = $(this);
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

                                $.getJSON('/index.php/Ajax/ModifyPic?pic='+oRet.filePath,function (data) {
                                 if(data.status==1){
                                     layer.msg(data.msg,{time:1000});
                                 }else{
                                     layer.msg(data.msg,{time:1000})
                                 }
                                  });
                                $('#j-pic-url').val(oRet.filePath);
                                $("#yulan").attr('src',oRet.filePath)
                                $("#img_in").attr('src',oRet.filePath)
                                $("#service_img").attr('src',oRet.filePath)
                            } else {
                                //alert(oRet.message);
                            }
                        } catch (e) {
                            //alert('Upload failed, please try again!');
                        }
                    }
                });

                oForm.submit();
            });
        });
    </script>
    <!--Tab-->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".title ul li").click(function(){
                var i = $(this).index();
                $(this).attr('class','on').siblings().attr('class','');
                $('.lists').eq(i).attr('style','display:block').siblings().attr('style','display:none');

            })
        });



    </script>

    <!--form validation-->
  <script type="text/javascript">
    $(function(){
            $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
            $("#password").formValidator({onshow:"Please enter the password",onfocus:"Between 6-20 digits"}).inputValidator({min:6,max:20,onerror:"Between 6-20 digits"});
            $("#newpassword").formValidator({onshow:"Please enter the password",onfocus:"Between 6-20 digits"}).inputValidator({min:6,max:20,onerror:"Between 6-20 digits"}).ajaxValidator({
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
            $("#renewpassword").formValidator({onshow:"Confirm password",onfocus:"Please enter a different password twice.",oncorrect:"Password input is consistent"}).compareValidator({desid:"newpassword",operateor:"=",onerror:"Please enter a different password twice."});

        });
   /*  $("#do_submit").click(function () {
         //alert(123)
     })*/
    </script>
    <!--Internal asynchronous call-->
    <script type="text/javascript">
        $(document).ready(function () {

            $('.inter_chanView').click(function () {

                var action = $(this).attr('data-value');

                $.ajax({
                    type: "get",
                    async: true,
                    url: "/index.php/Service/Ajax?action="+action+"&b="+Math.random(),
                    dataType: "html",
                    data: '',
                    cache:false,

                    success: function (msg) {

                        var show = $('.rtcnt');
                        show.text('');
                        show.prepend(msg)
                    },
                    error:  function (msg){
                        ////alert(msg.status)
                    }
                })
            });
        })

    </script>