<?php
	//print_r($_POST);
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=$_POST['active'];
		
		//insert vao DB
		$sql="insert into `nn_department` values(NULL,'$name','$order','$active')";
		mysqli_query($link,$sql);
		
		//Chuyen den trang chung loai
		header('location:?mod=dep');
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="400" border="1">
    <caption>
      THÊM CHỦNG LOẠI
    </caption>
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
