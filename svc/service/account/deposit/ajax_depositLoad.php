<?php

include "ajax_depositCondi.php";//조회조건파일

$currentDate = date('Y-m-d');
// echo $currentDate;

// for ($i=0; $i < count($allRows); $i++) {
//   if($allRows[$i]['div3']==='주식회사'){
//     $allRows[$i]['cdiv3'] = '(주)';
//   } elseif($allRows[$i]['div3']==='유한회사'){
//     $allRows[$i]['cdiv3'] = '(유)';
//   } elseif($allRows[$i]['div3']==='합자회사'){
//     $allRows[$i]['cdiv3'] = '(합)';
//   } elseif($allRows[$i]['div3']==='기타'){
//     $allRows[$i]['cdiv3'] = '(기타)';
//   }
//
//   if($allRows[$i]['div2']==='개인사업자'){
//     $allRows[$i]['cname'] = $allRows[$i]['name'].'('.$allRows[$i]['companyname'].')';
//   } else if($allRows[$i]['div2']==='법인사업자'){
//     $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['name'].')';
//   } else if($allRows[$i]['div2']==='개인'){
//     $allRows[$i]['cname'] = $allRows[$i]['name'];
//   }
//
//   $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];
//
//
//   $sql_getOrder = "select count(*) from contractSchedule where realContract_id={$allRows[$i][1]}";
//   $result_getOrder = mysqli_query($conn, $sql_getOrder);
//   $row_getOrder = mysqli_fetch_array($result_getOrder);
//
//   $sql_getEnd = "select mEndDate from contractSchedule where realContract_id={$allRows[$i][1]} and ordered={$row_getOrder[0]}";
//   $result_getEnd = mysqli_query($conn, $sql_getEnd);
//   $allRows[$i]['row_getend'] = mysqli_fetch_array($result_getEnd);
//   // echo $row_getEnd;
//
//   // if($currentDate >= $allRows[$i]['startDate'] && $currentDate <= $allRows[$i]['row_getend'][0]){
//   //   $allRows[$i]['status'] = '<div class="badge badge-info text-wrap" style="width: 3rem;">진행</div>';
//   // } elseif ($currentDate < $allRows[$i]['startDate']) {
//   //   $allRows[$i]['status'] = '<div class="badge badge-warning text-wrap" style="width: 3rem;">대기</div>';
//   // } elseif ($currentDate > $allRows[$i]['row_getend'][0]) {
//   //   $allRows[$i]['status'] = '<div class="badge badge-danger text-wrap" style="width: 3rem;">종료</div>';
//   // }
//
//
// } //for문closing

// print_r($allRows);
?>
