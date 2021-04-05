<?php
session_start();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
parse_str($_POST['form'], $a);

if($a['dateDiv']==='startDate'){
  $dateDiv = 'startDate';
} elseif($a['dateDiv']==='endDate'){
  $dateDiv = 'endDate';
} elseif($a['dateDiv']==='contractDate'){
  $dateDiv = 'contractDate';
} elseif($a['dateDiv']==='registerDate'){
  $dateDiv = 'createTime';
}

$etcDate = "";
if($a['fromDate'] && $a['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$a['fromDate']}' and '{$a['toDate']}')";
} elseif($a['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$a['fromDate']}')";
} elseif($a['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$a['toDate']}')";
}

if(isset($a['progress'])){
  $etcIng = "";
} else {
  if($a['progress']==='pIng'){
    $etcIng = " and getStatus(startDate, endDate2) = 'present'";
  } elseif($a['progress']==='pWaiting'){
    $etcIng = " and getStatus(startDate, endDate2) = 'waiting'";
  } elseif($a['progress']==='pEnd'){
    $etcIng = " and getStatus(startDate, endDate2) = 'the_end'";
  } elseif($a['progress']==='pAll'){
    $etcIng = "";
  } elseif($a['progress']==='clear'){
    $etcIng = " and (select count(*) from paySchedule2 where realContract_id=realContract.id)=0";
  }
}

if($a['group']==='groupAll'){
  $groupCondi = "";
} else {
  $groupCondi = " and (realContract.group_in_building_id = {$a['group']})";
}

$etcCondi = "";
if($a['cText']){
  if($a['etcCondi']==='customer'){
    $etcCondi = " and (name like '%".$a['cText']."%' or companyname like '%".$a['cText']."%')";
  } elseif($a['etcCondi']==='contact'){
    $etcCondi = " and (contact1 like '%".$a['cText']."%' or contact2 like '%".$a['cText']."%' or contact3 like '%".$a['cText']."%')";
  } elseif($a['etcCondi']==='contractId'){
    $etcCondi = " and (realContract.id like '%".$a['cText']."%')";
  } elseif($a['etcCondi']==='roomId'){
    $etcCondi = " and (r_g_in_building.rName like '%".$a['cText']."%')";
  }
}

$sql_count = "select count(*)
              from realContract
              where realContract.user_id = {$_SESSION['id']} and
                    realContract.building_id = {$a['building']} and
                    realContract.group_in_building_id = {$a['group']}
                    $etcCondi $etcDate
             ";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_array($result_count);

if($_POST['getPage']=='1'){
 $start = 0;
} else {
 $start = ((int)$_POST['getPage']-1) * (int)$_POST['pagerow'];
}

$firstOrder = $row_count[0] + 1;

$sql = "
  select
      @num := @num + 1 as num,
      realContract.id as rid,
      customer.id as cid,
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
        realContract.building_id = {$a['building']} and
        realContract.group_in_building_id = {$a['group']}
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
