<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'gName' => mysqli_real_escape_string($conn, $_POST['gName']),
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'rName0' => mysqli_real_escape_string($conn, $_POST['rName0'])
);

$query =
  "select count(*) from group_in_building where name='{$filtered['gName']}';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if($row[0] >= 1){
  alert('동일한 그룹명은 사용불가합니다.');
} else {
  $sql  = "
    INSERT INTO group_in_building (
        gName,
        created,
        building_id
    ) VALUES (
        '{$filtered['gName']}',
        NOW(),
        {$filtered['id']}
    )";
    $result = mysqli_query($conn, $sql);
    echo $sql+'\n';
    var_dump($result)+'\n';

    $sql2 = "SELECT * FROM group_in_building";
    $result2 = mysqli_query($conn, $sql2);
    echo $sql2+'\n';
    var_dump($result2)+'\n';

  // $sql2 = "INSERT INTO r_g_in_building (
  //      rName,
  //      group_in_building_id
  //    ) VALUES (
  //      '{$filtered['rName1']}',
  //
  //    )";
  // echo $sql2;

// for ($i=0; $i < $filtered['count'] ; $i++) {
//   $sql2 = "INSERT INTO r_g_in_building (
//     rName,
//     group_in_building_id
//   ) VALUES (
//     rName[]
//   )"
// }


// $result = mysqli_query($conn, $sql);
// echo $sql;
// echo $result;
// if($result === false){
//     echo mysqli_error($conn);
// } else {
//   echo
//   "<script>
//   alert('저장되었습니다.');
//   window.location.href='building.php';
//   </script>";
// }
?>
