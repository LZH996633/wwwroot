<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {
    public function index(){
        if (!session('admin_id')) {$this->redirect('Public/login');}
        $this->display();
    }

    //欢迎页
    public function welcome(){
        $a=date ( 'Y-m-d H:i:s');
        $d=date ( 'Y-m-d 00:00:00');

        $Config = M('sys_config');
        $visit = $Config->where(array('name'=>'Visit'))->getField('value');

        $map['opus_createtime']  = array('between',array($d,$a));
        $opus=M('opus')->where($map['between'])->count();
       
        $map['user_registertime']  = array('between',array($d,$a));
        $user = M('user')->where($map['between'])->count();
        //$points = M('user')->where($map['between'])->sum('user_points');
        $usermoney = M('user')->where($map['between'])->sum('user_money');

        $map['down_time']  = array('between',array($d,$a));
        $down = M('opus_download')->where($map['between'])->count();
        
        $map['time']  = array('between',array($d,$a));
        $usermoney = M('user_account')->where($map['between'])->sum('gold_coin');

        $map['time']  = array('between',array($d,$a));
        $usermoney = M('user_account')->where($map['between'])->sum('gold_coin');
        //交易额
        $trans = M('user_consume')->where(array('method_status'=>'0'))->sum('money');

        //提现额
        $cash = M('user_consume')->where(array('method'=>'3'))->sum('money');
        //站点余额
        $duizhang = $usermoney-$cash;
        $sum = array(
            'fang'=>$visit,
            'opus' => $opus,
            'user' => $user,
            'down' => $down,
            //'points' => $points,
            //'tuiguang'=> $tuiguang,
            'usermoney' => $usermoney,
            'trans' => $trans,
            'cash' => $cash,
            'duizhang'=> $duizhang
        );
// var_dump($sum);
        $this->assign('sum',$sum);

        $this->display();
	}

    //基本内容
    public function form(){
        $config=M('sys_config');
        $title=$config-> where('id=2') -> getField('value');
        $key=$config-> where('id=5') -> getField('value');
        $ifopen=$config-> where('id=28') -> getField('value');
        $des=$config-> where('id=6') -> getField('value');
        $icp=$config-> where('id=12') -> getField('value');
        $url=$config-> where('id=3') -> getField('value');

        $this->assign('icp',$icp);
        $this->assign('title',$title);
        $this->assign('key',$key);
        $this->assign('ifopen',$ifopen);
        $this->assign('des',$des);
        $this->assign('url',$url);
        // var_dump($title);die();
    	$this->display();
	}

    // 单页显示
    public function tab(){

        $about=M('single')-> where(array('name'=>'about')) -> getField('content');
        $this->assign('about',$about);
        $agreement=M('single')-> where(array('name'=>'agreement')) -> getField('content');
        $this->assign('agreement',$agreement);
    	$this->display();
	}


    //详细设置
    public function detailset(){
        $config = M('sys_config');
        $Withdrawal_lowest = $config->where(array('name'=>'Withdrawal_lowest'))->getField('value');
        $Withdrawal_tallest = $config->where(array('name'=>'Withdrawal_tallest'))->getField('value');
        $Contact_phone = $config->where(array('name'=>'Contact_phone'))->getField('value');
        $Contact_QQ = $config->where(array('name'=>'Contact_QQ'))->getField('value');
        $Contact_email = $config->where(array('name'=>'Contact_email'))->getField('value');
        $Work_address = $config->where(array('name'=>'Work_address'))->getField('value');
        $Work_time = $config->where(array('name'=>'Work_time'))->getField('value');

        $this->assign(array(
            'Contact_phone'=>$Contact_phone,
            'Contact_QQ'=>$Contact_QQ,
            'Contact_email'=>$Contact_email,
            'Work_address'=>$Work_address,
            'Work_time'=>$Work_time,
            'Withdrawal_lowest'=>$Withdrawal_lowest,
            'Withdrawal_tallest'=>$Withdrawal_tallest
        ));



    	$this->display();
	}

    //站点数据
    public function data(){

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

        $map_opus['opus_createtime']  = array('between',array($d,$a));
        $opus=M('opus')->where($map_opus)->count();
       
        $map_user['user_registertime']  = array('between',array($d,$a));
        $user = M('user')->where($map_user)->count();

       //积分 $points = M('user')->where($map)->sum('user_points');
        $map_account['time']  = array('between',array($d,$a));
        $duizhang = M('user_account')->where($map_account)->sum('gold_coin');

        $map_down['down_time']  = array('between',array($d,$a));
        $down = M('opus_download')->where($map_down)->count();
        $trans = M('opus_download')->where($map_down)->sum('down_price');
        
        $map_consume_tixian['time']  = array('between',array($d,$a));
        $map_consume_tixian['method_status'] = '0';
        $map_consume_tixian['method'] = '3';
       // var_dump($map_consume);
        $cash = M('user_consume')->where($map_consume_tixian)->sum('money');
       $usermoney = $duizhang+$cash;
        $usermoney = number_format($usermoney,'2');

        $sum = array(
           // 'fang' => $fang,//访问量
            'opus' => $opus,
            'user' => $user,
            'down' => $down,
            //'points' => $points,
            //'tuiguang'=> $tuiguang,//推广量
            'usermoney' => $usermoney,
            'trans' => $trans,//成交额
            'cash' => $cash,
            'duizhang'=> $duizhang//对账
        );
        
        //去除空的数值
        foreach ($sum as $key=>$value){
            
            if($value==null){
                $value = '0.00';
                $sum[$key] = $value;
            }
        }
// var_dump($sum);
        $this->assign('sum',$sum);
        
        $this->display();
    }

    public function isform(){
    	$title = I('title');
        $key = I('key');
        $ifopen = I('ifopen');
        $icp = I('icp');
        $url = I('url');

        $des = I('des');
        $config = M('sys_config');
        $config-> where('id=12')-> setField('value',$icp);
        $config-> where('id=2')-> setField('value',$title);
        $config-> where('id=5')-> setField('value',$key);

        $config-> where('id=28')-> setField('value',$ifopen);

        $config-> where('id=6')-> setField('value',$des);
        $config-> where('id=3')-> setField('value',$url);

      $this->redirect('Index/form');

        // var_dump($c);die();
	}

    public function tabform(){

      if($_POST){
          $where = array('name'=>$_POST['single']);
          $data = array('content'=>$_POST['content']);
          $Single = M('single');
          $Single->where($where)->save($data);
          $this->redirect('Index/tab');
      }



        //$this->redirect('Index/tab', array('cate_id' => 2), 1, '成功！页面跳转中...');
        // $this->error('新增失败',5,'Index/tab');
        // header("location:?m=Index&a=tab");
    }

    public function setform(){
        $config = M('sys_config');
        if($_POST){
            $data=array(
            'Withdrawal_lowest' => array('value'=>$_POST['Withdrawal_lowest'],'title'=>'最低提现','name'=>'Withdrawal_lowest','update_time'=>time()),
            'Withdrawal_tallest' => array('value'=>$_POST['Withdrawal_tallest'],'title'=>'最高提现','name'=>'Withdrawal_tallest','update_time'=>time()),
             'Contact_phone' => array('value'=>$_POST['Contact_phone'],'title'=>'联系电话','name'=>'Contact_phone','update_time'=>time()),
            'Contact_QQ' => array('value'=>$_POST['Contact_QQ'],'title'=>'联系QQ','name'=>'Contact_QQ','update_time'=>time()),
            'Contact_email' => array('value'=>$_POST['Contact_email'],'title'=>'联系邮箱','name'=>'Contact_email','update_time'=>time()),
             'Work_address' => array('value'=>$_POST['Work_address'],'title'=>'工作地址','name'=>'Work_address','update_time'=>time()),
            'Work_time' => array('value'=>$_POST['Work_time'],'title'=>'工作时间','name'=>'Work_time','update_time'=>time()),
        );
           // var_dump($data);
            foreach ($data as $key=>$value){

               $where['name'] = $value['name'];
               $config->where($where)->save($value);
            }
            $this->redirect('Index/detailset');
        }


       // $this->redirect('Index/detailset');
    }

	function sendmail(){
		$this->display();
	}



}