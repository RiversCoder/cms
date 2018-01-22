<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
global $_tpl;

$_tpl->display('admin_login.tpl');

//接收session 
echo $_SESSION['code'];

?>