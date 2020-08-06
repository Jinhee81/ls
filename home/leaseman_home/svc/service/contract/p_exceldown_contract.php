<?php
// include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

header("Content-Type: text/html; charset=utf-8");
session_start();

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
parse_str($_POST['formArray'], $a);

// print_r($a);

$currentDate = date('Y-m-d');

if($a['dateDiv']==='startDate'){
  $dateDiv = 'startDate';
} elseif($a['dateDiv']==='endDate'){
  $dateDiv = 'endDate2';
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

if(isset($_POST['progress'])){
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

$sql_before = "
select
    realContract.id as rid,
    customer.id as cid,
    customer.name,
    customer.companyname,
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
    realContract.group_in_building_id,
    group_in_building.gName,
    realContract.r_g_in_building_id,
    r_g_in_building.rName,
    contractDate,
    startDate,
    endDate2,
    mAmount,
    mvAmount,
    mtAmount,
    getStatus(startDate, endDate2) as status2,
    count2
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
      realContract.building_id = {$a['building']}
      $etcDate $etcIng $groupCondi $etcCondi
      $getCondi
order by
    realContract.group_in_building_id asc, realContract.r_g_in_building_id asc
";

// echo $sql_before;

$result_before = mysqli_query($conn, $sql_before);

$allRows = array();
while($row_before = mysqli_fetch_array($result_before)){
  $allRows[] = $row_before;
}

for ($i=0; $i < count($allRows); $i++){
  $sql3 = "select remainMoney from realContract_deposit where realContract_id={$allRows[$i]['rid']}";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_array($result3);

  $allRows[$i]['remainMoney'] = $row3[0];

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
    $allRows[$i]['companyname2'] = $allRows[$i]['companyname'];
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['companyname2'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'];
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['companyname2'] = $allRows[$i]['name'];
  }

  $allRows[$i]['companynumber'] = $allRows[$i]['cNumber1'].'-'.$allRows[$i]['cNumber2'].'-'.$allRows[$i]['cNumber3'];
}
 ?>

<style type="text/css">
.coltype1{background:yellow}
.coltype2{background:yellowgreen}
.coltype3{background:pink}
</style>

<table border="1">
  <thead>
    <tr>
      <td colspan="17"><h1>전체선택하여 엑셀시트에 복사하세요.</h1></td>
    </tr>
    <tr>
      <th rowspan="2" class="coltype1">순번</th>
      <th rowspan="2" class="coltype1">상태</th>
      <th rowspan="2" class="coltype1">물건명</th>
      <th rowspan="2" class="coltype1">그룹명</th>
      <th rowspan="2" class="coltype1">관리번호</th>
      <th rowspan="2" class="coltype3">사업자명</th>
      <th rowspan="2" class="coltype3">사업자번호</th>
      <th rowspan="2" class="coltype3">대표자명</th>
      <th rowspan="2" class="coltype2">계약번호</th>
      <th rowspan="2" class="coltype2">계약일</th>
      <th rowspan="2" class="coltype2">계약시작일</th>
      <th rowspan="2" class="coltype2">계약종료일</th>
      <th rowspan="2" class="coltype2">계약개월</th>
      <th colspan="3" class="coltype2">월이용료</th>
      <th rowspan="2" class="coltype2">보증금</th>
    </tr>
    <tr>
      <th class="coltype2">공급가액</th>
      <th class="coltype2">세액</th>
      <th class="coltype2">합계</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $num = count($allRows);
      for ($i=0; $i < count($allRows); $i++) {
        ?>
      <tr>
        <td><?=$num?></td><!--순번-->
        <td>
          <?php
          if($allRows[$i]['status2']==='present'){
            echo "현재";
          } elseif ($allRows[$i]['status2']==='the_end') {
            echo "종료";
          } elseif ($allRows[$i]['status2']==='waiting') {
            echo "대기";
          }
           ?>
        </td><!--상태-->
        <td><?=$allRows[$i]['bName']?></td><!--물건명-->
        <td><?=$allRows[$i]['gName']?></td><!--그룹명-->
        <td><?=$allRows[$i]['rName']?></td><!--관리번호-->
        <td><?=$allRows[$i]['companyname2']?></td><!--사업자명-->
        <td><?=$allRows[$i]['companynumber']?></td><!--사업자번호-->
        <td><?=$allRows[$i]['name']?></td><!--대표자명-->
        <td>
          <?=(int)$allRows[$i]['rid']?>
        </td><!--계약번호-->
        <td><?=$allRows[$i]['contractDate']?></td><!--계약일-->
        <td><?=$allRows[$i]['startDate']?></td><!--계약시작일-->
        <td><?=$allRows[$i]['endDate2']?></td><!--계약종료일-->
        <td><?=$allRows[$i]['count2']?></td><!--계약개월-->
        <td><?=$allRows[$i]['mAmount']?></td><!--월이용료(부가세별도)-->
        <td><?=$allRows[$i]['mvAmount']?></td><!--부가세-->
        <td><?=$allRows[$i]['mtAmount']?></td><!--월이용료(부가세포함)-->
        <td><?=$allRows[$i]['remainMoney']?></td><!--보증금-->
      </tr>
      <?php
      $num -= 1;
     }
     ?>
  </tbody>
</table>
