<?php
	//print_r($_POST);
	if(isset($_POST['name']))
	{
		$department_id=$_POST['department_id'];
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=$_POST['active'];
		
		//insert vao DB
		$sql="insert into `nn_category` values(NULL,'$department_id','$name','$order','$active')";
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=cat');
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="400" border="1">
    <caption>
      THÊM LOẠI SẢN PHẨM
    </caption>
    <tr>
      <th scope="row">Chủng loại</th>
      <td><select name="department_id" id="department_id">
      <?php
	  		//Lay danh sach cac chung loai hien co
			$sql='select `id`,`name` from `nn_department` order by `order` ';
			$rs=mysqli_query($link,$sql);
			while($r=mysqli_fetch_assoc($rs))
			{
	  ?>
        		<option value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
      <?php
			}
	  ?>
      </select></td>
    </tr>
    <tr>
      <th width="177" scope="row">Tên</th>
      <td width="407"><input type="text" name="name" id="name" /></td>
    </tr>
    <tr>
      <th scope="row">Thứ tự</th>
      <td><input type="number" name="order" id="order" /></td>
    </tr>
    <tr>
      <th scope="row">Hiển thị</th>
      <td>
      <select name="active" id="active">
        <option value="1">Hiện</option>
        <option value="0">Ẩn</option>
      </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" scope="row"><button type="submit">Thêm</button></td>
    </tr>
  </table>
</form>
