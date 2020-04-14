<?
	$fsql = " select * from tbl_bbs_config where board_code='$code' ";

	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[tbc_idx] == "") {
		alert_msg("정상적으로 이용바랍니다.");
		exit();
	} else {
		$board_name		= $frow[board_name];
		$board_code		= $frow[board_code];
		$isCategory		= $frow[is_category];	
		$isSecure		= $frow[is_secure];
		$isRight		= $frow[is_right];
		$isReply		= $frow[is_reply];
		$isComment		= $frow[is_comment];
		$isRecomm		= $frow[is_recomm];
		$isNotice		= $frow[is_notice];
		$skin			= $frow[skin];
		$is_comment		= $frow[is_comment];
	}
?>
<div class="com_hbox" style="display:none;"><h2 class="com_h2" data-type="<?if($code =="h_faq" || $code =="h_movie" ){echo "리스맨매뉴얼";}else{echo "게시판관리";}?>" data-title="<?=$board_name?>"></h2></div>