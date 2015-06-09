<?php// include("hitcounter.php");?>
<div id="thongke" class="tgp_box">
	<div class="content" style="text-align:center;">
	
	<?php 
		$r	=	$db->query("select * FROM tgp_online_daily t where  TO_DAYS(t.ngay)>TO_DAYS('2013-09-17');");
		$numRow=1000;
		while ($row=$db->fetch($r))
		{
			$numRow+=$row['bo_dem'];
		}
	?>
		Số lượng truy cập :<span style="font-weight:bold;"><?php echo $numRow;?></span>
	</div>
</div>