<?php
	/**
	*  Manage 管理员实体类 : manage.php 数据层的所有操作
	*/
	class LevelModel extends Model
	{
		
		private	$tpl;
		private $level;
		private $level_name;
		private $level_info;
		private $id;

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


		//查询所有等级信息
		public function getLevels()
		{				
			//1. sql
			$_sql = 'SELECT 
						id,level,level_name,level_info
					FROM 
						cms_level
					ORDER BY 
						id ASC
					LIMIT 
						0,20';	
			
			//2. 获取数据				
			$_html = array();
			$_html = parent::fetchMoreModel($_sql);

			
			//3.返回查询数据
			return $_html;
		}


		//新增等级
		public function addLevel()
		{
			
			//1.新增管理员sql语句
			$sql = "INSERT INTO cms_level (level,level_name,level_info) VALUES ({$this->level},'{$this->level_name}','{$this->level_info}')";

			//2.执行新增 并得到操作情况
			$affectd_rows = parent::audoModel($sql);

			return $affectd_rows;
		}


		//查询当前ID的等级数据
		public function selectCurrent()
		{

			//获取数据的ID
			$this->id = $_GET['id'];

			//1. 查询当前ID对应的数据,注入manage.tpl模板中
			$sql_select =  "SELECT level,level_name,level_info FROM cms_level WHERE id = {$this->id}";
			
			//2.获取数据
			$obj = parent::fetchModel($sql_select);


			//3. 注入变量
			$this->tpl->assign('update_level',$obj->level);
			$this->tpl->assign('update_level_name',$obj->level_name);
			$this->tpl->assign('update_level_info',$obj->level_info);

			return $obj;
		}

		//修改等级
		public function upadteLevel()
		{	
			

			$this->level = $_POST['level'];
			$this->level_name = $_POST['level_name'];
			$this->level_info = $_POST['level_info'];

			$sql_update = "UPDATE cms_level SET level={$this->level},level_name='{$this->level_name}',level_info='{$this->level_info}' WHERE id = {$this->id}";

			//执行修改 并得到操作情况
			$affectd_rows = parent::audoModel($sql_update);

			return $affectd_rows;
		}


		//删除等级信息
		public function deleteLevel()
		{

			$sql = "DELETE FROM cms_level WHERE id = {$this->id}";
			
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