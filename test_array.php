<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php

	function print_array($a)
	{
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}
	//$a=5;
	//$b=2;
	//$c=10;
	//if($a<=$b && $b<=$c)echo "$a,$b,$c";
	
	//Moi phần tử của mảng là key => value
	
	//Key gan tu dong
	$a=array(2,7,10,-6.5,2,'Hello',200.2);
	
	/*//Key tu gan thu cong
	$b=array(3=>10,4=>5.6,4=>7,'Hello',100);
	
	//Truy xuat
	print_r($b);//Xem tat ca
	
	echo $a[2];//get,10
	
	print_array($a);
	$a[3]=9.5;//set,[3]=>9.5
	print_array($a);
	
	
	//Thêm phần tử
	$b[50]=7;//key trùng => update, ngược lại add
	$b[]='Hello world';
	print_array($b);
	
	//Xóa phần từ
	unset($b[6]);
	print_array($b);*/
	
	//Duyet mang
	$b=array(3=>10,4=>5.6,4=>7,'Hello',100);
	print_array($a);
	
	//Danh cho mang key gan tu dong
	$n=count($a);//Dem so phan tu cua mang
	for($i=0;$i<$n;$i++)
	echo $a[$i],'<br>';
	
	//Danh cho moi mang
	foreach($b as $k=>$v)
	echo $v,'<hr>';

	//Mảng nhiều chiều
	$c=array(array(1,2,3),array(4,5,6));
	
	echo $c[0][1];//2
	echo $c[1][2];//6
	
	foreach($c as $k=>$v)
	{
		foreach($v as $k2=>$v2)
		echo $v2,'<br>';
		
	}

?>
</body>
</html>