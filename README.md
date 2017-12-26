### 2017年12月26日14:05:04 更新信息
#### 实现PHP管理员添加和修改快捷链接操作
```html
	<ol>
		<li><a href="manage.php?action=list" class="selected">管理员列表</a></li>
		<li><a href="manage.php?action=add">添加管理员</a></li>
		{if $update}
			<li><a href="manage.php?action=update">修改管理员</a></li>
		{/if}
	</ol>
```

#### JS操作
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

#### 从数据库中取出等级信息  ( 在类文件ManageModel.class.php 中 类ManageModel 中添加下面方法 )

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

#### 模板注入 ( 在类文件ManageAction.class.php 中 类ManageAction 注入查询数据的变量)

```php
$this->tpl->assign('levels',$this->model->fetchDegree());
```

