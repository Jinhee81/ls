<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);
$filtered_fileid = mysqli_real_escape_string($conn, $_POST['fileid']);

$sql = "DELETE from upload_file
        WHERE
          file_id = '{$filtered_fileid}' and
          realContract_id = {$filtered_id}
        ";
// echo $sql;
$result = mysqli_query($conn, $sql);

if($result){
  include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/condi/sql_file.php";

  //echo $sql_sum;
  echo json_encode($fileRows);
} else {
  echo "<script>alert('삭제과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
        history.back();
        </script>";
  error_log(mysqli_error($conn));
}
 ?>
