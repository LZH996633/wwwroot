<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Announcement</title>

<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
<link href="__CS__/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="__JS__/select-ui.min.js"></script>
<script type="text/javascript" src="__ROOT__/Public/admin/editor/kindeditor.js"></script>
</head>

<body>

    <div class="place">
    <span>Position：</span>
    <ul class="placeul">
    <li><a href="#">Home page</a></li>
    <li><a href="#">Detailed settings</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <form  method="post" action="<?php echo U('Index/setform');?>" role="form" >
	<!--
        <div class="formtitle"><span>提现限制</span></div>
        <ul class="forminfo">
            <li>
                最低提现：<input name="Withdrawal_lowest" type="text" value="<?php echo ($Withdrawal_lowest); ?>" class="dfinput" style="width:200px;" />（￥）
            </li>
            <li>
                最高提现：<input name="Withdrawal_tallest" type="text" value="<?php echo ($Withdrawal_tallest); ?>" class="dfinput" style="width:200px;" />（￥）
            </li>
        </ul>
		-->
        <div class="formtitle"><span>Communication settings</span></div>
        <ul class="forminfo">
            <li>
                Contact number：<input name="Contact_phone" type="text" value="<?php echo ($Contact_phone); ?>" class="dfinput" style="width:200px;" />
            </li>
            <li>
                Contact QQ :&nbsp; &nbsp;<input name="Contact_QQ" type="text" value="<?php echo ($Contact_QQ); ?>" class="dfinput" style="width:200px;" />

            </li>
            <li>
                Contact Email：<input name="Contact_email" type="text" value="<?php echo ($Contact_email); ?>" class="dfinput" style="width:200px;" />
            </li>
          </ul>


        <div class="formtitle"><span>Working arrangements</span></div>
        <ul class="forminfo">
            <li>Company address：<input name="Work_address" type="text" value="<?php echo ($Work_address); ?>" class="dfinput" style="width:200px;" /></li>
            <li>Operating hours：<input name="Work_time" type="text" value="<?php echo ($Work_time); ?>" class="dfinput" style="width:200px;" />Example: Monday to Friday 8：00-17:00</li>
            <li><input  type="submit" class="btn" value="Confirm save"/></li>
        </ul>
    </form>
    </div>

</body>

</html>