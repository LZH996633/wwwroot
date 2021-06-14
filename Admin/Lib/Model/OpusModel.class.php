<?php

class OpusModel extends Model{
    
    static $Opus;

    public function __construct()
    {
        self::$Opus = M('opus');
    }
    public function getPage($num,$Count){
        import('ORG.Util.Page');// Import pagination class
        //$count      = $User->where('opus_category="'.$where.'"')->count();// Query the total number of records that meet the requirements
        $Page = new Page($Count,$num);// Instantiate the paging class, pass in the total number of records and the number of records displayed on each page
        // $page -> setConfig('header','Members');
        $Page -> setConfig('prev', "<");//(Customize the format of thinkphp's own pagination▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','First');
        $Page -> setConfig('last','last');
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
     * Homepage list of works
     * @param $order   /Sort by
     * @param string $sort /Query conditions
     * @return mixed  /Return array
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
//    //Fuzzy search
//    public function FuzzySearch($search){
//        $where['opus_keyword|opus_title'] = array('like','%'.$search.'%');
//        $result = self::$Opus->where($where)->order()->select();
//        return $result;
//
//    }
//    //Precise search
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