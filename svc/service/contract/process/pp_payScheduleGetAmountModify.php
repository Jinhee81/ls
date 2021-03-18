<?php
//청구설정 모달안 수정버튼 누르면 실행되는거
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$filtered_id= $_POST['contractId'];

// $sqlfirst = "select payKind, executiveDate
//              from paySchedule2
//              where idpaySchedule2 = {$_POST['payid']}";

// $resultfirst = mysqli_query($conn, $sqlfirst);

// $rowfirst = mysqli_fetch_array($resultfirst);

// if($rowfirst['payKind']===$_POST['payKind']){
//     if($rowfirst['executiveDate']===$_POST['executiveDate']){
//         echo json_encode('noEdit');
//         exit();
//     }
// }

$sql = "
      UPDATE paySchedule2
      SET
        pExpectedDate = '{$_POST['pExpectedDate']}',
        payKind = '{$_POST['payKind']}',
        executiveDate = '{$_POST['executiveDate']}'
      WHERE idpaySchedule2 = {$_POST['payid']}
";

// echo $sql;

$result = mysqli_query($conn, $sql);

if($result){
  $sql5 = "UPDATE realContract SET
             updateTime = now()
           WHERE
             id = {$filtered_id}
          ";
  // echo $sql5;
  $result5 = mysqli_query($conn, $sql5);

  if($result5===false){
    echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요.(1)');
          history.back();
          </script>";
    error_log(mysqli_error($conn));
    exit();
  } else {
    include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/condi/sql_amount2.php";

    //echo $sql_sum;
    echo json_encode($allRows);
  }
} else {
  echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
        history.back();
        </script>";
  error_log(mysqli_error($conn));
  exit();
}


?>
