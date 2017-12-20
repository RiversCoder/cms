<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
require ROOT_PATH.'/action/Action.class.php';
require ROOT_PATH.'/action/ManageAction.class.php';
require ROOT_PATH.'/model/Model.class.php';
require ROOT_PATH.'/model/manage.class.php';
global $_tpl;



//查询数据 操作数据等 
new ManageAction($_tpl);

?>