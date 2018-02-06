<?php
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;

	//echo isset($_SESSION['admin']);

	//验证非法登录
	Validate::checkSession();

	$_tpl->display('admin.tpl');
?>