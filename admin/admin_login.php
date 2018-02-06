<?php
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;

	if(!!isset($_SESSION['admin'])){
		Tool::alertLocation(null,'admin.php');
	}

	$_tpl->display('admin_login.tpl');

?>