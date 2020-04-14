<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$chkval = $_POST['chkval'];

$chkval = substr($chkval,1,sizeof($chkval)-2);



$chk_array = explode("||",$chkval);

for($i=0; $i<sizeof($chk_array); $i++){
	$tmp_idx = $chk_array[$i];

	$sql_de = "select idx from tbl_contract_sub where callnum = '".$tmp_idx."' order by idx asc limit 1";
	$result_de = mysql_query($sql_de);
	$row_de = mysql_fetch_array($result_de);

	
	$sql_mo = " update tbl_contract_sub set r_date = '', r_price = ''   where idx = '".$row_de['idx']."' ";
	mysql_query($sql_mo);

	
}

echo "y";
?>