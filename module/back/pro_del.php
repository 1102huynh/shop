<?php
	//print_r($_POST);
	$id=$_GET['id'];
	
	//Truy van lay file anh (neu co)
	$sql='select `img_url`,`category_id` from `nn_product` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
	//Xoa file anh 
	if(is_file('images/sanpham/'.$r['img_url']))unlink('images/sanpham/'.$r['img_url']);
	
	//Xoa san pham khoi DB
	$sql='delete from `nn_product` where `id`='.$id;
	mysqli_query($link,$sql);
	
	//Chuyen den trang dep
	header('location:?mod=pro&cid='.$r['category_id']);
?>