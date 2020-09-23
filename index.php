<?php
	session_start();//su dung truoc khi dung $_SESSION[...]
	ob_start();//cache output, tranh loi khi dung header(...)
	require('lib/db.php');
	include('lib/function.php');
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Estore 16</title>
<!-- // Stylesheets // -->
<link rel="stylesheet" href="css/style.css" type="text/css" >
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" >
<link rel="stylesheet" href="css/default.advanced.css" type="text/css" >
<link rel="stylesheet" href="css/contentslider.css" type="text/css"  >
<link rel="stylesheet" href="css/jquery.fancybox-1.3.1.css" type="text/css" media="screen" >
<!-- // Javascript // -->
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script>
<script type="text/javascript" src="js/scroll.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/acordn.js"></script>
<script type="text/javascript" src="js/contentslider.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
</head>

<body>
<a name="top"></a>
<div id="wrapper_sec">
	<!-- Header -->
	<div id="masthead">
    	<div class="secnd_navi">
        	<ul class="links">
            	<li>
				<?php
				 	//$sql='select `name` from `nn_user` where `id`='.$_SESSION['id'];
					//$rs=mysqli_query($link,$sql);
					//$r=mysqli_fetch_assoc($rs);
					//echo 'Xin chào ',$r['name'];
					if(isset($_SESSION['name']))//Da dang nhap
						echo 'Xin chào ',$_SESSION['name'];
				 ?>
                 </li>
                <li><a href="?mod=account">Tài khoản</a></li>
                <li><a href="#">My Wishlist</a></li>
                <li><a href="?mod=cart">Giỏ hàng</a></li>
                <li><a href="#">Checkout</a></li>
                <li class="last">
                	<?php 
						if(isset($_SESSION['id']))
							echo ' <a href="?mod=logout">Đăng xuất</a>';
						else
							echo '<a href="?mod=login">Đăng nhập</a>';
					?>             	

                </li>
            </ul>
            <ul class="network">
            	<li>Share with us:</li>
                <li><a href="#"><img src="images/linkdin.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/rss.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/twitter.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/facebook.gif" alt="" ></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    	<div class="logo">
        	<a href="index.html"><img src="images/logo.png" alt="" ></a>
            <h5 class="slogn">The best watches for all</h5>
        </div>
        <ul class="search">
        	<li>
            <form action="?mod=search" method="post">
            	<input type="keyword" name="kw" placeholder="Nhập từ khóa" class="bar" >
            </form>
            </li>
            <li><a href="#" class="searchbtn">Search for Products</a></li>
        </ul>
        <div class="clear"></div>
        <div class="navigation">
            <ul id="nav" class="dropdown dropdown-linear dropdown-columnar">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="static.html">Giới thiệu</a></li>
                <li class="dir"><a href="#">Sản phẩm</a>
                    <ul class="bordergr big">
                    <?php
						$sql='SELECT `id`,`name` FROM `nn_department` WHERE `active`=1 order by `order`';
						$rs=mysqli_query($link,$sql);
						while($r=mysqli_fetch_assoc($rs))
						{
					?>
                        <li class="dir"><span class="colr navihead bold"><?php echo $r['name']?></span>
                            <ul>
                            <?php
								$sql2='select `id`,`name` from `nn_category` where department_id='.$r['id'].' and `active`=1 order by `order`';
								$rs2=mysqli_query($link,$sql2);
								while($r2=mysqli_fetch_assoc($rs2))
								{
							?>
                               	 	<li><a href="?mod=product&cid=<?php echo $r2['id']?>"><?php echo $r2['name']?></a></li>
                            <?php
								}
							?>   
                            </ul>
                        </li>
                    <?php
						}
					?>                       
                    </ul>
                </li>
                <li><a href="login.html">BedSheets</a></li>
                <li class="dir"><a href="#">Pages</a>
                    <ul class="bordergr small">
                        <li class="dir"><span class="colr navihead bold">Pages</span>
                            <ul>
                                <li class="clear"><a href="index.html">Home Page</a></li>
                                <li class="clear"><a href="account.html">Account Page</a></li>
                                <li class="clear"><a href="cart.html">Shopping Cart Page</a></li>
                                <li class="clear"><a href="categories.html">Categories</a></li>
                                <li class="clear"><a href="detail.html">Product Detail Page</a></li>
                                <li class="clear"><a href="listing.html">Listing Page</a></li>
                                <li class="clear"><a href="login.html">Login Page</a></li>
                                <li class="clear"><a href="static.html">Static Page</a></li>
                                <li class="clear"><a href="contact.html">Contact Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
                <li class="dir"><a href="#">Themes</a>
                    <ul class="bordergr small">
                        <li class="dir"><span class="colr navihead bold">Themes</span>
                            <ul>
                                <li class="clear"><a href="../blue/index.html">Blue</a></li>
                                <li class="clear"><a href="../green/index.html">Green</a></li>
                                <li class="clear"><a href="../orange/index.html">Orange</a></li>
                                <li class="clear"><a href="index.html">Purple</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="lang">
            	<li>Your Language:</li>
                <li><a href="#"><img src="images/flag1.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/flag2.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/flag3.gif" alt="" ></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!-- Banner Section -->
	<!--<div id="banner">
    	<div id="slider4" class="nivoSlider">
			<a href="detail.html"><img src="images/banner1.jpg" alt="" ></a>
			<a href="detail.html"><img src="images/banner2.jpg" alt="" ></a>
            <a href="detail.html"><img src="images/banner3.jpg" alt="" ></a>
            <a href="detail.html"><img src="images/banner4.jpg" alt="" ></a>
		</div>
        <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
		<script type="text/javascript" src="js/nivo.js"></script>
    </div>-->
    <div class="clear"></div>
    <!-- Scroolling Products -->
    <div class="content_sec">
    	<!-- Column2 Section -->
        <div class="col2">
        	<div class="col2_top">&nbsp;</div>
            <div class="col2_center">
            <?php
				$mod=@$_GET['mod'];
				if($mod=='')$mod='home';
				//Kiem soat $mod
				$mod=preg_replace('/[^a-z_]/','',$mod);//Regular Expression
				if(is_file("module/front/{$mod}.php"))
					include("module/front/{$mod}.php");
				else
					echo 'Đường dẫn không hợp lệ';
			?>
            </div>
            <div class="clear"></div>
            <div class="col2_botm">&nbsp;</div>
        </div>
        <!-- Column1 Section -->
    	<div class="col1">
        	<!-- Categories -->
                <div class="category">
                	<div class="col1center">
                    <div class="small_heading">
                        <h5>Categories</h5>
                    </div>
                    <div class="glossymenu">
                    <?php
						$sql='SELECT `id`,`name` FROM `nn_department` WHERE `active`=1 order by `order`';
						$rs=mysqli_query($link,$sql);
						while($r=mysqli_fetch_assoc($rs))
						{
					?>
                        <a class="menuitem submenuheader" href="#" ><?php echo $r['name']?></a>
                        <div class="submenu">
                            <ul>
                             <?php
								$sql2='select `id`,`name` from `nn_category` where department_id='.$r['id'].' and `active`=1 order by `order`';
								$rs2=mysqli_query($link,$sql2);
								while($r2=mysqli_fetch_assoc($rs2))
								{
							?>
                                <li><a href="?mod=product&cid=<?php echo $r2['id']?>"><?php echo $r2['name']?></a></li> 
                            <?php
								}
							?>                              
                            </ul>
                        </div>
                    <?php
						}
					?>                        
                    </div>
                    </div>
                    <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
                </div>
                <!-- My Cart Products -->
                <div class="mycart">
                	<div class="col1center">
                    <?php
						$cart=$_SESSION['cart'];
					?>
                    <div class="small_heading">
                        <h5>My Cart</h5>
                        <div class="clear"></div>
                        <span class="veiwitems">(<?php echo count($cart) ?>) Items - <a href="?mod=cart" class="colr">View Cart</a></span>
                    </div>
                    <ul>
                    <?php
						$s=0;
						if(count($cart))foreach($cart as $k=>$v)
						{
							$sql='select `name`,`price` from `nn_product` where `id`='.$k;
							$rs=mysqli_query($link,$sql);
							$r=mysqli_fetch_assoc($rs);
							
							$s+=$v*$r['price'];
					?>
                        <li>
                            <p class="bold title">
                                <a href="?mod=detail&id=<?php echo $k?>"><?php echo $r['name']?></a>
                            </p>
                            <div class="grey">
                                <p class="left">QTY: <span class="bold"><?php echo $v ?></span></p>
                                <p class="right">Price: <span class="bold"><?php echo number_format($r['price'])?></span></p>
                            </div>
                        </li>
                    <?php
						}
					?>
                        <!--<li>
                            <p class="bold title">
                                <a href="detail.html">Armani Tweed Blazer</a>
                            </p>
                            <div class="grey">
                                <p class="left">QTY: <span class="bold">3</span></p>
                                <p class="right">Price: <span class="bold">$200</span></p>
                            </div>
                        </li>
                        <li>
                            <p class="bold title">
                                <a href="detail.html">Armani Tweed Blazer</a>
                            </p>
                            <div class="grey">
                                <p class="left">QTY: <span class="bold">3</span></p>
                                <p class="right">Price: <span class="bold">$200</span></p>
                            </div>
                        </li>-->
                    </ul>
                    <p class="right bold sub">Sub total: <?php echo number_format($s)?></p>
                    <div class="clear"></div>
                    <a href="#" class="simplebtn right"><span>Checkout</span></a>
                    </div>
                    <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
                </div>
                <div class="poll">
                <div class="col1center">
            	<div class="small_heading">
            		<h5>Poll</h5>
                </div>
                <?php
					$sql='SELECT `id` , `content` FROM `nn_question` WHERE `active` =1';
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_assoc($rs);
				?>
                <p><?php echo $r['content'] ?></p>
                <form action="?mod=poll" method="post" id="poll">
                    <ul>
                    <?php
                        //Lay cac lua chon cua cau hoi
                        $sql='SELECT `id` , `content`
                        FROM `nn_answer`
                        WHERE `question_id` ='.$r['id'].'
                        ORDER BY `order` ';
                        $rs=mysqli_query($link,$sql);
                        while($r=mysqli_fetch_assoc($rs))
                        {
                    ?>
                        <li><label><input name="answer" type="radio" value="<?php echo $r['id']?>" > <?php echo $r['content']?></label></li>
                    <?php
                        }
                    ?>
                    </ul>
                </form>
                <a href="javascript:void(0)" onClick="document.getElementById('poll').submit()" class="simplebtn"><span>Vote</span></a>
                </div>
                <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
            </div>
            <div class="clear"></div>
            <div class="poll">
            <?php
				/*
					Xu ly so luot truy cap
				*/
				
				//Cap nhat so luot
				if(!isset($_SESSION['visit']))
				{
					$sql='update `nn_visit` set `cnt`=`cnt`+1';
					mysqli_query($link,$sql);
					
					$_SESSION['visit']=1;
				}
				
				//Lay gia tri
				$sql='select `cnt` from `nn_visit`';
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_assoc($rs);
				$visit=str_pad($r['cnt'],6,'0',STR_PAD_LEFT);
				
				/*
					Xu ly so luot online
				*/
				//Xoa cac user da timeout
				$timeout=1;//minutes
				$sql="delete from `nn_online` where unix_timestamp() - `last_access`>$timeout*60";
				mysqli_query($link,$sql);
				
				//insert hoac update vao DB				
				$id=session_id();
				$lastVisit=time();
				$user=$_SESSION['id'];
				
				//Neu key(id) da co => update (last_visit,user). Ngươc lai => insert
				$sql="replace into `nn_online` values('$id','$lastVisit','$user')";
				mysqli_query($link,$sql);
				
				//Dem so nguoi dang online
				$sql='select count(*) from `nn_online`';
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_row($rs);
				$online=str_pad($r[0],6,'0',STR_PAD_LEFT);
				
				//Dem so nguoi dang online la member
				$sql='select count(*) from `nn_online` where `user`!=""';
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_row($rs);
				$member=str_pad($r[0],6,'0',STR_PAD_LEFT);
				
				//Dem so khach
				$guest=str_pad($online-$member,6,'0',STR_PAD_LEFT);
				
				
			?>
                <div class="col1center">
                    <div class="small_heading">
                        <h5>Stats</h5>
                    </div>
               		  Số người đang online: <?php echo $online?><br>
                      Số thành viên: <?php echo $member?><br>
                      Số khách: <?php echo $guest?><br>
                      Số lượt truy cập: <?php echo $visit?><br>
                </div>
                <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<!-- Footer Section -->
	<div id="footer">
    	<div class="foot_inr">
        <div class="foot_top">
        	<div class="foot_logo">
            	<a href="#"><img src="images/footer_logo.png" alt="" ></a>
            </div>
            <div class="botm_navi">
            	<ul>
                	<li><a href="#">Home page</a></li>
                    <li><a href="#">Who we are</a></li>
                    <li><a href="#">Formoda news &amp; blog</a></li>
                    <li><a href="#">Follow us on Twitter</a></li>
                    <li><a href="#">Befriend us on Facebook</a></li>
                </ul>
                <ul>
                	<li><a href="#">Shipping &amp; Returns</a></li>
                    <li><a href="#">Secure Shopping</a></li>
                    <li><a href="#">International Shipping</a></li>
                    <li><a href="#">Affiliates</a></li>
                    <li><a href="#">Group Sales</a></li>
                </ul>
                <ul>
                	<li><a href="#">Sign In</a></li>
                    <li><a href="#">View Cart</a></li>
                    <li><a href="#">Wish List</a></li>
                    <li><a href="#">Track My Order</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
                <ul>
                	<li>Contact us</li>
                    <li>T: 01230 012312</li>
                    <li>E: <a href="mailto:info@abc.com">info@abc.com</a></li>
                    <li><a href="#">Site map</a></li>
                    <li><a href="#">Terms of use &amp; privacy</a></li>
                </ul>
            </div>
        </div>
        <div class="foot_bot">
        	<div class="emailsignup">
        	<h5>Join Our Mailing List</h5>
            <ul class="inp">
            	<li><input name="newsletter" type="text" class="bar" ></li>
                <li><a href="#" class="signup">Signup</a></li>
            </ul>
            <div class="clear"></div>
        </div>
            <div class="botm_links">
            	<ul>
                	<li class="first"><a href="#">Home</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
                <div class="clear"></div>
                <p>© 2010 DUMY. All Rights Reserved</p>
            </div>
            <div class="copyrights">
        	<p>
            	Registered address: County House, 1 New Road, BTQ5 8LZ. Company No. 6172469<br >
Office address: NewTrends Ltd, The Byre, Berry Pomeroy, Devon, TQ9 6LH
            </p>
        </div>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="topdiv">
        	<a href="#top" class="top">Top</a>
        </div>
        </div>
    </div>
</body>
</html>