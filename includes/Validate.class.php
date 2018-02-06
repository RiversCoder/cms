<?php
	//验证类
	class Validate {
		
		//是否为空
		static public function checkNull($_date) {
			if (trim($_date) == '') return true;
			return false;
		}
		
		//长度是否合法
		static public function checkLength($_date, $_length, $_flag) {
			if ($_flag == 'min') {
				if (mb_strlen(trim($_date),'utf-8') < $_length) return true;
				return false;
			} elseif ($_flag == 'max') {
				if (mb_strlen(trim($_date),'utf-8') > $_length) return true;
				return false;
			} elseif ($_flag == 'equals') {
				if (mb_strlen(trim($_date),'utf-8') != $_length) return true;
				return false;
			}else {
				Tool::alertBack('EROOR：参数传递的错误，必须是min,max！');
			}
		}
		
		//数据是否一致
		static public function checkEquals($_date, $_otherdate) {
			if (trim($_date) != trim($_otherdate)) return true;
			return false;
		}

		//检测session是否存在
		static public function checkSession()
		{
			if(!isset($_SESSION['admin']))
			{
				Tool::alertLocation('非法登录!','admin_login.php');
			}
		}
		
	}
?>