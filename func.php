<?php
function	get_page($alias)
{
	global $db , $_fix;
	
	$alias = $db->escape($alias);
	
	$db->query("UPDATE tgp_page SET luot_xem = luot_xem + 1 WHERE alias = '".$alias."'");
	$r	=	$db->select("tgp_page","alias = '".$alias."'");
	while ($row = $db->fetch($r))
	{
		return $row["noi_dung"];
	}
	
	return "Unknown Alias";
}
function gui_mail($nguoigoi,$nguoinhan,$tieude,$noidung)
{
	global $conf;
	
			$header="From: ".$nguoigoi."\n";
			$header .="Content-Type:text/html;";
			$header .="charset=UTF-8\n";
			$noidung =	str_replace("\n"	, "<br>"	, $noidung);
			$noidung =	str_replace("  "	, "&nbsp; "	, $noidung);
			$noidung =	str_replace("<script>","&lt;script&gt;", $noidung);

			$noidung =  $noidung;
			
			return (@mail($nguoinhan, $tieude, "$noidung", "$header"));
			
	return $KQ;
}
function	get_title()
{
	global $db;
	$txt	=	"";
	
	$r	=	$db->select("tgp_product_menu","","order by rand() asc limit 10");
	while ($row = $db->fetch($r))
	{
		$txt .= " - ".lg_string::bo_dau($row["ten"]);
	}
	
	return $txt;
}

?>