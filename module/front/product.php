        	<h4 class="heading colr">Featured Products</h4>
            <div class="small_banner">
            	<a href="#"><img src="images/small_banner.gif" alt="" ></a>
            </div>
            <div class="sorting">
            <?php
				$cid=intval($_GET['cid']);//Bat buoc $cid phai la so nguyen
				if($cid=='')$cid=1;
				
				$page=$_GET['page'];
				if($page<1)$page=1;
				
				//Sap xep
				$sort=$_GET['sort'];
				
				/* Tinh so trang */
				$sql="SELECT count(*) FROM `nn_product` where `category_id`={$cid}";
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_row($rs);
				
				$nop=ceil($r[0]/20);
				
			?>
            	<p class="left colr"><?php echo $r[0] ?> Item(s)</p>
                <ul class="right">                	
                    <li class="text">Page
                    <a title="Trang đầu" href="?mod=product&cid=<?php echo $cid?>&page=1" class="colr">&lt;&lt;</a>   
                    <a title="Trang trước" href="?mod=product&cid=<?php echo $cid?>&page=<?php echo $page-11 ?>" class="colr">&lt;</a>   
                    <?php
						for($i=$page-5;$i<=$page+5;$i++)
						if($i>=1 && $i<=$nop)
						{
					?>
                        	<a <?php if($i==$page) echo 'class="current"' ?> href="?mod=product&cid=<?php echo $cid?>&page=<?php echo $i?>&sort=<?php echo $sort ?>" class="colr"><?php echo $i?></a>                         
                    <?php
						}
					?>                    
                    <a title="Trang sau" href="?mod=product&cid=<?php echo $cid?>&page=<?php echo $page+11 ?>" class="colr">&gt;</a> 
                    <a title="Trang cuối" href="?mod=product&cid=<?php echo $cid?>&page=<?php echo $nop ?>" class="colr">&gt;&gt;</a>   
                    </li>
                </ul>
                <div class="clear"></div>
                <p class="left">View as: 
                	<a id="grid" href="javascript:void(0)" onClick="changeView(1)" class="colr current">Grid</a>&nbsp;
                	<a id="list" href="javascript:void(0)" onClick="changeView(2)" class="colr">List</a>
                </p>
                <script>
					function changeView(v)
					{
						if(v==1)
						{
							$('#view').removeClass('listing2').hide().addClass('listing').fadeIn(500);
							$('#grid').addClass('current');
							$('#list').removeClass('current');
						}
						else
						{
							$('#view').removeClass('listing').hide().addClass('listing2').fadeIn(500);						
							$('#list').addClass('current');
							$('#grid').removeClass('current');				
						}						
					}
				</script>
                <ul class="right">
                	<li class="text">
                    	Sort by Position
                    	<a <?php if($sort>=3) echo 'class="current"' ?> href="?mod=product&cid=<?php echo $cid?>&page=1&sort=<?php echo $sort==3?4:3 ?>" class="colr">Name <?php if($sort==3) echo '<img src="images/asc.png" alt="asc">'; if($sort==4) echo '<img src="images/desc.png" alt="desc" title="Giảm dần ">' ?></a> | 
                        <a <?php if($sort<=2) echo 'class="current"' ?> href="?mod=product&cid=<?php echo $cid?>&page=1&sort=<?php if($sort==2)echo 1;else echo 2; ?>" class="colr">Price <?php if($sort==1) echo '<img src="images/asc.png" alt="asc">'; if($sort==2) echo '<img src="images/desc.png" alt="desc">' ?></a> 
                    </li>
                </ul>
          	</div>
            <?php 
				$pos=($page-1)*20;
					
													
				$order='`price`';
				if($sort==2)$order='`price` desc';
				if($sort==3)$order='`name`';
				if($sort==4)$order='`name` desc';
				
								echo $sql="SELECT `id`, `name`, `price`, `img_url`,`desc` FROM `nn_product` where `active`=1 AND `category_id`={$cid} order by $order limit {$pos},20 ";
				$rs=mysqli_query($link,$sql);
				$i=1;
			
			?>
            	<div id="view" class="listing">
            	<h4 class="heading colr">New Products for March 2010</h4>
                <ul>
                 <?php			 	
									
					while($r=mysqli_fetch_assoc($rs))
					{
				?>
                	<li <?php if($i%4==0)echo 'class="last"' ?>>
                    <div class="product">
                        <div class="left"><a href="?mod=detail&id=<?php echo $r['id'] ?>" class="thumb"><img src="images/sanpham/<?php if(is_file('images/sanpham/'.$r['img_url'])) echo $r['img_url'];else echo 'noImage.jpg';?>" alt="" ></a>
                          <h6 class="colr"><?php echo $r['name']?></h6>
                        </div>
                        <div class="desc"><?php echo $r['desc']?></div>
                        <div class="right">
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
                        </div>
                    </div>
                    </li>
                  <?php
				  		$i++;
					}
				  ?>
                  
                </ul>
            </div>