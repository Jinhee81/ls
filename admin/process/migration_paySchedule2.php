<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");
$conn2 = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman");
//메인으로 쓰는 커넥트변수를 컨으로 하고 서브로 쓰는걸 컨투로 했음. 여기선 서브가 올드디비여서 이거가 컨투임(매우중요, 앞으로도 완전 조심할것)

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql = "select id from realContract where user_id=28";
$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

// print_r($allRows);

$error = array();
$error2 = array();
$error3 = array();
$error4 = array();
$allRows2 = array();



for ($i=0; $i < count($allRows); $i++) {
  $sql2 = "select count(*) from contractSchedule
           where user_id=28 and realContract_id={$allRows[$i]['id']}
          ";
  $result2 = mysqli_query($conn, $sql2);

  if(!$result2){
    array_push($error, $allRows[$i]['id']);
  } else {
    $row2 = mysqli_fetch_array($result2);

    // $allRows[$i]['id'] = array();
    // array_push($allRows[$i]['id'], $row2[0]);
    $allRows[$i]['count'] = $row2[0];

    $sql3 = "select * from contractSchedule
             where
                user_id=28 and realContract_id={$allRows[$i]['id']}";
    // echo $sql3;
    $result3 = mysqli_query($conn, $sql3);
    if(!$result3){
      array_push($error2, $allRows[$i]['id']);
    } else {
      $allRows[$i]['countArray'] = array();
      while($row3 = mysqli_fetch_array($result3)){
        array_push($allRows[$i]['countArray'], $row3);
      }
    }//if result3 }
  }//if result2 }
}//for i }

for ($i=0; $i < count($allRows); $i++) {
  $callnumArray = array();
  for ($j=0; $j < (int)$allRows[$i]['count']; $j++) {
    if($allRows[$i]['countArray'][$j]['old_idx2']){
      array_push($callnumArray, $allRows[$i]['countArray'][$j]['old_idx2']);
    }
  }
  $a = array_keys(array_count_values($callnumArray));
  // $allRows[$i]['callnum'] = array();
  // array_push($allRows[$i]['callnum'], $a);
  $allRows[$i]['callnum'] = $a;
}

for ($i=0; $i < count($allRows); $i++) {
  if($allRows[$i]['callnum']){
    for ($j=0; $j < count($allRows[$i]['callnum']); $j++) {
      $sql4 = "select
                  b_date, income_type, r_date, r_price
               from tbl_contract_sub
               where callnum = '{$allRows[$i]['callnum'][$j]}'
               order by ordernum asc
               limit 1
               ";
      // echo $sql4;
      $result4 = mysqli_query($conn2, $sql4);

      if($result4){
        $row4 = mysqli_fetch_array($result4);
        $allRows[$i]['callnum2'][$j] = array();

        array_push($allRows[$i]['callnum2'][$j], $row4);
      } else {
        array_push($error3, $allRows[$i]['id']);
      }

    }
  }
}



// for ($i=0; $i < count($allRows); $i++) {
for ($i=0; $i < 1; $i++) {
  // echo $allRows[$i]['id'];echo "<br>";
  // echo count($allRows[$i]['callnum']);echo "<br>";

  if($allRows[$i]['callnum']){
    for ($j=0; $j < count($allRows[$i]['callnum']); $j++) {
      $mMamount = 0;
      $mVmAmount = 0;
      $mTmAmount = 0;
      // print_r($allRows[$i]['count']);

      $sql5 = "select r_date, r_price
               from tbl_contract_sub
               where callnum='{$allRows[$i]['callnum'][$j]}'
                     order by ordernum
                     limit 1";
      $result5 = mysqli_query($conn2, $sql5);
      $row5 = mysqli_fetch_array($result5);

      if($row5['r_date']){
        if((int)$allRows[$i]['countArray'][$k]['old_idx2']===$allRows[$i]['callnum'][$j]){

          // print_r((int)$allRows[$i]['countArray'][$k]['old_idx2']); echo "..."; print_r($allRows[$i]['callnum'][$j]); echo "<br>";

          for ($k=0; $k < (int)$allRows[$i]['count']; $k++) {
            $mMamount += str_replace(',', '', $allRows[$i]['countArray'][$k]['mMamount']);
            $mVmAmount += str_replace(',', '', $allRows[$i]['countArray'][$k]['mVmAmount']);
            $mTmAmount += str_replace(',', '', $allRows[$i]['countArray'][$k]['mTmAmount']);

            // print_r($mMamount);echo "<br>";
          }


        }
      }


      $allRows[$i]['callnum3'][$j] = array();

      $sql5 = "select r_price
               from tbl_contract_sub
               where callnum='{$allRows[$i]['callnum'][$j]}'
                     order by ordernum
                     limit 1";
      $result5 = mysqli_query($conn2, $sql5);
      $row5 = mysqli_fetch_array($result5);

      print_r($mTmAmount); echo "..."; print_r((int)$row5[0]); echo "<br>";

      if($mTmAmount != (int)$row5[0]){
        array_push($error4, $allRows[$i]['callnum'][$j]);
      }
      array_push($allRows[$i]['callnum3'][$j], $mMamount);
      array_push($allRows[$i]['callnum3'][$j], $mVmAmount);
      array_push($allRows[$i]['callnum3'][$j], $mTmAmount);
    }
  }
}

echo "count(*)error : ";print_r($error);echo "<br><br>";
echo "contractSchedule select error : ";print_r(count($error2));echo "<br><br>";
echo "tbl_contract_sub select error : ";print_r(count($error3));echo "<br><br>";
echo "mtmAmount select error : ";print_r(count($error4));echo "<br><br>";
// print_r($error2);
// print_r($allRows[4]);

for ($i=0; $i < count($allRows); $i++) {
  if((int)$allRows[$i]['id']===2387){
    print_r($allRows[$i]);
  }
}
// var_dump($allRows[1]['callnum']);


?>
