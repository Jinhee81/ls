<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include "ajax_getFinishedCondi.php";//조회조건파일


echo '<label class="numberComma">'.count($allRows).'</label>';

// echo $depositTotal;
?>
<script>
  $(".numberComma").number(true);
</script>
