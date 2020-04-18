<?php
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
    $etcCondi = " and (customer.contact1 like '%".$_POST['cText']."%' or customer.contact2 like '%".$_POST['cText']."%' or customer.contact3 like '%".$_POST['cText']."%')";
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

?>
