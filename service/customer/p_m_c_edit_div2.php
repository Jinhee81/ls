<?php
echo "hello";
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$fil = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),//고객아이디
  'div2' => mysqli_real_escape_string($conn, $_POST['div2'])
);

settype($fil['id'], 'integer');

$sql="
      UPDATE customer
          SET
            div2 = '{$fil['div2']}',
            updated = now(),
            updatePerson = {$_SESSION['id']}
          WHERE id={$fil['id']}";
$result = mysqli_query($conn, $sql);

if($result){
  echo "<script>alert('수정하였습니다.');
  location.href = 'm_c_edit.php?id=".$fil['id']."';
  </script>";
} else {
  echo "<script>alert('수정 과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
  location.href = 'm_c_edit.php?id=".$fil['id']."';
  </script>";
  error_log(mysqli_error($conn));
}
 ?>
