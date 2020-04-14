<?php //고객생성 파일
session_start();

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
header("Content-Type: text/html; charset=UTF-8");
// ini_set('max_input_vars', 50000); 이거 암만해도 안되서 일단 포기함
// phpinfo();
// print_r($_POST);
// print_r($_SESSION);

for ($i=0; $i < count($_POST)/12; $i++) {
  $customerRow[$i]=array();
} //$customerRow 라는 배열을 만듦

$a = array();
foreach ($_POST as $key => $value) {
  array_push($a, $key);
}
// print_r($a);

for ($i=0; $i < count($_POST); $i++) {
  if($i < 12){
    array_push($customerRow[0], $_POST[$a[$i]]);
  } else {
    array_push($customerRow[floor($i/12)], $_POST[$a[$i]]);
  }
}

for ($i=0; $i < count($customerRow); $i++) {
  $customerRow[$i][3] = explode('-', $customerRow[$i][3]);
  $customerRow[$i][10] = explode('-', $customerRow[$i][10]);
}

print_r($customerRow);

for ($i=0; $i < count($customerRow); $i++) {

  $addCheck1 = "
    select count(*) from customer
    where
      user_id={$_SESSION['id']} and name = '{$customerRow[2]}'
      ";
  // echo $addCheck1;
  $result_addCheck1 = mysqli_query($conn, $addCheck1);
  $row_addCheck1 = mysqli_fetch_array($result_addCheck1);

  if((int)$row_addCheck1[0] >= 1){
    echo "<script>alert('중복된 이름이 존재합니다. 중복된 이름은 저장이 안돼요.');
          location.href = 'm_c_add_csv1.php';</script>";
    exit();
  }


  $addCheck2 = "
    select count(*) from customer
    where
      user_id={$_SESSION['id']} and
      contact1 = '{$customerRow[3][0]}' and
      contact2 = '{$customerRow[3][1]}' and
      contact3 = '{$customerRow[3][2]}'
      ";
  // echo $addCheck2;
  $result_addCheck2 = mysqli_query($conn, $addCheck2);
  $row_addCheck2 = mysqli_fetch_array($result_addCheck2);

  if((int)$row_addCheck2[0] >= 1){
    echo "<script>alert('중복된 연락처가 존재합니다. 중복된 연락처는 저장이 안돼요.');
          location.href = 'm_c_add.php_csv1';</script>";
    exit();
  }

  $sql = "
    INSERT INTO
      customer
      (div1, div2, name, contact1, contact2, contact3,
      gender, email, div3, div4, div5, companyname, cNumber1, cNumber2, cNumber3, etc, created, createPerson, user_id)
      VALUES
      ('{$customerRow[$i][0]}',
      '{$customerRow[$i][1]}',
      '{$customerRow[$i][2]}',
      '{$customerRow[$i][3][0]}',
      '{$customerRow[$i][3][1]}',
      '{$customerRow[$i][3][2]}',
      '{$customerRow[$i][4]}',
      '{$customerRow[$i][5]}',
      '{$customerRow[$i][6]}',
      '{$customerRow[$i][7]}',
      '{$customerRow[$i][8]}',
      '{$customerRow[$i][9]}',
      '{$customerRow[$i][10][0]}',
      '{$customerRow[$i][10][1]}',
      '{$customerRow[$i][10][2]}',
      '{$customerRow[$i][11]}',
      now(), {$_SESSION['id']}, {$_SESSION['id']}
      )
  ";

  // echo $sql;

  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
    location.href = 'customer.php';
    </script>";
    error_log(mysqli_error($conn));
  }
}

echo "<script>alert('저장되었습니다.');
location.href = 'customer.php';
</script>";


?>
