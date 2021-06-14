<?php if (!defined('THINK_PATH')) exit();?>
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

<script type="text/javascript">
    KE.show({
        id : 'content_1',
        cssPath : './index.css',
        resizeMode:0
    });
    KE.show({
        id : 'content_2',
        cssPath : './index.css',
        resizeMode:0
    });
  </script>
  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>

<body>

	<div class="place">
    <span>Position：</span>
    <ul class="placeul">
    <li><a href="#">Home page</a></li>
    <li><a href="#">System settings</a></li>
    <li><a href="#">Announcement</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
        <div class="itab">
      	<ul> 
        <li><a href="#tab1" class="selected">About Us</a></li>
        <li><a href="#tab2">Agreement statement</a></li>
      	</ul>
        </div>
         <div id="tab1" class="tabson">

            <form  method="post" action="<?php echo U('Index/tabform');?>" role="form" >
                <ul class="forminfo">
                    <li><label>Website Introduction：<b>*</b></label>
                        <input type="hidden" name="single" value="about">
                    <textarea  id="content_1" name="content" style="width:800px;height:400px;padding:20px;"><?php echo ($about); ?></textarea>
                    </li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="Publish now"/></li>
                </ul>
            </form>
        </div>

    
      	<div id="tab2" class="tabson">
            <form  method="post" action="<?php echo U('Index/tabform');?>" role="form" >
            <ul class="forminfo">
                <li><label>Agreement statement：<b>*</b></label>
                    <input type="hidden" name="single" value="agreement">
                    <textarea  id="content_2" name="content" style="width:800px;height:340px;padding:20px;"><?php echo ($agreement); ?></textarea>
                </li>
                <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="Publish now"/></li>
            </ul>
            </form>
        </div>  
       
	</div> 
 
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
    
    
    
    
    
    </div>


</body>

</html>