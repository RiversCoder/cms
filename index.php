<?php

require dirname(__FILE__).'/init.inc.php';
global $_tpl;
$_tpl->assign('title','大标头');
$_tpl->display('index.tpl');

?>