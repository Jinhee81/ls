<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");
$conn2 = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman");
//메인으로 쓰는 커넥트변수를 컨으로 하고 서브로 쓰는걸 컨투로 했음. 여기선 서브가 올드디비여서 이거가 컨투임(매우중요, 앞으로도 완전 조심할것)

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

//이거 입력값 매우 중요함 ㅠㅠ//
$building_id = 28;
$user_id = 28;
//================


$sql = "select id from realContract where user_id={$user_id}";
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
$error5 = array();
$error6 = array();
$error7 = array();
$error8 = array();

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
                user_id=28 and realContract_id={$allRows[$i]['id']}
             order by ordered asc
            ";
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

// for ($i=0; $i < count($allRows); $i++) {
//   // if((int)$allRows[$i]['id']===2322){
//     $callnumArray = array();  //청구번호 배열
//     for ($j=0; $j < (int)$allRows[$i]['count']; $j++) {
//       if($allRows[$i]['countArray'][$j]['old_idx2']){
//         array_push($callnumArray, $allRows[$i]['countArray'][$j]['old_idx2']);
//       }
//     }
//     $a = array_keys(array_count_values($callnumArray));
//     // $allRows[$i]['callnum'] = array();
//     // array_push($allRows[$i]['callnum'], $a);
//     $allRows[$i]['callnum'] = $a;
//
//     // print_r($allRows[$i]['callnum']);echo "<br>";
//   // }
// } 내가 틀리게한거가 아니다. 그 사이에 전진욱대표님이 입력한 데이터임

for ($i=0; $i < count($allRows); $i++) {
  $callnumArray = array();  //청구번호 배열
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
        // $allRows[$i]['tbl_contract_sub'][$j] = array();
        //
        // array_push($allRows[$i]['tbl_contract_sub'][$j], $row4);
        $allRows[$i]['tbl_contract_sub'][$j][0]['b_date'] = date('Y-n-j', strtotime($row4['b_date']));
        $allRows[$i]['tbl_contract_sub'][$j][0]['income_type'] = $row4['income_type'];
        $allRows[$i]['tbl_contract_sub'][$j][0]['r_date'] = date('Y-n-j', strtotime($row4['r_date']));
        $allRows[$i]['tbl_contract_sub'][$j][0]['r_price'] = $row4['r_price'];
      } else {
        array_push($error3, $allRows[$i]['id']);
      }

    }
  }
}

for ($i=0; $i < count($allRows); $i++) {

  if($allRows[$i]['callnum']){
    for ($j=0; $j < count($allRows[$i]['callnum']); $j++) {
      $mMamount = 0;
      $mVmAmount = 0;
      $mTmAmount = 0;
      // print_r($allRows[$i]['count']);
      $allRows[$i]['csIdArray'][$j] = array();
      $allRows[$i]['orderArray'][$j] = array();

      for ($k=0; $k < (int)$allRows[$i]['count']; $k++) {

        if((int)$allRows[$i]['countArray'][$k]['old_idx2']===$allRows[$i]['callnum'][$j]){

        $mMamount += str_replace(',', '', $allRows[$i]['countArray'][$k]['mMamount']);
        $mVmAmount += str_replace(',', '', $allRows[$i]['countArray'][$k]['mVmAmount']);
        $mTmAmount += str_replace(',', '', $allRows[$i]['countArray'][$k]['mTmAmount']);

        // print_r($mMamount);echo "<br>";
        array_push($allRows[$i]['orderArray'][$j], $allRows[$i]['countArray'][$k]['ordered']);
        array_push($allRows[$i]['csIdArray'][$j], $allRows[$i]['countArray'][$k]['idcontractSchedule']);
        }

      }
      $allRows[$i]['tbl_contract_sub'][$j][0]['mMamount'] = $mMamount;
      $allRows[$i]['tbl_contract_sub'][$j][0]['mVmAmount'] = $mVmAmount;
      $allRows[$i]['tbl_contract_sub'][$j][0]['mTmAmount'] = $mTmAmount;
    }
  }
}


