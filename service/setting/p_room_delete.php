<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'group' => mysqli_real_escape_string($conn, $_POST['group']), //지우려는방의 그룹아이디
  'rNumber' => mysqli_real_escape_string($conn, $_POST['rNumber']) //지우려는방의 방이름
);

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
// print_r($row);

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

for ($i=1; $i <= $row[0]; $i++) {
  $sql_update2 = "
    UPDATE r_g_in_building
    SET
     ordered = {$i}
    WHERE group_in_building_id = {$filtered['group']}
  ";
  // echo $sql_update2."<br>";
  $result_update2 = mysqli_query($conn, $sql_update2);
}

echo "<script>alert('삭제하였습니다.');
location.href='building.php';
</script>";
?>
