<?php if (!defined('THINK_PATH')) exit();?>
<!--显示标识-->
<span id="show_project" data-value="<?php echo ($show_project); ?>"></span>
<!--排序标识-->
<span id="up_order" data-value="<?php echo ($up_order); ?>"></span>
<!--开始时间-->
<span id="start_time" data-value="<?php echo ($start_time); ?>"></span>
<!--结束时间-->
<span id="end_time" data-value="<?php echo ($end_time); ?>"></span>
<div class="rtmain">
    <div class="hdtitle clearfix">
        <ul class="fl clearfix">
            <li ><a href="javascript:void(0);" class="inter_chanView" data-value="CollectFocus">收藏关注</a></li>
            <li class="on"><a href="javascript:void(0);" class="inter_chanView" data-value="Down_Upload">下载上传</a></li>
            <li ><a href="javascript:void(0);" class="inter_chanView" data-value="MyCustom">我的定制</a></li>
        </ul>
    </div>
    <div class="conts">
        <div class="tabconts">
            <ul class="title clearfix">
                <li class="active" id="fit"><a href="javascript:void (0)">我的下载</a></li>
                <li ><a href="javascript:void (0)">我的上传</a></li>
                <!--<li><a href="">物流地址</a></li>-->
            </ul>
        </div>
        <div class="listshow">
            <div class="lists userconts" style="display: none;">
                <div class="tabcts">
                <div class="clearfix">
                    <form id="form_one">
                       <!-- <input type="hidden" value="customize" name="m">
                        <input type="hidden" value="member" name="c">
                        <input type="hidden" value="init" name="a">-->
                        <ul class="clearfix fl">
                            <li>订单时间</li>
                            <li><input type="text" value="<?php echo ($down_start); ?>" readonly id="start_one" name="stime"  class="laydate-icon" ></li>
                            <li>到</li>
                            <li><input type="text" value="<?php echo ($down_end); ?>" readonly id="end_one" name="etime" class="laydate-icon" ></li>
                        </ul>
                        <a href="javascript:do_submit_one();">查询</a>
                    </form>
                </div>

            </div>
                <div class="tabs pt30">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="20%">订单编号</th>
                    <th width="25%">下载时间</th>
                    <th width="25%">作品名称</th>
                    <th width="15%">消耗金额</th>
                     <th width="15%">操作</th>
                </tr>
                <?php if(is_array($DownList)): $i = 0; $__LIST__ = $DownList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr id="down<?php echo ($list["id"]); ?>">
                    <td class="ts"><?php echo ($list["order_number"]); ?></td>
                    <td><?php echo ($list["down_time"]); ?></td>
                    <td ><span style="white-space:nowrap;width:250px;text-overflow:ellipsis;"><?php echo ($list['opus_title']); ?></span></td>
                    <td><?php echo ($list["down_price"]); ?>金币</td>
                    <td><a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="_blank">查看</a>&nbsp;<a href="javascript:down_delete(<?php echo ($list["id"]); ?>,<?php echo ($list["id"]); ?>)" >删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </div>
                <div class="pages">
                    <?php if($count_download == 0): else: ?><a class="a1">共<span id="page_download"><?php echo ($count_download); ?></span>条</a><?php endif; ?>
                    <?php echo ($page_download); ?>
                </div>
            </div>
            <div class="lists userconts" style="display: none;">
                <div class="tabcts">
                    <div class="clearfix">
                        <form id="form_two">
                           <!-- <input type="hidden" value="customize" name="m">
                            <input type="hidden" value="member" name="c">
                            <input type="hidden" value="init" name="a">-->
                            <ul class="clearfix fl">
                                <li>订单时间</li>
                                <li><input type="text" value="<?php echo ($up_start); ?>" readonly id="start_two" name="stime"  class="laydate-icon" ></li>
                                <li>到</li>
                                <li><input type="text" value="<?php echo ($end_start); ?>" readonly id="end_two" name="etime" class="laydate-icon" ></li>
                                <li><select name="status" id="order">
                                    <option value="" >全部</option>
                                    <option value="oext_views" >查看量</option>
                                    <option value="oext_favorite" >收藏量</option>
                                    <option value="down" >下载量</option>
                                </select></li>
                            </ul>
                            <a href="javascript:do_submit_two();" >查询</a>
                        </form>
                    </div>

                </div>
                <div class="tabs pt30">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <th width="28%">作品名称</th>
                            <th width="20%">上传时间</th>
                            <th width="10%">作品定价</th>
                            <th width="8%">查看次数</th>
                            <th width="8%">收藏次数</th>
                            <th width="8%">下载次数</th>
                            <th width="20%">操作</th>
                        </tr>
                        <?php if(is_array($UpList)): $i = 0; $__LIST__ = $UpList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr id="up<?php echo ($list["opus_id"]); ?>">
                            <td class="ts"><span style="white-space:nowrap;width:250px;text-overflow:ellipsis;"><?php echo ($list['opus_title']); ?></span></td>
                            <td><?php echo ($list["opus_createtime"]); ?></td>
                            <td><?php echo ($list["price"]); ?></td>
                            <td><?php echo ($list["oext_views"]); ?></td>
                            <td><?php echo ($list["oext_favorite"]); ?></td>
                            <td><?php echo ($list["down"]); ?></td>
                            <td><a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="_blank">查看</a>&nbsp;<a href="javascript:edit('MaterialUpload',<?php echo ($list["opus_id"]); ?>)">编辑</a>&nbsp;<a href="javascript:up_delete(<?php echo ($list["opus_id"]); ?>,<?php echo ($list["opus_id"]); ?>)" >删除</a> </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
                <div class="pages">
                    <?php if($count_upload == 0): else: ?><a class="a1">共<span id="page_upload"><?php echo ($count_upload); ?></span>条</a><?php endif; ?>
                    <?php echo ($page_upload); ?>
                </div>
            </div>
       </div>
    </div>

