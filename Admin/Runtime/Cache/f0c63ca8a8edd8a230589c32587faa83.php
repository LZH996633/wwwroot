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
        <li><a href="#">Basic Information</a></li>
    </ul>
</div>

<div class="formbody">

    <div class="formtitle"><span>Basic Information</span></div>
    <form  method="post" action="<?php echo U('Index/isform');?>" role="form" >
        <ul class="forminfo">
            <li><label for="title">Site title</label><input name="title" type="text" value="<?php echo ($title); ?>" class="dfinput" id="title" /><i>Title cannot exceed 30 characters</i></li>
            <li><label for="key">Keyword</label><input name="key" type="text" value="<?php echo ($key); ?>" class="dfinput" id="key" /><i>Used for multiple keywords, separated</i></li>
            <li><label for="icp">Record number</label><input name="icp" type="text" value="<?php echo ($icp); ?>" class="dfinput" id="icp" /><i></i></li>
            <li><label for="icp">URL</label><input name="url" type="text" value="<?php echo ($url); ?>" class="dfinput" id="url" /><i>Fill in the complete URL, for example: https://www.baidu.com</i></li>

            <li><label>Website switch</label><cite>
                <?php switch($ifopen): case "1": ?><input name="ifopen" type="radio" value="1" checked/>Turn on<?php echo ($repeat); ?>
                        <input name="ifopen" type="radio" value="2"/>Turn off<?php break;?>
                    <?php case "2": ?><input name="ifopen" type="radio" value="1" />Turn on<?php echo ($repeat); ?>
                        <input name="ifopen" type="radio" value="2" checked/>Turn off<?php break; endswitch;?>
            </cite></li>
            <li><label for="des">Site description</label><textarea name="des" cols="" rows="" class="textinput" id="des"><?php echo ($des); ?></textarea></li>
            <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="Confirm save"/></li>
        </ul>
    </form>
</div>


</body>

</html>