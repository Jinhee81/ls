<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include "ajax_getFinishedCondi.php";//조회조건파일

$ptAmountTotal = 0;

for ($i=0; $i < count($allRows); $i++) {
  $ptAmountTotal += str_replace(",", "", $allRows[$i]['ptAmount']);
  // var_dump($depositTotal);
} //for closing

echo '<label class="numberComma">'.$ptAmountTotal.'</label>';

// echo $depositTotal;
?>
<script>
  $(".numberComma").number(true);
</script>
