<?php
$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman");
$conn2 = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql = "select
            r_idx, user_name, mobile, gender,
            email, com_type, com_name, com_num, com_kind, com_kind2,
            gate_num, memo, com_name2, birthday,
            zipcode, addr, addr2
        from tbl_user
        where c_idx=45";

// echo $sql."<br>";

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

$allRows2 = array();
for ($i=0; $i < count($allRows); $i++) {

  $sql2 = "select
              tbl_contract.idx,
              tbl_contract.u_idx,
              tbl_user.user_name,
              tbl_contract.b_idx,
              tbl_build.aliasName,
              tbl_contract.g_idx,
              tbl_rgroup.g_name,
              tbl_contract.r_idx,
              tbl_room.roomname,
              tbl_contract.c_idx,
              tbl_customer.user_name,
              tbl_contract.c_date,
              tbl_contract.period,
              tbl_contract.s_date,
              tbl_contract.e_date,
              tbl_contract.supply,
              tbl_contract.tax,
              tbl_contract.total_price,
              tbl_contract.r_date,
              tbl_contract.m_date,
              tbl_contract.de_in,
              tbl_contract.de_in_date,
              tbl_contract.de_out,
              tbl_contract.de_out_date,
              tbl_contract.de_bal,
              tbl_contract.ordernum
           from tbl_contract
           left join tbl_customer
                on tbl_contract.c_idx = tbl_customer.c_idx
           left join tbl_user
                on tbl_contract.u_idx = tbl_user.r_idx
           left join tbl_build
                on tbl_contract.b_idx = tbl_build.idx
           left join tbl_rgroup
                on tbl_contract.g_idx = tbl_rgroup.idx
           left join tbl_room
                on tbl_contract.r_idx = tbl_room.idx
           where tbl_contract.u_idx={$allRows[$i]['r_idx']}
                 and tbl_contract.c_idx=45
           ";

  // echo $sql2;

  $result2 = mysqli_query($conn, $sql2);


  while($row2 = mysqli_fetch_array($result2)){
    $allRows2[] = $row2;
  }

}

$allRows3 = array();

for ($i=0; $i < count($allRows2); $i++) {
  $sql3 = "select id from customer where old_idx={$allRows2[$i]['u_idx']}";
  $result3 = mysqli_query($conn2, $sql3);
  $row3 = mysqli_fetch_array($result3);

  $allRows2[$i]['newCustomerId'] = $row3[0];

  $sql4 = "select id, group_in_building_id
           from r_g_in_building
           where
              rName={$allRows2[$i]['roomname']} and group_in_building_id>=39";
  $result4 = mysqli_query($conn2, $sql4);
  $row4 = mysqli_fetch_array($result4);

  $allRows2[$i]['roomId'] = $row4['id'];
  $allRows2[$i]['groupId'] = $row4['group_in_building_id'];

  // if((int)$row4[0]>1){
  //   array_push($allRows3, $allRows2[$i]['roomname']);
  // }
}

// print_r($allRows2);

$errorArray1 = array();//계약에러저장
$errorArray2 = array();//contractSchedule error save
$errorArray3 = array();//deposit error save

