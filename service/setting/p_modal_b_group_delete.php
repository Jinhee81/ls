<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id'])
);

$sql  = "
    DELETE
      FROM group_in_building
      WHERE
        id = {$filtered['id']}
    ";
echo $sql;
$result = mysqli_query($conn, $sql);

if($result === false){
  echo mysqli_error($conn);
} else {
  echo "<script>alert('삭제하였습니다.');
  location.href='building.php';
  </script>";
}
?>
