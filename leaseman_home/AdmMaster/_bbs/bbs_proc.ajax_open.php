<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
	mysql_query("SET AUTOCOMMIT=0");
	mysql_query("START TRANSACTION");

	
	$contents		= $_POST[contents];
	
	
	$sql = "update tbl_open set contents='$contents' where idx = '1'";
	$db = mysql_query($sql);


	if ($db) {
		echo "OK";
		mysql_query("COMMIT");
	} else {        
		//rollback
		mysql_query("ROLLBACK");
		echo "NO";
	}
?>
