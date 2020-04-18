<!-- 조회조건에 대한 파일 -->

<?php
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

if($_POST['dateDiv']==='startDate'){
  $dateDiv = 'startDate';
} elseif($_POST['dateDiv']==='endDate'){
  $dateDiv = 'endDate';
} elseif($_POST['dateDiv']==='contractDate'){
  $dateDiv = 'contractDate';
} elseif($_POST['dateDiv']==='registerDate'){
  $dateDiv = 'createTime';
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

$sql = "
  select
      @num := @num + 1 as num,
      realContract.id,
      customer.id,
      customer.name,
      customer.companyname,
      customer.div2,
      customer.div3,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      building.bName,
      group_in_building.gName,
      r_g_in_building.rName,
      mtAmount,
      realContract_deposit.inDate,
      realContract_deposit.inMoney,
      realContract_deposit.outDate,
      realContract_deposit.outMoney,
      realContract_deposit.remainMoney
  from
      (select @num :=0)a,realContract
  left join customer
      on realContract.customer_id = customer.id
  left join realContract_deposit
      on realContract.id = realContract_deposit.realContract_id
  left join building
      on realContract.building_id = building.id
  left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
  left join r_g_in_building
      on realContract.r_g_in_building_id = r_g_in_building.id
  where realContract.user_id = {$_SESSION['id']} and
        realContract.building_id = {$_POST['select1']} and
        realContract.group_in_building_id = {$_POST['select2']}
        $etcCondi $etcDate
  order by
      num desc";
// echo $sql;
$result = mysqli_query($conn, $sql);
// $total_rows = mysqli_num_rows($result);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

// print_r($allRows);
 ?>
