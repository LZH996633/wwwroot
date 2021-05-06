<?php

class OpusModel extends Model{
    
    static $Opus;

    public function __construct()
    {
        self::$Opus = M('opus');
    }
    public function getPage($num,$Count){
        import('ORG.Util.Page');// 导入分页类
        //$count      = $User->where('opus_category="'.$where.'"')->count();// 查询满足要求的总记录数
        $Page = new Page($Count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        // $page -> setConfig('header','个会员');
        $Page -> setConfig('prev', "<");//(对thinkphp自带分页的格式进行自定义▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','首');
        $Page -> setConfig('last','尾');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");
        
        $page = $Page->show();

       return $page;
    }
    public function getOpusList($order,$where,$num,$p){

        if ($order==''){
           $order = 'opus_createtime';
       }

            $count = self::$Opus->where($where)->count();
            $page = $this->getPage($num,$count);

            $OpusList = self::$Opus->where($where)->order($order.' DESC')->page($p.','.$num)->select();

            $OpusListShow=array('list'=>$OpusList,'page'=>$page,'count'=>$count);
                  return $OpusListShow;

    }
  // public function create(){
    //    for ($i=0;$i<20;$i++){
//

  //  $data['user_id'] = '1';
  //   $data['opus_sort'] = '0-1-2-11-15';
  //   $data['opus_pic'] = '5.jpg';
  //   $data['opus_title'] = '企业培训之沟通技巧PPT';
   //   $data['opus_createtime']= date('Y-m-d H:i:s',time());
  //     self::$Opus->data($data)->add();
 // }}
    public function create(){
        $where['use_id']='1';
        self::$Opus->where($where)->setField(array('opus_picbig'=>'con-img1.png','opus_updatetime'=>date('Y-m-d H:i:s',time())));
    }

    public function getOpusDetail($where){
  
        $OpusDetail = self::$Opus->where($where)->find();
        //var_dump($OpusDetail);
        return $OpusDetail;
    }
    public function getSameList($cid){
        $self = self::$Opus->where('opus_id='.$cid)->find();
        $where['opus_sort'] = $self['opus_sort'];
        $SameList = self::$Opus->where($where)->order('oext_views DESC')->limit(20)->select();
        return $SameList;
    }
    public function getOpusCount($where){
       
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
        if ($sort==null){
            $list = self::$Opus->order($order)->limit(20)->select();
            return $list;
        }else{
            $where['opus_updatetime'] = array('GT',$sort);
            $list = self::$Opus->where($where)->order($order)->limit(20)->select();
            return $list;
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