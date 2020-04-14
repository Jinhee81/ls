<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 

	$user_name			= updateSQ($_POST["user_name"]);
	$phone			= updateSQ($_POST["phone"]);
	$ip_address			= $_SERVER['REMOTE_ADDR'];
	if ($user_name == "" || $_POST["phone"] == "")
	{
		echo "NO";
		exit();
	}


	$sql = "
		insert tbl_phone SET 
			user_name		= '".$user_name."'
			,phone		= '".$phone."'
			,ip_address		= '".$ip_address."'
			,r_date			= now()

	";
	mysql_query($sql) or die (mysql_error());

	/*
	$contents = "";
	$contents = $contents."구분 : ".$gubunStr."<br>";
	$contents = $contents."이름 : ".$user_name."<br>";
	$contents = $contents."성별 : ".$user_sex."<br>";
	$contents = $contents."연락처 : ".$phone."<br>";
	$contents = $contents."연령 : ".$age."<br>";
	$contents = $contents."이메일 : ".$user_email."<br>";
	$contents = $contents."우편번호 : ".$zip."<br>";
	$contents = $contents."주소 : ".$addr1.$addr2."<br>";
	$contents = $contents."".$gubunStr."희망지역 : ".$sido." ".$gugun." <br>";
	$contents = $contents."우편번호 : ".$price."<br>";
	$contents = $contents."책자 : ".$book_yn."<br>";
	mailer("셔프20", "info@chef20.co.kr", "withchef20@naver.com", $gubunStr."문의가 신청되었습니다.", $contents, 0, "", "utf-8");
	*/
	$contents = $contents."성명 : ".$user_name."<br>";
	$contents = $contents."연락처 : ".$phone."<br>";
	mailer("153부대찌게", "snrfood@naver.com", "familyitv@naver.com", "lifeess@naver.com", $user_name."님에게서 가맹문의가 접수되었습니다.", $contents, 0, "", "utf-8");
?>
<script>
	alert("접수되었습니다.");
	location.href="/main/main.php";
</script>