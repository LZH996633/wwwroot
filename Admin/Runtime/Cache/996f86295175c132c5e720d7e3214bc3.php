<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome page</title>

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
    </ul>
    </div>
    
    <div class="mainindex">
        <div class="welinfo">
        <span><img src="__IMG__/sun.png" alt="the weather" /></span>
        <b><?php echo ($admin_name); ?><a href="javascript:void(0)" id="welcome">Good morning, welcome to log in to the background information management system</a></b>
        <a href="<?php echo U('Admin/person');?>">Account setting</a>
        </div>


        <div class="welinfo">
        <span><img src="__IMG__/time.png" alt="time" /></span>
        <i>Last time you logged in:<?php echo ($lasttime); ?>
    </i> 
        </div>
        

        

        
        <div class="xline"></div>
        <div class="box"></div> 
        <div class="welinfo">
        <span><img src="__IMG__/dp.png" alt="remind" /></span>
        <b>Today's data：</b>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                <th>Number of visits</th>
                <th>Number of works</th>
                <th>Number of members</th>
                <th>Downloads</th>


                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?php echo ($sum["fang"]); ?></td>
                <td><?php echo ($sum["opus"]); ?></td>
                <td><?php echo ($sum["user"]); ?></td>
                <td><?php echo ($sum["down"]); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="" style="font-size:20px;margin-top:20px;color:#f00;"><b>For more data, please go to the site data view.</b></div>

    </div>
</body>

</html>