<?php

class AjaxAction extends CommonAction{
    public function show(){
        echo cookie('de');
    }

	/**
	 * User Center, Details Page-Favorite Operation
	 */
	public function Favor(){
		//Determine whether to log in
		if (!isset($_COOKIE['user_id'])){
			$data = array('status'=>'-1');
		}
		else{
			if ($_GET['seller_id']!=$_COOKIE['user_id']){
				//Build query conditions and write data
				$where['opus_id'] = $_GET['fa_id'];
				$where['user_id'] = $_COOKIE['user_id'];


				//Perform favorite operations
				$Favor = new OpusFavoriteModel();
				$data = $Favor->Favor($where);

				//Query collection times information
				$where =null;
				$where['opus_id']=$_GET['fa_id'];
				$Opus = new OpusModel();
				$info = $Opus->getOpusDetail($where);
				$oext_favorite = $info['oext_favorite'];

				if ($data=='1'){
					//Collection success
					//Modify the number of favorites
					$datas['oext_favorite'] = $oext_favorite+1;
					$result = $Opus->Update($where,$datas);
					if ($result){
						$data = array('status'=>1);
					}
				}
				elseif ($data=='2'){
					//Unfavorite
					//Modify the number of favorites
					$datas['oext_favorite'] = $oext_favorite-1;
					$result = $Opus->Update($where,$datas);
					if ($result){
						$data = array('status'=>2);
					}
				}
			}else{
				//Collect yourself
				$data = array('status'=>'-3');
			}

		}

		$data = json_encode($data);
		echo $data;
		exit();
	}

	/**
	 * Details page-collection status
	 */
	public function FavorJudge(){
		//Receive value
		$fa_id = $_GET['fa_id'];
		$user_id = $_COOKIE['user_id'];
		//Build query conditions
		$where['opus_id'] = $fa_id;
		$where['user_id'] = $user_id;
		//Execute query
		$Favor = new OpusFavoriteModel();
		$result = $Favor->getFavorDetail($where);

		if ($result){
			//collected
			$data = array('judge'=>'true');
		}else{
			//Not favorited
			$data = array('judge'=>'false');
		}

		$data = json_encode($data);
		echo $data;
		exit();
	}

	/**
	 * User Center, Details Page-Follow Operation
	 */
	public function Focus(){
		//Determine whether to log in
		if (!isset($_COOKIE['user_id'])){
			$data = array('status'=>'-1');
		}
		else{
			if ($_GET['seller_id']!=$_COOKIE['user_id'])
			{
				//Build query conditions and write data
				$where['befocus_id'] = $_GET['seller_id'];
				$where['user_id'] = $_COOKIE['user_id'];


				//Perform follow operations
				$Focus = new UserFocusModel();
				$data = $Focus->Focus($where);
				//Build the return value
				$data = array('status'=>$data);
			}
			else{
				//Pay attention to yourself
				$data = array('status'=>'-3');
			}
		}


		$data = json_encode($data);

		echo $data;
		exit();

	}

	/**
	 * Details page-follow status
	 */
	public function FocusJudge(){
		//Receive value
		$seller_id = $_GET['seller_id'];
		$user_id = $_COOKIE['user_id'];
		//Build query conditions
		$where['befocus_id'] = $seller_id;
		$where['user_id'] = $user_id;
		//Execute query
		$Focus = new UserFocusModel();
		$result = $Focus->getFocusDetail($where);

		if ($result){
			//Followed
			$data = 'true';
		}else{
			//Not followed
			$data = 'false';
		}
		//Build the return value
		$data = array('judge'=>$data);
		$data = json_encode($data);
		echo $data;
		exit;
	}

