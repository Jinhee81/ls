<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
	include $_SERVER[DOCUMENT_ROOT]."/include/user_check.php";
	$upload="../data/comment/";

	$total_sql	= " select * from tbl_bbs_comment where tbc_idx='".$cidx."'";

	$result		= mysql_query($total_sql) or die (mysql_error());
	$row		= mysql_fetch_array($result);
	$rfile1		= $row[rfile1];
	if ($_SESSION[member][level] != "0" &&  $row[m_idx] != $_SESSION[member][idx]) {
		alert_msg("정상적으로 이용바랍니다.", "about:blank");
	}

	for ($a=1;$a<=1;$a++) {
		if (${"rfile".$a} != "")
		{
			@unlink($upload.${"rfile".$a});
			@unlink($upload.str_replace("img","thumb",${"rfile".$a}));
		}
	}
	$sql = " delete from tbl_bbs_comment where tbc_idx='".$cidx."'";
	mysql_query($sql);

?>
<script>
	alert("삭제처리되었습니다.");
	parent.location.reload();
</script>