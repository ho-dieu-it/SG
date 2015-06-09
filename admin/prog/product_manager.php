<font size="2" face="Tahoma"><b>Quản lý sản phẩm</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=product_menu_new&txt_cat=7"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=product_menu_new&txt_cat=7">Thêm danh mục sản phẩm</a>
</div>
<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
		$db->delete("tgp_product","cat = '".$delete."'");
		$db->delete("tgp_product_menu","id = '".$delete."'");
		admin_load("Đã xóa thành công.","?act=product_manager");
	}
	if ($func == "sort")
	{
		$r	=	$db->select("tgp_cat");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("tgp_cat","thu_tu",$order_[$id],"id = '".$id."'");
		}
		$r	=	$db->select("tgp_product_menu");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("tgp_product_menu","thu_tu",$order__[$id],"id = '".$id."'");
		}
		admin_load("Đã sắp xếp thành công.","?act=product_manager");
	}
?>
<form action="?act=product_manager" method="post">
<input type="hidden" name="func" value="sort" />

<table class="tb_table" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="tb_head">
    <td>Nhóm</td>
    <td>Tên mục</td>
    <td>Sắp xếp</td>
	<td>Hiển thị</td>
    <td>Thêm</td>
    <td>Sửa</td>
    <td>Xóa</td>
    <td>Nội dung</td>
  </tr>
<?php
$r	=	$db->select("tgp_cat","_product = 1","order by thu_tu asc");
while ($row = $db->fetch($r))
{
?>
  <tr class="tb_foot">
    <td style="text-align:right;"><b><?php echo $row["ten"]?></b></td>
    <td>&nbsp;</td>
    <td><?php echo show_order("order_[".$row["id"]."]",$db->num_rows($r),$row["thu_tu"],"100%");?></td>
	<td>-</td>
    <td><a href="?act=product_menu_new&txt_cat=<?php echo $row["id"]?>"><img src="images/i_add.gif" border="0" /></a></td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
<?php
	$r2	=	$db->select("tgp_product_menu","cat = '".$row["id"]."'","order by thu_tu asc");
	while ($row2 = $db->fetch($r2))
	{
?>
  <tr class="tb_content">
    <td>&nbsp;</td>
    <td style="text-align:left;"><img src="images/node.gif" align="absmiddle" /> <img src="images/lang_vn.gif" align="absmiddle" /> <?php echo $row2["ten"]?></td>
    <td style="text-align:right;"><?php echo show_order("order__[".$row2["id"]."]",$db->num_rows($r2),$row2["thu_tu"],"80%",0);?></td>
	<td><?php echo $row2["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
    <td><a href="?act=product_new&cate_id=<?php echo $row2["id"]?>">Thêm SP</a></td>
    <td><a href="?act=product_menu_edit&id=<?php echo $row2["id"]?>">Sửa</a></td>
    <td><a href="?act=product_manager&delete=<?php echo $row2["id"]?>" onclick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');">Xóa</a></td>
    <td><a href="?act=product_list&cate_id=<?php echo $row2["id"]?>"><img src="images/go_right.gif" border="0" /></a></td>
  </tr>
<?php
	}
}
?>
<tr>
	<td colspan="2">
	<div class="function">
		<a href="?act=product_menu_new&txt_cat=7"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=product_menu_new&txt_cat=7">Thêm danh mục sản phẩm</a>
	</div>
	</td>
	<td style="text-align:right;"><input type="submit" value="Sắp xếp" class="button_2" style="width:80%;" /></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
</form>