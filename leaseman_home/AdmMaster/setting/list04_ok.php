<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	$P_START_HH = str_pad(@trim($P_START_HH), 2, "0", STR_PAD_LEFT);
	$P_START_MM = str_pad(@trim($P_START_MM), 2, "0", STR_PAD_LEFT);
	$P_END_HH = str_pad(@trim($P_END_HH), 2, "0", STR_PAD_LEFT);
	$P_END_MM = str_pad(@trim($P_END_MM), 2, "0", STR_PAD_LEFT);




	$sql = "INSERT INTO tbl_popup2 (P_SUBJECT, P_STARTDAY, P_START_HH, P_START_MM, P_END_HH, P_END_MM, status, is_mobile, P_ENDDAY, P_MOVEURL, P_WIN_WIDTH, P_WIN_LEFT, P_CATE, P_STYLE, P_CONTENT, P_WIN_TOP, P_WIN_HEIGHT, rfile, ufile, r_date, reg_id)
				VALUES ('$P_SUBJECT', '$P_STARTDAY', '$P_START_HH', '$P_START_MM', '$P_END_HH', '$P_END_MM', '$status', '$is_mobile', '$P_ENDDAY', '$P_MOVEURL', '$P_WIN_WIDTH', '$P_WIN_LEFT', '$P_CATE', '$P_STYLE', '$P_CONTENT', '$P_WIN_TOP', '$P_WIN_HEIGHT', '$rfile_1', '$ufile_1', now(), '$reg_id');";

	mysql_query($sql);


?>

<script type="text/javascript">
	alert("등록되었습니다.");
	parent.location.reload();
</script>