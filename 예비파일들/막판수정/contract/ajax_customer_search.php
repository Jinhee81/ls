<!-- 펑션해보고 난리쳤는데 안되서 여기에다가 둠 ㅠㅠ 도대체 뭐가 잘못된거지? -->
<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

if(isset($_POST['query'])){

  $sql = "
    select
      id, div2, name, div3, companyname, contact1, contact2, contact3, cNumber1, cNumber2, cNumber3
    from customer
    where
      user_id={$_SESSION['id']} and
      div1='입주자' and
      (regexp_like(name, '{$_POST['query']}') or
       regexp_like(companyname, '{$_POST['query']}'))
    ";

    // echo $sql;

    $result = mysqli_query($conn, $sql);

    $clist = array();

    while($row = mysqli_fetch_array($result)){
      $clist['id'] = htmlspecialchars($row['id']);
      $clist['div2'] = htmlspecialchars($row['div2']);
      $clist['contact1'] = htmlspecialchars($row['contact1']);
      $clist['contact2'] = htmlspecialchars($row['contact2']);
      $clist['contact3'] = htmlspecialchars($row['contact3']);
      $clist['name'] = htmlspecialchars($row['name']);
      $clist['companyname'] = htmlspecialchars($row['companyname']);
      $clist['cNumber1'] = htmlspecialchars($row['cNumber1']);
      $clist['cNumber2'] = htmlspecialchars($row['cNumber2']);
      $clist['cNumber3'] = htmlspecialchars($row['cNumber3']);

      // print_r($clist);

      $clist['cNumber'] = $clist['cNumber1'].'-'.$clist['cNumber2'].'-'.$clist['cNumber3'];
      $clist['cContact'] = $clist['contact1'].'-'.$clist['contact2'].'-'.$clist['contact3'];

      if($row['div3']==='주식회사'){
        $clist['cdiv3'] = '(주)';
      } elseif($row['div3']==='유한회사'){
        $clist['cdiv3'] = '(유)';
      } elseif($row['div3']==='합자회사'){
        $clist['cdiv3'] = '(합)';
      } elseif($row['div3']==='기타'){
        $clist['cdiv3'] = '(기타)';
      }

      if($clist['div2']==='개인사업자'){
        $clist['ccname'] = $clist['name'].'('.$clist['companyname'].';'.$clist['cNumber'].')';
      } else if($clist['div2']==='법인사업자'){
        $clist['ccname'] = $cDiv3.$clist['companyname'].'('.$clist['name'].';'.$clist['cNumber'].')';
      } else if($clist['div2']==='개인'){
        $clist['ccname'] = $clist['name'];
      }
    }
  }


  echo json_encode($clist);

  // print_r($clist);

 ?>
