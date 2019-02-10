<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST)."<br>";

$filtered = array(
  'building_id' => mysqli_real_escape_string($conn, $_POST['building_id']), //건물아이디
  'id' => mysqli_real_escape_string($conn, $_POST['id']), //상품아이디
  'good' => mysqli_real_escape_string($conn, $_POST['good']) //상품명
);
settype($filtered['building_id'], 'integer');
settype($filtered['id'], 'integer');

$sql_count = "
  select count(*) from good_in_building
    where building_id={$filtered['building_id']}
      and name='{$filtered['good']}'";
// echo $sql_count;
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
// echo $row[0];

if($row[0]>=1){
  echo "<script>alert('동일한 그룹명은 사용 불가합니다.');
     location.href='building.php';
     </script>";
} else {
  $sql = "UPDATE good_in_building
    SET
    name = '{$filtered['good']}',
    updated = NOW()
  WHERE
    id = {$filtered['id']} and
    building_id = {$filtered['building_id']}";

  // echo $sql;
  $result = mysqli_query($conn, $sql);
  //
  if($result){
  echo "<script>alert('저장되었습니다.');
    location.href = 'building.php';
    </script>";
  } else {
  echo "<script>alert('저장에 문제가 생겼습니다. 관리자에게 문의해주세요.');
    location.href='building.php';
    </script>";
  error_log(mysqli_error($conn));
  }
}
?>
