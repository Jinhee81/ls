<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST)."<br>";

$filtered = array(
  'building_id' => mysqli_real_escape_string($conn, $_POST['building_id']), //건물아이디
  'good' => mysqli_real_escape_string($conn, $_POST['good']) //상품명
);
settype($filtered['building_id'], 'integer');

$sql_count = "select count(*) from good_in_building where building_id={$filtered['building_id']} and name='{$filtered['good']}'";
// echo $sql_count;
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
// echo $row[0];

if($row[0]>=1){
  echo "<script>alert('동일한 상품명은 사용 불가합니다.');
     location.href='building.php';
     </script>";
} else {
  $sql = "INSERT INTO good_in_building (name, created, building_id) VALUES
    ('{$filtered['good']}',
      now(),
      {$filtered['building_id']}
    )";
  echo $sql;
  $result = mysqli_query($conn, $sql);

  if($result){
    echo "<script>alert('저장되었습니다.');
    location.href = 'building.php';
    </script>";
  } else {
    echo "저장되지 않았습니다.";
    error_log(mysqli_error($conn));
  }
}
?>
