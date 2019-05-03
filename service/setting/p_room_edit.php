<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']), //그룹아이디
  'gName' => mysqli_real_escape_string($conn, $_POST['gName']) //그룹명
);
settype($filtered['id'],'integer');
// print_r($_POST);

$sql1 = "
  UPDATE group_in_building
  SET
    gName = '{$filtered['gName']}',
    updated = NOW()
  WHERE
    id = {$filtered['id']}
  ";
$result1 = mysqli_query($conn, $sql1); //그룹명수정

$sql = "select * from group_in_building where id = {$filtered['id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

// echo $sql; 카운트가져오려고 sql문 쓴거
// print_r($row);

// $roomArray = [];
// print_r((int)$_POST['count']);
for ($i=0; $i < (int)$row['count']; $i++) {
  $roomArray['rName'.$i] = mysqli_real_escape_string($conn, $_POST['rName'.$i]);
  // array_push($roomArray, $roomArray['rName'.$i]);
}

// print_r($roomArray);echo 7;

$num = array_count_values($roomArray);

// print_r($num);echo 9;

foreach($num as $key => $value){
  if ($value >= 2) {
    echo "<script>
         alert('동일한 관리번호는 사용 불가합니다.');</script>";
         goto end;
  } //동일한관리번호 불가 처리 9999
}

$r_order = 1;

foreach($roomArray as $key => $value){
  $sql = "
    UPDATE r_g_in_building
    SET
      rName = '{$value}'
    WHERE
      ordered = {$r_order} and
      group_in_building_id = {$filtered['id']}
  ";

  $r_order += 1;
  $result = mysqli_query($conn, $sql);
}

echo
"<script>
alert('수정하였습니다.');
location.href='modal_b_group_edit3.php?id=".$filtered['id']."';
</script>";


end :
echo "<script>
  location.href='modal_b_group_edit3.php?id=".$filtered['id']."';</script>";

?>
