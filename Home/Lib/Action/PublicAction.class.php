<?php
// 本类由系统自动生成，仅供测试用途
class PublicAction extends CommonAction
{
    public function header()
    {

        $Chat = M('chat');

        $user_id = cookie('user_id');

        $where_c = array(
            'user_id'=>$user_id,
            'chat_state'=>'1',
            'chat_form'=>'0'
        );

        $count = $Chat->where($where_c)->count();

        $this->assign(array('new_chat'=>$count));
        //实例化栏目模型
        $Classify = new ClassifyModel();
        //生成头部导航
        $Cates = $Classify->CreateCate();
        /*        //划分显示和隐藏的栏目
                foreach($Cates as $key=>$value ){
                    if ($key<3){
                        //显示
                        $cateshow[] = $value;
                    }else{
                        //隐藏
                        $catehide[] = $value;
                    }
                }*/
       //logo
        $Ad = M('sys_ads');
        $logo = $Ad->where(array('ad_locationpic'=>'station_logo'))->find();

        //赋值

        $this->assign(array('Cates' => $Cates,'logo'=>$logo));

    }

    public function footer()
    {

        $site = M('sys_config');
        $key = $site->where('id=5')->getField('value');
        
        $this->assign('key_show',$key);
    }

    public function phone(){
        $this->display();
    }
    
    public function we_chat(){
        $this->display('Public/weixin');
    }
    //注册页面显示
    public function RegisterShow()
    {
        $this->header();
        $this->footer();
        $this->display('Public/register');
    }
    //登录页面显示
    public function LoginShow()
    {
        $this->header();
        $this->footer();
        $this->display('Public/login');
    }
    //忘记密码页面显示
    public function ForgetShow()
    {
        $this->header();$this->footer();
        
        $this->display('Public/forget_1');
    }

    /**
     * 用户登录
     */
    public function login()
    {
                  //$this->error('',U('Public/forget_1'));
        if (isset($_POST['dosubmit'])) {
            $data = $_POST;
            $User = new UserModel();
            $result = $User->login($data);
            if ($result) {

                $this->success('登录成功');
                //echo session('username');
            } else {

                $this->error('无此用户或已被封禁！', U('Public/LoginShow'));
            }
        }
    }

    public function getLoginInfo()
    {
        //获取用户信息
        $User = new UserModel();
        $user_id = cookie('user_id');

        $where['user_id'] = $user_id;
        $UserInfo = $User->getUserInfo($where);
        $user_name = $UserInfo['user_name'];
        $nickname = $UserInfo['user_nickname'];
        if ($nickname==null){
            $nickname = $user_name;
        }
        $user_pic = $UserInfo['user_pic'];

        //获取用户账户信息
        $Acount = new UserAccountModel();
        $AcountInfo = $Acount->getAcountInfo($where);

        $gold_coin = $AcountInfo['gold_coin'];

        //组合返回值
        $islogin = cookie('is_login');
        $msg = array(
            'islogin' => $islogin,
            'nickname' => $nickname,
            'avar' => $user_pic,
            'amount' => $gold_coin
        );

        echo json_encode($msg);
        exit();
    }

    public function login_out()
    {

        cookie('is_login', null);
        cookie('user_id',null);
        session(null);

        $this->success('退出成功', U('Index/index'));
    }
    /*   public function login() {
           
           if (session('user_id')){
               $this->redirect('Service/index');}
   
           $reurl =urlencode($_GET['reurl']); //地址加密 
           $this->assign('reurl',$reurl);
           $this->display();
       }*/

