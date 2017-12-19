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
					
					if(isset($_POST['add']))
					{	
						//获取数据
						$this->admin_user = $_POST['admin_user'];
						$this->admin_pas = md5($_POST['admin_pass']);
						$this->level = $_POST['level'];

						//执行添加操作
						$getResult = $this->addManage();

						if($getResult > 0)
						{
							Tool::alertLocation('添加成功!','?action=list');
						}
						else
						{
							Tool::alertLocation('添加失败，请返回重新添加');
						}
					}

					$this->tpl->assign('add',true);
					$this->tpl->assign('title','添加管理员');
				break;

				case 'update':
					$this->tpl->assign('update',true);
					$this->tpl->assign('title','修改管理员');
				break;
				
				case 'delete':
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


		//修改管理员
		public function upadteManage()
		{
			echo '修改';
		}


		//删除管理员
		public function deleteManage()
		{
			echo '删除';
		}
	}
?>