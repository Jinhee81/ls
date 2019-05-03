<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$customer_id = substr($_POST['customer'],-9);

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
    depositAmount, depositInDate,
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
    '{$_POST['depositAmount']}',
    '{$_POST['depositInDate']}',
    {$_SESSION['id']},
    now(),
    {$_SESSION['id']}
  )
";

// echo $sql;

$result = mysqli_query($conn, $sql);

if($result){
  echo "<script>alert('저장되었습니다.');
  location.href = 'contract.php';
  </script>";
} else {
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
  location.href = 'contract.php';
  </script>";
  error_log(mysqli_error($conn));
}

 ?>
