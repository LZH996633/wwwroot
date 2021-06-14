<?php

class SysAdsModel extends Model{
     static $Ads;
    
    public function __construct()
    {
       self::$Ads = M('sys_ads');
    }

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

    public function getAdList($where,$num,$p){
        $count = self::$Ads->where($where)->count();

        $page = $this->getPage($num,$count);

        $list = self::$Ads->where($where)->page($p.','.$num)->select();

        $list = array(
            'count'=>$count,
            'page'=>$page,
            'list'=>$list
        );

        return $list;

    }

    public function home_page(){

    

    $where['ad_type'] = 1;

    $home_page = self::$Ads->where($where)->select();
    
    return $home_page;
}
    
}