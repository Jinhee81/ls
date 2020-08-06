<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$chkval = $_POST['chkval'];
$chkval = substr($chkval,1,sizeof($chkval)-2);

$chk_array = explode("||",$chkval);


// 메인 정보 캐치
$sql_lis = "select c_idx from tbl_contract_sub where idx = '".$chk_array[0]."' ";
$result_lis = mysql_query($sql_lis);
$row_lis = mysql_fetch_array($result_lis);

$sql_ko = " update tbl_contract set m_date = now()  where idx = '".$row_lis['c_idx']."' ";
mysql_query($sql_ko);


for($i=0; $i<sizeof($chk_array); $i++){
	$tmp_idx = $chk_array[$i];

	$sql_mo = " update tbl_contract_sub set income_type = '3', status = 0, callnum = '' where idx = '".$tmp_idx."' ";
	mysql_query($sql_mo);
}

echo "y";
?>