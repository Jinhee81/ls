<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 

	$subject			= updateSQ($_POST["subject"]);
	$user_name			= updateSQ($_POST["user_name"]);
	$gubun				= updateSQ($_POST["gubun"]);
	$user_phone			= updateSQ($_POST["user_phone_1"])."-".updateSQ($_POST["user_phone_2"])."-".updateSQ($_POST["user_phone_3"]);
	$user_email			= updateSQ($_POST["user_email"]);
	$visit_date			= updateSQ($_POST["visit_date"]);
	$visit_store		= updateSQ($_POST["visit_store"]);
	$contents			= updateSQ($_POST["contents"]);
	$ip_address			= $_SERVER['REMOTE_ADDR'];
	if ($user_name == "" || $_POST["user_phone_1"] == "" || $_POST["user_phone_2"] == "" || $_POST["user_phone_3"] == "" || $_POST["visit_date"] == "" || $_POST["visit_store"] == "")
	{
		exit();
	}


	$sql = "
		insert tbl_qna SET 
			subject			= '".$subject."'
			,user_name		= '".$user_name."'
			,gubun			= '".$gubun."'
			,user_phone		= '".$user_phone."'
			,user_email		= '".$user_email."'
			,visit_date		= '".$visit_date."'
			,visit_store	= '".$visit_store."'
			,contents		= '".$contents."'
			,ip_address		= '".$ip_address."'
			,r_date			= now()

	";
	mysql_query($sql) or die (mysql_error());

	if ($gubun == "01")
	{
		$gubunStr = "칭찬합니다";
	} elseif ($gubun == "02") {
		$gubunStr = "불만있습니다";
	} elseif ($gubun == "03") {
		$gubunStr = "창업희망";
	} elseif ($gubun == "04") {
		$gubunStr = "기타";
	}

	$_contents = $contents;
	$contents = "";
	$contents = $contents."제목 : ".$subject."<br>";
	$contents = $contents."이름 : ".$user_name."<br>";
	$contents = $contents."분류 : ".$gubunStr."<br>";
	$contents = $contents."연락처 : ".$user_phone."<br>";
	$contents = $contents."이메일 : ".$user_email."<br>";
	$contents = $contents."방문일자 : ".$visit_date."<br>";
	$contents = $contents."방문매장 : ".$visit_store."<br>";
	$contents = $contents."내용 : ".nl2br($_contents)."<br>";
	mailer("153부대찌게", "snrfood@naver.com", "familyitv@naver.com", "lifeess@naver.com", $user_name."님에게서 고객의 소리가 접수되었습니다.", $contents, 0, "", "utf-8");
?>
<script>
	alert("접수되었습니다.");
	location.href="/main/main.php";
</script>