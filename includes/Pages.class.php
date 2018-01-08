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
		private $urlStr;	 //获取当前路径

		//构造方法 初始化
		function __construct($_total,$_pageSize)
		{
			$this->total = $_total;
			$this->pageSize = $_pageSize;
			$this->allPages = ceil($this->total/$this->pageSize);
			$this->page = $this->setPage();
			$this->limitStr = 'LIMIT '.($this->page-1)*$this->pageSize.','.$this->pageSize;
			$this->urlStr = $this->setUrl();
		}

		//设置拦截类
		function __set($key,$value){
			$this->$key = $value;
		}

		function __get($key){
			return $this->$key;
		}

		//获取和过滤当前页码 防止用户在地址栏非法输入
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

		//首页
		private function firstPage()
		{
			return ' <a href="'.$this->urlStr.'">首页 </a> ';
		}

		//上一页
		private function prevPage()
		{
			return ' <a href="'.$this->urlStr.'t&page='.($this->page-1).'">上一页 </a> ';
		}
		
		//下一页
		private function nextPage()
		{
			return ' <a href="'.$this->urlStr.'&page='.($this->page+1).'">下一页 </a> ';
		}

		//尾页
		private function endPage()
		{
			return ' <a href="'.$this->urlStr.'&page='.$this->allPages.'">尾页</a> ';
		}

		//取出路径中的地址 方便其他页面直接调用该分页类
		private function setUrl()
		{	
			$url = $_SERVER['REQUEST_URI'];
			
			if(!isset(parse_url($url)['query']))
			{
				return;
			}	

			$urlquery = parse_url($url);
			parse_str($urlquery['query'],$query);
			unset($query['page']);
			$url = $urlquery['path'].'?'.http_build_query($query);

			return $url;
		}

		//数字分页目录
		private function pageList()
		{
			$pageNumLink = '';
			
			for($i=1;$i<=$this->allPages;$i++)
			{
				$pageNumLink .= '[<a href="'.$this->urlStr.'&page='.$i.'"> '.$i.' </a>]';
			}

			return $pageNumLink;
		}


		//分页信息
		public function showPage()
		{	 
			$_page = '';
			$_page .= $this->firstPage();
			$_page .= $this->prevPage();
			$_page .= $this->pageList();
			$_page .= $this->nextPage();
			$_page .= $this->endPage();
			
			return $_page;
		}
	}
?>