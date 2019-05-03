<!-- 이 파일의 기능은 그냥 없애기로 함 19.4.18-->

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']), //지우려는방의 그룹아이디
  'roomValue' => mysqli_real_escape_string($conn, $_POST['roomValue']) //지우려는방의 방이름
);

$sql  = "
    SELECT *
      FROM r_g_in_building
      WHERE
        rName = '{$filtered['roomValue']}' and
        group_in_building_id = {$filtered['id']}
    ";
echo $sql;
// $result = mysqli_query($conn, $sql);
// //
// $sql_count = "select count(*) from r_g_in_building where group_in_building_id={$filtered['id']}";
// $result_count = mysqli_query($conn, $sql_count);
// $row = mysqli_fetch_array($result_count);
// // print_r($row);
// //
// $sql_update = "
//     UPDATE group_in_building
//     SET
//       count = {$row[0]},
//       updated = NOW()
//     WHERE
//       id = {$filtered['id']}
//     ";
// // echo $sql_update;
// $result_update = mysqli_query($conn, $sql_update);


// $sql_update2 = "
//   UPDATE r_g_in_building
//   SET
//    ordered = {$i}
//   WHERE group_in_building_id = {$filtered['id']} and
//    ordered = {$i}
// ";
// echo $sql_update2."<br>";
// $result_update2 = mysqli_query($conn, $sql_update2);
// echo
//   "<script>
//       alert('삭제하였습니다.');
//       location.href='modal_b_group_edit2.php?id={$filtered['id']}';
//   </script>";
//
// echo "<script>alert('solmi88');</script>"
?>