</div>
<!--上传排序-->
<script type="text/javascript">
    $(document).ready(function () {
        var up_order = $("#up_order").attr("data-value");

         $("#order option").each(function () {
            var order = $(this).attr('value');

             if (up_order == order){
                 var order_text = $(this).text();
                 if(order_text!='全部'){
                     $("#order option").eq(0).attr("value",order).text(order_text);
                     $("#order option").eq(0).after("<option value=''>全部</option>");
                 }

             }/*"<option value="+up_order+">"+order_text+"</option>"*/
        });

    })
</script>
<!--编辑作品-->
<script type="text/javascript">
    function edit(action,id){
        $.ajax({
            type: "get",
            async: true,
            url: "/index.php/Service/"+action+"?action="+action+'&opus_id='+id,
            dataType: "html",
            data: '',

            success: function (msg) {

                var show = $('.rtcnt');
                show.text('');
                show.prepend(msg)
            },
            error:  function (msg){
                ////alert(msg.status)
            }
        })
    }
</script>
<!--下载删除-->
<script type="text/javascript">
    var SiteUrl = $('#SiteUrl').val();

    function down_delete(id,sid) {
        layer.confirm("您确认删除吗？", {
            btn: ['确认','取消'],
            icon: 3,
            title:'放弃二次免费下载'
        },function(){

            $.getJSON('/index.php/Ajax/DownDel?down_id='+id+"&"+Math.random(), function(data){

                if(data.status=='true'){
                    layer.msg("删除成功！",{icon:1,time:1000},function(){
                        $("#down"+sid).remove();
                        var page_download = $('#page_download').text()-1;
                        $('#page_download').text(page_download)
                    });
                }else {
                    layer.msg("删除失败!",{icon:1,time:2000});

                }
//                else if(data.status==-1){
//                    layer.msg("请登录后收藏!",{icon:1,time:1000},function(){
//                        $(".logintk").show();
//                        $(".graybg").show();
//                    });
//                }
//                else if(data.status==-3) {
//                    layer.msg("不能收藏自己的素材!",{icon:2,time:2000});
//
//                }

            });
        });
    }

</script>

<!--上传删除-->
<script type="text/javascript">
    var SiteUrl = $('#SiteUrl').val();

    function up_delete(id,sid) {
        layer.confirm("您确认删除吗？", {
            btn: ['确认','取消'],
            icon: 3,
            title:'删除已上传文件'
        },function(){

            $.getJSON('/index.php/Ajax/UpDel?up_id='+id+"&"+Math.random(), function(data){
                if(data.status=='true'){
                    layer.msg("删除成功！",{icon:1,time:1000},function(){
                        $("#up"+sid).remove();
                        var page_upload = $('#page_upload').text()-1;
                        $('#page_upload').text(page_upload)
                    });
                }
//                else if(data.status==-1){
//                    layer.msg("请登录后收藏!",{icon:1,time:1000},function(){
//                        $(".logintk").show();
//                        $(".graybg").show();
//                    });
//                }
//                else if(data.status==-3) {
//                    layer.msg("不能收藏自己的素材!",{icon:2,time:2000});
//
//                }
                else {
                    layer.msg("删除失败!",{icon:1,time:2000});

                }
            });
        });
    }

