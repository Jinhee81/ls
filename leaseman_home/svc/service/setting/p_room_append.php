<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']) //그룹아이디
);
settype($filtered['id'], 'integer');
//
$sql_count = "select count(*) from r_g_in_building where group_in_building_id={$filtered['id']}";
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
// print_r($row); //당방그룹의 방개수를 파악한다.

$r_order = $row[0]+1;
print_r($r_order);

if($row[0] >= 100){
  echo "<script>alert('관리번호는 100개를 초과할 수 없습니다.');
  location.href='modal_b_group_edit3.php?id=".$filtered['id'].";
  </script>";
} else {
  $sql = "INSERT INTO r_g_in_building
    (ordered, rName, group_in_building_id)
    VALUES (
    {$r_order},
    '',
    {$filtered['id']}
    )
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql); //빈값이있는 방을 생성한다

  $sql_update = "
      UPDATE group_in_building
      SET
        count = {$r_order},
        updated = NOW()
      WHERE
        id = {$filtered['id']}
      ";
  echo $sql_update;
  $result_update = mysqli_query($conn, $sql_update); //방갯수를 변경시킨다.
  echo "<script>alert('추가하였습니다.');
  location.href='b_group_room_edit3.php?id=".$filtered['id']."';
  </script>";
}
?>
