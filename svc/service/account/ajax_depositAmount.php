<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/account/ajax_depositCondi.php";//조회조건파일

$depositTotal = 0;

for ($i=0; $i < count($allRows); $i++) {
  $depositTotal += str_replace(",", "", $allRows[$i]['remainMoney']);
  // var_dump($depositTotal);
} //for closing

echo '<label class="numberComma" style="color:#F781F3;">'.$depositTotal.'</label>';

// echo $depositTotal;
?>
<script>
  $(".numberComma").number(true);
</script>
