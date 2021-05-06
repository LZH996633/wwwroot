<?php

class SysAdsModel extends Model{
     static $Ads;
    
    public function __construct()
    {
       self::$Ads = M('sys_ads');
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