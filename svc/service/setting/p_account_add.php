<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

print_r($_POST);

$filtered = array(
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'password' => mysqli_real_escape_string($conn, $_POST['password']),
  'etc' => mysqli_real_escape_string($conn, $_POST['etc'])
);

// $sql = "insert into user_account
//         (nickid, password, name, etc, user_id)
//         VALUES
//         ('{$filtered['nickid']}',
//          '{$filtered['password']}',
//          '{$filtered['name']}',
//          '{$filtered['etc']}',
//          {$_SESSION['id']}
//         )
//        ";
// // echo $sql;

// $result = mysqli_query($conn, $sql);

// if($result){
//   echo
//   "<script>
//   alert('저장되었습니다.');
//   window.location.href='account.php';
//   </script>";
// }
?>