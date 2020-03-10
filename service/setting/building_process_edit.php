<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'pay' => mysqli_real_escape_string($conn, $_POST['pay'])
);

$sql  = "
    UPDATE building
    SET
      bName = '{$filtered['name']}',
      pay = '{$filtered['pay']}'
    WHERE
      id = {$_POST['id']}
    ";
// echo $sql;
// var_dump($_POST['id']);

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// print_r($row);

if($result === false){
  // echo "<script>
  // alert('삭제할 수 없습니다. 건물안 그룹이 존재합니다.');
  // location.href='building.php';
  // </script>";
  echo mysqli_error($conn);
} else {
  echo "<script>alert('수정하였습니다.');
  location.href='building.php';
  </script>";
}

?>
