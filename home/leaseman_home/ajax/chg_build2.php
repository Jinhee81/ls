<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$b_idx = $_GET['b_idx'];

$sql_m = "select * from tbl_build where idx = '".$b_idx."' and c_idx = '".$_SESSION[customer][idx]."'  ";
$result_m = mysql_query($sql_m);

$row_m = mysql_fetch_array($result_m);
echo $row_m[pay_type];
?>