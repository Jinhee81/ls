<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$b_idx = $_GET['b_idx'];

$sql_c = "select count(*) as cnts from tbl_contract where b_idx = '".$b_idx."' ";
$result_c = mysql_query($sql_c);
$row_c = mysql_fetch_array($result_c);

if($row_c['cnts'] > 0){
	echo "n";
	exit;
}else{
	$sql_m = " delete from tbl_room where b_idx = '".$b_idx."' ";
	mysql_query($sql_m);

	$sql_m = " delete from tbl_build where idx = '".$b_idx."' ";
	mysql_query($sql_m);

	echo "y";
}