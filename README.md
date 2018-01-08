### 通过PHP面向对象创建内容管理系统
> 1.实现PHP管理员添加和修改快捷链接操作
```html
<ol>
	<li><a href="manage.php?action=list" class="selected">管理员列表</a></li>
	<li><a href="manage.php?action=add">添加管理员</a></li>
	{if $update}
		<li><a href="manage.php?action=update">修改管理员</a></li>
	{/if}
</ol>
```

> JS操作
```js
var title = document.getElementById('title');
var ol = document.getElementsByTagName('ol');
var a = ol[0].getElementsByTagName('a');

for(i=0;i<a.length;i++)
{
	a[i].className = null;
	
	if(title.innerHTML == a[i].innerHTML)
	{
		a[i].className = 'selected';
	}
}
```

> 2.从数据库中取出等级信息  ( 在类文件ManageModel.class.php 中 类ManageModel 中添加下面方法 )

```php
//查询所有等级列表
public function fetchDegree()
{
	//1.查询等级列表sql语句
	$sql = "SELECT level_name,level FROM cms_level ORDER BY id DESC";

	//2.执行新增 并得到操作情况
	$rows = parent::fetchMoreModel($sql);

	return $rows;
}
```

> 3.模板注入 ( 在类文件ManageAction.class.php 中 类ManageAction 注入查询数据的变量)

```php
$this->tpl->assign('levels',$this->model->fetchDegree());
```

> 4.新增等级管理

```html
思路：
	1. 其数据库操作方式, 以及基类和模型类的处理方式与管理员管理几乎保持一致
	2. 在templates目录下新建level.tpl, 粘贴来自manage.tpl的内容, 进行简单的修改
	3. 在admin目录下新建level.php,用来解析显示level.tpl
	4. 在model目录下新建LevelModel.class.php 粘贴来自ManageModel.class.php的内容, 同样继承基类Model,再对方法进行对应的修改
	5. 在action目录下新建LevelAction.class.php 粘贴来自ManageAction.class.php的内容, 同样继承基类Action,再对方法进行对应的修改
	6. 运行调试，建议开启 mysqli::errno 进行排错
```

> 5.新增表单检测工具类

```html
思路： 
	1. 在includes目录下新建Validate.class.php工具类文件
	2. 在类Validate中添加静态方法：
		2-1. 检测是否为空 checkNull($str)
		2-2. 检测长度是否合法	checkLength($str,$len,$max)
		2-3. 检测两次密码是否匹配正确 checkEquals($before,$behind)
		2-4. more……
	3.在类ManageAction和LevelAction中实现检测逻辑	
```

> 6.添加JS在客户端验证表单

> 7.数据库详细匹队验证

```
1. 用户名不得重复 -> 在类ManageAction中新建用户名查询方法
2. 等级名称不得重复 -> 在类ManageAction中新建等级名称查询方法
3. 防止等级误删除 -> 在没有被用户使用的情况下可以删除 -> 通过当前等级去查询对应的管理员表中是否去查询是否拥有这条记录
``` 

```php

1. 检测用户名是否存在 2.检测等级是否存在同上
$obj = $this->model->selectCurrentByUser();
if(isset($obj))
{
	Tool::alertBack('该用户名已存在！');	
}

3. 判断是否有用户占用这个等级
$manageMode = new ManageModel();
$manageMode->level = $fetchData->level;
if($manageMode->selectCurrentByLevel())
{
	Tool::alertBack('该等级名称已有用户占用，不能删除！');
}
```

> 8.新增分页类

```
1. 在配置文件中定义分页的limit
2. 新建分页类文件Pages.class.php 使用拦截器对总记录数、每页记录数、limitStr 赋值
4. 获取当前页码，获取总页码，获取当前页记录，来满足切换分页时sql语句中...limit x,y 中，x,y的值
5. 文本页码跳转( 上一页,下一页,首页,尾页 ); 数字页码跳转;  获取当前url( 因为不同模块下分页情况不同 ); 
6. 智能分页	
```

```php
1. 初始化分页 在Pages类中的showPage()生成分页列表 注入模板变量{$page}中

$arr = $this->model->getManages();
$totalRecords = count($arr);
$pages = new Pages($totalRecords,LIST_LIMIT);
$this->model->limit = $pages->limitStr;
$this->tpl->assign('page',$pages->showPage());

2.使用parse_url(url)解析url地址 使该分页类能同时在多个页面模块下实现分页

private function setUrl()
{	
	$url = $_SERVER['REQUEST_URI'];
	
	if(!isset(parse_url($url)['query'])) return;

	$urlquery = parse_url($url);
	parse_str($urlquery['query'],$query);
	unset($query['page']);
	$url = $urlquery['path'].'?'.http_build_query($query);

	return $url;
}
```