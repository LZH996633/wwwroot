<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Management</title>
<link href="__CS__/style.css" rel="stylesheet" type="text/css" />
	<style>
		.money input{
			display: none;
		}

		.money.focus input{
			display: inline-block;
			width: 45px;
			height: 32px;
			border: 1px solid #ccc;
			vertical-align: top;
		}
		.money.focus span{
			display: none;
		}
	</style>
<script type="text/javascript" src="__JS__/jquery-1.11.0.min.js"></script>

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
    <li><a href="#">Member Management</a></li>
    <li><a href="#">User list</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
        <ul class="toolbar">
            <!-- <li class="click"><span><img src="__IMG__/t01.png" /></span>添加</li> -->
            <!-- <li class="click"><span><img src="__IMG__/t02.png" /></span>修改</li> -->
            <li class="click"><span><img src="__IMG__/t03.png" /></span>Delete</li>
            <!--  <li class="click"><span><img src="__IMG__/t04.png" /></span>统计</li>-->
        </ul>
        <div style="float:right;width:500px;">



        <form action="__APP__?m=User&a=index" method="post"  >
            <ul class="">
                <li><input type="submit" class="scbtn" value="Inquire"/><?php echo ($repeat); ?><input name="searchop" type="text" class="scinput1" value="<?php echo ($search); ?>"/><label><?php echo ($repeat); ?>（Member name, nickname, email, mobile phone）</label>
				 </li>
            </ul>
            <ul class="">
            <li class="sarchbtn"><label>&nbsp;</label>
			<!-- <input name="" type="button" class="scbtn2" value="导出"/> -->
			</li>  
            </ul>
            <ul class="toolbar1" style="float:right;">
                <!-- <li><span><img src="__IMG__/t05.png" /></span>设置</li> -->
            </ul>
        </form>
        </div>
    </div>
        <!--全选与全不选-->
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
        <!--//单选-->
        <script type='text/javascript'>

            function select_it(id){

                var select = document.getElementById('select_'+id);
                select.checked=true;
                //alert(select.checked);
            }


        </script>
       <!--cancel 全部取消-->
        <script type='text/javascript'>

            function cancel(){
                var  select = document.getElementsByClassName('select');
                var length = select.length;
                var i =0;

                for (i;i<length;i++){
                    select[i].checked=false;

                }

            }
            <!-- 表单提交 -->
            function sure(){
                var  select = document.getElementsByClassName('select');
                var length = select.length;
                var i =0;

                for (i;i<length;i++){
                    if(select[i].checked==true){

                        var form = document.getElementById('form_select');

                        form.submit();
                    };

                    // alert(select[i].checked);
                }

            }
        </script>
    
    <table class="tablelist">
    	<thead>
        	<tr>
            <th><input type="checkbox" onclick="select_all()" id="select_all"/></th>
            <th>Numbering
			<!-- <i class="sort"><img src="__IMG__/px.gif" /></i> -->
			</th>
            <th>Username</th>
            <th>Nickname</th>
            <th>Mailbox</th>
                <!--<th>Cell phone</th>-->
               <!-- <th>籍贯</th> -->
            <!-- <th>等级</th> -->
            <!-- <th>用户权限</th> -->
            <!--<th>账户余额（￥）</th>-->
            <!-- <th>剩余积分</th> -->
            <th>Registration time</th>
            <th>Banned status</th>
            <th>Operating</th>
            </tr>
        </thead>
        <tbody class="user-list">
		<form action="<?php echo U('User/delete');?>" method='post' id='form_select'>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td>
			<input type="checkbox" name="select[]" class="select " value="<?php echo ($vo["user_id"]); ?>" id='select_<?php echo ($vo["user_id"]); ?>'/>
			</td>
            <td><?php echo ($vo["user_id"]); ?></td>
            <td><?php echo ($vo["user_name"]); ?></td>
            <td><?php echo ($vo["user_nickname"]); ?></td>
            <td><?php echo ($vo["user_email"]); ?></td>
                <!-- <td><?php echo ($vo["user_mobilephone"]); ?></td>-->
            <!-- <td><?php echo ($vo["user_home"]); ?></td> -->
            <!-- <td><?php echo ($vo["user_grade"]); ?></td> -->
            <!-- <td><?php echo ($vo["user_power"]); ?></td> -->
            <!--<td class="money"><span><?php echo ($vo["user_money"]); ?></span><input value="<?php echo ($vo["gold_coin"]); ?>" data-value="<?php echo ($vo["gold_coin"]); ?>" data-id="<?php echo ($vo["user_id"]); ?>"></td>-->
            <!-- <td><?php echo ($vo["user_points"]); ?></td> -->
            <td><?php echo ($vo["user_registertime"]); ?></td>
            <td><?php if($vo["user_state"] == 1): ?>Normal use<?php else: ?>Banned...<?php endif; ?></td>
            <td><?php if($vo["user_state"] == 1): ?><a href="<?php echo U('User/ban','id='.$vo['user_id']);?>" class="tablelink">Ban</a><?php else: ?><a href="<?php echo U('User/unban','id='.$vo['user_id']);?>" class="tablelink">Unblock</a><?php endif; ?> <a href="javascript:select_it(<?php echo ($vo["user_id"]); ?>)"  data='<?php echo ($vo["user_id"]); ?>' class="tablelink click select_it" ><?php echo ($repeat); echo ($repeat); ?>Delete</a></td>

            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</form>
        </tbody>
    </table>
    <div class="pagestyle"> <?php echo ($page); ?></div>

    
    
    <div class="tip">
    	<div class="tiptop"><span>Prompt information</span><a onclick='cancel()'></a></div>
        
      <div class="tipinfo">
        <span><img src="__IMG__/ticon.png" /></span>
        <div class="tipright">
        <p>Do you confirm the modification of the information? ？</p>
        <cite>If yes, please click the OK button, otherwise please click Cancel.</cite>
        </div>
        </div>
        
        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="Determine" onclick='sure()'/>&nbsp;
        <input name="" type="button"  class="cancel" value="Cancel" onclick='cancel()'/>
        </div>
    
    </div>

    
    
    
    </div>

    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>

</html>