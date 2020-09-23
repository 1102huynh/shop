<?php
	//print_r($_POST);
	$id=$_GET['id'];
	
	//Xoa khoi DB
	$sql='delete from `nn_department` where `id`='.$id;
	mysqli_query($link,$sql);
	
	//Chuyen den trang dep
	header('location:?mod=dep');
?>