for ($i=0; $i < count($allRows); $i++) {
  // if((int)$allRows[$i]['id']===2396 && $allRows[$i]['orderArray']){
  if($allRows[$i]['callnum'] && $allRows[$i]['orderArray']){
    for ($j=0; $j < count($allRows[$i]['orderArray']); $j++) {
      $allRows[$i]['paySchedule2'][$j] = array();
      for ($k=0; $k < count($allRows[$i]['orderArray'][$j]); $k++) {
        if($k===0){
          $firstOrder = $allRows[$i]['orderArray'][$j][$k];
        }
        $a = count($allRows[$i]['orderArray'][$j]) - 1;
        // var_dump($a); echo "<br>";
        if($k === $a){
          $lastOrder = $allRows[$i]['orderArray'][$j][$k];
        }
      }
      // echo "firstOrder : ";var_dump($firstOrder); echo "<br>";
      // echo "lastOrder : ";var_dump($lastOrder); echo "<br>";
      for ($m=0; $m < count($allRows[$i]['countArray']); $m++) {
        if($allRows[$i]['countArray'][$m]['ordered'] === $firstOrder){
          $pStartDate = $allRows[$i]['countArray'][$m]['mStartDate'];
        }
        if($allRows[$i]['countArray'][$m]['ordered'] === $lastOrder){
          $pEndDate = $allRows[$i]['countArray'][$m]['mEndDate'];
        }
      }
      array_push($allRows[$i]['paySchedule2'][$j], $pStartDate);
      array_push($allRows[$i]['paySchedule2'][$j], $pEndDate);
      // echo "pStartDate : ";print_r($pStartDate); echo "<br>";
      // echo "pEndDate : ";print_r($pEndDate); echo "<br>";
    }
  }
}

for ($i=0; $i < count($allRows); $i++) {
// for ($i=0; $i < 10; $i++) {
  if($allRows[$i]['callnum']){
    for ($j=0; $j < count($allRows[$i]['callnum']); $j++) {
      if((int)$allRows[$i]['tbl_contract_sub'][$j][0]['r_price'] > 0){
        $r_price = (int)$allRows[$i]['tbl_contract_sub'][$j][0]['r_price'];
        $mTmAmount = $allRows[$i]['tbl_contract_sub'][$j][0]['mTmAmount'];

        // print_r($mTmAmount); echo "..."; print_r((int)$r_price);echo "..."; print_r($allRows[$i]['callnum'][$j]); echo "<br>";

        if($r_price != $mTmAmount){
          array_push($error5, $allRows[$i]['id']);
        }

        $sql5 = "select count(*)
                 from tbl_billa
                 where ordernum = '{$allRows[$i]['callnum'][$j]}'
                 ";
        $result5 = mysqli_query($conn2, $sql5);
        $row5 = mysqli_fetch_array($result5);

        if((int)$row5[0]===1){
          $sql6 = "select writeDate from tbl_billa
                   where ordernum = '{$allRows[$i]['callnum'][$j]}'";
          $result6 = mysqli_query($conn2, $sql6);
          $row6 = mysqli_fetch_array($result6);

          $taxDate = substr($row6[0],0,4).'-'.substr($row6[0],4,2).'-'.substr($row6[0],6,2);
          $taxDate = date('Y-n-j', strtotime($taxDate));

          $allRows[$i]['tbl_contract_sub'][$j][0]['taxDate'] = $taxDate;
        } elseif((int)$row5[0] > 1) {
          array_push($error6, $allRows[$i]['id']);
        }
      }
    }
  }
}

//================여기서부턴 중요한 sql문이어서 주석처리했음 =========

