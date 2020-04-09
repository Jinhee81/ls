<!-- 이파일은 세입자만 찾는 파일임(계약등록에서는 세입자만 찾아야하니깐, 용어가 세입자에서 입주자로 뱌꼈음 -->
<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

if(isset($_POST['query'])){
  $output = '';
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

    $result = mysqli_query($conn, $sql);
    $output = '<ul class="list-unstyled">';

    if(mysqli_num_rows($result) > 0){
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

        $cNumber = $clist['cNumber1'].'-'.$clist['cNumber2'].'-'.$clist['cNumber3'];
        $cContact = $clist['contact1'].'-'.$clist['contact2'].'-'.$clist['contact3'];

        if($row['div3']==='주식회사'){
          $cDiv3 = '(주)';
        } elseif($row['div3']==='유한회사'){
          $cDiv3 = '(유)';
        } elseif($row['div3']==='합자회사'){
          $cDiv3 = '(합)';
        } elseif($row['div3']==='기타'){
          $cDiv3 = '(기타)';
        }

        if($clist['div2']==='개인사업자'){
          $cName = $clist['name'].'('.$clist['companyname'].';'.$cNumber.')';
        } else if($clist['div2']==='법인사업자'){
          $cName = $cDiv3.$clist['companyname'].'('.$clist['name'].';'.$cNumber.')';
        } else if($clist['div2']==='개인'){
          $cName = $clist['name'];
        }
        $output .= '<li>'.$cName.' | '.$cContact.' | '.$clist['id'].'</li>';
      }
    } else {
      $output .= '<li>검색값이 없네요. 다시 확인해보세요 ㅜㅜ</li>';
    }
  }

  $output .= '</ul>';
  echo $output;
 ?>
