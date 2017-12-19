<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
require ROOT_PATH.'/model/manage.class.php';
global $_tpl;



//查询数据 操作数据等 
new Manage($_tpl);

?>