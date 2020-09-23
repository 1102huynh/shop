<?php
	//print_r($_POST);
	//print_r($_FILES);
	
	$id=$_GET['id'];
	//Lay thong tin hien tai
	$sql='select * from `nn_product` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$rProduct=mysqli_fetch_assoc($rs);
	
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
		
		$img_url=$rProduct['img_url'];//file cũ
		
		//Xu ly file
		$file=$_FILES['img_url'];
		if($file['name']!='')//Neu co submit file -> thay ảnh
		{
			//Kiem tra co phai la file anh khong
			if(strpos($file['type'],'image/')===false)
				$msg='File không phải là ảnh, Hãy cập nhật lại file ảnh';
			else//File là ảnh
			{
				//Xóa file ảnh cũ (nếu có)
				if(is_file('images/sanpham/'.$img_url))
				unlink('images/sanpham/'.$img_url); 
				//Thêm file ảnh mới
				$img_url=rand().$file['name'];//Lay ten file
				//Copy file tu thu muc temp -> thu muc chua anh sp
				copy($file['tmp_name'],'images/sanpham/'.$img_url);
			}
		}
		
		
		//update DB
		$sql="update `nn_product` set 
		`category_id`='$cid',
		`name`='$name',
		`price`='$price',
		`desc`='$desc',
		`detail`='$detail',
		`img_url`='$img_url',
		`qty`='$qty',
		`note`='$note',
		`active`='$active'
		WHERE `id`=$id";
		
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

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/ckfinder/ckfinder.js"></script>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="100%" border="1">
    <caption>
      CẬP NHẬT SẢN PHẨM<br />
	  
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
                	<option <?php if($r['id']==$rProduct['category_id']) echo 'selected' ?> value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
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
      <th width="116" scope="row">Tên</th>
      <td width="897"><input type="text" name="name" id="name" value="<?php echo $rProduct['name'] ?>" /></td>
    </tr>
    <tr>
      <th scope="row">Giá</th>
      <td><input type="text" name="price" id="price" value="<?php echo $rProduct['price'] ?>"  /></td>
    </tr>
    <tr>
      <th scope="row">Số lượng</th>
      <td><input type="number" name="qty" id="qty" value="<?php echo $rProduct['qty'] ?>"  /></td>
    </tr>
    <tr>
      <th scope="row">Hình</th>
      <td>
      <img src="images/sanpham/<?php echo $rProduct['img_url'] ?>" alt="desc" height="100" /><br />
      <input type="file" name="img_url" id="img_url" /><br />
      <i>(Để trống nếu không muốn cập nhật lại hình)</i>
      </td>
    </tr>
    <tr>
      <th scope="row">Mô tả</th>
      <td><textarea class="ckeditor" name="desc" id="desc"><?php echo $rProduct['desc'] ?></textarea></td>
    </tr>
    <tr>
      <th scope="row">Chi tiết</th>
      <td><textarea name="detail" id="detail"><?php echo $rProduct['detail'] ?></textarea></td>
    </tr>
    <tr>
      <th scope="row">Ghi chú</th>
      <td><textarea name="note" id="note"><?php echo $rProduct['note'] ?></textarea></td>
    </tr>
    <tr>
      <th scope="row">Hiển thị</th>
      <td>
      <select name="active" id="active">
        <option value="1" <?php if(1==$rProduct['active']) echo 'selected' ?>>Hiện</option>
        <option value="0" <?php if(0==$rProduct['active']) echo 'selected' ?>>Ẩn</option>
      </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" scope="row"><button type="submit">Cập nhật</button></td>
    </tr>
  </table>
</form>
<p class="success" align="center"><?php echo $msg ?></p>
<script>
	var detail=CKEDITOR.replace('detail',{
		uiColor: '#14B8C4',
		language: 'vi',
	});
	//Gan CKFinder
	CKFinder.setupCKEditor(detail,'js/ckfinder/');
</script>