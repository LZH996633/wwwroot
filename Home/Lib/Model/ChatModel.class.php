<?php
class ChatModel extends Model{
    static $Chat;
    public function __construct()
    {
        self::$Chat = M('chat');
    }

    /**
     * 消息分页
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

    public function getChatList($where,$num,$p){
        $count = self::$Chat->where($where)->count();

        $page = $this->getPage($num,$count);

        $ChatList = self::$Chat->where($where)->order('chat_time DESC')->page($p.','.$num)->select();

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