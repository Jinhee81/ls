<!-- count2, enddate2 컬럼이 원래 없었다가 생긴거여서 이것을 추가하는 프로세스파일, 프로세스 폴더 자체가 개발자만 사용하려고 만든거이다. -->
<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

$sql = "select
          idpaySchedule2, pAmount, pvAmount, ptAmount, getAmount
        from paySchedule2
        where user_id=11
        ";
// echo $sql;

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}
//


for ($i=0; $i < count($allRows); $i++) {
  $allRows[$i]['pAmount'] = number_format($allRows[$i]['pAmount']);
  $allRows[$i]['pvAmount'] = number_format($allRows[$i]['pvAmount']);
  $allRows[$i]['ptAmount'] = number_format($allRows[$i]['ptAmount']);
  $allRows[$i]['getAmount'] = number_format($allRows[$i]['getAmount']);
}

// print_r($allRows);
//
for ($i=0; $i < count($allRows); $i++) {
  $sql_update = "
      update paySchedule2
        set
          pAmount = '{$allRows[$i]['pAmount']}',
          pvAmount = '{$allRows[$i]['pvAmount']}',
          ptAmount = '{$allRows[$i]['ptAmount']}',
          getAmount = '{$allRows[$i]['getAmount']}'
        WHERE
          idpaySchedule2 = {$allRows[$i]['idpaySchedule2']}
      ";
  echo $sql_update;

  $result_update = mysqli_query($conn, $sql_update);

  if(!$result_update){
    echo "<script>alert('error');</script>";
    error_log(mysqli_error($conn));
    exit();
  }
}

echo "<script>alert('수정하였습니다.');
      </script>";

?>
