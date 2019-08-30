<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include "password.php";

$email = $_POST['email'];
$password = $_POST['password'];

$check = "SELECT * from user WHERE email = '{$email}' LIMIT 1;";
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_array($result);

if( $email === $row['email'] && password_verify($password, $row['password'])){
  $_SESSION['is_login'] = true;
  $_SESSION['id'] = $row['id'];
  $_SESSION['email'] = $email;
  $_SESSION['user_div'] = $row['user_div'];
  $_SESSION['user_name'] = $row['user_name'];
  $_SESSION['damdangga_name'] = $row['damdangga_name'];
  $_SESSION['cellphone'] = $row['cellphone'];
  $_SESSION['lease_type'] = $row['lease_type'];
  $_SESSION['created'] = $row['created'];
  header('Location: /main/main.php');
  exit();
  // $_SESSION['email'] = $email;
  // if(isset($_SESSION['email'])){
  //
  // }
} else {
  echo "<script>
  alert('아이디 또는 비밀번호가 일치하지 않습니다.');
  location.href='login.php';
  </script>";
}
 ?>
