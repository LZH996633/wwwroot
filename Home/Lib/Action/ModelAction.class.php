<?php
// 本类由系统自动生成，仅供测试用途
class ModelAction extends CommonAction {

    /**
     * 列表页
     */
    public function index(){
        /*实例化模型*/

        $Classify = new ClassifyModel();//栏目
        $Opus = new OpusModel();        //作品
        $Sort = M('sort');              //分类
        $start_list = $Sort->where(array('kind'=>'sort'))->select();
        foreach ($start_list as $key=>$value){
            cookie('sort_'.$value['id'],$value['id']);
        }

        /*获取传值*/
             $cid = I('cid');
        if($cid!=''){
            cookie('cid',$cid);
            cookie(null,'tip_');
        }

        $cid = $_COOKIE['cid'];
        $is_half = M('classify')->where(array('cid'=>$cid))->getField('type');

        $this->assign(array('is_half'=>$is_half));
        /*分类查询传值*/

        $tip_sort = I('sort');   //顶部分类
        //$tip_other = I('other');//中部分类

        $tip_order = I('order');//排序
        $tip_index = I('index');//排序显示

        $tip_use = I('use');          //用途
        $tip_industry = I('industry');//行业
        $tip_style = I('style');      //风格
        $tip_color = I('color');      //颜色
        $tip_software = I('software');//软件
         $tip_scale = I('scale');      //比例
        $tip_type = I('type');        //类型
        /*获取传值结束*/

        /*写入数组*/
        //头部分类
        $tip_head = array(
            'tip_use'=>$tip_use,
            'tip_industry'=>$tip_industry,
            'tip_style'=>$tip_style,

        );
        //中部分类
        $tip_middle = array(
            'tip_color'=>$tip_color,
            'tip_software'=>$tip_software,
            'tip_scale'=>$tip_scale,
            'tip_type'=>$tip_type
        );
      
       // var_dump($tip_head);

        /*写入COOKIE*/
        //头部分类
        foreach ($tip_head as $key=>$value){
             if($value!=''){
                 cookie($key,$value);

             }
        }
        //中部分类
        foreach ($tip_middle as $key=>$value){
            if($value!=''){
                cookie($key,$value);
            }
        }
        //重置子类选项
        if($tip_sort!=''){
            $kind_son= $Sort->where(array('pid'=>$tip_sort))->getField('kind');
            cookie('tip_'.$kind_son,null);
            cookie('sort_'.$tip_sort,$tip_sort);
           }
        if(I('tip_clear')!=''){
              $clear_kind = $Sort->where(array('id'=>I('tip_clear')))->getField('kind');
              cookie('tip_'.$clear_kind,null);
        }
        //头部分类展示
        $tip_head_show = array(
            'tip_use'=>cookie('tip_use'),
            'tip_industry'=>cookie('tip_industry'),
            'tip_style'=>cookie('tip_style'),

        );
        foreach ($tip_head_show as $key=>$value){
            $pid = $Sort->where(array('id'=>$value))->getField('pid');
            cookie('sort_'.$pid,null);
        }

        foreach ($_COOKIE as $key=>$value){
            $return = preg_match("/^sort_/",$key);
            if ($return==1){
                $sort_show[] = $value;
            }
        }
        $this->assign(array('sort_show'=>$sort_show));
        //中部分类
        $tip_middle_show = array(
            'tip_color'=>cookie('tip_color'),
            'tip_software'=>cookie('tip_software'),
            'tip_scale'=>cookie('tip_scale'),
            'tip_type'=>cookie('tip_type')
        );
       // var_dump($tip_head_show);
        $this->assign(array('tip_head_show'=>$tip_head_show));

        $tip_show_first = array_merge($tip_head_show,$tip_middle_show);
         $tip_show =array();
        foreach ($tip_show_first as $key=>$value){
            if ($value!=''){
                $tip_show[$key] = $value;
            }
        }
        foreach ($tip_show as $key=>$value){
            $tip_show_name = $Sort->where(array('id'=>$value))->getField('name');
            $tip_show[$key] = array('id'=>$value,'name'=>$tip_show_name);
        }
        $this->assign(array('tip_show'=>$tip_show));
        //var_dump($tip_show);

       // var_dump($tip_head_show);
        /*写入COOKIE结束*/


        /*综合查询*/


        /*导航标识区*/
        $tip_info = $Classify->findOne(array('cid'=>$_COOKIE['cid']));
        
        $this->assign(array('tip_info'=>$tip_info));

        /*导航标识区结束*/
 
       /*查询条件构建*/
        $where = null;
        $where = array();
        foreach ($tip_show as $key=>$value){
            $where[$key] = $value['id'];
        }
        /*查询条件构建结束*/

        /*排序构建*/

        if ($tip_order!=''){
            cookie('tip_order',$tip_order);
        }
        if ($tip_index!=''){
            cookie('tip_index',$tip_index);
        }else{
            cookie('tip_index','0');
        }
        $this->assign(array('tip_index'=>cookie('tip_index')));

        $order = cookie('tip_order');

        /*排序构建结束*/

        /*分类查询区*/
        /*顶部查询列表*/
        if($tip_sort!=''){
            $tip_info = $Sort->where(array('pid'=>$tip_sort))->find();
            $tip_kind = $tip_info['kind'];
            cookie($tip_kind,null);
        }
        $where_sort['kind'] = array('like','sort_%');
        $sort = $Sort->where($where_sort)->select();
        foreach ($sort as $key=>$value){
            $sort_son = $Sort->where(array('pid'=>$value['id']))->select();
            $value['son'] = $sort_son;
            $sort[$key] = $value;
        }
        $this->assign(array('sort'=>$sort));

        /*中部查询*/
        $where_other['kind'] = array('like','other_%') ;
        $sort_middle = $Sort->where($where_other)->select();
        $middle = array();
        foreach ($sort_middle as $key_middle=>$value_middle){
            $son_kind = $Sort->where(array('pid'=>$value_middle['id']))->find();
            $kind = $son_kind['kind'];

            $sort_son = $Sort->where(array('pid'=>$value_middle['id']))->select();
            $value_middle['son'] = $sort_son;

            $middle[$kind] = $value_middle;
        }
        $sort_color = $middle['color'];
        $sort_software = $middle['software'];
        $sort_type = $middle['type'];
        $sort_scale = $middle['scale'];
        
        $this->assign(array('sort_color'=>$sort_color,'sort_software'=>$sort_software,'sort_type'=>$sort_type,'sort_scale'=>$sort_scale));

        /*分类查询区结束*/

       /*公共头尾引用*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        /*公共头尾引用结束*/

        /*页码*/
        if ($_GET['p']=='') {
            $p = 1;
        } else {
            $p = $_GET['p'];
        }
        /*页码结束*/

       /*作品列表展示区*/
        $path =  $Classify->getPath($cid);
        $is_half = M('classify')->where(array('cid'=>$cid))->getField('type');
        if($is_half=='half'){
            $where['is_half']='1';
        }

        $OpusListShow = $Opus->getOpusList($path,$order,$where,$num=20,$p);

        $OpusList = $OpusListShow['list'];
        $page = $OpusListShow['page'];
        $count = $OpusListShow['count'];


        $user = M('user');
        for ($i=0; $i < count($OpusList) ; $i++) {      //  循环输出 时间格式化


            $qqq =  $user->where('user_id',$list1[$i]['user_id'])->find();

            // dump($qq);

            $OpusList[$i]['user_nickname']=$qqq['user_nickname'];

            $OpusList[$i]['sjs']=$this->format_date(strtotime($OpusList[$i]['opus_updatetime']));
        }



       $this->assign(array('OpusList'=>$OpusList,'page'=>$page,'count'=>$count));
        /*作品列表展示区结束*/
        /*//列表页banner图
         $ad = M('sys_ads');
        $adlist = $ad->where('ad_type=2')->find();
        $this->assign('adlist', $adlist);*/
       // dump($OpusList);






        $this->display(); // 输出模板*/





	 }














