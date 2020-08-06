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

	//네비게이션 및 텍스트 변경
	switch($code){
		case "h_notice":
			$nav ="/sevice/sub_nav_03.php";
			$info_txt1 ="리스맨의 공지사항입니다.";
			$info_txt2 ="최적의 임대관리전문시스템 리스맨으로";
			$info_txt3 ="더욱 쉽게 임대관리를 시작하세요!";
			$visual_class="five";
			break;
		case "h_after":
			$nav ="/sevice/sub_nav_03.php";
			$info_txt1 ="리스맨 후기 게시판";
			$info_txt2 ="리스맨 사용 후 후기를 올려 주시는 게시판 입니다.";
			$info_txt3 ="당신의 경험을 공유해 주세요.";
			$visual_class="six";
			break;
		case "h_qna":
			$nav ="/sevice/sub_nav_03.php";
			$info_txt1 ="리스맨에 질문하세요!";
			$info_txt2 ="리스맨에 대해서 궁금하신 점이 있으시면";
			$info_txt3 ="언제든지 문의해주세요. 빠르게 도와드리겠습니다!";
			$visual_class="seven";
			break;
		case "h_faq":
			$nav ="/use_guide/sub_nav_02.php";
			$info_txt1 ="리스맨 매뉴얼 가이드";
			$info_txt2 ="최적의 임대관리전문시스템 리스맨으로";
			$info_txt3 ="더욱 쉽게 임대관리를 시작하세요!";
			$visual_class="eight";
			break;
		case "h_movie":
			$nav ="/use_guide/sub_nav_02.php";
			$info_txt1 ="리스맨의 사용법을 동영상으로 쉽게!";
			$info_txt2 ="사용자를 최우선으로 고려한 리스맨의 ";
			$info_txt3 ="다양한 기능을 확인하세요!";
			$visual_class="four";
			break;
	}
?>
<div class="com_hbox" style="display:none;"><h2 class="com_h2" data-type="게시판관리" data-title="<?=$board_name?>"></h2></div>