<?php if (!defined('THINK_PATH')) exit();?><title>会员管理中心</title>
<!--显示标识-->
<span id="show_project" data-value="<?php echo ($show_project); ?>"></span>
<div class="rtmain">
            <div class="hdtitle clearfix">
                <ul class="fl clearfix">
                     <li class="on"><a href="javascript:void(0);" class="inter_chanView" data-value="CollectFocus">收藏关注</a></li>
                     <li ><a href="javascript:void(0);" class="inter_chanView" data-value="Down_Upload">下载上传</a></li>
                </ul>
            </div>
            <div class="userconts uspictm ">
                <div class="title">
                    <ul class="clearfix">
                        <li class="on" id="fit" title=""><a href="javascript:void(0);" >我的收藏</a></li>
                        <li ><a href="javascript:void(0);" >我的关注</a></li>
                    </ul>
                </div>
              <div class="showlist">
                 <div class="lists collect">


                <div class="clearfix tabctsd">
                     <?php if(is_array($FavorList)): $i = 0; $__LIST__ = $FavorList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl id="sc<?php echo ($list["opus_id"]); ?>">
                            <a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" target="blank">
                            <dt class="scrollpic">
                                <div class="pic"><img class="lazy" src="<?php echo ($list["opus_pic"]); ?>" ></div>
                                <div class="upscr"></div>
                                <div class="downscr"></div>

                            </dt></a>
                            <dd><p><a href="<?php echo U('Model/model',array('cid'=>$list['opus_id']));?>" class="title" target="_blank" ><?php echo ($list["opus_title"]); ?></a></p></dd>
                            <dd><span><i><img src="__IMG__/yangzf.png"><?php echo ($list["price"]); ?></i><em><img src="__IMG__/downico.png"><?php echo ($list["down"]); ?>次</em></span></dd>
                            <a class="optioner pa" href="javascript:favdelete(<?php echo ($list["opus_id"]); ?>,<?php echo ($list["opus_id"]); ?>);">取消收藏</a>
                    	</dl><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="pages">
                    <?php if($count_collect == 0): else: ?><a class="a1">共<span id="page_collect"><?php echo ($count_collect); ?></span>条</a><?php endif; ?>
                    <?php echo ($page_collect); ?>
                </div>
             </div>

                  <div class="lists follows clearfix focus" style="display: none">

                      <div class="clearfix">
                          <?php if(is_array($FocusList)): $i = 0; $__LIST__ = $FocusList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="cotb " id="follow<?php echo ($list["user_id"]); ?>">
                              <div class="pic pr"><a href="" target="_blank"><img src="<?php echo ($list["user_pic"]); ?>"><span><i><?php echo ($list["user_nickname"]); ?></i></span></a></div>
                              <div class="name"><b><a href="" target="_blank"></a></b><i class="follow"><a href="javascript:follow(<?php echo ($list["user_id"]); ?>,<?php echo ($list["user_id"]); ?>);">取消</a></i></div>
                          </div><?php endforeach; endif; else: echo "" ;endif; ?>
                      </div>
                      <div class="pages">
                          <?php if($count_focus == 0): else: ?><a class="a1">共<span id="page_focus"><?php echo ($count_focus); ?></span>条</a><?php endif; ?>
                          <?php echo ($page_focus); ?>
                      </div>
                  </div>
                </div>
            </div>
      </div>

<!--切换页面-->
<script type="text/javascript">
    var SiteUrl = $('#SiteUrl').val();

    function change_page(p) {
        if (typeof (p)=='undefined'){
            var p = '1';
        }
        var show = $('#show_project').attr('data-value');
        if (show!='1'){
            show = 0;
        }
        $.ajax({
            type: "get",
            async: true,
            url: "/index.php/Service/CollectFocus?action=CollectFocus&p="+p+'&show='+show+"&b="+Math.random(),
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

<!--收藏-->
<script type="text/javascript">
    var SiteUrl = $('#SiteUrl').val();

    $(function(){
        $(".scrollpic").each(function(){
            scrollpic($(this));
        });
    });
    function favdelete(id,sid) {
        layer.confirm("您确认取消收藏吗？", {
            btn: ['确认','取消'],
            icon: 3,
            title:'取消收藏'
        },function(){

            $.getJSON(SiteUrl+'/index.php/Ajax/Favor?fa_id='+id+"&"+Math.random(), function(data){
                 if(data.status==2){
                    layer.msg("收藏已取消！",{icon:1,time:1000},function(){
                        $("#sc"+sid).remove();
                        var page_collect = $('#page_collect').text()-1;
                        $('#page_collect').text(page_collect)
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
                    layer.msg("取消收藏失败!",{icon:1,time:2000});

                }
            });
        });
    }

</script>
<!--关注-->
<script type="text/javascript">
    //关注操作
    var SiteUrl = $('#SiteUrl').val();
    function follow(seller_id,sid) {

        layer.confirm('确认取消关注吗?', {
            btn: ['确认','取消'],
            icon: 3,
            title:'取消关注'
        }, function(){

            $.getJSON(SiteUrl+'/index.php/Ajax/Focus?seller_id='+seller_id+"&"+Math.random(), function(data){
//                if(data.status==1)  {
//                    layer.msg("关注成功！",{icon:1,time:1000},function(){
//                        $(".follow").html("已关注").removeClass("followbg");
//                    });
//                }
                 if(data.status==2){
                    layer.msg("关注已取消！",{icon:1,time:1000},function(){
                        $("#follow"+sid).remove();
                        var page_collect = $('#page_focus').text()-1;
                        $('#page_focus').text(page_collect)
                    });
                }
                 /*else if(data.status==-1){
                    layer.msg("请登录后关注!",{icon:1,time:1000},function(){
                        $(".graybg").show();
                    });
                } else if(data.status==-3) {
                    layer.msg("不能关注自己!",{icon:2,time:2000});

                }*/
                 else {
                    layer.msg("关注失败!",{icon:1,time:2000});

                }
            });
        });
    }




</script>

<!--选项卡-->
<script type="text/javascript">
    $(document).ready(function (){
                var i= $("#show_project").attr("data-value");
                if(i=="1"){
                    $("#show_project").attr("data-value",i);

                    $(".title ul li").eq(i).attr("class","on").siblings().attr("class","");

                    $(".lists").eq(i).attr("style","display:block").siblings().attr("style","display:none");
                }
            }
    );
        $(".title ul li").click(function(){
            var i = $(this).index();
            var a= $('#show_project').attr('data-value');
            if (i != a){
                $('#show_project').attr('data-value',i);
                change_page();
            }

            $(this).attr('class','on').siblings().attr('class','');

            $('.lists').eq(i).attr('style','display:block').siblings().attr('style','display:none');
        })


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