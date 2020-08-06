<?
	$csql		= " select * from tbl_bbs_config where board_code = '$code' ";
	$cresult	= mysql_query($csql) or die (mysql_error());
	$crow		= mysql_fetch_array($cresult);
	$is_comment	= $crow[is_comment];
	$is_reply	= $crow[is_reply];
	$is_right	= $crow[is_right];
	$is_notice	= $crow[is_notice];
	$isReply	= $crow[is_reply];
	$is_secure  = $crow[is_secure];
	$skin		= $crow[skin];

	
	$bbs_idx	= updateSQ($bbs_idx);
	$mode	= updateSQ($mode);
	if ($mode == "write" || $mode == "modify" ) {
			include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_write.inc.php";
		/*
		if ($smode == "secure") {
			include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_pass.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_write.inc.php";
		}
		*/
	} elseif ($_GET[mode] == "delete") {
		include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_pass.inc.php";
	} elseif ($mode == "view") {
			include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_view.inc.php";
		/*
		if ($smode == "secure") {
			include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_pass.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_view.inc.php";
		}
		*/
	} elseif ($mode == "reply") {
		include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_write.inc.php";
	} else {
		if ($skin == "blog") {
		include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/blog_list.inc.php";
		} else if ($skin == "gallery") {
		include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/gallery_list.inc.php";
		} else {
		include $_SERVER[DOCUMENT_ROOT]."/skin/board/".$skin."/notice_list.inc.php";
		}
	}
?>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>