<?php

class AjaxAction extends CommonAction{
    public function show(){
        echo cookie('de');
    }

	/**
	 * 用户中心、详情页-收藏操作
	 */
	public function Favor(){
		//判断是否登录
		if (!isset($_COOKIE['user_id'])){
			$data = array('status'=>'-1');
		}
		else{
			if ($_GET['seller_id']!=$_COOKIE['user_id']){
				//构建查询条件及写入数据
				$where['opus_id'] = $_GET['fa_id'];
				$where['user_id'] = $_COOKIE['user_id'];


				//执行收藏操作
				$Favor = new OpusFavoriteModel();
				$data = $Favor->Favor($where);

				//查询收藏次数信息
				$where =null;
				$where['opus_id']=$_GET['fa_id'];
				$Opus = new OpusModel();
				$info = $Opus->getOpusDetail($where);
				$oext_favorite = $info['oext_favorite'];

				if ($data=='1'){
					//收藏成功
					//修改收藏次数
					$datas['oext_favorite'] = $oext_favorite+1;
					$result = $Opus->Update($where,$datas);
					if ($result){
						$data = array('status'=>1);
					}
				}
				elseif ($data=='2'){
					//取消收藏
					//修改收藏次数
					$datas['oext_favorite'] = $oext_favorite-1;
					$result = $Opus->Update($where,$datas);
					if ($result){
						$data = array('status'=>2);
					}
				}
			}else{
				//收藏自己
				$data = array('status'=>'-3');
			}

		}

		$data = json_encode($data);
		echo $data;
		exit();
	}

	/**
	 * 详情页-收藏状态
	 */
	public function FavorJudge(){
		//接收传值
		$fa_id = $_GET['fa_id'];
		$user_id = $_COOKIE['user_id'];
		//构建查询条件
		$where['opus_id'] = $fa_id;
		$where['user_id'] = $user_id;
		//执行查询
		$Favor = new OpusFavoriteModel();
		$result = $Favor->getFavorDetail($where);

		if ($result){
			//已收藏
			$data = array('judge'=>'true');
		}else{
			//未收藏
			$data = array('judge'=>'false');
		}

		$data = json_encode($data);
		echo $data;
		exit();
	}

	/**
	 * 用户中心、详情页-关注操作
	 */
	public function Focus(){
		//判断是否登录
		if (!isset($_COOKIE['user_id'])){
			$data = array('status'=>'-1');
		}
		else{
			if ($_GET['seller_id']!=$_COOKIE['user_id'])
			{
				//构建查询条件及写入数据
				$where['befocus_id'] = $_GET['seller_id'];
				$where['user_id'] = $_COOKIE['user_id'];


				//执行关注操作
				$Focus = new UserFocusModel();
				$data = $Focus->Focus($where);
				//构建返回值
				$data = array('status'=>$data);
			}
			else{
				//关注自己
				$data = array('status'=>'-3');
			}
		}


		$data = json_encode($data);

		echo $data;
		exit();

	}

	/**
	 * 详情页-关注状态
	 */
	public function FocusJudge(){
		//接收传值
		$seller_id = $_GET['seller_id'];
		$user_id = $_COOKIE['user_id'];
		//构建查询条件
		$where['befocus_id'] = $seller_id;
		$where['user_id'] = $user_id;
		//执行查询
		$Focus = new UserFocusModel();
		$result = $Focus->getFocusDetail($where);

		if ($result){
			//已关注
			$data = 'true';
		}else{
			//未关注
			$data = 'false';
		}
		//构建返回值
		$data = array('judge'=>$data);
		$data = json_encode($data);
		echo $data;
		exit;
	}

	/**
	 * 用户中心-下载删除
	 */
	public function DownDel(){
	    //接受传值
		$down_id = $_GET['down_id'];
		$user_id = $_COOKIE['user_id'];

		$where['id'] = $down_id;
		$where['user_id'] = $user_id;

		$OpusDown = new OpusDownloadModel();
		$result = $OpusDown->delete($where);
		if ($result){
			$data = array('status'=>'true');
		}else{
			$data = array('status'=>'false');
		}
		
		$data = json_encode($data);

		echo $data;
	}

