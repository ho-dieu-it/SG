<script type="text/javascript">

$(document).ready(function(){
	  $('.bxslider').bxSlider({
		  pagerCustom: '#bx-pager',
		});
	  $('.bxslider-thumb').bxSlider({
		  //pagerCustom: '#bx-pager',
		  slideWidth: 200,
 			 minSlides: 5,
  		maxSlides: 5,
		});
// 	  $("#various1").fancybox({
// 			'titlePosition'		: 'inside',
// 			'transitionIn'		: 'none',
// 			'transitionOut'		: 'none',
// 			 onStart: function() {
// 				    $('.detail').css('display','block');
// 			},
// 			onClosed: function() {
// 			    $('.detail').css('display','none');
// 			    //alert('tst');
// 		}
// 		});
	});
</script>
<?php
$cmid = $cmid + 0;
$r = $db->select("tgp_gallery_menu","cat='9'");

if ($db->num_rows($r) == 0)
{
	$cmid = 0;
}
else
{
		?>
		
    <div style="padding-bottom:20px; overflow:hidden">
     <div style="position:relative; clear:both; margin-bottom:20px">
        <div style="position:absolute"><img src="<?php echo $liveSite;?>/img/h2p1.gif" width="570" height="15" usemap="#Map2" border="0" />
          <map name="Map2" id="Map2">
            <area shape="rect" coords="534,4,566,11" href="#" />
          </map>
        </div>
        <div style="position:absolute; background:#FFF; padding-right:10px; color:#000; text-transform:uppercase">
		Thư viện ảnh 
		</div>
      </div>
		<!-- Show Product -->
		
		<?php 
		// Paging ======
		$cate_id=9;$page=isset($_GET['page'])?$_GET['page']:((isset($page))?$page:0) + 0;
		
		//$page		=	((isset($page))?$page:0) + 0;
		$perpage	=	9;
		$r_all		=	$db->select("tgp_gallery_menu","hien_thi = 1 AND cat IN ('".$cate_id."')  ","order by id desc ");
		$sum		=	$db->num_rows($r_all);
		$pages		=	($sum-($sum%$perpage))/$perpage;
		if ($sum % $perpage <> 0 )	$pages = $pages+1;
		$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
		$min 		= 	abs($page-1) * $perpage;
		$max 		= 	$perpage;
		
		$p = $db->select("tgp_gallery_menu","hien_thi = 1 AND cat IN ('".$cate_id."')  ","order by id desc LIMIT $min,$max");
		$count_rows=$db->num_rows($p);
		if ($db->num_rows($p) == 0)
		{
			echo "Không có danh mục sản phẩm nào.";
		}
		$i=1;
		$count=1;
		
		
		while($row_p=$db->fetch($p))
		{
			$gal = $db->select("tgp_gallery","hien_thi = 1 AND cat IN ('".$row_p['id']."')  ","order by id desc LIMIT 0,1");
			
			while($row_gal=$db->fetch($gal)){
				$img_url=$liveSite."/uploads/gal/".$row_gal["hinh"];
			}
			
		
		if($count==1 ||$count==4)
		{
			$count=1;
		?>	
		<div style="clear:both; margin-bottom:20px;overflow:hidden">
		<?php }?>
			
		  <div class="inner-product"> 
		  <a href="<?php echo $liveSite."/thu-vien-anh-chi-tiet/".$row_p["id"]."/".lg_string::get_link($row_p['ten'])."\"";?>" rel="gallery1" class="fancybox">
		  <?php 
		  $days_between = ceil(abs(time()-$row_p['time'])/86400);
		  
		  if($days_between<7){
		  ?>
		  <img src="<?php echo $liveSite."/img/new.gif";?>">
		  <?php } ?>
		  <div class="img-gal">
	 	<img title="<?php echo $row_p["chu_thich"];?>" class="img-product"  alt="" src="<?php echo $img_url;?>"> 
		</div>
	 </a>
        <h4> <a href="<?php echo $liveSite."/thu-vien-anh-chi-tiet/".$row_p["id"]."/".lg_string::get_link($row_p['ten'])."\"";?>" rel="gallery1" class="fancybox">
		<?php echo $row_p['ten'];?></a> </h4>
		</div>
		
<div class="detail" id="inline1"  style="display: none;">
	 <?php
// 	$id	=	$_GET['id'] + 0;
// 	$r2	=	$db->select("tgp_cms","id = '".$id."'");
		// get data for binding tag
// 		$article=array(
// 			'title'=>$row2['ten'],
// 			'description'=>$row2['chu_thich'],
// 			'image'=>$liveSite.'/uploads/gal/'.$row2['hinh']
// 		);
		//$db->update("tgp_cms","luot_xem",$row2["luot_xem"]+1,"id = '".$id."'");
		//if($act=="")
		?>		
	
	<ul class="bxslider">
	<?php 
	$id=$row_p['id'];
	$r2	=	$db->select("tgp_gallery","cat = '".$id."'");
	while($row2=$db->fetch_assoc($r2)){
	
		?>
	  <li> <img src="<?php echo $liveSite;?>/uploads/gal/<?php echo $row2["hinh"];?>" alt="" class="" /></li>
	  <?php } ?>
	</ul>

	<div id="bx-pager">
	<ul class="bxslider-thumb">
	<?php $index=0;
	$r2	=	$db->select("tgp_gallery","cat = '".$id."'");
	 while($row3=$db->fetch_assoc($r2)){?>
	 <li> <a data-slide-index="<?php echo $index;?>" href="">
	  <img src="<?php echo $liveSite;?>/uploads/gal/<?php echo $row3["hinh"];?>" class="bx-pager-img"/>
	  
	  </a>
	  </li><?php $index++;
	 } ?>
	 </ul>
	</div>
     
        <?php
	if ($db->num_rows($r2) == 0)
	{
		echo "<h3>Thư viện ảnh đang được cập nhật.</h3>";
	}
	else{
	?>
	<?php }?>
		
</div>  
		
		<?php if($count==3||$count_rows==$i)
		{		
			
		?>	
		</div>
		
		<?php } ?>
		<?php $i++;$count++; ?>			
		
	<?php }
 ?>
	</div>
   
	<?php 
}

