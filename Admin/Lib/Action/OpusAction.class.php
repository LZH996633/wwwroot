<?php
// 本类由系统自动生成，仅供测试用途
class OpusAction extends CommonAction {
    /**
     * 作品管理首页
     */
    public function index(){
        $Opus = new OpusModel();
        $User  = M('user');
        $Class = M('classify');

        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            cookie('admin_search',null);
            $p = '1';
        }

        $where=array();
		if($_POST){
		     cookie('admin_search',$_POST['searchop']);

        }
        $search = cookie('admin_search');
        if($search!=null){
            $where_c['name']=array('like',$search);
            $result = $Class->where($where_c)->find();
            if($result) {
                $path = $result['path'].'-'.$result['cid'];
                $where['opus_sort'] = array('like',$path."%");
            }
               $where['opus_title'] = array('like','%'.$search.'%');
               $where['_logic'] = 'or';
        }

        $this->assign(array('search'=>cookie('admin_search')));

		 $ShowList = $Opus->getOpusList($order='opus_id',$where,$num='8',$p);

		 foreach($ShowList['list'] as $key=>$value){
			 			 
				 $user_name = $User->where(array('user_id'=>$value['user_id']))->getField('user_nickname');
				 
				 $value['user_nickname']= $user_name;
				 
				 preg_match("/[0-9]+-[0-9]+-([0-9]+)/",$value['opus_sort'],$match);
				 $cid= $match[1];
				 $cate = $Class->where(array('cid'=>$cid))->getField('name');
			     $value['cate'] = $cate;
				 
				 			  
				 $ShowList['list'][$key] = $value;
				 
			
		 }
	
	
		 
		 $this->assign($ShowList);

