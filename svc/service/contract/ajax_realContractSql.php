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
} elseif($_POST['progress']==='clear'){
  $etcIng = " and (select count(*) from paySchedule2 where realContract_id=realContract.id)=0";
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
      count2,
      (select count(*) from paySchedule2 where realContract_id=rid) as stepped
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


?>
