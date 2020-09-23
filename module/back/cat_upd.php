<?php
	//print_r($_POST);
	$id=$_GET['id'];
	
	$sql='select * from `nn_category` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
	if(isset($_POST['name']))
	{
		$department_id=$_POST['department_id'];
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=$_POST['active'];
		
		//update DB
		$sql="update `nn_category` set
		`department_id`='$department_id',
		`name`='$name',
		`order`='$order',
		`active`='$active'
		WHERE `id`=$id";
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=cat');
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="400" border="1">
    <caption>
      CẬP NHẬT LOẠI SẢN PHẨM
    </caption>
    <tr>
      <th scope="row">Chủng loại</th>
      <td><select name="department_id" id="department_id">
      <?php
	  		//Lay danh sach cac chung loai hien co
			$sql='select `id`,`name` from `nn_department` order by `order` ';
			$rs=mysqli_query($link,$sql);
			while($rD=mysqli_fetch_assoc($rs))
			{
	  ?>
        		<option <?php if($r['department_id']==$rD['id']) echo 'selected' ?> value="<?php echo $rD['id']?>"><?php echo $rD['name']?></option>
      <?php
			}
	  ?>
      </select></td>
    </tr>
    <tr>
      <th width="177" scope="row">Tên</th>
      <td width="407"><input type="text" name="name" id="name" value="<?php echo $r['name'] ?>" /></td>
    </tr>
    <tr>
      <th scope="row">Thứ tự</th>
      <td><input type="number" name="order" id="order" value="<?php echo $r['order'] ?>"  /></td>
    </tr>
    <tr>
      <th scope="row">Hiển thị</th>
      <td>
      <select name="active" id="active">
        <option <?php if($r['active']==1) echo 'selected' ?> value="1">Hiện</option>
        <option <?php if($r['active']==0) echo 'selected' ?> value="0">Ẩn</option>
      </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" scope="row"><button type="submit">Cập nhật</button></td>
    </tr>
  </table>
</form>
