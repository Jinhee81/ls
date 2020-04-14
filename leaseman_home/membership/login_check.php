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
		$user_id	= updateSQ($_POST['user_id']);
		$user_pw	= updateSQ($_POST['user_pw']);

		$total_sql = " select * from tbl_customer where user_id='".$user_id."'";
		$result = mysql_query($total_sql) or die (mysql_error());
		$row=mysql_fetch_array($result);	
		$auth_level = $row['manage'];
		if ($row['user_id'] == "") {
			//아이디가 없습니다.
			alert_msg("존재하지 않는 아이디입니다.");
			exit();
		}

		if ($row["user_pw"] != sql_password($user_pw)) {
			alert_msg("패스워드가 일치하지 않습니다.");
			exit();
		}
		
		

		$_SESSION[member][id]		= $row[user_id];
		$_SESSION[member][idx]		= $row[c_idx];
		$_SESSION[member][name]		= $row[user_name];
		$_SESSION[member][email]	= $row[user_email];
		$_SESSION[member][level]	= $row[user_level];
		$_SESSION[member][chmods]	= $row[chmods];
		$_SESSION[member][mobile]	= $row[mobile];
?>
<script src="../js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script>
var user_id ='<?=$user_id?>';
var user_pw ='<?=$user_pw?>';

function cross_login(user_id,user_pw ){
	
	$.ajax({
		type: "GET", // GET, POST
		dataType: "jsonp", // json, text
		url: "http://sv.leaseman.co.kr/main/login_check2.php",
		data: {"user_id":user_id,"user_pw":user_pw},
		success: function(data, textStatus){
			alert("로그인 되었습니다.");
			location.href="/";
			//alert(data);
			
		}
	});
	
}
cross_login(user_id,user_pw );
alert("로그인 되었습니다.");
location.href="/";
</script>