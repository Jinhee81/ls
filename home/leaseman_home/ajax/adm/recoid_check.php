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
	

	$total_sql = " select * from tbl_customer where user_id like '%".$user_id."%'";
	$result = mysql_query($total_sql) or die (mysql_error());
	while($row=mysql_fetch_array($result)){
		echo "<li onclick='reco_subs(this);' >".$row['user_id']."</li>";
	}
?>