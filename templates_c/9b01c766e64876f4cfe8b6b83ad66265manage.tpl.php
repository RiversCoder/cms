<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body id="main">


	<div class="map">
		管理首页 &gt;&gt; 管理员管理 &gt;&gt; <strong><?php echo $this->_vars['title'];?></strong>
	</div>

	<?php if ($this->_vars['list']) {?>
	<table cellspacing="0">
		<tr><th>编号</th><th>用户名</th><th>等级</th><th>登陆次数</th><th>最近登录IP</th><th>最近登陆时间</th><th>操作</th></tr>
		<?php foreach ($this->_vars['AllManage'] as $key=>$value) { ?>
			<tr>
				<td><?php echo $value->id?></td>
				<td><?php echo $value->admin_user?></td>
				<td><?php echo $value->level_name?></td>
				<td><?php echo $value->login_count?></td>
				<td><?php echo $value->last_ip?></td>
				<td><?php echo $value->last_time?></td>
				<td><a href='?action=update'>修改</a> | <a href='?action=delete'>删除</a></td>
			</tr>
		<?php } ?>
	</table>

	<p class="center">[<a href='?action=add'>新增管理员</a>]</p>
	<?php } ?>


	<?php if ($this->_vars['add']) {?>
	<form method="post">
		<table cellspacing="0" class="left">
			<tr><td>用户名：<input type="text" name="admin_user" class="text" /></td></tr>
			<tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
			<tr><td>等　级：<select name="level">
								<option value="5">普通管理员</option>
								<option value="6">超级管理员</option>
							 </select>
			</td></tr>
			<tr><td><input type="submit" name="send" value="新增管理员" class="submit" /> [ <a href="manage.php?action=list">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>



	<?php if ($this->_vars['update']) {?>
	<form method="post">
		<table cellspacing="0" class="left">
			<tr><td>用户名：<input type="text" name="admin_user" class="text" /></td></tr>
			<tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
			<tr><td>等　级：<select name="level">
								<option value="5">普通管理员</option>
								<option value="6">超级管理员</option>
							 </select>
			</td></tr>
			<tr><td><input type="submit" name="send" value="修改管理员" class="submit" /> [ <a href="manage.php?action=list">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>



	<?php if ($this->_vars['delete']) {?>
	删除页面
	<?php } ?>

</body>
</html>