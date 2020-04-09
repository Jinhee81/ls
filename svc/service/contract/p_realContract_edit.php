<!-- 이거는 계약수정할 때 처리하는 프로세스파일 -->
<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

print_r($_POST);
// print_r($_SESSION);

// $customer_id = $_POST['customer'];
$filtered_id = mysqli_real_escape_string($conn, $_POST['contract']);

date_default_timezone_set('Asia/Seoul'); //이거있어야지 시간대가 맞게설정됨, 없으면 시간대가 안맞아짐

$currentDateTime = date('Y-m-d H:i:s');
// echo $currentDateTime;

$sql = "
  UPDATE realContract
    SET
        building_id = {$_POST['building_id']},
        group_in_building_id = {$_POST['group_id']},
        r_g_in_building_id = {$_POST['room_id']},
        payOrder = '{$_POST['payOrder']}',
        monthCount = {$_POST['monthCount']},
        startDate = '{$_POST['startDate']}',
        endDate = '{$_POST['endDate1']}',
        contractDate = '{$_POST['contractDate']}',
        mAmount = '{$_POST['mAmount']}',
        mvAmount = '{$_POST['mvAmount']}',
        mtAmount = '{$_POST['mtAmount']}',
        updateTime = now(),
        updatePerson = {$_SESSION['id']}
    WHERE
      id = {$filtered_id}";

// echo $sql;
//
$result = mysqli_query($conn, $sql);

if($result){
  $sql_delete = "delete from contractSchedule where realContract_id={$filtered_id}";
  $result_delete = mysqli_query($conn, $sql_delete);
  if($result_delete){
    $mStartDate = $_POST['startDate']; //초기시작일 가져오기

    for ($i=1; $i <= (int)$_POST['monthCount']; $i++) {

        $contractRow[$i] = array();
        $mEndDate = date("Y-m-d", strtotime($mStartDate."+1 month"."-1 day"));

        if($_POST['payOrder']==='선불'){
          $mExpectedDate = $mStartDate;
        } else if($_POST['payOrder']==='후불'){
          $mExpectedDate = $mEndDate;
        }

        array_push($contractRow[$i], $i, $mStartDate, $mEndDate, $_POST['mAmount'], $_POST['mvAmount'], $_POST['mtAmount'], $mExpectedDate);
        // print_r($i);
        $mStartDate = date("Y-m-d", strtotime($mEndDate."+1 day"));
    } //for closing

    // print_r($contractRow);
    // echo 'bbbbb';

    for ($i=1; $i <= count($contractRow); $i++) {
      $sql2 = "
            INSERT INTO contractSchedule (
              ordered, mStartDate, mEndDate, mMamount, mVmAmount, mTmAmount,
              mExpectedDate, realContract_id)
            VALUES (
              {$contractRow[$i][0]},
              '{$contractRow[$i][1]}',
              '{$contractRow[$i][2]}',
              '{$contractRow[$i][3]}',
              '{$contractRow[$i][4]}',
              '{$contractRow[$i][5]}',
              '{$contractRow[$i][6]}',
              {$filtered_id}
            )
      ";
      $result2 = mysqli_query($conn, $sql2);
      // echo $sql2;

      if($result2===false){
        echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
              location.href = 'contract_add1_edit.php?id=$filtered_id';
              </script>";
        error_log(mysqli_error($conn));
        exit();
      }
    } //for closing
  } else {
  echo "<script>alert('수정과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
        location.href = 'contract_add1_edit.php?id=$filtered_id';
        </script>";
  error_log(mysqli_error($conn));
  exit();
  } //if($result_delete) closing
}//if($result, update) closing


echo "<script>alert('수정하였습니다.');
      location.href = 'contractEdit3.php?id=$filtered_id';
      </script>";

 ?>
