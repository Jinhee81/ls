<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	$user_id	= $_GET[user_id];
	

	$total_sql = " select count(*) as cnt from tbl_customer where user_id='".$user_id."'";
	$result = mysql_query($total_sql) or die (mysql_error());
	$row=mysql_fetch_array($result);	

	echo $row[cnt];
?>