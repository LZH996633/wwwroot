<?php
//Load public templates

$ConfigHome  = array(
	//'Configuration item'=>'Configuration value'
	/*Connect to the database configuration*/
	// 'DB_TYPE'	=>	'mysql',
	// 'DB_HOST'	=>	'localhost',
	// 'DB_NAME'	=>	'chameleon',
	// 'DB_USER'	=>	'root',
	// 'DB_PWD'	=>	'',
	// 'DB_PORT'	=>	'3306',
	// 'DB_PREFIX'	=>	'sj_t_',
	'DB_TYPE'	=>	'mysql',
	'DB_HOST'	=>	'localhost',
	'DB_NAME'	=>	'material',
	'DB_USER'	=>	'root',
	'DB_PWD'	=>	'root',
	'DB_PORT'	=>	'8306',
	'DB_PREFIX'	=>	'sj_t_',
	/* URL settings */
    'URL_CASE_INSENSITIVE'  => true,   // The default false means that the URL is case-sensitive true is case-insensitive
	// 'URL_MODEL'          => '0',

    //URL Pseudo-static
    // 'URL_HTML_SUFFIX'       =>'shtml|pdd|ms|ok',// Multiple use | split

	/* Template replacement */
	'TMPL_PARSE_STRING'  =>array(
	// '__PUBLIC__' => '/Common', // Change the default __PUBLIC__ replacement rule
	'__CS__' => __ROOT__.'/Public/css', // Add new css class library path replacement rules
	'__JS__' =>  __ROOT__.'/Public/js', // Add new JS class library path replacement rules
	'__IMG__' =>  __ROOT__.'/Public/images', // Add new path replacement rules for image library
	'__UPLOAD__' => __ROOT__.'/Uploads', // Add new upload path replacement rules
	// '--PUBLIC--' => '__PUBLIC__', // Use new rules to output __PUBLIC__ strings
	),

	//Template engine think/php/Smarty
	// 'TMPL_ENGINE_TYPE' =>'think', //think/PHP/Smarty

	// 	/* Cache settings */
	// 'DB_FIELDS_CACHE'=>false, // false do not cache

	//'APP_AUTOLOAD_PATH'=>'@.Behavior',
 
	//Default controller
	//'DEFAULT_MODULE'       => 'test',
	//默认方法
	//'DEFAULT_ACTION'       => 'test',
	
	// Set default time zone
	'DEFAULT_TIMEZONE'		=>'PRC',

	//Load other configuration files. Conf directory
	//'LOAD_EXT_CONFIG'=>'ex,ab,c',

	//Load the custom function file. Common directory
	//"LOAD_EXT_FILE"=>"user2,db1",

	//Show running track. After using the template, the bottom right corner of the page
    'SHOW_PAGE_TRACE'=>TRUE,

	//'EXTEND_GROUP_LIST'=>array(
	//	'Home'=>'Home',
	//	'Admin'=>'Admin',
	//),

	//Module simplification
	//'TMPL_FILE_DEPR'	=>	'_'

	/* 
	Set the default template theme name
	The template location is: the template directory in the configuration file (if not defined, the default tpl directory) / theme directory / controller class name directory / controller external method name file
	*/
	'DEFAULT_THEME'         => 'mall',

	//Custom file location
	// 'TMPL_FILE_DEPR'        =>  '_', 

	//Custom suffix, different from pseudo-static
	// 'TMPL_TEMPLATE_SUFFIX'  => '.xyz',


	// Maximum number of nested loops
	'TAG_NESTED_LEVEL' => '5',

	//Gold coin to RMB ratio
	'MONEY_TO_POINT' =>1,

	//Minimum withdrawal amount
	// 'MIN_MONEY' =>100,

	//Whether to automatically open the session
    //'SESSION_AUTO_START'=>true,

	//The template file corresponding to the default error jump
	//'TMPL_ACTION_ERROR'     => THINK_PATH.'Tpl/dispatch_jump.tpl',

	//// Successfully jump to the corresponding template file by default
    //'TMPL_ACTION_SUCCESS'   => THINK_PATH.'Tpl/dispatch_jump.tpl', 

	//Template file for exception page
    //'TMPL_EXCEPTION_FILE'   => THINK_PATH.'Tpl/think_exception.tpl',
	

	//'payDebug'=>true,//Whether to pay for the test


        
  //  'alipay'   =>array(
    //Here is the asynchronous notification page url, submitted to the notifyurl method of the Pay controller of the project;
  //  'notify_url'=>'htttp://www.looksucai.com/index.php?m=Pay&a=notifyurl', 
    //Here is the page jump notification url, which is submitted to the returnurl method of the Pay controller of the project;
  //  'return_url'=>'htttp://www.looksucai.com/index.php?m=Pay&a=returnurl',
    //The page to which the payment is successful, I jump to the User controller of the project, myorder method, and pass the parameter paid (paid list)
  //  'successpage'=>'User/myorder?ordtype=payed',   
    //The page to which the payment fails, I jump to the User controller of the project, myorder method, and pass the parameter unpay (unpaid list)
  //  'errorpage'=>'User/myorder?ordtype=unpay', 
  //  ),


	/*//Mail configuration
    'THINK_EMAIL' => array(

       'SMTP_HOST'   => 'smtp.163.com', //SMTP server

       'SMTP_PORT'   => '465', //SMTP server port

       'SMTP_USER'   => '13721059073@163.com', //SMTP server user name

       'SMTP_PASS'   => 'feng687881', //SMTP server password

       'FROM_EMAIL'  => '13721059073@163.com', //Sender EMAIL

       'FROM_NAME'   => 'feng', //Sender name

       'REPLY_EMAIL' => '', //Reply to EMAIL (leave blank for sender EMAIL)

       'REPLY_NAME'  => '', //Reply name (leave blank for sender name)

    ),*/
	'MAIL_ADDRESS'=>'hndajiawang@163.com', // email address
//	'MAIL_ADDRESS'=>'13721059073@163.com', // email address

	'MAIL_SMTP'=>'220.181.12.18', // Mailbox SMTP server

	'MAIL_LOGINNAME'=>'hndajiawang@163.com', // Email login account
//	'MAIL_LOGINNAME'=>'13721059073@163.com', // Email login account

	'MAIL_PASSWORD'=>'Hndjw8898', // email Password
//	'MAIL_PASSWORD'=>'feng687881', // email Password

	//QQ login configuration
	'QQ_AUTH' => array(

	'APP_ID'  => '101248581', //Your QQ Internet APPID

	'APP_KEY' => '9ffd569d936595b8e9d7efa5a957ca22',

	'SCOPE'   => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',

	'CALLBACK' => 'http://www.baidu.com/user/oauth/callback/type/qq.html',
	),








'alipay_config'=>array(
        'partner'        => '*****',  //Here is the PID you obtained after successfully applying for the Alipay interface；
        //Receiving Alipay account, under normal circumstances the receiving account is the signed account
        'seller_id'    => '*****',  
        //Security check code, 32 characters composed of numbers and letters
        'key'            => '***',    //Here is the Key you obtained after successfully applying for the Alipay interface
        //No need to modify the signature method
        //Here is the asynchronous notification page url, submitted to the notifyurl method of the Pay controller of the project;
        'notify_url'=>'http://update.my/index.php/Home/Pay/notifyurl.html',
        //Here is the page jump notification url, which is submitted to the returnurl method of the Pay controller of the project;
        'return_url'=>'http://update.my/index.php/Home/Pay/returnurl.html',
        'sign_type'    => strtoupper('MD5'),
        //Character encoding format currently supports gbk or utf-8
        'input_charset'=> strtolower('utf-8'),
        //CA certification path address, used for ssl verification in curl
        //Please ensure that the cacert.pem file is in the current folder directory
        'cacert'    => VENDOR_PATH.'Alipay/cacert.pem',
        //Access mode, according to whether your server supports ssl access, if it supports, please select https; if not, please select http
        'transport'    => 'http',
        // Payment type, no need to modify
        'payment_type' => "1",
        // Product type, no need to modify
        'service' => "create_direct_pay_by_user",
        //↑↑↑↑↑↑↑↑↑↑Please configure basic information here↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        // Anti-phishing timestamp To use, please call the query_timestamp function in the class file submit
        'anti_phishing_key' => "",
        'exter_invoke_ip' => "",
    ),
        
    //The above configuration items are copied from the alipay.config.php file in the interface package for configuration;
    'alipay' =>array(

 

        //The page to which the payment is successful, I jump to the User controller of the project, myorder method, and pass the parameter paid (paid list)
        'successpage'=>'/index.php/',
        //The page to which the payment fails, I jump to the User controller of the project, myorder method, and pass the parameter unpay (unpaid list)
        'errorpage'=>'/index.php/Home/Test',
    ),













);

return $ConfigHome;

?>