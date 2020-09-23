<?php
	//Huy cac SESSION
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin_name']);
	//Chuyen ve trang dang nhap
	header('location:?mod=login');
?>