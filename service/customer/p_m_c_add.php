<?php //고객생성 파일
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$fil = array(
  'qDate' => mysqli_real_escape_string($conn, $_POST['qDate']),
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'etc' => mysqli_real_escape_string($conn, $_POST['etc']),
  'companyname' => mysqli_real_escape_string($conn, $_POST['companyname']),
  'contact1' => mysqli_real_escape_string($conn, $_POST['contact1']),
  'contact2' => mysqli_real_escape_string($conn, $_POST['contact2']),
  'contact3' => mysqli_real_escape_string($conn, $_POST['contact3']),
  'cNumber1' => mysqli_real_escape_string($conn, $_POST['cNumber1']),
  'cNumber2' => mysqli_real_escape_string($conn, $_POST['cNumber2']),
  'cNumber3' => mysqli_real_escape_string($conn, $_POST['cNumber3']),
  'add1' => mysqli_real_escape_string($conn, $_POST['add1']),
  'add2' => mysqli_real_escape_string($conn, $_POST['add2']),
  'add3' => mysqli_real_escape_string($conn, $_POST['add3'])
);

// print_r($fil);
if ($_POST['div1'] != '문의'){
  $addCheck1 = "
    select count(*) from customer
    where
      user_id={$_SESSION['id']} and name = '{$fil['name']}'
      ";
  // echo $addCheck1;
  $result_addCheck1 = mysqli_query($conn, $addCheck1);
  $row_addCheck1 = mysqli_fetch_array($result_addCheck1);

  if((int)$row_addCheck1[0]>1){
    echo "<script>alert('중복된 이름이 존재합니다. 중복된 이름은 저장이 안돼요.');
          location.href = 'm_c_add.php';</script>";
    exit();
  }
}


$addCheck2 = "
  select count(*) from customer
  where
    user_id={$_SESSION['id']} and
    contact1 = '{$fil['contact1']}' and
    contact2 = '{$fil['contact2']}' and
    contact3 = '{$fil['contact3']}'
    ";
// echo $addCheck2;
$result_addCheck2 = mysqli_query($conn, $addCheck2);
$row_addCheck2 = mysqli_fetch_array($result_addCheck2);

if((int)$row_addCheck2[0]>0){
  echo "<script>alert('중복된 연락처가 존재합니다. 중복된 연락처는 저장이 안돼요.');
        location.href = 'm_c_add.php';</script>";
  exit();
}

$sql = "
  INSERT INTO customer (
    div1, qDate, div2, name, contact1, contact2, contact3,
    gender, email, div3, div4, div5, companyname, cNumber1, cNumber2, cNumber3, zipcode, add1, add2, add3, etc, created, createPerson, user_id
    ) VALUES (
    '{$_POST['div1']}', '{$fil['qDate']}', '{$_POST['div2']}', '{$fil['name']}', '{$fil['contact1']}', '{$fil['contact2']}', '{$fil['contact3']}', '{$_POST['gender']}', '{$fil['email']}', '{$_POST['div3']}', '{$_POST['div4']}', '{$_POST['div5']}', '{$fil['companyname']}',
    '{$fil['cNumber1']}', '{$fil['cNumber2']}','{$fil['cNumber3']}', '{$_POST['zipcode']}', '{$fil['add1']}','{$fil['add2']}', '{$fil['add3']}', '{$fil['etc']}', now(), {$_SESSION['id']}, {$_SESSION['id']}
    )
";

echo $sql;
$result = mysqli_query($conn, $sql);
if($result){
  echo "<script>alert('저장되었습니다.');
  location.href = 'customer.php';
  </script>";
} else {
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
  location.href = 'customer.php';
  </script>";
  error_log(mysqli_error($conn));
}
?>
