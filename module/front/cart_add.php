<?php
	//Lay tu session
	$cart=$_SESSION['cart'];
	
	//Thêm
	$id=$_GET['id'];
	$cart[$id]++;
	
	//Xoa
	unset($cart[$id]);
	
	//Dua len session
	$_SESSION['cart']=$cart;
	
	//Chuyen den trang gio hang
	header('location:?mod=cart');
?>