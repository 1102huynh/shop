<?php
	//print_r($_POST);
	$id=$_GET['id'];//category_id
	
	//Xoa tat ca san pham thuoc category nay
	
	//Truy van lay hinh cua tat ca san pham thuoc loai can xoa
	$sql='select `img_url` from `nn_product` where `category_id`='.$id;
	$rs=mysqli_query($link,$sql);
	while($r=mysqli_fetch_assoc($rs))
	{				
		//Xoa file anh 
		if(is_file('images/sanpham/'.$r['img_url']))unlink('images/sanpham/'.$r['img_url']);
	}
	
	//Xoa tat ca san pham thuoc category khoi DB
	$sql='delete from `nn_product` where `category_id`='.$id;
	mysqli_query($link,$sql);

	
	//Xoa category khoi DB
	$sql='delete from `nn_category` where `id`='.$id;
	mysqli_query($link,$sql);
	
	//Chuyen den trang dep
	header('location:?mod=cat');
?>