<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">


	<div class="map">
		管理首页 &gt;&gt; 等级管理 &gt;&gt; <strong id='title'>{$title}</strong>
	</div>

	<ol>
		<li><a href="level.php?action=list" class="selected">等级列表</a></li>
		<li><a href="level.php?action=add">添加等级</a></li>
		{if $update}
			<li><a href="level.php?action=update">修改等级</a></li>
		{/if}
	</ol>

	{if $list}
		<table cellspacing="0">

			<tr>
				<th>编号</th>
				<th>等级</th>
				<th>等级名称</th>
				<th>等级信息</th>
				<th>等级操作</th>
			</tr>
			{foreach $AllLevel(key,value)}
				<tr>
					<td>{@value->id}</td>
					<td>{@value->level}</td>
					<td>{@value->level_name}</td>
					<td>{@value->level_info}</td>
					<td><a href='?action=update&id={@value->id}'>修改</a> | <a href='?action=delete&id={@value->id}'>删除</a></td>
				</tr>
			{/foreach}
		</table>

		<p class="center">[<a href='?action=add'>新增等级</a>]</p>
	{/if}


	{if $add}
		<form method="post">
			<table cellspacing="0" class="left">
				<tr><td>等  级：<input type="text" name="level" class="text" /></td></tr>
				<tr><td>等级名称：<input type="text" name="level_name" class="text" /></td></tr>
				<tr><td>等级信息：<textarea cols="40" rows="10" name="level_info"></textarea>
				</td></tr>
				<tr><td><input type="submit" name="add" value="新增等级" class="submit" /> [ <a href="level.php?action=list">返回列表</a> ]</td></tr>
			</table>
		</form>
	{/if}



	{if $update}
		<form method="post">
			<table cellspacing="0" class="left">
				<tr><td>等  级：<input type="text" name="level" class="text" value="{$update_level}" /></td></tr>
				<tr><td>等级名称：<input type="text" name="level_name" class="text" value="{$update_level_name}"/></td></tr>
				<tr><td>等级信息：<textarea cols="40" rows="10" name="level_info" >{$update_level_info}</textarea>
				</td></tr>
				<tr><td><input type="submit" name="update" value="修改等级" class="submit" /> [ <a href="level.php?action=list">返回列表</a> ]</td></tr>
			</table>
		</form>

		<!-- <script type="text/javascript">
			~function(){
				var updateSelect = document.querySelector('.updateSelect');
				var options = updateSelect.children;
				console.log(options);
				for(var i=0;i<options.length;i++)
				{
					if(options[i].value == {$update_level})
					{
						options[i].setAttribute('selected','selected');
					}
				}
			}();
		</script> -->
	{/if}



	{if $delete}
		删除页面
	{/if}

</body>
</html>