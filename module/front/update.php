<?php
	//Neu chua dang nhap --> trang dang nhap
	if(!isset($_SESSION['id']))header('location:?mod=login');
	
	//Neu da dang nhap
	$id=$_SESSION['id'];

	$msg='';
	if(isset($_POST['name']))//Neu nguoi dung da submit
	{
		$name=$_POST['name'];
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		$mobile=$_POST['mobile'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		//convert dob tu dd/mm/yyyy -> yyyy-mm-dd
		$d=substr($dob,0,2);
		$m=substr($dob,3,2);
		$y=substr($dob,6,4);
		$dob="$y-$m-$d";
		
		$address=$_POST['address'];
	
		if($pass!='' && strlen($pass)<6)
			$msg='Mật khẩu tối thiểu 6 ký tự';
		elseif($pass!=$repass)
			$msg='Mật khẩu nhập lại không khớp';
		else		
		{
			if($pass!='')
				echo $sql="UPDATE `nn_user` SET 
				`password`=sha1('$pass'),
				`name`='$name',
				`mobile`='$mobile',
				`gender`='$gender',
				`dob`='$dob',
				`address`='$address'
				WHERE `id`=$id";
			
			else
				echo $sql="UPDATE `nn_user` SET 
				`name`='$name',
				`mobile`='$mobile',
				`gender`='$gender',
				`dob`='$dob',
				`address`='$address'
				WHERE `id`=$id";
			
			$rs=mysqli_query($link,$sql);
			if(!$rs)//Không thành công
				$msg='Cập nhật tài khoản không thành công.';
			else
				$msg='Cập nhật tài khoản thành công.';
		}
	}
	
	//Lay thong tin user
	$sql='select * from `nn_user` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
?>
<h2 class="heading colr">Update</h2>
<div class="login">
    <div class="registrd">       
        <p class="error"><?php echo $msg ?></p>
        <form action="" method="post" id="register" onsubmit="return checkData();" novalidate>
          <ul class="forms">
            <li class="txt">Name<span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="name" class="bar" required="required" value="<?php echo $r['name']?>" id="name">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Password <span class="req">*</span></li>
            <li class="inputfield">
              <input type="password" id="pass" name="pass" class="bar" placeholder="Để trống nếu không muốn thay đổi">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Retype Password <span class="req">*</span></li>
            <li class="inputfield">
              <input type="password" name="repass" class="bar" id="repass">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Mobile <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="mobile" class="bar"  value="<?php echo $r['mobile']?>" required="required" id="mobile">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Gender <span class="req">*</span></li>
            <li>
            	<label>
              		<input type="radio" name="gender" value="1" <?php if($r['gender']==1) echo 'checked' ?>> Nam
              	</label><br><br>
              	<label>
              		<input type="radio" name="gender" value="0" <?php if($r['gender']==0) echo 'checked' ?>> Nữ
              	</label>
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">DOB <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="dob" readonly value="<?php echo date('d/m/Y',strtotime($r['dob']));?>" class="bar" required="required" id="dob">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Address <span class="req">*</span></li>
            <li class="textfield">
              <textarea name="address" required="required" class="bar" id="address"><?php echo $r['address'] ?></textarea>
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">&nbsp;</li>
            <li><a href="javascript:document.getElementById('sm').click()" class="simplebtn"><span>Cập nhật</span></a> <input type="submit" style="width:0;height:0;border:none" value="Register" id="sm">
            </li>
        </ul>
        </form>
    </div>
    
</div>
<div class="clear"></div>
<link href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script>
	$('#dob').datepicker({
		dateFormat:'dd/mm/yy',
		changeMonth:true,
		changeYear:true,
		yearRange:'-99:+0',
	});
	
	//Ham kiem du lieu trong form
	function checkData()
	{
		
		//Xoa tat ca cac thong bao loi (truoc day)
		$('#register div.error').remove();
		
		if($('#name').val()=='')
		{
			//alert('Bạn phải nhập họ tên');
			$('#name').parent().append('<div class="error">Bạn phải nhập họ tên</div>');
			$('#name').focus();
			//Khong cho submit
			return false;
		}
		if($('#pass').val()!='' && $('#pass').val().length<6)
		{
			//alert('Mật khẩu tối thiểu 6 ký tự');
			$('#pass').parent().append('<div class="error">Bạn phải nhập họ tên</div>');
			$('#pass').focus();
			return false;
		}
		if($('#pass').val()!=$('#repass').val())
		{
			alert('Mật khẩu nhập lại không khớp');
			$('#repass').select();
			return false;
		}
		if(isNaN($('#mobile').val()))
		{
			alert('Điện thoại chỉ được nhập số');
			$('#mobile').focus();
			return false;
		}
	}
</script>
