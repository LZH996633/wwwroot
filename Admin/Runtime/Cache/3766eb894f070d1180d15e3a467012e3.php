<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>System settings</title>
    
<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
<link href="__CS__/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="__JS__/select-ui.min.js"></script>
<script type="text/javascript" src="__ROOT__/Public/admin/editor/kindeditor.js"></script>
</head>

<body>

<div class="place">
    <span>position：</span>
    <ul class="placeul">
        <li><a href="#">Home page</a></li>
        <li><a href="#">System settings</a></li>
        <li><a href="#">Clear cache</a></li>
    </ul>
</div>

<div class="formbody">

    <div class="formtitle"><span>Front-end cache</span></div>
    <form action="<?php echo U('Admin/cache');?>"  method="post" >
        <ul class="forminfo">
            <input type="hidden" name="cache" value="qian">
            <li><label for="qian_cache">Cache size</label><input  type="text" value="<?php echo ($qian); ?>" class="dfinput" id="qian_cache" disabled/><i></i></li>
           <li><label>&nbsp;</label><input type="submit" class="btn" value="Confirm clear"/></li>
        </ul>
    </form>
</div>
<div class="formbody">
    <div class="formtitle"><span>Background cache</span></div>
    <form  action="<?php echo U('Admin/cache');?>" method="post" >
        <ul class="forminfo">
            <input type="hidden" name="cache" value="hou">
            <li><label for="hou_cache">Cache size</label><input  type="text" value="<?php echo ($hou); ?>" class="dfinput" id="hou_cache" disabled/><i></i></li>
            <li><label>&nbsp;</label><input type="submit" class="btn" value="Confirm clear"/></li>
        </ul>
    </form>
</div>




</body>

</html>