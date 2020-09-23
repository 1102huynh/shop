<?php

if(isset($_POST['user']))
{
	$user=mysqli_real_escape_string($link,$_POST['user']);// Chuyen '," => \',\"
	$pass=sha1($_POST['pass']);
	
	echo $sql="select * from `nn_admin` where `email`='$user'";
	$rs=mysqli_query($link,$sql);
	
	if(mysqli_num_rows($rs)==0)//Sai => thong bao sai email
	{
		echo 'Email không tồn tại trong hệ thống !';
	}
	else//Đúng email => kiểm tra mật khẩu
	{
		//Lay thong tin
		$r=mysqli_fetch_assoc($rs);
		if($r['password']==$pass)//Đúng mat khau => ghi nhan nguoi dung da dang nhap vào SESSION
		{
			$_SESSION['admin_id']=$r['id'];
			$_SESSION['admin_name']=$r['name'];
			//Chuyen ve trang chu (PHP)
			header('location:?mod=home');
		}
		else //Sai mat khau
			echo 'Mật khẩu không đúng !';
	}
}
?>

<h2 class="heading colr">Login</h2>
<div class="login">
    <div class="registrd">
        <h3>Please Sign In</h3>
        <p>If you have an account with us, please log in.</p>
        <form action="" method="post" id="login">
        <ul class="forms">
            <li class="txt">Email Address <span class="req">*</span></li>
            <li class="inputfield"><input type="text" name="user" class="bar" required ></li>
        </ul>
        <ul class="forms">
            <li class="txt">Password <span class="req">*</span></li>
            <li class="inputfield"><input type="password" name="pass" class="bar" required ></li>
        </ul>
        <ul class="forms">
            <li class="txt">&nbsp;</li>
            <li><a href="javascript:document.getElementById('sm').click()" class="simplebtn"><span>Login</span></a> <input type="submit" style="width:0;height:0;border:none" value="Login" id="sm"> <a href="#" class="forgot">Forgot Your Password?</a></li>
        </ul>
        </form>
    </div>
</div>
<div class="clear"></div>