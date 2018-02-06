
//验证登录
function checkLogin()
{	

	let fm = document.login;

	if(fm.admin_user.value == '' || fm.admin_user.value.length < 2 || fm.admin_user.value.length > 20)
	{
		alert('用户名不得为空并且不得小于2位不得大于20位');
		fm.admin_user.focus();
		return false;
	}

	if(fm.admin_pass.value == '' || fm.admin_pass.value.length < 2 || fm.admin_pass.value.length > 16)
	{
		alert('密码不得为空并且不得小于2位不得大于16位');
		fm.admin_pass.focus();
		return false;
	}

	if(fm.code.value == '' || fm.code.value.length != 4 )
	{
		alert('验证不得为空并且必须为4位');
		fm.code.focus();
		return false;
	}

	return true;
}