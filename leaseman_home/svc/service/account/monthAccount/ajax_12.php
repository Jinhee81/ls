<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// echo $_POST;
// print_r($_POST);

// var_dump($_POST['year']);

$fromDate = $_POST['year'] . '-' . $_POST['month'] . '-01';
$endDate = date('t', strtotime($fromDate));
$toDate = $_POST['year'] . '-' . $_POST['month'] . '-' . $endDate;

$sql = "
  (select
        paySchedule2.idpaySchedule2,
        paySchedule2.executiveDate,
        paySchedule2.ptAmount,
        paySchedule2.pAmount,
        paySchedule2.pvAmount
  from
        paySchedule2
  join realContract
      on paySchedule2.realContract_id = realContract.id
  join building
      on realContract.building_id = building.id
  where paySchedule2.user_id = {$_SESSION['id']} and
        realContract.building_id = {$_POST['buildingIdx']} and
        DATE(paySchedule2.executiveDate) BETWEEN '{$fromDate}' and '{$toDate}')
  union
  (select
        paySchedule2.idpaySchedule2,
        paySchedule2.executiveDate,
        paySchedule2.ptAmount,
        paySchedule2.pAmount,
        paySchedule2.pvAmount
  from
        paySchedule2
  join etcContract
      on paySchedule2.etcContract_id = etcContract.id
  join building
      on etcContract.building_id = building.id
  where paySchedule2.user_id = {$_SESSION['id']} and
        etcContract.building_id = {$_POST['buildingIdx']} and
        DATE(paySchedule2.executiveDate) BETWEEN '{$fromDate}' and '{$toDate}')
  ";

// echo $sql;

$result = mysqli_query($conn, $sql);
// $total_rows = mysqli_num_rows($result);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

// print_r($allRows);

$amountTotalArray = [0,0,0];

for ($i=0; $i < count($allRows); $i++) {
  $amountTotalArray[0] += str_replace(",", "", $allRows[$i]['ptAmount']);
  $amountTotalArray[1] += str_replace(",", "", $allRows[$i]['pAmount']);
  $amountTotalArray[2] += str_replace(",", "", $allRows[$i]['pvAmount']);
}

// $amountTotalArray[0] = number_format($amountTotalArray[0]);
// $amountTotalArray[1] = number_format($amountTotalArray[1]);
// $amountTotalArray[2] = number_format($amountTotalArray[2]);

$output = "<tr class='table-warning'>";
$output .= "<td id='leftArea1' class='numberComma'>".count($allRows)."</td>";
$output .= "<td id='leftArea2' class='numberComma'>".$amountTotalArray[0]."</td>";
$output .= "<td id='leftArea3' class='numberComma'>".$amountTotalArray[1]."</td>";
$output .= "<td id='leftArea4' class='numberComma'>".$amountTotalArray[2]."</td>";
$output .= "</tr>";

echo $output;

?>

<script type="text/javascript">
  $(".numberComma").number(true);
</script>
