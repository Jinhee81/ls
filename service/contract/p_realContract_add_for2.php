<!-- 2가 붙은 이 파일이 왜 있는지 모르겠네. 확인해야겠음 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$sql_pay = "select pay from building where id={$_POST['buildingId']}";
// echo $sql_pay;
$result_pay = mysqli_query($conn, $sql_pay);
$row_pay = mysqli_fetch_array($result_pay);
// print_r($row_pay);

$a = explode(",", $_POST['allArray']);
// print_r($a);

for ($i=0; $i < count($a)/11; $i++) {
  $contractRow[$i]=[];
} //$contractRow 라는 배열을 만듦

for ($i=0; $i < count($a); $i++) {
  if($i < 11){
    array_push($contractRow[0], $a[$i]);
  } else {
    array_push($contractRow[floor($i/11)], $a[$i]);
  }
}
// print_r($contractRow);

for ($i=0; $i < count($contractRow); $i++) {
  $contractRow[$i][1] = substr($contractRow[$i][1], -9);
}
// print_r($contractRow);

for ($i=0; $i < count($contractRow); $i++) {
  $sql = "
      INSERT INTO realContract (
        customer_id, building_id, group_in_building_id, r_g_in_building_id,
        payOrder, monthCount, startDate, endDate, contractDate,
        mAmount, mvAmount, mtAmount,
        user_id, createTime, createPerson)
      VALUES (
          {$contractRow[$i][1]},
          {$_POST['buildingId']},
          {$_POST['groupId']},
          {$_POST['roomId']},
          '{$row_pay[0]}',
          {$contractRow[$i][6]},
          '{$contractRow[$i][7]}',
          '{$contractRow[$i][8]}',
          '{$contractRow[$i][2]}',
          '{$contractRow[$i][3]}',
          '{$contractRow[$i][4]}',
          '{$contractRow[$i][5]}',
          {$_SESSION['id']},
          now(),
          {$_SESSION['id']}
          )
  ";
  // echo $sql;

  $result = mysqli_query($conn, $sql);
  if(!$result){
    // echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
    //       </script>";
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(3).');
          location.href = 'contractAll2.php';
          </script>";
    error_log(mysqli_error($conn));
    exit();
  }

  $id = mysqli_insert_id($conn); //방금넣은 계약번호아이디를 가져오는거

  $mStartDate = $contractRow[$i][7]; //초기시작일 가져오기

  for ($j=1; $j <= (int)$contractRow[$i][6]; $j++) {
        $contractRow[$i][11][$j] = array();

        $mEndDate = date("Y-m-d", strtotime($mStartDate."+1 month"."-1 day"));

        if($row_pay[0]==='선불'){
          $mExpectedDate = $mStartDate;
        } else if($row_pay[0]==='후불'){
          $mExpectedDate = $mEndDate;
        }

        array_push($contractRow[$i][11][$j], $j, $mStartDate, $mEndDate, $contractRow[$i][3], $contractRow[$i][4], $contractRow[$i][5], $mExpectedDate, $id);
        $mStartDate = date("Y-m-d", strtotime($mEndDate."+1 day"));
  }
}
// print_r($contractRow);

//여기부터는 보증금테이블에 입력하는 for문
for ($i=0; $i < count($contractRow); $i++) {
  $sql_deposit = "
          INSERT INTO realContract_deposit
            (inDate, inMoney, remainMoney, saved, realContract_id)
          VALUES (
            '{$contractRow[$i][10]}',
            '{$contractRow[$i][9]}',
            '{$contractRow[$i][9]}',
            now(),
            {$contractRow[$i][11][1][7]}
          )
  ";
  // echo $sql_deposit;
  $result_deposit = mysqli_query($conn, $sql_deposit);
  if($result_deposit===false){
    // echo "<script>alert('보증금 저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
    //       </script>";
    echo "<script>alert('보증금 저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
          location.href = 'contractAll2.php';
          </script>";
    error_log(mysqli_error($conn));
    exit();
  }
} //여기부터는 보증금테이블에 입력하는 for문 closing


// 여기부터는 계약별 스케줄테이블에 입력하는 for문
for ($i=0; $i < count($contractRow); $i++) {
  for ($j=1; $j <= $contractRow[$i][6]; $j++) {
    $sql2 = "
            INSERT INTO contractSchedule (
              ordered, mStartDate, mEndDate, mMamount, mVmAmount, mTmAmount,
              mExpectedDate, realContract_id)
            VALUES (
              {$contractRow[$i][11][$j][0]},
              '{$contractRow[$i][11][$j][1]}',
              '{$contractRow[$i][11][$j][2]}',
              '{$contractRow[$i][11][$j][3]}',
              '{$contractRow[$i][11][$j][4]}',
              '{$contractRow[$i][11][$j][5]}',
              '{$contractRow[$i][11][$j][6]}',
              {$contractRow[$i][11][$j][7]}
            )
      ";
    // echo $sql2;

    $result2 = mysqli_query($conn, $sql2);

    if($result2===false){
      echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
            location.href = 'contractAll2.php';
            </script>";
      error_log(mysqli_error($conn));
      exit();
    }
  }
}//for count($contractRow) closing

echo "<script>alert('계약을 저장하였습니다.');
      location.href = 'contract.php';
      </script>";

// echo 111;

 ?>
