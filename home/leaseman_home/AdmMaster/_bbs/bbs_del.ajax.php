<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 

	mysql_query("SET AUTOCOMMIT=0");
	mysql_query("START TRANSACTION");
	
	$upload = "../data/bbs/";
	$tot=count($bbs_idx);
	for ($j=0;$j<$tot;$j++){
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx[$j]."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);

		$rfile1		= $row[rfile1];
		$rfile2		= $row[rfile2];
		$rfile3		= $row[rfile3];
		$rfile4		= $row[rfile4];
		$rfile5		= $row[rfile5];

		for ($a=1;$a<=5;$a++) {
			if (${"rfile".$a} != "")
			{
				@unlink($upload.${"rfile".$a});
			}
		}

		$sql = " delete from tbl_bbs_list where bbs_idx='".$bbs_idx[$j]."'";

		$db1	= mysql_query($sql);
		if (!$db1) {
			mysql_query("ROLLBACK");
			echo "NO1";
			exit();
		}
	}
	if ($db1) {
		echo "OK";
		mysql_query("COMMIT");
	} else {        
		//rollback
		mysql_query("ROLLBACK");
		echo "NO";
	}
	mysql_close($connect);
?>