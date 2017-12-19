<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
require ROOT_PATH.'/model/manage.class.php';
global $_tpl;
$_tpl->assign('list',false);
$_tpl->assign('add',false);
$_tpl->assign('update',false);
$_tpl->assign('delete',false);


//业务流程控制 操作界面显示
@$r_result = $_GET['action'];
switch ($r_result) 
{
	case 'list':
		$_tpl->assign('list',true);
		$_tpl->assign('title','管理员列表');
	break;

	case 'add':
		$_tpl->assign('add',true);
		$_tpl->assign('title','添加管理员');
	break;

	case 'update':
		$_tpl->assign('update',true);
		$_tpl->assign('title','修改管理员');
	break;
	
	case 'delete':
		$_tpl->assign('delete',true);
		$_tpl->assign('title','删除管理员');
	break;

	default:
		$_tpl->assign('list',true);
		$_tpl->assign('title','管理员列表');
	break;
}




//查询数据
$_manage = new Manage();
$arr = $_manage->getManages();

//在manage.tpl模板中 注入变量
$_tpl->assign('AllManage',$arr);
$_tpl->display('manage.tpl');


?>