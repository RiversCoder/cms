<?php
	/**
	*  分页类 Pages
	*/
	class Pages
	{
		
		private $total;    //总记录数
		private $pageSize;   //每页显示的条数
		private $limitStr;   //LIMIT X,Y

		//构造方法 初始化
		function __construct($_total,$_pageSize)
		{
			$this->total = $_total;
			$this->pageSize = $_pageSize;
			$this->limitStr = 'LIMIT 0,'.$this->pageSize;
		}

		//设置拦截类
		function __set($key,$value){
			$this->$key = $value;
		}

		function __get($key){
			return $this->$key;
		}
	}
?>