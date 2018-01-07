<?php
	/**
	*  分页类 Pages
	*/
	class Pages
	{
		
		private $total;      //总记录数
		private $pageSize;   //每页显示的条数
		private $limitStr;   //LIMIT X,Y
		private $page;		 //获取当前页码
		private $allpages;   //获取总页码数

		//构造方法 初始化
		function __construct($_total,$_pageSize)
		{
			$this->total = $_total;
			$this->pageSize = $_pageSize;
			$this->allPages = ceil($this->total/$this->pageSize);
			$this->page = $this->setPage();
			$this->limitStr = 'LIMIT '.($this->page-1)*$this->pageSize.','.$this->pageSize;
		}

		//设置拦截类
		function __set($key,$value){
			$this->$key = $value;
		}

		function __get($key){
			return $this->$key;
		}

		//获取和过滤当前页码
		private function setPage(){
			$page = 0;
			if(isset($_GET['page'])){

				//如果不是数字 默认第1列
				if(!is_numeric($_GET['page'])){
					return 1;
				}

				//判断是否超出最大页数
				if($_GET['page'] > $this->allPages){
					$page =  $this->allPages;
				}
				else
				{
					$page = $_GET['page'];
				}
				
			}else{
				$page = 1;
			}

			return $page;
		}

		//分页信息
		public function showPage()
		{
			 return $this->page;
		}
	}
?>