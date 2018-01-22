<?php
	require_once 'init.inc.php';
	require_once 'config/code.php';
	$vc = new ValidateCode();

	$vc->dovImg();
	echo $_SESSION['code'];
	//echo mt_rand(0,3);

?>