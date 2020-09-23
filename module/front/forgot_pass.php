<?php
$msg='Nhập email để nhận link reset mật khẩu.';
if(isset($_POST['email']))
{
	$email=mysqli_real_escape_string($link,$_POST['email']);
	
	//Kiểm tra email có trong hệ thống hay không 
	$sql="select `id`,`name` from `nn_user` where `email`='$email'";
	$rs=mysqli_query($link,$sql);
	if(mysqli_num_rows($rs)==0)
		$msg='Email không tồn tại trong hệ thống';
	else
	{
		//Lấy thông tin user
		$r=mysqli_fetch_assoc($rs);
		$id=$r['id'];
		$name=$r['name'];
		//Tạo link reset
		
		//Tạo code ngẫu nhiên
		$code=genCode(8);
				
		//echo $code;
		//Cập nhật code cho user
		//$sql="update `nn_user` set `code`='$code' where `id`=$id";
		//mysqli_query($link,$sql);
		
		//Tạo chữ ký cho link (tránh giả mạo)
		$secret='faceshop@123#com';
		$hash=sha1($id.$code.$secret);
		
		$link="http://localhost/shop/?mod=reset&id={$id}&code={$code}&hash={$hash}";
		
		
		//Gửi link reset password vào email
		$from='info@faceshop.com';
		$to=$email;
		$subject='FaceShop - Link reset mật khẩu';
		$message="Xin chào <b>{$name}</b><br>
		Bạn nhấn vào <a target='_blank' href='{$link}'>link sau</a> để reset lại mật khẩu<br>
		Good luck !";
		
		if(mailer($from,$to,$subject,$message))
			$msg='Link reset mật khẩu đã được gửi vào email của bạn';
		else
			$msg='Gửi mail không thành công. Hãy liên hệ với quản trị website';
		
	}
}
?>
<h2 class="heading colr">Forgot password</h2>
<div class="login">
    <div class="registrd">
      <p class="error"><?php echo $msg ?></p>
        <form action="" method="post" id="login">
        <ul class="forms">
            <li class="txt">Email Address <span class="req">*</span></li>
            <li class="inputfield"><input type="text" name="email" class="bar" required ></li>
        </ul>
        <ul class="forms">
          <li class="txt">&nbsp;</li>
            <li><a href="javascript:document.getElementById('sm').click()" class="simplebtn"><span>Reset</span></a> <input type="submit" style="width:0;height:0;border:none" value="Login" id="sm"> <a href="#" class="forgot">Forgot Your Password?</a></li>
        </ul>
        </form>
    </div>    
</div>
<div class="clear"></div>