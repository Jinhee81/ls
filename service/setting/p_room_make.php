<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'gName' => mysqli_real_escape_string($conn, $_POST['gName']),
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'count' => mysqli_real_escape_string($conn, $_POST['count'])
  // 'rName'.'0' => mysqli_real_escape_string($conn, $_POST['rName'.'0'])
);
for ($i=0; $i < (int)$filtered['count']; $i++) {
  $roomed['rName'.$i] = mysqli_real_escape_string($conn, $_POST['rName'.$i]);
}

$sql5 =
  "select count(*) from group_in_building where gName='{$filtered['gName']}'";
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_array($result5);

if((int)$row5[0] >= 1){
  echo "<script>
  alert('동일한 그룹명은 사용불가합니다.');
  location.href='building.php';
  </script>";
  } else {
  $sql6  = "
    INSERT INTO group_in_building (
        gName,
        count,
        created,
        building_id
    ) VALUES (
        '{$filtered['gName']}',
        '{$filtered['count']}',
        NOW(),
        {$filtered['id']}
    )";
  $result6 = mysqli_query($conn, $sql6); //건물안에 그룹명 생성

  $id = mysqli_insert_id($conn);

  foreach($roomed as $key => $value){
    $sql = "
      INSERT INTO r_g_in_building (
      rName,
      group_in_building_id
    ) VALUES (
      '{$value}',
      {$id}
    )";
    $result = mysqli_query($conn, $sql);
  } //건물안 그룹명 내에 방번호 생성

  echo
  "<script>
  alert('저장되었습니다.');
  location.href='building.php';
  </script>";
}
?>
