<?php
	$user=mysqli_real_escape_string($link,$_POST['user']);// Chuyen '," => \',\"
	$pass=sha1($_POST['pass']);
	
	$sql="select * from `nn_user` where `email`='$user'";
	$rs=mysqli_query($link,$sql);
	
	if(mysqli_num_rows($rs)==0)//Sai => thong bao, chuyen ve trang dang nhap (JS)
	{
		//echo 'Sai email';
?>
		<script>
		window.onload=function()
		{
			alert('Email không tồn tại trong hệ thống !');
			//window.location='?mod=login';
			history.go(-1);
		}
		</script>
<?php
	}
	
	else//Đúng => Kiểm tra mật khẩu
	{
		//Lay thong tin
		$r=mysqli_fetch_assoc($rs);
		if($r['password']==$pass)//Đúng mật khẩu => ghi nhan nguoi dung da dang nhap vào SESSION
		{
			$_SESSION['id']=$r['id'];
			$_SESSION['name']=$r['name'];
			//Chuyen ve trang chu (PHP)
			header('location:?mod=home');
		}
		else //Sai mật khẩu
		{
?>
		<script>
			window.onload=function()
			{
				alert('Mật khẩu không đúng !');
				//window.location='?mod=login';
				history.go(-1);
			}
		</script>
<?php
		}
	}
	
?>
