<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	if($idx){
		$sql = "delete from tbl_popup2 WHERE idx='$idx' ";

		mysql_query($sql);
	}


?>

<script type="text/javascript">
	alert("삭제되었습니다.");
	location.href="/AdmMaster/setting/list04.php";
</script>