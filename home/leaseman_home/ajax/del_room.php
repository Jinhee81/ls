<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$r_idx = $_GET['r_idx'];

$sql_c = "select count(*) as cnts from tbl_contract where r_idx = '".$r_idx."' ";
$result_c = mysql_query($sql_c);
$row_c = mysql_fetch_array($result_c);

if($row_c['cnts'] > 0){
	echo "n";
	exit;
}else{


	// 정보를 뺴오자
	$sql_s = "select * from tbl_room where idx = '".$r_idx."' ";
	$result_s = mysql_query($sql_s);
	$row_s = mysql_fetch_array($result_s);

	$b_idx = $row_s['b_idx'];
	$ordernum = $row_s['ordernum'];

	// ordernum 정리
	$sql = "";
	$sql = $sql . "UPDATE  tbl_room "							;
	$sql = $sql .   " SET    ordernum = ordernum -1 "			;
	$sql = $sql . " WHERE    b_idx = '".$b_idx."' "				;
	$sql = $sql . "   AND    ordernum > '".$ordernum."' "		;
	mysql_query($sql);




	$sql_m = " delete from tbl_room where idx = '".$r_idx."' ";
	mysql_query($sql_m);

	echo "y";
}