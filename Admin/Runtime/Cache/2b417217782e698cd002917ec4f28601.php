<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to log in to the background management system</title>
<link href="__CS__/style.css" rel="stylesheet" type="text/css" />

<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
<link href="__CS__/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="__JS__/select-ui.min.js"></script>
<script type="text/javascript" src="__ROOT__/Public/admin/editor/kindeditor.js"></script>
<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 

</head>

<body style="background-color:#df7611; background-image:url(__IMG__/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>Log in to the background management interface platform</span>
    <ul>
    <li><a href="__ROOT__/index.php?m=Index&a=index">Back to homepage</a></li>


    </ul>    
    </div>
    
    <div class="loginbody">
        <span class="systemlogo"></span>
        <div class="loginbox">
        <form  role="form"   method="post" action="<?php echo U('Public/dologin/');?>" style="margin-top: 20px">
            <ul>
                <li><input name="admin_name" type="text" class="loginuser" value="" onclick="JavaScript:this.value=''"/></li>
                <li><input name="pwd" type="password" class="loginpwd" value="" onclick="JavaScript:this.value=''"/></li>
                <li><input name="" type="submit" class="loginbtn" value="Log in" />
                
            </ul>
        </form>
        </div>
    </div>
    <div class="loginbm">Zhihui lei </div>
	
    
</body>

</html>