<?php

class SearchAction extends CommonAction{

    public function index(){
        //引用PublicAction
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();

        $Sort = M('sort');
        //获取传值
        $half = I('half');
        if (I('half')!=''){
            cookie('half',$half);
        }

        $this->assign(array('is_half'=>$half));
        $search = I('search');
        if ($search!=''){
            cookie('search',$search);
        }
        $search = cookie('search');
        $this->assign('search',$search);
        $tip_order = I('order');//排序
        $tip_index = I('index');//排序显示


        $tip_color = I('color');      //颜色
        $tip_software = I('software');//软件
        $tip_scale = I('scale');      //比例
        $tip_type = I('type');       //类型

        if ($tip_index!=''){
            cookie('tip_index',$tip_index);
        }else{
            cookie('tip_index','0');
        };
        if ($tip_order!=''){
            cookie('tip_order',$tip_order);
        }
        $order = cookie('tip_order');
        
        $this->assign(array('tip_index'=>cookie('tip_index')));

        //中部分类
        $tip_middle = array(
            'tip_color'=>$tip_color,
            'tip_software'=>$tip_software,
            'tip_scale'=>$tip_scale,
            'tip_type'=>$tip_type
        );
        //中部分类
        foreach ($tip_middle as $key=>$value){
            if($value!=''){
                cookie($key,$value);
            }
        }
        //清除
        if(I('tip_clear')!=''){
            $clear_kind = $Sort->where(array('id'=>I('tip_clear')))->getField('kind');
            cookie('tip_'.$clear_kind,null);
            if(I('tip_clear')=='all'){
                cookie(null,'tip_');
            }
        }
        //中部分类
        $tip_middle_show = array(
            'tip_color'=>cookie('tip_color'),
            'tip_software'=>cookie('tip_software'),
            'tip_scale'=>cookie('tip_scale'),
            'tip_type'=>cookie('tip_type')
        );

        $tip_show =array();
        foreach ($tip_middle_show as $key=>$value){
            if ($value!=''){
                $tip_show[$key] = $value;
            }
        }
        foreach ($tip_show as $key=>$value){
            $tip_show_name = $Sort->where(array('id'=>$value))->getField('name');
            $tip_show[$key] = array('id'=>$value,'name'=>$tip_show_name);
        }
        $this->assign(array('tip_show'=>$tip_show));

        /*查询条件构建*/
        $where = null;
        $where = array();
        foreach ($tip_show as $key=>$value){
            $where[$key] = $value['id'];
        }
       /*查询条件构建结束*/

        /*中部查询*/
        $where_other['kind'] = array('like','other_%');
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

        //精准搜索标识
        if(isset($_GET['action'])){
            $where['opus_title'] = $search;

        }else{
            $where['opus_keyword|opus_title'] = array('like','%'.$search.'%');
        };

        //页码
        if ($_GET['p']=='') {
            $p = 1;
        } else {
            $p = $_GET['p'];
        }

        //查询
        $Opus = new OpusModel();
        $SearchListShow = $Opus->getOpusList($path='',$order,$where,$num=20,$p);

        $SearchList = $SearchListShow['list'];
        $page = $SearchListShow['page'];
        $count = $SearchListShow['count'];

        $this->assign(array('search'=>$search,'SearchList'=>$SearchList,'page'=>$page,'count'=>$count));
     

        $this->display();
    }
}