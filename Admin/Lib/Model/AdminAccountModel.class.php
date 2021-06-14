<?php

class AdminAccountModel extends Model{
    static $Account;

    public function __construct()
    {
        self::$Account = M('admin_account');
    }

    public function getPage($num,$Count){
        import('ORG.Util.Page');// Import pagination class
        //$count      = $User->where('opus_category="'.$where.'"')->count();// Query the total number of records that meet the requirements
        $Page = new Page($Count,$num);// Instantiate the paging class, pass in the total number of records and the number of records displayed on each page
        // $page -> setConfig('header','Members');
        $Page -> setConfig('prev', "<");//(Customize the format of thinkphp's own pagination▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','首');
        $Page -> setConfig('last','尾');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");

        $page = $Page->show();

        return $page;
    }

    public function getLinkList($where,$num,$p){
        $count = self::$Account->where($where)->count();

        $page = $this->getPage($num,$count);

        $list = self::$Account->where($where)->page($p.','.$num)->select();

        $list = array(
            'count'=>$count,
            'page'=>$page,
            'list'=>$list
        );

        return $list;

    }


}