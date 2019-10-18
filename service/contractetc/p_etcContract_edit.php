<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$fil = array(
  'pAmount' => mysqli_real_escape_string($conn, $_POST['pAmount']),
  'pvAmount' => mysqli_real_escape_string($conn, $_POST['pvAmount']),
  'ptAmount' => mysqli_real_escape_string($conn, $_POST['ptAmount']),
  'etc' => mysqli_real_escape_string($conn, $_POST['etc'])
);

$filtered_id = settype($_POST['etcContract_id'], 'integer'); //기타계약번호

$sql = "
  UPDATE etcContract
  SET
    building_id = {$_POST['building_id']},
    good_in_building_id = {$_POST['good_in_building_id']},
    startTime = '{$_POST['startTime']}',
    endTime = '{$_POST['endTime']}',
    payKind = '{$_POST['payKind']}',
    pAmount = '{$fil['pAmount']}',
    pvAmount = '{$fil['pvAmount']}',
    ptAmount = '{$fil['ptAmount']}',
    executiveDate = '{$_POST['executiveDate']}',
    etc = '{$fil['etc']}',
    updateTime = now(),
    updatePerson = {$_SESSION['id']}
  WHERE id = {$filtered_id}
";

// echo $sql;

$result = mysqli_query($conn, $sql);

if(!$result){
  echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요.(1)');
        location.href = 'contractetc_edit.php?id=$filtered_id';
        </script>";
  error_log(mysqli_error($conn));
  exit();
}

$sql2 = "
  UPDATE paySchedule2
  SET
    pAmount = '{$fil['pAmount']}',
    pvAmount = '{$fil['pvAmount']}',
    ptAmount = '{$fil['ptAmount']}',
    payKind = '{$_POST['payKind']}',
    executiveDate = '{$_POST['pAmount']}',
    getAmount = '{$fil['ptAmount']}'
  WHERE
    etcContract_id = {$filtered_id}";
// echo $sql2;//청구테이블에다가 입력하는거

$result2 = mysqli_query($conn, $sql2);
//
if(!$result2){
  echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
        location.href = 'contractetc_edit.php?id=$filtered_id';
        </script>";
  error_log(mysqli_error($conn));
  exit();
}

echo "<script>alert('수정하였습니다.');
      location.href = 'contractetc_edit.php?id=$filtered_id';
      </script>";
 ?>
