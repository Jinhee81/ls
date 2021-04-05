<?php

//paySchedule migration진행, 아 떨린다 ㅠㅠ

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman");
$conn2 = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql1 = "select idx
         from tbl_contract
         where c_idx=45 and idx<=4089";

// echo $sql1;
$result1 = mysqli_query($conn, $sql1);

$allRows = array();

while($row1 = mysqli_fetch_array($result1)){
  $allRows[] = $row1;
}

for ($i=0; $i < count($allRows); $i++) {
  $sql2 = "select
              idx,
              c_idx, ordernum, s_date, e_date,
              supply, tax, cost, total_price,
              income_type, callnum
           from tbl_contract_sub
           where c_idx={$allRows[$i]['idx']}
           order by ordernum asc
           ";
  $result2 = mysqli_query($conn, $sql2);

  $allRows[$i]['idx'] = array();

  while($row2 = mysqli_fetch_array($result2)){
    array_push($allRows[$i]['idx'], $row2);
  }

  $sql3 = "select id
           from realContract
           where user_id=28 and
                 old_idx1={$allRows[$i][0]}
           ";
  // echo $sql3;
  $result3 = mysqli_query($conn2, $sql3);
  $row3 = mysqli_fetch_array($result3);

  $allRows[$i]['realContract_id'] = $row3[0];
}


// echo count($allRows);
// print_r($allRows);

$error = array();
$error2 = array();
$error3 = array();
$allRows2 = array();


for ($i=0; $i < count($allRows); $i++) {

  // print_r($allRows[$i]);
  $sql4 = "select count(*)
           from contractSchedule
           where user_id=28 and
                 realContract_id={$allRows[$i]['realContract_id']}
  ";
  // echo $sql4;
  $result4 = mysqli_query($conn2, $sql4);

  if(!$result4){
    array_push($error, $allRows[$i][0]);//거짓이면 에러를 보냄
  } else {
    $row4 = mysqli_fetch_array($result4);
    $allRows[$i]['count'] = $row4[0];
    array_push($allRows2, $allRows[$i]);//참이면 예전계약이랑 개수비교
    // $allRows2 = $row4[0];

    $sql5 = "select count(*) from tbl_contract_sub
             where c_idx={$allRows[$i][0]}
    ";
    $result5 = mysqli_query($conn, $sql5);

    if(!$result5){
      array_push($error2, $allRows[$i][0]);
    }
  }

}

// print_r($error);
// echo "<br><br>";
print_r($allRows2);
// echo "<br><br>";
// print_r($error2);
//
for ($i=0; $i < count($allRows2); $i++) {
  for ($j=0; $j < (int)$allRows2[$i]['count']; $j++) {
    $k = $j+1;
    $supply = number_format($allRows2[$i]['idx'][$j]['supply']);
    $tax = number_format($allRows2[$i]['idx'][$j]['tax']);
    $total_price = number_format($allRows2[$i]['idx'][$j]['total_price']);
    $sql6 = "update contractSchedule set
                mMamount = '{$supply}',
                mVmAmount = '{$tax}',
                mTmAmount = '{$total_price}',
                old_idx = {$allRows2[$i]['idx'][$j]['idx']},
                old_idx2 = '{$allRows2[$i]['idx'][$j]['callnum']}'
             where
                realContract_id = {$allRows2[$i]['realContract_id']} and
                ordered = {$k}
             ";
    // echo $sql6;
    $result6 = mysqli_query($conn2, $sql6);
    if(!$result6){
      array_push($error3, $allRows2[$i]['realContract_id']);
    }
  }

}

print_r($error3);




?>
