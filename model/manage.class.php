<?php
	/**
	*  Manage 管理员实体类 : manage.php 数据层的所有操作
	*/
	class Manage
	{
		
		private	$tpl;
		private $admin_user;
		private $admin_pas;
		private $level;
		private $id;

		//构造方法
		public function __construct(&$tpl)
		{
			$this->tpl = $tpl;
			$this->doAction();
		}

		//管理员操作
		private function doAction()
		{	
			$this->tpl->assign('list',false);
			$this->tpl->assign('add',false);
			$this->tpl->assign('update',false);
			$this->tpl->assign('delete',false);

			//业务流程控制 操作界面显示
			@$r_result = $_GET['action'];

			switch ($r_result) 
			{
				case 'list':
					$this->tpl->assign('list',true);
					$this->tpl->assign('title','管理员列表');
				break;

				case 'add':
					
					//检测当前页面是否发出POST请求 并且检测$_POST['add']是否存在	
					if(isset($_POST['add']))
					{	
						//获取数据
						$this->admin_user = $_POST['admin_user'];
						$this->admin_pas = md5($_POST['admin_pass']);
						$this->level = $_POST['level'];

						//执行添加操作
						$getResult = $this->addManage();
						$this->alertInfo($getResult,$this->alertInfos()['add']);	
					}

					$this->tpl->assign('add',true);
					$this->tpl->assign('title','添加管理员');
				break;

				case 'update':
					
					//1. 获取id
					if(!isset($_GET['id']) || !is_numeric($_GET['id']))
					{
						Tool::alertBack('修改错误!');
					}


					//3. 查询当前要修改的数据 -> 需要获取当前页面的ID值
					$this->id = $_GET['id'];
					$current = $this->selectCurrent();

					//4.检测当前页面是否发出POST请求 并且是否能接收到$_POST['update']值
					if(isset($_POST['update']))
					{	
						//执行修改操作
						$getResult = $this->upadteManage();
						//弹窗设置
						$this->alertInfo($getResult,$this->alertInfos()['update']);	
					}	

					//2. 渲染页面 注入变量
					$this->tpl->assign('update',true);
					$this->tpl->assign('title','修改管理员');

				break;
				
				case 'delete':
					
					//1. 获取id
					if(!isset($_GET['id']) || !is_numeric($_GET['id']))
					{
						Tool::alertBack('删除错误!');
					}

					//3. 删除操作
					$this->id = $_GET['id'];
					$getResult = $this->deleteManage();
					$this->alertInfo($getResult,$this->alertInfos()['delete']);	
						
					//2. 渲染页面 
					$this->tpl->assign('delete',true);
					$this->tpl->assign('title','删除管理员');
				break;

				default:
					$this->tpl->assign('list',true);
					$this->tpl->assign('title','管理员列表');
				break;
			}

			//获取列表数据
			$arr = $this->getManages();

			//在manage.tpl模板中 注入变量
			$this->tpl->assign('AllManage',$arr);
			$this->tpl->display('manage.tpl');
		}	


		//查询所有管理员
		public function getManages()
		{	
			//连接数据库 返回连接资源句柄
			$_db = DB::getDB();
			
			//sql
			$_sql = 'SELECT 
						m.id,m.admin_user,m.level,m.login_count,m.last_ip,m.last_time,l.level_name 
					FROM 
						cms_manage m,cms_level l
					WHERE
						m.level = l.level 	 
					ORDER BY 
						m.id ASC
					LIMIT 
						0,20';

			//获取结果集
			$_result = $_db->query($_sql);

			//创建返回函数
			$_html = array();

			//打印出所有数据
			while(!! $obj = $_result->fetch_object())
			{
				$_html[] = $obj;
			}

			//清除数据库连接
			DB::unDB($_result, $_db);

			//返回查询数据
			return $_html;
		}


		//新增管理员
		public function addManage()
		{
			//获取数据库连接
			$mysqli = DB::getDB();

			//新增管理员sql语句
			$sql = "INSERT INTO cms_manage (admin_user,admin_pas,level,reg_time) VALUES ('{$this->admin_user}','{$this->admin_pas}',{$this->level},now())";

			//执行sql语句
			$mysqli->query($sql);

			//执行情况 大于0 属于执行成功 小于等于0 属于执行失败 
			$affectd_rows = $mysqli->affected_rows;

			//清理结果集和数据库连接
			@DB::unDB($result=null,$mysqli);

			return $affectd_rows;
		}

		//查询当前ID的管理员数据
		public function selectCurrent()
		{
			//获取数据库连接
			$mysqli = DB::getDB();
			//获取数据的ID
			$this->id = $_GET['id'];

			//1. 查询当前ID对应的数据,注入manage.tpl模板中
			$sql_select =  "SELECT admin_user,level FROM cms_manage WHERE id = {$this->id}";
			$result = $mysqli->query($sql_select);
			$obj = $result->fetch_object();

			//注入变量
			$this->tpl->assign('update_admin_user',$obj->admin_user);
			$this->tpl->assign('update_level',$obj->level);

			//清楚数据库连接
			DB::unDB($result,$mysqli);

			return $obj;
		}

		//修改管理员
		public function upadteManage()
		{	
			$mysqli = DB::getDB();

			$this->admin_user = $_POST['admin_user'];
			$this->admin_pas = $_POST['admin_pass'];
			$this->level = $_POST['level'];

			$sql_update = "UPDATE cms_manage SET admin_user='{$this->admin_user}',admin_pas='{$this->admin_pas}',level={$this->level} WHERE id = {$this->id}";
			$result = $mysqli->query($sql_update);
			$getResult = $mysqli->affected_rows;
			
			DB::unDB($result,$mysqli);

			return $getResult;
		}


		//删除管理员
		public function deleteManage()
		{
			//获取id成功
			$mysqli = DB::getDB();
			
			$sql = "DELETE FROM cms_manage WHERE id = {$this->id}";
			$result = $mysqli->query($sql);
			$getResult = $mysqli->affected_rows;
			DB::unDB($result,$mysqli);

			return  $getResult;
		}

		//弹出信息窗口
		private function alertInfo($checkResult,$info)
		{
			if($checkResult > 0)
			{
				Tool::alertLocation($info['success'],'?action=list');
			}
			else
			{
				Tool::alertBack($info['error']);
			}
		}

		private function alertInfos()
		{
			$arr = array();
			$arr['update'] = Array('success'=>'修改成功','error'=>'修改失败');
			$arr['add'] = Array('success'=>'添加成功','error'=>'添加失败');
			$arr['delete'] = Array('success'=>'删除成功','error'=>'删除失败');
			
			return $arr;
		}
	}
?>