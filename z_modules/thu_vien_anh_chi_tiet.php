<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '307333802678358',
      xfbml      : true,
      version    : 'v2.3'
    },function(response){
		console.log(response);
        });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  $(document).ready(function(){
	  $('.bxslider').bxSlider({
		  pagerCustom: '#bx-pager',
		  slideMargin:5
		});
	  $('.bxslider-thumb').bxSlider({
		  //pagerCustom: '#bx-pager',
		  slideWidth: 200,
   			 minSlides: 5,
    		maxSlides: 5,
    		slideMargin:5
		});
	  $("#various1").fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});
	});
//   $('.bxslider').bxSlider({
// 	  pagerCustom: '#bx-pager'
// 	});
</script>
<p> Home > Thư viện ảnh > <a id="various1" href="#inline1">Chi tiết</a></p>
      <div class="detail">
      <div class="detail-gal">
	 <?php
// 	$id	=	$_GET['id'] + 0;
// 	$r2	=	$db->select("tgp_cms","id = '".$id."'");
		// get data for binding tag
		$article=array(
			'title'=>$row2['ten'],
			'description'=>$row2['chu_thich'],
			'image'=>$liveSite.'/uploads/gal/'.$row2['hinh']
		);
		//$db->update("tgp_cms","luot_xem",$row2["luot_xem"]+1,"id = '".$id."'");
		//if($act=="")
		?>		
	<div class="image-show">
		<ul class="bxslider">
		<?php while($row2=$db->fetch_assoc($r2)){
		
			?>
		  <li> <div class="img-gal-show"><img data-scale="best-fit" data-align="center" class="scale" src="<?php echo $liveSite;?>/uploads/gal/<?php echo $row2["hinh"];?>" alt="" /></div></li>
		  <?php } ?>
		</ul>
		</div>
		<div id="bx-pager">
		<ul class="bxslider-thumb">
		<?php $index=0;
		$r2	=	$db->select("tgp_gallery","cat = '".$id."'");
		 while($row3=$db->fetch_assoc($r2)){?>
		 <li> <a data-slide-index="<?php echo $index;?>" href="">
		  <div class="thumb-img-gal"><img src="<?php echo $liveSite;?>/uploads/gal/<?php echo $row3["hinh"];?>" class="bx-pager-img"/></div></a>
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
	</div>
	<script>
	$(document).ready(function() {
		//$(".img-gal-show").imgLiquid();
		$("img.scale").imageScale('scale');
	  
	   $(".thumb-img-gal").imgLiquid();
	
	});
	</script>
	

