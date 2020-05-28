<?php
$sql = "select * from building where user_id = {$_SESSION['id']}";
// echo $sql;
$result = mysqli_query($conn, $sql);
$buildingArray = array();
while($row = mysqli_fetch_array($result)){
  $buildingArray[$row['id']] =
                array($row['bName'],
                      $row['pay'],
                      $row['popbillid'],
                      $row['contact1'],
                      $row['contact2'],
                      $row['contact3'],
                      $row['cnumber1'],
                      $row['cnumber2'],
                      $row['cnumber3']
                    );
}

$buildingcount = 0;
foreach ($buildingArray as $key => $value) {
  $buildingcount += count($value);
}

// print_r($buildingcount);

if($buildingcount===0){
  echo "<script>
    alert('물건을 등록한 것이 없네요. 환경설정에서 물건을 등록해야 이용할 수 있어요!');
    </script>";
  echo "<meta http-equiv='refresh' content='0; url=/svc/service/setting/building.php'>";
}

foreach ($buildingArray as $key => $value) { //key는 건물아이디, value는 건물이름
  $sql2 = "select * from group_in_building where building_id={$key}"; //건물아이디로 그룹조회
  // echo $sql2;
  $result2 = mysqli_query($conn, $sql2);
  $groupBuildingArray[$key] = array();
  while($row2 = mysqli_fetch_array($result2)){
    $groupBuildingArray[$key][$row2['id']]=$row2['gName'];//그룹아이디
  }
}

foreach ($groupBuildingArray as $key => $value) {
  $sql3 = "select id from group_in_building where building_id={$key}"; //건물아이디로 그룹조회 (건물아이디가 키값)
  // echo $sql3;
  $result3 = mysqli_query($conn, $sql3);
  while($row3 = mysqli_fetch_array($result3)){
    $sql4 = "select id, rName from r_g_in_building where group_in_building_id={$row3['id']}";
    // echo $sql4;다시 그룹아이디로 방번호조회
    $result4 = mysqli_query($conn, $sql4);
    $roomArray[$row3['id']] = array();
    while($row4 = mysqli_fetch_array($result4)){
      $roomArray[$row3['id']][$row4['id']]=$row4['rName'];
    }
  }
}

//room 개수 구하고, room 등록이 없으면 환경설정화면으로 이동시킴

$roomcount = 0;
foreach ($roomArray as $key => $value) {
  $roomcount += count($value);
}

// print_r($roomcount);

if($roomcount===0){
  echo "<script>
    alert('관리호수를 등록한 것이 없네요. 환경설정에서 관리호수를 등록해야 이용할 수 있어요!');
    </script>";
  echo "<meta http-equiv='refresh' content='0; url=/svc/service/setting/building.php'>";
}

foreach ($buildingArray as $key => $value) { //key는 건물아이디, value는 건물이름
  $sql4 = "select
            id, building_id, group_in_building_id,
            r_g_in_building_id,
            startDate, endDate2,
            getStatu(startDate, endDate2) as status2
          from realContract
          where user_id = {$_SESSION['id']} and
                building_id = {$key} and
                (getStatus(startDate, endDate2)='present' or
                 getStatus(startDate, endDate2)='waiting')
          ";
  echo $sql4;
  $result4 = mysqli_query($conn, $sql4);
  $fullrooms = array();
  while($row4 = mysqli_fetch_array($result4)){
    $fullrooms[]= $row4;
  }
}
print_r($fullrooms);

$fullrooms = array();

// print_r($fullrooms);
// echo 12;
// $full = array();
// $empty = array();
//
// foreach ($roomArray as $key => $value) {
//   foreach ($value as $key => $value) {
//     for ($i=0; $i < count($fullrooms); $i++) {
//       if($key==(int)$fullrooms[$i][2]){
//         array_push($full, $key);
//       } else {
//         array_push($empty, $key);
//       }
//     }
//   }
// }
//
// print_r($full).'<br>';
// print_r($empty).'<br>';
//
// // print_r($roomArray);
// echo 20;


// print_r($fb);

 ?>
