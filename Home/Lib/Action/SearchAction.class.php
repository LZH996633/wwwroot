<?php

class SearchAction extends CommonAction{

    public function index(){
        //Reference to PublicAction
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();

        $Sort = M('sort');
        //Get pass value
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
        $tip_order = I('order');//Sorting
        $tip_index = I('index');//Sort display


        $tip_color = I('color');      //colour
        $tip_software = I('software');//software
        $tip_scale = I('scale');      //proportion
        $tip_type = I('type');       //Types of

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

        //Middle class
        $tip_middle = array(
            'tip_color'=>$tip_color,
            'tip_software'=>$tip_software,
            'tip_scale'=>$tip_scale,
            'tip_type'=>$tip_type
        );
        //Middle class
        foreach ($tip_middle as $key=>$value){
            if($value!=''){
                cookie($key,$value);
            }
        }
        //Clear
        if(I('tip_clear')!=''){
            $clear_kind = $Sort->where(array('id'=>I('tip_clear')))->getField('kind');
            cookie('tip_'.$clear_kind,null);
            if(I('tip_clear')=='all'){
                cookie(null,'tip_');
            }
        }
        //Middle class
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

        /*Query condition construction*/
        $where = null;
        $where = array();
        foreach ($tip_show as $key=>$value){
            $where[$key] = $value['id'];
        }
       /*End of query condition construction*/

        /*Central inquiry*/
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

        //Accurate search mark
        if(isset($_GET['action'])){
            $where['opus_title'] = $search;

        }else{
            $where['opus_keyword|opus_title'] = array('like','%'.$search.'%');
        };

        //page number
        if ($_GET['p']=='') {
            $p = 1;
        } else {
            $p = $_GET['p'];
        }

        //Inquire
        $Opus = new OpusModel();
        $SearchListShow = $Opus->getOpusList($path='',$order,$where,$num=20,$p);

        $SearchList = $SearchListShow['list'];
        $page = $SearchListShow['page'];
        $count = $SearchListShow['count'];

        $this->assign(array('search'=>$search,'SearchList'=>$SearchList,'page'=>$page,'count'=>$count));
     

        $this->display();
    }
}