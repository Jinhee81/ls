<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

echo $sql1;

// $result = mysqli_query($conn, $sql);
//
// print_r($result);
// $total_rows = mysqli_num_rows($result);
// $allRows = array();
// while($row = mysqli_fetch_array($result)){
//   // $allRows[]=$row;
//   print_r($row);
// }



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
//   $allRows[$i]['companynumber'] = $allRows[$i]['cNumber1'].'-'.$allRows[$i]['cNumber2'].'-'.$allRows[$i]['cNumber3'];
//
//   if($allRows[$i]['div2']==='개인사업자'){
//     $allRows[$i]['cname'] = $allRows[$i]['name'].'('.$allRows[$i]['companyname'].','.$allRows[$i]['companynumber'].')';
//   } else if($allRows[$i]['div2']==='법인사업자'){
//     $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['name'].','.$allRows[$i]['companynumber'].')';
//   } else if($allRows[$i]['div2']==='개인'){
//     $allRows[$i]['cname'] = $allRows[$i]['name'];
//   }
//
//   $allRows[$i]['cnamemb'] = mb_substr($allRows[$i]['cname'],0,7);
//
//   $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];
//
//
//
//   $allRows[$i]['address'] = $allRows[$i]['add1'].','.$allRows[$i]['add2'].''.$allRows[$i]['add3'];
//
//   if($allRows[$i]['div4']===null){
//     $allRows[$i]['div4'] = '';
//   }
//
//   if($allRows[$i]['div5']===null){
//     $allRows[$i]['div5'] = '';
//   }
//
//   $allRows[$i]['pAmount'] = number_format($allRows[$i]['pAmount']);
//   $allRows[$i]['pvAmount'] = number_format($allRows[$i]['pvAmount']);
//   $allRows[$i]['ptAmount'] = number_format($allRows[$i]['ptAmount']);
//
// } //for문closing
//
// print_r($allRows);

// echo json_encode($allRows);


// print_r($amountTotalArray);
?>
