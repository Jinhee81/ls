<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";


$chkCnt = $_GET[chkCnt];
$c_idx = $_SESSION[customer][idx];



$result = bill_able($chkCnt, $_danga_price);


echo $result;
?>