		$this->display(); // 输出模板
    }
    

	public function check(){
		$id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $opus=M('opus');
            $data['opus_id']=$id;
            $rs=$opus->where($data)->find();
            if ($rs['opus_verify']== 1) {
                $this->error('请勿重复审核！');
            } else {
               $opus-> where($data)->setField('opus_verify','1');

               $value = $rs['user_id'];
               // var_dump($value );
                $title = '作品通过审核通知';
                $content = '你的作品现已给予申请审核通过，如果作品优异被推荐将在首页展示！';
        
                $data = array(
                    'chat_title'=>$title,
                    'chat_content'=>$content,
                    'chat_form'=>'0',
                    'chat_state'=>'1',
                    'chat_time'=>date('Y-m-d H:i:s')
                );
                // var_dump($rs);die();
				   $Chat = M('chat');
                   $data['user_id'] = $value;
                   $Chat->data($data)->add();
                $this->success('审核通过!');
            }
        }
        else
        {
            $this->error('未能成功审核!');
        }
		
    }
   
    
    
	public function checkroom(){
		$id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $opus=M('opus');
            $data['opus_id']=$id;
            $rs=$opus->where($data)->find();
            if ($rs['recom']== 1) {
                $this->error('请勿重复推荐！');
            } else {
               $opus-> where($data)->setField('recom','1');

               $value = $rs['user_id'];
              // var_dump($value );
               $title = '作品推荐通知';
               $content = '因作品优异或者其他特别原因现已给予特殊推荐申请，推荐作品将在首页展示，请再接再厉！';
       
               $data = array(
                   'chat_title'=>$title,
                   'chat_content'=>$content,
                   'chat_form'=>'0',
                   'chat_state'=>'1',
                   'chat_time'=>date('Y-m-d H:i:s')
               );
       
                   $Chat = M('chat');
                   $data['user_id'] = $value;
                   $Chat->data($data)->add();



                // var_dump($rs);die();
                $this->success('推荐成功!');
            }
        }
        else
        {
            $this->error('未能推荐成功!');
        }
		
    }














	public function uncheck(){
		$id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $opus=M('opus');
            $data['opus_id']=$id;
            $rs=$opus->where($data)->find();
            if ($rs['opus_verify']== 2) {
                $this->error('请勿重复退回！');
            } else {
               $opus-> where($data)->setField('opus_verify','2');


               $value = $rs['user_id'];
              // var_dump($value );
               $title = '作品退回通知';
               $content = '因作品重复或者其他原因现已撤销审申请，有问题请与客服人员联系！';
       
               $data = array(
                   'chat_title'=>$title,
                   'chat_content'=>$content,
                   'chat_form'=>'0',
                   'chat_state'=>'1',
                   'chat_time'=>date('Y-m-d H:i:s')
               );
       
                   $Chat = M('chat');
                   $data['user_id'] = $value;
                   $Chat->data($data)->add();



                // var_dump($rs);die();
                $this->success('不给予通过!');
            }
        }
        else
        {
            $this->error('未能成功审核!');
        }
		
	}

    /**
     * 作品删除
     */





	public function delete(){

	    if($_POST)
	    {
			$del = $_POST['select'];
	        $opus=M('opus');
			$data['opus_id']=array('in',$del);
            $filelist = $opus->where($data)->select();

            foreach ($filelist as $key=>$value) {
                $file_list[] = $value['opus_source'];
            }

            foreach ($file_list as $key=>$value){
                if($value!=null || $value!=''){
                    $path = $_SERVER['DOCUMENT_ROOT'].$value;
                    unlink($path);

                }
            }

			$result = $opus->where($data)->delete();
            if($result){
                $this->redirect('Opus/index');
            }else
            {
                $this->redirect('Opus/index','','2','删除失败！');
            }

	    }

	}

        public function count(){
			
			if(I('data')){
            $getdata=I('data');
        }
        if(I('day')){
            $getdata = I('day');
        }
        
        // strtotime("2015-05-22 15:00:00");
        $this->assign('currentday',$getdata);
		
        if($getdata==null){
			$d='';
			$a=date ( 'Y-m-d H:i:s');
			
		}else{
			
			$a=date ( 'Y-m-d H:i:s');
			if($getdata=='1'){
				$d=date ( 'Y-m-d');
			}else{
				$d=date ( 'Y-m-d H:i:s',time()-3600*24*$getdata);
			}
			
		}
		$where = array($d,$a);
		
		
		   $Opus = new OpusModel();
		   $Class = new ClassifyModel(); 
		   $Down = new OpusDownloadModel();
		   
		   // 各栏目作品数
		 
		  $CateList = $Class->CreateCate();
		  foreach($CateList as $key=>$value){
			  $path = $value['path'].'-'.$value['cid'];
			  
			  $count = $Opus->getOpusCount(array('opus_sort'=>$path,'opus_createtime'=>array('between',$where)));
			  $value['count'] = $count;
			  $CateList[$key] = $value;
			  
		  }
		  $count_down = $Down->getDownCount(array('down_time'=>array('between',$where)));
		  $tran = $Down->getDownSum(array('down_time'=>array('between',$where)),'down_price');
		  if($tran==null){
			  $tran = number_format(0,2);
		  };
		  
		  
		  
		  
		  
		  $count_all = $Opus->getOpusCount(array('opus_createtime'=>array('between',$where)));
		  
		  
		  //var_dump($CateList);
		  $this->assign(array('cate_list'=>$CateList,'total'=>$count_all,'count_down'=>$count_down,'tran'=>$tran));
		  
		
          $this->display('Opus/count');
    }

    /**
     * 下载
     */
	    public function down(){

	        $OpusDown = new OpusDownloadModel();
	        $User = M('user');

            if($_GET['p']){
                $p = $_GET['p'];
            }else{
                cookie('admin_search',null);
                $p = '1';
            }
            $where = array();

            if($_POST){
                cookie('admin_search',$_POST['searchop']);

            }
            $search = cookie('admin_search');

            if($search!=null){
                $where_u['user_nickname']=array('like','%'.$search.'%');
                $where_u['user_name'] = array('like','%'.$search.'%');
                $where_u['_logic'] = 'or';
                $result = $User->where($where_u)->select();
                if($result){
                    foreach ($result as $key=>$value){
                        $id_list = $value['user_id'];
                    }
                    $where['user_id'] = array('in',$id_list);
                }
                $where['opus_title'] = array('like','%'.$search.'%');
                $where['order_number'] = array('like','%'.$search.'%');
                $where['_logic'] = 'or';
            }
            $this->assign(array('search'=>cookie('admin_search')));
           $ShowList =  $OpusDown->getDownList($where,$num='10',$p);

            foreach($ShowList['list'] as $key=>$value){
                $seller_result = $User->where(array('user_id'=>$value['seller_id']))->find();
                $buyer_result = $User->where(array('user_id'=>$value['user_id']))->find();

                $seller_nickname = $seller_result['user_nickname'];
                $seller_name = $seller_result['user_name'];
                $buyer_nickname = $buyer_result['user_nickname'];
                $buyer_name = $buyer_result['user_name'];


                if($seller_nickname==null ||$seller_nickname==''){
                    $seller_nickname = '暂无昵称';
                }
                if($buyer_nickname==null ||$buyer_nickname==''){
                    $buyer_nickname = '暂无昵称';
                }
                $value['buyer_name'] = $buyer_name;
                $value['seller_name'] = $seller_name;

                $value['buyer_nickname'] = $buyer_nickname;
                $value['seller_nickname'] = $seller_nickname;
                $ShowList['list'][$key]=$value;
            }

          $this->assign($ShowList);

          $this->display(); // 输出模板

    }

    public function down_del(){
        $OpusDown = new OpusDownloadModel();
	        if($_POST){
	            $id_list = $_POST['select'];
                $where['id'] = array('in',$id_list);


               $result = $OpusDown->Delete($where);
               if($result){
                   $this->redirect('Opus/down');
               }else{
                   $this->redirect('Opus/down','','2','删除失败！');
               }
            }
    }
    /**
     * 上传记录
     */
	public function upload(){
    	$Opus = new OpusModel();
		$User = M('user');

        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            cookie('admin_search',null);
            $p = '1';
        }
        $where = array();

        if($_POST){
            cookie('admin_search',$_POST['searchop']);

        }
        $search = cookie('admin_search');

        if($search!=null){
            $where_u['user_nickname']=array('like','%'.$search.'%');
            $where_u['user_name'] = array('like','%'.$search.'%');
            $where_u['_logic'] = 'or';
            $result = $User->where($where_u)->select();

            if($result){
                foreach ($result as $key=>$value){
                    $id_list = $value['user_id'];
                }
                $where['user_id'] = array('in',$id_list);
            }
            $where['opus_title'] = array('like','%'.$search.'%');
            $where['_logic'] = 'or';

        }
        $this->assign(array('search'=>cookie('admin_search')));

		$ShowList = $Opus->getOpusList($order='opus_id',$where,$num='10',$p);

		foreach($ShowList['list'] as $key=>$value){

            $result = $User->where(array('user_id'=>$value['user_id']))->find();
           $user_nickname = $result['user_nickname'];
           $user_name = $result['user_name'];
            if($user_nickname==''||$user_nickname==null){
                $user_name = '暂无昵称';
            }
            $value['user_nickname']= $user_nickname;
            $value['user_name']= $user_name;

            $ShowList['list'][$key] = $value;
        }
		$this->assign($ShowList);

		$this->display(); // 输出模板
	}


}