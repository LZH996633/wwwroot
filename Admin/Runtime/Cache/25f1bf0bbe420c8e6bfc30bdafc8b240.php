<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Management</title>
<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
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


 /* Picture enlargement tooltip */
#tooltip{
width:550px;
higher:550px;
	position:absolute;
	border:1px solid #eeeeee;
	background:#eeeeee;
	padding:1px 1px 1px 1px;
	display:none;

}


</script>


</head>


<body>

	<div class="place">
    <span>Position：</span>
    <ul class="placeul">
    <li><a href="#">Home page</a></li>
    <li><a href="#">Member Management</a></li>
    <li><a href="#">Real name authentication</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
        <ul class="toolbar">
            <li class="click"><span><img src="__IMG__/t01.png" /></span>Add to</li>
            <li class="click"><span><img src="__IMG__/t02.png" /></span>Modify</li>
            <li><span><img src="__IMG__/t03.png" /></span>Delete</li>
        </ul>
        <div style="float:right;width:400px;">
        <form action="__APP__?m=User&a=Certa" method="post"  >
            <ul class="">
                <li><?php echo ($repeat); ?><input name="searchop" type="text" class="scinput1" /><label><?php echo ($repeat); ?>（Member name, real name, mobile phone）</label></li>
            </ul>
            <ul class="">
            <li class="sarchbtn"><label>&nbsp;</label><input type="submit" class="scbtn" value="Inquire"/> <input name="" type="button" class="scbtn2" value="Export"/></li>  
            </ul>
            <ul class="toolbar1" style="float:right;">
                <li><span><img src="__IMG__/t05.png" /></span>Set up</li>
            </ul>
        </form>
        </div>
    </div>
    
    
    <table class="imgtable">
    	<thead>
        	<tr>
            <th><input name="" type="checkbox" value="" checked="checked"/></th>
            <th>Numbering<i class="sort"><img src="__IMG__/px.gif" /></i></th>
            <th>Username</th>
            <th>Actual name</th>
            <th>ID card</th>
            <th>Front of ID card</th>
            <th>Reverse side of ID card</th>
            <th>Holding ID card</th>
            <th>Certification status</th>
            <th>Operating</th>
            </tr>
        </thead>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>
            <tr>
            <td><input name="" type="checkbox" value="" /></td>
            <td><?php echo ($vo["user_id"]); ?></td>
            <td><?php echo ($vo["user_name"]); ?></td>
            <td><?php echo ($vo["user_compellation"]); ?></td>
            <td><?php echo ($vo["user_idcard"]); ?></td>
			 <td>
	<a href="<?php echo ($vo["idcarda_pic"]); ?>" class="tooltip" target="_blank"><img src="<?php echo ($vo["idcarda_pic"]); ?>"  style="max-width:80px; max-height:80px;"/></a>
		</td>	
			 <td>
	<a href="<?php echo ($vo["idcardb_pic"]); ?>" class="tooltip" target="_blank"><img src="<?php echo ($vo["idcardb_pic"]); ?>"  style="max-width:80px; max-height:80px;"/></a>
		</td>
			 <td>
	<a href="<?php echo ($vo["idcardc_pic"]); ?>" class="tooltip" target="_blank"><img src="<?php echo ($vo["idcardc_pic"]); ?>"  style="max-width:80px; max-height:80px;"/></a>
		</td>	
            <td><?php if($vo["idcard_sta"] == 0): ?>Not certified<?php else: ?>Verified<?php endif; ?></td>
         <!--   <td><?php echo ($vo["user_registertime"]); ?></td>  -->
            <td><a href="<?php echo U('User/delete','id='.$vo['user_id']);?>" onclick='return del();' class="tablelink">delete</a>
			<?php if($vo["idcard_sta"] == 1): else: ?>
			<?php if($vo["idcard_sta"] == 2): ?><a href="<?php echo U('User/isCerta','id='.$vo['user_id']);?>" class="tablelink"><?php echo ($repeat); echo ($repeat); ?>Re-review</a>
				<?php else: ?>
			<a href="<?php echo U('User/isCerta','id='.$vo['user_id']);?>" class="tablelink"><?php echo ($repeat); echo ($repeat); ?>Approved</a>
			<a href="<?php echo U('User/isCerts','id='.$vo['user_id']);?>" class="tablelink"><?php echo ($repeat); echo ($repeat); ?>Return</a><?php endif; endif; ?>
			</td>

            </tr>
        </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div class="pagestyle"> <?php echo ($page); ?></div>
    
    <div class="tip">
    	<div class="tiptop"><span>Prompt information</span><a></a></div>
        
      <div class="tipinfo">
        <span><img src="__IMG__/ticon.png" /></span>
        <div class="tipright">
        <p>Whether to confirm the modification of the information ？</p>
        <cite>If yes, please click the OK button, otherwise please click Cancel.</cite>
        </div>
        </div>
        
        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="Determine" />&nbsp;
        <input name="" type="button"  class="cancel" value="Cancel" />
        </div>
    
    </div>
    
    
    
    
    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
    <script>
        function del()
        {
            if(confirm("You sure you want to delete it？"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
		
   </script>		
		
  
	
	


	
	
	
	
	
	
</body>

</html>