    /**
     * 详情页
     */
	public function model(){
        //引用PublicAction
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();

        $cid = I('cid');
        $Opus = new OpusModel();
        //获取作品详情
        $where=null;
        $where['opus_id'] = $cid;

        $OpusDetail = $Opus->getOpusDetail($where);
        $oext_views = $OpusDetail['oext_views']+1;
        $Opus->Update($where,array('oext_views'=>$oext_views));
        //获取推荐搜索 取关键词
        $OpusSearch = $OpusDetail['opus_keyword'];

        $OpusSearch = explode("-",$OpusSearch);

        $Sort = M('sort');

        $name_type = $Sort->where(array('id'=>$OpusDetail['tip_type']))->getField('name');
        $OpusDetail['tip_type'] = $name_type;

        $name_software = $Sort->where(array('id'=>$OpusDetail['tip_software']))->getField('name');
        $OpusDetail['tip_software'] = $name_software;



        $this->assign('OpusSearch',$OpusSearch);
        $this->assign('OpusDetail',$OpusDetail);

        //获取同级推荐
        $SameList = $Opus->getSameList($cid);
        $this->assign('SameList',$SameList);



        //获取详情页评论区
        $opus_comment = M('opus_comment');
        $where['opus_id']=$cid;      
 
        $list1 =  $opus_comment->where($where)->order('cmt_createtime DESC')->limit(10)->select();

        $user = M('user');

        for ($i=0; $i < count($list1) ; $i++) { 

            $qq =  $user->where('user_id',$list1[$i]['user_id'])->find();

            // dump($qq);

            $list1[$i]['user_nickname']=$qq['user_nickname'];


            $list1[$i]['sj']=$this->format_date(strtotime($list1[$i]['cmt_createtime']));

        }
      
        $coment =  count($list1) ;

        $this->assign('list1',$list1);

        $this->assign('coment',$coment);
      




        //作品用户信息
        $User = new UserModel();
        $user_id = $OpusDetail['user_id'];
        $where=null;
        $where['user_id'] = $user_id;
        
        $OpusCount = $Opus->getOpusCount($where);
        $UserInfo = $User->getUserInfo($user_id);
        $this->assign(array('OpusCount'=>$OpusCount,'UserInfo'=>$UserInfo));



    	$this->display();
    }




