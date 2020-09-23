<?php
	//print_r($_POST);
	$id=$_GET['id'];
	
	//Lay thong tin hien tai	
	$sql='select * from `nn_department` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
	
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=$_POST['active'];
		
		//update vao DB
		$sql="update `nn_department` set 
			`name`='$name',
			`order`='$order',
			`active`='$active'
			Where `id`=$id";
			
		mysqli_query($link,$sql);
		
		//Chuyen den trang chung loai
		header('location:?mod=dep');
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="400" border="1">
    <caption>
     CẬP NHẬT CHỦNG LOẠI
    </caption>
    <tr>
      <th width="177" scope="row">Tên</th>
      <td width="407"><input type="text" name="name" id="name" value="<?php echo $r['name'] ?>" /></td>
    </tr>
    <tr>
      <th scope="row">Thứ tự</th>
      <td><input type="number" name="order" id="order" value="<?php echo $r['order']?>" /></td>
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
