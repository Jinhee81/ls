<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// echo 'solme';
$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id'])//그룹아이디
);

$sql  = "
    DELETE
      FROM group_in_building
      WHERE
        id = {$filtered['id']}
    ";
// echo $sql;
$result = mysqli_query($conn, $sql);

if($result === false){
  $sql2 = "delete from r_g_in_building where group_in_building_id={$filtered['id']}";
  $result2 = mysqli_query($conn, $sql2);
  // echo $sql2;
  $result = mysqli_query($conn, $sql);

  echo "<script>alert('삭제하였습니다.');
     location.href='building.php';
     </script>";
} else {
  echo "<script>alert('삭제하였습니다.');
    location.href='building.php';
    </script>";
}
?>
