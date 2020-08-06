<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";
	

	
	$goname		= $_SESSION[customer][idx];
	$goname		= $_GET['goname'];
	$fromhp		= $_GET['fromhp'];
	$fromhp		= str_replace("-","",$fromhp);
	$bytes		= $_GET['len_sms'];
	$smstexts	= $_GET['sms_text'];

	// 모바일 PC 체크
	
	$mobile = !!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile'));

	if($mobile){
		$chk_m = "m";
	}else{
		$chk_m = "p";
	}

	
	for($i=0; $i<sizeof($chkNum); $i++){

		$toname = $chkNum[$i];
		$r_idx	= ${"r_idx_".$toname};
		$ss_hp	= ${"phone_".$toname};
		$ss_hp = str_replace("-","",$ss_hp);


		//$bytes  = mb_strlen($smstexts, 'euc-kr');

		//echo $bytes . " : " . $smstexts . "<br/>";

		if( $bytes > 80){

			
			$spend_type = "M";
			
			
			$sql = "insert into MMS_MSG (SUBJECT, PHONE, CALLBACK, REQDATE, MSG, FILE_CNT, FILE_PATH1, FILE_PATH1_SIZ, ETC1, ETC2, ETC3, ETC4) value ( '".$title_temp."', '".$ss_hp."','".$fromhp."',now(),'".$smstexts."',0,'','','".$chk_m."','".$r_idx."','".$goname."','".$spend_type."')";
			
			

		}else{

			
			$spend_type = "M";
			
			
			$sql = "insert into SC_TRAN (TR_SENDDATE, TR_ETC1, TR_ETC4, TR_ETC5, TR_ETC6, TR_PHONE, TR_CALLBACK, TR_MSG, TR_SENDSTAT, TR_MSGTYPE) value ( now(),'".$chk_m."','".$spend_type."','".$r_idx."','".$goname."','".$ss_hp."','".$fromhp."','".$smstexts."','0','0');";

			

		}
		

		mysql_query("set names utf8" );
		mysql_query($sql) or die(mysql_error());
		//echo $sql . "<br/>";
		
	}
	
?>
<section class="pops_wrap">


</section>

<script type="text/javascript">
	alert("문자가 접수되었습니다.\r\n발송까지 1분미만 소요됩니다.");
	parent.location.reload();

	//location.href="/works02/sms_list.php";
</script>