	/**
	 * 用户中心-上传删除
	 */
	public function UpDel(){
		//接受传值
		$up_id = $_GET['up_id'];
		$user_id = $_COOKIE['user_id'];
		//构建查询条件
		$where['opus_id'] = $up_id;
		$where['user_id'] = $user_id;
		//执行删除
		$Opus = new OpusModel();
		$result = $Opus->Delete($where);
		//结果返回
		if($result){
			$data=array('status'=>'true');
		}else{
			$data = array('status'=>'false');
		}
		
		$data = json_encode($data);
		
		echo $data;
	}

    /**
     * 用户中心-修改昵称
     */
	public function ModifyNick(){
		$nick_name = $_POST['nickname'];
		$user_id = $_COOKIE['user_id'];

		$pre = "[\\!|@|#|\\$|%|\\^|&|\\*|\\(|\\)|_|\\+|\\||-|=|\\\\|~|`|:|\\\"|\\<|\\>|\\?|;|'|,|\\.|/|“|”|；|：|，|。|、|·|\\{|\\}|\\[|\\]]";

		if (preg_match($pre, $nick_name)) {
			$data=array('status'=>3,'msg'=>'有特殊字符');

		}else{
			$where['user_id'] = $user_id;
			$data['user_nickname'] = $nick_name;
			$User = new UserModel();
			$result = $User->save($where,$data);
			if ($result){
				$data=array('status'=>1,'msg'=>'修改成功');
			}else{
				$data=array('status'=>0,'msg'=>'修改失败');
			}

		}

	
		$data = json_encode($data);
		echo $data;
	}

    /**
     * 用户中心-修改头像
     */
	public function ModifyPic(){
		$user_id = $_COOKIE['user_id'];
		$user_pic = $_GET['pic'];

		$where['user_id'] = $user_id;
		$data['user_pic'] = $user_pic;

		$User = new UserModel();
	    $Info = $User->getUserInfo($where);
		$pic = $Info['user_pic'];
		if(file_exists('.'.$pic)){
		unlink('.'.$pic);
	
	}
		$result = $User->save($where,$data);
		if ($result){

			$data=array('status'=>1,'msg'=>'修改成功');
		}else{
			$data=array('status'=>0,'msg'=>'修改失败');
		}

		$data = json_encode($data);
		echo $data;
	}





    /**
     * 用户中心-实名认证
     */
	public function RenzhengPica(){
		$user_id = $_COOKIE['user_id'];
		$user_apic = $_GET['pic'];

		$where['user_id'] = $user_id;
		$data['idcarda_pic'] = $user_apic;
		$User = new UserModel();
	    $Info = $User->getUserInfo($where);
		$pic = $Info['idcarda_pic'];
		if(file_exists('.'.$pic)){
		unlink('.'.$pic);
	
	}
		$result = $User->save($where,$data);
		if ($result){

			$data=array('status'=>1,'msg'=>'上传成功');
		}else{
			$data=array('status'=>0,'msg'=>'上传失败');
		}

		$data = json_encode($data);
		echo $data;
	}	
	
	public function RenzhengPicb(){
		$user_id = $_COOKIE['user_id'];
		$user_bpic = $_GET['pic'];

		$where['user_id'] = $user_id;
		$data['idcardb_pic'] = $user_bpic;
		$User = new UserModel();
	    $Info = $User->getUserInfo($where);
		$pic = $Info['idcardb_pic'];
		if(file_exists('.'.$pic)){
		unlink('.'.$pic);
	
	}
		$result = $User->save($where,$data);
		if ($result){

			$data=array('status'=>1,'msg'=>'上传成功');
		}else{
			$data=array('status'=>0,'msg'=>'上传失败');
		}

		$data = json_encode($data);
		echo $data;
	}	
	
	
	
	public function RenzhengPicc(){
		$user_id = $_COOKIE['user_id'];
		$user_cpic = $_GET['pic'];

		$where['user_id'] = $user_id;
		$data['idcardc_pic'] = $user_cpic;
		$User = new UserModel();
	    $Info = $User->getUserInfo($where);
		$pic = $Info['idcardc_pic'];
		if(file_exists('.'.$pic)){
		unlink('.'.$pic);
	
	}
		$result = $User->save($where,$data);
		if ($result){

			$data=array('status'=>1,'msg'=>'上传成功');
		}else{
			$data=array('status'=>0,'msg'=>'上传失败');
		}

		$data = json_encode($data);
		echo $data;
	}		
	
	




