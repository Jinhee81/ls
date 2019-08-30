<!-- 청구설정 모달안 입금완료버튼 누르면 실행되는거 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$filtered_id = mysqli_real_escape_string($conn, $_POST['realContract_id']);
// print_r($filtered_id);

$sql = "
      UPDATE paySchedule2
      SET
        payKind = '{$_POST['paykind']}',
        executiveDate = '{$_POST['pgetdate']}',
        getAmount = '{$_POST['pgetAmount']}'
      WHERE idpaySchedule2 = {$_POST['payid']}
";

// echo $sql;

$result = mysqli_query($conn, $sql);

if($result){

  $sql5 = "UPDATE realContract SET
             updateTime = now(),
             updatePerson = {$_SESSION['id']}
           WHERE
             id = {$filtered_id}
          ";
  // echo $sql5;
  $result5 = mysqli_query($conn, $sql5);

  if(!$result5){
    echo "<script>alert('입금처리 과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
          location.href = 'contractEdit3.php?id=$filtered_id';
          </script>";
    // echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
    //       </script>";
    error_log(mysqli_error($conn));
    exit();
  }

  echo "<script>
          alert('입금처리하였습니다.');
          location.href = 'contractEdit3.php?id=$filtered_id';
        </script>";
}
else {
  echo "<script>alert('입금처리 과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
        location.href = 'contractEdit3.php?id=$filtered_id';
        </script>";
  error_log(mysqli_error($conn));
  exit();
}
?>
