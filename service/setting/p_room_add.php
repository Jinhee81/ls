<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'room_add' => mysqli_real_escape_string($conn, $_POST['room_add'])
);
settype($filtered['id'], 'integer');

$sql = "INSERT INTO r_g_in_building
  (rName, group_in_building_id)
  VALUES (
  '{$filtered['room_add']}',
  {$filtered['id']}
  )
";
$result = mysqli_query($conn, $sql);

$sql_count = "select count(*) from r_g_in_building where group_in_building_id={$filtered['id']}";
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
print_r($row);

$sql_update = "
    UPDATE group_in_building
    SET
      count = {$row[0]},
      updated = NOW()
    WHERE
      id = {$filtered['id']}
    ";
// echo $sql_update;
$result_update = mysqli_query($conn, $sql_update);

if($result_update === true){
  header('Location: building.php');
} else {
  echo "저장되지않았습니다.";
  error_log(mysqli_error($conn));
}

?>
