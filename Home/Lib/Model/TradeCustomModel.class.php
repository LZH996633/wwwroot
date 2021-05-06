<?php
class TradeCustomModel extends Model{
    static $Custom ;

    public function __construct()
    {
        self::$Custom = M('trade_custom');
    }
    /**
     * 分页
     * @param $num
     * @param $Count
     * @return mixed|string
     */
    public function getPage($num,$Count){
        import('ORG.Util.Page');// 导入分页类
        //$count      = $User->where('opus_category="'.$where.'"')->count();// 查询满足要求的总记录数
        $Page = new Page($Count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        // $page -> setConfig('header','个会员');
        $Page -> setConfig('prev', "上一页");//(对thinkphp自带分页的格式进行自定义▲▼)
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('first','首');
        $Page -> setConfig('last','尾');
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