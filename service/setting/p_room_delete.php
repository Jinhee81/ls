<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// echo "<br>";

$filtered = array(
  'group' => mysqli_real_escape_string($conn, $_POST['group']),
  'rNumber' => mysqli_real_escape_string($conn, $_POST['rNumber'])
);
// print_r($filtered);
// echo "<br>";

$sql  = "
    DELETE
      FROM r_g_in_building
      WHERE
        rName = '{$filtered['rNumber']}' and
        group_in_building_id = {$filtered['group']}
    ";
// echo $sql;
$result = mysqli_query($conn, $sql);

$sql_count = "select count(*) from r_g_in_building where group_in_building_id={$filtered['group']}";
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
print_r($row);

$sql_update = "
    UPDATE group_in_building
    SET
      count = {$row[0]},
      updated = NOW()
    WHERE
      id = {$filtered['group']}
    ";
// echo $sql_update;
$result_update = mysqli_query($conn, $sql_update);

if($result_update === false){
  echo mysqli_error($conn);
} else {
  echo "<script>alert('삭제하였습니다.');
  location.href='building.php';
  </script>";
}
?>
