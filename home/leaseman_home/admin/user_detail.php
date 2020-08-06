<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
if(!isset($_SESSION['ais_login'])){
  header('Location: /admin/main/alogin.php');
}
require('view/aconn.php');
require('view/admin_header.php');


$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//사용자번호
settype($filtered_id, 'integer');

$sql = "select
          id, email, user_div, user_name,
          manager_name, cellphone,
          lease_type, regist_channel, regist_etc,
          created, updated,
          (select count(*) from building where user_id = {$filtered_id}) as building_count
        from user
        where id={$filtered_id}
       ";
echo $sql;

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$sql_all = "
        select count(*)
        from realContract
        where user_id={$filtered_id}
        ";
$result_all = mysqli_query($conn, $sql_all);
$row_all = mysqli_fetch_array($result_all);

$sql_present = "
        select count(*)
        from realContract
        where
            user_id={$filtered_id} and
            getstatus(startdate, enddate2) = 'present'
         ";
$result_present = mysqli_query($conn, $sql_present);
$row_present = mysqli_fetch_array($result_present);

$sql_end = "
       select count(*)
       from realContract
       where
           user_id={$filtered_id} and
           getstatus(startdate, enddate2) = 'the_end'
        ";
$result_end = mysqli_query($conn, $sql_end);
$row_end = mysqli_fetch_array($result_end);

$sql_waiting = "
        select count(*)
        from realContract
        where
            user_id={$filtered_id} and
            getstatus(startdate, enddate2) = 'waiting'
         ";
$result_waiting = mysqli_query($conn, $sql_waiting);
$row_waiting = mysqli_fetch_array($result_waiting);


date_default_timezone_set('Asia/Seoul');
$currentDate = date('Y-m-d');

// $date1 = $currentDate;
// $date2 = $row['created'];
//
// function diffdate($date1, $date2){
//   $diff = abs(strtotime($date2) - strtotime($date1));
//   $years = floor($diff / (365*60*60*24));
//   $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
//   $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
//
//   // return array('year'=>$years, 'month'=>$months, 'day'=>$days);
//   return $days;
// }


$currentDateDate = strtotime($currentDate);
$startDateDate = strtotime($row['created']);

$fordays = $currentDateDate - $startDateDate;

$fordays2 = round($fordays / (60*60*24));


$sql_grade = "select
                gradename, executivedate, startdate, enddate, formonth, payamount,
                ordered
              from grade
              where user_id={$filtered_id}
              ";
echo $sql_grade;

$result_grage = mysqli_query($conn, $sql_grade);

$gradeArray = array();

while($row_grade = mysqli_fetch_array($result_grage)){
  $gradeArray[] = $row_grade;
}

$div1 = array('입주자', '거래처', '기타', '문의');

$customerRows = array();

$sql1 = "select count(*) from customer where user_id={$filtered_id}";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

for ($i=0; $i < count($div1); $i++) {
  $sql2 = "select count(*)
          from customer
          where user_id={$filtered_id} and
                div1='{$div1[$i]}'";
  // echo $sql2."<br>";

  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  array_push($customerRows, $row2[0]);
}

 ?>
<section class="container mt-3">
  <div class="text-center">
    <h1>회원상세보기</h1>
    <table class="table mt-5 table-bordered">
        <tr class="table-success">
          <th>회원번호</th>
          <th>이메일</th>
          <th>구분(유형,회원명)</th>
          <th>휴대폰번호</th>
          <th>가입경로</th>
          <th>가입일시</th>
          <th>가입일수</th>
        </tr>
        <tr>
          <td><?=$row['id']?></td>
          <td><?=$row['email']?></td>
          <td><?=$row['user_div'].'('.$row['lease_type'].','.$row['user_name'].')'?></td>
          <td><?=substr($row['cellphone'],0,3).'-'.substr($row['cellphone'],3,4).'-'.substr($row['cellphone'],7,4)?></td>
          <td><?=$row['regist_channel'].'('.$row['regist_etc'].')'?></td>
          <td><?=$row['created']?></td>
          <td><?=$fordays2?></td>
        </tr>
    </table>
    <table class="table mt-5 table-bordered">
        <tr class="table-success">
          <th rowspan="2">건물수</th>
          <th colspan="4">계약수</th>
        </tr>
        <tr class="table-success">
          <td>전체</td>
          <td><b>현재</b></td>
          <td>대기</td>
          <td>종료</td>
        </tr>
        <tr>
          <td><?=$row['building_count']?></td>
          <td><?=$row_all[0]?></td>
          <td><b><?=$row_present[0]?></b></td>
          <td><?=$row_waiting[0]?></td>
          <td><?=$row_end[0]?></td>
        </tr>
    </table>
    <table class="table mt-5 table-bordered">
        <tr class="table-success">
          <td>전체</td>
          <td><b>입주자</b></td>
          <td>문의</td>
          <td>거래처</td>
          <td>기타</td>
        </tr>
        <tr>
          <td><?=$row1[0]?></td>
          <td><?=$customerRows[0]?></td>
          <td><?=$customerRows[1]?></td>
          <td><?=$customerRows[2]?></td>
          <td><?=$customerRows[3]?></td>
        </tr>
    </table>
    <table class="table mt-5 table-bordered">
        <tr class="table-danger">
          <td>등급명</td>
          <td>결제일</td>
          <td>시작일</td>
          <td>종료일</td>
          <td>개월수</td>
          <td>결제금액</td>
          <td>회차</td>
        </tr>
        <?php
        for ($i=0; $i < count($gradeArray); $i++) {?>
          <tr>
            <td>
              <?php if($gradeArray[$i]['gradename']==='feefree'){
                echo "무료";
              } else {
                echo $gradeArray[$i]['gradename'];
              }
              ?>
            </td>
            <td><?=$gradeArray[$i]['executivedate']?></td>
            <td><?=$gradeArray[$i]['startdate']?></td>
            <td><?=$gradeArray[$i]['enddate']?></td>
            <td><?=$gradeArray[$i]['formonth'].'개월'?></td>
            <td><?=number_format($gradeArray[$i]['payamount']).'원'?></td>
            <td><?=$gradeArray[$i]['ordered'].'회차'?></td>
          </tr>
        <?php
        }
         ?>
    </table>

  </div>
</section>


<?php require('view/footer.php');?>
