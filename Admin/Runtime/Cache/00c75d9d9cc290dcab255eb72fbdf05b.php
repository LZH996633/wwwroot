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
        <li><a href="#">Work management</a></li>
    <li><a href="#">Works Statistics</a></li>
    </ul>
    </div>
    <div class="mainindex">
        <div style="">
        <form action="__APP__?m=Opus&a=count" method="post" style="" >
            <ul class="">
                <li class="sarchbtn">
                <button type="submit" name="data" value="1" class="scbtn" >That day</button>
                <button type="submit" name="data" value="7" class="scbtn" >This week</button>
                <button type="submit" name="data" value="30" class="scbtn2" >This month</button>
                <button type="submit" name="data" value="90" class="scbtn2" >This quarter</button>
                <?php echo ($repeat); echo ($repeat); echo ($repeat); ?>Customize：<input type="text" name="day" placeholder="Please enter the number of days you want to query" style="height:30px;line-height:30px;text-align:center;" >day
                <button type="submit" class="scbtn2" >Inquire</button>
                </li>  
            </ul>
        </form>
        </div>
        <div style="">
            <div class="welinfo">
                <span><img src="__IMG__/dp.png" alt="remind" /></span>
                <b><?php if(($currentday) == ""): ?><em>all</em><?php else: ?><em><?php echo ($currentday); ?>day</em><?php endif; ?> data：</b>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                    <th>Total number of works</th>
					<?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><th><?php echo ($list["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                    <th>Downloads</th>
                    <!--<th>total points</th>-->
                    <!--<th>Promotion number</th>-->
                    <!--<th>Member's total gold</th>-->
                    <th>Turnover</th>
                    <!--<th>Withdrawal amount</th>-->
                    <!--<th>Reconciliation</th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><?php echo ($total); ?></td>
					<?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><td><?php echo ($list["count"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                    <!--<td><?php echo ($sum["user"]); ?></td>-->
                    <td><?php echo ($count_down); ?></td>
                    <!--<td><?php echo ($sum["points"]); ?></td>
                    <td><?php echo ($sum["tuiguang"]); ?></td>-->
                    
                    <td><?php echo ($tran); ?></td>
                    <!--<td><?php echo ($sum["cash"]); ?></td>-->
                    <!--<td><?php echo ($sum["duizhang"]); ?></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>