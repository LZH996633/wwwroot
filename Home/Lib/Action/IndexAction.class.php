<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {

  public function get_array($cid=1,$limitp,$limits){
        $arr = array();

       if ($cid!=1){
           $cateModel = M('classify')->where(array('pid'=>$cid))->limit($limits)->select();
       }else{
           $cateModel = M('classify')->where(array('pid'=>$cid))->limit($limitp)->select();

       }
        foreach ($cateModel as $row){
            if ($row['cid']) {
                $arr[$row['cid']]['path'] = $row['path'];
                $arr[$row['cid']]['id'] = $row['cid'];
                $arr[$row['cid']]['name'] = $row['name'];
                //$home_show = M('opus')->where('opus_category like "'.$row['path'].'-'.$row['cid'].'%" OR opus_sort LIKE  "'.$row['path'].'-'.$row['cid'].'%"')->order('opus_updatetime DESC')->limit(13)->select();
                //$arr[$row['cid']]['show'] = $home_show;

                if (isset($row['cid']) != NULL) {
                    $arr[$row['cid']]['cid'] = $this->get_array($row['cid'],$limitp,$limits);
                }
            }
        }
        return $arr;
    }

    Public function erwei($cate,$pid=0){
        $arr=array();
        foreach($cate as $v){
            if($v['pid'] == $pid){
                $v['child']=self::erwei($cate,$v['id']);
                $arr[]=$v;
            }
        }
        return $arr;

    }
        public function index(){

            $Config = M('sys_config');
            $visit = $Config->where(array('name'=>'Visit'))->getField('value');
            $visit = $visit+1;
            $Config->where(array('name'=>'Visit'))->data(array('value'=>$visit))->save();
            //引用PublicAction
            $Public = new PublicAction();
            $Public->header();
            $Public->footer();

            $Opus = new OpusModel();
            $Opus->create();
        
            /*首页栏目信息*/
            $Classify = new ClassifyModel();
            $info =$Classify->findOne(array('location'=>1));
        
            $this->assign(array('info'=>$info));
           /*首页栏目信息结束*/

        
            /*分类显示区*/
            $Sort = M('sort');

            $sort = $Sort->select();

            $arr = $this->erwei($sort,$pid=0);

            $home_list = array();
            $home_list_limit = array();
            foreach ($arr as $key=>$value){
                if(strpos($value['kind'],"ort_")){

                    foreach ($value['child'] as $key_one=>$value_one){
                         if($key_one<5){
                             $home_list_limit[$value['kind']][]= $value_one ;
                         }
                        $home_list[$value['kind']][]= $value_one ;
                    }
                };
            }

       //首页热门用途栏目
        $home_use = $home_list['sort_use'];
        $home_use_limit = $home_list_limit['sort_use'];
       //首页热门行业栏目
        $home_industry = $home_list['sort_industry'];
        $home_industry_limit = $home_list_limit['sort_industry'];
       //首页热门风格栏目
        $home_style = $home_list['sort_style'];
        $home_style_limit = $home_list_limit['sort_style'];
       //赋值
        $this->assign(array('home_use'=>$home_use,'home_industry'=>$home_industry,'home_style'=>$home_style));
        $this->assign(array('home_use_limit'=>$home_use_limit,'home_industry_limit'=>$home_industry_limit,'home_style_limit'=>$home_style_limit));
        /*分类显示区结束*/
        
        /*首页作品列表*/
        $Opus = new OpusModel();
        
        //首页热门
        $orderHot = 'oext_views DESC';
        $home_HotList = $Opus->getHomeList($orderHot);
      //  $home_HotList = $Opus->getHomeList10($orderHot);   //提取  新发布的 数量  还有 拦截数量


     // dump($home_HotList);
	 

        //首页 yuanchang
        $home_HotList0 = $Opus->getHomeList0($orderHot);


        //首页最新     视频
        
        $orderNew = 'opus_updatetime DESC';


       // dump($Opus);

        $home_NewList = $Opus->getHomeList1($orderNew);


      $user = M('user');
      $classify = M('classify');

      for ($i=0; $i < count($home_NewList) ; $i++) {      //  循环输出 时间格式化


        $qqq =  $user->where('user_id',$list1[$i]['user_id'])->find();

       //  dump($qqq);

        $home_NewList[$i]['user_nickname']=$qqq['user_nickname'];

      
        $home_NewList[$i]['opus_sort']= $home_NewList[$i]['opus_sort'];


        $home_NewList[$i]['sjs']=$this->format_date(strtotime($home_NewList[$i]['opus_updatetime']));
       
    }

    for ($j=0; $j < count($home_NewList) ; $j++) {      //  循环输出 时间格式化


        $cid2= substr($home_NewList[$j]['opus_sort'],4);
        $home_NewList[$j]['cid2']= $cid2;
       
       $cid1 =  $classify->where(array('cid'=>$cid2))->find();

       $home_NewList[$j]['name']=$cid1['name'];


         //  dump($cid1);
        

    }





        //首页最新    3d
        
        $orderNews = 'opus_updatetime DESC';


       // dump($Opus);

        $home_NewLists = $Opus->getHomeList2($orderNews);
       // dump($home_NewLists);
        
      $user = M('user');
      $classify = M('classify');

      for ($i=0; $i < count($home_NewLists) ; $i++) {      //  循环输出 时间格式化


        $qqq =  $user->where('user_id',$list1[$i]['user_id'])->find();

        // dump($qqq);

        $home_NewLists[$i]['user_nickname1']=$qqq['user_nickname'];

      
        $home_NewLists[$i]['opus_sort']= $home_NewLists[$i]['opus_sort'];


        $home_NewLists[$i]['sjs1']=$this->format_date(strtotime($home_NewLists[$i]['opus_updatetime']));
      
    }

    for ($j=0; $j < count($home_NewLists) ; $j++) {      //  循环输出 时间格式化


        $cid2= substr($home_NewLists[$j]['opus_sort'],4);
        $home_NewLists[$j]['cid2']= $cid2;
       
       $cid1 =  $classify->where(array('cid'=>$cid2))->find();

       $home_NewLists[$j]['name1']=$cid1['name'];


       //  dump($cid2);


    }

    $this->assign('home_NewLists',$home_NewLists);







 //首页最新    AE
        
 $orderNews1 = 'opus_updatetime DESC';


 // dump($Opus);

  $home_NewLists1 = $Opus->getHomeList3($orderNews);
 // dump($home_NewLists);
  
$user = M('user');
$classify = M('classify');

for ($i=0; $i < count($home_NewLists1) ; $i++) {      //  循环输出 时间格式化


  $qqq =  $user->where('user_id',$list1[$i]['user_id'])->find();

  // dump($qqq);

  $home_NewLists1[$i]['user_nickname1']=$qqq['user_nickname'];


  $home_NewLists1[$i]['opus_sort']= $home_NewLists1[$i]['opus_sort'];


  $home_NewLists1[$i]['sjs1']=$this->format_date(strtotime($home_NewLists1[$i]['opus_updatetime']));

}

for ($j=0; $j < count($home_NewLists1) ; $j++) {      //  循环输出 时间格式化


  $cid2= substr($home_NewLists1[$j]['opus_sort'],4);
  $home_NewLists1[$j]['cid2']= $cid2;
 
 $cid1 =  $classify->where(array('cid'=>$cid2))->find();

 $home_NewLists1[$j]['name1']=$cid1['name'];


 //  dump($cid2);


}

$this->assign('home_NewLists1',$home_NewLists1);










 //首页最新    pr
        
 $orderNews = 'opus_updatetime DESC';


 // dump($Opus);

  $home_NewLists2 = $Opus->getHomeList4($orderNews);
 // dump($home_NewLists);
  
$user = M('user');
$classify = M('classify');

for ($i=0; $i < count($home_NewLists2) ; $i++) {      //  循环输出 时间格式化


  $qqq =  $user->where('user_id',$list1[$i]['user_id'])->find();

  // dump($qqq);

  $home_NewLists2[$i]['user_nickname1']=$qqq['user_nickname'];


  $home_NewLists2[$i]['opus_sort']= $home_NewLists2[$i]['opus_sort'];


  $home_NewLists2[$i]['sjs1']=$this->format_date(strtotime($home_NewLists2[$i]['opus_updatetime']));

}

for ($j=0; $j < count($home_NewLists2) ; $j++) {      //  循环输出 时间格式化


  $cid2= substr($home_NewLists2[$j]['opus_sort'],4);
  $home_NewLists2[$j]['cid2']= $cid2;
 
 $cid1 =  $classify->where(array('cid'=>$cid2))->find();

 $home_NewLists2[$j]['name1']=$cid1['name'];


 //  dump($cid2);


}

$this->assign('home_NewLists2',$home_NewLists2);








 //首页最新    ediues
        
 $orderNews = 'opus_updatetime DESC';


 // dump($Opus);

  $home_NewLists3 = $Opus->getHomeList5($orderNews);
 // dump($home_NewLists);
  
$user = M('user');
$classify = M('classify');

for ($i=0; $i < count($home_NewLists3) ; $i++) {      //  循环输出 时间格式化


  $qqq =  $user->where('user_id',$list1[$i]['user_id'])->find();

  // dump($qqq);

  $home_NewLists3[$i]['user_nickname1']=$qqq['user_nickname'];


  $home_NewLists3[$i]['opus_sort']= $home_NewLists3[$i]['opus_sort'];


  $home_NewLists3[$i]['sjs1']=$this->format_date(strtotime($home_NewLists3[$i]['opus_updatetime']));

}

for ($j=0; $j < count($home_NewLists3) ; $j++) {      //  循环输出 时间格式化


  $cid2= substr($home_NewLists3[$j]['opus_sort'],4);
  $home_NewLists3[$j]['cid2']= $cid2;
 
 $cid1 =  $classify->where(array('cid'=>$cid2))->find();

 $home_NewLists3[$j]['name1']=$cid1['name'];


 //  dump($cid2);


}

$this->assign('home_NewLists3',$home_NewLists3);

























        //首页最新推荐   下载排行
        $orderRecom = 'opus_updatetime DESC,recom DESC';
        $home_RecomList = $Opus->getHomeList($orderRecom);
        //首页一周热门
       // $sort = date('Y-m-d H:i:s',time()-3600*24*7);
        $orderWeek = 'oext_views DESC';
        $home_WeekList = $Opus->getHomeList($orderWeek);


        for ($l=0; $l < count($home_WeekList) ; $l++) {      //  循环输出 时间格式化


            $qqq1 =  $user->where('user_id',$list1[$l]['user_id'])->find();

           //  dump($qqq1);

            $home_WeekList[$l]['user_nickname']=$qqq1['user_nickname'];

          
            $home_WeekList[$l]['opus_sort']= $home_WeekList[$l]['opus_sort'];


        //    $home_WeekList[$i]['sjs']=$this->format_date(strtotime($home_WeekList[$i]['opus_updatetime']));
        }

        for ($j=0; $j < count($home_WeekList) ; $j++) {      //  循环输出 时间格式化


            $cid2= substr($home_WeekList[$j]['opus_sort'],4);
           
           $cid1 =  $classify->where(array('cid'=>$cid2))->find();

           $home_WeekList[$j]['name']=$cid1['name'];


            //   dump($cid1);


        }







        if($home_WeekList){

        }else{
            $orderWeek = 'oext_views DESC';
            $home_WeekList = $Opus->getHomeList($orderWeek);
        }
        $this->assign(array('home_HotList'=>$home_HotList,'home_HotList0'=>$home_HotList0,'home_NewList'=>$home_NewList,'home_RecomList'=>$home_RecomList,'home_WeekList'=>$home_WeekList));
        //实例化广告模型
            $Ad = M('sys_ads');
            $ad_list= $Ad->where(array('ad_locationpic'=>'station_banner'))->select();

            $this->assign(array('ad_list'=>$ad_list));

        $this->display(); // 输出模板
	}

    public function most(){

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





    /**
     * @return mixed 最新悬赏
     */
   public function newobj(){
       $opus = M('opus');
      $newobj =  $opus->order('opus_updatetime DESC')->limit(10)->select();
       return $newobj;
   }

    /**
     * @return false|mixed|PDOStatement|string|\think\Collection 友情链接
     */
    public function link(){
        $link =M('sys_link');
        $links = $link->select();
        return $links;
    }

    public function hot(){
        $opusModel = M('opus');
        $hot1 = $opusModel->order('opus_updatetime DESC')->limit(0,4)->select();
        $hot2 = $opusModel->order('opus_updatetime DESC')->limit(5,4)->select();
        $hot3 = $opusModel->order('opus_updatetime DESC')->limit(9,4)->select();
        $hot4 = $opusModel->order('opus_updatetime DESC')->limit(13,4)->select();
        $hot5 = $opusModel->order('opus_updatetime DESC')->limit(17,4)->select();
        $hot =array($hot1,$hot2,$hot3,$hot4,$hot5);

        return $hot;
    }
   public function headsearch(){


    }

}




