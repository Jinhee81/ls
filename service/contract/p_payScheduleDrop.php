<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$sql = "
      DELETE from paySchedule2
      WHERE idpaySchedule2 = {$_POST['payid']}
";

// echo $sql;

$result = mysqli_query($conn, $sql);

if($result){
  $sql2 = "
    UPDATE contractSchedule
    SET
      payId = null,
      payIdOrder = null
    WHERE
      realContract_id = {$_POST['realContract_id']} and
      payId = {$_POST['payid']}
    ";
  // echo $sql2;
  $result2 = mysqli_query($conn, $sql2);

  if($result2){
    echo "<script>
            alert('청구취소하였습니다.');
            location.href = 'contractEdit3.php?id=$_POST[realContract_id]';
          </script>";
  } else {
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
          location.href = 'contractEdit3.php?id=$_POST[realContract_id]';
          </script>";
    error_log(mysqli_error($conn));
    exit();
}


}
?>
