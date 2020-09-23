<?php
	require('lib/db.php');
	//print_r($_GET);
	//print_r($_POST);
	$email=mysqli_real_escape_string($link,$_GET['email']);
	
	if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
		echo '<img src="images/deny.png" alt="deny" height="12" align="absmiddle" > Email không hợp lệ';
	else
	{
	
		$sql="select 1 from `nn_user` where `email`='$email'";
		$rs=mysqli_query($link,$sql);
		if(mysqli_num_rows($rs)==0) 
			echo '<img src="images/accept.png" alt="accept" height="12" align="absmiddle" > Bạn có thể đăng ký bằng email này';
		else
			echo '<img src="images/deny.png" alt="deny" height="12" align="absmiddle" > Email này đã tồn tại trong hệ thống'; 
	}
	
?>
