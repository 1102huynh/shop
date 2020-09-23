<table width="825" border="1">
  <caption>
    DANH SÁCH LOẠI SẢN PHẨM
  </caption>
  <tr>
    <th width="58" scope="col">STT</th>
    <th width="219" scope="col">Chủng loại</th>
    <th width="219" scope="col">Tên</th>
    <th width="109" scope="col">Thứ tự</th>
    <th width="83" scope="col">Ẩn</th>
    <th width="97" scope="col"><a href="?mod=cat_add">+Thêm</a></th>
  </tr>
  <?php
  $sql='SELECT a . * , b.`name` as `dep_name`
		FROM `nn_category` a LEFT JOIN `nn_department` b
		ON a.`department_id` = b.`id`
		ORDER BY b.`id` ';
  $rs=mysqli_query($link,$sql);
  while($r=mysqli_fetch_assoc($rs))
  {
  ?>
      <tr>
        <td align="center"><?php echo ++$i; ?></td>
        <td><?php echo $r['dep_name']; ?></td>
        <td><?php echo $r['name']; ?></td>
        <td align="center"><?php echo $r['order']; ?></td>
        <td align="center"><?php if($r['active']==0) echo  'X'; ?></td>
        <td align="center"><a href="?mod=cat_upd&id=<?php echo $r['id'] ?>">Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?\n(Nếu xóa thì tất cả sản phẩm thuộc loại này cũng sẽ bị xóa)')" href="?mod=cat_del&id=<?php echo $r['id'] ?>">Xóa</a></td>
  </tr>
  <?php
  }
  ?>
</table>
