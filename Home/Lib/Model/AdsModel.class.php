<?php

class AdsModel extends Model{
     static $Ads;
    
    public function __construct()
    {
       self::$Ads = M('sys_ads');
    }

    public function home_page(){

    

    $where['ad_type'] = 1;

    $home_page = self::$Ads->where($where)->select();
    
    return $home_page;
}

    
}