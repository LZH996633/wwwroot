<?php
// 本类由系统自动生成，仅供测试用途
class AccountAction extends CommonAction {

    /**
     * 充值记录
     *
     * */
    public function recharge(){
        if($_POST['select']){
            $Reg = M('user_recharge');
            $select = $_POST['select'];

            $where['id'] = array('in',$select);

            $result =  $Reg->where($where)->delete();

            if ($result){
                $this->redirect('Account/recharge');
            }else{
                $this->redirect('Account/recharge','','2','删除失败');
            }
        }else{


        $UserRecharge = new UserRechargeModel();
        $User = M('user');
        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            cookie('admin_search',$_POST['searchop']);
            $p='1';
        }
        $where=array();
            $this->assign(array('search'=>cookie('admin_search')));
       if($_POST['searchop']){
                cookie('admin_search',$_POST['searchop']);
       }
            $search = cookie('admin_search');

            if($search!=null) {
                $where_u['user_name'] = array('like', '%' . $search . '%');
                $where_u['user_nickname'] = array('like', '%' . $search . '%');
                $where_u['_logic'] = 'or';

                $result = $User->where($where_u)->select();
                $id_list = array();
                if($result){
                    foreach ($result as $key=>$value){
                        $id_list = $value['user_id'];
                    }
                    $where['user_id'] = array('in',$id_list);
                }

                $where['acct_order'] = array('like', '%' . $search . '%');
                $where['_logic'] = 'or';

            }

              $RechargeListShow = $UserRecharge->getRechargeList($where,$num=10,$p);

        foreach($RechargeListShow['list'] as $key=>$value){
            $user_info = $User->where(array('user_id'=>$value['user_id']))->find();
            $value['user_name']= $user_info['user_name'];
            $user_nickname = $user_info['user_nickname'];
            if($user_nickname==null){
                $user_nickname = '暂无';
            }
            $value['user_nickname'] = $user_nickname;
            $RechargeListShow['list'][$key] = $value;
        }
        $this->assign($RechargeListShow);
        }
        $this->display(); // 输出模板
	}

    /**
     * 购买记录
     */
	public function pay(){
        if($_POST['select']){
            //删除
            $where['id'] = array('in',$_POST['select']);

            $Down = M('opus_download');

            $result = $Down->where($where)->delete();

            if($result){
                $this->redirect('Account/pay');
            }else{
                $this->redirect('Account/pay','','2','删除失败');
            }
        }
        else{
            //查询 显示
            $Down = new OpusDownloadModel();
            $User = M('user');

            if($_GET['p']){
                $p = $_GET['p'];
            }else{
                cookie('admin_search',null);
                $p = '1';
            }
            $where = array();

            if($_POST['searchop']){
                cookie('admin_search',$_POST['searchop']);

            }
            $search = cookie('admin_search');
            $this->assign(array('search'=>cookie('admin_search')));

            //构建查询条件
            if($search!=null){
                $where_u['user_nickname']=array('like','%'.$search.'%');
                $where_u['user_name'] = array('like','%'.$search.'%');
                $where_u['_logic'] = 'or';
                $result = $User->where($where_u)->select();
                $id_list = array();
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

            $DownList = $Down->getDownList($where,$num=10,$p);
            //添加信息处理
            foreach ($DownList['list'] as $key=>$value){
                $user_info = $User->where(array('user_id'=>$value['user_id']))->find();
                $user_name = $user_info['user_name'];
                $user_nickname = $user_info['user_nickname'];
                if($user_nickname==null){
                    $user_nickname = '暂无';
                }
                $value['user_name'] = $user_name;
                $value['user_nickname'] = $user_nickname;
                $DownList['list'][$key] = $value;
            }


            $this->assign($DownList);

        }



        $this->display(); // 输出模板
	}
    /**
     * 收入记录
     **/
	public function income(){
        if($_POST['select']){
            //删除
            $where['id'] = array('in',$_POST['select']);

            $Down = M('opus_download');

            $result = $Down->where($where)->delete();

            if($result){
                $this->redirect('Account/pay');
            }else{
                $this->redirect('Account/pay','','2','删除失败');
            }
        }
        else{
            //查询 显示
            $Down = new OpusDownloadModel();
            $User = M('user');

            if($_GET['p']){
                $p = $_GET['p'];
            }else{
                cookie('admin_search',null);
                $p = '1';
            }
            $where = array();

            if($_POST['searchop']){
                cookie('admin_search',$_POST['searchop']);

            }
            $search = cookie('admin_search');
            $this->assign(array('search'=>cookie('admin_search')));

            //构建查询条件
            if($search!=null){
                $where_u['user_nickname']=array('like','%'.$search.'%');
                $where_u['user_name'] = array('like','%'.$search.'%');
                $where_u['_logic'] = 'or';
                $result = $User->where($where_u)->select();
                $id_list = array();
                if($result){
                    foreach ($result as $key=>$value){
                        $id_list = $value['user_id'];
                    }
                    $where['seller_id'] = array('in',$id_list);
                }
                $where['opus_title'] = array('like','%'.$search.'%');
                $where['order_number'] = array('like','%'.$search.'%');
                $where['_logic'] = 'or';
            }

            $DownList = $Down->getDownList($where,$num=10,$p);
            //添加信息处理
            foreach ($DownList['list'] as $key=>$value){
                $user_info = $User->where(array('user_id'=>$value['seller_id']))->find();
                $user_name = $user_info['user_name'];
                $user_nickname = $user_info['user_nickname'];
                if($user_nickname==null){
                    $user_nickname = '暂无';
                }
                $value['user_name'] = $user_name;
                $value['user_nickname'] = $user_nickname;
                $DownList['list'][$key] = $value;
            }


            $this->assign($DownList);

        }

        $this->display(); // 输出模板
	}
    /**
     * 提现记录
     */
	public function withdraw(){
        if($_POST['select']){
            //删除
            $where['id'] = array('in',$_POST['select']);

            $Con = M('user_consume');

            $result = $Con->where($where)->delete();

            if($result){
                $this->redirect('Account/withdraw');
            }else{
                $this->redirect('Account/withdraw','','2','删除失败');
            }
        }
        else{
            //查询 显示
            $Down = new UserConsumeModel();
            $User = M('user');
            $Acc = M('user_account');

            if($_GET['p']){
                $p = $_GET['p'];
            }else{
                cookie('admin_search',null);
                $p = '1';
            }
            $where_new = array('method'=>'3');

            if($_POST['searchop']){
                cookie('admin_search',$_POST['searchop']);

            }
            $search = cookie('admin_search');
            $this->assign(array('search'=>cookie('admin_search')));

            //构建查询条件
            if($search!=null){
                $where_u['user_nickname']=array('like','%'.$search.'%');
                $where_u['user_name'] = array('like','%'.$search.'%');
                $where_u['_logic'] = 'or';
                $result = $User->where($where_u)->select();
                $id_list = array();
                if($result){
                    foreach ($result as $key=>$value){
                        $id_list = $value['user_id'];
                    }
                    $where['seller_id'] = array('in',$id_list);
                }
                $where['model_type'] = array('like','%'.$search.'%');
                $where['order'] = array('like','%'.$search.'%');
                $where['_logic'] = 'or';

                $where_new['_complex'] = $where;

            }

            $DownList = $Down->getConsumeList($where_new,$num=10,$p);
            //添加信息处理
            foreach ($DownList['list'] as $key=>$value){
                $user_info = $User->where(array('user_id'=>$value['user_id']))->find();
                $user_name = $user_info['user_name'];
                $user_nickname = $user_info['user_nickname'];
                if($user_nickname==null){
                    $user_nickname = '暂无';
                }
                $coin = $Acc->where(array('user_id'=>$value['user_id']))->getField('gold_coin');
                $value['gold_coin'] = $coin;
                $value['user_name'] = $user_name;
                $value['user_nickname'] = $user_nickname;
                $DownList['list'][$key] = $value;
            }


            $this->assign($DownList);

        }
        $this->display(); // 输出模板
	}
	public function count(){
	    $Acc  = M('user_account');
	    $Rec  = M('user_recharge');
	    $Con  = M('user_consume');
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
        //站点余额
        $gold_coin = $Acc->sum('gold_coin');
        //充值
        $rec_coin = $Rec->where(array('acct_time'=>array('between',$where),'acct_status'=>'3'))->sum('acct_money');
        //支出
        $Con_out = $Con->where(array('time'=>array('between',$where),'method_status'=>'0','over'=>'1'))->sum('money');
        //收入
         $Con_in = $Con->where(array('time'=>array('between',$where),'method_status'=>'1','over'=>'1'))->sum('money');

        //提现
         $Con_xian = $Con->where(array('time'=>array('between',$where),'method'=>'3','over'=>'1'))->sum('money');
        //总金
        $total = $gold_coin+$Con_xian;
        $data = array(
            'gold_coin'=>$gold_coin,
            'rec_coin'=>$rec_coin,
            'con_out'=>$Con_out,
            'con_in'=>$Con_in,
            'con_xian'=>$Con_xian,
            'total'=>$total
        );

        $this->assign($data);
	  $this->display();
    }

    public function recover(){
        $id=$this->_request('id');
        // var_dump($id);die();
        $user=M('sys_tran');
        $data['tran_id']=$id;
        $user->where($data)->setField('tag','1');
        if($id)
        {
            $this->success('恢复成功!');
        }
        else
        {
            $this->error('恢复失败!');
        }
    }

    public function rec(){
        $mt = $_POST['mt'];
        $dat = $_POST['check'];
        $map['tran_id']  = array('in',$dat);
        $data['tag'] = '1';
// var_dump($mt);die();
        if (empty($dat)) {
            $this->error('请勾选！');
        } else {
            if ($mt == 1) {
                $p = M('sys_tran')->where($map)->save($data);
                if ($p) {
                    $this->success('全部恢复成功！');
                } else {
                    $this->error('全部恢复失败！');
                }
            } else {
                $d = M('sys_tran')->where($map)->delete();
                $this->success('已删除选中！');
            }
        }
    }

	public function updateCash(){
        $ret = array(
            'status' => 1,
            'msg' => '请登录'
        );
        if(session('admin_name') && session('admin_id')){
            $cash = M('cash');
            $condition['id'] = $_POST['id'];
            $data['cash_status'] = $_POST['money'];
            $ret2 = $cash->where($condition)->save($data);
            if($ret2){
                $ret['status'] = 0;
                $ret['msg'] = '更新成功';
            }else{
                $ret['msg'] = '更新失败';
            }
        }

        $this->ajaxReturn($ret);
    }

	public function verify(){
		$id=$this->_request('id');
        if($id)
        {
            $cash=M('cash');
            $data['id']=$id;
            $rs=$cash->where($data)->find();
			if($rs['status']==1){
				$cash-> where($data)->setField('status','0');
				$this->redirect("account/withdraw");
				//$this->success('已提现!');
			}else{
				//$cash-> where($data)->setField('status','1');
				$this->redirect("account/withdraw");
				//$this->success('未提现!');
			}
        }
        else{
            $this->error('未能成功审核!');
        }
	}


    public function bank(){

         if($_POST['select']){

             $Reg = M('user_recharge');
             $Acc = M('user_account');
             $Con = M('user_consume');
             $Chat = M('chat');
             $select = $_POST['select'];

             foreach ($select as $key=>$value){


                 $data_new = array('acct_status'=>'3');
                 $where_new = array('id'=>$value);
                  //更新状态，查询信息
                $Reg->where($where_new)->save($data_new);
                 $info_new = $Reg->where($where_new)->find();



                 //账户增值
                 $acc_gold = $Acc->where(array('user_id'=>$info_new['user_id']))->getField('gold_coin');

                 $gold = $acc_gold+intval($info_new['acct_money'],10);
                 $Acc->where(array('user_id'=>$info_new['user_id']))->save(array('gold_coin'=>$gold));

                 //交易记录
                 $data_con = array(
                     'user_id'=>$info_new['user_id'],
                     'order'=>$info_new['acct_order'],
                     'time'=>$info_new['acct_time'],
                     'model_type'=>'银行转账',
                     'money'=>$info_new['acct_money'],
                     'method_status'=>'1',
                     'method'=>'1',
                     'ip'=>$info_new['ip'],
                     'over'=>'1'
                 );

              $Con->data($data_con)->add();

                 $data_chat = array(
                     'user_id'=>$info_new['user_id'],
                     'chat_state'=>'1',
                     'chat_content'=>'您的金额为：'.$info_new['acct_money'].'的订单已处理',
                     'chat_title'=>'用户充值',
                     'chat_form'=>'0',
                     'chat_time'=>date("Y-m-d H:i:s")
                 );

               $Chat->data($data_chat)->add();

             }
             $this->redirect('Account/bank');

            }else{

             $UserRecharge = new UserRechargeModel();
             $User = M('user');
             $User_account = M('user_account');
             if($_GET['p']){
                 $p = $_GET['p'];
             }else{
                 cookie('admin_search',$_POST['searchop']);
                 $p='1';
             }
             $where=array();
             $this->assign(array('search'=>cookie('admin_search')));
             if($_POST['searchop']){
                 cookie('admin_search',$_POST['searchop']);
             }
             $search = cookie('admin_search');

             if($search!=null) {
                 $where_u['user_name'] = array('like', '%' . $search . '%');
                 $where_u['user_nickname'] = array('like', '%' . $search . '%');
                 $where_u['_logic'] = 'or';

                 $result = $User->where($where_u)->select();
                 $id_list = array();
                 if($result){
                     foreach ($result as $key=>$value){
                         $id_list = $value['user_id'];
                     }
                     $where['user_id'] = array('in',$id_list);
                 }

                 $where['acct_order'] = array('like', '%' . $search . '%');
                 $where['_logic'] = 'or';

             }
             $where['acct_method'] = '3';
             $where['acct_status'] = '2';

             $RechargeListShow = $UserRecharge->getRechargeList($where,$num=10,$p);

             foreach($RechargeListShow['list'] as $key=>$value){
                 $user_info = $User->where(array('user_id'=>$value['user_id']))->find();
                 $value['user_name']= $user_info['user_name'];
                 $user_nickname = $user_info['user_nickname'];
                 $acc_info = $User_account->where(array('user_id'=>$value['user_id']))->find();

                 $user_realname = $acc_info['acct_name'];
                 $user_bank = $acc_info['acct_bank'];
                 $user_account = $acc_info['acct_account'];

                 $value['user_acct_name'] =  $user_realname;
                 $value['user_bank'] = $user_bank;
                 $value['user_account'] = $user_account;

                 if($user_nickname==null){
                     $user_nickname = '暂无';
                 }
                 $value['user_nickname'] = $user_nickname;
                 $RechargeListShow['list'][$key] = $value;
             }
             $this->assign($RechargeListShow);
         }
	    $this->display();

     }

}