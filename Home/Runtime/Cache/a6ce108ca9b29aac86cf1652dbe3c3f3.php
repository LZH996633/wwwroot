<?php if (!defined('THINK_PATH')) exit();?><div class="rtmain">

    <div class="hdtitle clearfix">
        <ul class="fl clearfix">
            
            <li class="on"><a href="javascript:void(0);" class="inter_chanView" data-value="StationMsg">Station news</a></li>
            
        </ul>
    </div>
    <div class="uspictm">
        <div class="title">
            <ul class="clearfix">
                <li id="fit" class="on"><a href="javascript:void(0)">My message</a></li>
            </ul>
        </div>
        <div class="list_show">
            <div class="lists">
                <div class="tabs">
                    <dl>
                        <dt><i class="i1">Title</i><i class="i2">Source</i><i class="i3">Status</i><i class="i4">Time</i><i class="i5">Operational</i></dt>
                       <?php if(is_array($ChatList)): $i = 0; $__LIST__ = $ChatList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dd id="chat<?php echo ($list["id"]); ?>"><span>
                        <i class="i1"><?php echo ($list["chat_title"]); ?></i>
                        <i class="i2">
                          Site Information
                             </i>
	   					<i class="i3" id="sta_<?php echo ($list["id"]); ?>">
                            <?php if($list['chat_state'] == 1): ?>Not viewed
                                <?php else: ?>
                                Viewed<?php endif; ?>

                        </i>
	   					<i class="i4"><?php echo ($list["chat_time"]); ?></i>
	   					<i class="i5"><a href="javascript:to_view(<?php echo ($list["id"]); ?>)">View</a>&nbsp;&nbsp;&nbsp;<a href="javascript:to_del(<?php echo ($list["id"]); ?>)">Delete</a></i>
	   					</span></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <div class="pages">
                        <?php if($count == 0): else: ?><a class="a1">A total of <span id="page"><?php echo ($count); ?></span>piece</a><?php endif; ?>
                        <?php echo ($page); ?>
                    </div>
                </div>

            </div>
            <!--Question details-->
            <div class="anser" style="display: none">
                <div class="titles" id="msg_title"></div>

                <div class="zpert">

                    <div class="stle clearfix">
                        <b>Message content</b>
                        <i id="msg_time"></i>
                    </div>
                    <div class="ancnt" id="msg_content">

                    </div>
                   <a class="pay-btn fr" href="javascript:void (0);" onclick="go_back()">Return</a>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Switch page-->
<script type="text/javascript">
   function change_page(p) {
      $.ajax({
            type: "get",
            async: true,
            url: "/index.php/Service/Ajax?action=StationMsg&p="+p+"&b="+Math.random(),
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

<!--Tab-->
<script type="text/javascript">
    $(document).ready(function () {
        $(".title ul li").click(function(){
            var i = $(this).index();
            $(this).attr('class','on').siblings().attr('class','');
            $('.lists').eq(i).attr('style','display:block').siblings().attr('style','display:none');

        })
    });

</script>
<!--View-->
<script type="text/javascript">
function to_view(id){

    $('.lists').attr('style','display:none');
    $(".anser").attr('style','display:block');
    $("#sta_"+id).text('Viewed');
    $.getJSON('/index.php/Ajax/show_msg?id='+id,function (data) {

        $("#msg_title").text("title："+data.chat_title);
        $("#msg_time").text("time："+data.chat_time);
        $("#msg_content").text(data.chat_content);

    })
}
</script>
<!--return-->
<script type="text/javascript">

        function go_back(){
            $(".anser").attr('style','display:none');
            $('.lists').attr('style','display:block')
        }

</script>
<!--delete-->
<script type="text/javascript">
    function to_del(id){
        $.getJSON('/index.php/Ajax/del_msg?id='+id,function (data) {
           if (data.status==1){
               layer.msg(data.msg,{time:1000});
               $("#chat"+id).remove();
              var count =  $('#page').text()-1;
               $('#page').text(count)
           }else{
               layer.msg(data.msg,{time:1000});
           }
        });
    }
</script>
<!--Internal asynchronous call-->
<script type="text/javascript">
    $(document).ready(function () {

        $('.inter_chanView').click(function () {

            var action = $(this).attr('data-value');

            $.ajax({
                type: "get",
                async: true,
                url: "/index.php/Service/Ajax?action="+action+"&b="+Math.random(),
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