<?php

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
      paySchedule2.taxDate
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

$amountTotalArray = [0,0,0];

for ($i=0; $i < count($allRows); $i++) {
  $amountTotalArray[0] += str_replace(",", "", $allRows[$i]['pAmount']);
  $amountTotalArray[1] += str_replace(",", "", $allRows[$i]['pvAmount']);
  $amountTotalArray[2] += str_replace(",", "", $allRows[$i]['ptAmount']);
}
?>
