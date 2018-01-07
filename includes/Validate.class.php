<?php
	/**
	*  验证类
	*/
	class Validate 
	{

		//是否为空
		static public function checkNull($str)
		{	
			//为空
			if(empty(trim($str)))
			{
				return true;
			}

			return false;

		}

		//长度是否合法
		static public function checkLength($str,$len,$max)
		{
			$newStr = trim($str);
			if(mb_strlen($newStr,'utf-8') < $len || mb_strlen($newStr,'utf-8') > $max)
			{
				return true;
			}

			return false;
		}

		//数据是否一致
		static public function checkEquals($before,$behind)
		{
			if( trim($before) != trim($behind) )
			{
				return true;
			}

			return false;
		}
	}
?>