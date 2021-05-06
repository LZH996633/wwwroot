<?php

class NewsModel extends Model{
	//文件上传类
    public function say(){
        echo 12312321312;
    }
	function upimg($savepath){
		   $upload = new \Think\Upload();// 实例化上传类    
		   $upload->maxSize   =     3145728 ;// 设置附件上传大小    
		   $upload->exts      =     array('jpg', 'gif', 'png','mp4', 'jpeg');// 设置附件上传类型    
		   $upload->savePath  =     $savepath; // 设置附件上传目录    // 上传文件     
		   $info   =   $upload->upload();  
		   return $info;
	}

	//分页类
    public function getPageList($where, $order = 'id desc')
    {
        $totalRows = $this->where($where)->count(); // 查询满足要求的总记录数
        $page = new \Think\Page($totalRows, 10); // 实例化分页类 传入总记录数和每页显示的记录数
        $page->setConfig('header', '条记录');
        $page->setConfig('first', '第一页');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '最后一页');
        $page->setConfig('theme', '共 %TOTAL_ROW% %HEADER% 当前第  %NOW_PAGE%/%TOTAL_PAGE% 页 %FIRST% %UP_PAGE%  %LINK_PAGE% %DOWN_PAGE%  %END%');
        $show = $page->show(); // 分页显示输出
        $list = $this->where($where)
            ->order($order)
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        return array(
            $show,
            $list
        );
    }
}
?>