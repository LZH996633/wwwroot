<?php

class OpusModel extends Model{
    
    static $Opus;
   // static $opus_comment;
    public function __construct()
    {
        self::$Opus = M('opus');
     //  self::$opus_comment = M('opus_comment');
    }
    public function getPage($num,$Count){
        import('ORG.Util.Page');// 导入分页类
        //$count      = $User->where('opus_category="'.$where.'"')->count();// 查询满足要求的总记录数
        $Page = new Page($Count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        // $page -> setConfig('header','个会员');
        $Page -> setConfig('prev', "上一页");//(对thinkphp自带分页的格式进行自定义▲▼)
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('first','首页');
        $Page -> setConfig('last','尾页');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");
        
        $page = $Page->show();

       return $page;
    }
    public function getOpusList($path='',$order,$where,$num,$p){

        if ($order==''){
           $order = 'opus_createtime';
       }

    if ($path!=''){
        $where['opus_sort'] = array('like','%'.$path.'%');

        $Class = M('classify');
        $class = $Class->where('cid='.$_COOKIE['cateid'])->find();

        if ($class['type']=='half'){
            $where['is_half'] = '1';
         //   $where['opus_verify'] = '1';
            unset($where['opus_sort']);
        }/*else{
            $where['is_half'] = '0';
        }*/
       }
            $count = self::$Opus->where($where)->count();
            $page = $this->getPage($num,$count);
            $where['opus_verify']  = array('EQ','1');
            $OpusList = self::$Opus->where($where)->order($order.' DESC')->page($p.','.$num)->select();

            $OpusListShow=array('list'=>$OpusList,'page'=>$page,'count'=>$count);
                  return $OpusListShow;

    }
   /*public function create(){
        for ($i=0;$i<20;$i++){


    $data['user_id'] = '1';
     $data['opus_sort'] = '0-1-2-11-15';
     $data['opus_pic'] = '5.jpg';
     $data['opus_title'] = '企业培训之沟通技巧PPT';
      $data['opus_createtime']= date('Y-m-d H:i:s',time());
       self::$Opus->data($data)->add();
   }}*/
   /* public function create(){
        $where['use_id']='1';
        self::$Opus->where($where)->setField(array('opus_picbig'=>'con-img1.png','opus_updatetime'=>date('Y-m-d H:i:s',time())));
    }*/

    public function getOpusDetail($where){
  
       $OpusDetail = self::$Opus->where($where)->find();
      //  var_dump($OpusDetail);
       return $OpusDetail;
    }



   
                                            //  新添加商品评论
  

  //   `cmt_id` decimal(8,0) NOT NULL COMMENT '评论ID',
  //   `opus_id` decimal(8,0) DEFAULT NULL COMMENT '作品编号',
  //   `user_id` decimal(8,0) DEFAULT NULL COMMENT '用户编号',
  //   `cmt_parentid` decimal(8,0) NOT NULL DEFAULT '0' COMMENT '评论父ID',
   //  `cmt_path` varchar(200) NOT NULL COMMENT '评论路径（如：1/、2/、2.1/、2.2/、3/）',
   //  `cmt_topic` char(1) NOT NULL DEFAULT '1' COMMENT '是否是主题',
  //   `cmt_status` char(1) NOT NULL DEFAULT '1' COMMENT '评论状态（1显示0不显示）',
  //   `cmt_content` varchar(500) NOT NULL COMMENT '评论内容',
  //  `cmt_top` int(11) NOT NULL DEFAULT '0' COMMENT '顶、赞的次数',
  //   `cmt_report` int(11) NOT NULL DEFAULT '0' COMMENT '举报次数',
 //   `cmt_createip` varchar(15) NOT NULL COMMENT '评论创建IP',
 //    `cmt_createtime` datetime NOT NULL COMMENT '评论创建时间',
  //   `cmt_edittime` datetime DEFAULT NULL COMMENT '评论编辑时间（为空则说明此评论未被编辑过）',




    public function getSameList($cid){
        $self = self::$Opus->where('opus_id='.$cid)->find();
        $where['opus_sort'] = $self['opus_sort'];
        $where['opus_verify']  = array('EQ','1');
        $SameList = self::$Opus->where($where)->order('oext_views DESC')->limit(20)->select();

      // var_dump($cid);
        return $SameList;




        
    }
    public function getOpusCount($where){
        $where['opus_verify']  = array('EQ','1');
        $OpusCount = self::$Opus->where($where)->count();
        return $OpusCount;
    }

    /**
     * 首页作品列表
     * @param $order   /排序方式
     * @param string $sort /查询条件
     * @return mixed  /返回数组
     */
    public function getHomeList($order,$sort='',$limit){

       if ($sort==null|| $sort==''){

        $where['opus_verify']  = array('EQ','1');



        $where['recom']  = array('EQ','1');
            $list = self::$Opus->where($where)->order($order)->limit(16)->select();

           

           return $list;



        }else{

            $where['opus_updatetime'] = array('GT',$sort);
            $where['opus_verify']  = array('EQ','1');
            $where['recom']  = array('EQ','1');
            $list = self::$Opus->where($where)->order($order)->limit(16)->select();



           return $list;





        }

    }



    /**
     * 首页作品列表               yuanchang
     * @param $order   /排序方式
     * @param string $sort /查询条件
     * @return mixed  /返回数组
     */
    public function getHomeList0($order,$sort='',$limit){

       if ($sort==null|| $sort==''){

        $where['opus_verify']  = array('EQ','1');
        $where['opus_source']  = array('EQ','1');
            $list = self::$Opus->where($where)->order($order)->limit(3)->select();

           

           return $list;



        }else{

            $where['opus_updatetime'] = array('GT',$sort);
            $where['opus_verify']  = array('EQ','1');
            $where['opus_source']  = array('EQ','1');
            $list = self::$Opus->where($where)->order($order)->limit(3)->select();



           return $list;





        }

    }



  /**
     * 首页作品最新列表
     *   /排序方式  按栏目来排序
     * 
     * 就是大类  ID排序       AE
     */

    public function getHomeList1($order,$sort='',$limit){

        if ($sort==null|| $sort==''){
          ///  $cid2= substr($home_NewList[$j]['opus_sort'],4);
         $where['opus_verify']  = array('EQ','1');
         $where ['opus_sort'] = array('EQ','0-1-3');
         $where['recom']  = array('EQ','1');
             $list = self::$Opus->where($where)->order($order)->limit(4)->select();

          //   var_dump($list);
            return $list;
 
         }else{
 
             $where['opus_updatetime'] = array('GT',$sort);
             $where['opus_verify']  = array('EQ','1');
             $where ['opus_sort'] = array('EQ','0-1-3');
             $where['recom']  = array('EQ','1');
             $list = self::$Opus->where($where)->order($order)->limit(4)->select();
            return $list;
 
         }
 
     }




  /**
     * 首页作品最新列表
     *   /排序方式  按栏目来排序
     * 
     * 就是大类  ID排序        pr
     */

     public function getHomeList2($order,$sort='',$limit){

        if ($sort==null|| $sort==''){
   
         $where['opus_verify']  = array('EQ','1');
         $where ['opus_sort'] = array('EQ','0-1-5');
         $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();

 
            return $list1;
 
         }else{
 
             $where['opus_updatetime'] = array('GT',$sort);
             $where['opus_verify']  = array('EQ','1');
             $where ['opus_sort'] = array('EQ','0-1-5');
             $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();
            return $list1;
 
         }
 
     }



  /**
     * 首页作品最新列表
     *   /排序方式  按栏目来排序
     * 
     * 就是大类  ID排序       达芬奇模板
     */

    public function getHomeList3($order,$sort='',$limit){

        if ($sort==null|| $sort==''){
   
         $where['opus_verify']  = array('EQ','1');
         $where ['opus_sort'] = array('EQ','0-1-2');
         $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();

 
            return $list1;
 
         }else{
 
             $where['opus_updatetime'] = array('GT',$sort);
             $where['opus_verify']  = array('EQ','1');
             $where ['opus_sort'] = array('EQ','0-1-2');
             $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();
            return $list1;
 
         }
 
     }








  /**
     * 首页作品最新列表
     *   /排序方式  按栏目来排序
     * 
     * 就是大类  ID排序       竖幅模板专区（手机）
     */

    public function getHomeList4($order,$sort='',$limit){

        if ($sort==null|| $sort==''){
   
         $where['opus_verify']  = array('EQ','1');
         $where ['opus_sort'] = array('EQ','0-1-4');
         $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();

 
            return $list1;
 
         }else{
 
             $where['opus_updatetime'] = array('GT',$sort);
             $where['opus_verify']  = array('EQ','1');
             $where ['opus_sort'] = array('EQ','0-1-4');
             $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();
            return $list1;
 
         }
 
     }




  /**
     * 首页作品最新列表
     *   /排序方式  按栏目来排序
     * 
     * 就是大类  ID排序        视频素材
     */

    public function getHomeList5($order,$sort='',$limit){

        if ($sort==null|| $sort==''){
   
         $where['opus_verify']  = array('EQ','1');
         $where ['opus_sort'] = array('EQ','0-1-6');
         $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();

 
            return $list1;
 
         }else{
 
             $where['opus_updatetime'] = array('GT',$sort);
             $where['opus_verify']  = array('EQ','1');
             $where ['opus_sort'] = array('EQ','0-1-6');
             $where['recom']  = array('EQ','1');
             $list1 = self::$Opus->where($where)->order($order)->limit(4)->select();
            return $list1;
 
         }
 
     }














//    //模糊搜索
//    public function FuzzySearch($search){
//        $where['opus_keyword|opus_title'] = array('like','%'.$search.'%');
//        $result = self::$Opus->where($where)->order()->select();
//        return $result;
//
//    }
//    //精准搜索
//    public function AccurateSearch($search){
//             $where['opus_title'] = $search;
//        $result = self::$Opus->where($where)->order()->select();
//        return $result;
//    }
    
    public  function Update($where,$data){
        $result = self::$Opus->where($where)->save($data);
        return $result;
   }
    public function Delete($where){
        
        $result = self::$Opus->where($where)->delete();
        
        return $result;
    }
    
    public function addData($data){
        $result = self::$Opus->data($data)->add();
        return $result;
    
}




}