<?php
class OpusFavoriteModel extends Model{
    static $OpusFavor;
    
    public function __construct()
    {
        self::$OpusFavor = M('opus_favorite');
    }
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

    /**
     * 获取收藏信息列表
     * @param $where
     * @param $num
     * @param $p
     * @return array|false|mixed|PDOStatement|string|\think\Collection
     */
    public function getFavorList($where){

        $FavorInfo = self::$OpusFavor->where($where)->select();

        return $FavorInfo;
        
    }

    /**
     * 获取用户收藏数目
     * @param $where
     * @return int|string
     */
    public function getFavorCount($where){
       
        $FavorCount = self::$OpusFavor->where($where)->count();
        
        return $FavorCount;
    }

    
    public function Favor($data){
           //查询
       $result = self::$OpusFavor->where($data)->find();
        

          if ($result){
              //已收藏,取消收藏
              self::$OpusFavor->where($data)->delete();
              
              return 2;
        }else{
              //未收藏，添加收藏
              $data['fav_time'] = date('Y-m-d H:i:s',time());
               self::$OpusFavor->data($data)->add();

               return 1;
          }
        
        
    }

    public function getFavorDetail($where){
        $result = self::$OpusFavor->where($where)->find();
        
        return $result;
    }
    
}