<?php
	/**
	*  Manage 管理员实体类 : 数据层的操作
	*/
	class Manage
	{
		
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
						0,10';

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
			echo '新增';
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