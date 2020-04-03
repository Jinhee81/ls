<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

$sql = "select
          id, div1, div2, name, div3, companyname, cNumber1, cNumber2, cNumber3, contact1, contact2, contact3, email, etc, created, updated
        from customer
        where user_id={$_SESSION['id']}
        order by created desc";
// echo $sql;

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;

}


for ($i=0; $i < count($allRows); $i++) {
   $sql2 = "select count(*) from realContract where customer_id={$allRows[$i]['id']}";
   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_array($result2);


   $allRows[$i]['contractCount'] = $row2[0];

  $allRows[$i]['cNumber'] = $allRows[$i]['cNumber1'].'-'.$allRows[$i]['cNumber2'].'-'.$allRows[$i]['cNumber3'];

  $allRows[$i]['cContact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

  if($allRows[$i]['div3']==='주식회사'){
    $allRows[$i]['cdiv3'] = '(주)';
  } elseif($allRows[$i]['div3']==='유한회사'){
    $allRows[$i]['cdiv3'] = '(유)';
  } elseif($allRows[$i]['div3']==='합자회사'){
    $allRows[$i]['cdiv3'] = '(합)';
  } elseif($allRows[$i]['div3']==='기타'){
    $allRows[$i]['cdiv3'] = '(기)';
  }

  if($allRows[$i]['div2']==='개인사업자'){
    $allRows[$i]['cName'] = $allRows[$i]['name'].'('.$allRows[$i]['companyname'].','.$allRows[$i]['cNumber'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['cName'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['name'].','.$allRows[$i]['cNumber'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['cName'] = $allRows[$i]['name'];
  }


  if($allRows[$i]['div1']==='문의'){
    $allRows[$i]['cName'] = 'ㅇㅇㅇ';
  }

  if($allRows[$i]['div1']==='입주자'){
    $allRows[$i]['gothere'] = '임대계약';
  } else if($allRows[$i]['div1']==='기타'){
    $allRows[$i]['gothere'] = '기타계약';
  } else {
    $allRows[$i]['gothere'] = '';
  }

  $allRows[$i]['cNamemb'] = mb_substr($allRows[$i]['cName'],0,10);

  $allRows[$i]['email'] = mb_substr($allRows[$i]['email'],0,8);

  $allRows[$i]['etc'] = mb_substr($allRows[$i]['etc'],0,10);

  $allRows[$i]['created'] = mb_substr($allRows[$i]['created'],0,10);

  $allRows[$i]['updated'] = mb_substr($allRows[$i]['updated'],0,10);
}


echo json_encode($allRows);

// print_r($allRows);
?>
