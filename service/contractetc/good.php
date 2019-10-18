<?php
$sql = "select * from building where user_id = {$_SESSION['id']}";
// echo $sql;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
  $buildingArray[$row['id']] = [$row['bName']];
}

foreach ($buildingArray as $key => $value) { //key는 건물아이디, value는 건물이름
  $sql2 = "select * from good_in_building where building_id={$key}"; //건물아이디로 그룹조회
  // echo $sql2;
  $result2 = mysqli_query($conn, $sql2);
  $goodBuildingArray[$key] = array();
  while($row2 = mysqli_fetch_array($result2)){
    $goodBuildingArray[$key][$row2['id']]=$row2['name'];//상품아이디
  }
}

// echo "building Array : "; print_r($buildingArray);
// echo "good Array : "; print_r($goodBuildingArray);
?>
<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var goodBuildingArray = <?php echo json_encode($goodBuildingArray); ?>;
  // console.log(buildingArray);
  // console.log(goodBuildingArray);
</script>
