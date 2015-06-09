<?php
$r	=	$db->select("tgp_customers","cat = 3");
while ($row = $db->fetch($r))
{
?>
	<a href="<?php echo $row["dia_chi"]?>" target="_blank">
	<img src="<?php echo $liveSite;?>/uploads/cus/<?php echo $row["hinh"]?>" border="0" width="115" />
	</a>
<?php
}
?>