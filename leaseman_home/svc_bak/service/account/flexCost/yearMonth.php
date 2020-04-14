<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$currentYear = date('Y');
$currentMonth = date('m');

// print_r($currentYear);
// var_dump($currentMonth);

$yearArray = [(int)$currentYear-2, (int)$currentYear-1, (int)$currentYear, (int)$currentYear+1];

// print_r($yearArray);
// var_dump($yearArray[0]);
 ?>
