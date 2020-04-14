<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";


$chkId		= $_GET['chkId'];


$chkId = substr($chkId,1,strlen($chkId)-2);
$array_chk = explode("||",$chkId);

$text1 = "";
for($i=0; $i<sizeof($array_chk); $i++){

	// 고객 탈퇴
	$sql_m = "update tbl_customer set status = '1' , e_date = now() where c_idx = '".$array_chk[$i]."' ";
	mysql_query($sql_m);
	
}
?>
<script type="text/javascript">

alert("탈퇴되었습니다.");
location.href="/AdmMaster/member/list01.php";

</script>