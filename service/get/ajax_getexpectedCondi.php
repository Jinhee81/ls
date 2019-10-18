<?php

$currentDate = date('Y-m-d');

if($_POST['dateDiv']==='pExpectedDate'){
  $dateDiv = 'pExpectedDate';
}
$etcDate = "";
$toDate1 = strtotime($_POST['toDate']);
$toDate2 = date('Y-m-d', $toDate1);
$toDate3 = date('Y-m-d', strtotime($toDate2.'+1 days'));

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and ($dateDiv >= '{$_POST['fromDate']}' and $dateDiv <= '{$toDate3}')";
} elseif($_POST['fromDate']){
  $etcDate = " and ($dateDiv >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and ($dateDiv <= '{$toDate3}')";
}

if($_POST['select2']==='all'){
  $groupCondi = "";
} else {
  $groupCondi = " and (realContract.group_in_building_id = {$_POST['select2']})";
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
      @num := @num + 1 as num,
      realContract_id,
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
      customer.div3,
      customer.companyname,
      idpaySchedule2,
      paySchedule2.monthCount,
      paySchedule2.pStartDate,
      paySchedule2.pEndDate,
      paySchedule2.pAmount,
      paySchedule2.pvAmount,
      paySchedule2.ptAmount,
      paySchedule2.pExpectedDate,
      paySchedule2.payKind
  from
      (select @num:=0)a,
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
        realContract.building_id = {$_POST['select1']} and
        paySchedule2.executiveDate is null
        $groupCondi $etcCondi $etcDate
  order by
        num desc
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
    $allRows[$i]['cname'] = $allRows[$i]['name'].'('.$allRows[$i]['companyname'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['name'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['cname'] = $allRows[$i]['name'];
  }

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

} //for문closing

// print_r($allRows);
?>