    /**
     * 用户注册-邮箱激活
     */


	public function Renzhengemil(){

		$user_email = $_GET['emil'];
        $ip = get_client_ip();
		 $sss = rand(11111,99999);  //随机L币		
	 $emil = M("emil"); // 验证其他用户是否注册过邮箱 没有就添加并发送激活码
		
		$where['user_email'] = $user_email;
		
     $jianyan = $emil->where($where)->find(); //  判断是否有注册邮箱		
	
                    if ($jianyan == null) {						
                        $data['user_email'] = $user_email;
						 $data['int'] = $sss;
                        $data['ip'] = $ip;
                        $data['detectiontime'] = date('Y-m-d H:i:s', time());
                        $emil->add($data);
						
						
	                //构建激活链接
                $site = M('sys_config');
                $SiteUrl = $site->where('id=3')->getField('value');

             //   $where['user_name'] = $user_name;
              //  $get = $User->findOne($where);

             //   $token = $get['user_token'];

                $url = $sss;

                $send = $this->send_mail($user_email,$url);
            if ($send){
          //   $this->success('邮件发送成功！请查看邮件，完成注册！',U('Index/index'));
			$data=array('status'=>1,'msg'=>'邮件发送成功！请查看邮件，完成注册！');
            }else{
                $where['user_email'] = $user_email;

                $emil->delData($where);
                 $data=array('status'=>1,'msg'=>'邮件发送成功！请查看邮件，完成注册！');
                $this->error('邮件发送失败！请检查您填写的邮箱！',U('Index/index'));
            }					
						
						
						
						

		}else{
			$where['user_email'] = $user_email;
                $data = array('int'=>$sss);
                $emil->where($where)->save($data);


			
			                //构建激活链接
                $site = M('sys_config');
                $SiteUrl = $site->where('id=3')->getField('value');

                $url = $sss;

                $send = $this->send_mail($user_email,$url);
            if ($send){
			$data=array('status'=>1,'msg'=>'邮件发送成功！请查看邮件，完成注册！');
            }else{
                $where['user_email'] = $user_email;

                $emil->delData($where);
                 $data=array('status'=>1,'msg'=>'邮件发送成功！请查看邮件，完成注册！');
                $this->error('邮件发送失败！请检查您填写的邮箱！',U('Index/index'));
            }		

			$data=array('status'=>0,'msg'=>'已发送验证码到邮箱，如果还没收到请更换邮箱试试');


					}


		$data = json_encode($data);
		echo $data;
	}		








    /**
     * 用户中心-显示消息
     */
	public function show_msg(){
		$id = $_GET['id'];
		$user_id = $_COOKIE['user_id'];
		
		$where['id'] = $id;
		$where['user_id'] = $user_id;
		
		$data['chat_state'] = '2';
		$Chat = new ChatModel();
		$Chat->save($where,$data);
		$Info = $Chat->getChatInfo($where);
		
		$Info = json_encode($Info);
		
		echo $Info;
	}

    /**
     * 用户中心-删除消息
     */
	public function del_msg(){
		$id = $_GET['id'];
		$user_id = $_COOKIE['user_id'];

		$where['id'] = $id;
		$where['user_id'] = $user_id;

		$Chat = new ChatModel();
		$result = $Chat->delete($where);
		
		if($result){
			$data=array('status'=>1,'msg'=>'删除成功');
		}else{
			$data=array('status'=>0,'msg'=>'删除失败');
		}
		$data = json_encode($data);
		
		echo $data;
	}

    /**
     * 用户中心-提问
     */
	public function ask_question(){
		$title = $_GET['title'];
		$content = $_GET['content'];
		$user_id = $_COOKIE['user_id'];
		
		$data['user_id'] = $user_id;
		$data['chat_title'] = $title;
		$data['chat_content'] = $content;
        $data['chat_state'] = '1';
		$data['chat_from'] = '1';
		$data['chat_time'] = date('Y-m-d H:i:s',time());

		$Chat = new ChatModel();
		$result = $Chat->add($data);

		if($result){
			$data=array('status'=>1,'msg'=>'提交成功');
		}else{
			$data=array('status'=>0,'msg'=>'提交失败');
		}
		$data = json_encode($data);

		echo $data;
	}



