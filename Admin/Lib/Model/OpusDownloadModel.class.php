<?php

class OpusDownloadModel extends Model{
    static $OpusDown;
    public function __construct()
    {
        self::$OpusDown = M('opus_download');
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
    public function getDownInfo($where){
        
        //下载文件详情
        $DownInfo = self::$OpusDown->where($where)->find();
              
        return $DownInfo;
    }
    public function getDownCount($where){
        //下载数量
        $DownCount = self::$OpusDown->where($where)->count();
        return $DownCount;
    }
public function getDownSum($where,$port){
	
	   $sum = self::$OpusDown->where($where)->sum($port);
	   return $sum;
}
    /**
     * 下载信息列举
     * @param $where
     * @param $num
     * @param $p
     * @return array|false|mixed|PDOStatement|string|\think\Collection
     */
    public function getDownList($where,$num,$p){
        
        $count = self::$OpusDown->where($where)->count();
        //分页
        $page = $this->getPage($num,$count);

        $DownList = self::$OpusDown->where($where)->order('down_time DESC')->page($p.','.$num)->select();

        $DownList = array('count'=>$count,'page'=>$page,'list'=>$DownList);

         return $DownList;
    }
    
    public function delete($where){
        
        $result = self::$OpusDown->where($where)->delete();
        
        return $result;
    }
    public function add($data){
        $result = self::$OpusDown->data($data)->add();
        
        return $result;
    }
}
