<?php
header('Content-Type:text/html;charset=UTF-8');
// 业务基控制器
//基础调用文件
class CommonAction extends Action {
    
    function _initialize() {
        //加载扩展函数库
        // vendor('sliver.upload');
        // 
        $re=str_repeat('&nbsp;', 4);
        $this->assign('repeat',$re);

        // 模块
        $path['pid'] = '1';
        $lei = M('classify')->where($path)->select();
        $this->assign('lei',$lei);


        //qq登录
        $Config = M('sys_config');

        $qq_back = $Config->where(array('name'=>'QQ_login_callback'))->getField('value');
        $qq_id = $Config->where(array('name'=>'QQ_login_id'))->getField('value');
        $qq_url = " https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$qq_id."&redirect_uri=".$qq_back;
        $this->assign(array('qq_login'=>$qq_url));

       //微信登录
        $WeChat_id=$Config-> getFieldByName('WeChat_login_id','value');
        $WeChat_back=$Config-> getFieldByName('WeChat_login_callback','value');
        $WeChat_url = "https://open.weixin.qq.com/connect/qrconnect?appid=".$WeChat_id."&redirect_uri=".$WeChat_back."&response_type=code&scope=snsapi_login&state=".md5('weixindenglu')."#wechat_redirect";

        $this->assign(array('wechat_login'=>$WeChat_url));
        // 网站信息
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

        //积分与金钱比率
        $integral = $site->where('id=11')->getField('value');
        C('INTEGRAL_TO_POINT',$integral);

        //最少提取金额[锭]
        $minmoney = $site->where('id=41')->getField('value');
        C('MIN_MONEY',$minmoney);

        // $icp = $site->where('id=12')->getField('value');
        // $this->assign('icp',$icp);

        $notice = $site->where('id=17')->getField('value');
        $this->assign('notice',$notice);

        $webswitch = $site->where('id=28')->getField('value');
        if($webswitch=='2'){
            echo "网站维护中。。。。";
            die;
        }
        $this->assign('webswitch',$webswitch);
        
        $shortcut = $site->where('id=18')->getField('value');
        $this->assign('shortcut',$shortcut);
        
        // footer底部信息
        // $z = M('sys_config');  
        
        // $pspay = $z -> where('id=16')->find();
        // $this->assign('pspay',$pspay['value']);

        
    }
 
    public function getEmailConfig(){

    }

//$r = think_send_mail('要发送的邮箱','发送人名称，即你的名称','文件标题','邮件内容');
   public function send_mail($to,$url){
       $config=M('sys_config');
       $eMail_SMTP=$config-> getFieldByName('eMail_SMTP','value');
       $eMail_port=$config-> getFieldByName('eMail_port','value');
       $eMail_acc=$config-> getFieldByName('eMail_acc','value');
       $eMail_key=$config-> getFieldByName('eMail_key','value');
       $eMail_sender=$config-> getFieldByName('eMail_sender','value');
       $eMail_title=$config-> getFieldByName('eMail_title','value');
       $eMail_content=$config-> getFieldByName('eMail_content','value');

    //  $body = $eMail_content.",<a href=$url>点击链接激活账号</a>";
	  
		  $body = $eMail_content.",$url 复制左边验证码到注册区域验证注册";
		  
    vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件

    $mail             = new PHPMailer(); //PHPMailer对象

    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码

    $mail->IsSMTP();  // 设定使用SMTP服务

    $mail->SMTPDebug  = 1;                      // 关闭SMTP调试功能// 1 = errors and messages  // 2 = messages only

    $mail->SMTPAuth   = true;                   // 启用 SMTP 验证功能

    $mail->SMTPSecure = '';                  // 使用安全协议ssl

     $mail->Host="ssl://smtp.qq.com";  //此处需要谨慎，本地测试时不需要放“ssl://”，

    $mail->Port       = $eMail_port;                  //SMTP服务器的端口号   1
       //  $mail->Port       = 465;                  //SMTP服务器的端口号   1

    $mail->Username   = $eMail_acc;  // SMTP服务器用户名   1
       //  $mail->Username   = 'ccw51@qq.com';  // SMTP服务器用户名   1

   $mail->Password   = $eMail_key;           // SMTP服务器密码     1
       //  $mail->Password   = 'fwlpzdowhubpbajd';           // SMTP服务器密码     1

    $mail->FromName = $eMail_sender;                  //发件人名称

    $mail->From = $eMail_acc;
       //  $mail->From = 'ccw51@qq.com';

    $mail->Subject    = $eMail_title;                //邮件标题

    $mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 

    $mail->MsgHTML($body);

    $mail->AddAddress($to); //发送邮件地址
    

	if( $mail->send()){

		return true;
		
	}else{
        return false;
	}

 }

}

?>
