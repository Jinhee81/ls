<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'pay' => mysqli_real_escape_string($conn, $_POST['pay']),
  'popbill' => mysqli_real_escape_string($conn, $_POST['popbill']),
  'companynumber' => mysqli_real_escape_string($conn, $_POST['companynumber'])
);

$sql  = "
    UPDATE building
    SET
      bName = '{$filtered['name']}',
      pay = '{$filtered['pay']}',
      popbill = '{$filtered['popbill']}',
      companynumber = '{$filtered['companynumber']}',
      updated = now()
    WHERE
      id = {$_POST['id']}
    ";
// echo $sql;
// var_dump($_POST['id']);

$result = mysqli_query($conn, $sql);

if($result){
  echo "<script>alert('수정하였습니다.');
  location.href='building.php';
  </script>";
} else {
  echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
  location.href='building.php';
  </script>";
}


?>
