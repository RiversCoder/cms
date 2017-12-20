<?php
	class Action
	{
		protected $tpl;
		protected $model;		

		protected function __construct(&$tpl,&$model)
		{
			$this->tpl = $tpl;
			$this->model = $model;
		}
	}	
?>