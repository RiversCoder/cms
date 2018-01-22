<?php
	require_once substr(dirname(__FILE__),0,-6).'init.inc.php';
	$vc = new ValidateCode();
	$vc->dovImg();

	//设置session 
	$_SESSION['code'] = $vc->vchar;
	
?>