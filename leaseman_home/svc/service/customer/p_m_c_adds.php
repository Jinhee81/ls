<?php //고객 여러명 생성 파일도 좀 바뀜
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$a = array();

foreach ($_POST as $key => $value) {
  if($key != 'div1'){
    array_push($a, mysqli_real_escape_string($conn, $value));
  }
}

// print_r($a);

for ($i=0; $i < count($a)/7; $i++) {
  $customerRow[$i]=[];
} //$customerRow 라는 배열을 만듦

for ($i=0; $i < count($a); $i++) {
  if($i < 7){
    array_push($customerRow[0], $a[$i]);
  } elseif($i >= 7) {
    array_push($customerRow[floor($i/7)], $a[$i]);
  }
}

for ($i=0; $i < count($customerRow); $i++) {
  $customerRow[$i][1] = explode("-", $customerRow[$i][1]);
  $customerRow[$i][4] = explode("-", $customerRow[$i][4]);
}

// print_r($customerRow);

for ($i=0; $i < count($customerRow); $i++) {

  $addCheck1 = "
        select count(*) from customer
        where
          user_id={$_SESSION['id']} and
          name = '{$customerRow[$i][0]}'
          ";
  // echo $addCheck1;
  $result_addCheck1 = mysqli_query($conn, $addCheck1);
  $row_addCheck1 = mysqli_fetch_array($result_addCheck1);

  if((int)$row_addCheck1[0]>0){
    echo "<script>alert('".$customerRow[$i][0]."는(은) 이미 존재합니다. 중복된 성명은 저장 불가합니다.');
          history.back();</script>";
    exit();
  }

  $addCheck2 = "
    select count(*) from customer
    where
      user_id={$_SESSION['id']} and
      contact1 = '{$customerRow[$i][1][0]}' and
      contact2 = '{$customerRow[$i][1][1]}' and
      contact3 = '{$customerRow[$i][1][2]}'
      ";
  // echo $addCheck2;
  $result_addCheck2 = mysqli_query($conn, $addCheck2);
  $row_addCheck2 = mysqli_fetch_array($result_addCheck2);

  if((int)$row_addCheck2[0]>0){
      echo "<script>alert('".$customerRow[$i][1][0].$customerRow[$i][1][2].$customerRow[$i][1][2]."연락처는 이미 존재합니다. 중복된 연락처는 저장 불가합니다.');
            history.back();</script>";
      exit();
  }

  if($customerRow[$i][2]){
    $div2 = '법인사업자';
  } else {
    if($customerRow[$i][3]){
      $div2 = '개인사업자';
    } else {
      $div2 = '개인';
    }
  }


  $sql = "
      INSERT INTO customer
        (div1, div2, name, contact1, contact2, contact3, div3, companyname, cNumber1, cNumber2, cNumber3, email, etc, created, user_id)
      VALUES
        ('{$_POST['div1']}',
         '{$div2}',
         '{$customerRow[$i][0]}',
         '{$customerRow[$i][1][0]}',
         '{$customerRow[$i][1][1]}',
         '{$customerRow[$i][1][2]}',
         '{$customerRow[$i][2]}',
         '{$customerRow[$i][3]}',
         '{$customerRow[$i][4][0]}',
         '{$customerRow[$i][4][1]}',
         '{$customerRow[$i][4][2]}',
         '{$customerRow[$i][5]}',
         '{$customerRow[$i][6]}',
         now(),
         {$_SESSION['id']}
        )";

  // echo $sql;

  $result = mysqli_query($conn, $sql);
  if($result){
    echo "<script>alert('저장되었습니다.');
    location.href = 'customer.php';
    </script>";
  } else {
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
    history.back();
    </script>";
    error_log(mysqli_error($conn));
  }


} //for closing }


?>
