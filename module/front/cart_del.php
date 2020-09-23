<?php
	//Lay tu session
	$cart=$_SESSION['cart'];
	
	//Xóa
	$id=$_GET['id'];
	unset($cart[$id]);
	
	//Dua len session
	$_SESSION['cart']=$cart;
	
	//Chuyen den trang gio hang
	header('location:?mod=cart');
?>