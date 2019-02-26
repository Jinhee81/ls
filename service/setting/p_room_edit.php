<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']), //그룹아이디
  'gName' => mysqli_real_escape_string($conn, $_POST['gName']) //그룹명
);
settype($filtered['id'],'integer');

print_r($_POST);

$roomArray = [];
for ($i=0; $i < (int)$_POST['count']; $i++) {
  $roomed['rName'.$i] = mysqli_real_escape_string($conn, $_POST['rName'.$i]);
}
// print_r($roomArray);

echo 'siwon'; print_r($roomed['rName1']); echo 'misun';
for ($i=0; $i < (int)$_POST['count']; $i++) {
  echo $roomed[$i];
}
echo 'solme';

// $sql1 = "
//   UPDATE group_in_building
//   SET
//     gName = '{$filtered['gName']}',
//     updated = NOW()
//   WHERE
//     id = {$filtered['id']}
//   ";
// $result1 = mysqli_query($conn, $sql1); //그룹명수정
//
// $r_order = 1;
//
// foreach($roomed as $key => $value){
//   $sql = "
//     UPDATE r_g_in_building
//     SET
//       rName = '{$value}'
//     WHERE
//       ordered = {$r_order} and
//       group_in_building_id = {$filtered['id']}
//   ";
//
//   $r_order += 1;
//   $result = mysqli_query($conn, $sql);
//
//   $sql_overlap_check =
//     "select count(*) from r_g_in_building
//     where group_in_building_id={$filtered['id']}
//     and rName = '{$value}'
//     ";
//   $result_overlap_check = mysqli_query($conn, $sql_overlap_check);
//   $row_overlap_check = mysqli_fetch_array($result_overlap_check);
//   // echo $sql_overlap_check;
//   // print_r($row_overlap_check[0]);
//
//   if((int)$row_overlap_check[0] >= 2 ){
//     echo "<script>
//     alert('동일한 관리번호는 사용 불가합니다.');</script>";
//     goto end;
//   } //동일한관리번호 불가 처리 9999
// }
//
// echo
// "<script>
// alert('수정하였습니다.');
// location.href='modal_b_group_edit2.php?id=".$filtered['id']."';
// </script>";
//
// end :
// echo "<script>
//   location.href='modal_b_group_edit2.php?id=".$filtered['id']."';</script>";

?>
