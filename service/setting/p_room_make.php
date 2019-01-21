<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered = array(
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'count' => mysqli_real_escape_string($conn, $_POST['count']),
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'rName[0]' => mysqli_real_escape_string($conn, $_POST['rName[0]'])
);

$sql  = "
  INSERT INTO group_in_building (
      name,
      count,
      created,
      building_id
  ) VALUES (
      '{$filtered['name']}',
      {$filtered['count']},
      NOW(),
      {$filtered['id']}
  )";

  $sql2 = "INSERT INTO r_g_in_building (
       rName,
       group_in_building_id
     ) VALUES (
       rName[0];
     )";
  echo $sql2;

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
