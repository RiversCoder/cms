<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
global $_tpl;

//验证非法登录
//Validate::checkSession();

//查询数据 操作数据等 
new LevelAction($_tpl);

?>