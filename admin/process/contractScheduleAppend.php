<?php
//도이치오토월드 계약추가건


ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql = "select id, mAmount, mvAmount, mtAmount from realContract where user_id=42";

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

// print_r($allRows);


for ($i=0; $i < count($allRows); $i++) {
  $ordered = 2;
  $mStartDate = '2020-6-1';

  for ($j=0; $j < 25; $j++) {
    $allRows[$i]['cs'][$j] = array();
    $mEndDate = date("Y-n-j", strtotime($mStartDate."+1 month"."-1 day"));
    array_push($allRows[$i]['cs'][$j], $ordered, $mStartDate, $mEndDate);

    $ordered += 1;
    $mStartDate = date("Y-n-j", strtotime($mEndDate."+1 day"));
  }
}

// print_r($allRows);

for ($i=0; $i < count($allRows); $i++) {
  for ($j=0; $j < count($allRows[$i]['cs']); $j++) {
    $sql2 = "insert into contractSchedule
             (ordered, mStartDate, mEndDate,
              mMamount, mVmAmount, mTmAmount,
              mExpectedDate, realContract_id, user_id)
             VALUES
              ({$allRows[$i]['cs'][$j][0]},
              '{$allRows[$i]['cs'][$j][1]}',
              '{$allRows[$i]['cs'][$j][2]}',
              '{$allRows[$i]['mAmount']}',
              '{$allRows[$i]['mvAmount']}',
              '{$allRows[$i]['mtAmount']}',
              '{$allRows[$i]['cs'][$j][2]}',
              {$allRows[$i]['id']},
              42
              )";
    // echo $sql2;

    $result2 = mysqli_query($conn, $sql2);

    if(!$result2){
      echo "<script>alert('error accur!!');
            </script>";
    }
  }
}

echo "<script>alert('success!!');
      </script>";
 ?>