</script>

<!--选项卡-->
<script type="text/javascript">
    $(document).ready(function () {
            var i = $('#show_project').attr("data-value");
        
           // $("#show_project").attr("data-value",i);

            $(".title li").eq(i).attr("class","active").siblings().attr("class","");

            $(".lists").eq(i).attr("style","display:block").siblings().attr('style','display:none');
       

    });

    $(".title li").click(function(){
        var i = $(this).index();

        var a= $('#show_project').attr('data-value');

        if (i != a){
            $('#show_project').attr('data-value',i);
           change_page();
        }


        $(this).attr('class','active').siblings().attr('class','');

        $('.lists').eq(i).attr('style','display:block').siblings().attr('style','display:none');


    })


</script>
<!--下载日期-->
<script type="text/javascript">
    var start = {
        elem: '#start_one',
        format: 'YYYY-MM-DD',
        max: '2099-06-16 23:59:59',
        istime: false,
        istoday: true,
        choose: function(datas){
            end.min = datas;
            end.start = datas
        }
    };
    var end = {
        elem: '#end_one',
        format: 'YYYY-MM-DD',

        max: '2099-06-16 23:59:59',
        istime: false,
        istoday: true,
        choose: function(datas){
            start.max = datas;
        }
    };
    laydate(start);
    laydate(end);
    function do_submit_one(){

        var start_time =   $("#form_one #start_one").val();
        var end_time =   $("#form_one #end_one").val();

        $("#start_time").attr("data-value",start_time);
        $("#end_time").attr("data-value",end_time);


        change_page();
        //return false;
    }

</script>

<!--切换页面-->
<script type="text/javascript">

    var SiteUrl = $('#SiteUrl').val();
    function change_page(p) {
      if (typeof (p)=='undefined'){
            var p = '1';
        }
        var start_time =  $("#start_time").attr("data-value");
        var end_time = $("#end_time").attr("data-value");
        var order = $("#up_order").attr('data-value');


        var show = $('#show_project').attr('data-value');
        if (show!='1'){
            show = 0;
        }

        $.ajax({
            type: "get",
            async: true,
            url: "/index.php/Service/Down_Upload?action=Down_Upload&p="+p+'&show='+show+'&start='+start_time+'&end='+end_time+'&order='+order+"&b="+Math.random(),
            dataType: "html",
            data: '',

            success: function (msg) {
                var show = $('.rtcnt');
                show.text('');
                show.prepend(msg)
            },
            error:  function (msg){
                ////alert(msg.status)
            }
        })

    }



</script>

<!--上传日期-->
<script type="text/javascript">
    var start = {
        elem: '#start_two',
        format: 'YYYY-MM-DD',
        max: '2099-06-16 23:59:59',
        istime: false,
        istoday: true,
        choose: function(datas){
            end.min = datas;
            end.start = datas
        }
    };
    var end = {
        elem: '#end_two',
        format: 'YYYY-MM-DD',

        max: '2099-06-16 23:59:59',
        istime: false,
        istoday: true,
        choose: function(datas){
            start.max = datas;
        }
    };
    laydate(start);
    laydate(end);
    function do_submit_two(){
        var start_time =   $("#form_two #start_two").val();
        var end_time =   $("#form_two #end_two").val();
        var  order = $("#form_two #order").val();
 $("#start_time").attr("data-value",start_time);
 $("#end_time").attr("data-value",end_time);
 $("#up_order").attr('data-value',order);
        change_page();
    }



</script>

<!--内部异步调用-->
<script type="text/javascript">
    $(document).ready(function () {

        $('.inter_chanView').click(function () {

            var action = $(this).attr('data-value');

            $.ajax({
                type: "get",
                async: true,
                url: "/index.php/Service/"+action+"?action="+action+"&b="+Math.random(),
                dataType: "html",
                data: '',
                cache:false,

                success: function (msg) {

                    var show = $('.rtcnt');
                    show.text('');
                    show.prepend(msg)
                },
                error:  function (msg){
                    ////alert(msg.status)
                }
            })
        });
    })

</script>