<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);


////////////////////////////////////////////////////////////
// 파일 인클루드 / 객체 생성
////////////////////////////////////////////////////////////
		$user_email		= updateSQ($_POST['user_email']);
		
		$return =array();
		$total_sql = " select * from tbl_member where user_email='".$user_email."'";
		$result = mysql_query($total_sql) or die (mysql_error());
		$row=mysql_fetch_array($result);	
		$auth_level = $row[manage];
		if ($row['user_id'] != "") {
			//아이디가 없습니다.
			$return['msg'] ="이미 사용중인 E-mail 입니다.";
			$return['stat'] =1;
		}

		$return =json_encode($return);
		echo $return;

	
		
	
?>