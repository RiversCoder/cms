<?php
	/**
	* 工具类 Tool
	*/
	class Tool 
	{
		
		//弹窗 页面跳转 go
		static public function alertLocation($info,$url)
		{
			$script = "<script>alert('{$info}');window.location.href='{$url}';</script>";

			exit($script);
		}

		//弹窗 页面跳转 back
		static public function alertBack($info)
		{
			$script = "<script>alert('{$info}');history.back();</script>";
			exit($script);
		}
		
		
	}
?>