   /**
     * 用户评论-信息提交
     */
	public function discuss(){
		$kw = $_GET['kw'];
	//	$content = $_GET['content'];
	if (!isset($_COOKIE['user_id'])){
		$data=array('status'=>3,'msg'=>"提交失败,请先登录..");

	   
		$data = json_encode($data);

		echo $data;
	}
	else{
		$user_id = $_COOKIE['user_id'];
		
		$data['user_id'] = $user_id;
		$data['cmt_content'] = $kw;
        $data['cmt_status'] = '1';
		$data['opus_id'] = $_GET['id'];      //作品id
		$data['cmt_createtime'] = date('Y-m-d H:i:s',time());

		$Comment = M ('opus_comment');
		$result = $Comment->add($data);

		if($result){
			$data=array('status'=>1,'msg'=>'提交成功');
		}else{
			$data=array('status'=>0,'msg'=>'提交失败');
		}
	//	$data = json_encode($data);

		//echo $data;

		$this->ajaxReturn($data);
        echo $data;
	}

  }








    /**
     * 作品下载-判断
     */
	public function download(){
//		$data=array('status'=>'2','msg'=>'您已下载过此文件，此次免费','flag'=>'1');
//		echo json_encode($data);die;

		$opus_id = I('opus_id');
		$user_id = $_COOKIE['user_id'];


		if ($user_id=='' || $user_id==null){
			$data = array('status'=>'0','msg'=>'尚未登录');
		}else{

			//查询作品信息
			$Opus = new OpusModel();
			$Opus_info = $Opus->getOpusDetail(array('opus_id'=>$opus_id));

			$seller_id = $Opus_info['user_id'];
			$price = $Opus_info['price'];
			
			$is_half = $Opus_info['is_half'];

			if ($is_half=='1'){
				$prices = $Opus_info['prices'];; 
			}
			//查询账户

			$User = M('user');

			$User_acc = new UserAccountModel();
			$AccInfo = $User_acc->getAcountInfo(array('user_id'=>$user_id));
			$AccInfos = $User->where(array('user_id'=>$user_id))->find();

			$gold_coin = $AccInfo['gold_coin'];
			$gold_coins = $AccInfos['gold_coins'];


                 //dump($AccInfos);

			
			cookie('de',$gold_coin);
			cookie('de1',$gold_coins);
			//查询下载
			$OpusDown = new OpusDownloadModel();

			$result = $OpusDown->getDownInfo(array('user_id'=>$user_id,'opus_id'=>$opus_id));


			if($result){
				if($result['down_price']!='0'|| $price=='0'){
					//cookie('de',$result);
					//已下载，此次免费
					$down_url = $result['down_url'];
					if($down_url==null || $down_url==''){
					    $down_place = $result['down_place'];
					    $down_pass = $result['down_pass'];
					    $data = array('msg'=>'此次下载免费','status'=>'3','url'=>$down_place,'pass'=>$down_pass);
                    }else{
                        $data = array('status'=>'2','msg'=>'此次下载免费','down_url'=>$down_url);
                    }

				}elseif($result['down_price']=='0' && $price!='0'){
					$data = array('status'=>'2','msg'=>'此次下载需要付费');
					$OpusDown->delete(array('user_id'=>$user_id,'opus_id'=>$opus_id));
				}
			}else{
				//未下载
				if ($is_half=='0'){
				if ($gold_coin<$price){
					$data = array('status'=>'-1','msg'=>'金币不足，请充值');
				}else{
					$data = array('status'=>'1','msg'=>'下载扣除'.$price.'元');


				}
			}else{
				if($gold_coins<$prices){
					$data = array('status'=>'-1','msg'=>'L币不足，请做任务或者签到积攒L币 或者加入VIP会员永久免费');
				}else{
					$data = array('status'=>'1','msg'=>'下载扣除'.$prices.'L币');	
				}

			}






			}
			

			
			}

       echo json_encode($data);

	}

