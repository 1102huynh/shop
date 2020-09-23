<?php
	//Lay tu session
	$cart=$_SESSION['cart'];
	$act=$_GET['act'];//1: Thêm, 2: Sửa, 3: Xóa
	
	$id=$_GET['id'];
	
	//Thêm
	if($act==1)
	{	
		$qty=max(1,intval($_GET['qty']));
		$cart[$id]+=$qty;
	}
	
	//Sua
	if($act==2)
	{
		//print_r($cart);
		//print_r($_POST);
		//$cart=$_POST;
		foreach($cart as $k=>$v)
		$cart[$k]=max(1,intval($_POST[$k]));
	}
	
	
	//Xoa
	if($act==3)
	unset($cart[$id]);
	
	//Dua len session
	$_SESSION['cart']=$cart;
	
	//Chuyen den trang gio hang
	header('location:?mod=cart');
?>