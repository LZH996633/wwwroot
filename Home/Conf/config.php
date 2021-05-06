<?php
//加载公共模板

$ConfigHome  = array(
	//'配置项'=>'配置值'
	/*连接数据库配置*/
	// 'DB_TYPE'	=>	'mysql',
	// 'DB_HOST'	=>	'localhost',
	// 'DB_NAME'	=>	'chameleon',
	// 'DB_USER'	=>	'root',
	// 'DB_PWD'	=>	'',
	// 'DB_PORT'	=>	'3306',
	// 'DB_PREFIX'	=>	'sj_t_',
	'DB_TYPE'	=>	'mysql',
	'DB_HOST'	=>	'localhost',
	'DB_NAME'	=>	'sucai',
	'DB_USER'	=>	'root',
	'DB_PWD'	=>	'root',
	'DB_PORT'	=>	'3306',
	'DB_PREFIX'	=>	'sj_t_',
	/* URL设置 */
    'URL_CASE_INSENSITIVE'  => true,   // 默认false 表示URL区分大小写 true不区分大小写
	// 'URL_MODEL'          => '0',

    //URL 伪静态
    // 'URL_HTML_SUFFIX'       =>'shtml|pdd|ms|ok',// 多个用 | 分割

	/* 模板替换 */
	'TMPL_PARSE_STRING'  =>array(
	// '__PUBLIC__' => '/Common', // 更改默认的__PUBLIC__ 替换规则
	'__CS__' => __ROOT__.'/Public/css', // 增加新的css类库路径替换规则
	'__JS__' =>  __ROOT__.'/Public/js', // 增加新的JS类库路径替换规则
	'__IMG__' =>  __ROOT__.'/Public/images', // 增加新的图片类库路径替换规则
	'__UPLOAD__' => __ROOT__.'/Uploads', // 增加新的上传路径替换规则
	// '--PUBLIC--' => '__PUBLIC__', // 采用新规则输出__PUBLIC__字符串
	),

	//模板引擎 think/php/Smarty
	// 'TMPL_ENGINE_TYPE' =>'think', //think/PHP/Smarty

	// 	/* 缓存设置 */
	// 'DB_FIELDS_CACHE'=>false, // false不缓存

	//'APP_AUTOLOAD_PATH'=>'@.Behavior',
 
	//默认控制器
	//'DEFAULT_MODULE'       => 'test',
	//默认方法
	//'DEFAULT_ACTION'       => 'test',
	
	// 设置默认时区
	'DEFAULT_TIMEZONE'		=>'PRC',

	//载入其他配置文件。Conf目录下
	//'LOAD_EXT_CONFIG'=>'ex,ab,c',

	//载入自定义函数文件。Common目录下
	//"LOAD_EXT_FILE"=>"user2,db1",

	//显示运行轨迹。在使用模板后，页面右下角
    'SHOW_PAGE_TRACE'=>TRUE,

	//'EXTEND_GROUP_LIST'=>array(
	//	'Home'=>'Home',
	//	'Admin'=>'Admin',
	//),

	//模块简化
	//'TMPL_FILE_DEPR'	=>	'_'

	/* 
	设置默认的模板主题名 
	模板位置为：配置文件中的模板目录(如果没有定义，则默认 tpl 目录 ) / 主题目录 / 控制器类名目录 / 控制器对外方法名文件
	*/
	'DEFAULT_THEME'         => 'mall',

	//自定义文件位置
	// 'TMPL_FILE_DEPR'        =>  '_', 

	//自定义后缀,与伪静态区别
	// 'TMPL_TEMPLATE_SUFFIX'  => '.xyz',


	// 嵌套循环最大次数
	'TAG_NESTED_LEVEL' => '5',

	//金币与人民币比率
	'MONEY_TO_POINT' =>1,

	//最少提取金额[锭]
	// 'MIN_MONEY' =>100,

	//是否自动打开session	
    //'SESSION_AUTO_START'=>true,

	//默认错误跳转对应的模板文件
	//'TMPL_ACTION_ERROR'     => THINK_PATH.'Tpl/dispatch_jump.tpl',

	//// 默认成功跳转对应的模板文件
    //'TMPL_ACTION_SUCCESS'   => THINK_PATH.'Tpl/dispatch_jump.tpl', 

	//异常页面的模板文件
    //'TMPL_EXCEPTION_FILE'   => THINK_PATH.'Tpl/think_exception.tpl',
	

	//'payDebug'=>true,//是否支付测试


        
  //  'alipay'   =>array(
    //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
  //  'notify_url'=>'htttp://www.looksucai.com/index.php?m=Pay&a=notifyurl', 
    //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
  //  'return_url'=>'htttp://www.looksucai.com/index.php?m=Pay&a=returnurl',
    //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
  //  'successpage'=>'User/myorder?ordtype=payed',   
    //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
  //  'errorpage'=>'User/myorder?ordtype=unpay', 
  //  ),


	/*//邮件配置
    'THINK_EMAIL' => array(

       'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器

       'SMTP_PORT'   => '465', //SMTP服务器端口

       'SMTP_USER'   => '13721059073@163.com', //SMTP服务器用户名

       'SMTP_PASS'   => 'feng687881', //SMTP服务器密码

       'FROM_EMAIL'  => '13721059073@163.com', //发件人EMAIL

       'FROM_NAME'   => 'feng', //发件人名称

       'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）

       'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）

    ),*/
	'MAIL_ADDRESS'=>'hndajiawang@163.com', // 邮箱地址
//	'MAIL_ADDRESS'=>'13721059073@163.com', // 邮箱地址

	'MAIL_SMTP'=>'220.181.12.18', // 邮箱SMTP服务器

	'MAIL_LOGINNAME'=>'hndajiawang@163.com', // 邮箱登录帐号
//	'MAIL_LOGINNAME'=>'13721059073@163.com', // 邮箱登录帐号	

	'MAIL_PASSWORD'=>'Hndjw8898', // 邮箱密码
//	'MAIL_PASSWORD'=>'feng687881', // 邮箱密码

	//qq登陆配置
	'QQ_AUTH' => array(

	'APP_ID'  => '101248581', //你的QQ互联APPID

	'APP_KEY' => '9ffd569d936595b8e9d7efa5a957ca22',

	'SCOPE'   => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',

	'CALLBACK' => 'http://www.baidu.com/user/oauth/callback/type/qq.html',
	),








'alipay_config'=>array(
        'partner'        => '*****',  //这里是你在成功申请支付宝接口后获取到的PID；
        //收款支付宝账号，一般情况下收款账号就是签约账号
        'seller_id'    => '*****',  
        //安全检验码，以数字和字母组成的32位字符
        'key'            => '***',    //这里是你在成功申请支付宝接口后获取到的Key
        //签名方式 不需修改
        //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
        'notify_url'=>'http://update.my/index.php/Home/Pay/notifyurl.html',
        //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
        'return_url'=>'http://update.my/index.php/Home/Pay/returnurl.html',
        'sign_type'    => strtoupper('MD5'),
        //字符编码格式 目前支持 gbk 或 utf-8
        'input_charset'=> strtolower('utf-8'),
        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        'cacert'    => VENDOR_PATH.'Alipay/cacert.pem',
        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'transport'    => 'http',
        // 支付类型 ，无需修改
        'payment_type' => "1",
        // 产品类型，无需修改
        'service' => "create_direct_pay_by_user",
        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
        'anti_phishing_key' => "",
        'exter_invoke_ip' => "",
    ),
        
    //以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
    'alipay' =>array(

 

        //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
        'successpage'=>'/index.php/',
        //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
        'errorpage'=>'/index.php/Home/Test',
    ),













);

return $ConfigHome;

?>