<?php
	$id=$_GET['id'];
	$idUser=$_SESSION['id'];
	
	//update status
	$sql="update `nn_order` set `status`=-1 where `status`=0 AND `user_id`=$idUser AND `id`=$id";
	mysqli_query($link,$sql);
	
	//Chuyen den trang account
	header('location:?mod=account');
?>