?>  

 <!--/Area of Showing Product-->
 <!-- Paging -->
<?php

if ($pages > 1)
{
?>
<div style="width:100%;">
	<div id="page_paging" class="pagination">
		<dl>
			<dt class="first" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,1);">Trang đầu</dt>
			<dt class="last" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,<?php echo abs($page-1)?>)">&laquo;Quay lại</dt>
		<?php
		$_start	=	$page - 2;
		$_end	=	$page + 2;
		
		if ($page < 4) $_end += (4-$page);
		if ($page > $pages - 3) $_start -= (3-($pages - $page));
		
		if ($_start < 1) $_start = 1;
		if ($_end   > $pages) $_end = $pages;
		
		for ($i = $_start; $i <= $_end; $i++)
		{
			if ($i == $page)
					echo "<dt class='current'> $i </dt>";
			else	echo "<dt onclick=\"paging('$liveSite',$cate_id,$i);\" class='rp_page'> $i </dt>";
		}
		?>
			<dt class="btn_chg_page" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,<?php echo abs($page+1)?>)">Xem thêm&raquo;</dt>
			<dt class="btn_chg_page" onclick="paging('<?php echo $liveSite;?>',<?php echo $cate_id?>,<?php echo ($pages)?>)">Cuối cùng</dt>
		</dl>
	</div>	
</div>
<?php
}
?>
<!-- End Paging -->
<script>
$(document).ready(function() {
	
	    $(".img-gal").imgLiquid();
	
	});

function paging(root,cateId,pageNo)
{
	var url=root+"/cac-san-pham/"+cateId+"/"+pageNo+"/index.html";
	window.location.href=url;	
}
</script>

 