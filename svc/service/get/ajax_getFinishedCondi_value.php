<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include "ajax_getfinishedCondi_sql.php";


// $result1 = mysqli_query($conn, $sql1);
// // $total_rows = mysqli_num_rows($result);
// $allRows1 = array();
// while($row = mysqli_fetch_array($result)){
//   $allRows1[]=$row;
// }
//
// for ($i=0; $i < count($allRows1); $i++) {
//   if($allRows1[$i]['div3']==='주식회사'){
//     $allRows1[$i]['cdiv3'] = '(주)';
//   } elseif($allRows1[$i]['div3']==='유한회사'){
//     $allRows1[$i]['cdiv3'] = '(유)';
//   } elseif($allRows1[$i]['div3']==='합자회사'){
//     $allRows1[$i]['cdiv3'] = '(합)';
//   } elseif($allRows1[$i]['div3']==='기타'){
//     $allRows1[$i]['cdiv3'] = '(기타)';
//   }
//
//   $allRows1[$i]['companynumber'] = $allRows1[$i]['cNumber1'].'-'.$allRows1[$i]['cNumber2'].'-'.$allRows1[$i]['cNumber3'];
//
//   if($allRows1[$i]['div2']==='개인사업자'){
//     $allRows1[$i]['cname'] = $allRows1[$i]['name'].'('.$allRows1[$i]['companyname'].','.$allRows1[$i]['companynumber'].')';
//   } else if($allRows1[$i]['div2']==='법인사업자'){
//     $allRows1[$i]['cname'] = $allRows1[$i]['cdiv3'].$allRows1[$i]['companyname'].'('.$allRows1[$i]['name'].','.$allRows1[$i]['companynumber'].')';
//   } else if($allRows1[$i]['div2']==='개인'){
//     $allRows1[$i]['cname'] = $allRows1[$i]['name'];
//   }
//
//   $allRows1[$i]['cnamemb'] = mb_substr($allRows1[$i]['cname'],0,7);
//
//   $allRows1[$i]['contact'] = $allRows1[$i]['contact1'].'-'.$allRows1[$i]['contact2'].'-'.$allRows1[$i]['contact3'];
//
//
//
//   $allRows1[$i]['address'] = $allRows1[$i]['add1'].','.$allRows1[$i]['add2'].''.$allRows1[$i]['add3'];
//
//   if($allRows1[$i]['div4']===null){
//     $allRows1[$i]['div4'] = '';
//   }
//
//   if($allRows1[$i]['div5']===null){
//     $allRows1[$i]['div5'] = '';
//   }
//
//   $allRows1[$i]['pAmount'] = number_format($allRows1[$i]['pAmount']);
//   $allRows1[$i]['pvAmount'] = number_format($allRows1[$i]['pvAmount']);
//   $allRows1[$i]['ptAmount'] = number_format($allRows1[$i]['ptAmount']);
//
// } //for문closing
//
// print_r($allRows1);
//
// echo json_encode($allRows1);
//
//
// print_r($amountTotalArray);
?>
