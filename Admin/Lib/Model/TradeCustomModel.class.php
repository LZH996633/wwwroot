<?php
class TradeCustomModel extends Model{
    static $Custom ;

    public function __construct()
    {
        self::$Custom = M('trade_custom');
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
        $Page -> setConfig('prev', "Previous page");//(Customize the format of thinkphp's own pagination▲▼)
        $Page -> setConfig('next','Next page');
        $Page -> setConfig('first','First');
        $Page -> setConfig('last','Last');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");

        $page = $Page->show();

        return $page;
    }

    public function getCustomList($where,$num,$p){
        $count = self::$Custom->where($where)->count();
        $page =  $this->getPage($num,$count);

        $CustomList = self::$Custom->where($where)->page($p.','.$num)->select();

        $DownList = array('count'=>$count,'page'=>$page,'list'=>$CustomList);

        return $DownList;
        
    }
}