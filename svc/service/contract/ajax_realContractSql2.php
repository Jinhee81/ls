<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_SESSION);
// print_r($_POST);
// echo '111';

include "ajax_realContractSql.php";
echo $sql_count;
echo $sql;

print_r($_POST['form']).'<br>';

print_r($a);


?>
