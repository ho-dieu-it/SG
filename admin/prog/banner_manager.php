<font size="2" face="Tahoma"><b><a href='?act=banner_manager'>Quản lý banner</a> 
</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=banner_new"><img src="images/add_new.gif"
		align="absmiddle" border="0" /></a> <a href="?act=banner_new">Thêm
		banner mới</a>
</div>
<?php
include "templates/banner.php";
if (! empty ( $delete )) {
	$db->delete ( "tgp_gallery", "id = '" . $delete . "'" );
	admin_load ( "Đã xóa banner đó ra khỏi CSDL.", "?act=banner_manager" );
}
?>
<table class="tb_table" width="100%" border="0" cellspacing="0"
	cellpadding="0">
	<tr class="tb_head">
		<td>STT</td>
		<td>Hình ảnh</td>
		<td>Vị trí</td>
		<td>Hiển thị</td>
		<td>Sửa</td>
		<td>Xóa</td>
	</tr>
<?php
$dem = 0;
$r = $db->select ( "tgp_gallery", "cat <= 3 ", "order by time desc" );
if($db->num_rows($r)>0){
while ( $row = $db->fetch ( $r ) ) {
	$dem ++;
	?>
  <tr class="tb_content">
		<td><b>#<?php echo $dem?></b></td>
		<td><img alt="Xem phong to" border="0"
			src="../uploads/banner/<?php echo $row["hinh"]?>" width="100"
			height="50" vspace="2" style="cursor: hand"></td>
		<td><?php echo get_cat($row["cat"],'ten')?></td>
		<td><?php echo $row["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
		
		<td><a href="?act=banner_edit&id=<?php echo $row["id"]?>">Sửa</a></td>
		<td><a href="?act=banner_manager&delete=<?php echo $row["id"]?>">Xóa</a></td>
	</tr>
<?php
}
}else{ 
?>
 <tr class="tb_content">
		<td colspan=4><b>Hiện tại chưa có banner nào.</b></td>
		
	</tr>
<?php }?>
</table>
<div class="function">
	<a href="?act=banner_new"><img src="images/add_new.gif"
		align="absmiddle" border="0" /></a> <a href="?act=banner_new">Thêm
		banner mới</a>
</div>