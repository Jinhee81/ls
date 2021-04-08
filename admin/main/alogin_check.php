<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include $_SERVER['DOCUMENT_ROOT']."/admin/view/aconn.php";

$id = $_POST['id'];
$password = $_POST['password'];

$check = "SELECT * from administrator WHERE id = '{$id}' LIMIT 1;";

// echo $check;
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_array($result);

if( $id === $row['id'] && $password === $row['password']){
  $_SESSION['ais_login'] = true;//관리자페이지여서 a를 넣음
  $_SESSION['id'] = $row['id'];
  $_SESSION['grade'] = $row['grade'];
  $_SESSION['created'] = $row['created'];
  header('Location: /admin/user_list.php');
  exit();
} else {
  echo "<script>
  alert('아이디 또는 비밀번호가 일치하지 않습니다.');
  location.href='alogin.php';
  </script>";
}
 ?>