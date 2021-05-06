<?php
//加载公共配置文件


$ConfigAdmin = array(

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
	'__CS__' => __ROOT__.'/Public/admin/css', // 增加新的css类库路径替换规则
	'__JS__' =>  __ROOT__.'/Public/admin/js', // 增加新的JS类库路径替换规则
	'__IMG__' =>  __ROOT__.'/Public/admin/images', // 增加新的JS类库路径替换规则
    '__TOOL__'=> __ROOT__.'ThinkPHP/Extend/Tool',//工具类库
	'__UPLOAD__' => __ROOT__.'/Uploads', // 增加新的上传路径替换规则
	// '--PUBLIC--' => '__PUBLIC__', // 采用新规则输出__PUBLIC__字符串
	),

	//模块简化
	//'TMPL_FILE_DEPR'	=>	'_',

	// 	/* 缓存设置 */
	// 'DB_FIELDS_CACHE'=>false, // false不缓存
	
	// 设置默认时区
	'DEFAULT_TIMEZONE'		=>'PRC',


	'payDebug'=>true,//是否支付测试
);
    return $ConfigAdmin ;
?>