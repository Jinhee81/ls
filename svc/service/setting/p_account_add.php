<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

print_r($_POST);echo "<br>";
print_r($_SESSION);echo "<br>";

$filtered = array(
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'password' => mysqli_real_escape_string($conn, $_POST['password']),
  'etc' => mysqli_real_escape_string($conn, $_POST['etc'])
);

$sql1 = "select * from user where id={$_SESSION['id']}";
echo $sql1;echo "<br>";

$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql = "insert into user
        (email, password, user_div, user_name, 
         manager_name, cellphone, lease_type, regist_channel,
         created, gradename,
         coin,
         divdiv, main_id)
        VALUES
        ('{$filtered['email']}',
         '{$filtered['password']}',
         '{$row1['user_div']}',
         '{$row1['user_name']}',
         '{$row1['manager_name']}',
         '{$row1['cellphone']}',
         '{$row1['lease_type']}',
         '{$row1['regist_channel']}',
         '{$row1['created']}',
         '{$row1['gradename']}',
         {$row1['coin']},
         'sub',
         {$_SESSION['id']}
        )
       ";

$sql3 = "insert into user_account
         (name, email, password, etc, usescreen)
         values
         (
          '{$_filtered['name']}',

        ";


$result = mysqli_query($conn, $sql);

if($result){
  echo
  "<script>
  alert('저장되었습니다.');
  window.location.href='building.php';
  </script>";
} else {
  echo $sql;
}
?>