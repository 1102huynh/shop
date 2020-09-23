        	<h4 class="heading colr">Result</h4>
           <?php
		   		$kw=$_REQUEST['kw'];
				//Xu ly loi SQL Injection
				$kw=str_replace("'",'',$kw);//Xoa dau '
				$kw=str_replace('"','',$kw);//Xoa dau "
				$kw=str_replace(' ','_',$kw);//Thay khoang trang bang dau _
				
				//Xu ly loi XSS
				$kw=htmlentities($kw);//Co the thay bang strip_tags, htmlspecialchars

				$cid=$_REQUEST['cid'];
				$price=$_REQUEST['price'];
				
				//Tim theo keyword
				$cond="`active`=1 AND `name` like '%$kw%'";
				
				//Tim theo loai (neu co)
				if($cid>0)$cond=$cond." AND `category_id`=$cid";
				
				//Tim theo khoang gia
				if($price==1)$cond.=" AND `price` < 5000000";
				if($price==2)$cond.=" AND (`price` between 5000000 and 10000000)";
				if($price==3)$cond.=" AND (`price` between 10000000 and 15000000)";
				if($price==4)$cond.=" AND (`price` between 15000000 and 20000000)";
				if($price==5)$cond.=" AND (`price` between 20000000 and 30000000)";
				if($price==6)$cond.=" AND `price` > 30000000";
		   ?>
           <div id="search">              
                <form action="?mod=search" method="post" id="login">
                <ul class="forms">
                    <li class="inputfield"><input value="<?php echo $kw ?>" type="text" name="kw" class="bar" required placeholder="Nhập từ khóa" ></li>               <li class="inputfield">
                    	<select id="cat" name="cid">
                        <option value="0">-- Chọn loại sản phẩm --</option>
						<?php
                            //Lay cac chung loai
                            $sql='select `id`,`name` from `nn_department` order by `order`';
                            $rs=mysqli_query($link,$sql);
                            while($r=mysqli_fetch_assoc($rs))
                            {
                        ?>
                                <optgroup label="<?php echo $r['name']?>">
                                <?php
                                    //Lay cac loai sp tuong ung
                                    $sql='select `id`,`name` from `nn_category` where `department_id`='.$r['id'];
                                    $rsCate=mysqli_query($link,$sql);
                                    while($r=mysqli_fetch_assoc($rsCate))
                                    {
                                ?>
                                        <option <?php if($r['id']==$cid) echo 'selected' ?> value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
                                <?php
                                    }
                                ?>
                                </optgroup>
                        <?php
                            }
                        ?>
                        </select>
                    </li>
                    <li class="inputfield">
                    	<select name="price">
                          <option value="0">-- Chọn khoảng giá --</option>	
                    	  <option <?php if(1==$price) echo 'selected' ?> value="1">Dưới 5 triệu</option>
                    	  <option <?php if(2==$price) echo 'selected' ?> value="2">Từ 5 đến 10 triệu</option>
                    	  <option <?php if(3==$price) echo 'selected' ?> value="3">Từ 10 đến 15 triệu</option>
                    	  <option <?php if(4==$price) echo 'selected' ?> value="4">Từ 15 đến 20 triệu</option>
                    	  <option <?php if(5==$price) echo 'selected' ?> value="5">Từ 20 đến 30 triệu</option>
                    	  <option <?php if(6==$price) echo 'selected' ?> value="6">Trên 30 triệu</option>
                        </select>
                    </li>                       
                    <li><a href="javascript:document.getElementById('sm').click()" class="simplebtn"><span>Tìm</span></a> <input type="submit" style="width:0;height:0;border:none" value="Login" id="sm"></li>
                </ul>
                </form>
            </div>
            <div class="clear"></div>
            <div class="sorting">
            <?php
			
				
				$page=$_GET['page'];
				if($page<1)$page=1;
				
				//Sap xep
				$sort=$_GET['sort'];
				if($sort=='')$sort=1;
				
				/* Tinh so trang */
				$sql="SELECT count(*) FROM `nn_product` where $cond";
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_row($rs);
				
				$nop=ceil($r[0]/20);
				if($page>$nop)$page=$nop;
				
			?>
            	<p class="left colr"><?php echo $r[0] ?> Item(s)</p>
                <ul class="right">                	
                    <li class="text">Page
                    <a title="Trang đầu" href="?mod=search&kw=<?php echo $kw?>&page=1&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr">&lt;&lt;</a>   
                    <a title="Trang trước" href="?mod=search&kw=<?php echo $kw?>&page=<?php echo $page-11 ?>&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr">&lt;</a>   
                    <?php
						for($i=$page-5;$i<=$page+5;$i++)
						if($i>=1 && $i<=$nop)
						{
					?>
                        	<a <?php if($i==$page) echo 'class="current"' ?> href="?mod=search&kw=<?php echo $kw?>&page=<?php echo $i?>&sort=<?php echo $sort ?>&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr"><?php echo $i?></a>                         
                    <?php
						}
					?>                    
                    <a title="Trang sau" href="?mod=search&kw=<?php echo $kw?>&page=<?php echo $page+11 ?>&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr">&gt;</a> 
                    <a title="Trang cuối" href="?mod=search&kw=<?php echo $kw?>&page=<?php echo $nop ?>&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr">&gt;&gt;</a>   
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
                    	<a <?php if($sort>=3) echo 'class="current"' ?> href="?mod=search&kw=<?php echo $kw?>&page=1&sort=<?php echo $sort==3?4:3 ?>&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr">Name <?php if($sort==3) echo '<img src="images/asc.png" alt="asc">'; if($sort==4) echo '<img src="images/desc.png" alt="desc" title="Giảm dần ">' ?></a> | 
                        <a <?php if($sort<=2) echo 'class="current"' ?> href="?mod=search&kw=<?php echo $kw?>&page=1&sort=<?php if($sort==2)echo 1;else echo 2; ?>&cid=<?php echo $cid ?>&price=<?php echo $price ?>" class="colr">Price <?php if($sort==1) echo '<img src="images/asc.png" alt="asc">'; if($sort==2) echo '<img src="images/desc.png" alt="desc">' ?></a> 
                    </li>
                </ul>
          	</div>
            <?php 
				$pos=($page-1)*20;
					
													
				if($sort==1)$order='`price`';
				if($sort==2)$order='`price` desc';
				if($sort==3)$order='`name`';
				if($sort==4)$order='`name` desc';
				
				echo $sql="SELECT `id`, `name`, `price`, `img_url`,`desc` FROM `nn_product` where $cond order by $order limit {$pos},20 ";
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