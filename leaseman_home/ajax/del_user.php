<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

$chkId		= $_GET['chkId'];
$chkId = substr($chkId,1,strlen($chkId)-2);
$array_chk = explode("||",$chkId);



for($i=0; $i<sizeof($array_chk); $i++){
	// 회원 정보
	$sql_m = "delete from tbl_user where r_idx = '".$array_chk[$i]."'";
	mysql_query($sql_m);
}
echo "y";
?>