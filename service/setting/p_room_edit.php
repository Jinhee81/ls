<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'building_id' => mysqli_real_escape_string($conn, $_POST['building_id']), //건물아이디
  'name' => mysqli_real_escape_string($conn, $_POST['name']), //그룹명
  'group' => mysqli_real_escape_string($conn, $_POST['group']), //그룹아이디
);

// print_r($_POST)."<br>";
// print_r($filtered)."<br>";

$sql_edit_r_count = "select count(*) from r_g_in_building
       where group_in_building_id={$filtered['group']}";
$result_edit_r_count = mysqli_query($conn, $sql_edit_r_count);
$row_edit_r_count = mysqli_fetch_array($result_edit_r_count);

for ($i=0; $i < (int)$row_edit_r_count[0]; $i++) {
  $roomed['rName'.$i] = mysqli_real_escape_string($conn, $_POST['rName'.$i]);
}

$sql6 = "
  UPDATE group_in_building
  SET
    gName = '{$filtered['name']}',
    updated = NOW()
  WHERE
    id = {$filtered['group']}
  ";
$result6 = mysqli_query($conn, $sql6); //그룹명수정 질의
// echo $sql6."<br>";
$r_order = 1;
foreach($roomed as $key => $value){
  $sql = "
    UPDATE r_g_in_building
    SET
      rName = '{$value}'
    WHERE
      ordered = {$r_order} and
      group_in_building_id = {$filtered['group']}
  ";
  // echo $sql."<br>";
  $r_order += 1;
  $result = mysqli_query($conn, $sql);
} //건물안 그룹명 내에 방번호 수정(update로하면 안되고, insert로 해야한다)

foreach($roomed as $key => $value){
  $sql_overlap_check =
    "select count(*) from r_g_in_building
    where group_in_building_id={$filtered['group']}
    and rName = {$value}
    ";
  $result_overlap_check = mysqli_query($conn, $sql_overlap_check);
  $row_overlap_check = mysqli_fetch_array($result_overlap_check);

  if($row_overlap_check[0] >= 2 ){
    echo "<script>
    alert('동일한 관리번호는 사용 불가합니다.');</script>";
    goto end;
  }
}

echo
"<script>
alert('수정하였습니다.');
location.href='building.php';
</script>";

end :
echo "<script>
  location.href='building.php';</script>";

?>
