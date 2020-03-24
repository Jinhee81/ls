<?php
$currentDate = date('Y-m-d');
// echo $currentDate;

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//계약번호
settype($filtered_id, 'integer');

$sql = "
      select
          realContract.id,
          customer.id,
          customer.name,
          customer.companyname,
          customer.div2,
          customer.div3,
          customer.contact1,
          customer.contact2,
          customer.contact3,
          customer.etc,
          building_id,
          (select bName from building where id=building_id),
          group_in_building_id,
          (select gName from group_in_building where id=group_in_building_id),
          r_g_in_building_id,
          (select rName from r_g_in_building where id=r_g_in_building_id),
          payOrder,
          monthCount,
          startDate,
          endDate,
          contractDate,
          mAmount,
          mvAmount,
          mtAmount,
          count2,
          endDate2,
          realContract.createTime,
          realContract.updateTime
      from
          realContract
      left join customer
          on realContract.customer_id = customer.id
      where realContract.id = {$filtered_id} and
            realContract.user_id = {$_SESSION['id']}
";
// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($result->num_rows === 0) {
  echo "<script>
          alert('세션에 포함된 계약이 아니어서 조회 불가합니다.');
          location.href = 'contract.php';
        </script>";
  error_log(mysqli_error($conn));
}

// print_r($row);
// print_r($_SESSION);

$cContact = $row['contact1'].'-'.$row['contact2'].'-'.$row['contact3'];

if($row['div3']==='주식회사'){
  $cDiv3 = '(주)';
} elseif($row['div3']==='유한회사'){
  $cDiv3 = '(유)';
} elseif($row['div3']==='합자회사'){
  $cDiv3 = '(합)';
} elseif($row['div3']==='기타'){
  $cDiv3 = '(기타)';
}

if($row['div2']==='개인사업자'){
  $cName = $row['name'].'('.$row['companyname'].')';
} else if($row['div2']==='법인사업자'){
  $cName = $cDiv3.$row['companyname'].'('.$row['name'].')';
} else if($row['div2']==='개인'){
  $cName = $row['name'];
}


$original_period = [$row['monthCount'], $row['startDate'], $row['endDate']];
$edited_period = [$row['count2'], $row['startDate'], $row['endDate2']];

// print_r($edited_period);
// print_r($original_period);

$difference = count(array_diff_assoc($edited_period, $original_period));

$currentDate = date('Y-m-d');
// echo $currentDate;
if($currentDate >= $row['startDate'] && $currentDate <= $row['endDate2']){
  $status = '현재';
} elseif ($currentDate < $row['startDate']) {
  $status = '대기';
} elseif ($currentDate > $edited_period[2]) {
  $status = '종료';
}
// print_r($status);

$sql_step = "select count(*) from paySchedule2 where realContract_id={$filtered_id}";
$result_step = mysqli_query($conn, $sql_step);
$row_step = mysqli_fetch_array($result_step);

if((int)$row_step[0]===0){
  $step = "clear";
} else {
  $sql_step2 = "select getAmount from paySchedule2 where realContract_id={$filtered_id}";
  // echo $sql_step2;
  $result_step2 = mysqli_query($conn, $sql_step2);
  $getAmount = 0;
  while($row_step2 = mysqli_fetch_array($result_step2)){
    $getAmount = $getAmount + (int)$row_step2[0];
  }

  if($getAmount > 0) {
    $step = "입금";
  } else {
    $step = "청구";
  }
}

$sql_deposit = "
      select
            *
      from realContract_deposit where realContract_id={$filtered_id}";
// echo $sql_deposit;
$result_deposit = mysqli_query($conn, $sql_deposit);
$row_deposit = mysqli_fetch_array($result_deposit);

$sql_file = "
    select
      @num := @num + 1 as num,
      file_id,
      name_orig,
      size,
      reg_time
    FROM
      (select @num := 0)a,
      upload_file
    WHERE
      realContract_id = {$filtered_id}
    ORDER BY
      reg_time asc";
// echo $sql_file;
$result_file = mysqli_query($conn, $sql_file);

$fileRows = array();
while($row_file = mysqli_fetch_array($result_file)){
  $fileRows[]=$row_file;
}

for ($i=0; $i < count($fileRows); $i++) {
  if($fileRows[$i]['size'] >= 1073741824){
    $fileRows[$i]['bytes'] = number_format($fileRows[$i]['size'] / 1073741824, 2) . ' GB';
  } elseif($fileRows[$i]['size'] >= 1048576){
    $fileRows[$i]['bytes'] = number_format($fileRows[$i]['size'] / 1048576, 2) . ' MB';
  } elseif($fileRows[$i]['size'] >= 1024){
    $fileRows[$i]['bytes'] = number_format($fileRows[$i]['size'] / 1024, 2) . ' KB';
  } elseif($fileRows[$i]['size'] >= 1){
    $fileRows[$i]['bytes'] = number_format($fileRows[$i]['size']).' bytes';
  }
}

$sql_memoS = "select
                @num := @num + 1 as num,
                idrealContract_memo,
                memoCreator,
                memoContent,
                created,
                updated
              from
                (select @num :=0)a,
                realContract_memo
              where realContract_id={$filtered_id}
              order by
                num asc";
// echo $sql_memoS;
$result_memoS = mysqli_query($conn, $sql_memoS);

$memoRows = array();
while($row_memoS=mysqli_fetch_array($result_memoS)) {
  $memoRows[] = $row_memoS;
}

$sql2 = "
        SELECT * FROM contractSchedule WHERE realContract_id = {$filtered_id}
        ";
// echo $sql2;
$result2 = mysqli_query($conn, $sql2);

$allRows = array();
while($row2 = mysqli_fetch_array($result2)){
  $allRows[] = $row2;

  if($allRows[$i]['payId']){

    for ($i=0; $i < count($allRows); $i++) {
      $sql3 = "
              Select
                  pExpectedDate,
                  ptAmount,
                  payKind,
                  executiveDate,
                  getAmount
              from paySchedule2
              where
                  idpaySchedule2={$allRows[$i]['payId']}";
      // echo $sql3;
      $result3 = mysqli_query($conn, $sql3);

      $allRows[$i]['paySchedule2'] = array();
      while($row3 = mysqli_fetch_array($result3)){
        $allRows[$i]['paySchedule2'][] = $row3;
      }

    }
  }
}

// print_r($allRows);
 ?>