    public function format_date($time){
        $t=time()-$time;
        $f=array(
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'周',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        );
        foreach ($f as $k=>$v)    {
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

    //广告位
    public function adver(){

    }

    /**
     * 下载页
     */
    public function loading(){

        $cid = I('opus_id');

        $Opus = new OpusModel();
        //获取作品详情
        $where=null;
        $where['opus_id'] = $cid;
       
        $OpusDetail = $Opus->getOpusDetail($where);

        if($OpusDetail['is_half']=='1'){
           
            $half_price = $OpusDetail['prices'];      //新添加免费 交易币  L币
            $half_price = number_format($half_price);
            
        }
        $Sort = M('sort');

        $name_type = $Sort->where(array('id'=>$OpusDetail['tip_type']))->getField('name');
        $OpusDetail['tip_type'] = $name_type;

        $name_software = $Sort->where(array('id'=>$OpusDetail['tip_software']))->getField('name');
        $OpusDetail['tip_software'] = $name_software;

        $this->assign('half_price',$half_price);
        $this->assign('OpusDetail',$OpusDetail);
       
        //获取同级推荐
        $SameList = $Opus->getSameList($cid);
        $this->assign('SameList',$SameList);


        $Ad = M('sys_ads');
        $ad_down = $Ad->where(array('ad_locationpic'=>'ad_down'))->find();
        $this->assign(array('ad_down'=>$ad_down));

   
        $this->display('Model/loading');
    }

}