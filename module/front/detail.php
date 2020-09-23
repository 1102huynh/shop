            <?php
				//Lay thong tin cua san pham
				$id=$_GET['id'];	
				
				//Tang so luot xem
				$sql='UPDATE `nn_product` SET `view`=`view`+1 WHERE `id`='.$id;
				mysqli_query($link,$sql);
				
				
				echo $sql='SELECT `id`,`category_id`, `name`, `price`, `desc`, `detail`, `img_url`, `qty`, `view` FROM `nn_product` WHERE  `active` = 1 AND `id` = '.$id;
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_assoc($rs);		
				
				
			?>
        	<h4 class="heading colr"><?php echo $r['name']?></h4>
            <div class="prod_detail">
            	<div class="big_thumb">
                	<div id="slider2">
                        <div class="contentdiv">
                        	<img src="images/sanpham/<?php echo $r['img_url']?>" alt="" >
                            <a rel="example_group" href="images/sanpham/<?php echo $r['img_url']?>" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                      </div>                       
                    </div>
                    <a href="javascript:void(null)" class="prevsmall"><img src="images/prev.gif" alt="" ></a>
                    <div style="float:left; width:189px !important; overflow:hidden;">
                    <div class="anyClass" id="paginate-slider2">
                        <ul>
                            <li><a href="#" class="toc"><img src="images/sanpham/<?php echo $r['img_url']?>" alt="" ></a></li>                          
                        </ul>
                    </div>
                    </div>
                    <a href="javascript:void(null)" class="nextsmall"><img src="images/next.gif" alt="" ></a>
                    <script type="text/javascript" src="js/cont_slidr.js"></script>
                </div>
                <div class="desc">
                	<div class="quickreview">
                            <a href="#" class="bold black left"><u>Be the first to review this product</u></a>
                            <div class="clear"></div><br>

                            <p class="avail"><span class="bold">Availability:</span><?php echo $r['qty']?></p>
                            <p class="avail"><span class="bold">View:</span><?php echo $r['view']?></p>
                          <h6 class="black">Quick Overview</h6>
                        <p>
                        	<?php echo $r['desc']?> 
                        </p>
                    </div>
                    <div class="addtocart">
                    	<h4 class="left price colr bold"><?php echo number_format($r['price'])?> VND</h4>
                            <div class="clear"></div>
                            <ul class="margn addicons">
                                <li>
                                    <a href="#">Add to Wishlist</a>
                                </li>
                                <li>
                                    <a href="#">Add to Compare</a>
                                </li>
                        	</ul>
                            <div class="clear"></div>
                        <ul class="left qt">
                   	    <li class="bold qty">QTY</li>
                            <li><input name="qty" type="number" min="1" id="qty" value="1" class="bar" ></li>
                            <li><a href="javascript:window.location='?mod=cart_action&act=1&id=<?php echo $id ?>&qty='+$('#qty').val()" class="simplebtn"><span>Add To Cart</span></a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="prod_desc">
                	<h4 class="heading colr">Product Description</h4>
                    <p>
                    	<?php echo $r['detail']?>
                    </p>
                </div>
            </div>
            <div class="listing">
            	<h4 class="heading colr">New Products for March 2010</h4>
                <ul>
                 <?php
					$sql="SELECT `id`, `name`, `price`, `img_url` FROM `nn_product` where `category_id`={$r['category_id']} AND `id`!={$id} order by `id` desc limit 0,20 ";
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
                        	<a href="cart.html" class="adcart">Add to Cart</a>
                            <p class="price"><?php echo number_format($r['price']/1000000,2)?> Tr</p>
                        </div>
                    </li>
                  <?php
				  		$i++;
					}
				  ?>
                  
                </ul>
            </div>
            <div class="tags_big">
            	<h4 class="heading">Product Tags</h4>
                <p>Add Your Tags:</p>
                <span><input name="tags" type="text" class="bar" ></span>
                <div class="clear"></div>
                <span><a href="#" class="simplebtn"><span>Add Tags</span></a></span>
                <p>Use spaces to separate tags. Use single quotes (') for phrases.</p>
            </div>
            <div class="clear"></div>