for ($i=0; $i < count($allRows); $i++) {
// for ($i=0; $i < 10; $i++) {
  // if((int)$allRows[$i]['id']===2396 && $allRows[$i]['callnum']){
  if($allRows[$i]['callnum']){

    for ($j=0; $j < count($allRows[$i]['callnum']); $j++) {
      $csIdArray = implode(',', $allRows[$i]['csIdArray'][$j]);
      $orderArray = implode(',', $allRows[$i]['orderArray'][$j]);
      $pStartDate = $allRows[$i]['paySchedule2'][$j][0];
      $pEndDate = $allRows[$i]['paySchedule2'][$j][1];
      $pAmount = number_format($allRows[$i]['tbl_contract_sub'][$j][0]['mMamount']);
      $pvAmount = number_format($allRows[$i]['tbl_contract_sub'][$j][0]['mVmAmount']);
      $ptAmount = number_format($allRows[$i]['tbl_contract_sub'][$j][0]['mTmAmount']);
      $pExpectedDate = $allRows[$i]['tbl_contract_sub'][$j][0]['b_date'];

      $a = $allRows[$i]['tbl_contract_sub'][$j][0]['income_type'];

      if($a === '0'){
        $payKind = '현금';
      } elseif($a === '1'){
        $payKind = '카드';
      } elseif($a === '2') {
        $payKind = '계좌';
      }


      $realContract_id = $allRows[$i]['id'];
      $monthCount = count($allRows[$i]['orderArray'][$j]);

      if((int)$allRows[$i]['tbl_contract_sub'][$j][0]['r_price'] > 0){
        $executiveDate = $allRows[$i]['tbl_contract_sub'][$j][0]['r_date'];
        $getAmount = $allRows[$i]['tbl_contract_sub'][$j][0]['r_price'];

        if($allRows[$i]['tbl_contract_sub'][$j][0]['taxDate']){
          $taxSelect = '세금계산서';
          $taxDate = $allRows[$i]['tbl_contract_sub'][$j][0]['taxDate'];
        } else {
          $taxSelect = '';
          $taxDate = '';
        }

        $sql7 = "insert into paySchedule2
                  (csIdArray, orderArray, pStartDate, pEndDate,
                   pAmount,pvAmount, ptAmount,
                   pExpectedDate, paykind, executiveDate, getAmount, realContract_id, building_id, user_id, monthCount, taxSelect, taxDate)
                 values
                  ('{$csIdArray}', '{$orderArray}', '{$pStartDate}', '{$pEndDate}',
                   '{$pAmount}','{$pvAmount}', '{$ptAmount}',
                   '{$pExpectedDate}', '{$payKind}', '{$executiveDate}', '{$getAmount}', {$realContract_id}, {$building_id}, {$user_id}, {$monthCount}, '{$taxSelect}', '{$taxDate}')
                 ";
          // echo $sql7;echo "<br>";
          $result7 = mysqli_query($conn, $sql7);

          if($result7){
            $paySid = mysqli_insert_id($conn);

            for ($k=0; $k < count($allRows[$i]['orderArray'][$j]); $k++) {
              $sql8 = "update contractSchedule
                       set
                         payId = {$paySid},
                         payIdOrder = '{$k}'
                       where
                         realContract_id={$realContract_id} and
                         ordered = {$allRows[$i]['orderArray'][$j][$k]}
                         ";
              // echo $sql8;
              $result8 = mysqli_query($conn, $sql8);

              if(!$result8){
                array_push($error8, $allRows[$i]['id']);
              }
            }
          } else {
            array_push($error7, $allRows[$i]['id']);
          }
      } else {
        $sql7 = "insert into paySchedule2
                  (csIdArray, orderArray, pStartDate, pEndDate,
                   pAmount,pvAmount, ptAmount,
                   pExpectedDate, paykind, getAmount, realContract_id, building_id, user_id, monthCount)
                 values
                  ('{$csIdArray}', '{$orderArray}', '{$pStartDate}', '{$pEndDate}',
                   '{$pAmount}','{$pvAmount}', '{$ptAmount}',
                   '{$pExpectedDate}', '{$payKind}', '0', {$realContract_id}, {$building_id}, {$user_id}, {$monthCount})
                 ";
          // echo $sql7;echo "<br>";
          $result7 = mysqli_query($conn, $sql7);
          if($result7){
            $paySid = mysqli_insert_id($conn);

            for ($k=0; $k < count($allRows[$i]['orderArray'][$j]); $k++) {
              $sql8 = "update contractSchedule
                       set
                         payId = {$paySid},
                         payIdOrder = '{$k}'
                       where
                         realContract_id={$realContract_id} and
                         ordered = {$allRows[$i]['orderArray'][$j][$k]}
                         ";
              // echo $sql8;
              $result8 = mysqli_query($conn, $sql8);

              if(!$result8){
                array_push($error8, $allRows[$i]['id']);
              }
            }
          } else {
            array_push($error7, $allRows[$i]['id']);
          }
      }
    }
  }
}
//================여기서부턴 중요한 sql문이어서 종료 =========

// print_r($allRows[0]['tbl_contract_sub']);

echo "count(*)error : ";print_r($error);echo "<br><br>";
echo "contractSchedule select error : ";print_r(count($error2));echo "<br><br>";
echo "tbl_contract_sub select error : ";print_r(count($error3));echo "<br><br>";
echo "mtmAmount select error : ";print_r(count($error4));echo "<br><br>";
echo "rprice sum error : ";print_r(count($error5));echo "<br><br>";
echo "taxdate select error : ";print_r(count($error6));echo "<br><br>";
echo "taxdate select error : ";print_r(count($error7));echo "<br><br>";
echo "taxdate select error : ";print_r(count($error8));echo "<br><br>";

// for ($i=0; $i < count($allRows); $i++) {
//   if((int)$allRows[$i]['id']===2396){
//   //   // print_r($allRows[$i]['tbl_contract_sub'][$j][0]['r_date']);
//   //   // print_r($allRows[$i]['tbl_contract_sub'][1]);
//     // echo "all<br>";
//     // print_r($allRows[$i]);echo "<br>";
//     echo "countArray<br>";
//     print_r($allRows[$i]['countArray']);echo "<br>";
//     echo "청구번호<br>";
//     print_r($allRows[$i]['callnum']);echo "<br>";
//     echo "tbl_contract_sub<br>";
//     print_r($allRows[$i]['tbl_contract_sub']);echo "<br>";
//     echo "orderArray<br>";
//     print_r($allRows[$i]['orderArray']);echo "<br>";
//     echo "csIdArray<br>";
//     print_r($allRows[$i]['csIdArray']);echo "<br>";
//     echo "paySchedule2<br>";
//     print_r($allRows[$i]['paySchedule2']);echo "<br>";
//   }
//   // print_r(count($allRows));echo "<br>";
//   // print_r($allRows);echo "<br>";
// }

?>
