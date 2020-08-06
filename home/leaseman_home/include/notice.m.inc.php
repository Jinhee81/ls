<?
	$csql		= " select * from tbl_bbs_config where board_code = '$code' ";
	$cresult	= mysql_query($csql) or die (mysql_error());
	$crow		= mysql_fetch_array($cresult);
	$is_comment	= $crow[is_comment];
	$is_reply	= $crow[is_reply];
	$is_right	= $crow[is_right];
	$isReply	= $crow[is_reply];
	$is_secure  = $crow[is_secure];
	$skin		= $crow[skin];

	
	$bbs_idx	= updateSQ($bbs_idx);
	$mode	= updateSQ($mode);
	if ($mode == "write" || $mode == "modify" ) {
		if ($smode == "secure") {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_pass.m.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_write.m.inc.php";
		}
	} elseif ($_GET[mode] == "delete") {
		include $_SERVER[DOCUMENT_ROOT]."/include/notice_pass.m.inc.php";
	} elseif ($mode == "view") {
		if ($smode == "secure") {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_pass.m.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_view.m.inc.php";
		}
	} elseif ($mode == "reply") {
		include $_SERVER[DOCUMENT_ROOT]."/include/notice_write.m.inc.php";
	} else {
		if ($skin == "blog") {
		include $_SERVER[DOCUMENT_ROOT]."/include/blog_list.m.inc.php";
		} else if ($skin == "gallery") {
		include $_SERVER[DOCUMENT_ROOT]."/include/gallery_list.m.inc.php";
		} else {
		include $_SERVER[DOCUMENT_ROOT]."/include/notice_list.m.inc.php";
		}
	}
?>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>