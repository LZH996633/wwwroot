<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Left side</title>


<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
<link href="__CS__/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="__JS__/select-ui.min.js"></script>
<script type="text/javascript" src="__ROOT__/Public/admin/editor/kindeditor.js"></script>

<script type="text/javascript">
$(function(){
	//Navigation switch
	$(".menuson .header").click(function(){
		var $parent = $(this).parent();
		$(".menuson>li.active").not($parent).removeClass("active open").find('.sub-menus').hide();

		$parent.addClass("active");
		if(!!$(this).next('.sub-menus').size()){
			if($parent.hasClass("open")){
				$parent.removeClass("open").find('.sub-menus').hide();
			}else{
				$parent.addClass("open").find('.sub-menus').show();
			}
		}
	});

	// Three-level menu click
	$('.sub-menus li').click(function(e) {
        $(".sub-menus li.active").removeClass("active")
		$(this).addClass("active");
    });

	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('.menuson').slideUp();
		if($ul.is(':visible')){
			$(this).next('.menuson').slideUp();
		}else{
			$(this).next('.menuson').slideDown();
		}
	});
})
</script>


</head>

<body style="background:#fff3e1;margin-top:-18px;">
	<div class="lefttop"><span></span>Address book</div>
    
    <dl class="leftmenu">
    <dd>
    <div class="title">
    <span><img src="__IMG__/leftico01.png" /></span>Management
    </div>
    	<ul class="menuson">
        
        <li>
            <div class="header">
            <cite></cite>
            <a href="<?php echo U('Index/welcome');?>" target="rightFrame">Site Information</a>
            <i></i>
            </div>
            <ul class="sub-menus">
            <li><a href="<?php echo U('Index/form');?>" target="rightFrame">Basic content</a></li>
            <li><a href="<?php echo U('Index/tab');?>"  target="rightFrame">Announcement</a></li>
            <li><a href="<?php echo U('Index/detailset');?>"  target="rightFrame">Detailed settings</a></li>
			 </ul>
        </li>
        <li>
            <div class="header">
            <cite></cite>
            <a href="javascript:void(0)" target="rightFrame">Work management</a>
            <i></i>
            </div>
            <ul class="sub-menus">
                <li><a href="<?php echo U('Opus/index');?>" target="rightFrame">List of works</a></li>               
				<li><a href="<?php echo U('Opus/upload');?>"  target="rightFrame">Upload list</a></li>
                <!--<li><a href="<?php echo U('Opus/down');?>"  target="rightFrame">Download record</a></li>-->
				<li><a href="<?php echo U('Opus/count');?>"  target="rightFrame">Works Statistics</a></li>
             </ul>
        </li>
        
        <li>
            <div class="header">
            <cite></cite>
            <a href="javascript:void(0)" target="rightFrame">Member </a>
            <i></i>
            </div>
            <ul class="sub-menus">
            <li><a href="<?php echo U('User/index');?>" target="rightFrame">User list</a></li>
            <li><a href="<?php echo U('User/Certa');?>"  target="rightFrame">Certification</a></li>				
                <!--<li><a href="<?php echo U('User/count');?>"  target="rightFrame">Member Statistics</a>-->
            </ul>
        </li>

        <li>
                <div class="header">
                    <cite></cite>
                    <a href="javascript:void(0)" target="rightFrame">Friendly Link</a>
                    <i></i>
                </div>
            <ul class="sub-menus">
                <li><a href="<?php echo U('Link/index');?>" target="rightFrame">Management</a></li>
            </ul>
            </li>

    </ul>
    </dd>
        
    
    <dd>
    <div class="title">
    <span><img src="__IMG__/leftico02.png" /></span>Message Center
    </div>
    <ul class="menuson">
        <li>
            <div class="header">
                <cite></cite>
                <a href="javascript:void(0)" target="rightFrame">Edit information</a>
                <i></i>
            </div>
            <ul class="sub-menus">
                <li><a href="<?php echo U('Information/edit');?>" target="rightFrame">Send Message</a></li>

            </ul>
        </li>

 </ul>
    </dd> 
    
    
    <dd><div class="title"><span><img src="__IMG__/leftico03.png" /></span>Interface settings</div>
    <ul class="menuson">


        <li>
            <div class="header">
                <cite></cite>
                <a href="javascript:void(0)" target="rightFrame">Verification interface</a>
                <i></i>
            </div>
            <ul class="sub-menus">
                <li><a href="<?php echo U('Interface/eMail_send_form');?>" target="rightFrame">Mailbox</a></li>
            </ul>
        </li>

    </ul>
    </dd>  

    <dd><div class="title"><span><img src="__IMG__/leftico04.png" /></span>System settings</div>
    <ul class="menuson">
        <li>
            <div class="header">
                <cite></cite>
                <a href="javascript:void(0)" target="rightFrame">Administrator</a>
                <i></i>
            </div>
            <ul class="sub-menus">
                <li><a href="<?php echo U('Admin/person');?>" target="rightFrame">Account password</a></li>



            </ul>
        </li>
        <li>
            <div class="header">
                <cite></cite>
                <a href="javascript:void(0)" target="rightFrame">Cache settings</a>
                <i></i>
            </div>
            <ul class="sub-menus">
                <li><a href="<?php echo U('Admin/cache');?>" target="rightFrame">Clear cache</a></li>
               
                                
                

            </ul>
        </li>
    </ul>
    
    </dd>   
    
    </dl>
    
</body>
</html>