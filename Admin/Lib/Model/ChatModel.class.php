<?php
class ChatModel extends Model{
    static $Chat;
    public function __construct()
    {
        self::$Chat = M('chat');
    }

    /**
     * Message paging
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

    public function getChatList($where,$num,$p){
        $count = self::$Chat->where($where)->count();

        $page = $this->getPage($num,$count);

        $ChatList = self::$Chat->where($where)->page($p.','.$num)->select();

        $ChatListShow = array('count'=>$count,'page'=>$page,'list'=>$ChatList);

        return $ChatListShow;

    }
    
    public function getChatInfo($where){
        $info = self::$Chat->where($where)->find();
        
        return $info;
    }
    
    public function delete($where){
        
        $result = self::$Chat->where($where)->delete();
        
        return $result;
    }
    public function save($where,$data){
        $result = self::$Chat->where($where)->save($data);
        
        return $result;
    }
    
    public function add($data){
        $result = self::$Chat->data($data)->add();
        return $result;
    }
}