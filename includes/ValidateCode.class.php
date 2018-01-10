<?php
	/**
	*  验证码类 ValidateCode
	*/
	class ValidateCode
	{	
		
		//默认验证码字符
		private $char = '23456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
		private $vnumber = 4;   //按正码长度
		private $vchar = ''; //生成的验证码
		private $vlength = 50;   //验证码高度
		private $vwidth = 130;   //验证码宽度
		private $vimg;           //图形资源句柄


		//生成随机码 验证码位数 -- $this->vnumber
		private function createValidateChar(){
			
			$str = '';

			for($i=0;$i<$this->vnumber;$i++)
			{
				$str .= $this->char[mt_rand(0,mb_strlen($this->char)-1)];
			}

			return $str;
		}

		//生成验证码背景
		private function createValidateBg(){
			
			//创建图片
			$this->vimg = imagecreatetruecolor($this->vwidth, $this->vlength);

			//颜色
			$color = imagecolorallocate($this->vimg, mt_rand(150,255),mt_rand(150,255),mt_rand(150,255) );

			//绘制矩形
			imagefilledrectangle($this->vimg, 0, 0, $this->vwidth, $this->vlength, $color);
		}

		//输出
		private function outPutImg()
		{	
			header('Content-type:image/png');
			imagepng($this->vimg);
			imagedestroy($this->vimg);
		}


		//对外渲染输出验证码图片
		public function dovImg(){
			$this->createValidateBg();
			$this->outPutImg();
		}

	}
?>