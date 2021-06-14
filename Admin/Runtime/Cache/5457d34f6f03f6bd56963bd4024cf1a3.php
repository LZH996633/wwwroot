<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Work management</title>
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
</script>


</head>


<body>

	<div class="place">
    <span>Position：</span>
    <ul class="placeul">
    <li><a href="#">Home page</a></li>
        <li><a href="#">Upload management</a></li>
    <li><a href="#">List of works</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">

    <div class="tools">
    	<ul class="toolbar">
          <!-- <li class="click"><span><img src="__IMG__/t01.png" /></span>Add to</li>
            <li class="click"><span><img src="__IMG__/t02.png" /></span>modify</li>-->
            <li class="click"><span><img src="__IMG__/t03.png" /></span>Delete</li>
            <li><span><a href="<?php echo U('Opus/count');?>"><img src="__IMG__/t04.png" /></a></span>Statistics</li>
        </ul>

        <div style="float:right;width:400px;">
        <form action="__APP__?m=Opus&a=index" method="post"  >
            <ul class="">
                <li><input type="submit" class="scbtn" value="Inquire"/> <?php echo ($repeat); ?><input name="searchop" type="text" class="scinput1" value="<?php echo ($search); ?>"/><label><?php echo ($repeat); ?>（Work name, category）</label></li>
            </ul>
            <ul class="">
            <li class="sarchbtn"><label>&nbsp;</label>
			<!-- <input name="" type="button" class="scbtn2" value="Export"/> -->
			</li>  
            </ul>
            <ul class="toolbar1" style="float:right;">
                <!--<li><span><img src="__IMG__/t05.png" /></span>Set up</li>-->
            </ul>
            <br>
        </form>
        </div>
    </div>

        <!--Select all or none-->
        <script type="text/javascript">

            function select_all(){
                var select_all = document.getElementById('select_all');
                var  select = document.getElementsByClassName('select');
                var length = select.length;
                var i =0;
                if(select_all.checked==true){

                    for (i;i<length;i++){
                        select[i].checked=true;

                    }

                }else{
                    for (i;i<length;i++){
                        select[i].checked=false;
                    }
                }

            }
        </script>
        <!--//Single choice-->
        <script type='text/javascript'>

            function select_it(id){
                var select = document.getElementById('select_'+id);
                select.checked=true;
                //alert(select.checked);
            }


        </script>
        <!--cancel cancel all of them-->
        <script type='text/javascript'>

            function cancel(){
                var  select = document.getElementsByClassName('select');
                var length = select.length;
                var i =0;

                for (i;i<length;i++){
                    select[i].checked=false;

                }

            }
            <!-- Form submission -->
            function sure(){

                var  select = document.getElementsByClassName('select');
                var length = select.length;

                var i =0;

                for (i;i<length;i++){
                    if(select[i].checked==true){

                        var form = document.getElementById('form_delect');

                        form.submit();
                    };

                    // alert(select[i].checked);
                }

            }
        </script>
  
    <table class="imgtable">
        <thead>
            <tr>
            <th><input type="checkbox" onclick="select_all()" id="select_all"/>select all</th>
            <th width="100px;">Thumbnail</th>
            <th>Title</th>
			<!--<th>opus_video</th>-->
            <th>Column</th>
            <th>Publisher</th>
           <!-- <th>Authority</th>-->
            <th>Whether to review</th>
            <th>Price</th>
            <th>Recommend</th>
            <th>Statistics</th>
            <th>Operating</th>
            </tr>
        </thead>
        
       
        <tbody>


		<form action="__APP__?m=Opus&a=delete" method="post" id='form_delect'>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
             <td>
			 <input type="checkbox" name="select[]" class="select " value="<?php echo ($vo["opus_id"]); ?>" id='select_<?php echo ($vo["opus_id"]); ?>'/>
			 </td>
            <td class="imgtd"><img src="<?php echo ($vo["opus_pic"]); ?>" style="height: 80px;width: 60px"/></td>
            <td><span  style="white-space:nowrap;width:250px;text-overflow:ellipsis; overflow:hidden"><a href="__ROOT__/index.php/model/model/cid/<?php echo ($vo["opus_id"]); ?>.html" target="_blank" style="white-space:nowrap;width:250px;text-overflow:ellipsis;"><?php echo ($vo['opus_title']); ?></a></span><p>Posted on：<?php echo ($vo["opus_createtime"]); ?></p></td>
            <td><span  style="white-space:nowrap;width:80px;text-overflow:clip; overflow:hidden"><?php echo ($vo['cate']); ?></span><p>ID: <?php echo ($vo["opus_id"]); ?></p></td>

            <td><span  style="white-space:nowrap;width:60px;text-overflow:clip; overflow:hidden"><?php echo ($vo['user_nickname']); ?></span></td>
            
            <!--<td><?php if($vo["opus_power"] == 1 ): ?>Ordinary member<?php elseif($vo["opus_power"] == 2): ?>VIP member<?php else: ?> Senior VIP member<?php endif; ?></td>-->
            <td><?php if($vo["opus_verify"] == 1): ?>Audited<?php else: ?>
			<?php if($vo["opus_verify"] == 2): ?>Returned<?php else: ?>Unreviewed<?php endif; endif; ?>
			</td>
            <!--<td><?php if($vo["opus_verify"] == 2): ?>Returned<?php else: ?>Unreviewed<?php endif; ?></td>	-->		
            <td><p>Gold：<?php echo ($vo["price"]); ?></p><!--<p>Integral：<?php echo ($vo["scoreprice"]); ?></p></td>-->
			<td><?php if($vo["recom"] == 1): ?>Recommended<?php else: ?>Not recommended<?php endif; ?></td>		
           <!-- <td><p><?php if($vo["is_half"] == 0): ?>否<?php else: ?>是<?php endif; ?></p></td>-->
            <td><p>Number of visits：<?php echo ($vo["oext_views"]); ?></p><p>Number of collections：<?php echo ($vo["oext_favorite"]); ?></p><p>Number of transactions：<?php echo ($vo["oext_trade"]); ?></p></td>
            <td>
                <a href="__ROOT__/index.php?m=Model&a=model&cid=<?php echo ($vo["opus_id"]); ?>" class="tablelink" target="_blank" >View</a>
                <a href="javascript:select_it(<?php echo ($vo["opus_id"]); ?>)"  class="tablelink click select_it" data='<?php echo ($vo["opus_id"]); ?>'><?php echo ($repeat); ?>Delete</a>

				
				
			

                <?php if($vo["opus_verify"] == 1): if($vo["recom"] == 1): else: ?>
				<a href="<?php echo U('Opus/checkroom','id='.$vo['opus_id']);?>" class="tablelink"><?php echo ($repeat); echo ($repeat); ?>Home Recommendation</a><?php endif; ?>
                 <?php else: ?>
				<?php if($vo["opus_verify"] == 2): else: ?>
					<a href="<?php echo U('Opus/check','id='.$vo['opus_id']);?>" class="tablelink"><?php echo ($repeat); echo ($repeat); ?>Approved</a>	
					<a href="<?php echo U('Opus/uncheck','id='.$vo['opus_id']);?>" class="tablelink"><?php echo ($repeat); echo ($repeat); ?>Return</a><?php endif; endif; ?>
				
			<!--
		
            <form  method="post" action="<?php echo U('Information/do_edit');?>" role="form" > 
                <ul class="forminfo">
                    <input type="hidden" name="select_send" value="<?php echo ($select); ?>">  
                    <li><label for="title">消息标题</label><input name="title" type="text"  class="dfinput" id="title" placeholder="请填写与此素材重复的另一个素材的链接或ID" /><i>标题不能超过30个字符</i></li>

                    <li><label>消息内容：<b>*</b></label>
                        <input type="hidden" name="single" value="about">
                        <textarea  id="content_1" name="content" style="width:800px;height:400px;padding:20px;"></textarea>
                    </li>
                    <li><label></label><input name="" type="submit" class="btn" value="发送消息" onclick="return check()"/></li>
                </ul>
            </form>

-->

		
				
				
            </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</form>
        </tbody>
       
    
    </table>
  
    <div class="pagestyle"> <?php echo ($page); ?></div>

    
    
    <div class="tip">
    	<div class="tiptop"><span>Prompt information</span><a onclick="cancel()"></a></div>
        
      <div class="tipinfo">
        <span><img src="__IMG__/ticon.png" /></span>
        <div class="tipright">
        <p>Are you sure to delete the source file?</p>
        <cite>If yes, please click the OK button, otherwise please click Cancel.</cite>
        </div>
        </div>
        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="Determine" onclick="sure()"/>&nbsp;
        <input name="" type="button"  class="cancel" value="Cancel" onclick="cancel()"/>
        </div>
    
    </div>
    
    </div>

    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
  
</body>

</html>