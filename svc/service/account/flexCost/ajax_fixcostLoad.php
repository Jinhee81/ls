<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// echo $_POST;
// print_r($_POST);

$fromDate = $_POST['year'] . '-' . $_POST['month'] . '-01';
$endDate = date('t', strtotime($fromDate));
$toDate = $_POST['year'] . '-' . $_POST['month'] . '-' . $endDate;

$sql = "
  select
        @num := @num + 1 as num,
        id,
        title,
        amount1, amount2, amount3,
        payDate,
        taxDate,
        etc
  from
        (select @num :=0)a, costlist
  where user_id = {$_SESSION['id']} and
        building_id = {$_POST['buildingIdx']} and
        fixflexdiv = 'fix' and
        DATE(payDate) BETWEEN '{$fromDate}' and '{$toDate}'
  order by
      id asc
  ";

// echo $sql;
$result = mysqli_query($conn, $sql);
// $total_rows = mysqli_num_rows($result);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

echo json_encode($allRows);

?>
