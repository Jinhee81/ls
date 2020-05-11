<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$a = array();

foreach ($_POST as $key => $value) {
  array_push($a, mysqli_real_escape_string($conn, $value));
}

for ($i=0; $i < count($a)/11; $i++) {
  $contractRow[$i]=array();
} //$contractRow 라는 배열을 만듦

for ($i=0; $i < count($a); $i++) {
  if($i < 11){
    array_push($contractRow[0], $a[$i]);
  } elseif($i >= 11) {
    array_push($contractRow[floor($i/11)], $a[$i]);
  }
}

print_r($contractRow);

for ($i=0; $i < count($contractRow); $i++) {
  $sql1 = "
    select id, pay
    from building
    where bName='{$contractRow[$i][0]}' and
          user_id={$_SESSION['id']}";
  $result1 = mysqli_query($conn, $sql1);

  if(!$result1){
    echo "<script>alert('".$contractRow[$i][0]."물건이 존재하지 않습니다. 환경설정의 물건명을 확인해주세요.');
    history.back();</script>";
    error_log(mysqli_error($conn));
    exit();
  }
  $row1 = mysqli_fetch_array($result1);

  $sql2 = "
    select id
    from group_in_building
    where gName='{$contractRow[$i][1]}' and
          building_id = {$row1['id']}";
  $result2 = mysqli_query($conn, $sql2);

  if(!$result2){
    echo "<script>alert('".$contractRow[$i][1]."그룹이 존재하지 않습니다. 환경설정의 그룹명을 확인해주세요.');
    history.back();</script>";
    error_log(mysqli_error($conn));
    exit();
  }
  $row2 = mysqli_fetch_array($result2);

  $sql3 = "
    select id
    from r_g_in_building
    where rName='{$contractRow[$i][2]}' and
          group_in_building_id={$row2['id']}";
  $result3 = mysqli_query($conn, $sql3);

  if(!$result3){
    echo "<script>alert('".$contractRow[$i][2]."관리번호가 존재하지 않습니다. 환경설정의 물건의 관리번호를 확인해주세요.');
    history.back();</script>";
    error_log(mysqli_error($conn));
    exit();
  }
  $row3 = mysqli_fetch_array($result3);

  $sql4 = "
    select id
    from customer
    where name='{$contractRow[$i][3]}' and
          building_id = {$row1['id']} and
          user_id={$_SESSION['id']}";
  $result4 = mysqli_query($conn, $sql4);

  if(!$result4){
    echo "<script>alert('".$contractRow[$i][3]."입주자가 존재하지 않습니다. 관계자목록에서 입주자 이름을 확인해주세요.');
    history.back();</script>";
    error_log(mysqli_error($conn));
    exit();
  }
  $row4 = mysqli_fetch_array($result4);

  $contractDate = date("Y-n-j", strtotime($contractRow[$i][4]));
  $startDate = date("Y-n-j", strtotime($contractRow[$i][8]));
  $endDate = date("Y-n-j", strtotime($startDate."+".$contractRow[$i][7]." month"."-1 day"));
  $mAmount = number_format($contractRow[$i][5]);
  $mvAmount = number_format($contractRow[$i][6]);
  $mtAmount = number_format((int)$contractRow[$i][5]+(int)$contractRow[$i][6]);

  $sql = "insert into realContract
          (building_id, group_in_building_id, r_g_in_building_id, customer_id, payOrder, monthCount, startDate, endDate, contractDate,
          mAmount, mvAmount, mtAmount,
          user_id, createTime, count2, endDate2)
          VALUES
          ({$row1['id']},
          {$row2['id']},
          {$row3['id']},
          {$row4['id']},
          '{$row1['pay']}',
          {$contractRow[$i][7]},
          '{$startDate}',
          '{$endDate}',
          '{$contractDate}',
          '{$mAmount}',
          '{$mvAmount}',
          '{$mtAmount}',
          {$_SESSION['id']},
          now(),
          {$contractRow[$i][7]},
          '{$endDate}'
          )";
  echo $sql;

  // $result = mysqli_query($conn, $sql);

  // if(!$result){
  //   $row = $i+1;
  //   echo "<script>alert('".$row."행".$contractRow[$i][3]." 데이터의 저장과정에 문제가 생겼습니다. 다시 확인해주세요.(1)');
  //         history.go(-2);
  //         </script>";
  //   error_log(mysqli_error($conn));
  //   exit();
  // }

  // $id = mysqli_insert_id($conn); //방금넣은 계약번호아이디를 가져오는거
  //
  // $mStartDate = $startDate; //초기시작일 가져오기
  //
  // for ($j=1; $j <= (int)$contractRow[$i][7]; $j++) {
  //   $contractRow[$i][$j] = array();
  //
  //   $mEndDate = date("Y-n-j", strtotime($startDate."+1 month"."-1 day"));
  //
  //   if($row1['pay']==='선납'){
  //     $mExpectedDate = $mStartDate;
  //   } else if($row1['pay']==='후납'){
  //     $mExpectedDate = $mEndDate;
  //   }
  //
  //   array_push($contractRow[$i][$j], $j, $mStartDate, $mEndDate, $mAmount, $mvAmount, $mtAmount, $mExpectedDate);
  //
  //   $mStartDate = date("Y-n-j", strtotime($mEndDate."+1 day"));
  // } //for j end
  //
  //
  // for ($k=1; $k <= (int)$contractRow[$i][7]; $k++) {
  //   $sqlk = "
  //         INSERT INTO contractSchedule (
  //           ordered, mStartDate, mEndDate, mMamount, mVmAmount, mTmAmount,
  //           mExpectedDate, realContract_id)
  //         VALUES (
  //           {$contractRow[$i][$j][0]},
  //           '{$contractRow[$i][$j][1]}',
  //           '{$contractRow[$i][$j][2]}',
  //           '{$contractRow[$i][$j][3]}',
  //           '{$contractRow[$i][$j][4]}',
  //           '{$contractRow[$i][$j][5]}',
  //           '{$contractRow[$i][$j][6]}',
  //           {$id}
  //         )";
  //   echo $sqlk;
  //   $resultk = mysqli_query($conn, $sqlk);
  //   // echo $sql2;
  //
  //   if($resultk===false){
  //     echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
  //           history.back();
  //           </script>";
  //     error_log(mysqli_error($conn));
  //     exit();
  //   }
  // }//for k end
  //
  // for ($m=0; $m < count($contractRow); $m++) {
  //   $depositInDate = date("Y-n-j", strtotime($contractRow[$m][10]));
  //   $deposintMoney = number_format($contractRow[$m][9]);
  //
  //   $sql_deposit = "
  //       insert into realContract_deposit
  //       (inDate, inMoney, remainMoney, saved, realContract_id)
  //       VALUES
  //       (
  //       '{$depositInDate}',
  //       '{$deposintMoney}',
  //       '{$deposintMoney}',
  //       now(),
  //       $id)";
  //   echo $sql_deposit;
  //
  //   $result_deposit = mysqli_query($conn, $sql_deposit);
  //
  //   if($result_deposit===false){
  //     // echo "<script>alert('보증금 저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
  //     //       </script>";
  //     echo "<script>alert('보증금 저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(3).');
  //           history.back();
  //           </script>";
  //     error_log(mysqli_error($conn));
  //     exit();
  //   }
  // }//for m end

}//for i end

// echo "<script>alert('계약을 저장하였습니다.');
//       location.href = 'contract.php';
//       </script>";


 ?>