    /**
     * 密码找回
     */
    public function forget()
    {
        $show = I('show');
       
        switch ($show){
            case 2:
                $email = I('email');
                $where['user_email'] = $email;

                $exptime = date('Y-m-d H:i:s',time()+3600*12);//注册超时24小时
                $token = md5($email.$exptime);
                $data = array('user_exptime'=>$exptime,
                    'user_token'=>$token,);
                $User = new UserModel();
                $result = $User->save($where,$data);
                if ($result){
                    //构建激活链接
                    $site = M('sys_config');
                    $SiteUrl = $site->where('id=3')->getField('value');

                    $where['user_email'] = $email;
                    $get = $User->findOne($where);

                    $token = $get['user_token'];

                    $url = $SiteUrl.'/index.php/Public/forget?show=3&token='.$token;

                    $send = $this->send_mail($email,$url);
                }


                $start = strpos($email,'@')+1;
                $len = strlen($email);
                $num = $len-$start;
                $url = substr($email,$start,$num);

                $this->assign(array('email'=>$email,'url'=>$url));
                $show_page = "Public/forget_2";
                break;
            case 3:

                $token = $_GET['token'];
                $time = date('Y-m-d H:i:s',time());

                $user = M('user');
                $where['user_token'] = $token;
                $result = $user->where($where)->find();

                $user_name = $result['user_name'];
                
                $this->assign(array('user_name'=>$user_name));
                if ($result['user_exptime']>$time){
                    $show_page = "Public/forget_3";
                }else{
                    //超时删除数据
                     $this->error('邮件已超过有效期',U('Public/ForgetShow'));
                }

                break;
            case 4:
                $user_name = I('user_name');
                $pass = I('pass');
                $cw['user_name'] = $user_name;
                $cd['user_password'] = md5($pass);

                $User = new UserModel();
                $result = $User->save($cw,$cd);
                if ($result){
                    $show_page = "Public/forget_4";
                }else{
                    $this->error('未知错误，请重新操作或联系管理员',U('Public/ForgetShow'));
                }

                break;
        }
        if ($show==""){
            $show_page = "Public/forget_1";
        }

        //$this->show('暂未开启');
        $this->header();$this->footer();
        $this->display($show_page);
    }

    /**
     * 用户退出
     */
    public function logout()
    {
        session_destroy();
        cookie('user_nickname', null);
        cookie('user_pic', null);

        $this->redirect("/index");
    }


