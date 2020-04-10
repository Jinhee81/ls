<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
// print_r($_POST);

$currentDate = date('Y-m-d');

if($_POST['dateDiv']==='pExpectedDate'){
  $dateDiv = 'pExpectedDate';
}

$etcDate = "";

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$_POST['fromDate']}' and '{$_POST['toDate']}')";
} elseif($_POST['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$_POST['toDate']}')";
}

if($_POST['group']==='all'){
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
      realContract_id as rid,
      realContract.building_id as rbid,
      building.bName as bname,
      realContract.group_in_building_id as gid,
      group_in_building.gName as gname,
      realContract.r_g_in_building_id as roomid,
      r_g_in_building.rName as roomname,
      realContract.customer_id as cid,
      customer.div2,
      customer.name as ccname,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      customer.div3,
      customer.div4,
      customer.div5,
      customer.companyname,
      customer.cNumber1,
      customer.cNumber2,
      customer.cNumber3,
      customer.add1,
      customer.add2,
      customer.add3,
      customer.email,
      idpaySchedule2,
      paySchedule2.monthCount,
      paySchedule2.pStartDate,
      paySchedule2.pEndDate,
      paySchedule2.pAmount,
      paySchedule2.pvAmount,
      paySchedule2.ptAmount,
      paySchedule2.pExpectedDate,
      paySchedule2.payKind,
      paySchedule2.taxSelect,
      paySchedule2.taxDate,
      TIMESTAMPDIFF(day, pExpectedDate, curdate()) as delaycount
  from
      paySchedule2
  left join realContract
      on paySchedule2.realContract_id = realContract.id
  left join customer
      on realContract.customer_id = customer.id
  left join building
      on realContract.building_id = building.id
  left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
  left join r_g_in_building
      on realContract.r_g_in_building_id = r_g_in_building.id
  where paySchedule2.user_id={$_SESSION['id']} and
        realContract.building_id = {$_POST['building']} and
        paySchedule2.executiveDate is null
        $groupCondi $etcCondi $etcDate
  order by
        pExpectedDate asc
  ";
// echo $sql;

$result = mysqli_query($conn, $sql);
// $total_rows = mysqli_num_rows($result);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

for ($i=0; $i < count($allRows); $i++) {
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
    $allRows[$i]['cname'] = $allRows[$i]['ccname'].'('.$allRows[$i]['companyname'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['ccname'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['cname'] = $allRows[$i]['ccname'];
  }

  $allRows[$i]['cnamemb'] = mb_substr($allRows[$i]['cname'],0,5,"utf-8");

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

  $allRows[$i]['cnamecontact'] = $allRows[$i]['cname'] .','. $allRows[$i]['contact'];

  $allRows[$i]['companynumber'] = $allRows[$i]['cNumber1'].'-'.$allRows[$i]['cNumber2'].'-'.$allRows[$i]['cNumber3'];

  $allRows[$i]['address'] = $allRows[$i]['add1'].', '.$allRows[$i]['add2'].' '.$allRows[$i]['add3'];


  if($allRows[$i]['delaycount'] < 0){
    $allRows[$i]['delaycount'] = 0;
    $allRows[$i]['delayinterest'] = 0; //연체일수가 0일이어서 이자없음
  } elseif($allRows[$i]['delaycount'] >= 0) {
    $allRows[$i]['delayinterest'] = $allRows[$i]['pAmount'] * ($allRows[$i]['delaycount'] / 365) * 0.27; //연체일수 생기니 이자 생
  }

  $allRows[$i]['pAmount'] = number_format($allRows[$i]['pAmount']);
  $allRows[$i]['pvAmount'] = number_format($allRows[$i]['pvAmount']);
  $allRows[$i]['ptAmount'] = number_format($allRows[$i]['ptAmount']);
  $allRows[$i]['delayinterest'] = number_format($allRows[$i]['delayinterest']);

  $allRows[$i]['cnamecontactmb'] = mb_substr($allRows[$i]['cnamecontact'],0,5,"utf-8");

  if($allRows[$i]['taxSelect']===null){
    $allRows[$i]['taxSelect'] = '';
  }

  if($allRows[$i]['taxDate']===null){
    $allRows[$i]['taxDate'] = '';
  }
} //for문closing

// print_r($allRows);

echo json_encode($allRows);
?>
