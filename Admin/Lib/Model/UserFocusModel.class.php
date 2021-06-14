<?php

class UserFocusModel extends Model{
    static $Focus;

    public function __construct()
    {
        self::$Focus = M('user_focus');
    }

    

    /**
     * Add following information
     * @param mixed|string $data
     * @return mixed
     */
    public function add($data){

        $result = self::$Focus->data($data)->add();

        return $result;
    }

    /**
     * Delete following information
     * @param array|mixed $where
     * @return int|mixed
     */
    public function delete($where){
       $result = self::$Focus->where($where)->delete();
        
        return $result;
    }

    /**
     * Get the list of concerned information
     * @param $where
     * @return false|mixed|PDOStatement|string|\think\Collection
     */
    public function getFocusList($where){
        
        $FocusList = self::$Focus->where($where)->select();
       
        return $FocusList;
    }

    /**
     * Followed add and cancel operations
     * @param $data
     * @return int
     */
    public function Focus($data){

        $result = self::$Focus->where($data)->find();
        if ($result){
            //Followed, unfollow
            self::$Focus->where($data)->delete();
            return 2;
        }else{
            //Not followed, add follow
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