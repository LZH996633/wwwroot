<?php
// This category is automatically generated by the system and is for testing purposes only
class UserAction extends CommonAction {

    public function index(){
		$User = new UserModel();
		
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

            $where['user_name'] = array('like','%'.$search.'%');
            $where['user_nickname'] = array('like','%'.$search.'%');
            $where['user_email'] = array('like','%'.$search.'%');
            $where['user_mobilephone'] = array('like','%'.$search.'%');
            $where['_logic'] = 'or';
        }
        $this->assign(array('search'=>cookie('admin_search')));

		
		$ListShow = $User->getUserList($where,$num='55',$p);
		foreach ($ListShow['list'] as $key=>$value){
            if($value['user_nickname']==null){
                $value['user_nickname']='Not yet';
            }
		    $acc = M('user_account');

		   $user_money =  $acc->where(array('user_id'=>$value['user_id']))->getField('gold_coin');
		   $value['user_money'] = $user_money;
		   $ListShow['list'][$key]= $value;
        }

		//var_dump($ListShow);
		
		$this->assign($ListShow);
		
        // $map['user_name'] = array('like','%'.I('searchop').'%');
      //   $map['user_nickname'] = array('like','%'.I('searchop').'%');
      ////   $map['user_email'] = array('like','%'.I('searchop').'%');
       //  $map['user_mobilephone'] = array('like','%'.I('searchop').'%');
      //   $map['_logic'] = 'OR';
     //   $this->pages('user',$map,'user_id DESC');
		$this->display();
    }

   

    public function Certi(){
		$User = new UserModel();
		
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
        //   if($where['user_veri'] = 0){
         //   $where['user_id'] = array('like','%'.$search.'%');

        //   $where['user_veri'] = array('like','%'.$search.'%');
            $where['user_name'] = array('like','%'.$search.'%');
            $where['user_mobilephone'] = array('like','%'.$search.'%');
            $where['user_qq'] = array('like','%'.$search.'%');	
            $where['user_email'] = array('like','%'.$search.'%');			
            $where['user_registertime'] = array('like','%'.$search.'%');
              $where['_logic'] = 'or';
            
         //   }
          
        }


       // $where1=array();
      //  foreach ($ceshi1 as $key=>$value){
      //      $acc12 = M('user');            // The first database table call
          

          
     //       $user_name =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_name');
      //      $user_mobilephone =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_mobilephone');
     //       $user_qq =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_qq');
      //      $user_email =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_email');
     //       $user_registertime =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_registertime');
      //      $where['_logic'] = 'or';
      //      if($user_qq!=null){
      //       $value['user_name'] = $user_name;
      //       $value['user_qq'] = $user_qq;
      //       $value['user_mobilephone'] = $user_mobilephone;
      //       $value['user_registertime'] = $user_registertime;
       //      $value['user_email'] = $user_email;
            
      //      }

      



      //  }


        $this->assign(array('search'=>cookie('admin_search')));
        $ListShow = $User->getUserList($where,$num='50',$p);




 



            foreach ($ListShow['list'] as $key=>$value){
                if($value['user_qq']==null){
                    $value['user_qq'] ='Not yet';
                   }
		     $acc1 = M('user_account');            // The second database table call

		     $user_money =  $acc1->where(array('user_id'=>$value['user_id']))->getField('gold_coin');
		     $value['user_money'] = $user_money;
		   
		      $user_bank =  $acc1->where(array('user_id'=>$value['user_id']))->getField('acct_bank');
		      $value['user_bank'] = $user_bank;

		      $user_alipay =  $acc1->where(array('user_id'=>$value['user_id']))->getField('acct_alipay');
		      $value['user_alipay'] = $user_alipay;		   
		   
		      $user_registertime =  $acc1->where(array('user_id'=>$value['user_id']))->getField('acct_bank');
		      $value['user_bank'] = $user_bank;	
		   
		      $user_name =  $acc1->where(array('user_id'=>$value['user_id']))->getField('acct_name');
		      $value['user_compellation'] = $user_name;	
		   
		      $ListShow['list'][$key]= $value;
             }
         
		$this->assign($ListShow);
		

		$this->display();
    }
  






      public function Certa(){
		$User = new UserModel();
		
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
        //   if($where['user_veri'] = 0){
         //   $where['user_id'] = array('like','%'.$search.'%');

        //   $where['user_veri'] = array('like','%'.$search.'%');
            $where['user_name'] = array('like','%'.$search.'%');
            $where['user_mobilephone'] = array('like','%'.$search.'%');
            $where['user_qq'] = array('like','%'.$search.'%');	
            $where['user_email'] = array('like','%'.$search.'%');			
            $where['user_registertime'] = array('like','%'.$search.'%');
              $where['_logic'] = 'or';
            
         //   }
          
        }


        $where1=array();
       foreach ($ceshi1 as $key=>$value){
            $acc12 = M('user');            // The first database table call
          

          
          $user_name =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_name');
           $user_mobilephone =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_mobilephone');
           $user_qq =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_qq');
            $user_email =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_email');
           $user_registertime =  $acc1->where(array('user_id'=>$value['user_id']))->getField('user_registertime');
            $where['_logic'] = 'or';
           if($user_qq!=null){
            $value['user_name'] = $user_name;
             $value['user_qq'] = $user_qq;
            $value['user_mobilephone'] = $user_mobilephone;
            $value['user_registertime'] = $user_registertime;
            $value['user_email'] = $user_email;

	  }
            
	      $idcarda_pic =  $acc12->where(array('user_id'=>$value['user_id']))->getField('idcarda_pic');	
		  $idcardb_pic =  $acc12->where(array('user_id'=>$value['user_id']))->getField('idcardb_pic');	
          $idcardc_pic =  $acc12->where(array('user_id'=>$value['user_id']))->getField('idcardc_pic');	
		  
}

	        $this->assign(array('search'=>cookie('admin_search')));
        $ListShow = $User->getUserList($where,$num='25',$p);
	



   


 



            foreach ($ListShow['list'] as $key=>$value){
                if($value['user_qq']==null){
                    $value['user_qq'] ='??????';
                   }
		     $acc1 = M('user_account');            // The second database table call
		   
		      $user_name =  $acc1->where(array('user_id'=>$value['user_id']))->getField('acct_name');
		      $value['user_compellation'] = $user_name;	
		   
		      $ListShow['list'][$key]= $value;
             }
         
		$this->assign($ListShow);
		

		$this->display();
    }











    public function opera(){

    	$this->display();
	}
    public function adMgmt(){

    	$this->display();
	}

    /**
     * Disable
     */
    public function ban(){
        $id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $user=M('user');
            $data['user_id']=$id;
            $rs=$user->where($data)->find();
            // var_dump($rs['user_state']);die();
            if ($rs['user_state']== '1') {
                $user-> where($data)->setField('user_state','0');
                // var_dump($rs);die();
                $this->redirect('User/index');
            } else {
                $this->redirect('User/index');
            }
        }
        else
        {
            $this->redirect('User/index');
        }
    }

    /**
     * Unblock
     */
    public function unban(){
        $id=$this->_request('id');
        // var_dump($id);die();
        if($id){
            $user=M('user');
            $data['user_id']=$id;
            $rs=$user->where($data)->find();
            // var_dump($rs['user_state']);die();
            if ($rs['user_state']== '1') {
                $this->redirect('User/index');
            } else {
                $user-> where($data)->setField('user_state','1');
                // var_dump($rs);die();
                $this->redirect('User/index');
            }
        }
        else{
            $this->redirect('User/index');
        }
    }
    public function isCerti(){
        $id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $user=M('user');
            $data['user_id']=$id;
            $rs=$user->where($data)->find();
            if ($rs['user_veri']== 1) {
                $this->redirect('User/index');
            } else {
               $user-> where($data)->setField('user_veri','1');
                // var_dump($rs);die();
                $this->redirect('User/index');
            }
        }
        else
        {
            $this->redirect('User/index');
        }
    }

    /**
     * delete
     */
    public function delete(){

		
		
        if($_POST)
	    {
			$del = $_POST['select'];
	        $opus=M('user');
	        $acc = M('user');

			$data['user_id']=array('in',$del);

			$result =$opus->where($data)->delete();
		if($result){
		    $acc->where($data)->delete();
            $this->redirect('User/index');
        }else
            {
                $this->redirect('User/index','','2','Failed to delete???');
            }


	    }

    }
	

    /**
     * Seller authentication
     */	
    public function isCerta(){
        $id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $user=M('user');
            $data['user_id']=$id;
            $rs=$user->where($data)->find();
            if ($rs['idcard_sta']== 1) {
				 $this->error('Do not repeat review???');
            
            } else {
               $user-> where($data)->setField('idcard_sta','1');
                // var_dump($rs);die();
				    $value = $rs['user_id'];
               // var_dump($value );
                $title = 'Seller???s real-name authentication notice';
                $content = 'Your real-name certification has now passed the application review, and you can publish your work in the seller center. Excellent and recommended will be displayed on the homepage???';
        
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
				
                $this->success('examination passed!');
              //  $this->redirect('User/index');
            }
        }
        else
        {
            $this->redirect('User/index');
        }
    }	
	
	
    /**
     * Seller verification
     */	
    public function isCerts(){
        $id=$this->_request('id');
        // var_dump($id);die();
        if($id)
        {
            $user=M('user');
            $data['user_id']=$id;
            $rs=$user->where($data)->find();
            if ($rs['idcard_sta']== 2) {
				 $this->error('Do not repeat review???');
            
            } else {
               $user-> where($data)->setField('idcard_sta','2');
                // var_dump($rs);die();
				    $value = $rs['user_id'];
               // var_dump($value );
                $title = 'Seller\'s real-name authentication withdrawal notice';
                $content = 'Your real-name authentication has now been withdrawn due to incomplete information or false information. You can publish your work in the seller center and enter to re-modify and apply for authentication. You can also contact customer service for manual processing.???';
        
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
                $this->success('Concurrent message notification rejected!');
              //  $this->redirect('User/index');
            }
        }
        else
        {
            $this->redirect('User/index');
        }
    }	
		
	
		
	
	
	
	
	
	
    public function updateMoney(){
        $ret = array(
            'status' => 1,
            'msg' => 'please sign in'
        );
        if(session('admin_name') && session('admin_id')){
            $user = M('user');
            $condition['user_id'] = $_POST['id'];
            $data['user_money'] = $_POST['money'];
            $ret2 = $user->where($condition)->save($data);
            if($ret2){
                $ret['status'] = 0;
                $ret['msg'] = 'update completed';
            }else{
                $ret['msg'] = 'Update failed';
            }
        }

        $this->ajaxReturn($ret);
    }

    public function withdrawal(){

      $Acc = M('user_account');
      $User = M('user');
      $Chat = new ChatModel();


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
        $this->assign(array('search'=>cookie('admin_search')));
      if($search!=null){

          $where['user_name'] = array('like','%'.$search.'%');
          $where['user_nickname'] = array('like','%'.$search.'%');
          $where['user_mobilephone'] = array('like','%'.$search.'%');
          $where['_logic'] = 'or';

          $result = $User->where($where)->select();

          $id_list = array();
          if($result){
              foreach ($result as $key=>$value){
                  $id_list = $value['user_id'];
              }
              $where_c['user_id'] = array('in',$id_list);
          }

      }

      $where_c['chat_from']='2';
        $where_c['chat_state']='1';

      $ListShow = $Chat->getChatList($where_c,$num=50,$p);


      foreach ($ListShow['list'] as $key=>$value){
            $user_info = $User->where(array('user_id'=>$value['user_id']))->find();
            $acc_info = $Acc->where(array('user_id'=>$value['user_id']))->find();
            $value['user_name'] = $user_info['user_name'];

            $value['user_nickname'] = $user_info['user_nickname'];
          if($user_info['user_nickname']==null){
              $value['user_nickname'] = 'Not yet';
          }
            $value['user_mobilephone']= $user_info['user_mobilephone'];
            $value['user_account'] = $acc_info['gold_coin'];

            $ListShow['list'][$key] = $value;
      }

      $this->assign($ListShow);
      $this->assign(array('search'=>cookie('admin_search')));





      //var_dump($ListShow);
       $this->display();
  }

    /**
     * Withdrawal operation
     */
    public function dodrawal(){
        $Chat = new ChatModel();
        $Con = new UserConsumeModel();

       if($_POST['do']){
           if($_POST['do']=='true'){
               //Allow withdrawal
               $id_list = $_POST['select'];
               foreach ($id_list as $key=>$value){
                   $info = $Chat->getChatInfo(array('id'=>$value));
                   //Modify status
                   $where_f['id'] = $info['id'];
                   $data_f = array(
                       'chat_state'=>'2'
                   );
                   $Chat->save($where_f,$data_f);

                   //Withdrawal operation

                    //Change withdrawal status
                   $order = $info['chat_title'];
                   $user_id = $info['user_id'];
                   $where_con['order'] = $order;
                   $where_con['user_id'] = $user_id;
                   $data_con['over'] = '1';
                   $Con->save($where_con,$data_con);

                   //Create reply
                   $data=array(
                       'user_id'=>$info['user_id'],
                       'chat_state'=>'1',
                       'chat_title'=>'Withdrawal application',
                       'chat_content'=>'Your???'.$info['chat_content'].'The withdrawal request of has been processed',
                       'chat_replay'=>'',
                       'chat_time'=>date("Y-m-d H:i:s"),
                       'chat_form'=>'0'
                   );
                   $result = $Chat->add($data);
                   if($result){
                       $this->redirect('User/withdrawal');
                   }else{
                       $this->redirect('User/withdrawal','','2','Operation failed');
                   }
               }

           }else{
               //Refuse to withdraw
               $id_list = $_POST['select'];

               foreach ($id_list as $key=>$value){
                   $info = $Chat->getChatInfo(array('id'=>$value));
                   $where_f['id'] = $info['id'];
                   $data_f = array(
                       'chat_state'=>'2'
                   );
                  $Chat->save($where_f,$data_f);

                  //Change withdrawal status
                   $order = $info['chat_title'];
                   $user_id = $info['user_id'];
                  $where_con['order'] = $order;
                  $where_con['user_id'] = $user_id;
                  $data_con['over'] = '2';
                  $Con->save($where_con,$data_con);
                   //Send rejection message
                $data=array(
                       'user_id'=>$info['user_id'],
                       'chat_state'=>'1',
                       'chat_title'=>'Withdrawal application',
                       'chat_content'=>'Your???'.$info['chat_content'].'The withdrawal application of has been rejected, please contact customer service for specific reasons',
                       'chat_replay'=>'',
                       'chat_time'=>date("Y-m-d H:i:s"),
                       'chat_form'=>'0'
                   );
                   $result = $Chat->add($data);
               }
               if($result){
                   $this->redirect('User/withdrawal');
               }else{
                   $this->redirect('User/withdrawal','','2','Operation failed');
               }
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


     $User = M('user');
     $User_acc = M('user_account');

     $total = $User->count();
     $total_coin = $User_acc->sum('gold_coin');

     $count = $User->where(array('user_registertime'=>array('between',$where)))->count();
     $coin = $User_acc->where(array('time'=>array('between',$where)))->sum('gold_coin');

     $this->assign(array('total'=>$total,'total_coin'=>$total_coin,'count'=>$count,'coin'=>$coin));


      $this->display();
  }
}