<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

// 모바일 PC 체크

$mobile = !!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile'));

if($mobile){
	$chk_m = "m";
}else{
	$chk_m = "p";
}

	
$idx = $_GET['idx'];
$types = $_GET['types'];

//echo $types;
if($types=="S"){

	$total_sql = "
	select TR_SENDDATE, TR_ETC1, TR_ETC5, TR_ETC6, TR_PHONE, TR_CALLBACK, TR_MSG, TR_SENDSTAT, TR_MSGTYPE
	 from SC_TRAN where  tr_num = '".$idx."' ";
	$result = mysql_query($total_sql) or die (mysql_error());
	$row = mysql_fetch_array($result);

	
	$goname = $row['TR_ETC5'];
	$toname = $row['TR_ETC6'];
	$ss_hp = $row['TR_PHONE'];
	$fromhp = $row['TR_CALLBACK'];
	$smstexts = $row['TR_MSG'];

	$tmp_cnt = get_sms_able();

	$spend_type = "M";
	
	

	$sql = "insert into SC_TRAN (TR_SENDDATE, TR_ETC1, TR_ETC4, TR_ETC5, TR_ETC6, TR_PHONE, TR_CALLBACK, TR_MSG, TR_SENDSTAT, TR_MSGTYPE) value ( now(),'".$chk_m."','".$spend_type."','".$toname."','".$goname."','".$ss_hp."','".$fromhp."','".$smstexts."','0','0');";

	
	
	
}else{

	$total_sql = "select SUBJECT, PHONE, CALLBACK, REQDATE, MSG, FILE_CNT, FILE_PATH1, FILE_PATH1_SIZ, ETC1, ETC2, ETC3 from MMS_MSG where msgkey = '".$idx."' ";
	$result = mysql_query($total_sql) or die (mysql_error());
	$row = mysql_fetch_array($result);

	$ss_hp = $row['PHONE'];
	$fromhp = $row['CALLBACK'];
	$smstexts = $row['MSG'];
	$toname = $row['ETC2'];
	$goname = $row['ETC3'];


	$tmp_cnt = get_sms_able();

	
	$spend_type = "M";
	
	

	$sql = "insert into MMS_MSG (SUBJECT, PHONE, CALLBACK, REQDATE, MSG, FILE_CNT, FILE_PATH1, FILE_PATH1_SIZ, ETC1, ETC2, ETC3, ETC4) value ( '".$title_temp."', '".$ss_hp."','".$fromhp."',now(),'".$smstexts."',0,'','','".$chk_m."','".$toname."','".$goname."','".$spend_type."')";


			
	


}

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

		
?>
<section class="pops_wrap">


</section>

<script type="text/javascript">
	alert("문자가 접수되었습니다.\r\n발송까지 1분미만 소요됩니다.");
	parent.location.reload();

</script>