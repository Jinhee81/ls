<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$prevPage = $_SERVER['HTTP_REFERER'];
// print_r($_POST);

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']), //그룹아이디
  'room_add' => mysqli_real_escape_string($conn, $_POST['room_add']) //추가하기버튼누르면 나오는 빈값
);
settype($filtered['id'], 'integer');

$sql_count = "select count(*) from r_g_in_building where group_in_building_id={$filtered['id']}";
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
// print_r($row);, 해당방그룹의 방개수를 파악한다.

$r_order = $row[0]+1;
// print_r($r_order);

if($row[0] >= 100){
  echo "<script>alert('관리번호는 100개를 초과할 수 없습니다.');
  location.href='building.php';
  </script>";
} else {
  $sql = "INSERT INTO r_g_in_building
    (ordered, rName, group_in_building_id)
    VALUES (
    {$r_order},
    '{$filtered['room_add']}',
    {$filtered['id']}
    )
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql); //빈값이있는 방을 생성한다

  $sql_update = "
      UPDATE group_in_building
      SET
        count = {$row[0]},
        updated = NOW()
      WHERE
        id = {$filtered['id']}
      ";
  // echo $sql_update;
  // $result_update = mysqli_query($conn, $sql_update); //방갯수를 변경시킨다.
  echo "<script>alert('추가하였습니다.');
  location.href='building.php';
  </script>";
}
?>
