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


    public function getOpusDetail($where){
  
       $OpusDetail = self::$Opus->where($where)->find();
      //  var_dump($OpusDetail);
       return $OpusDetail;
    }




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