    /**
     * 作品下载-执行
     */
	public function down(){
		$file_path = I('path');
		if($file_path){

        }

		header("Content-type:text/html;charset=utf-8");
// $file_name="cookie.jpg";
		$file_name=basename($file_path);
//用以解决中文不能显示出来的问题
		$file_name=iconv("utf-8","gb2312",$file_name);
//首先要判断给定的文件存在与否

       /* var_dump($file_path);
        var_dump($file_name);
        //var_dump($file_size);
        echo $_SERVER['DOCUMENT_ROOT'];die;*/
		if(!file_exists($file_path)){
			echo $data=array('msg'=>'该文件已被删除');
			return ;
		}
		$fp=fopen($file_path,"r");
		$file_size=filesize($file_path);
//下载文件需要用到的头
		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length:".$file_size);
		header("Content-Disposition: attachment; filename=".$file_name);
		$buffer=1024;
		$file_count=0;
//向浏览器返回数据
		while(!feof($fp) && $file_count<$file_size){
			$file_con=fread($fp,$buffer);
			$file_count+=$buffer;
			echo $file_con;
			
		}
		fclose($fp);
	}

    /**
     * 作品下载-付款
     */
	public function pay(){
		$opus_id = I('opus_id');
		$user_id = cookie('user_id');
		$Opus = new OpusModel();
		$Opus_info = $Opus->getOpusDetail(array('opus_id'=>$opus_id));

		$cate = $Opus_info['opus_sort'];
		$seller_id = $Opus_info['user_id'];
		$down = $Opus_info['down'];
		$price = $Opus_info['price'];
		$prices = $Opus_info['prices'];		
		$is_half = $Opus_info['is_half'];
		$title = $Opus_info['opus_title'];
		$opus_file = $Opus_info['opus_filedown'];

		$fileurl = $Opus_info['opus_fileurl'];
		$zippass = $Opus_info['opus_zippass'];



		$down_url = $opus_file;
		
		
        $order_num = date('YmdHis').$user_id.$seller_id;
		$ip = get_client_ip();

		$time = date('Y-m-d H:i:s');

		$OpusDown = new OpusDownloadModel();

		$data = array(
			'user_id'=>$user_id,
			'order_number'=>$order_num,
			'seller_id'=>$seller_id,
			'opus_id'=>$opus_id,
			'down_price'=>$price,
			'down_prices'=>$prices,			
			'down_place'=>$fileurl,
			'down_pass'=>$zippass,
			'down_ip'=>$ip,
			'down_time'=>$time,
			'opus_title'=>$title,
			'down_url'=>$down_url,
		);


		if ($is_half=='1'){      ///////////////////////////////////////免费下载






$result = $OpusDown->add($data);
if ($result){

	//卖家//买家账户操作

	$User = new UserModel();
	
	$sellers = $User->getUserInfo(array('user_id'=>$seller_id));
	$buyers = $User->getUserInfo(array('user_id'=>$user_id));			




		$seller_coins = $seller['gold_coins']+$prices;
		$buyer_coins = $buyer['gold_coins']-$prices;




	$where_d['user_id'] = $user_id;
	$data_d['gold_coins'] = $buyer_coins;
	$User->save($where_d,$data_d);

	$where_s['user_id'] = $seller_id;
	$data_s['gold_coins'] = $seller_coins;			
	$User->save($where_s,$data_s);





	//交易操作
	$Class = M('classify');
	preg_match("/[0-9]+-[0-9]+-([0-9]+)/",$cate,$match);
	$cid= $match[1];
	$cates = $Class->where(array('cid'=>$cid))->getField('name');
	$data_c_b=array(
		'order'=>$order_num,
		'user_id'=>$user_id,
		'content'=>'下载'.$title,
		'time'=>$time,
		'ip'=>$ip,
		'model_type'=>$cates,
		'gold_coins'=>$prices,
		'method_status'=>'0',
		'method'=>2,
		'over'=>'1'
	);
	$data_c_s=array(
		'order'=>$order_num,
		'user_id'=>$seller_id,
		'content'=>'出售'.$title,
		'time'=>$time,
		'ip'=>$ip,
		'model_type'=>$cates,
		'gold_coins'=>$prices,
		'method_status'=>'1',
		'method'=>4,
		'over'=>'1'
	);

	$Con = M('user_consume');
	$Con->data($data_c_b)->add();
	$Con->data($data_c_s)->add();

	
	$down_new = $down+1;
	$Opus->Update(array('opus_id'=>$opus_id),array('down'=>$down_new));
   if($down_url==null || $down_url==''){
	   $data = array('url'=>$fileurl,'pass'=>$zippass,'status'=>'2');
   }else{
		$data = array('down_url'=>$down_url,'msg'=>'下载扣除' . $prices . 'L币','status'=>'1');
 }
	
}else{
	$data = array('msg'=>'下载失败，请刷新后重试');



}                 ///////////////////////////////////////////免费下载






		}else{

$result = $OpusDown->add($data);      //////////收费下载
if ($result){
	$UserAcc = new UserAccountModel();
	//卖家//买家账户操作
	$seller = $UserAcc->getAcountInfo(array('user_id'=>$seller_id));
	$buyer = $UserAcc->getAcountInfo(array('user_id'=>$user_id));

//	$data['user_nickname'] = $nick_name;
	$User = new UserModel();
	
	$sellers = $User->getUserInfo(array('user_id'=>$seller_id));
	$buyers = $User->getUserInfo(array('user_id'=>$user_id));			
//	$result = $User->save($where,$data);



		$seller_coin = $seller['gold_coin']+$price;
		$buyer_coin = $buyer['gold_coin']-$price;





	$where_d['user_id'] = $user_id;
	$data_d['gold_coin'] = $buyer_coin;
	$UserAcc->save($where_d,$data_d);

	$where_s['user_id'] = $seller_id;
	$data_s['gold_coin'] = $seller_coin;			
	$UserAcc->save($where_s,$data_s);




	//交易操作
	$Class = M('classify');
	preg_match("/[0-9]+-[0-9]+-([0-9]+)/",$cate,$match);
	$cid= $match[1];
	$cates = $Class->where(array('cid'=>$cid))->getField('name');
	$data_c_b=array(
		'order'=>$order_num,
		'user_id'=>$user_id,
		'content'=>'下载'.$title,
		'time'=>$time,
		'ip'=>$ip,
		'model_type'=>$cates,
		'money'=>$price,
		'method_status'=>'0',
		'method'=>2,
		'over'=>'1'
	);
	$data_c_s=array(
		'order'=>$order_num,
		'user_id'=>$seller_id,
		'content'=>'出售'.$title,
		'time'=>$time,
		'ip'=>$ip,
		'model_type'=>$cates,
		'money'=>$price,
		'method_status'=>'1',
		'method'=>4,
		'over'=>'1'
	);

	$Con = M('user_consume');
	$Con->data($data_c_b)->add();
	$Con->data($data_c_s)->add();

	
	$down_new = $down+1;
	$Opus->Update(array('opus_id'=>$opus_id),array('down'=>$down_new));
   if($down_url==null || $down_url==''){
	   $data = array('url'=>$fileurl,'pass'=>$zippass,'status'=>'2');
   }else{

	   $data = array('down_url'=>$down_url,'msg'=>'下载扣除' . $price . '元','status'=>'1');

 }
	
}else{
	$data = array('msg'=>'下载失败，请刷新后重试');
}                                                         //收费下载




		}
















		echo json_encode($data);
	}


























