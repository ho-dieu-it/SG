<?php
@session_start();
//error_reporting(E_ALL & ~( E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED ));
$func = $_POST['func'];
$CHECK = TRUE;// if true is send mail....
// load the variables form address bar

if ($func=='send')
{
	$verif_box = $_POST["txtCode"];

	// check to see if verificaton code was correct
	// if (empty($from)) 	$from = "";
		// if (empty($txtName)) 	$txtName = "";
		// if (empty($txtSubject)) $txtSubject = "";
		// if (empty($txtContent)) $txtContent = "";
		
		// if (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txtEmail)) {
			// $CHECK=FALSE;
			// $thongbao = "Email của bạn không hợp lệ !";
		// }
		// else if (empty($txtName)){
			// $CHECK=FALSE;
			// $thongbao = "Vui lòng nhập tên của bạn";
		// }
		// else if (empty($txtSubject)){
			// $CHECK=FALSE;
			// $thongbao = "Bạn chưa nhập Chủ đề\n";
		// }
		// else if (empty($txtContent)){
			// $CHECK=FALSE;
			// $thongbao = "Bạn chưa nhập nội dung\n";
		// }
	
}
$thongbao="";
if(isset($_SESSION['msg'])){
$thongbao=$_SESSION['msg'];
  unset($_SESSION['msg']);
}

?>
<div class="detail">
  <h1><span>LIÊN HỆ</span></h1>
  <div class="content"> <?php echo get_page("lien_he")?> </div>
</div>
<div class="detail">
  <h1></h1>
  <div class="content"> 
  <div class="detail">
    <script>
function CheckForm ()
{
	if (document.frmContact.txtName.value == ''){
		 alert('Bạn chưa nhập họ & tên.');
		 document.frmContact.txtName.focus();
		 return false;
		}
	if (document.frmContact.txtAddress.value == ''){
	 alert('Bạn chưa nhập địa chỉ.');
	 document.frmContact.txtAddress.focus();
	 return false;
	}
	if (document.frmContact.txtTel.value == ''){
	 alert('Bạn chưa nhập điện thoại.');
	 document.frmContact.txtTel.focus();
	 return false;
	}if (document.frmContact.txtEmail.value == ''){
		 alert('Bạn chưa nhập email.');
		 document.frmContact.txtEmail.focus();
		 return false;
	}
	if (!email.match(/^([-\d\w][-.\d\w]*)?[-\d\w]@([-\w\d]+\.)+[a-zA-Z]{2,6}$/)){
		alert('Địa chỉ email không hợp lệ.');
		document.frmContact.txtEmail.focus();
		return false;
	}
	if (document.frmContact.txtSubject.value == ''){
		//alert('Bạn chưa nhập chủ đề.');
		document.frmContact.txtSubject.value="";
		//return false;
	}
	if (document.frmContact.txtContent.value == ''){
		//alert('Bạn chưa nhập nội dung.');
		document.frmContact.txtContent.value="";
		//document.frmContact.txtContent.focus();
		//return false;
	 }
	 if (document.frmContact.txtCode.value == ''){
		//alert('Bạn chưa nhập nội dung.');
		document.frmContact.txtCode.value="";
		//document.frmContact.txtContent.focus();
		//return false;
	 }
	return true;
}
</script>
    <form name="frmContact" onsubmit="return CheckForm();" method="post" action="<?php echo $liveSite;?>/lib/mail/mailer.php">
      <input type="hidden" name="func" value="send" />
      <center>
        <table border="0" style="border-collapse: collapse;" width="95%" cellpadding="5" cellspacing="0">
		 
          <tr>
            <td colspan="2" align="left"><?php //echo !empty($thongbao)?"<div class=error style='height:0px;font-weight:bold;'>".$thongbao."</div><br />":""?></td>
          </tr>
          <tr>
            <td colspan="2" align="left"><p><strong>Hãy góp ý và trao đổi với chúng tôi qua mẫu bảng Form dưới đây, chúng tôi sẵn sàng lắng nghe các ý kiến đóng góp của quý vị : </strong></p>
              <p>&nbsp;</p></td>
          </tr>
		  <tr>
            <td colspan="2"><?php if(!empty($thongbao)){?>
				<div style="border:1px solid #990000; background-color:#D70000; color:#FFFFFF; padding:4px; padding-left:6px;width:295px;">
				<?php 
					echo $thongbao;
				?>
				</div><br /> 
				<?php ;}?>
			</td>
            
          </tr>
          <tr>
            <td width="30%"><div align="left">Họ và tên:</div></td>
            <td width="70%" align="left" style="padding:1px;"><input type="text" name="txtName" size="50" class="inputbox" maxlength="100" style="width:75%">
              (*)</td>
          </tr>
          <tr>
            <td><div align="left">Địa chỉ:</div></td>
            <td align="left" style="padding:1px;"><input type="text" name="txtAddress" size="50" class="inputbox" maxlength="50" style="width:75%"> (*)</td>
          </tr>
          <tr>
            <td><div align="left">Điên thoại:</div></td>
            <td align="left" style="padding:1px;"><input type="text" name="txtTel" size="50" class="inputbox" maxlength="20" style="width:75%"> (*)</td>
          </tr>
          <tr>
            <td><div align="left">E-mail:</div></td>
            <td align="left" style="padding:1px;"><input type="text" name="txtEmail" size="50" class="inputbox" maxlength="50" style="width:75%">
              (*)</td>
          </tr>
          <tr>
            <td><div align="left">Chủ đề:</div></td>
            <td align="left" style="padding:1px;"><input type="text" name="txtSubject" size="50" class="inputbox" maxlength="200" style="width:75%">
              </td>
          </tr>
		 
		  <tr>		  
            <td><div align="left">Mã bảo vệ::</div></td>
            <td align="left" style="padding:1px;">
			<input type="text" name="txtCode" size="50" class="inputbox" maxlength="200" style="width:28%">
			<img src="<?php echo $liveSite;?>/lib/captcha.v.1/verificationimage.php" alt="verification image, type it in the box" width="50" height="24" align="absbottom" />
              </td>
          </tr>
          <tr>
            <td><div align="left"> Nội dung :</div></td>
            <td align="left" style="padding:1px;"><textarea rows="5" name="txtContent" cols="32" class="inputbox" style="width:75%;" ></textarea>
              </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td ><div align="left">
                <input type="submit" value="   Gửi   " name="btnSend" class="button" style="width:20%">
                &nbsp;
                <input type="reset" value="Viết lại" name="btnReset" class="button" style="width:20%">
              </div></td>
          </tr>
        </table>
      </center>
    </form>	
  </div>
  </div>
</div>
