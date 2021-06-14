<?php
class UserConsumeModel extends Model{
    static $Consume;

    public function __construct()
    {
        self::$Consume = M('user_consume');
    }

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

    public function getConsumeList($where,$num,$p){
        $count = self::$Consume->where($where)->count();
        
        $page = $this->getPage($num,$count);
        
        $Consume = self::$Consume->where($where)->page($p.','.$num)->select();
        
        $ConsumeShowList = array('count'=>$count,'page'=>$page,'list'=>$Consume);
        
        return $ConsumeShowList;
    }

    public function save($where,$data){

        $result = self::$Consume->where($where)->save($data);

        return $result;
    }
    public function delete($where){
        $result = self::$Consume->where($where)->delete();

        return $result;
    }
}