    /**
     * 用户中心-提现-判断
     */
	public function withdrawal(){
	    $user_id = $_COOKIE['user_id'];

	    $User = M('user');
	    $Acc = M('user_account');
	    $Config = M('sys_config');

        $Withdrawal_lowest = $Config->where(array('name'=>'Withdrawal_lowest'))->getField('value');
        $Withdrawal_tallest = $Config->where(array('name'=>'Withdrawal_tallest'))->getField('value');

	    $info = $User->where(array('user_id'=>$user_id))->find();
	    if($info['user_mobilephoneState']==1){
            $acc_info = $Acc->where(array('user_id'=>$user_id))->find();
            $gold_coin = $acc_info['gold_coin'];

            $data = array(
                'status'=>'2',
                'coin'=>$gold_coin,
                'tall'=>$Withdrawal_tallest,
                'low'=>$Withdrawal_lowest
            );
            echo json_encode($data);exit;
        }else{
	        $data = array(
                'status'=>'0',
	            'msg'=>'财务=>安全=>绑定手机'
            );
	        echo json_encode($data);exit;
        }

	}
	

    /**
     * 用户中心-签到-判断
     */
	public function qiandao(){
	    $user_id = $_COOKIE['user_id'];

	    $User = M('user');
		 $t=time();
		 $endtimestr = "23:59:59";
		 $endtime = strtotime($endtimestr);
		 $ssss = rand(1,5);  //随机L币
	    $info = $User->where(array('user_id'=>$user_id))->find();

		 $newtime=$info['qiandao_data'];		 		 
	   // if($t > $newtime+24*3600){
			
         if($t > $newtime){
			 
			$data['gold_coins'] = $info['gold_coins'] + $ssss;		
			$data['qiandao_data'] = $endtime ;			

			$User->where("user_id = $user_id")->save($data); // 根据条件更新记录



           $data = array(
               'status'=>'2',
           //  'coins'=>$gold_coins,
		  'msg'=> '签到成功领取' . $ssss . 'L币'
           );
           echo json_encode($data);exit;
        }else{
	        $data = array(
                'status'=>'0',
	            'msg'=> '每天一次哦!'
            );
	        echo json_encode($data);exit;
        }

    }







