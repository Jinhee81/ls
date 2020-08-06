<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

// 자동쓰기 방지 체크
if(isset($_POST["captcha"])&& $_POST["captcha"] !="" && $_SESSION["code"] == $_POST["captcha"])
{


	$subject			= updateSQ($_POST["product_name"]);
	$user_name			= updateSQ($_POST["user_name"]);
	$price				= updateSQ($_POST["price"]);
	$user_phone			= updateSQ($_POST["user_phone_1"])."-".updateSQ($_POST["user_phone_2"])."-".updateSQ($_POST["user_phone_3"]);
	$user_tel			= updateSQ($_POST["user_tel_1"])."-".updateSQ($_POST["user_tel_2"])."-".updateSQ($_POST["user_tel_3"]);
	$user_email			= updateSQ($_POST["user_email"]);
	$user_pw			= updateSQ($_POST["user_pw"]);
	$contents			= updateSQ($_POST["contents"]);

	$sql = "
		insert tbl_shop_qna SET
			product_name			= '".$subject."'
			,user_name		= '".$user_name."'
			,price			= '".$price."'
			,user_phone		= '".$user_phone."'
			,user_email		= '".$user_email."'
			,user_tel		= '".$user_tel."'
			,user_pw		= '".$user_pw."'
			,contents		= '".$contents."'
			,r_date			= now()

	";
	//테스트 이메일
	//$admin_email ="xordud99@naver.com";
	mysql_query($sql) or die (mysql_error());

	$_contents = $contents;
	$contents = "";
	$contents = $contents."제품명 : ".$subject."<br>";
	$contents = $contents."업체명/담당자 : ".$user_name."<br>";
	$contents = $contents."휴대폰 : ".$user_phone."<br>";
	$contents = $contents."연락처 : ".$user_tel."<br>";
	$contents = $contents."이메일 : ".$user_email."<br>";
	$contents = $contents."제품수량 : ".$price."<br>";
	$contents = $contents."문의내용 : ".nl2br($_contents)."<br>";
	//mailer("김차장", $admin_email, $admin_email,  $user_name."님에게서 건젹문의가 접수되었습니다.", $contents, 0, "", "utf-8");
	alert_msg("제휴문의가 등록되었습니다.","qna_write.php");

}else{
	alert_msg("자동방지숫자를 확인해주세요");
}


?>
