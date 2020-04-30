<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

print_r($_POST);
print_r($_SESSION);

$sql_pay = "select pay from building where id={$_POST['buildingId']}";
// echo $sql_pay;
$result_pay = mysqli_query($conn, $sql_pay);
$row_pay = mysqli_fetch_array($result_pay);
// print_r($row_pay);

$a = explode(",", $_POST['allArray']);
// print_r($a);

for ($i=0; $i < count($a)/13; $i++) {
  $contractRow[$i]=[];
} //$contractRow 라는 배열을 만듦
//
for ($i=0; $i < count($a); $i++) {
  if($i < 13){
    array_push($contractRow[0], $a[$i]);
  } else {
    array_push($contractRow[floor($i/13)], $a[$i]);
  }
}

print_r($contractRow);
//
for ($i=0; $i < count($contractRow); $i++) {
  $sql = "
      INSERT INTO realContract (
        customer_id, building_id, group_in_building_id, r_g_in_building_id,
        payOrder, monthCount, startDate, endDate, contractDate,
        mAmount, mvAmount, mtAmount,
        user_id, createTime, count2, endDate2)
      VALUES (
          {$contractRow[$i][2]},
          {$_POST['buildingId']},
          {$_POST['groupId']},
          {$contractRow[$i][1]},
          '{$contractRow[$i][3]}',
          {$contractRow[$i][8]},
          '{$contractRow[$i][9]}',
          '{$contractRow[$i][10]}',
          '{$contractRow[$i][4]}',
          '{$contractRow[$i][5]}',
          '{$contractRow[$i][6]}',
          '{$contractRow[$i][7]}',
          {$_SESSION['id']},
          now(),
          {$contractRow[$i][8]},
          '{$contractRow[$i][10]}'
          )
  ";
  // echo $sql;

  $result = mysqli_query($conn, $sql);
  if(!$result){
    // echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
    //       </script>";
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(3).');
          location.href = 'contractAll.php';
          </script>";
    error_log(mysqli_error($conn));
    exit();
  }

  $id = mysqli_insert_id($conn); //방금넣은 계약번호아이디를 가져오는거

  $mStartDate = $contractRow[$i][9]; //초기시작일 가져오기

  for ($j=1; $j <= (int)$contractRow[$i][8]; $j++) {
      $contractRow[$i][13][$j] = array();

      $mEndDate = date("Y-n-j", strtotime($mStartDate."+1 month"."-1 day"));

      if($contractRow[$i][3]==='선납'){
        $mExpectedDate = $mStartDate;
      } else if($contractRow[$i][3]==='후납'){
        $mExpectedDate = $mEndDate;
      }

      array_push($contractRow[$i][13][$j], $j, $mStartDate, $mEndDate, $contractRow[$i][5], $contractRow[$i][6], $contractRow[$i][7], $mExpectedDate, $id);
      $mStartDate = date("Y-n-j", strtotime($mEndDate."+1 day"));
  }

  $sql_deposit = "
          INSERT INTO realContract_deposit
            (inDate, inMoney, remainMoney, saved, realContract_id)
          VALUES (
            '{$contractRow[$i][12]}',
            '{$contractRow[$i][11]}',
            '{$contractRow[$i][11]}',
            now(),
            $id
          )
  ";
  // echo $sql_deposit;
  $result_deposit = mysqli_query($conn, $sql_deposit);

  if($result_deposit===false){
    // echo "<script>alert('보증금 저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
    //       </script>";
    echo "<script>alert('보증금 저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
          history.back();
          </script>";
    error_log(mysqli_error($conn));
    exit();
  }
}


// print_r($contractRow);

for ($i=0; $i < count($contractRow); $i++) {
  for ($j=1; $j <= $contractRow[$i][8]; $j++) {
    $sql2 = "
            INSERT INTO contractSchedule (
              ordered, mStartDate, mEndDate, mMamount, mVmAmount, mTmAmount,
              mExpectedDate, realContract_id)
            VALUES (
              {$contractRow[$i][13][$j][0]},
              '{$contractRow[$i][13][$j][1]}',
              '{$contractRow[$i][13][$j][2]}',
              '{$contractRow[$i][13][$j][3]}',
              '{$contractRow[$i][13][$j][4]}',
              '{$contractRow[$i][13][$j][5]}',
              '{$contractRow[$i][13][$j][6]}',
              {$contractRow[$i][13][$j][7]}
            )
      ";
    // echo $sql2;

    $result2 = mysqli_query($conn, $sql2);

    if($result2===false){
      echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
            location.href = 'contractAll.php';
            </script>";
      error_log(mysqli_error($conn));
      exit();
    }
  }
}//for count($contractRow) closing

echo "<script>alert('계약을 저장하였습니다.');
      location.href = 'contract.php';
      </script>";

 ?>
