<font size="2" face="Tahoma"><b>Quản lý tin tức</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
<!-- 	<a href="?act=cms_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=cms_new">Đăng bài viết mới</a> -->
</div>
<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
		$db->delete("tgp_cms","cat = '".$delete."'");
		$db->delete("tgp_cms_menu","id = '".$delete."'");
		admin_load("Đã xóa thành công.","?act=cms_manager");
	}
	if ($func == "sort")
	{
		$r	=	$db->select("tgp_cat");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("tgp_cat","thu_tu",$order_[$id],"id = '".$id."'");
		}
		$r	=	$db->select("tgp_cms_menu");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("tgp_cms_menu","thu_tu",$order__[$id],"id = '".$id."'");
		}
		admin_load("Đã sắp xếp thành công.","?act=cms_manager");
	}
?>
<form action="?act=cms_manager" method="post">
<input type="hidden" name="func" value="sort" />

<table class="tb_table" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="tb_head">
    <td>Nhóm</td>
    <td>Tên mục</td>
	<td>Hiển thị</td>
	<td>Nổi bật</td>
    <td>Thêm</td>
    <td>Sửa</td>
    <td>Xóa</td>
    <td>Nội dung</td>
  </tr>
<?php
$r	=	$db->select("tgp_cat","_cms = 1","order by thu_tu asc");
while ($row = $db->fetch($r))
{
?>
  <tr class="tb_foot">
    <td style="text-align:right;"><b><?php echo $row["ten"]?></b></td>
    <td>&nbsp;</td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
<?php
	$r2	=	$db->select("tgp_cms_menu","cat = '".$row["id"]."'","order by thu_tu asc");
	while ($row2 = $db->fetch($r2))
	{
?>
  <tr class="tb_content">
    <td>&nbsp;</td>
    <td style="text-align:left;"><img src="images/node.gif" align="absmiddle" /> <img src="images/lang_vn.gif" align="absmiddle" /> <?php echo $row2["ten"]?> <font size=1 color="#999999"><?php echo $row2["type"]==0?"1 column":($row2["type"]==1?"2 columns":"1 page")?></font></td>
	<td><?php echo $row2["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?php echo $row2["noi_bat"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
    <td><a href="?act=cms_new&cate_id=<?php echo $row2["id"]?>">Đăng bài</a></td>
    <td><a href="?act=cms_menu_edit&cate_id=<?php echo $row2["id"]?>">Sửa</a></td>
    <td><a href="?act=cms_manager&delete=<?php echo $row2["id"]?>" onclick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');">Xóa</a></td>
    <td><a href="?act=cms_list&cate_id=<?php echo $row2["id"]?>"><img src="images/go_right.gif" border="0" /></a></td>
  </tr>
<?php
	}
}
?>
<tr>
	<td colspan="2">
	<div class="function">
<!-- 		<a href="?act=cms_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=cms_new">Đăng bài viết mới</a> -->
	</div>
	</td>
	<td></td><td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
</form>