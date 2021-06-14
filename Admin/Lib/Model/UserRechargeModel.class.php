<?php
class UserRechargeModel extends Model{
    static $UserRecharge;
    
    public function __construct()
    {
        self::$UserRecharge = M('user_recharge');
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
    
    
    public function getRechargeList($where,$num,$p){
        
        $count = self::$UserRecharge->where($where)->count();
        
        $page = $this->getPage($num,$count);
        
        $RechargeList = self::$UserRecharge->where($where)->order('acct_time DESC')->page($p.','.$num)->select();

        $RechargeListShow = array('count'=>$count,'page'=>$page,'list'=>$RechargeList);
        
        return $RechargeListShow;
    }
    
    public function getRechargeInfo($where){
    $result = self::$UserRecharge->where($where)->find();
        return $result;
}
    public function save($where,$data){
        $result = self::$UserRecharge->where($where)->save($data);
        
        return $result;
    }
}