for ($i=0; $i < count($allRows2); $i++) {
  $contractDate = date("Y-n-j", strtotime($allRows2[$i]['c_date']));
  $startDate = date("Y-n-j", strtotime($allRows2[$i]['s_date']));
  $endDate = date("Y-n-j", strtotime($allRows2[$i]['e_date']));
  $mAmount = number_format($allRows2[$i]['supply']);
  $mvAmount = number_format($allRows2[$i]['tax']);
  $mtAmount = number_format($allRows2[$i]['total_price']);

  $sql = "insert into realContract
          (building_id, group_in_building_id, r_g_in_building_id, customer_id, payOrder, monthCount, startDate, endDate, contractDate,
          mAmount, mvAmount, mtAmount,
          user_id, createTime, count2, endDate2, old_idx1, old_idx2)
          VALUES (
          00000000028,
          {$allRows2[$i]['groupId']},
          {$allRows2[$i]['roomId']},
          {$allRows2[$i]['newCustomerId']},
          '선납',
          {$allRows2[$i]['period']},
          '{$startDate}',
          '{$endDate}',
          '{$contractDate}',
          '{$mAmount}',
          '{$mvAmount}',
          '{$mtAmount}',
          00000028,
          now(),
          {$allRows2[$i]['period']},
          '{$endDate}',
          {$allRows2[$i]['idx']},
          {$allRows2[$i]['ordernum']}
          )";
      // echo $sql;

      $result = mysqli_query($conn2, $sql);

      if(!$result){
        array_push($errorArray1, $allRows2[$i]['ordernum']." 데이터 저장과정에 문제가 생겼습니다.");
      }

      $id = mysqli_insert_id($conn2); //방금넣은 계약번호아이디를 가져오는거

      $mStartDate = $startDate; //초기시작일 가져오기

      for ($j=1; $j <= (int)$allRows2[$i]['period']; $j++) {
        $allRows2[$i]['contractSchedule'][$j] = array();

        $mEndDate = date("Y-n-j", strtotime($mStartDate."+1 month"."-1 day"));

        $mExpectedDate = $mStartDate;

        array_push($allRows2[$i]['contractSchedule'][$j], $j, $mStartDate, $mEndDate, $mAmount, $mvAmount, $mtAmount, $mExpectedDate);

        $mStartDate = date("Y-n-j", strtotime($mEndDate."+1 day"));
      } //for j end

      // print_r($contractRow);


      for ($k=1; $k <= (int)$allRows2[$i]['period']; $k++) {
        $sqlk = "
              INSERT INTO contractSchedule (
                ordered, mStartDate, mEndDate, mMamount, mVmAmount, mTmAmount,
                mExpectedDate, realContract_id, user_id)
              VALUES (
                {$allRows2[$i]['contractSchedule'][$k][0]},
                '{$allRows2[$i]['contractSchedule'][$k][1]}',
                '{$allRows2[$i]['contractSchedule'][$k][2]}',
                '{$allRows2[$i]['contractSchedule'][$k][3]}',
                '{$allRows2[$i]['contractSchedule'][$k][4]}',
                '{$allRows2[$i]['contractSchedule'][$k][5]}',
                '{$allRows2[$i]['contractSchedule'][$k][6]}',
                {$id}, 00000028
              )";
        // echo $sqlk;
        $resultk = mysqli_query($conn2, $sqlk);
        // echo $sql2;

        if(!$resultk){
          array_push($errorArray2, $allRows2[$i]['ordernum']." 데이터 스케쥴 저장과정에 문제가 생겼습니다.");
        }
      }//for k end

      $depositInDate = date("Y-n-j", strtotime($allRows2[$i]['de_in_date']));
      $depositInMoney = number_format($allRows2[$i]['de_in']);
      $depositOutDate = date("Y-n-j", strtotime($allRows2[$i]['de_out_date']));
      $depositOutMoney = number_format($allRows2[$i]['de_out']);
      $depositRemainMoney = number_format($allRows2[$i]['de_bal']);

      $sql_deposit = "
          insert into realContract_deposit
          (inDate, inMoney, outDate, outMoney, remainMoney, saved, realContract_id, user_id)
          VALUES
          (
          '{$depositInDate}',
          '{$depositInMoney}',
          '{$depositOutDate}',
          '{$depositOutMoney}',
          '{$depositRemainMoney}',
          now(),
          $id, 00000028)";
      // echo $sql_deposit;

      $result_deposit = mysqli_query($conn2, $sql_deposit);

      if($result_deposit===false){
        array_push($errorArray3, $allRows2[$i]['ordernum']." 데이터 보증금 저장과정에 문제가 생겼습니다.");
      }
}

print_r($errorArray1)."<br>";
print_r($errorArray2)."<br>";
print_r($errorArray3)."<br>";


 ?>
