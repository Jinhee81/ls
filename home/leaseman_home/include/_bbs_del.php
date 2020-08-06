<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
	$upload="../data/bbs/";

	$tot=count($bbs_idx);
	for ($j=0;$j<$tot;$j++){
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx[$j]."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		if ($_SESSION[member][level] == "1" || $_SESSION[member][id] == $row[user_id]) {
		} else {
			if ($row[passwd] != $pass) { 
	?>
			<script>	
				alert("패스워드가 일치하지 않습니다.");
				history.back();
			</script>
	<?
			exit();
			}

		}
		$rfile1		= $row[rfile1];
		$rfile2		= $row[rfile2];
		$rfile3		= $row[rfile3];
		$rfile4		= $row[rfile4];
		$rfile5		= $row[rfile5];

		for ($a=1;$a<=5;$a++) {
			if (${"rfile".$a} != "")
			{
				unlink($upload.${"rfile".$a});
			}
		}

		$sql = " delete from tbl_bbs_list where bbs_idx='".$bbs_idx[$j]."'";
		mysql_query($sql);
	}
?>
<script>
	alert("삭제처리되었습니다.");
	parent.location.href="<?=$gourl?>?code=<?=$code?>&pg=<?=$pg?>";
</script>