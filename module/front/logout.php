<?php
	//Huy cac SESSION
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	//Chuyen ve trang dang nhap
	header('location:?mod=login');
?>