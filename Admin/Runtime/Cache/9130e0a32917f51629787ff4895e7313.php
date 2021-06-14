<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Top</title>

<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
<link href="__CS__/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="__JS__/select-ui.min.js"></script>
<script type="text/javascript" src="__ROOT__/Public/admin/editor/kindeditor.js"></script>
<script type="text/javascript">
$(function(){	
	//Top navigation toggle
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>


</head>

<body style="background:url(__IMG__/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="<?php echo U('Index/index');?>" target="_parent"><img src="__IMG__/logo.png" title="System Home" /></a>
    </div>
        
    <ul class="nav" style="margin-top:-10px;" >
    <li><a href="<?php echo U('Index/welcome');?>" target="rightFrame" class="selected" style="text-decoration: none;" ><img src="__IMG__/icon01.png" title="Workbench" /><h2>Workbench</h2></a></li>
    <li><a href="<?php echo U('Opus/index');?>" target="rightFrame"  style="text-decoration: none;"><img src="__IMG__/icon02.png" title="Work management" /><h2>Work</h2></a></li>
    <li><a href="<?php echo U('User/index');?>"  target="rightFrame"  style="text-decoration: none;"><img src="__IMG__/icon03.png" title="Member Management" /><h2>Member</h2></a></li>

    <li><a href="<?php echo U('Index/detailset');?>"  target="rightFrame"  style="text-decoration: none;"><img src="__IMG__/icon06.png" title="Specific settings" /><h2>Details</h2></a></li>
    </ul>
            
    <div class="topright">    
    <ul>

    <li><a href="<?php echo U('Public/logout');?>" target="_parent">Sign out</a></li>
    </ul>
     
    <div class="user">
    <span><?php echo ($admin_name); ?></span>
        <a href="<?php echo U('User/withdrawal');?>" target="rightFrame">

    </div>    
    
    </div>

</body>
</html>