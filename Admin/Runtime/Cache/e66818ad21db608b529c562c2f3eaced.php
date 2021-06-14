<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Cooperative management</title>
	<link href="__CS__/style.css" rel="stylesheet" type="text/css"/>
	<style>
		form p{
			line-height: 36px;
		}
		.inp{
			display: inline-block;
			vertical-align: middle;
			width: 300px;
			height: 30px;
			border: 1px solid #ccc;
		}
		.select{
			border: 1px solid #ccc;
		}

		form button{
			display: inline-block;
			margin-left: 20px;
			height: 30px;
			padding: 0 10px;
			line-height: 30px;
			text-align: center;
			border: 1px solid #ccc;
		}
	</style>
	<script type="text/javascript" src="__JS__/jquery-1.11.0.min.js"></script>
</head>
<body>

<div class="place">
	<span>position：</span>
	<ul class="placeul">
		<li><a href="#">Home page</a></li>
		<li><a href="#">Cooperative management</a></li>
		<li><a href="#">Cooperation link</a></li>
	</ul>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click").click(function(){
            $(".tip").fadeIn(200);
        });
        function suc() {
            $(".tip").fadeIn(200);
        }

        $(".tiptop a").click(function(){
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function(){
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function(){
            $(".tip").fadeOut(100);
        });

    });
</script>
<div class="rightinfo">
	<form action="<?php echo U('add');?>" method="post">
		<div class="formtitle"><span>Add to</span></div>
		<ul class="forminfo">
			<li>
				Title：<input name="link_name" type="text" value="<?php echo ($link["link_name"]); ?>" class="dfinput" style="width:200px;" />
			</li>
			<li>
				Link：<input name="link_url" type="text" value="<?php echo ($link["link_url"]); ?>" class="dfinput" style="width:200px;" />
			</li>
			<li>
				Image：<input name="link_logo" id="j-pic-url" readonly class="dfinput" style="width:200px;" value="<?php echo ($link["link_logo"]); ?>"/><input type="file" name="file" id="j-file">
			</li>
			<!--<li>
				Logo：<input name="ad_locationpic" type="text" value="<?php echo ($ad["ad_locationpic"]); ?>" class="dfinput" style="width:200px;" />
			</li>-->
			<li>
				Remarks：	</li>
			<li>
				<textarea name="link_remark"  class="dfinput" style="width:300px;height: 150px;resize: none" ></textarea>
			</li>
			<li><input  type="submit" class="btn" value="Confirm save"/></li>
		</ul>
	</form>
</div>
<form action="<?php echo U('Upload/upload');?>" method="post" enctype="multipart/form-data" id="j-uploadFile-form" style="position: absolute;left: -9999px;top: -9999px;" target="j-uploadFile-iframe"></form>
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
                            $('#j-pic-url').val(oRet.filePath);
                        } else {
                            alert(oRet.message);
                        }
                    } catch (e) {
                        alert('Upload failed, please try again!');
                    }
                }
            });

            oForm.submit();
        });
    });
</script>
<div class="tip">
	<div class="tiptop"><span>Prompt information</span><a onclick="cancel()"></a></div>

	<div class="tipinfo">
		<span><img src="__IMG__/ticon.png"/></span>

		<div class="tipright">
			<p>Do you confirm the modification of the information? ？</p>
			<cite>If yes, please click the OK button, otherwise please click Cancel.</cite>
		</div>
	</div>

	<div class="tipbtn">
		<input name="" type="button" class="sure" value="Determine" onclick="sure()"/>&nbsp;
		<input name="" type="button" class="cancel" value="Cancel" onclick="cancel()"/>
	</div>

</div>
</body>

</html>