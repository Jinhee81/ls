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
		$user_pw		= updateSQ($_POST['user_pw']);
		$user_name		= updateSQ($_POST['user_name']);
		$mobile			= updateSQ($_POST['mobile']);
		$mode			= updateSQ($_POST['mode']);
		$user_id =$user_email;
		
		
		
			$return2 =array();
			$sql = "
			insert into tbl_member SET 
				user_name		= '".$user_name."'
				,user_id		= '".$user_id."'
				,mobile			= '".$mobile."'
				,user_email		= '".$user_email."'
				,user_level		= 2
				,r_date		    = now();
			";
			mysql_query($sql) or die (mysql_error());
			
			$sql1 ="select * from tbl_member where user_id ='".$user_id."' ";
			$result1 = mysql_query($sql1) or die (mysql_error());
			$row2=mysql_fetch_array($result1);
			
			$_SESSION['member']['id']	= $row2['user_id'];
			$_SESSION['member']['idx']	= $row2['m_idx'];
			$_SESSION['member']['name'] = $row2['user_name'];
			$_SESSION['member']['email'] = $row2['user_email'];
			$_SESSION['member']['level'] = $row2['user_level'];

			$return2['msg'] ="회원가입이 되었습니다..";
			$return2['stat'] =2;
			$return2 =json_encode($return2);
			echo $return2;
			exit();

	
	
?>