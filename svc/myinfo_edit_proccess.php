<!-- 담당자명 항목이 있었는데 없애서 담당자명 부분을 주석처리함 -->
<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

$filtered = array(
  'user_name' => mysqli_real_escape_string($conn, $_POST['user_name']),
  'manager_name' => mysqli_real_escape_string($conn, $_POST['manager_name'])
);

// 'damdangga_name' => mysqli_real_escape_string($conn, $_POST['damdangga_name'])

$sql  = "
    UPDATE user
    SET
      user_div = '{$_POST['user_div']}',
      user_name = '{$filtered['user_name']}',
      manager_name = '{$filtered['manager_name']}',
      cellphone = '{$_POST['cellphone']}',
      lease_type = '{$_POST['lease_type']}',
      updated = NOW()
    WHERE
      id = {$_SESSION['id']}
    ";
$result = mysqli_query($conn, $sql);


$_SESSION['user_div'] = $_POST['user_div'];
$_SESSION['user_name'] = $filtered['user_name'];
$_SESSION['manager_name'] = $filtered['manager_name'];
$_SESSION['cellphone'] = $_POST['cellphone'];
$_SESSION['lease_type'] = $_POST['lease_type'];

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
