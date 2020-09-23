<?php
	$msg='';
	if(isset($_POST['name']))//Neu nguoi dung da submit
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		$mobile=$_POST['mobile'];		
		$captcha=$_POST['captcha'];
		
		if($captcha!=$_SESSION['captcha'])
			$msg='Chuỗi bảo mật nhập không đúng';
		elseif(strlen($pass)<6)
			$msg='Mật khẩu tối thiểu 6 ký tự';
		elseif($pass!=$repass)
			$msg='Mật khẩu nhập lại không khớp';
		else		
		{
			echo $sql="INSERT INTO `nn_user`(`password`, `email`, `name`, `mobile`) VALUES (sha1('$pass'),'$email','$name','$mobile')";
			$rs=mysqli_query($link,$sql);
			if(!$rs)//Không thành công
				$msg='Thêm tài khoản không thành công. Email bị trùng';
			else
				$msg='Thêm tài khoản thành công. Hệ thống sẽ chuyển đến trang đang nhập...<script>redirect("?mod=login")</script>';		
		}
	}
?>
<script>
	function redirect(url,delay=3000)
	{
		setTimeout("window.location='"+url+"'",delay);
	}
</script>

<h2 class="heading colr">Registration</h2>
<div class="login">
    <div class="registrd">
        <h3>Please Sign up</h3>
        <p class="error"><?php echo $msg ?></p>
        <form action="" method="post" id="register">
          <ul class="forms">
            <li class="txt">Name<span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="name" class="bar" required="required" id="name" />
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Email <span class="req">*</span></li>
            <li class="inputfield">
              <input type="email" onblur="callAjax()" name="email" class="bar" required="required" id="email" />
              <div id="msg" class="error"></div>
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Password <span class="req">*</span></li>
            <li class="inputfield">
              <input type="password" name="pass" class="bar" required="required" />
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Retype Password <span class="req">*</span></li>
            <li class="inputfield">
              <input type="password" name="repass" class="bar" required="required" id="repass" />
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Mobile <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="mobile" class="bar" required="required" id="mobile" />
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Captcha <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="captcha" style="width:100px" class="bar" required="required" id="captcha" /><img src="lib/captcha.php" id="img_captcha" alt="captcha" style="vertical-align:middle"  /><img onclick="document.getElementById('img_captcha').src='lib/captcha.php?ran='+Math.random()" src="images/refresh.png" alt="refresh" style="vertical-align:middle"  />
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">&nbsp;</li>
            <li><a href="javascript:document.getElementById('sm').click()" class="simplebtn"><span>Register</span></a> <input type="submit" style="width:0;height:0;border:none" value="Register" id="sm">
            </li>
        </ul>
        </form>
    </div>
    
</div>
<div class="clear"></div>
<script>
function callAjax()
{
	//alert('ok');
	$.ajax({
		url:'ajax.php',
		type:'GET',
		data:{email:$('#email').val()},
		success:function(data){
			//alert(data);			
		}
	})
	.done(function(data){
		$('#msg').html(data);
	});
}
</script>