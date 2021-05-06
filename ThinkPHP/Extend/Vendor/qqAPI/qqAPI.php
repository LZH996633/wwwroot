<?php

/**

 * QQ开发平台 SDK

 * 作者：偶尔陶醉

 * blog: www.stuppt20tu.com

 */



class Qq_sdk{



//配置APP参数

static $app_id;

static $app_secret;

static $redirect ;



function __construct()

{



}



/**

 * [get_access_token 获取access_token]

 * @param [string] $code [登陆后返回的$_GET['code']]

 * @return [array] [expires_in 为有效时间 , access_token 为授权码 ; 失败返回 error , error_description ]

 */

function get_access_token($code)

{
//echo $code;
//获取access_token

    $token_url = 'https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id='.$this::$app_id .'&redirect_uri='.$this::$redirect//回调地址

. '&client_secret=' . $this::$app_secret . '&code=' . $code;

  //echo $token_url;
$token = array();

//expires_in 为access_token 有效时间增量

parse_str($this->_curl_get_content($token_url), $token);

//var_dump($token);

return $token;

}



/**

 * [get_open_id 获取用户唯一ID，openid]

 * @param [string] $token [授权码]

 * @return [array] [成功返回client_id 和 openid ;失败返回error 和 error_msg]

 */

function get_open_id($token)

{

    $str = $this->_curl_get_content('https://graph.qq.com/oauth2.0/me?access_token=' . $token);

if (strpos($str, "callback") !== false)

{

$lpos = strpos($str, "(");

$rpos = strrpos($str, ")");

$str = substr($str, $lpos + 1, $rpos -$lpos -1);

}

$user = json_decode($str, TRUE);



return $user;

}



/**

 * [get_user_info 获取用户信息]

 * @param [string] $token [授权码]

 * @param [string] $open_id [用户唯一ID]

 * @return [array] [ret：返回码，为0时成功。msg为错误信息,正确返回时为空。...params]

 */

function get_user_info($token, $open_id)

{



//组装URL

    $user_info_url = 'https://graph.qq.com/user/get_user_info?access_token='.$token.'&oauth_consumer_key=' . $this::$app_id . '&openid=' . $open_id

. '&format=json';



$info = json_decode($this->_curl_get_content($user_info_url), TRUE);



return $info;

}



private function _curl_get_content($url)

{
    //初始化cURL对象
  $ch = curl_init();
   //设置需要抓取的url
   curl_setopt($ch, CURLOPT_URL, $url);
   //设置保存到字符串还是输出到屏幕上
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   //设置超时时间为3s
   curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3);
    //关键代码  ： 跳过SSL证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //运行cURL请求网页
    $result = curl_exec($ch) ;

    //var_dump(curl_error($ch));  错误检查
    //关闭cURL请求
    curl_close($ch);
    //echo($result);echo "<br>";

    return $result;

}



}



/* end of Qq_sdk.php */





//使用方法：在你网站上放置超链接，地址为：https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=你的APP_ID&redirect_uri=你的回调地址

//在回调地址上调用我上面这个qq_sdk即可。

//demo如下：

 //代码如下	复制代码





