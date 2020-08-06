<?
	//=====================================================
	//	데이터베이스 접속 정보
	//=====================================================
	$DB_HOST="localhost";
	$DB_USER="lguplus";
	$DB_PWD="1q2w3e4r";
	$DB_NAME="lguplus";	

	$connect = mysql_connect($DB_HOST, $DB_USER, $DB_PWD);
	mysql_query("set names utf8",$connect);
	mysql_select_db($DB_NAME, $connect);

	include($_SERVER[DOCUMENT_ROOT].'/include/basic_class.php');
	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();

	
	$bytes = $_POST['bytes'];

	$toname = $_POST['toname'];
	$goname = $_POST['goname'];
	$ss_hp = $_POST['ss_hp'];

	$ss_hp = str_replace("-","",$ss_hp);

	$fromhp = $_POST['fromhp'];

	$fromhp = str_replace("-","",$fromhp);

	$smstexts = $_POST['smstexts'];

	/*
	$bytes  = 50;
	$smstexts = "테스트 입니다.";
	$fromhp = "0236670774";
	$ss_hp = "01022980203";
	*/

	
		if( $bytes > 80){

			$sql = "insert into MMS_MSG (SUBJECT, PHONE, CALLBACK, REQDATE, MSG, FILE_CNT, FILE_PATH1, FILE_PATH1_SIZ, ETC2, ETC3) value ( '".$title_temp."', '".$ss_hp."','".$fromhp."',now(),'".$smstexts."',0,'','','".$toname."','".$goname."')";

		}else{
			$sql = "insert into SC_TRAN (TR_SENDDATE, TR_ETC5, TR_ETC6, TR_PHONE, TR_CALLBACK, TR_MSG, TR_SENDSTAT, TR_MSGTYPE) value ( now(),'".$toname."','".$goname."','".$ss_hp."','".$fromhp."','".$smstexts."','0','0');";
		}
		
		mysql_query("set names utf8" );
		mysql_query($sql) or die(mysql_error());
		
		
?>

<script type="text/javascript">
	alert("문자가 접수되었습니다.\r\n발송까지 1분미만 소요됩니다.");
	location.href="/works02/sms_list.php";
</script>