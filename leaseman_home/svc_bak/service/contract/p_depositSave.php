<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);
$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);

$sql = "update
          realContract_deposit set
            inDate = '{$_POST['depositInDate']}',
            inMoney = '{$_POST['depositInAmount']}',
            outDate = '{$_POST['depositOutDate']}',
            outMoney = '{$_POST['depositOutAmount']}',
            remainMoney = '{$_POST['depositMoney']}',
            saved = now()
          where realContract_id = {$filtered_id}
       ";
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result){
  echo "<script>
            alert('보증금내역이 저장되었습니다.');
            location.href = 'contractEdit3.php?id=$filtered_id';
        </script>";
} else {
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
        location.href = 'contractEdit3.php?id=$filtered_id';
        </script>";
  error_log(mysqli_error($conn));
}
 ?>
