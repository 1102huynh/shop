                <h2 class="heading colr">CART</h2>
                <div class="shoppingcart">
            	<ul class="tablehead">
                	<li class="remove colr">Remove</li>
                    <li class="thumb colr">&nbsp;</li>
                    <li class="title colr">Product Name</li>
                    <li class="price colr">Unit Price</li>
                    <li class="qty colr">QTY</li>
                    <li class="total colr">Sub Total</li>
                </ul>
                <form action="?mod=cart_action&act=2" id="cart" method="post">
                <?php
					//$cart=array(2=>3,400=>2,150=>1);
					$cart=$_SESSION['cart'];
					print_r($cart);
					$s=0;
					if(count($cart)>0)foreach($cart as $k=>$v)
					{
						$sql='select `name`,`img_url`,`price` from `nn_product` where `id`='.$k;
						$rs=mysqli_query($link,$sql);
						$r=mysqli_fetch_assoc($rs);
						$s=$s+$r['price']*$v;
				?>
                    <ul class="cartlist gray">
                        <li class="remove txt"><a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm ?')" href="?mod=cart_action&act=3&id=<?php echo $k ?>"><img src="images/delete.gif" alt="" ></a></li>
                        <li class="thumb"><a href="detail.html"><img src="images/sanpham/<?php echo $r['img_url']?>" alt="" ></a></li>
                        <li class="title txt"><a href="detail.html"><?php echo $r['name']?></a></li>
                        <li class="price txt"><?php echo number_format($r['price'])?></li>
                        <li class="qty"><input name="<?php echo $k ?>" min="1" type="number" value="<?php echo $v?>" ></li>
                        <li class="total txt"><?php echo number_format($r['price']*$v)?></li>
                    </ul>
				<?php
                	}
                ?>
                </form>
<!--                <ul class="cartlist">
                	<li class="remove txt"><a href="#"><img src="images/delete.gif" alt="" ></a></li>
                    <li class="thumb"><a href="detail.html"><img src="images/cart_thumb.gif" alt="" ></a></li>
                    <li class="title txt"><a href="detail.html">Alexander Christie</a></li>
                    <li class="price txt">$577.00</li>
                    <li class="qty"><input name="qty" type="text" value="1" ></li>
                    <li class="total txt">$577.00</li>
                </ul>
                <ul class="cartlist gray">
                	<li class="remove txt"><a href="#"><img src="images/delete.gif" alt="" ></a></li>
                    <li class="thumb"><a href="detail.html"><img src="images/cart_thumb.gif" alt="" ></a></li>
                    <li class="title txt"><a href="detail.html">Alexander Christie</a></li>
                    <li class="price txt">$577.00</li>
                    <li class="qty"><input name="qty" type="text" value="1" ></li>
                    <li class="total txt">$577.00</li>
                </ul>
                <ul class="cartlist">
                	<li class="remove txt"><a href="#"><img src="images/delete.gif" alt="" ></a></li>
                    <li class="thumb"><a href="detail.html"><img src="images/cart_thumb.gif" alt="" ></a></li>
                    <li class="title txt"><a href="detail.html">Alexander Christie</a></li>
                    <li class="price txt">$577.00</li>
                    <li class="qty"><input name="qty" type="text" value="1" ></li>
                    <li class="total txt">$577.00</li>
                </ul>
                <ul class="cartlist gray">
                	<li class="remove txt"><a href="#"><img src="images/delete.gif" alt="" ></a></li>
                    <li class="thumb"><a href="detail.html"><img src="images/cart_thumb.gif" alt="" ></a></li>
                    <li class="title txt"><a href="detail.html">Alexander Christie</a></li>
                    <li class="price txt">$577.00</li>
                    <li class="qty"><input name="qty" type="text" value="1" ></li>
                    <li class="total txt">$577.00</li>
                </ul>-->
                <div class="clear"></div>
                <div class="subtotal">
                	<a href="?mod=product" class="simplebtn"><span>Continue Shopping</span></a>
                    <a href="javascript:document.getElementById('cart').submit()" class="simplebtn"><span>Update</span></a>
                    <a href="?mod=checkout" class="simplebtn"><span>Checkout</span></a>
                	<h3 class="colr"><?php echo number_format($s)?></h3>
                </div>
                <div class="clear"></div>
            </div>
                <div class="clear"></div>
