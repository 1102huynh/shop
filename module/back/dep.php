<table width="600" border="1">
  <caption>
    DANH SÁCH CHỦNG LOẠI
  </caption>
  <tr>
    <th width="58" scope="col">STT</th>
    <th width="219" scope="col">Tên</th>
    <th width="109" scope="col">Thứ tự</th>
    <th width="83" scope="col">Ẩn</th>
    <th width="97" scope="col"><a href="?mod=dep_add">+Thêm</a></th>
  </tr>
  <?php
  $sql='select * from `nn_department`';
  $rs=mysqli_query($link,$sql);
  while($r=mysqli_fetch_assoc($rs))
  {
  ?>
      <tr>
        <td align="center"><?php echo ++$i; ?></td>
        <td><?php echo $r['name']; ?></td>
        <td align="center"><?php echo $r['order']; ?></td>
        <td align="center"><?php if($r['active']==0) echo  'X'; ?></td>
        <td align="center"><a href="?mod=dep_upd&id=<?php echo $r['id'] ?>">Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" href="?mod=dep_del&id=<?php echo $r['id'] ?>">Xóa</a></td>
  </tr>
  <?php
  }
  ?>
</table>
