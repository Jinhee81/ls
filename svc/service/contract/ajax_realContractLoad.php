<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_SESSION);
// print_r($_POST);
// echo '111';

$currentDate = date('Y-m-d');

if($_POST['dateDiv']==='startDate'){
  $dateDiv = 'startDate';
} elseif($_POST['dateDiv']==='endDate'){
  $dateDiv = 'endDate2';
} elseif($_POST['dateDiv']==='contractDate'){
  $dateDiv = 'contractDate';
} elseif($_POST['dateDiv']==='registerDate'){
  $dateDiv = 'createTime';
}

$etcDate = "";

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$_POST['fromDate']}' and '{$_POST['toDate']}')";
} elseif($_POST['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$_POST['toDate']}')";
}

if($_POST['progress']==='pIng'){
  $etcIng = " and getStatus(startDate, endDate2) = 'present'";
} elseif($_POST['progress']==='pWaiting'){
  $etcIng = " and getStatus(startDate, endDate2) = 'waiting'";
} elseif($_POST['progress']==='pEnd'){
  $etcIng = " and getStatus(startDate, endDate2) = 'the_end'";
} elseif($_POST['progress']==='pAll'){
  $etcIng = "";
}

if($_POST['group']==='groupAll'){
  $groupCondi = "";
} else {
  $groupCondi = " and (realContract.group_in_building_id = {$_POST['group']})";
}

$etcCondi = "";
if($_POST['cText']){
  if($_POST['etcCondi']==='customer'){
    $etcCondi = " and (name like '%".$_POST['cText']."%' or companyname like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contact'){
    $etcCondi = " and (contact1 like '%".$_POST['cText']."%' or contact2 like '%".$_POST['cText']."%' or contact3 like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contractId'){
    $etcCondi = " and (realContract.id like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='roomId'){
    $etcCondi = " and (r_g_in_building.rName like '%".$_POST['cText']."%')";
  }
}



$sql = "
  select
      realContract.id as rid,
      customer.id as cid,
      customer.name as cname,
      customer.companyname as ccomname,
      customer.div2,
      customer.div3,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      customer.cNumber1,
      customer.cNumber2,
      customer.cNumber3,
      customer.email,
      building.bName,
      group_in_building.gName,
      r_g_in_building.rName,
      startDate,
      endDate2,
      mAmount,
      mvAmount,
      mtAmount,
      getStatus(startDate, endDate2) as status2,
      count2
  from
      realContract
  left join customer
      on realContract.customer_id = customer.id
  left join building
      on realContract.building_id = building.id
  left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
  left join r_g_in_building
      on realContract.r_g_in_building_id = r_g_in_building.id
  where realContract.user_id = {$_SESSION['id']} and
        realContract.building_id = {$_POST['building']}
        $etcDate $etcIng $groupCondi $etcCondi
  order by
      group_in_building.id asc, r_g_in_building.id asc";
// echo $sql;
$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

for ($i=0; $i < count($allRows); $i++) {

  $allRows[$i]['cNumber'] = $allRows[$i]['cNumber1'].'-'.$allRows[$i]['cNumber2'].'-'.$allRows[$i]['cNumber3'];

  if($allRows[$i]['div3']==='주식회사'){
    $allRows[$i]['cdiv3'] = '(주)';
  } elseif($allRows[$i]['div3']==='유한회사'){
    $allRows[$i]['cdiv3'] = '(유)';
  } elseif($allRows[$i]['div3']==='합자회사'){
    $allRows[$i]['cdiv3'] = '(합)';
  } elseif($allRows[$i]['div3']==='기타'){
    $allRows[$i]['cdiv3'] = '(기타)';
  }

  if($allRows[$i]['div2']==='개인사업자'){
    $allRows[$i]['ccnn'] = $allRows[$i]['cname'].'('.$allRows[$i]['ccomname'].','.$allRows[$i]['cNumber'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['ccnn'] = $allRows[$i]['cdiv3'].$allRows[$i]['ccomname'].'('.$allRows[$i]['cname'].','.$allRows[$i]['cNumber'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['ccnn'] = $allRows[$i]['cname'];
  }

  $allRows[$i]['ccomname'] = mb_substr($allRows[$i]['cdiv3'].$allRows[$i]['ccomname'],0,10,'utf-8');

  $allRows[$i]['ccnnmb'] = mb_substr($allRows[$i]['ccnn'],0,10,'utf-8');

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

  $allRows[$i]['startDate'] = date('Y-n-j', strtotime($allRows[$i]['startDate']));
  $allRows[$i]['endDate2'] = date('Y-n-j', strtotime($allRows[$i]['endDate2']));

  $sql_step = "select idpaySchedule2 from paySchedule2 where realContract_id = {$allRows[$i]['rid']}";
  // echo $sql_step;
  $result_step = mysqli_query($conn, $sql_step);
  if ($result_step->num_rows === 0) {
    $allRows[$i]['step'] = 'clear';
  } else {
    $sql_step2 = "select getAmount from paySchedule2 where realContract_id = {$allRows[$i]['rid']}";
    // echo $sql_step2;
    $result_step2 = mysqli_query($conn, $sql_step2);
    $getAmount = 0;
    while($row_step2 = mysqli_fetch_array($result_step2)){
      $getAmount = $getAmount + (int)$row_step2[0];
    }
    // echo $getAmount;

    if($getAmount > 0) {
      $allRows[$i]['step'] = 'recieved';
    } else {
        $allRows[$i]['step'] = 'recieving';
    }
  }

  $sql_file_c = "select count(*) from upload_file where realContract_id={$allRows[$i]['rid']}";
  // echo $sql_file_c;
  $result_file_c = mysqli_query($conn, $sql_file_c);
  $row_file_c = mysqli_fetch_array($result_file_c);

  $allRows[$i]['filecount'] = (int)$row_file_c[0];


  $sql_memo_c = "select count(*) from realContract_memo where realContract_id={$allRows[$i]['rid']}";
  $result_memo_c = mysqli_query($conn, $sql_memo_c);
  $row_memo_c = mysqli_fetch_array($result_memo_c);

  $allRows[$i]['memocount'] = (int)$row_memo_c[0];


} //for문closing

// print_r($allRows);

echo json_encode($allRows);
?>
