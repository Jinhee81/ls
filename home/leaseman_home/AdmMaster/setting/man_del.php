<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	$m_idx			= updateSQ($_GET[m_idx]);
	

	$sql = "";
	$sql = $sql . "delete from  tbl_admin where m_idx = '[%m_idx%]' "		;

	$sql = str_replace("[%m_idx%]",   				$m_idx,					$sql);
	
	
	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());


?>

<script type="text/javascript">
	alert("삭제되었습니다.");
	location.href="/AdmMaster/setting/list02.php";
</script>