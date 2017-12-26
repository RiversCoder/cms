<?php
	/*
	  执行 ManageAction 
	*/
	class LevelAction extends Action
	{
		
		//构造方法 初始化
		public function __construct(&$_tpl)
		{	
			//在parent::__construct($_tpl,new ManageModel($_tpl)) 之前都不能用 $this->tpl 以及 $this->model 因为还没有给父类（基类）的属性添加属性值
			$lmt = new LevelModel($_tpl);
			parent::__construct($_tpl,$lmt);
			$this->_action();
		}

		//_action
		private function _action()
		{	
			//初始化数据 避免PHP未定义语法报错
			$this->initRender();

			//业务流程控制 操作界面显示
			@$r_result = $_GET['action'];

			switch ($r_result) 
			{
				case 'list':
					$this->defaults();
				break;

				case 'add':
					$this->add();
				break;

				case 'update':
					$this->update();
				break;
				
				case 'delete':
					$this->delete();
				break;

				default:
					$this->defaults();
				break;
			}

			//获取列表数据后 渲染level.tpl模板页面
			$this->renderLevel();
		}


		private function add()
		{
			//检测当前页面是否发出POST请求 并且检测$_POST['add']是否存在	
			if(isset($_POST['add']))
			{	
				//获取数据
				$this->model->level = $_POST['level'];
				$this->model->level_name = $_POST['level_name'];
				$this->model->level_info = $_POST['level_info'];

				//执行添加操作
				$getResult = $this->model->addLevel();

				echo $getResult;
				$this->model->alertInfo($getResult,$this->model->alertInfos()['add']);	
			}

			$this->tpl->assign('add',true);
			$this->tpl->assign('title','添加等级');
		}


		private function update()
		{
			//1. 获取id
			if(!isset($_GET['id']) || !is_numeric($_GET['id']))
			{
				Tool::alertBack('修改错误!');
			}


			//3. 查询当前要修改的数据 -> 需要获取当前页面的ID值
			$this->model->id = $_GET['id'];
			$current = $this->model->selectCurrent();

			//4.检测当前页面是否发出POST请求 并且是否能接收到$_POST['update']值
			if(isset($_POST['update']))
			{	
				//执行修改操作
				$getResult = $this->model->upadteLevel();

				//弹窗设置
				$this->model->alertInfo($getResult,$this->model->alertInfos()['update']);	
			}	

			//2. 渲染页面 注入变量
			$this->tpl->assign('update',true);
			$this->tpl->assign('title','修改等级');
		}


		private function delete()
		{
			//1. 获取id
			if(!isset($_GET['id']) || !is_numeric($_GET['id']))
			{
				Tool::alertBack('删除错误!');
			}

			//3. 删除操作
			$this->model->id = $_GET['id'];
			$getResult = $this->model->deleteLevel();
			$this->model->alertInfo($getResult,$this->model->alertInfos()['delete']);	
				
			//2. 渲染页面 
			$this->tpl->assign('delete',true);
			$this->tpl->assign('title','删除等级');
		}


		private function defaults()
		{
			$this->tpl->assign('list',true);
			$this->tpl->assign('title','等级列表');
		}

		private function initRender()
		{
			$this->tpl->assign('list',false);
			$this->tpl->assign('add',false);
			$this->tpl->assign('update',false);
			$this->tpl->assign('delete',false);
		}

		private function renderLevel()
		{
			//获取列表数据
			$arr =$this->model->getLevels();

			//在manage.tpl模板中 注入变量
			$this->tpl->assign('AllLevel',$arr);
			$this->tpl->display('level.tpl');
		}
	}
?>