<?php
class  WeChat
{

    public $APPID;
    public $APPSECRET;
    public $CALLBACK;
    public $CODE;
    public $LANG = 'zh_CN';
    public $OPENID;
    public $ACCESS_TOKEN;

    /**
     * 用户同意授权，获取code
     */
    public function getCode()
    {
        $APPID = $this->APPID;
        $CALLBACK = $this->CALLBACK;
        header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$APPID."&redirect_uri=".$CALLBACK."&response_type=code&scope=snsapi_userinfo&a#wechat_redirect");
    }

    /**
     * 通过code换取网页授权access_token
     */
    public function getAccessToken()
    {
        $APPID = $this->APPID;
        $APPSECRET = $this->APPSECRET;
        $CODE = $this->CODE;
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $APPID . '&secret=' . $APPSECRET . '&code=' . $CODE . '&grant_type=authorization_code';
       // var_dump($url);
        $array = $this->getContent($url);
        //var_dump($array.'getToken');
        return $array;
    }

    /**
     * 刷新access_token（如果需要）
     */
    public function updateAccessToken($appid, $refresh_token)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=' . $appid . '&grant_type=refresh_token&refresh_token=' . $refresh_token;
        $array = $this->getContent($url);
        return $array;
    }

    /**
     *检验授权凭证（access_token）是否有效 bool
     */
    public function tokenIsValid($access_token, $openid)
    {
        $url = 'https://api.weixin.qq.com/sns/auth?access_token=' . $access_token . '&openid=' . $openid;
        $array = $this->getContent($url);
        if ($array['errcode'] == 0) {
            return true;
        } else if ($array['errcode'] == 40003) {
            return false;
        }
    }

    /**
     *    拉取用户信息(需scope为 snsapi_userinfo) Json
     */
    public function getWXUsersInfo( )
    {

        $ACCESS_TOKEN = $this->ACCESS_TOKEN;
        $OPENID = $this->OPENID;
        $LANG = $this->LANG;

        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $ACCESS_TOKEN . '&openid=' . $OPENID . '&lang=' . $LANG;
        $array = $this->getContent($url);
        return $array;
    }

    /**
     *    解析url地址 返回请求数据
     */
    public function getContent($url)
    {
       // var_dump($url.'getContent');

        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
        } else {
            $agent = '';
        }

        if(isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
        } else {
            $referer = '';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT,1);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_REFERER,$referer);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        //curl_setopt($ch, CURLOPT_POST, 1); //启用POST提交
        $file_contents = curl_exec($ch);

        //var_dump($file_contents.'getContent');
        curl_close($ch);
        $array = json_decode($file_contents, true);
        return $array;
    }
}
    