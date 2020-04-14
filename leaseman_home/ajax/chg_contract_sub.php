<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$chkval = $_POST['chkval'];
$b_date = $_POST['b_date'];
$income_type = $_POST['income_type'];


$chkval = substr($chkval,1,sizeof($chkval)-2);

$sql_re = "";

if($b_date){
	$sql_re .= " , b_date = '".$b_date."'";
	$callnum = create_contract_sub_code();
}

$chk_array = explode("||",$chkval);

$old_bdate = "";

// 메인 정보 캐치
$sql_lis = "select c_idx from tbl_contract_sub where idx = '".$chk_array[0]."' ";
$result_lis = mysql_query($sql_lis);
$row_lis = mysql_fetch_array($result_lis);

$sql_ko = " update tbl_contract set m_date = now()  where idx = '".$row_lis['c_idx']."' ";
mysql_query($sql_ko);


for($i=0; $i<sizeof($chk_array); $i++){
	$tmp_idx = $chk_array[$i];

	$sql_li = "select * from tbl_contract_sub where idx = '".$tmp_idx."' ";
	$result_li = mysql_query($sql_li);
	$row_li = mysql_fetch_array($result_li);

	if($b_date==""){
		if( $old_bdate != $row_li['b_date'] ){
			$callnum = create_contract_sub_code();
		}
	}



	$sql_mo = " update tbl_contract_sub set income_type = '".$income_type."', status = 1, callnum = '".$callnum."' ".$sql_re."  where idx = '".$tmp_idx."' ";
	mysql_query($sql_mo);

	$old_bdate = $row_li['b_date'];
}

echo "y";
?>