<?php
session_start();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

$sql = "select id, bName
        from building
        where user_id={$_SESSION['id']}";

$result = mysqli_query($conn, $sql);

$buildingRow = array();

while($row = mysqli_fetch_array($result)){
  array_push($buildingRow, array($row['id'],$row['bName']));
}

for ($i=0; $i < count($buildingRow); $i++) {
  $sql2 = "select id, gName
           from group_in_building
           where building_id = {$buildingRow[$i][0]}
          ";
  $result2 = mysqli_query($conn, $sql2);
  $buildingRow[$i][2] = array();
  while ($row2 = mysqli_fetch_array($result2)) {
     array_push($buildingRow[$i][2], array($row2['id'], $row2['gName']));
  }
}

for ($i=0; $i < count($buildingRow); $i++) {
  for ($j=0; $j < count($buildingRow[$i][2]); $j++) {
    $sql3 = "select count(*)
             from r_g_in_building
             where group_in_building_id = {$buildingRow[$i][2][$j][0]}
            ";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_array($result3)) {
       $buildingRow[$i][2][$j][3] = $row3[0];
    }

    $sql4 = "select id from r_g_in_building
             where group_in_building_id = {$buildingRow[$i][2][$j][0]}";
    $result4 = mysqli_query($conn, $sql4);
    $buildingRow[$i][2][$j][4] = array();
    while ($row4 = mysqli_fetch_array($result4)) {
      array_push($buildingRow[$i][2][$j][4], $row4[0]);
    }
  }
}


for ($i=0; $i < count($buildingRow); $i++) {
  for ($j=0; $j < count($buildingRow[$i][2]); $j++) {
    $a = 0;
    for ($k=0; $k < count($buildingRow[$i][2][$j][4]); $k++) {
      $sql5 = "select count(*) from realContract
               where user_id={$_SESSION['id']} and
                     r_g_in_building_id={$buildingRow[$i][2][$j][4][$k]}
               ";
      // echo $sql5;
      // print_r($buildingRow[$i][2][$j][4][$k])."<br>";
      $result5 = mysqli_query($conn, $sql5);
      $row5 = mysqli_fetch_array($result5);
      // var_dump($row5[0]);
      if((int)$row5[0] >= 1){
        $a += 1;
      }
    }
    $buildingRow[$i][2][$j][4] = $a;
    $buildingRow[$i][2][$j][5] = (int)$buildingRow[$i][2][$j][3] - (int)$buildingRow[$i][2][$j][4];
  }
}
// print_r($_SESSION);
// print_r($buildingRow);
// echo 5;
 ?>
