<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
header('Content-Type: text/html; charset=UTF-8');
include "ajax_sentsms_sql.php";

$result = mysqli_query($conn, $sql);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

for ($i=0; $i < count($allRows); $i++) {
  $allRows[$i]['customermb'] =  mb_substr($allRows[$i]['customer'],0,10,'utf-8');
  $allRows[$i]['descriptionmb'] =  mb_substr($allRows[$i]['description'],0,10,'utf-8');
}

echo json_encode($allRows);
?>
