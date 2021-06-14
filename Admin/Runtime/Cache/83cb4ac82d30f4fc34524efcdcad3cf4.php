<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cooperative management</title>
    <link href="__CS__/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="__JS__/jquery-1.11.0.min.js"></script>
    <script language="javascript">
        $(function () {
            //Navigation switch
            $(".imglist li").click(function () {
                $(".imglist li.selected").removeClass("selected")
                $(this).addClass("selected");
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
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
        <li><a href="#">Cooperative management</a></li>
        <li><a href="#">Cooperation link</a></li>
    </ul>
</div>

<div class="rightinfo">

    <div class="tools">
        <ul class="toolbar">
            <li class="btn-add"><a href="<?php echo U('Link/add');?>"><span><img src="__IMG__/t01.png"/></span>Add to</a></li>
            <li class="btn-edit" onclick="modify()"><span><img src="__IMG__/t02.png"/></span>Modify</li>
            <li class="btn-del click"><span><img src="__IMG__/t03.png"/></span>Delete</li>
            <!--<li class="btn-count"><span><img src="__IMG__/t04.png"/></span>statistics</li>-->
        </ul>
        <!--
                <ul class="toolbar1">
                    <li><span><img src="__IMG__/t05.png"/></span>Set up</li>
                </ul>-->
    </div>

    <p></p>
    <!--modify-->
    <script type="text/javascript">
        function modify(){
            var  select = document.getElementsByClassName('select');
            var length = select.length;
            var i =0;
            var a= 0;
            for (i;i<length;i++){
                if(select[i].checked==true){
                    a++
                } ;

            }
            if(a=='1'){
                var url = "<?php echo U('Link/edit', array('id' =>'adid'));?>";
                var id = $('.select').filter(':checked').val();
                if(id){
                    window.location.href = url.replace('adid', id);
                }
            }
        }
    </script>
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

                    var form = document.getElementById('form_select');

                    form.submit();
                };

                // alert(select[i].checked);
            }

        }
    </script>

    <table class="imgtable">

        <thead>
        <tr>
            <th width="60px;"><input type="checkbox" onclick="select_all()" id="select_all"/>Select all</th>
            <th width="200px;">Thumbnail</th>
            <th>Title</th>
            <th>Link</th>

            <th>Remarks</th>
            <th width="125px">Operating</th>
        </tr>
        </thead>

        <tbody>
        <form action="<?php echo U('Link/del');?>" method="post" id="form_select">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><input type="hidden" value="2" name="type"><input type="checkbox" name="select[]" class="select " value="<?php echo ($vo["link_id"]); ?>" id='select_<?php echo ($vo["link_id"]); ?>'/></td>
                    <td class="imgtd"><img src="<?php echo ($vo["link_logo"]); ?>"  style="width: 166px;height: 45px;"/></td>
                    <td><a href="<?php echo ($vo["link_url"]); ?>" target="_blank"><?php echo ($vo["link_name"]); ?></a></td>
                    <td><a href="<?php echo ($vo["link_url"]); ?>" target="_blank"><?php echo ($vo["link_url"]); ?></a></td>

                    <td><span style="white-space:nowrap;width:300px;text-overflow:ellipsis;overflow: hidden"><?php echo ($vo["link_remark"]); ?></span></td>
                    <td><a href="javascript:select_it(<?php echo ($vo["link_id"]); ?>)"  class="tablelink click select_it" data='<?php echo ($vo["link_id"]); ?>'><?php echo ($repeat); ?>Delete</a>
                        <a href="<?php echo U('Link/edit', array('id' =>$vo['link_id']));?>"  class="tablelink " data='<?php echo ($vo["link_id"]); ?>'><?php echo ($repeat); ?>Edit</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </form>
        </tbody>

    </table>

    <div class="pagestyle"> <?php echo ($page); ?></div>


    <div class="tip">
        <div class="tiptop"><span>Prompt information</span><a onclick="cancel()"></a></div>

        <div class="tipinfo">
            <span><img src="__IMG__/ticon.png"/></span>

            <div class="tipright">
                <p>Do you confirm the modification of the information? ？</p>
                <cite>If yes, please click the OK button, otherwise please click Cancel.</cite>
            </div>
        </div>

        <div class="tipbtn">
            <input name="" type="button" class="sure" value="Determine" onclick="sure()"/>&nbsp;
            <input name="" type="button" class="cancel" value="Cancel" onclick="cancel()"/>
        </div>

    </div>


</div>


<script type="text/javascript">
    $('.imgtable tbody tr:odd').addClass('odd');
</script>

</body>

</html>