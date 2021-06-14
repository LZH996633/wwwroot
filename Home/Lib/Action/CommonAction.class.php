<?php
header('Content-Type:text/html;charset=UTF-8');
// Business-based controller
//Basic call file
class CommonAction extends Action {
    
    function _initialize() {
        //Load the extension library
        // vendor('sliver.upload');
        // 
        $re=str_repeat('&nbsp;', 4);
        $this->assign('repeat',$re);

        // Module
        $path['pid'] = '1';
        $lei = M('classify')->where($path)->select();
        $this->assign('lei',$lei);




        // Website information
        $site = M('sys_config');

        $Contact_phone = $site->where(array('name'=>'Contact_phone'))->getField('value');
        $Contact_QQ = $site->where(array('name'=>'Contact_QQ'))->getField('value');
        $Contact_email = $site->where(array('name'=>'Contact_email'))->getField('value');
        $Work_address = $site->where(array('name'=>'Work_address'))->getField('value');
        $Work_time = $site->where(array('name'=>'Work_time'))->getField('value');

        $this->assign(array('Contact_phone'=>$Contact_phone,'Contact_QQ'=>$Contact_QQ,'Contact_email'=>$Contact_email,'Work_address'=>$Work_address,'Work_time'=>$Work_time));


        $SiteUrl = $site->where('id=3')->getField('value');
        
        $this->assign('SiteUrl',$SiteUrl);

        $icp = $site->where('id=12')->getField('value');
        $this->assign('icp',$icp);

        $title = $site->where('id=2')->getField('value');
        $this->assign('title',$title);

        $logo = $site->where('id=4')->getField('value');
        $this->assign('logo',$logo);

        $key = $site->where('id=5')->getField('value');
        $this->assign('key',$key);
       

        $des = $site->where('id=6')->getField('value');
        $this->assign('des',$des);

        // $tj = $site->where('id=7')->getField('value');
        // $this->assign('tj',$tj);

        //Points to money ratio
        $integral = $site->where('id=11')->getField('value');
        C('INTEGRAL_TO_POINT',$integral);

        //Minimum withdrawal amount
        $minmoney = $site->where('id=41')->getField('value');
        C('MIN_MONEY',$minmoney);

        // $icp = $site->where('id=12')->getField('value');
        // $this->assign('icp',$icp);

        $notice = $site->where('id=17')->getField('value');
        $this->assign('notice',$notice);

        $webswitch = $site->where('id=28')->getField('value');
        if($webswitch=='2'){
            echo "The website is under maintenance. . . .";
            die;
        }
        $this->assign('webswitch',$webswitch);
        
        $shortcut = $site->where('id=18')->getField('value');
        $this->assign('shortcut',$shortcut);
        
        // footer bottom information
        // $z = M('sys_config');  
        
        // $pspay = $z -> where('id=16')->find();
        // $this->assign('pspay',$pspay['value']);

        
    }
 
    public function getEmailConfig(){

    }

//$r = think_send_mail('Email to be sent','The name of the sender, which is your name','File title','content of email');
   public function send_mail($to,$url){
       $config=M('sys_config');
       $eMail_SMTP=$config-> getFieldByName('eMail_SMTP','value');
       $eMail_port=$config-> getFieldByName('eMail_port','value');
       $eMail_acc=$config-> getFieldByName('eMail_acc','value');
       $eMail_key=$config-> getFieldByName('eMail_key','value');
       $eMail_sender=$config-> getFieldByName('eMail_sender','value');
       $eMail_title=$config-> getFieldByName('eMail_title','value');
       $eMail_content=$config-> getFieldByName('eMail_content','value');

    //  $body = $eMail_content.",<a href=$url>Click the link to activate the account</a>";
	  
		  $body = $eMail_content.",$url. Copy the verification code on the left to the registration area to verify registration";
		  
    vendor('PHPMailer.class#phpmailer'); //Import the class.phpmailer.php class file from the PHPMailer directory

    $mail             = new PHPMailer(); //PHPMailer object

    $mail->CharSet    = 'UTF-8'; //Set the mail code, the default is ISO-8859-1, if you want to send Chinese, this must be set, otherwise the code is garbled

    $mail->IsSMTP();  // Set to use SMTP service

    $mail->SMTPDebug  = 1;                      // Turn off SMTP debugging// 1 = errors and messages  // 2 = messages only

    $mail->SMTPAuth   = true;                   // Enable SMTP authentication

  //  $mail->SMTPSecure = '';                  // Use secure protocol ssl

	$mail->Host="ssl://smtp.qq.com";  //You need to be cautious here, you don’t need to put“ssl://”，

  //  $mail->Port       = $eMail_port;                  //Port number of the SMTP server   1
     $mail->Port       = "465";                  //Port number of the SMTP server   1  465

  //  $mail->Username   = $eMail_acc;  // SMTP server user name   1
    $mail->Username   = 'ccw51@qq.com';  // SMTP server user name   1

 //   $mail->Password   = $eMail_key;           // SMTP server password     1
    $mail->Password   = 'dqsmxkehimnqbbbb';           // SMTP server password     1

    $mail->FromName = $eMail_sender;                  //Sender name

//    $mail->From = $eMail_acc;
    $mail->From = 'ccw51@qq.com';	

    $mail->Subject    = $eMail_title;                //mail title

    $mail->AltBody    = "In order to view the email, please switch to an email client that supports HTML";

    $mail->MsgHTML($body);

    $mail->AddAddress($to); //Send email address
    

	if( $mail->send()){

		return true;
		
	}else{
        return false;
	}

 }

}

?>
