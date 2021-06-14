<?php

class NewsModel extends Model{
	//File upload class
    public function say(){
        echo 12312321312;
    }
	function upimg($savepath){
		   $upload = new \Think\Upload();// Instantiate upload class
		   $upload->maxSize   =     3145728 ;// Set attachment upload size
		   $upload->exts      =     array('jpg', 'gif', 'png','mp4', 'jpeg');// Set attachment upload type
		   $upload->savePath  =     $savepath; // Set attachment upload directory    // upload files
		   $info   =   $upload->upload();  
		   return $info;
	}

	//分页类
    public function getPageList($where, $order = 'id desc')
    {
        $totalRows = $this->where($where)->count(); // Query the total number of records that meet the requirements
        $page = new \Think\Page($totalRows, 10); // Instantiate the paging class, pass in the total number of records and the number of records displayed on each page
        $page->setConfig('header', 'records');
        $page->setConfig('first', 'The first page');
        $page->setConfig('prev', 'Previous page');
        $page->setConfig('next', 'Next page');
        $page->setConfig('last', 'the last page');
        $page->setConfig('theme', 'A total of %TOTAL_ROW% %HEADER% Current %NOW_PAGE%/%TOTAL_PAGE% page %FIRST% %UP_PAGE%  %LINK_PAGE% %DOWN_PAGE%  %END%');
        $show = $page->show(); // Paging display output
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