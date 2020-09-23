<?php
	//Neu chua dang nhap --> trang dang nhap
	if(!isset($_SESSION['id']))header('location:?mod=login');
	
	//Neu da dang nhap
	$id=$_SESSION['id'];
	
	if(isset($_POST['name']))
	{
		
		//insert vao bang order (cha)
		$name=$_POST['name'];
		$mobile=$_POST['mobile'];
		$email=$_POST['email'];
		$dos=$_POST['dos'];
		//Chuyen dd-mm-yyyy => yyyy-mm-dd
		$dos=date('Y-m-d',strtotime($dos));
		
		$address=$_POST['address'];
		$note=$_POST['note'];
		
		$sql="insert into `nn_order` values(NULL,$id,now(),'$name','$address','$dos','$email','$mobile','$note',0)";
		
		mysqli_query($link,$sql);
		
		//insert vao bang order_detail (con)
		$order_id=mysqli_insert_id($link);
		$cart=$_SESSION['cart'];
		foreach($cart as $k=>$v)
		{
			//Truy van lay gia
			$sql='select `price` from `nn_product` where `id`='.$k;
			$rs=mysqli_query($link,$sql);
			$r=mysqli_fetch_assoc($rs);
			$price=$r['price'];
			
			//insert 
			$sql="insert into `nn_order_detail` values('$order_id','$k','$v','$price')";
			mysqli_query($link,$sql);
		}
?>
		<script>
		$(document).ready(function(){
			alert('Bạn đã đặt hàng thành công');
			window.location='?mod=account';
		});
		</script>   
<?php
	}//endif
	
?>      
   
            <h2 class="heading colr">CHECKOUT</h2>
            <div class="shoppingcart">
            <ul class="tablehead">
                <li class="remove colr">No</li>
                <li class="thumb colr">&nbsp;</li>
                <li class="title colr">Product Name</li>
                <li class="price colr">Unit Price</li>
                <li class="qty colr">QTY</li>
                <li class="total colr">Sub Total</li>
            </ul>
           
            <?php
                //$cart=array(2=>3,400=>2,150=>1);
                $cart=$_SESSION['cart'];
                $s=0;
                $i=1;
                if(count($cart)>0)foreach($cart as $k=>$v)
                {
                    $sql='select `name`,`img_url`,`price` from `nn_product` where `id`='.$k;
                    $rs=mysqli_query($link,$sql);
                    $r=mysqli_fetch_assoc($rs);
                    $s=$s+$r['price']*$v;
            ?>
                <ul class="cartlist <?php if($i%2==1) echo 'gray' ?>">
                    <li class="remove txt"><?php echo $i++; ?></li>
                    <li class="thumb"><a href="detail.html"><img src="images/sanpham/<?php echo $r['img_url']?>" alt="" ></a></li>
                    <li class="title txt"><a href="detail.html"><?php echo $r['name']?></a></li>
                    <li class="price txt"><?php echo number_format($r['price'])?></li>
                  <li class="qty txt"><?php echo $v?></li>
                    <li class="total txt"><?php echo number_format($r['price']*$v)?></li>
                </ul>
            <?php
                }
            ?>
            <div class="clear"></div>
            <div class="subtotal">
                
                <h3 class="colr"><?php echo number_format($s)?></h3>
            </div>
            <div class="clear"></div>
            
       <h2 class="heading colr">SHIP'S INFO</h2>
       <?php
            //Lay thong tin user
            $sql='select * from `nn_user` where `id`='.$id;
            $rs=mysqli_query($link,$sql);
            $r=mysqli_fetch_assoc($rs);
       ?>
            <form action="" method="post" id="checkout">
      <ul class="forms">
        <li class="txt">Name<span class="req">*</span></li>
        <li class="inputfield">
          <input type="text" name="name" class="bar" required="required" value="<?php echo $r['name']?>" id="name">
        </li>
      </ul>
      <ul class="forms">
        <li class="txt">Email<span class="req">*</span></li>
        <li class="inputfield">
          <input type="text" name="email" class="bar"  value="<?php echo $r['email']?>" required="required" id="email" />
        </li>
      </ul>
      <ul class="forms">
        <li class="txt">Mobile <span class="req">*</span></li>
        <li class="inputfield">
          <input type="text" name="mobile" class="bar"  value="<?php echo $r['mobile']?>" required="required" id="mobile" />
        </li>
      </ul>
      <ul class="forms">
        <li class="txt">Shipping date<span class="req">*</span></li>
        <li class="inputfield">
          <input type="text" name="dos" readonly value="<?php echo date('d-m-Y',time()+2*24*3600);?>" class="bar" required="required" id="dos">
        </li>
      </ul>
      <ul class="forms">
        <li class="txt">Address <span class="req">*</span></li>
        <li class="textfield">
          <textarea name="address" required="required" class="bar" id="address"><?php echo $r['address'] ?></textarea>
        </li>
      </ul>
      <ul class="forms">
        <li class="txt">Note <span class="req">*</span></li>
        <li class="textfield">
          <textarea name="note" required="required" class="bar" id="note"></textarea>
        </li>
      </ul>
            </form>
        </div>
        <div class="clear"></div>
        <a href="?mod=cart" class="simplebtn"><span>Update</span></a>
        <a href="javascript:void(0)" onclick="$('#name,#address,#mobile,#email').val('')" class="simplebtn"><span>Clear all</span></a>
        <a href="javascript:void(0)" onclick="document.getElementById('checkout').reset()" class="simplebtn"><span>Reset</span></a>        
        <a href="javascript:void(0)" onclick="document.getElementById('checkout').submit()" class="simplebtn"><span>Checkout</span></a>
        
        
<link href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script>
	$('#dos').datepicker({
		dateFormat:'dd-mm-yy',
	});
</script>