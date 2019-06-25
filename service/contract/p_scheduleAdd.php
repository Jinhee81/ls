<!-- 청구설정버튼누르면 청구되는거, 계약스케줄에 청구번호추가되는거 -->

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
$filtered = mysqli_real_escape_string($conn, $_POST['scheduleArray']);
$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);
// print_r($filtered_id);
//
$a = explode(",", $filtered);

for ($i=0; $i < count($a)/9; $i++) {
  $payrow[$i]=[];
} //payrow라는 배열을 만듦

for ($i=0; $i < count($a); $i++) {
  if($i < 9){
    array_push($payrow[0], $a[$i]);
  } else {
    array_push($payrow[floor($i/9)], $a[$i]);
  }
} //배열에다가 청구데이터를 추가시킴

// print_r($payrow);

for ($i=0; $i < count($payrow); $i++) {
  $sql3 = "
          UPDATE contractSchedule
            SET
              mMamount = {$payrow[$i][4]},
              mVmAmount = {$payrow[$i][5]},
              mTmAmount = {$payrow[$i][6]}
            WHERE
              idcontractSchedule = {$payrow[$i][0]}";
  // echo $sql3;
  $result3 = mysqli_query($conn, $sql3);
  if($result3===false){
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.')
                  location.href='contractEdit3.php?id=$filtered_id'
            </script>";
    error_log(mysqli_error($conn));
  }
}//이작업을해야지 계약스케줄의 행별로 바뀐금액이 저장이 된다

$expectedDateArray = []; //입금예정일만 모인 배열을 만듦
for ($i=0; $i < count($a)/9; $i++) {
  array_push($expectedDateArray, $payrow[$i][7]);
}

print_r($expectedDateArray);

$expectedDateArray2= array_keys(array_count_values($expectedDateArray)); //입금예정일만 모인 배열에서 중복된 값 제거함

// print_r($expectedDateArray2);


for ($i=0; $i < count($expectedDateArray2); $i++) {
  $contractScheduleIdArray = [];
  $orderedArray = [];
  $startDate = [];
  $pAmountAccumulate = 0;
  $pvAmountAccumulate = 0;
  $ptAmountAccumulate = 0;

  for ($j=0; $j < count($payrow); $j++) {
    if($payrow[$j][7] == $expectedDateArray2[$i]){

      array_push($contractScheduleIdArray, $payrow[$j][0]);
      array_push($orderedArray, $payrow[$j][1]);
      array_push($startDate, $payrow[$j][2]);

      $payExecutiveRow[$i][0]=implode(',', $contractScheduleIdArray);
      $payExecutiveRow[$i][1]=implode(',', $orderedArray);

      $payExecutiveRow[$i][2]=$startDate[0];//시작일
      $payExecutiveRow[$i][3]=$payrow[$j][3];//종료일

      $pAmountAccumulate += $payrow[$j][4];
      $pvAmountAccumulate += $payrow[$j][5];
      $ptAmountAccumulate += $payrow[$j][6];

      $payExecutiveRow[$i][4]=$pAmountAccumulate;//공급가액
      $payExecutiveRow[$i][5]=$pvAmountAccumulate;//세액
      $payExecutiveRow[$i][6]=$ptAmountAccumulate;//합계

      $payExecutiveRow[$i][7]=$payrow[$j][7];//예정일
      $payExecutiveRow[$i][8]=$payrow[$j][8];//입금구분

    }
  }
}

// print_r($payExecutiveRow);


for ($i=0; $i < count($payExecutiveRow); $i++) {
  $sql = "
        INSERT INTO paySchedule2 (
          csIdArray, orderArray, pStartDate, pEndDate, pAmount,
          pvAmount, ptAmount, pExpectedDate, paykind, getAmount, contractId)
        VALUES (
          '{$payExecutiveRow[$i][0]}',
          '{$payExecutiveRow[$i][1]}',
          '{$payExecutiveRow[$i][2]}',
          '{$payExecutiveRow[$i][3]}',
          '{$payExecutiveRow[$i][4]}',
          '{$payExecutiveRow[$i][5]}',
          '{$payExecutiveRow[$i][6]}',
          '{$payExecutiveRow[$i][7]}',
          '{$payExecutiveRow[$i][8]}',
          0,
          {$filtered_id}
        )
      ";
  // echo $sql;
  $result = mysqli_query($conn, $sql);
  if($result === true){
    $paySid = mysqli_insert_id($conn); //방금넣은 계약번호아이디를 가져오는거
    $contractScheduleIdArray2 = explode(',', $payExecutiveRow[$i][0]);
    // echo $paySid;
    // print_r($contractScheduleIdArray2);
    for ($j=0; $j < count($contractScheduleIdArray2); $j++) {
      // code...
      $sql2 = "
              UPDATE contractSchedule
              SET
                payId = '{$paySid}',
                payIdOrder = {$j}
              WHERE idcontractSchedule = {$contractScheduleIdArray2[$j]}
              ";
      // echo $sql2; 청구번호를 계약스케줄번호에 넣음
      $result2 = mysqli_query($conn, $sql2);
    }
  } else {
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.')
             location.href='contractEdit3.php?id=$filtered_id'
       </script>";
       error_log(mysqli_error($conn));
  }
}

echo "<script>alert('청구되었습니다.')
         location.href='contractEdit3.php?id=$filtered_id'
   </script>";
 ?>
