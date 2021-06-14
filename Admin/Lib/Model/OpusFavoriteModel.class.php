<?php
class OpusFavoriteModel extends Model{
    static $OpusFavor;
    
    public function __construct()
    {
        self::$OpusFavor = M('opus_favorite');
    }
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

    /**
     * Get a list of favorite information
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
     * Get the number of user favorites
     * @param $where
     * @return int|string
     */
    public function getFavorCount($where){
       
        $FavorCount = self::$OpusFavor->where($where)->count();
        
        return $FavorCount;
    }

    
    public function Favor($data){
           //Inquire
       $result = self::$OpusFavor->where($data)->find();
        

          if ($result){
              //Favorited, unfavored
              self::$OpusFavor->where($data)->delete();
              
              return 2;
        }else{
              //Not favorite, add favorite
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