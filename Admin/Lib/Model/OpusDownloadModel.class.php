<?php

class OpusDownloadModel extends Model{
    static $OpusDown;
    public function __construct()
    {
        self::$OpusDown = M('opus_download');
    }

    /**
     * Pagination
     * @param $num
     * @param $Count
     * @return mixed|string
     */
    public function getPage($num,$Count){
        import('ORG.Util.Page');// Import pagination class
        //$count      = $User->where('opus_category="'.$where.'"')->count();// Query the total number of records that meet the requirements
        $Page = new Page($Count,$num);// Instantiate the paging class, pass in the total number of records and the number of records displayed on each page
        // $page -> setConfig('header','Members');
        $Page -> setConfig('prev', "<");//(Customize the format of thinkphp's own pagination▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','First');
        $Page -> setConfig('last','Last');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");

        $page = $Page->show();

        return $page;
    }
    public function getDownInfo($where){
        
        //Download file details
        $DownInfo = self::$OpusDown->where($where)->find();
              
        return $DownInfo;
    }
    public function getDownCount($where){
        //Number of downloads
        $DownCount = self::$OpusDown->where($where)->count();
        return $DownCount;
    }
public function getDownSum($where,$port){
	
	   $sum = self::$OpusDown->where($where)->sum($port);
	   return $sum;
}
    /**
     * Download information list
     * @param $where
     * @param $num
     * @param $p
     * @return array|false|mixed|PDOStatement|string|\think\Collection
     */
    public function getDownList($where,$num,$p){
        
        $count = self::$OpusDown->where($where)->count();
        //Pagination
        $page = $this->getPage($num,$count);

        $DownList = self::$OpusDown->where($where)->order('down_time DESC')->page($p.','.$num)->select();

        $DownList = array('count'=>$count,'page'=>$page,'list'=>$DownList);

         return $DownList;
    }
    
    public function delete($where){
        
        $result = self::$OpusDown->where($where)->delete();
        
        return $result;
    }
    public function add($data){
        $result = self::$OpusDown->data($data)->add();
        
        return $result;
    }
}
