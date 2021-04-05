<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql = "select id, count2
        from realContract
        where user_id=42 and
              building_id=36 and
              group_in_building_id in(59)";

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

// print_r($allRows);

for ($i=0; $i < count($allRows); $i++) {
  $allRows[$i]['cs'] = array();
  for ($j=0; $j < $allRows[$i]['count2']; $j++) {
    $order = $j + 1;
    $sql2 = "select
                idcontractSchedule,
                ordered,
                mStartDate,
                mEndDate,
                mMamount,
                mVmAmount,
                mTmAmount,
                mExpectedDate,
                realContract_id,
                user_id
             from contractSchedule
             where realContract_id={$allRows[$i]['id']}
                   and ordered = {$order}
             order by ordered";
    // echo $sql2;

    $result2 = mysqli_query($conn, $sql2);
    $allRows[$i]['cs'][$j] = array();
    while($row2 = mysqli_fetch_array($result2)){
      $allRows[$i]['cs'][$j] = $row2;
    }
  }
}

//and date(mExpectedDate) > '2020-9-1'

// print_r($allRows);
// echo count($allRows);

for ($i=0; $i < count($allRows); $i++) {
// for ($i=0; $i < 1; $i++) {
  for ($j=0; $j < count($allRows[$i]['cs']); $j++) {
    if($allRows[$i]['cs'][$j]){
      $sql3 = "
        INSERT INTO paySchedule2 (
          csIdArray, orderArray, pStartDate, pEndDate, pAmount,
          pvAmount, ptAmount, pExpectedDate, paykind, getAmount, realContract_id, building_id, user_id, monthCount)
        VALUES (
          '{$allRows[$i]['cs'][$j]['idcontractSchedule']}',
          '{$allRows[$i]['cs'][$j]['ordered']}',
          '{$allRows[$i]['cs'][$j]['mStartDate']}',
          '{$allRows[$i]['cs'][$j]['mEndDate']}',
          '{$allRows[$i]['cs'][$j]['mMamount']}',
          '{$allRows[$i]['cs'][$j]['mVmAmount']}',
          '{$allRows[$i]['cs'][$j]['mTmAmount']}',
          '{$allRows[$i]['cs'][$j]['mExpectedDate']}',
          '계좌',
          0,
          {$allRows[$i]['id']},
          36,
          42,
          1
          )";
      // echo $sql3."<br>";

      $result3 = mysqli_query($conn, $sql3);
      if($result3){
        $paySid = mysqli_insert_id($conn); //방금넣은 청구번호아이디를 가져오는거

        $sql4 = "
                UPDATE contractSchedule
                SET
                  payId = '{$paySid}',
                  payIdOrder = 0
                WHERE idcontractSchedule = {$allRows[$i]['cs'][$j]['idcontractSchedule']}
                ";
        // echo $sql4; //청구번호를 계약스케줄번호에 넣음
        $result4 = mysqli_query($conn, $sql4);
        if(!$result4){
          echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
             </script>";
             error_log(mysqli_error($conn));
             exit();
        }
      } else {
        echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(1)');
           </script>";
           error_log(mysqli_error($conn));
           exit();
      }

    }//for j 밑 if}
  }//forj
}//for i
//
echo "<script>alert('success!!');
   </script>";


?>
