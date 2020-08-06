<link rel="stylesheet" href="/include/css/bbs.css" type="text/css">
<div class="page">
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
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_pass.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_write.inc.php";
		}
	} elseif ($_GET[mode] == "delete") {
		include $_SERVER[DOCUMENT_ROOT]."/include/notice_pass.inc.php";
	
	} elseif ($mode == "view") {

		if ($smode == "secure") {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_pass.inc.php";
		} else if ($skin == "default") {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_view.inc.php";
		} else if ($skin == "chamber") {
			include $_SERVER[DOCUMENT_ROOT]."/include/chamber_view.inc.php";
		} else if ($skin == "default2") {
			include $_SERVER[DOCUMENT_ROOT]."/include/qna_view.inc.php";
		} else if ($skin == "free") {
			include $_SERVER[DOCUMENT_ROOT]."/include/free_view.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/include/qna_view.inc.php";
		}



	} elseif ($mode == "reply") {
		include $_SERVER[DOCUMENT_ROOT]."/include/notice_write.inc.php";
	} else {

		if ($skin == "faq") {
			include $_SERVER[DOCUMENT_ROOT]."/include/faq_list.inc.php";
		} else if ($skin == "event") {
			include $_SERVER[DOCUMENT_ROOT]."/include/event_list.inc.php";
		} else if ($skin == "blog") {
			include $_SERVER[DOCUMENT_ROOT]."/include/blog_list.inc.php";
		} else if ($skin == "default") {
			include $_SERVER[DOCUMENT_ROOT]."/include/notice_list.inc.php";
		} else if ($skin == "default2") {
			include $_SERVER[DOCUMENT_ROOT]."/include/qna_list.inc.php";
		} else if ($skin == "free") {
			include $_SERVER[DOCUMENT_ROOT]."/include/free_list.inc.php";
		} else if ($skin == "chamber") {
			include $_SERVER[DOCUMENT_ROOT]."/include/chamber_list.inc.php";
		} else {
			include $_SERVER[DOCUMENT_ROOT]."/include/qna_list.inc.php";
		}

	}
?>
</div>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>