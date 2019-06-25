<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$customer_id = substr($_POST['customer'],-9); //이거는 고객관련문자열에서 뒤9자리 고객번호만 가져오는 명령

date_default_timezone_set('Asia/Seoul'); //이거있어야지 시간대가 맞게설정됨, 없으면 시간대가 안맞아짐

$currentDateTime = date('Y-m-d H:i:s');
// echo $currentDateTime;

if($currentDateTime >= $_POST['startDate']
    && $currentDateTime <= $_POST['endDate']){
  $status = '진행';
} elseif ($currentDateTime < $_POST['startDate']) {
  $status = '예정';
} else {
  $status = '종료';
}

// print_r($status);

$sql = "
  INSERT INTO realContract (
    status, customer_id, building_id, group_in_building_id, r_g_in_building_id,
    payOrder, monthCount, startDate, endDate, contractDate,
    mAmount, mvAmount, mtAmount,
    depositInAmount, depositInDate,
    user_id, createTime, createPerson)
  VALUES (
    '{$status}',
    {$customer_id},
    {$_POST['building_id']},
    {$_POST['group_id']},
    {$_POST['room_id']},
    '{$_POST['payOrder']}',
    {$_POST['monthCount']},
    '{$_POST['startDate']}',
    '{$_POST['endDate']}',
    '{$_POST['contractDate']}',
    '{$_POST['mAmount']}',
    '{$_POST['mvAmount']}',
    '{$_POST['mtAmount']}',
    '{$_POST['depositInAmount']}',
    '{$_POST['depositInDate']}',
    {$_SESSION['id']},
    now(),
    {$_SESSION['id']}
  )
";

// echo $sql;

$result = mysqli_query($conn, $sql);

$id = mysqli_insert_id($conn); //방금넣은 계약번호아이디를 가져오는거

$mStartDate = $_POST['startDate']; //초기시작일 가져오기

for ($i=1; $i <= (int)$_POST['monthCount']; $i++) {

    $contractRow[$i] = array();
    $mEndDate = date("Y-m-d", strtotime($mStartDate."+1 month"."-1 day"));

    if($_POST['payOrder']==='선불'){
      $mExpectedDate = $mStartDate;
    } else if($_POST['payOrder']==='후불'){
      $mExpectedDate = $mEndDate;
    }

    array_push($contractRow[$i], $i, $mStartDate, $mEndDate, $_POST['mAmount'], $_POST['mvAmount'], $_POST['mtAmount'], $mExpectedDate);
    // print_r($i);
    $mStartDate = date("Y-m-d", strtotime($mEndDate."+1 day"));
}
// print_r($contractRow);
// echo 'bbbbb';

for ($i=1; $i <= count($contractRow); $i++) {
  $sql2 = "
        INSERT INTO contractSchedule (
          ordered, mStartDate, mEndDate, mMamount, mVmAmount, mTmAmount,
          mExpectedDate, realContract_id)
        VALUES (
          '{$contractRow[$i][0]}',
          '{$contractRow[$i][1]}',
          '{$contractRow[$i][2]}',
          '{$contractRow[$i][3]}',
          '{$contractRow[$i][4]}',
          '{$contractRow[$i][5]}',
          '{$contractRow[$i][6]}',
          {$id}
        )
  ";
  $result2 = mysqli_query($conn, $sql2);
  // echo $sql2;

  if($result2===false){
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
          location.href = 'contract_add2.php';
          </script>";
    error_log(mysqli_error($conn));
    exit();
  }
}

echo "<script>alert('저장되었습니다.');
      location.href = 'contractEdit3.php?id=$id';
      </script>";

// if ($_POST['endDate'] === $mEndDate){
//   echo '정상적으로 스케쥴 생성되었음';
// } //우와 2020년에 윤달이 있어서 종료일자가 안맞음, 그래서 이걸로 확인체크하는것은 없애기로 함

 ?>
