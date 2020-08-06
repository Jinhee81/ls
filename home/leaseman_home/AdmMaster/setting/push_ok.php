<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	$send_date		= updateSQ($_POST[send_date]);
	$send_time		= updateSQ($_POST[send_time]);
	$title			= updateSQ($_POST[title]);
	$content		= updateSQ($_POST[content]);

	$reg_id	= $_SESSION[member][id];

	$sql = "";
	$sql = $sql . "INSERT INTO	  tbl_push "					;
	$sql = $sql .			   " (reg_id "     					;
	$sql = $sql .			   " ,title "						;
	$sql = $sql .			   " ,content "						;
	$sql = $sql .			   " ,send_date "					;
	$sql = $sql .			   " ,send_time "					;
	$sql = $sql .			   " ,reg_date) "					;
	$sql = $sql .	   "VALUES "						        ;
	$sql = $sql .			   " ('[%reg_id%]' "				;
	$sql = $sql .			   " ,'[%title%]' "					;
	$sql = $sql .			   " ,'[%content%]' "				;
	$sql = $sql .			   " ,'[%send_date%]' "				;
	$sql = $sql .			   " ,'[%send_time%]' "				;
    $sql = $sql .			   " ,now() ) "    					;

	$sql = str_replace("[%reg_id%]",   			$reg_id,			$sql);
	$sql = str_replace("[%title%]",				$title,				$sql);
	$sql = str_replace("[%content%]",			$content,			$sql);
	$sql = str_replace("[%send_date%]",			$send_date,			$sql);
	$sql = str_replace("[%send_time%]",			$send_time,			$sql);
	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

	


?>

<script type="text/javascript">
	alert("등록되었습니다.");
	parent.location.reload();
</script>