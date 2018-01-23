<?php
	/**
	*  Manage 管理员实体类 : manage.php 数据层的所有操作
	*/
	class ManageModel extends Model
	{
		
		private	$tpl;
		private $admin_user;
		private $admin_pas;
		private $level;
		private $id;
		private $limit = '';

		//构造方法
		public function __construct(&$tpl)
		{
			$this->tpl = $tpl;
		}

		//拦截器 __set 用于实例获取设置更改私有变量$key值$value
		public function __set($key,$value)
		{
			$this->$key = $value;
		}

		//拦截器 __get 用于实例获取私有变量$key值
		public function __get($key)
		{
			return $this->$key;
		}


		//查询所有管理员
		public function getManages()
		{				
			//1. sql
			$_sql = 'SELECT 
						m.id,m.admin_user,m.level,m.login_count,m.last_ip,m.last_time,l.level_name 
					FROM 
						cms_manage m,cms_level l
					WHERE
						m.level = l.level 	 
					ORDER BY 
						m.id ASC
					'.$this->limit;	
			
			//2. 获取数据				
			$_html = array();
			$_html = parent::fetchMoreModel($_sql);

			
			//3.返回查询数据
			return $_html;
		}

		//查询登录管理员
		public function getLoginManage()
		{
			//1. sql
			$_sql = "SELECT 
						m.admin_user,l.level_name
					FROM 
						cms_manage m ,cms_level l
					WHERE
						m.admin_user='$this->admin_user' 
					AND 
						m.admin_pas='$this->admin_pas'
					AND
						m.level = l.level	
					LIMIT
						1"
					;		
			
			//2. 获取数据				
			$data = parent::fetchModel($_sql);
	
			//3.返回查询数据
			return $data;	
		}


		//新增管理员
		public function addManage()
		{
			
			//1.新增管理员sql语句
			$sql = "INSERT INTO cms_manage (admin_user,admin_pas,level,reg_time) VALUES ('{$this->admin_user}','{$this->admin_pas}',{$this->level},now())";

			//2.执行新增 并得到操作情况
			$affectd_rows = parent::audoModel($sql);

			return $affectd_rows;
		}

		//查询所有等级列表
		public function fetchDegree()
		{
			//1.查询等级列表sql语句
			$sql = "SELECT level_name,level FROM cms_level ORDER BY id DESC";

			//2.执行新增 并得到操作情况
			$rows = parent::fetchMoreModel($sql);

			return $rows;
		}


		//查询当前ID的管理员数据
		public function selectCurrent()
		{

			//获取数据的ID
			$this->id = $_GET['id'];

			//1. 查询当前ID对应的数据,注入manage.tpl模板中
			$sql_select =  "SELECT admin_user,level FROM cms_manage WHERE id = {$this->id}";
			
			//2.获取数据
			$obj = parent::fetchModel($sql_select);


			//3. 注入变量
			$this->tpl->assign('update_admin_user',$obj->admin_user);
			$this->tpl->assign('update_level',$obj->level);

			return $obj;
		}


		//修改管理员
		public function upadteManage()
		{	
			

			$this->admin_user = $_POST['admin_user'];
			$this->admin_pas = $_POST['admin_pass'];
			$this->level = $_POST['level'];

			$sql_update = "UPDATE cms_manage SET admin_user='{$this->admin_user}',admin_pas='{$this->admin_pas}',level={$this->level} WHERE id = {$this->id}";
			
			//执行修改 并得到操作情况
			$affectd_rows = parent::audoModel($sql_update);

			return $affectd_rows;
		}


		//删除管理员
		public function deleteManage()
		{

			$sql = "DELETE FROM cms_manage WHERE id = {$this->id}";
			
			//执行修改 并得到操作情况
			$affectd_rows = parent::audoModel($sql);

			return $affectd_rows;
		}


		//弹出窗口
		public function alertInfo($checkResult,$info)
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


		//信息
		public function alertInfos()
		{
			$arr = array();
			$arr['update'] = Array('success'=>'修改成功','error'=>'修改失败');
			$arr['add'] = Array('success'=>'添加成功','error'=>'添加失败');
			$arr['delete'] = Array('success'=>'删除成功','error'=>'删除失败');
			
			return $arr;
		}
	}
?>