<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
//$buildingIdx = array();
$DateArray = array();

// error_reporting(E_ALL);

// ini_set("display_errors", 1);

for ($i=1; $i < 13; $i++) {
  $DateArrayEle = array();
  $from = $_POST['year'] .'-'.$i.'-'.'01';
  $toDate = date('t', strtotime($from));
  $to = $_POST['year'] .'-'.$i.'-'.$toDate;
  array_push($DateArrayEle, $from, $to);
  array_push($DateArray, $DateArrayEle);
}
print_r($DateArrayEle);
// foreach ($buildingArray as $key => $value) {
//   array_push($buildingIdx, $key);
// }


// print_r($DateArray);


// print_r($buildingIdx);

$allRows = array();

for ($i=0; $i < count($DateArray); $i++) {
  $sql = "(select 
              paySchedule2.idpaySchedule2,
              paySchedule2.ptAmount
          from paySchedule2
          join realContract
              on paySchedule2.realContract_id = realContract.id
          join building
              on realContract.building_id = building.id
          where paySchedule2.user_id = {$_SESSION['id']} and
                realContract.building_id = {$_POST['buildingIdx']} and
                DATE(paySchedule2.executiveDate) BETWEEN '{$DateArray[$i][0]}' and '{$DateArray[$i][1]}')
          union
          (select
                paySchedule2.idpaySchedule2,
                paySchedule2.ptAmount
          from
                paySchedule2
          join etcContract
              on paySchedule2.etcContract_id = etcContract.id
          join building
              on etcContract.building_id = building.id
          where paySchedule2.user_id = {$_SESSION['id']} and
                etcContract.building_id = {$_POST['buildingIdx']} and
                DATE(paySchedule2.executiveDate) BETWEEN '{$DateArray[$i][0]}' and '{$DateArray[$i][1]}')
          ";
  // echo $sql;

  $result = mysqli_query($conn, $sql);
  // $total_rows = mysqli_num_rows($result);

  while($row = mysqli_fetch_array($result)){
    $allRows[$i][]=$row;
  }
  $allRows[$i][$i]=
  array(
        '0'=>'',
        'idpaySchedule2'=>'',
        '1'=>'',
        'ptAmount'=>''
        );
}
$year = $_POST['year'];
// echo "<pre>";
// print_r($allRows);
// echo "</pre>";

echo $_POST['year'];
echo $_POST['buildingIdx'];
// print_r($allRows); echo 111;

$plusAmountArray = array(0,0,0,0,0,0,0,0,0,0,0,0);

for ($i=0; $i < count($allRows); $i++) {

  for ($j=0; $j < count($allRows[$i]); $j++) {

    $plusAmountArray[$i] += str_replace(",", "", $allRows[$i][$j]['ptAmount']);
  }
}

// print_r($plusAmountArray); echo 222;

$allRows2 = array();

for ($i=0; $i < count($DateArray); $i++) {
  $sql = "
    select
          amount1
    from
          costlist
    where user_id = {$_SESSION['id']} and
          building_id = {$_POST['buildingIdx']} and
          DATE(payDate) BETWEEN '{$DateArray[$i][0]}' and '{$DateArray[$i][1]}'
    ";

  // echo $sql;//amount1 합계, amount2 공급가액, amount3 세엑

  $result = mysqli_query($conn, $sql);
  // $total_rows = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result)){
    $allRows2[$i][]=$row;
  }
}

// print_r($allRows2);

$minusAmountArray = array(0,0,0,0,0,0,0,0,0,0,0,0);

for ($i=0; $i < count($allRows2); $i++) {

  for ($j=0; $j < count($allRows2[$i]); $j++) {

    $minusAmountArray[$i] += str_replace(",", "", $allRows2[$i][$j]['amount1']);
  }
}

// print_r($minusAmountArray);

// $output = "<input type='hidden' name='plusAmountArray1' value=".json_encode($plusAmountArray).">";
// $output .= "<input type='hidden' name='minusAmountArray1' value=".json_encode($minusAmountArray).">";
//
// echo $output;
//echo 111;
 ?>

 <script>
 var plusAmountArray = <?php echo json_encode($plusAmountArray); ?>;
 var minusAmountArray = <?php echo json_encode($minusAmountArray); ?>;
 </script>
