<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST)."<br>";

$filtered = array(
  'building_id' => mysqli_real_escape_string($conn, $_POST['building_id']), //건물아이디
  'good' => mysqli_real_escape_string($conn, $_POST['good']) //상품명
);
// settype($filtered['building_id'], 'integer');
print_r($filtered)."<br>";

$sql = "INSERT INTO good_in_building (name, created, building_id) VALUES
  ('{$filtered['good']}',
    now(),
    {$filtered['building_id']}
  )";
echo $sql;
$result = mysqli_query($conn, $sql);

if($result){
  echo "<script>alert('저장되었습니다.');
  location.hred(building.php)
  </script>";
} else {
  echo "저장되지 않았습니다.";
  error_log(mysqli_error($conn));
}
?>
