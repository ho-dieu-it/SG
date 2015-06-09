<?php 
//	Kiểm tra sự tồn tại của ID
$cate_id = $cate_id + 0;
$r	= $db->select("tgp_product_menu","id = '".$cate_id."'");
if ($db->num_rows($r) == 0)
	admin_load("Không tồn tại Mục này.","?act=product_manager");
$product_menu=$db->fetch_array($r);
?>
<font size="2" face="Tahoma"><b><a href="?act=product_manager">Quản lý sản phẩm</a><img src="images/bl3.gif" border="0" /><?php echo $product_menu['ten']?></b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=product_new&cate_id=<?php echo $cate_id?>"><img src="images/add_new.gif" align="absmiddle" border="0" /></a>
	 <a href="?act=product_new&cate_id=<?php echo $cate_id ?>">Thêm sản phẩm mới</a>
</div>
<?php	
	if (isset($_POST['del']))
	{
		$tik=$_POST['tik'];
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("tgp_product","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các Bài viết đã chọn.","?act=product_list&cate_id=".$cate_id);
		
	}
?>
<center>
<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="cate_id" value="<?php echo $cate_id?>" />
<div style="float:right;width:190px;padding:10px;">
<select name="filter" class=""  onchange="this.form.submit();">
<option value="">Filter</option>
<option value="all">Tất cả</option>
<option value="sp_moi">Sản phẩm mới</option>
<option value="slide">Slide</option>
</select>
</div>
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td>STT</td>
	<td>PIC</td>
	<td>Tên sản phẩm</td>
	<td>Hiển thị</td>
	<td>Ngày đăng</td>
	<td>Người đăng</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?php
if(empty($filter)||$filter=='all')
{
	$filter="";
}
else if($filter=='sp_moi') {
	$filter=" AND san_pham_moi = 1";
}
else if($filter=='slide') {
	$filter=" AND slide = 1";
}

$page		=	$page + 0;
$perpage	=	10;
$r_all		=	$db->select("tgp_product","cat = '".$cate_id."'".$filter);
$sum		=	$db->num_rows($r_all);
$pages		=	($sum-($sum%$perpage))/$perpage;
if ($sum % $perpage <> 0 )	$pages = $pages+1;
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;

$count	=	$min;
$r		=	$db->select("tgp_product","cat = '".$cate_id."'".$filter," ORDER BY thu_tu DESC limit $min, $max");
while ($row = $db->fetch($r))
{
	$count++;
?>

<tr class="tb_content">
	<td><?php echo $count?></td>
	<td><?php echo $row["hinh"]!="no"?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td style="text-align:left;"><?php echo $row["ten"]?></td>
	<td><?php echo $row["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?php echo lg_date::vn_time($row["time"])?></td>
	<td><?php echo get_user($row["user"],"username")?></td>
	<td><a href="?act=product_edit&cate_id=<?php echo $cate_id ?>&id=<?php echo $row["id"]?>">Sửa</a></td>
	<td><input name="tik[]" type="checkbox" value="<?php echo $row["id"]?>" /></td>
</tr>
<?php
}
?>
<tr class="tb_foot">
	<td colspan="7" style="text-align:left;">
		<strong>Trang : </strong>
		<?php
			if ($pages==0) echo ":1:";
    		for($i=1;$i<=$pages;$i++) {
    			if ($i==$page) echo "<b>[".$i."]</b>";
    			else {
					echo "<a href='?act=product_list&cate_id=".$cate_id."&page=$i'>-$i-</a>";
				}
			}
    	?>
	</td>
	<td>
		<?php if($pages!=0){ ?>
		<input type="submit" name="del" value="Xóa" class="button_2" style="width:40%;" />
		<input type="button" name="del" onclick="selectOnList()" id="slChkAll" value="Chọn hết" class="button_2" style="width:55px;" />
		<?php } ?>
	</td>
</tr>
</table>
</table>
</form>
</center>
<div class="function">
	<a href="?act=product_new&cate_id=<?php echo $cate_id?>"><img src="images/add_new.gif" align="absmiddle" border="0" /></a>
	 <a href="?act=product_new&cate_id=<?php echo $cate_id ?>">Thêm sản phẩm mới</a></div>