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
		管理首页 &gt;&gt; 管理员管理 &gt;&gt; <strong id='title'><?php echo $this->_vars['title'];?></strong>
	</div>

	<ol>
		<li><a href="manage.php?action=list" class="selected">管理员列表</a></li>
		<li><a href="manage.php?action=add">添加管理员</a></li>
		<?php if ($this->_vars['update']) {?>
			<li><a href="manage.php?action=update">修改管理员</a></li>
		<?php } ?>
	</ol>

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
					<td><a href='?action=update&id=<?php echo $value->id?>'>修改</a> | <a href='?action=delete&id=<?php echo $value->id?>'>删除</a></td>
				</tr>
			<?php } ?>
		</table>
			
		<div id="page"><?php echo $this->_vars['page'];?></div>	

		<p class="center">[<a href='?action=add'>新增管理员</a>]</p>
	
	<?php } ?>


	<?php if ($this->_vars['add']) {?>
		<form method="post">
			<table cellspacing="0" class="left">
				<tr><td>用户名：<input type="text" name="admin_user" class="text" /></td></tr>
				<tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
				<tr><td>等　级：<select name="level">
									<?php foreach ($this->_vars['levels'] as $key=>$value) { ?>
										<option value="<?php echo $value->level?>"><?php echo $value->level_name?></option>
									<?php } ?> 
								 </select>
				</td></tr>
				<tr><td><input type="submit" name="add" value="新增管理员" class="submit" /> [ <a href="manage.php?action=list">返回列表</a> ]</td></tr>
			</table>
		</form>
	<?php } ?>



	<?php if ($this->_vars['update']) {?>
		<form method="post">
			<table cellspacing="0" class="left">
				<tr><td>用户名：<input type="text" name="admin_user" class="text" value="<?php echo $this->_vars['update_admin_user'];?>" /></td></tr>
				<tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
				<tr><td>等　级：<select name="level" class="updateSelect">
									<?php foreach ($this->_vars['levels'] as $key=>$value) { ?>
										<option value="<?php echo $value->level?>"><?php echo $value->level_name?></option>
									<?php } ?> 
								 </select>
				</td></tr>
				<tr><td><input type="submit" name="update" value="修改管理员" class="submit" /> [ <a href="manage.php?action=list">返回列表</a> ]</td></tr>
			</table>
		</form>
		<script type="text/javascript">
			~function(){
				var updateSelect = document.querySelector('.updateSelect');
				var options = updateSelect.children;
				console.log(options);
				for(var i=0;i<options.length;i++)
				{
					if(options[i].value == <?php echo $this->_vars['update_level'];?>)
					{
						options[i].setAttribute('selected','selected');
					}
				}
			}();
		</script>
	<?php } ?>



	<?php if ($this->_vars['delete']) {?>
		删除页面
	<?php } ?>

</body>
</html>