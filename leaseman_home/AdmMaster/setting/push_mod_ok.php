<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	$idx			= updateSQ($_POST[idx]);
	$send_date		= updateSQ($_POST[send_date]);
	$send_time		= updateSQ($_POST[send_time]);
	$title			= updateSQ($_POST[title]);
	$content		= updateSQ($_POST[content]);

	$mod_id	= $_SESSION[member][id];


	$sql = "";
	$sql = $sql . "UPDATE  tbl_push "							;
	$sql = $sql .   " SET    send_date='[%send_date%]'"			;
	$sql = $sql .         " ,send_time = '[%send_time%]' "		;
	$sql = $sql .         " ,title = '[%title%]' "				;
	$sql = $sql .         " ,content = '[%content%]' "			;
	$sql = $sql .         " ,mod_id = '[%mod_id%]' "			;
	$sql = $sql .         " ,mod_date = now() "					;
	$sql = $sql . " WHERE    idx = '[%idx%]' "					;

	$sql = str_replace("[%send_date%]",			$send_date,			$sql);
	$sql = str_replace("[%send_time%]",			$send_time,			$sql);
	$sql = str_replace("[%title%]",				$title,				$sql);
	$sql = str_replace("[%content%]",			$content,			$sql);
	$sql = str_replace("[%mod_id%]",   			$mod_id,			$sql);
	$sql = str_replace("[%idx%]",   			$idx,				$sql);
	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

	


?>

<script type="text/javascript">
	var idx = "<?=$idx?>";
	alert("수정되었습니다.");
	location.href="/AdmMaster/setting/list03_mod.php?idx=" + idx;
</script>