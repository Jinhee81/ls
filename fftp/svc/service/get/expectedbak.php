<?php

error_reporting(E_ALL);

ini_set("display_errors", 1);

// print_r($_POST);

// $currentDate = date('Y-m-d');이걸 왜 넣었을까? 필요가 없음

if($_POST['dateDiv']==='executiveDate') $dateDiv = 'paySchedule2.executiveDate';
else if($_POST['dateDiv']==='taxDate') $dateDiv = 'taxDate';


$etcDate = "";

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$_POST['fromDate']}' and '{$_POST['toDate']}')";
} elseif($_POST['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$_POST['toDate']}')";
}

$taxCondi = "";
if($_POST['taxDiv']==='alltax'){
  $taxCondi = "";
} elseif ($_POST['taxDiv']==='taxYes') {
  $taxCondi = " and (paySchedule2.pvAmount > 0)";
} elseif ($_POST['taxDiv']==='taxNone') {
  $taxCondi = " and (paySchedule2.pvAmount = 0)";
}

$payCondi = "";
if($_POST['payKind']==='payall'){
  $payCondi = "";
} elseif ($_POST['payKind']==='계좌') {
  $payCondi = " and (paySchedule2.payKind='계좌')";
} elseif ($_POST['payKind']==='현금') {
  $payCondi = " and (paySchedule2.payKind='현금')";
} elseif ($_POST['payKind']==='카드') {
  $payCondi = " and (paySchedule2.payKind='카드')";
}



$etcCondi1 = "";//방계약에서만 사용하는 조건문
$etcCondi2 = "";//기타계약에서만 사용하는 조건문, 둘다사용하는이유가 그래야지 union이안됨
if($_POST['cText']){
  if($_POST['etcCondi']==='customer'){
    $etcCondi1 = " and (customer.name like '%".$_POST['cText']."%' or customer.companyname like '%".$_POST['cText']."%')";
    $etcCondi2 = " and (customer.name like '%".$_POST['cText']."%' or customer.companyname like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contact'){
    $etcCondi1 = " and (contact1 like '%".$_POST['cText']."%' or contact2 like '%".$_POST['cText']."%' or contact3 like '%".$_POST['cText']."%')";
    $etcCondi2 = " and (contact1 like '%".$_POST['cText']."%' or contact2 like '%".$_POST['cText']."%' or contact3 like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='gName'){
    $etcCondi1 = " and group_in_building.gName like '%".$_POST['cText']."%'";
    $etcCondi2 = " and good_in_building.name like '%".$_POST['cText']."%'";
  } elseif($_POST['etcCondi']==='rName'){
    $etcCondi1 = " and r_g_in_building.rName like '%".$_POST['cText']."%'";
    $etcCondi2 = " and good_in_building.name like '%".$_POST['cText']."%'";
  } elseif($_POST['etcCondi']==='goodName'){
    $etcCondi1 = " and group_in_building.gName like '%".$_POST['cText']."%'";
    $etcCondi2 = " and good_in_building.name like '%".$_POST['cText']."%'";
  }
}


$sql = "
(select
    @roomdiv as roomdiv,
    paySchedule2.realContract_id,
    realContract.building_id,
    building.bName,
    realContract.group_in_building_id,
    group_in_building.gName,
    realContract.r_g_in_building_id,
    r_g_in_building.rName,
    realContract.customer_id,
    customer.div2,
    customer.name,
    customer.contact1,
    customer.contact2,
    customer.contact3,
    customer.email,
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
    idpaySchedule2,
    invoicerMgtKey,
    paySchedule2.monthCount,
    paySchedule2.pStartDate,
    paySchedule2.pEndDate,
    paySchedule2.pAmount,
    paySchedule2.pvAmount,
    paySchedule2.ptAmount,
    paySchedule2.pExpectedDate,
    paySchedule2.payKind,
    paySchedule2.executiveDate,
    paySchedule2.getAmount,
    paySchedule2.taxSelect,
    paySchedule2.taxDate
from
    (select @roomdiv:='방계약')a,
    paySchedule2
join realContract
    on paySchedule2.realContract_id = realContract.id
join customer
    on realContract.customer_id = customer.id
join building
    on realContract.building_id = building.id
join group_in_building
    on realContract.group_in_building_id = group_in_building.id
join r_g_in_building
    on realContract.r_g_in_building_id = r_g_in_building.id
where paySchedule2.user_id={$_SESSION['id']} and
      realContract.building_id = {$_POST['building']} and
      paySchedule2.executiveDate is not null
      $etcDate $taxCondi $payCondi $etcCondi1)
union
(select
    @gooddiv as gooddiv,
    paySchedule2.etcContract_id,
    etcContract.building_id,
    building.bName,
    etcContract.good_in_building_id,
    good_in_building.name,
    etcContract.good_in_building_id,
    good_in_building.name,
    etcContract.customer_id,
    customer.div2,
    customer.name,
    customer.contact1,
    customer.contact2,
    customer.contact3,
    customer.email,
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
    idpaySchedule2,
    invoicerMgtKey,
    paySchedule2.monthCount,
    paySchedule2.pStartDate,
    paySchedule2.pEndDate,
    paySchedule2.pAmount,
    paySchedule2.pvAmount,
    paySchedule2.ptAmount,
    paySchedule2.pExpectedDate,
    paySchedule2.payKind,
    paySchedule2.executiveDate,
    paySchedule2.getAmount,
    paySchedule2.taxSelect,
    paySchedule2.taxDate
from
    (select @gooddiv:='기타계약')a,
    paySchedule2
join etcContract
    on paySchedule2.etcContract_id = etcContract.id
join customer
    on etcContract.customer_id = customer.id
join building
    on etcContract.building_id = building.id
join good_in_building
    on etcContract.good_in_building_id = good_in_building.id
where paySchedule2.user_id={$_SESSION['id']} and
      etcContract.building_id = {$_POST['building']} and
      paySchedule2.executiveDate is not null
      $etcDate $taxCondi $payCondi $etcCondi2)
order by roomdiv desc, executiveDate desc
";
// echo $sql;
mysqli_set_charset($conn,"utf8");
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
    $allRows[$i]['cname'] = $allRows[$i]['name'].'('.$allRows[$i]['companyname'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['name'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['cname'] = $allRows[$i]['name'];
  }

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

  $allRows[$i]['companynumber'] = $allRows[$i]['cNumber1'].'-'.$allRows[$i]['cNumber2'].'-'.$allRows[$i]['cNumber3'];

  $allRows[$i]['address'] = $allRows[$i]['add1'].'-'.$allRows[$i]['add2'].'-'.$allRows[$i]['add3'];

} //for문closing

// print_r($allRows);

$amountTotalArray = array(0,0,0);

for ($i=0; $i < count($allRows); $i++) {
  $amountTotalArray[0] += str_replace(",", "", $allRows[$i]['pAmount']);
  $amountTotalArray[1] += str_replace(",", "", $allRows[$i]['pvAmount']);
  $amountTotalArray[2] += str_replace(",", "", $allRows[$i]['ptAmount']);
}


// print_r($amountTotalArray);
?>
