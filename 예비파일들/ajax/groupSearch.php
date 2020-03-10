<!-- 원래는 여러 옵션중에서 고르는걸로 하고싶은데 방법을 잘 몰라서 결국 계약의 정보로만 빌딩명을 호출하는것으로 바꿈-> 추후 개선 필요한 파일 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// $output = '';

$sql2 = "
    select
      group_in_building.id, group_in_building.gName
    from
      realContract
    left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
    where realContract.id={$_POST['contractId']}
    ";
$result2 = mysqli_query($conn, $sql2);

if(mysqli_num_rows($result2) > 0){
  $row2 = mysqli_fetch_array($result2);
  $output .= "<option value='$row2[0]'>$row2[1]</option>";
} else {
  $output .= "<option>등록된 그룹명이 없습니다.</option>";
}

echo $output;
 ?>
