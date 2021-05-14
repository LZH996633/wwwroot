<?php
header('Content-Type:text/html;charset=UTF-8');

class AccountAction extends CommonAction{

	function index(){
		$mod = M('sys_tran');
		$uid = session('user_id');
		$num = $mod -> where(array('user_id' => $uid)) -> count();
		$totelFee = $mod -> where(array('user_id' => $uid)) -> sum('tran_money'); 
		$totelinfo = M('user') -> where(array('user_id' => $uid)) -> find();


		$this->assign('minmoney',C('MONEY_TO_POINT')*C('MIN_MONEY'));
		$this->assign('totelinfo',$totelinfo);

		$this->assign('now_user_point',$totelinfo['user_money']*C('MONEY_TO_POINT'));
		$this->assign('totalFee',intval($totelFee));
		$this->assign('num',$num);
    	$this->display();		
	}

	//充值详细
    public function detail(){

    	$type = I('type');
    	if($type==3){
    		$mod = M('alipay');
    		$where['uid'] = session('user_id');
    		$data = $mod -> where($where) -> select();
    		$this->assign('data',$data);
    	}
    	$this->display();
    }

    //计算金额
	function calc(){
		$len  = I('len');
		$select['type'] = I('type');//年付，月付
		$select['power'] = I('power');//会员类型
		$data = M('vipset') -> where($select) -> getField('money');
		//$money = $data*$len*$select['power'];
		$money = $data*$len;
		$this->ajaxReturn($money);
	}

	//提现
	function cash(){
		$uid = session('user_id');
		$user_id =  session('user_id');
		$count = I('count');
		$truename = I('truename');
		$cash = I('cash');
		$password = I('password');
		if(!$count || !$truename){
			$this->error('提现支付宝，账户名，提现数不能为空！');
			exit();
		}
		if($cash < C('MIN_MONEY')){
			$this->error('低于最低提现金额');
		//	echo "<script>//alert('低于最低提现金额')</>";
			exit();
		}
		if($cash %100 != 0 || strrpos($cash, '.')){
			$this->error('提现金额必须为100的整数倍');
		//	echo "<script>//alert('提现金额必须为100的整数倍')</>";
			exit();
		}
		$where['user_id'] = session('user_id');
		$where['user_alipay'] = $count;
		$where['user_name'] = $truename;
		$res = M('user') -> where($where) -> find();
		$data['user_id'] = $uid;
		$data['count'] = $count;
		$data['truename'] = $truename;
		$data['cash'] = $cash;
		$data['status'] = 1;
		$data['cash_status'] = 1;
		$data['cash_ip'] = get_client_ip();
		$data['cash_time'] = date('Y-m-d H:i:s',time());
		if(!$res){
			$this->error('支付宝或者账户错误，请重新输入');
			exit();			
		}else if($res['user_money']<$cash){
			$this->error('余额不足');
			exit;
		}else{
			M('cash') -> where(array('user_id' => $uid))->add($data);
			$da['user_money'] = $res['user_money']-$cash;
			M('user') -> where(array('user_id' => $uid))->save($da);
			$this->success('提现成功,请等待答复');
		}
	}

    public function upgrade(){
        $uid = session('user_id');
        $user = M('user')->where('user_id='.session('user_id'))->find();
        $this->assign('user', $user);
        $this->display();
    }

    function withdraw(){
    	$user = M('user')->where('user_id='.$_SESSION['user_id'])->find();
        $this->assign('user', $user);
        $this->display();
    }

	function gold(){
		$data = array('gold' => $_POST['gold']);
		$arr['gold'] = $data['gold']*60;
		$where['user_id'] = $_SESSION['user_id'];
		$res = M('user') -> where($where) -> find();
		if($res){
			M('user') -> where($where) -> setField('user_points',$res['user_points']+$arr['gold']);
			M('user') -> where($where) -> setField('user_money',$res['user_money']-$data['gold']);
			$this->redirect("Account/gold");
		}else{
			$this->error('please sign in');
		}	
	}
	
}
?>