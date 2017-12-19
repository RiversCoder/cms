<?php
//设置utf-8编码
header('Content-Type:text/html;charset=utf-8');
//网站根目录
define('ROOT_PATH',dirname(__FILE__));
//引入配置信息
require ROOT_PATH.'/config/profile.inc.php';
//引入模板类
require ROOT_PATH.'/includes/Templates.class.php';
//引入数据库
require ROOT_PATH.'/includes/DB.class.php';
//缓存机制
require 'cache.inc.php';
//清除未定义变量报错
//error_reporting(E_ALL & ~E_NOTICE);

//实例化模板类
$_tpl = new Templates();
?>