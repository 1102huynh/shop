<table width="900" border="1">
  <caption>
    DANH SÁCH SẢN PHẨM<br />
    <select id="cat" name="cat" onchange="window.location='?mod=pro&cid='+this.value">
    <?php
		$cid=$_GET['cid'];
		if($cid=='')$cid=1;
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
  </caption>
  <tr>
    <th width="50" scope="col">STT</th>
    <th width="245" scope="col">Tên</th>
    <th width="154" scope="col">Hình</th>
    <th width="97" scope="col">Giá</th>
    <th width="115" scope="col">Số lượng</th>
    <th width="79" scope="col">Ẩn</th>
    <th width="114" scope="col"><a href="?mod=pro_add&cid=<?php echo $cid ?>">+Thêm</a></th>
  </tr>
  <?php
  
  $sql='SELECT `id` , `name` , `price` , `img_url` , `qty`,`active`
		FROM `nn_product`
		WHERE `category_id` ='.$cid;
  $rs=mysqli_query($link,$sql);
  while($r=mysqli_fetch_assoc($rs))
  {
  ?>
      <tr>
        <td align="center"><?php echo ++$i; ?></td>
        <td><?php echo $r['name']; ?></td>
        <td align="center"><img src="images/sanpham/<?php echo $r['img_url']; ?>" height="60" /></td>
        <td align="right"><?php echo number_format($r['price']); ?></td>
        <td align="right"><?php echo $r['qty']; ?></td>
        <td align="center"><?php if($r['active']==0) echo  'X'; ?></td>
        <td align="center"><a href="?mod=pro_upd&id=<?php echo $r['id'] ?>">Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" href="?mod=pro_del&id=<?php echo $r['id'] ?>">Xóa</a> | <a href="index.php?mod=detail&id=<?php echo $r['id'] ?>">Chi tiết</a></td>
  </tr>
  <?php
  }
  ?>
</table>
