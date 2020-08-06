<!-- 담당자명 항목이 있었는데 없애서 담당자명 부분을 주석처리함 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);

$filtered = array(
  'user_name' => mysqli_real_escape_string($conn, $_POST['user_name'])
);

// 'damdangga_name' => mysqli_real_escape_string($conn, $_POST['damdangga_name'])

$sql  = "
    UPDATE user
    SET
      user_div = '{$_POST['user_div']}',
      user_name = '{$filtered['user_name']}',
      cellphone = '{$_POST['cellphone']}',
      lease_type = '{$_POST['lease_type']}',
      updated = NOW()
    WHERE
      id = {$_SESSION['id']}
    ";
$result = mysqli_query($conn, $sql);


$sql2 = "SELECT * FROM user WHERE id = {$_SESSION['id']}";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$_SESSION['user_div'] = $row2['user_div'];
$_SESSION['user_name'] = $row2['user_name'];
// $_SESSION['damdangga_name'] = $row['damdangga_name'];
$_SESSION['cellphone'] = $row2['cellphone'];
$_SESSION['lease_type'] = $row2['lease_type'];

// echo $_SESSION['user_div'];
// echo $_SESSION['user_name'];
// echo $_SESSION['damdangga_name'];
// echo $_SESSION['cellphone'];
// echo $_SESSION['lease_type'];


if($result2 === false){
    echo mysqli_error($conn);
} else {
  echo "<script>
  alert('수정되었습니다.');
  window.location.href='myinfo.php';
  </script>";
}
// mysqli_close($conn);

?>
