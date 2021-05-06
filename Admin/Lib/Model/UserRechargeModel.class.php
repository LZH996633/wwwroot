<?php
class UserRechargeModel extends Model{
    static $UserRecharge;
    
    public function __construct()
    {
        self::$UserRecharge = M('user_recharge');
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
        $Page -> setConfig('prev', "<");//(对thinkphp自带分页的格式进行自定义▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','首');
        $Page -> setConfig('last','尾');
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