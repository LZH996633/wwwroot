<?php
class UserConsumeModel extends Model{
    static $Consume;

    public function __construct()
    {
        self::$Consume = M('user_consume');
    }

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