<?php
	/**
	* 模型基类 Model 
	*/
	class Model
	{
		

		//添加，修改，删除数据 模型
		public function audoModel($sql)
		{
			//1. 获取数据库连接
			$mysqli = DB::getDB();
			
			//2. 操作数据库
			$result = $mysqli->query($sql);
			$getResult = $mysqli->affected_rows;
			
			//3. 清楚数据库连接
			DB::unDB($result,$mysqli);

			return $getResult;
		}

		//查找单条数据 模型
		public function fetchModel($sql)
		{
			//1. 获取数据库连接
			$mysqli = DB::getDB();

			//操作数据库
			$result = $mysqli->query($sql);
			$obj = $result->fetch_object();

			//清楚数据库连接
			DB::unDB($result,$mysqli);

			return $obj;
		}

		//查找多条数据 模型

		public function fetchMoreModel($sql)
		{
			//1. 获取数据库连接
			$mysqli = DB::getDB();

			//操作数据库
			$result = $mysqli->query($sql);
			$arr = array();

			while(!!$obj = $result->fetch_object())
			{
				$arr[] = $obj;
			}

			//清楚数据库连接
			DB::unDB($result,$mysqli);

			return $arr;
		}
	}
?>