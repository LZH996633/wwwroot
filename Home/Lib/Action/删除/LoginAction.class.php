<?php

class LoginAction extends CommonAction{

    private $WeChat ;
    
    public function __construct()
    {
        vendor('qqAPI.qqAPI');
        vendor('wechatAPI.wechatAPI');

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
     * QQ登录
     */
    public function QQ_login(){

        $Config = M('sys_config');
        $back = $Config->where(array('name'=>'QQ_login_callback'))->getField('value');
        $id = $Config->where(array('name'=>'QQ_login_id'))->getField('value');
        $pass = $Config->where(array('name'=>'QQ_login_key'))->getField('value');

        if(empty($_GET['code']))
        {
            exit('参数非法');

        }
        $User = M('User');

       //实例化
        $qq_sdk = new Qq_sdk();

        $qq_sdk::$app_id = $id;
        $qq_sdk::$app_secret = $pass;
        $qq_sdk::$redirect = $back;

        //获取access_token的值
        $token = $qq_sdk->get_access_token($_GET['code']);

        //获取open_id
        $open_id = $qq_sdk->get_open_id($token['access_token']);


        $user_pass = $open_id['openid'];

        $result = $User->where(array('user_token'=>'qq_'.$user_pass))->find();

        if($result){
            cookie('user_id',$result['user_id']);
            cookie('is_login',true);

            echo "<script type='text/javascript'>
            var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
            </script>";
          }else{

            $user_info = $qq_sdk->get_user_info($token['access_token'], $open_id['openid']);
            $random = $this->get_random($User,'user_name','00QQ_');

            $data = array(
                'user_name'=>$random,
                'user_registerip'=>get_client_ip(),
                'user_password'=>$random,
                'user_token'=>md5(md5($open_id['openid'])),
                'user_nickname'=>$user_info['nickname'],
                'user_pic'=>$user_info['figureurl_qq_2'],
                'user_exptime'=>date('Y-m-d H:i:s'),
                'user_state'=>'1'
            );

            $result = $User->data($data)->add();
            if($result){

                $Acc =  M('user_account');
                $new_info = $User->where(array('user_token'=>'qq_'.$user_pass))->find();
                $data_acc = array(
                    'user_id'=>$new_info['user_id']
                );
                $Acc->data($data_acc)->add();

                cookie('user_id',$new_info['user_id']);
                cookie('is_login',true);
                echo "<script type='text/javascript'>
                var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                </script>";
            }
        }


    }

    public function WeChat_login_check(){
        
        if($_GET['code']){
            $this->WeChat->CODE=$_GET['code'];
            $result=$this->WeChat->getAccessToken();
            $this->WeChat->ACCESS_TOKEN = $result['access_token'];
            $this->WeChat->OPENID = $result['openid'];

            $info = $this->WeChat->getWXUsersInfo();
              var_dump($info);


                $openID = $info['openid'];
                $nickname = $info['nickname'];
                $user_pic = $info['headimgurl'];
                $time = date("Y-m-d H:i:s");

                $data = array(
                    'user_name'=>$openID,
                    'user_nickname'=>$nickname,
                    'user_pic'=>$user_pic,
                    'user_exptime'=>$time
                );
           // var_dump($data);
               $User = new UserModel();
              $result =  $User->addData($data);
            
                                //$this->success('登录成功',U('Index/index'));
              }

    }
    public function login($user_id){
       // var_dump($user_id);
        session('user_id',$user_id);
    }

    /**
     * 微信登录
     */
    public function WeChat_login(){

        if($_GET['code']){
            //实例化
           $WeChat = new WeChat();
            $User = M('user');

            $config=M('sys_config');
            $WeChat_login_id=$config-> getFieldByName('WeChat_login_id','value');
            $WeChat_login_key=$config-> getFieldByName('WeChat_login_key','value');
            $WeChat->APPID = $WeChat_login_id;
            $WeChat->APPSECRET = $WeChat_login_key;

            //获取access_token 和 openid
            $this->WeChat->CODE=$_GET['code'];
            $result=$this->WeChat->getAccessToken();
            $open_id = $result['openid'];
            $open_info = $User->findOne(array('user_token'=>'wx_'.$open_id));
            if($open_info){

                cookie('user_id',$open_info['user_id']);
                cookie('is_login',true);

                echo "<script type='text/javascript'>
                var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                </script>";

            }else{
                //获取用户信息
                $this->WeChat->ACCESS_TOKEN = $result['access_token'];
                $this->WeChat->OPENID = $result['openid'];
                $info = $this->WeChat->getWXUsersInfo();
                //写入数据
                $openID = $info['openid'];
                $nickname = $info['nickname'];
                $user_pic = $info['headimgurl'];
                $time = date("Y-m-d H:i:s");

                $user_name = $this->get_random($User,'user_name','WX_');
                $data = array(
                    'user_name'=>$user_name,
                    'user_token'=>'wx_'.$openID,
                    'user_nickname'=>$nickname,
                    'user_pic'=>$user_pic,
                    'user_exptime'=>$time
                );
                   $result = $User->addData($data);
                   if($result){
                       $open_info = $User->findOne(array('user_token'=>'wx_'.$open_id));

                       cookie('user_id',$open_info['user_id']);
                       cookie('is_login',true);

                       echo "<script type='text/javascript'>
                      var index = parent.layer.getFrameIndex(window.name);
                      parent.layer.close(index);
                        </script>";
                   }
            }

        }
        }


}
