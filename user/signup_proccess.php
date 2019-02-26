<?php
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include "password.php";

$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

$filtered = array(
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'user_name' => mysqli_real_escape_string($conn, $_POST['user_name']),
  'damdangga_name' => mysqli_real_escape_string($conn, $_POST['damdangga_name'])
);

$sql  = "
    INSERT INTO user (
        email,
        password,
        user_div,
        user_name,
        damdangga_name,
        cellphone,
        lease_type,
        regist_channel,
        created
    ) VALUES (
        '{$filtered['email']}',
        '{$hash}',
        '{$_POST['user_div']}',
        '{$filtered['user_name']}',
        '{$filtered['damdangga_name']}',
        '{$_POST['cellphone']}',
        '{$_POST['lease_type']}',
        '{$_POST['regist_channel']}',
        NOW()
    )";
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result === false){
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
  location.href = 'signup.php';
  </script>";
  error_log(mysqli_error($conn));
} else {
  echo "저장되었습니다.<a href='/admin/user_list.php'>돌아가기</a>";
}
?>
