<?php
$sql = "select * from building where user_id = {$_SESSION['id']}";
// echo $sql;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
  $buildingArray[$row['id']] = array($row['bName'],$row['pay'],$row['popbill'],$row['companynumber']);
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
    while($row4 = mysqli_fetch_array($result4)){
      $roomArray[$row3['id']][$row4['id']]=$row4['rName'];
    }
  }
}
 ?>

 <script type="text/javascript">
   var buildingArray = <?php echo json_encode($buildingArray); ?>;
   var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
   var roomArray = <?php echo json_encode($roomArray); ?>;
   console.log(buildingArray);
   console.log(groupBuildingArray);
   console.log(roomArray);
 </script>
