<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$chkid = $_GET['chkid'];

$sql = "select count(*) cnts from tbl_admin where user_id = '".$chkid."' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

echo $row['cnts'];
?>