    //验证码
    Public function verify()
    {
        import('ORG.Util.Image');//本地用

        Image::buildImageVerify(4, 3, 'png', 80, 38, 'verity');//用法($length,$mode,$type,$width,$height,$verifyName)
        // Image::GBVerify(4, 'png', 1, 38, 'SIMHEI.TTF', 'verify');//字体文件可以从window的Fonts目录下面找到
    }
public function show(){
    var_dump($_SESSION['verify']);
    var_dump($_COOKIE['de']);

}
    Public function checkverify()
    {
      session('de', md5(I('param'))) ;
     
        //每次生成验证码的时候，就会通过SESSION记录本次的验证码的md5后的字符串信息
        //verify名称取决于你的验证码的verifyName参数的值。
        if ($_SESSION['verify'] != md5($_GET['param'])) {
            echo '{ "info":"验证码错误","status":"n"}';
            // $this->error('验证码错误！');
        } else {
            echo '{
                "info":"",
                "status":"y"
            }';
        }
    }



 
    //邮箱注册操作
    public function register()
    {

        if (isset($_POST)){
            //获取数据
            $user_name = $_POST['username'];    //账号
            $user_password = md5($_POST['password']);//密码
            $user_email = $_POST['email'];      //邮箱
            $emailword = $_POST['emailword'];      //邮箱验证码			
            $ip = get_client_ip();              //用户ip
            $time = date('Y-m-d H:i:s',time()); //创建时间
            $exptime = date('Y-m-d H:i:s',time()+3600*24);//注册超时24小时
            $token = md5($user_name.$user_password.$time);

			
			 $emil = M("emil"); // 验证其他用户是否注册过邮箱 没有就添加并发送激活码
		
		$where['user_email'] = $user_email;	
			
	     $jianyan = $emil->where($where)->find(); //  判断是否有注册邮箱	
              $int= $jianyan['int'];
		 
			 if ($emailword == $int) {		
			
			             //构建新增数据
            $data = array(
                'user_name'=>$user_name,
                'user_password'=>$user_password,
                'user_email'=>$user_email,
                'user_registertime'=>$time,
                'user_registerip'=>$ip,
                'user_exptime'=>$exptime,
                'user_token'=>$token,
				'user_emailState'=>'1', 
				'user_state'=>'1',
                'user_pic'=>'/Public/images/header-img.jpg'
            );


            //创建数据
            $User = new UserModel();
           $User->addData($data);
          //  if ($result){

                //构建激活链接
      //          $site = M('sys_config');
     //           $SiteUrl = $site->where('id=3')->getField('value');

     //           $where['user_name'] = $user_name;
    //            $get = $User->findOne($where);
//
      //          $token = $get['user_token'];

       //         $url = $SiteUrl.'/index.php/Public/activate?token='.$token;

        //        $send = $this->send_mail($user_email,$url);
          //  if ($send){
                $this->success('注册成功！欢迎来到鹿酷网，已完成激活注册！',U('Index/index'));
            }else{
            //    $where['user_name'] = $user_name;

           //     $User->delData($where);

                $this->error('验证失败！请检查您填写的邮箱或重新发送验证码！');
            }
            }
			
			
			
			
			 }
			



    //    }
   // }
	
	
	
	
    //邮箱注册激活
    public function activate(){
        if (isset($_GET)){
            $token = $_GET['token'];
            $time = date('Y-m-d H:i:s',time());

            $user = M('user');
            $where['user_token'] = $token;
            $result = $user->where($where)->find();
            $user_id = $result['user_id'];
            //激活是否超时
            if ($result['user_exptime']>$time){
                //修改账号状态
                $data = array('user_emailState'=>'1', 'user_state'=>'1');
                $user->where($where)->save($data);
                //创建账户数据
                $Account = new UserAccountModel();
                $data = array('user_id'=>$user_id,'time'=>date( 'Y-m-d H:i:s'));
                $Account->addData($data);

                $this->success('激活成功！',U('Index/index'));
            }else{
                //超时删除数据
                $user->where($where)->delete();
                
                $this->error('注册邮件已超时，请重新注册！',U('Public/RegisterShow'));
            }
        }
    }

    /**
     * 登陆验证
     */
    public function check_login(){
        if (isset($_GET)) {
            //获取传值
            $clientid = $_GET['clientid'];
            $user_name = $_GET[$clientid];

            //查询
            $where['user_name|user_email'] = $user_name;
            $User = new UserModel();
            $result = $User->findOne($where);
cookie('de',$result);
            //验证返回
            if ($result) {
                echo '{
                "status":"true"
                }';
                exit();
            } else {
                echo '{
                "status":"false";
              
            }';

            }
            exit();
        }
        else{
            $this->error('数据验证故障，请重试！', U('Public/register'));
        }
    }
    //用户名唯一性验证
    Public function check_name()
    {
        if (isset($_GET)) {
            //获取传值
            $clientid = $_GET['clientid'];
            $user_name = $_GET[$clientid];
            //查询
            $where['user_name|user_email'] = $user_name;
            
            $User = new UserModel();
            $result = $User->findOne($where);

            //验证返回
            if (empty($result)) {
                echo '{
                "status":"true"
                }';
                exit();
            } else {
                echo '{
                "status":"false";
                   }';

            }
            exit();
        }
        else{
                $this->error('数据验证故障，请重试！', U('Public/register'));
            }

      
    }
    //密码验证
    public function check_pass()
    {
        if (isset($_GET)) {
            $clientid = $_GET['clientid'];
            $user_pass = $_GET[$clientid];

            $pre = "[\\!|@|#|\\$|%|\\^|&|\\*|\\(|\\)|_|\\+|\\||-|=|\\\\|~|`|:|\\\"|\\<|\\>|\\?|;|'|,|\\.|/|“|”|；|：|，|。|、|·|\\{|\\}|\\[|\\]]";

            if (preg_match($pre, $user_pass)) {
                echo '{
                "status":""
                }';

            } else {
                echo '{
                "status":"true"
                }';
            }
            exit();

        }else {
            $this->error('数据验证故障，请重试！', U('Public/register'));
        }
    }
    //邮箱唯一性验证
    Public function check_email(){
        if (isset($_GET)){
            //获取传值
            $clientid = $_GET['clientid'];
            $email = $_GET[$clientid];

            $where['user_email'] = $email;
            $User = new UserModel();
            $result = $User->findOne($where);

            if (empty($result)) {
                echo '{
                "status":"true"
                }';
              
            } else {
                echo '{
                "status":"";
                         }';
                
            }exit();
        }else{
            $this->error('数据验证故障，请重试！',U('Public/register'));
        }

    }
    //qq登陆
    public function qqlogin($code){
        vendor('qqAPI.qqAPI');
        $_GET['code'] =  $code;
        echo $_GET['code'];
        if(empty($_GET['code']))

        {

            exit('参数非法');

        }
        //实例化
        $qq_sdk = new Qq_sdk();
       //获取access_token的值
        $token = $qq_sdk->get_access_token($_GET['code']);
       //获取open_id
        $open_id = $qq_sdk->get_open_id($token['access_token']);
        var_dump($open_id);
       //获取用户信息
       $user_info = $qq_sdk->get_user_info($token['access_token'], $open_id['openid']);
         var_dump($user_info);
        die;
    }




}