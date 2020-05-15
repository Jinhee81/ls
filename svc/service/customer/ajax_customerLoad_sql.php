<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

parse_str($_POST['form'], $a);

// print_r($a);

// echo 111;

if($a['dateDiv']==='registerDate'){
  $dateDiv = 'created';
} elseif($a['dateDiv']==='updateDate'){
  $dateDiv = 'updated';
}

$etcDate = "";

if($a['fromDate'] && $a['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$a['fromDate']}' and '{$a['toDate']}')";
} elseif($a['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$a['fromDate']}')";
} elseif($a['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$a['toDate']}')";
}

$div1 = "";
if($a['customerDiv']==='customerAll'){
  $div1 = "";
} else {
  $div1 = " and div1 = '{$a['customerDiv']}'";
}

$etcCondi = "";
if($a['cText']){
  if($a['etcCondi']==='customer'){
    $etcCondi = " and (name like '%".$a['cText']."%' or companyname like '%".$a['cText']."%')";
  } elseif($a['etcCondi']==='contact'){
    $etcCondi = " and (contact1 like '%".$a['cText']."%' or contact2 like '%".$a['cText']."%' or contact3 like '%".$a['cText']."%')";
  } elseif($a['etcCondi']==='email'){
    $etcCondi = " and (email like '%".$a['cText']."%')";
  } elseif($a['etcCondi']==='etc'){
    $etcCondi = " and (etc like '%".$a['cText']."%')";
  }
}

$sql_count = "select count(*) from customer
        where user_id={$_SESSION['id']}
              and building_id={$a['building']}
              $etcDate $div1 $etcCondi";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_array($result_count);

if($_POST['getPage']=='1'){
  $start = 0;
} else {
  $start = ((int)$_POST['getPage']-1) * (int)$_POST['pagerow'];
}


$sql = "select
          @num := @num + 1 as num,
          id, div1, div2, name, div3, companyname, cNumber1, cNumber2, cNumber3, contact1, contact2, contact3, email, etc, created, updated
        from
          (select @num := 0)a,
          customer
        where user_id={$_SESSION['id']} and building_id={$a['building']}
              $etcDate $div1 $etcCondi
        order by num desc
        LIMIT {$start}, {$_POST['pagerow']}";

?>
