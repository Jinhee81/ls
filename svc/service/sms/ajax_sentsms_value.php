<?php
include "ajax_sentsms_sql.php";

$result = mysqli_query($conn, $sql);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

for ($i=0; $i < count($allRows); $i++) {
  $allRows[$i]['customermb'] =  mb_substr($allRows[$i]['customer'],0,10);
  $allRows[$i]['descriptionmb'] =  mb_substr($allRows[$i]['description'],0,10);
}

echo json_encode($allRows);
?>
