<?php
$sql = "select count(*) from building where user_id={$_SESSION['id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$b_count = (int)$row['count(*)'];

// var_dump($b_count);
// var_dump($row['count(*)']);
if($b_count == 0){
  echo "<meta http-equiv='refresh' content='0; url=/service/setting/building.php'>";
}

// print_r($_SESSION);

// date_default_timezone_set('Asia/Seoul');
// $currentDate = date('Y-m-d');
// $currentDateDate = new DateTime($currentDate);
// $startDateDate = new DateTime($_SESSION['created']);
//
// $fordays = date_diff($currentDateDate, $startDateDate);
//
// $fordays2 = $fordays->days;

// var_dump($fordays2); //30일 이상이어도 계약건수가 20건이하이면 무료 사용이 있기 때문에 30일이상 이런거는 의미가 없어서 주석처리 했음

$sql_grade = "select gradename
              from user
              where id={$_SESSION['id']}";
$result_grade = mysqli_query($conn, $sql_grade);

$row_grade = mysqli_fetch_array($result_grade);

$sql_c_p = "select count(*)
        from realcontract
        where user_id={$_SESSION['id']} and
              getstatus(startdate, enddate2) = 'present'
        ";
$result_c_p = mysqli_query($conn, $sql_c_p);

$row_c_p = mysqli_fetch_array($result_c_p);

// var_dump($row_c_p[0]);

if(($row_grade==='feefree') && ((int)$row_c_p[0] > 20)){
  echo "<meta http-equiv='refresh' content='0; url=/main/payment.php'>";
}
 ?>
