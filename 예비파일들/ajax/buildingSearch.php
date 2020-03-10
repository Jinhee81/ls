<!-- 원래는 여러 옵션중에서 고르는걸로 하고싶은데 방법을 잘 몰라서 결국 계약의 정보로만 빌딩명을 호출하는것으로 바꿈-> 추후 개선 필요한 파일 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

// if(isset($_POST['sessionId'])){
  $output = '';
  // $sql = "
  //   select * from building where user_id = {$_POST['sessionId']}
  //   ";
  // echo $sql;

  $sql2 = "
      select
        building.id, building.bName
      from
        realContract
      left join building
        on realContract.building_id = building.id
      where realContract.id={$_POST['contractId']}
      ";
  $result2 = mysqli_query($conn, $sql2);

  if(mysqli_num_rows($result2) > 0){
    $row2 = mysqli_fetch_array($result2);
    $output .= "<option value='$row2[0]'>$row2[1]</option>";
  } else {
    $output .= "<option>등록된 관리물건이 없습니다.</option>";
  }


  // print_r($row2);

  // $result = mysqli_query($conn, $sql);

  // if(mysqli_num_rows($result) > 0){
  //   while($row = mysqli_fetch_array($result)){
  //     $output .= "<option value='".$row['id']."'".if($row['id']===$row2[0]){
  //       echo 'selected';}.">".$row['bName']."</option>";
  //   }} else {
  //     $output .= "<option>등록된 관리물건이 없습니다.</option>";
  //   }
  // }

  echo $output;
 ?>
