<?php

class UserFocusModel extends Model{
    static $Focus;

    public function __construct()
    {
        self::$Focus = M('user_focus');
    }

    

    /**
     * 添加关注信息
     * @param mixed|string $data
     * @return mixed
     */
    public function add($data){

        $result = self::$Focus->data($data)->add();

        return $result;
    }

    /**
     * 删除关注信息
     * @param array|mixed $where
     * @return int|mixed
     */
    public function delete($where){
       $result = self::$Focus->where($where)->delete();
        
        return $result;
    }

    /**
     * 获取关注信息列举
     * @param $where
     * @return false|mixed|PDOStatement|string|\think\Collection
     */
    public function getFocusList($where){
        
        $FocusList = self::$Focus->where($where)->select();
       
        return $FocusList;
    }

    /**
     * 关注的添加与取消操作
     * @param $data
     * @return int
     */
    public function Focus($data){

        $result = self::$Focus->where($data)->find();
        if ($result){
            //已关注，取消关注
            self::$Focus->where($data)->delete();
            return 2;
        }else{
            //未关注，添加关注
            $data['focus_time'] = date('Y-m-d H:i:s',time());
            self::$Focus->data($data)->add();
            
            return 1;
        }

    }
    
    public function getFocusDetail($where){
        $result = self::$Focus->where($where)->find();
        
        return $result;
    }
}