<?php
	//print_r($_POST);
	//print_r($_FILES);
	
	$cid=$_GET['cid'];
	$msg='';
	if(isset($_POST['name']))
	{
		$cid=$_POST['cid']; 
		$name=$_POST['name'];
		$price=$_POST['price'];
		$qty=$_POST['qty'];
		$desc=$_POST['desc'];
		$detail=$_POST['detail'];
		$note=$_POST['note'];
		$active=$_POST['active'];
		
		//Xu ly file
		$file=$_FILES['img_url'];
		if($file['name']!='')//Neu co submit file
		{
			//Kiem tra co phai la file anh khong
			if(strpos($file['type'],'image/')===false)
				$msg='File không phải là ảnh, Hãy cập nhật lại file ảnh';
			else//File là ảnh
			{
			
			
				$img_url=rand().$file['name'];//Lay ten file
				//Copy file tu thu muc temp -> thu muc chua anh sp
				copy($file['tmp_name'],'images/sanpham/'.$img_url);
			}
		}
		
		
		//insert vao DB
		$sql="insert into `nn_product` values(NULL,'$cid','$name','$price','$desc','$detail','$img_url',now(),'$qty','$note','0','0','$active')";
		mysqli_query($link,$sql);
		//Chuyen trang
		//header('location:?mod=pro');
?>
	<script>
	setTimeout("window.location='?mod=pro&cid=<?php echo $cid ?>'",1000);
	</script>
<?php

	}
?>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="400" border="1">
    <caption>
      THÊM  SẢN PHẨM<br />
	  
    </caption>
    <tr>
      <th scope="row">Loại</th>
      <td>
      <select id="cid" name="cid">
    <?php
		$cid=$_GET['cid'];
		//Lay cac chung loai
		$sql='select `id`,`name` from `nn_department` order by `order`';
		$rs=mysqli_query($link,$sql);
		while($r=mysqli_fetch_assoc($rs))
		{
	?>
            <optgroup label="<?php echo $r['name']?>">
            <?php
				//Lay cac loai sp tuong ung
				$sql='select `id`,`name` from `nn_category` where `department_id`='.$r['id'];
				$rsCate=mysqli_query($link,$sql);
				while($r=mysqli_fetch_assoc($rsCate))
				{
			?>
                	<option <?php if($r['id']==$cid) echo 'selected' ?> value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
            <?php
				}
			?>
            </optgroup>
    <?php
		}
	?>
    </select>
      </td>
    </tr>
    <tr>
      <th width="177" scope="row">Tên</th>
      <td width="407"><input type="text" name="name" id="name" /></td>
    </tr>
    <tr>
      <th scope="row">Giá</th>
      <td><input type="text" name="price" id="price" /></td>
    </tr>
    <tr>
      <th scope="row">Số lượng</th>
      <td><input type="number" name="qty" id="qty" /></td>
    </tr>
    <tr>
      <th scope="row">Hình</th>
      <td><input type="file" name="img_url" id="img_url" /></td>
    </tr>
    <tr>
      <th scope="row">Mô tả</th>
      <td><textarea name="desc" id="desc"></textarea></td>
    </tr>
    <tr>
      <th scope="row">Chi tiết</th>
      <td><textarea name="detail" id="detail"></textarea></td>
    </tr>
    <tr>
      <th scope="row">Ghi chú</th>
      <td><textarea name="note" id="note"></textarea></td>
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
<p class="success" align="center"><?php echo $msg ?></p>
