<a href="http://www.singa.com.vn/webmail/" target="_blank" class="check-mail"></a> 
<?php 	
	if($_SESSION['tinnb']!="ok")
	{
	?>
	<a  onclick="vpb_show_login_box();" href="#" class="check-news"></a>
	<?php }
	else {
?>
<a href="<?php echo $liveSite;?>/tin-tuc-noi-bo/index.html" class="check-news"></a>
<?php } 
$r	=	$db->select("tgp_cms","cat = 8 AND hien_thi=1","order by id DESC LIMIT 2");
if($db->num_rows($r)>0){ ?>
<!-- NHÂN VIÊN XUẤT SẮC -->
<div class="partner" style="padding-bottom:10px">
	<div class="inner-partner" >
	  <ul class="partner-main">
		<h2>NHÂN VIÊN XUẤT SẮC</h2>
		<?php
		
		while ($row = $db->fetch($r))
		{
		?>
				
			<li>
			<a href="<?php echo $liveSite.'/tin-tuc-xem/'.$row['id'].'/'.lg_string::get_link($row2['ten']).'/'; ?>">			
				<img title="<?php echo $row["ten"]?>" alt="<?php echo $row["ten"]?>" src="<?php echo $liveSite;?>/uploads/cms/<?php echo $row["hinh"]?>" class="img-nhanvien" /> 
				</a>
				<span style="text-align:center;width:100%; display:block"><?php echo $row["ten"]?></span>
			</li>
					
		<?php
		}
		?>
	  </ul>
	</div>
<img src="<?php echo $liveSite;?>/img/bg-bottom-partner.gif" width="170" height="13"> 
</div>
<?php }?>
<!-- // -->
<!-- ĐỐI TÁC CHIẾN LƯỢC -->
<div class="partner">
	<div class="inner-partner">
	  <ul class="partner-main">
		<h2>ĐỐI TÁC CHIẾN LƯỢC</h2>
		<?php
		$r	=	$db->select("tgp_customers","cat = 3");
		while ($row = $db->fetch($r))
		{
		?>
			<a href="<?php echo $row["dia_chi"]?>" target="_blank">
			<li> 
				<img title="<?php echo $row["gioi_thieu"]?>" alt="<?php echo $row["gioi_thieu"]?>" src="<?php echo $liveSite;?>/uploads/cus/<?php echo $row["hinh"]?>" class="img-partner" /> 
			</li>
			</a>
			
		<?php
		}
		?>
	  </ul>
	</div>
<img src="<?php echo $liveSite;?>/img/bg-bottom-partner.gif" width="170" height="13"> 
</div>
<!-- // -->
<!-- Login Box Starts Here -->
<div style="display: none;" id="vpb_login_pop_up_box" class="vpb_signup_pop_up_box">
<div style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;" align="center">
Mã thành viên</div><br clear="all">

<div style="width:300px;float:left;" align="center"><input id="pass" name="pass" class="vpb_textAreaBoxInputs" type="text"></div>
<br clear="all">
<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">&nbsp;</div>
<div style="width: 290px;float:left;" align="center">

<a href="javascript:xacnhan();" id="btnXacnhan" class="myButton" 
onclick="">Xác nhận</a>

<a href="javascript:void(0);" class="myButton" onclick="vpb_hide_popup_boxes();">Bỏ qua</a>
</div>

<br clear="all"><br clear="all">
</div>

<!-- Login Box Ends Here -->

<script type="text/javascript">
$("#pass").keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {            
                xacnhan();
            }
        });
function xacnhan(){
	var code = $("#pass").val();	
	var url="<?php echo $liveSite;?>/z_includes/kt_xacnhan.php?code="+code;
	$.ajax({ 
		 url: url,
		 type: "POST",
		 dataType: "json",
		 //async: false,
		 complete: function () {
		 },
		 success: function (reqData) {					 
			//divId="#"+divId;
			if(reqData=="thanhcong")
			{
				window.location.href="<?php echo $liveSite;?>/tin-tuc-noi-bo/index.html";
			}	
			else {
				alert("Sai mã thành viên.")
				return false;
			}
		 }
		 , error: function () {
		 }
	 });	
}
</script>