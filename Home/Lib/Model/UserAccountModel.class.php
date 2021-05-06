<?php
class UserAccountModel extends Model{
    static $Account;

    public function __construct()
    {
        self::$Account = M('user_account');
    }

    public function getAcountInfo($where){
        
        $AcountInfo = self::$Account->where($where)->find();
         return $AcountInfo;
    }

    public function addData($data){
        self::$Account->data($data)->add();
    }
    //更新
    public function save($where,$data){
        
        $result = self::$Account->where($where)->data($data)->save();
        return $result;
    }
}