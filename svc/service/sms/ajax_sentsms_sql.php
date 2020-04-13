<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

$currentDate = date('Y-m-d');
$dateDiv = 'sendtime';

$etcDate = "";

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$_POST['fromDate']}' and '{$_POST['toDate']}')";
} elseif($_POST['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$_POST['toDate']}')";
}

if($_POST['type']==='typeAll'){
  $typeCondi = "";
} else {
  $typeCondi = " and type = '{$_POST['type']}'";
}

$etcCondi = "";
if($_POST['cText']){
  if($_POST['etcCondi']==='customer'){
    $etcCondi = " and (customer like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contact'){
    $etcCondi = " and (phonenumber like '%".$_POST['cText']."%')";
  }
}

$sql = "select
          type, byte, sendtime, customer, phonenumber, roomNumber,
          description, sentnumber, result
        from
          sentsms
        where user_id={$_SESSION['id']}
              $typeCondi $etcCondi $etcDate
        order by
          sendtime desc
        ";

?>
