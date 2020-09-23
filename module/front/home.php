        	<h4 class="heading colr">SẢN PHẨM NỔI BẬT</h4>
            <div id="prod_scroller">
            <a href="javascript:void(null)" class="prev">&nbsp;</a>
       	  <div class="anyClass scrol">
                <ul>
                <?php
					$sql='SELECT `id`, `name`, `price`, `img_url` FROM `nn_product` order by `view` desc limit 0,10 ';
					$rs=mysqli_query($link,$sql);
					while($r=mysqli_fetch_assoc($rs))
					{
				?>
                    <li>
                     	<h6 class="colr"><?php echo $r['name'] ?></h6>
                    	<a href="?mod=detail&id=<?php echo $r['id'] ?>"><img src="images/sanpham/<?php echo $r['img_url'] ?>" alt="" ></a>
                        <p class="price bold"><?php echo number_format($r['price']) ?> VND</p>
                        <a href="?mod=cart_action&act=1&id=<?php echo $r['id'] ?>" class="adcart">Add to Cart</a>
                    </li>
                <?php
					}
				?>
                    
                </ul>
			</div>
            <a href="javascript:void(null)" class="next">&nbsp;</a>
        </div>
            <div class="clear"></div>
            <div class="listing">
            	<h4 class="heading colr">SẢN PHẨM MỚI</h4>
                <ul>
                 <?php
					$sql='SELECT `id`, `name`, `price`, `img_url` FROM `nn_product` order by `id` desc limit 0,20 ';
					$rs=mysqli_query($link,$sql);
					$i=1;
					while($r=mysqli_fetch_assoc($rs))
					{
				?>
                	<li <?php if($i%4==0)echo 'class="last"' ?>>
                    	<a href="?mod=detail&id=<?php echo $r['id'] ?>" class="thumb"><img src="images/sanpham/<?php echo $r['img_url']?>" alt="" ></a>
                        <h6 class="colr"><?php echo $r['name']?></h6>
                        <div class="stars">
                        	<a href="#"><img src="images/star_green.gif" alt="" ></a>
                            <a href="#"><img src="images/star_green.gif" alt="" ></a>
                            <a href="#"><img src="images/star_green.gif" alt="" ></a>
                            <a href="#"><img src="images/star_green.gif" alt="" ></a>
                            <a href="#"><img src="images/star_grey.gif" alt="" ></a>
                            <a href="#">(3) Reviews</a>
                        </div>
                        <div class="addwish">
                        	<a href="#">Add to Wishlist</a>
                            <a href="#">Add to Compare</a>
                        </div>
                        <div class="cart_price">
                        	<a href="?mod=cart_action&act=1&id=<?php echo $r['id'] ?>" class="adcart">Add to Cart</a>
                            <p class="price"><?php echo number_format($r['price']/1000000,2)?> Tr</p>
                        </div>
                    </li>
                  <?php
				  		$i++;
					}
				  ?>
                  
                </ul>
            </div>