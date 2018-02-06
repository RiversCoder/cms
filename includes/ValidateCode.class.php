<?php
	/**
	*  验证码类 ValidateCode
	*/
	class ValidateCode
	{	
		
		//默认验证码字符
		private $char = '23456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
		private $vnumber = 4;    //按正码长度
		private $vchar = '';     //生成的验证码
		private $vheight = 50;   //验证码高度
		private $vwidth = 130;   //验证码宽度
		private $vimg;           //图形资源句柄
		private $fontFile = ROOT_PATH.'/fonts/segoepr.ttf';  //验证码字体
		private $lineNums = 10;  //随机线条数
		private $snowNums = 30;  //随机雪花数

		
		public function __construct(){
			
		}


		public function __get($key)
		{
			return $this->$key;
		}

		public function __set($key,$value)
		{
			$this->$key = $value;
		}

		//生成随机码 验证码位数 -- $this->vnumber
		private function createValidateChar(){
			
			$str = '';

			for($i=0;$i<$this->vnumber;$i++)
			{
				$str .= $this->char[mt_rand(0,mb_strlen($this->char)-1)];
			}

			$this->vchar = $str;

			return $str;
		}

		//生成验证码背景
		private function createValidateBg(){
			
			//创建图片
			$this->vimg = imagecreatetruecolor($this->vwidth, $this->vheight);

			//颜色
			$color = imagecolorallocate($this->vimg, mt_rand(200,255),mt_rand(200,255),mt_rand(200,255) );

			//绘制矩形
			imagefilledrectangle($this->vimg, 0, 0, $this->vwidth, $this->vheight, $color);
		}

		//生成验证码
		private function createCode()
		{
			//创建颜色
			$color = null;
			
			//创建验证码字符
			for($i=0;$i<mb_strlen($this->vchar);$i++)
			{
				$color = imagecolorallocate($this->vimg,mt_rand(0,155),mt_rand(0,155),mt_rand(0,155));
				imagettftext($this->vimg, mt_rand(15,18), mt_rand(-30,30), $i/4*$this->vwidth+mt_rand(6,12),mt_rand($this->vheight/3,$this->vheight/1.2), $color ,$this->fontFile, $this->vchar[$i]);
			}
		}

		//创建随机线条
		private function createLines()
		{	
			$img_line_color = null;

			for($i=0;$i<$this->lineNums;$i++)
			{
				$img_line_color = imagecolorallocate($this->vimg, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
				imageline($this->vimg, mt_rand(0,$this->vwidth),mt_rand(0,$this->vheight), mt_rand(0,$this->vwidth),mt_rand(0,$this->vheight),$img_line_color);
			}
		}

		//创建随机雪花
		private function createSnows()
		{
			$img_snow_color = null;

			for($i=0;$i<$this->snowNums;$i++)
			{
				$img_snow_color = imagecolorallocate($this->vimg, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
				imagestring($this->vimg,mt_rand(1,5), mt_rand(0,$this->vwidth),mt_rand(0,$this->vheight), '*',$img_snow_color);
			}
		}

		//输出
		private function outPutImg()
		{	
			header('Content-type:image/png');
			imagepng($this->vimg);
			imagedestroy($this->vimg);
		}


		//对外渲染输出验证码图片
		public function dovImg()
		{
			$this->createValidateBg();
			$this->createValidateChar();
			$this->createLines();
			$this->createSnows();
			$this->createCode();
			$this->outPutImg();
		}

	}
?>