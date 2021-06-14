<?php

vendor('Alipay.Corefunction');
vendor('Alipay.Md5function');
vendor('Alipay.Notify');
vendor('Alipay.Submit');
vendor('WxPayAPI.lib.WxPay','','.Api.php');
vendor('WxPayAPI.lib.WxPay','','.Notify.php');

// vendor('WxPayAPI.lib.WxPay.Data');
class RechargeAction extends CommonAction{

    public function _initialize() {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
        vendor('WxPayAPI.lib.WxPay','','.Api.php');
        vendor('WxPayAPI.lib.WxPay','','.Notify.php');

    }

    /**
     * 在线支付+银行转账
     */
    public function recharge(){

        //充值途径 1：在线支付 2.银行转账
        $pay_type = $_POST['pay_type'];

        $type = $_POST['type'];
        $rec_num = $_POST['rec_num'];
       $order = $_POST['order'];

        if ($pay_type=='1'){
            //在线支付
            switch ($type){
                case '1'://支付宝支付
                    $this->AliPay($rec_num,$order);
                    break;
                case '2'://微信支付
                    $this->WeChat($rec_num,$order);
                    break;

            }

        }
        if($pay_type==2){

            $this->BankTransfer($rec_num);
        }
    }

    /**
     * 支付宝支付
     * @param $rec_num
     */
    public function AliPay($rec_num,$order){


        //获取配置
        $config=M('sys_config');
        $url = $config->getFieldByName('url','value');
        $ali_id=$config-> getFieldByName('Ali_pay_id','value');
        $ali_key=$config-> getFieldByName('Ali_pay_key','value');
        $ali_email=$config-> getFieldByName('Ali_pay_acc','value');


        //支付宝配置参数
        $alipay_config = array(
            'partner'		=> $ali_id,
            //收款支付宝账号
            'seller_email'	=> $ali_email,
            //安全检验码，以数字和字母组成的32位字符
            'key'		=> $ali_key,
            //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

            //签名方式 不需修改
            'sign_type'   => strtoupper('MD5'),
            //字符编码格式 目前支持 gbk 或 utf-8
            'input_charset' => strtolower('utf-8'),
            //ca证书路径地址，用于curl中ssl校验
            //请保证cacert.pem文件在当前文件夹目录中
            'cacert'    => getcwd().'\\cacert.pem',

            //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
            'transport'    => 'http',

        );


        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = $url."/index.php/Pay/Ali_notifyurl";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = $url."/index.php/Pay/Ali_returnurl";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

   /*     //成功跳转页面
        $successpage = $url."/index.php/Pay/Ali_jump";
        //失败跳转页面
        $errorpage = $url."/index.php/Pay/Ali_jump";*/
        //商户订单号
        if($order){
            $out_trade_no = $order;
        }else{
           $out_trade_no =date('YmdHis',time()).substr(md5(cookie('user_id')),0,14);
    }  //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = "网站充值";
        //必填
        $buyer_uid = cookie('user_id');

        //付款金额
        $total_fee =  $rec_num;
        //必填
        //订单描述
        $body = "网站充值交易";
        //商品展示地址
        $show_url = "http://www.baidu.com";
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
        //写入
        if($order){

        }else{
          $data['user_id'] = cookie('user_id');
        $data['acct_money'] = $rec_num;
        $data['acct_order'] = $out_trade_no;
        $data['acct_time'] = date('Y-m-d H:i:s');
        $data['acct_status'] = 0;
        $data['acct_method'] = 1;
        $data['ip'] = get_client_ip();
        M('user_recharge') -> data($data) -> add();
        }
        /************************************************************/
//构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($ali_id),
            "seller_email" => trim($ali_email),
            "payment_type"  => $payment_type,
            "notify_url"    => $notify_url,
            "return_url"    => $return_url,
           /* 'successpage'=>$successpage,
            'errorpage'=>$errorpage,*/
            "out_trade_no"  => $out_trade_no,
            "buyer_uid"     => $buyer_uid,
            "subject"   => $subject,
            "total_fee" => $total_fee,
            "body"  => $body,
            "show_url"  => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip"   => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );
//建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }

    /**
     * 微信支付
     * @param $rec_num
     */
    public function WeChat($rec_num,$order){
        ini_set('date.timezone','Asia/Shanghai');

        $Public = new PublicAction();
        $Public->footer();
        $Public->header();

        //支付配置
        $config=M('sys_config');
        $WeChat_pay_id=$config-> getFieldByName('WeChat_pay_id','value');
        $WeChat_pay_key=$config-> getFieldByName('WeChat_pay_key','value');
        $WeChat_pay_acc=$config-> getFieldByName('WeChat_pay_acc','value');

        $url = $config->getFieldByName('url','value');
        //写入数据
        $Rec = M('user_consume');
        //产品ID
        $out_time = date('YmdHis'.cookie('user_id'));
        if($order){
            $out_trade_no = $order;

        }else{
            $out_trade_no =date('YmdHis').substr(md5(cookie('user_id')),0,14);

            $user_id = cookie('user_id');
            $time = date("Y-m-d H:i:s");
            $ip = get_client_ip();

            $data=array(
                'user_id'=>$user_id,
                'acct_order'=>$out_trade_no,
                'acct_time'=>$time,
                'acct_money'=>$rec_num,
                'acct_method'=>'2',
                'acct_status'=>'0',
                'ip'=>$ip,
            );
            $Rec->data($data)->add();
        }

        $input = new WxPayUnifiedOrder();
        //设置
        WxPayConfig::$APPID  = $WeChat_pay_id;
        WxPayConfig::$MCHID = $WeChat_pay_acc;
        WxPayConfig::$KEY = $WeChat_pay_key;

        $input->SetBody("网站充值");
        $input->SetAttach("网站充值");
        $input->SetOut_trade_no($out_trade_no);
        $input->SetTotal_fee($rec_num*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("充值");
        $input->SetNotify_url($url."/index.php/Recharge/WeChat_notifyurl");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($out_time);

        if($input->GetTrade_type() == "NATIVE")
        {
            $WxPayApi = new WxPayApi();
            $result = $WxPayApi::unifiedOrder($input);
        }

        $url = $result["code_url"];

        $this->assign(array('url'=>$url,'rec_num'=>$rec_num));
        $this->display('Recharge/we_chat');
    }

    /**
     * 银行转账
     * @param $rec_num
     */
    public function BankTransfer($rec_num){

        $user_id = cookie('user_id');

        $out_trade_no =date('YmdHis',time()).substr(md5($user_id),0,14);

        $data['user_id'] = $user_id;
        $data['acct_money'] = $rec_num;
        $data['acct_order'] = $out_trade_no;
        $data['acct_time'] = date('Y-m-d H:i:s');
        $data['acct_status'] = 2;
        $data['acct_method'] = 3;
        $data['ip'] = get_client_ip();

        M('user_recharge') -> data($data) -> add();
        $this->success('信息已创建,请尽快转账，账户余额将在核实后处理',U('Service/Close'));
    }

    /**
     * 支付宝异步通知
     */
    public function Ali_notifyurl(){

        //获取配置
        $config=M('sys_config');
        $ali_id=$config-> getFieldByName('Ali_pay_id','value');
        $ali_key=$config-> getFieldByName('Ali_pay_key','value');
        $ali_email=$config-> getFieldByName('Ali_pay_acc','value');
        //支付宝配置参数
        $alipay_config = array(
            'partner'		=> $ali_id,
            //收款支付宝账号
            'seller_email'	=> $ali_email,
            //安全检验码，以数字和字母组成的32位字符
            'key'		=> $ali_key,
            //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

            //签名方式 不需修改
            'sign_type'   => strtoupper('MD5'),
            //字符编码格式 目前支持 gbk 或 utf-8
            'input_charset' => strtolower('utf-8'),
            //ca证书路径地址，用于curl中ssl校验
            //请保证cacert.pem文件在当前文件夹目录中
            'cacert'    => getcwd().'\\cacert.pem',

            //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
            'transport'    => 'http',

        );

        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //订单时间
            $time =  $_GET['notify_time'];

            //交易状态
            $trade_status = $_POST['trade_status'];

            //用户uid
            $buyer_uid   = $_POST['buyer_uid'];

            //金额
            $money = $_POST['total_fee'];
            //等待付款
            if($trade_status == 'WAIT_BUYER_PAY') {

                M('user_recharge')->where(array('acct_order' => $out_trade_no))->setField('acct_status', 2);

            }
            //支付成功
            else if ($trade_status == 'TRADE_SUCCESS') {

                $Recharge = new UserRechargeModel();
                $where = array('acct_order' => $out_trade_no);
                $result = $Recharge->getRechargeInfo($where)->find();

                if ($result) {
                    $user_id = $result['user_id'];
                    $oldTotalMoney = M('user_account')->where(array('user_id' => $user_id))->getField('gold_coin');

                    $data['order'] = $out_trade_no;
                    $data['money'] = $money;
                    $data['user_id'] = $buyer_uid;
                    $data['time'] = $time;
                    // $data['tran_remark'] = '充值';
                    $data['method'] = 1;
                    $data['method_status'] = 1;
                    $data['ip'] = get_client_ip();
                    $data['over'] = 1;

                    $mod = M('user_consume');
                    $mod->data($data)->add();

                    $nowTotalMoney = $money + $oldTotalMoney;

                    $update['gold_coin'] = $nowTotalMoney;

                    M('user_account')->where(array('user_id' => $user_id))->save($update);
                    M('user_recharge')->where(array('acct_order' => $out_trade_no))->setField('acct_status', 3);
                }

                }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            echo "success";     //请不要修改或删除

        }
        else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    /**
     * 支付宝同步通知
     */
    public function Ali_returnurl(){
        //获取配置
        $config=M('sys_config');
        $ali_id=$config-> getFieldByName('Ali_pay_id','value');
        $ali_key=$config-> getFieldByName('Ali_pay_key','value');
        $ali_email=$config-> getFieldByName('Ali_pay_acc','value');
        //支付宝配置参数
        $alipay_config = array(
            'partner'		=> $ali_id,
            //收款支付宝账号
            'seller_email'	=> $ali_email,
            //安全检验码，以数字和字母组成的32位字符
            'key'		=> $ali_key,
            //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

            //签名方式 不需修改
            'sign_type'   => strtoupper('MD5'),
            //字符编码格式 目前支持 gbk 或 utf-8
            'input_charset' => strtolower('utf-8'),
            //ca证书路径地址，用于curl中ssl校验
            //请保证cacert.pem文件在当前文件夹目录中
            'cacert'    => getcwd().'\\cacert.pem',

            //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
            'transport'    => 'http',

        );

        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {

             $trade_status = $_GET['trade_status'];

            if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {

             $this->success('交易完成',U('Service/Close'));

            }else {
                echo "trade_status=".$_GET['trade_status'];
            }

        }else {

            echo "验证失败";
        }

    }

    /**
     * 微信支付异步通知
     */
    public function WeChat_notifyurl(){
        //支付配置
        $config=M('sys_config');
        $WeChat_pay_id=$config-> getFieldByName('WeChat_pay_id','value');
        $WeChat_pay_key=$config-> getFieldByName('WeChat_pay_key','value');
        $WeChat_pay_acc=$config-> getFieldByName('WeChat_pay_acc','value');

        //设置
        WxPayConfig::$APPID  = $WeChat_pay_id;
        WxPayConfig::$MCHID = $WeChat_pay_acc;
        WxPayConfig::$KEY = $WeChat_pay_key;

        Log::write("begin notify",Log::INFO);
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);

    }



}
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once $_SERVER['DOCUMENT_ROOT']."\ThinkPHP\Extend\Vendor\WxpayAPI\lib\WxPay.Api.php";
require_once $_SERVER['DOCUMENT_ROOT']."\ThinkPHP\Extend\Vendor\WxpayAPI\lib\WxPay.Notify.php";

class PayNotifyCallBack extends WxPayNotify
{

    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        Log::Write("query:" . json_encode($result,Log::INFO));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
         Log::Write("call back:" . json_encode($data),Log::INFO);
        $notfiyOutput = array();

        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }else{
            //回调信息写入数据库
            $Rec = M('user_consume');
            $order = $data['out_trade_no'];
            $where_data = array('acct_order'=>$order,'user_id'=>cookie('user_id'));

            $info = $Rec->where($where_data)->find();
            $data = array(
                'ip'=>get_client_ip(),
                'acct_status'=>'3',
                'acct_time'=>date("Y-m-d H:i:s")
            );
            $result_d = $Rec->where($where_data)->save($data);
            if($result_d){

                $Con = M('user_consume');
                $data_c = array(
                    'order'=>$order,
                    'user_id'=>cookie('user_id'),
                    'time'=>date("Y-m-d H:i:s"),
                    'model_type'=>'微信支付',
                    'money'=>$info['acct_money'],
                    'method_status'=>'1',
                    'method'=>'1',
                    'ip'=>get_client_ip(),
                    'over'=>'2',
                );

               $result_c =  $Con ->data($data_c)->add();
               if($result_c){
                   $Chat = M('chat');

                   $data_chat = array(
                       'user_id'=>cookie('user_id'),
                       'chat_state'=>'1',
                       'chat_title'=>'微信充值',
                       'chat_content'=>'你的充值额为：'.$info['acct_money'].'元的订单已处理',
                       'chat_time'=>date('Y-m-d H:i:s'),
                       'chat_form'=>'0'
                   );
                   $Chat->data($data_chat);
               }
            }
        }

        return true;
    }
}

