<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'user_name' => mysqli_real_escape_string($conn, $_POST['user_name']),
  'damdangga_name' => mysqli_real_escape_string($conn, $_POST['damdangga_name'])
);

$sql  = "
    UPDATE user
    SET
      user_div = '{$_POST['user_div']}',
      user_name = '{$filtered['user_name']}',
      damdangga_name = '{$filtered['damdangga_name']}',
      cellphone = '{$_POST['cellphone']}',
      lease_type = '{$_POST['lease_type']}',
      updated = NOW()
    WHERE
      email = '{$_POST['email']}'
    ";
$result = mysqli_query($conn, $sql);


$sql = "SELECT * FROM user WHERE email = '{$_POST['email']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['user_div'] = $row['user_div'];
$_SESSION['user_name'] = $row['user_name'];
$_SESSION['damdangga_name'] = $row['damdangga_name'];
$_SESSION['cellphone'] = $row['cellphone'];
$_SESSION['lease_type'] = $row['lease_type'];

// echo $_SESSION['user_div'];
// echo $_SESSION['user_name'];
// echo $_SESSION['damdangga_name'];
// echo $_SESSION['cellphone'];
// echo $_SESSION['lease_type'];


if($result === false){
    echo mysqli_error($conn);
} else {
  echo "<script>
  alert('수정되었습니다.');
  window.location.href='myinfo.php';
  </script>";
}
mysqli_close($conn);
?>