	/**
	 * User Center-Download Delete
	 */
	public function DownDel(){
	    //Accept pass value
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
	 * User Center-upload and delete
	 */
	public function UpDel(){
		//Accept pass value
		$up_id = $_GET['up_id'];
		$user_id = $_COOKIE['user_id'];
		//Build query conditions
		$where['opus_id'] = $up_id;
		$where['user_id'] = $user_id;
		//Execute delete
		$Opus = new OpusModel();
		$result = $Opus->Delete($where);
		//Result returned
		if($result){
			$data=array('status'=>'true');
		}else{
			$data = array('status'=>'false');
		}
		
		$data = json_encode($data);
		
		echo $data;
	}

    /**
     * User Center-modify nickname
     */
	public function ModifyNick(){
		$nick_name = $_POST['nickname'];
		$user_id = $_COOKIE['user_id'];

		$pre = "[\\!|@|#|\\$|%|\\^|&|\\*|\\(|\\)|_|\\+|\\||-|=|\\\\|~|`|:|\\\"|\\<|\\>|\\?|;|'|,|\\.|/|“|”|；|：|，|。|、|·|\\{|\\}|\\[|\\]]";

		if (preg_match($pre, $nick_name)) {
			$data=array('status'=>3,'msg'=>'Has special characters');

		}else{
			$where['user_id'] = $user_id;
			$data['user_nickname'] = $nick_name;
			$User = new UserModel();
			$result = $User->save($where,$data);
			if ($result){
				$data=array('status'=>1,'msg'=>'Successfully modified');
			}else{
				$data=array('status'=>0,'msg'=>'Fail to edit');
			}

		}

	
		$data = json_encode($data);
		echo $data;
	}

    /**
     * User Center-Modify Avatar
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

			$data=array('status'=>1,'msg'=>'Successfully modified');
		}else{
			$data=array('status'=>0,'msg'=>'Fail to edit');
		}

		$data = json_encode($data);
		echo $data;
	}





    /**
     * User Center-Real Name Authentication
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

			$data=array('status'=>1,'msg'=>'Uploaded successfully');
		}else{
			$data=array('status'=>0,'msg'=>'Upload failed');
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

			$data=array('status'=>1,'msg'=>'Uploaded successfully');
		}else{
			$data=array('status'=>0,'msg'=>'Upload failed');
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

			$data=array('status'=>1,'msg'=>'Uploaded successfully');
		}else{
			$data=array('status'=>0,'msg'=>'Upload failed');
		}

		$data = json_encode($data);
		echo $data;
	}		
	
	




    /**
     * User registration-email activation
     */


	public function Renzhengemil(){

		$user_email = $_GET['emil'];
        $ip = get_client_ip();
		 $sss = rand(11111,99999);  //Random gold coins
	 $emil = M("emil"); // Verify whether other users have registered their email addresses, add and send the activation code if they haven’t
		
		$where['user_email'] = $user_email;
		
     $jianyan = $emil->where($where)->find(); //  Determine whether there is a registered email address
	
                    if ($jianyan == null) {						
                        $data['user_email'] = $user_email;
						 $data['int'] = $sss;
                        $data['ip'] = $ip;
                        $data['detectiontime'] = date('Y-m-d H:i:s', time());
                        $emil->add($data);
						
						
	                //Build activation link
                $site = M('sys_config');
                $SiteUrl = $site->where('id=3')->getField('value');

             //   $where['user_name'] = $user_name;
              //  $get = $User->findOne($where);

             //   $token = $get['user_token'];

                $url = $sss;

                $send = $this->send_mail($user_email,$url);
            if ($send){
          //   $this->success('Mail sent successfully! Please check the email to complete the registration！',U('Index/index'));
			$data=array('status'=>1,'msg'=>'Mail sent successfully! Please check the email to complete the registration!');
            }else{
                $where['user_email'] = $user_email;

                $emil->delData($where);
                 $data=array('status'=>1,'msg'=>'Mail sent successfully! Please check the email to complete the registration!');
                $this->error('Failed to send mail! Please check your email address!',U('Index/index'));
            }					
						
						
						
						

		}else{
			$where['user_email'] = $user_email;
                $data = array('int'=>$sss);
                $emil->where($where)->save($data);


			
			                //Build activation link
                $site = M('sys_config');
                $SiteUrl = $site->where('id=3')->getField('value');

                $url = $sss;

                $send = $this->send_mail($user_email,$url);
            if ($send){
			$data=array('status'=>1,'msg'=>'Mail sent successfully! Please check the email to complete the registration!');
            }else{
                $where['user_email'] = $user_email;

                $emil->delData($where);
                 $data=array('status'=>1,'msg'=>'Mail sent successfully! Please check the email to complete the registration!');
                $this->error('Failed to send mail! Please check your email address!',U('Index/index'));
            }		

			$data=array('status'=>0,'msg'=>'The verification code has been sent to the mailbox, if you have not received it, please try changing the mailbox');


					}


		$data = json_encode($data);
		echo $data;
	}		








    /**
     * User Center-Display Message
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
     * User Center-Delete Message
     */
	public function del_msg(){
		$id = $_GET['id'];
		$user_id = $_COOKIE['user_id'];

		$where['id'] = $id;
		$where['user_id'] = $user_id;

		$Chat = new ChatModel();
		$result = $Chat->delete($where);
		
		if($result){
			$data=array('status'=>1,'msg'=>'Successfully deleted');
		}else{
			$data=array('status'=>0,'msg'=>'Failed to delete');
		}
		$data = json_encode($data);
		
		echo $data;
	}

    /**
     * User Center-Question
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
			$data=array('status'=>1,'msg'=>'Submitted successfully');
		}else{
			$data=array('status'=>0,'msg'=>'Submission Failed');
		}
		$data = json_encode($data);

		echo $data;
	}









    /**
     * Works download-judgment
     */
	public function download(){
//		$data=array('status'=>'2','msg'=>'You have already downloaded this file, it’s free this time','flag'=>'1');
//		echo json_encode($data);die;

		$opus_id = I('opus_id');
		$user_id = $_COOKIE['user_id'];


		if ($user_id=='' || $user_id==null){
			$data = array('status'=>'0','msg'=>'Not logged in yet');
		}else{

			//Query work information
			$Opus = new OpusModel();
			$Opus_info = $Opus->getOpusDetail(array('opus_id'=>$opus_id));

			$seller_id = $Opus_info['user_id'];
			$price = $Opus_info['price'];
			
			$is_half = $Opus_info['is_half'];

			if ($is_half=='1'){
				$prices = $Opus_info['prices'];; 
			}
			//Check account

			$User = M('user');

			$User_acc = new UserAccountModel();
			$AccInfo = $User_acc->getAcountInfo(array('user_id'=>$user_id));
			$AccInfos = $User->where(array('user_id'=>$user_id))->find();

			$gold_coin = $AccInfo['gold_coin'];
			$gold_coins = $AccInfos['gold_coins'];


                 //dump($AccInfos);

			
			cookie('de',$gold_coin);
			cookie('de1',$gold_coins);
			//Query download
			$OpusDown = new OpusDownloadModel();

			$result = $OpusDown->getDownInfo(array('user_id'=>$user_id,'opus_id'=>$opus_id));


			if($result){
				if($result['down_price']!='0'|| $price=='0'){
					//cookie('de',$result);
					//Downloaded, this time for free
					$down_url = $result['down_url'];
					if($down_url==null || $down_url==''){
					    $down_place = $result['down_place'];
					    $down_pass = $result['down_pass'];
					    $data = array('msg'=>'This download is free','status'=>'3','url'=>$down_place,'pass'=>$down_pass);
                    }else{
                        $data = array('status'=>'2','msg'=>'This download is free','down_url'=>$down_url);
                    }

				}elseif($result['down_price']=='0' && $price!='0'){
					$data = array('status'=>'2','msg'=>'This download requires payment');
					$OpusDown->delete(array('user_id'=>$user_id,'opus_id'=>$opus_id));
				}
			}else{
				//Not downloaded
				if ($is_half=='0'){
				if ($gold_coin<$price){
					$data = array('status'=>'-1','msg'=>'Not enough gold coins to download');
				}else{
					$data = array('status'=>'1','msg'=>'You will deduct'.$price.'gold coin for this download');


				}
			}else{
				if($gold_coins<$prices){
					$data = array('status'=>'-1','msg'=>'Insufficient gold coins, please sign in to accumulate gold coins');
				}else{
					$data = array('status'=>'1','msg'=>'You will deduct'.$prices.'gold coin for this download');
				}

			}






			}
			

			
			}

       echo json_encode($data);

	}

    /**
     * Work download-execution
     */
	public function down(){
		$file_path = I('path');
		if($file_path){

        }

		header("Content-type:text/html;charset=utf-8");
// $file_name="cookie.jpg";
		$file_name=basename($file_path);
//Used to solve the problem that Chinese cannot be displayed
		$file_name=iconv("utf-8","gb2312",$file_name);
//First of all, it is necessary to determine whether the given file exists or not

       /* var_dump($file_path);
        var_dump($file_name);
        //var_dump($file_size);
        echo $_SERVER['DOCUMENT_ROOT'];die;*/
		if(!file_exists($file_path)){
			echo $data=array('msg'=>'The file has been deleted');
			return ;
		}
		$fp=fopen($file_path,"r");
		$file_size=filesize($file_path);
//Headers needed to download the file
		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length:".$file_size);
		header("Content-Disposition: attachment; filename=".$file_name);
		$buffer=1024;
		$file_count=0;
//Return data to the browser
		while(!feof($fp) && $file_count<$file_size){
			$file_con=fread($fp,$buffer);
			$file_count+=$buffer;
			echo $file_con;
			
		}
		fclose($fp);
	}

    /**
     * Work Download-Payment
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


		if ($is_half=='1'){      ///////////////////////////////////////free download






$result = $OpusDown->add($data);
if ($result){

	//Seller//Buyer account operation

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





	//Trading operations
	$Class = M('classify');
	preg_match("/[0-9]+-[0-9]+-([0-9]+)/",$cate,$match);
	$cid= $match[1];
	$cates = $Class->where(array('cid'=>$cid))->getField('name');
	$data_c_b=array(
		'order'=>$order_num,
		'user_id'=>$user_id,
		'content'=>'Download'.$title,
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
		'content'=>'Sell'.$title,
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
		$data = array('down_url'=>$down_url,'msg'=>'Download deduction' . $prices . 'gold','status'=>'1');
 }
	
}else{
	$data = array('msg'=>'Download failed, please refresh and try again');



}                 ///////////////////////////////////////////free download






		}else{

$result = $OpusDown->add($data);      //////////Download for a fee
if ($result){
	$UserAcc = new UserAccountModel();
	//Seller//Buyer account operation
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




	//Trading operations
	$Class = M('classify');
	preg_match("/[0-9]+-[0-9]+-([0-9]+)/",$cate,$match);
	$cid= $match[1];
	$cates = $Class->where(array('cid'=>$cid))->getField('name');
	$data_c_b=array(
		'order'=>$order_num,
		'user_id'=>$user_id,
		'content'=>'Download'.$title,
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
		'content'=>'sell'.$title,
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

	   $data = array('down_url'=>$down_url,'msg'=>'Download will deduction' . $price . 'gold','status'=>'1');

 }
	
}else{
	$data = array('msg'=>'Download failed, please refresh and try again');
}                                                         //Download for a fee




		}






		echo json_encode($data);
	}







	

    /**
     * User Center-Sign in-Judgment
     */
	public function qiandao(){
	    $user_id = $_COOKIE['user_id'];

	    $User = M('user');
		 $t=time();
		 $endtimestr = "23:59:59";
		 $endtime = strtotime($endtimestr);
		 $ssss = rand(1,5);  //Random gold coins
	    $info = $User->where(array('user_id'=>$user_id))->find();

		 $newtime=$info['qiandao_data'];		 		 
	   // if($t > $newtime+24*3600){
			
         if($t > $newtime){
			 
			$data['gold_coins'] = $info['gold_coins'] + $ssss;		
			$data['qiandao_data'] = $endtime ;			

			$User->where("user_id = $user_id")->save($data); // Update records based on conditions



           $data = array(
               'status'=>'2',
           //  'coins'=>$gold_coins,
		  'msg'=> 'Sign in successfully to receive' . $ssss . 'gold'
           );
           echo json_encode($data);exit;
        }else{
	        $data = array(
                'status'=>'0',
	            'msg'=> 'Once a day!'
            );
	        echo json_encode($data);exit;
        }

    }







    /**
     * Get random
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
     * Cancel payment
     */
    public function cancel_pay(){
        $id = $_GET['id'];
       if($id){
            $Rec  = M('user_recharge');
           $result =  $Rec->where(array('id'=>$id))->delete();
           if($result){
               $data = array('status'=>1,'msg'=>'Cancel success');
           }else{
               $data = array('status'=>0,'msg'=>'Cancel failed');
           }
        }else{
            $data = array('status'=>0,'msg'=>'Cancel failed');
        }

        echo json_encode($data);
    }


}

?>