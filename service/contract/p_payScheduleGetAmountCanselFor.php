<!-- 여러개를 한꺼번에 입금완료하는 처리파일 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);

$a = explode(",", $_POST['scheduleArray']);
// var_dump($a);


for ($i=0; $i < count($a); $i++) {
  $sql = "
        select * from paySchedule2 where idpaySchedule2={$a[$i]}
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  $sql_u = "update paySchedule2
            set
              executiveDate = null,
              getAmount = null
            where idpaySchedule2 = {$a[$i]}
  ";
  // echo $sql_u;
  $result_u = mysqli_query($conn, $sql_u);

  if($result_u){
    $sql5 = "UPDATE realContract SET
               updateTime = now()
             WHERE
               id = {$filtered_id}
            ";
    // echo $sql5;
    $result5 = mysqli_query($conn, $sql5);

    if($result5===false){
      echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
            location.href = 'contractEdit3.php?id=$filtered_id';
            </script>";
      error_log(mysqli_error($conn));
      exit();
    }

    echo "<script>
            alert('입금취소하였습니다.');
            location.href = 'contractEdit3.php?id=$filtered_id';
          </script>";
  } else {
    echo "<script>alert('취소처리에 문제가 생겼습니다. 관리자에게 문의하세요.');
          location.href = 'contractEdit3.php?id=$filtered_id';
          </script>";
    error_log(mysqli_error($conn));
  }
}

?>
