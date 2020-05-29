<!-- 건물뿐만아니라 방을 등록해야지 사용시작 가능함 -->

<?php
$sql = "select count(*) from building where user_id={$_SESSION['id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row[0] === 0){
  echo "<meta http-equiv='refresh' content='0; url=/svc/service/setting/building.php'>";
} else {
  $sql2 = "select id from building where user_id = {$_SESSION['id']}";
  // echo $sql;
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);

  $sql3 = "select count(*) from group_in_building where building_id={$row2[0]}"; //건물아이디로 그룹조회
  // echo $sql2;
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_array($result3);

  if($row3[0]===0){
    echo "<meta http-equiv='refresh' content='0; url=/svc/service/setting/building.php'>";
  }
}




print_r($_SESSION);

date_default_timezone_set('Asia/Seoul');
$currentDate = date('Y-m-d');

$sql_grade = "select gradename
              from user
              where id={$_SESSION['id']}";
$result_grade = mysqli_query($conn, $sql_grade);

$row_grade = mysqli_fetch_array($result_grade);

$sql1 = "select count(*) from grade where user_id={$_SESSION['id']}";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql2 = "select enddate from grade
         where user_id={$_SESSION['id']} and
               ordered={$row1[0]}";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);


$sql_c_p = "select count(*)
        from realContract
        where user_id={$_SESSION['id']} and
              getstatus(startdate, enddate2) = 'present'
        ";
$result_c_p = mysqli_query($conn, $sql_c_p);

$row_c_p = mysqli_fetch_array($result_c_p);


if(strtotime($currentDate) > strtotime($row2[0])){
  if((int)$row_c_p[0] > 20){
      echo "<meta http-equiv='refresh' content='0; url=/svc/main/payment.php'>";
  }
}

//처음에 등급명으로 했다가 등급명보다 만료일이 더 중요해서 코드를 변경함

 ?>