    /**
     * 用户中心-提现-执行
     */
    public function do_withdrawal(){

        if($_GET){
            $user_id = $_COOKIE['user_id'];
            $cash = $_GET['cash'];
            $acc = $_GET['acc'];
            $bank = $_GET['bank'];
            $name = $_GET['name'];

            $order_num = date('YmdHis').$user_id;
            $time = date('Y-m-d H:i:s');
            //消息
            $Chat = M('chat');
            $chat_data = array(
                'user_id'=>$user_id,
                'chat_state'=>'1',
                'chat_title'=>$order_num,
                'chat_content'=>'金额：'.$cash.',开户行：'.$bank.',户名：'.$name.'，账号：'.$acc,
                'chat_time'=>$time,
                'chat_from'=>'2'
                );
            $Chat->data($chat_data)->add();
            //记录
            $Con = M('user_consume');
            $con_data = array(
                'order'=>$order_num,
                'user_id'=>$user_id,
                'time'=>$time,
                'model_type'=>'银行转账',
                'money'=>$cash,
                'method_status'=>'0',
                'method'=>'3',
                'ip'=>get_client_ip(),
                'over'=>'0'
            );
            $result =  $Con->data($con_data)->add();

             if($result){
                 $data = array(
                     'status'=>'1',
                     'msg'=>'提交成功'
                 );

             }else{
                 $data = array(
                     'status'=>'0',
                     'msg'=>'提交失败,请重试！'
                 );
             }
        }else{
            $data = array(
                'status'=>'0',
                'msg'=>'提交失败,请重试！'
            );
        }

        echo json_encode($data);exit;
    }

    /**
     * 用户中心-安全-发送
     */
    public function send_msg(){
        $User = M('user');
        $config = M('sys_config');

        $SMS_acc=$config-> getFieldByName('SMS_acc','value');
        $SMS_key=$config-> getFieldByName('SMS_key','value');
        $SMS_sign=$config-> getFieldByName('SMS_sign','value');
        $SMS_location=$config-> getFieldByName('SMS_location','value');

        $user_id = $_COOKIE['user_id'];
        $mobile = $_POST['mobile'];

        $info  =$User->where(array('user_id'=>$user_id))->find();
        //$title = $Config->where(array('name'=>'title'))->getField('name');
        //生成验证码
        $arr = array('1','2','3','4','5','6','7','8','9','0');
        $send_code = array_rand($arr).array_rand($arr).array_rand($arr).array_rand($arr).array_rand($arr).array_rand($arr);

        session('send_code',$send_code);
        session('mobile',$mobile);

        $send_code = session('send_code');

        $flag = 0;
        $params='';//要post的数据
        $argv = array(
            'name'=> $SMS_acc,     //必填参数。用户账号
            'pwd'=>$SMS_key,     //必填参数。（web平台：基本资料中的接口密码）
            'content'=>'您登陆的验证码为：'.$send_code,
            'mobile'=>$mobile,   //必填参数。手机号码。多个以英文逗号隔开
            'stime'=>'',   //可选参数。发送时间，填写时已填写的时间发送，不填时为当前时间发送
            'sign'=>$SMS_sign,    //必填参数。用户签名。
            'type'=>'pt',  //必填参数。固定值 pt
            'extno'=>''    //可选参数，扩展码，用户定义扩展码，只能为数字
        );
        //print_r($argv);exit;
        //构造要post的字符串
        //echo $argv['content'];
        foreach ($argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";
                $flag = 1;
            }
            $params.= $key."="; $params.= urlencode($value);// urlencode($value);
            $flag = 1;
        }

