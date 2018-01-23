<?php
	/*
	  执行 ManageAction 
	*/
	class ManageAction extends Action
	{
		
		//构造方法 初始化
		public function __construct(&$_tpl)
		{	
			//在parent::__construct($_tpl,new ManageModel($_tpl)) 之前都不能用 $this->tpl 以及 $this->model 因为还没有给父类（基类）的属性添加属性值
			$mmt = new ManageModel($_tpl);
			parent::__construct($_tpl,$mmt);
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

				case 'login':
					$this->login();
				break;

				default:
					$this->defaults();
				break;
			}

			//获取列表数据后 渲染manage.tpl模板页面
			$this->renderManage();
		}


		private function add()
		{
			//检测当前页面是否发出POST请求 并且检测$_POST['add']是否存在	
			if(isset($_POST['add']))
			{	
				//获取数据
				$this->model->admin_user = $_POST['admin_user'];
				$this->model->admin_pas = md5($_POST['admin_pass']);
				$this->model->level = $_POST['level'];

				//执行添加操作
				$getResult = $this->model->addManage();
				$this->model->alertInfo($getResult,$this->model->alertInfos()['add']);	
			}

			$this->tpl->assign('add',true);
			$this->tpl->assign('title','添加管理员');
			$this->tpl->assign('levels',$this->model->fetchDegree());
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
				$getResult = $this->model->upadteManage();
				//弹窗设置
				$this->model->alertInfo($getResult,$this->model->alertInfos()['update']);	
			}	

			//2. 渲染页面 注入变量
			$this->tpl->assign('update',true);
			$this->tpl->assign('title','修改管理员');
			$this->tpl->assign('levels',$this->model->fetchDegree());
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
			$getResult = $this->model->deleteManage();
			$this->model->alertInfo($getResult,$this->model->alertInfos()['delete']);	
				
			//2. 渲染页面 
			$this->tpl->assign('delete',true);
			$this->tpl->assign('title','删除管理员');
		}


		private function defaults()
		{	

			//初始化分页
			$arr = $this->model->getManages();
			$totalRecords = count($arr);
			$pages = new Pages($totalRecords,LIST_LIMIT);
			$this->model->limit = $pages->limitStr;
			
			//注入分页内容
			$this->tpl->assign('page',$pages->showPage());
			
			$this->tpl->assign('list',true);
			$this->tpl->assign('title','管理员列表');
		}

		private function initRender()
		{
			$this->tpl->assign('list',false);
			$this->tpl->assign('add',false);
			$this->tpl->assign('update',false);
			$this->tpl->assign('delete',false);
		}

		private function renderManage()
		{
			//获取列表数据
			$arr =$this->model->getManages();

			//在manage.tpl模板中 注入变量
			$this->tpl->assign('AllManage',$arr);
			$this->tpl->display('manage.tpl');
		}

		//Login
		private function login()
		{
			if(!isset($_POST['send'])) return;

			//验证 验证码 -> 位数
			if(Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('验证码必须是四位');

			//验证 验证码 -> 匹配是否输入正确
			if(Validate::checkEquals(strtolower($_SESSION['code']),strtolower($_POST['code']))) Tool::alertBack('验证码输入错误');
			
			//验证验证账号和密码                               
			if(Validate::checkNull($_POST['admin_user'])) Tool::alertBack('用户名不能为空');
			if(Validate::checkLength($_POST['admin_user'],2,'min')) Tool::alertBack('用户名不能小于2位');
			if(Validate::checkLength($_POST['admin_user'],20,'max')) Tool::alertBack('用户名不能大于20位');	
			if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('密码不能为空');
			if(Validate::checkLength($_POST['admin_pass'],16,'max')) Tool::alertBack('密码不能大于16位');
			if(Validate::checkLength($_POST['admin_pass'],2,'min')) Tool::alertBack('密码不能小于2位');	
			
			//查询返回数据库验证
			$this->model->admin_user = $_POST['admin_user'];
			$this->model->admin_pas = md5($_POST['admin_pass']);
			$obj = $this->model->getLoginManage();

			if($obj)
			{	
				//设置后台界面用户信息
				$_SESSION['admin']['admin_user'] = $obj->admin_user;
				$_SESSION['admin']['level_name'] = $obj->level_name;

				//登录成功直接进入后台
				Tool::alertLocation(null,'admin.php');
			}	
			else
			{
				Tool::alertBack('用户名或密码错误');	
			}


			print_r($_POST);
		}
	}
?>