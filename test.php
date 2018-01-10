<?php
	require_once 'init.inc.php';

	$vc = new ValidateCode();

	echo $vc->dovImg();

	//echo mt_rand(0,3);
?>