        $url = $SMS_location."?".$params; //提交的url地址
        $con= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态
        if($con == '0'){
            $data=array('status'=>1,'msg'=>'发送成功');
        }else{
            $data=array('status'=>0,'msg'=>'发送失败');
        }
        echo json_encode($data);
    }

    /**
     * 用户中心-安全-验证
     */
    public function check_verify(){
         $mobile = $_GET['mobile'];
         $verify = $_GET['verify'];

         if(session('mobile')==$mobile && session('send_code')==$verify){
             $data = array('status'=>1,'msg'=>'验证码正确');
         }else{
             $data = array('status'=>0,'msg'=>'验证码错误');
         }

          echo json_encode($data);
    }

    /**
     * 用户中心-安全-写入
     */
    public function phone_write(){
        $mobile = $_SESSION['mobile'];

        if($mobile){

        $User = M('user');
        $user_id = $_COOKIE['user_id'];
        $data_u['user_mobilephone'] = $mobile;
        $data_u['user_mobilephoneState'] = '1';

        if($_GET['action']){
            //登陆
            $where_u['user_mobilephone'] = $mobile;
            $where_u['user_mobilephoneState'] = 1;
            $user_result = $User->where($where_u)->find();
            if($user_result){
                //已有账户
                cookie('user_id',$user_result['user_id']);
                cookie('is_login',true);

                $data = array('status'=>1,'msg'=>'成功');
            }
            else{
                //首次登录
                $random = $this->get_random($User,'user_name','01PH');
                $data_u['user_name'] = $random;
                $data_u['user_password'] = $random;
                $data_u['user_exptime']= date("Y-m-d H:i:s");
                $data_u['user_state'] = 1;
                $result =  $User->data($data_u)->add();
                if($result){
                    //写入状态
                    $user_result = $User->where($where_u)->find();
                    if($user_result){
                        cookie('user_id',$user_result['user_id']);
                        cookie('is_login',true);

                        $data = array('status'=>1,'msg'=>'登录成功');
                    }else{
                        $data = array('status'=>0,'msg'=>'登录失败');
                    }

                }else{
                    $data = array('status'=>0,'msg'=>'登录失败');
                }
            }

        }
        else{
            //手机绑定验证
            $result =  $User->where(array('user_id'=>$user_id))->save($data_u);

            if($result){
                $data = array('status'=>1,'msg'=>'绑定成功');
            }else{
                $data = array('status'=>0,'msg'=>'绑定失败');
            }
        }
        }
        else{
            $data = array('status'=>0,'msg'=>'操作失败');
        }
        session('mobile',null);
        session('send_code',null);
        echo json_encode($data);
    }

    /**
     * 获取随机
     * @param $model
     * @param $where
     * @param $sign
     * @return string
     */
    public function get_random($model,$where,$sign){
        $arr = ['1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i',
            'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $random = array_rand($arr,1).array_rand($arr,1).array_rand($arr,1).array_rand($arr,1).array_rand($arr,1).array_rand($arr,1);
        $random = $sign.$random;
        $result = $model->where(array($where=>$random))->find();
        if($result){
            return  $this->get_random($model,$where,$sign);
        }else{
            return $random;
        }
    }

    /**
     * 取消支付
     */
    public function cancel_pay(){
        $id = $_GET['id'];
       if($id){
            $Rec  = M('user_recharge');
           $result =  $Rec->where(array('id'=>$id))->delete();
           if($result){
               $data = array('status'=>1,'msg'=>'取消成功');
           }else{
               $data = array('status'=>0,'msg'=>'取消失败');
           }
        }else{
            $data = array('status'=>0,'msg'=>'取消失败');
        }

        echo json_encode($data);
    }

    /**
     * 建立账户信息
     */
    public function set_acct(){
        if($_GET){
            $where['user_id'] = cookie('user_id');
            $bank = $_GET['bank'];
            $name = $_GET['name'];
            $acct = $_GET['acct'];

            $Acc = M('user_account');
            $data_new = array(
                'acct_name'=>$name,
                'acct_bank'=>$bank,
                'acct_account'=>$acct
            );
            $result = $Acc->where($where)->save($data_new);

            if($result){
                $data = array('status'=>'1','msg'=>'提交成功');
            }else{
                $data = array('status'=>'0','msg'=>'提交失败');
            }
        }else{
            $data = array('status'=>'0','msg'=>'提交失败');
        }



     echo json_encode($data);
    }
}
