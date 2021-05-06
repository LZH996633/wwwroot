<?php
// ThinkPHP 入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Admin/'); //定义项目路径
define('APP_NAME', 'Admin');//定义项目名称
// define('TMPL_PATH', './tpl/');//项目模板目录 

// // 自定义缓存
// define('RUNTIME_PATH','./App/temp/');// 自定义编译缓存目录
// define('RUNTIME_FILE','./App/temp/runtime_cache.php');// 自定义编译缓存文件名

// 引入ThinkPHP框架入口文件
require './ThinkPHP/ThinkPHP.php';