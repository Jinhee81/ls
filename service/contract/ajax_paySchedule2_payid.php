<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

if(isset($_POST['payNumber'])){
  $output = $_POST['payNumber'];
  echo $output;
}
 ?>
