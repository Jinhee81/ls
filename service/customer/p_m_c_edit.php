<?php //고객수정파일
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$fil = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),//고객아이디
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
  'postcode' => mysqli_real_escape_string($conn, $_POST['postcode']),
  'add1' => mysqli_real_escape_string($conn, $_POST['add1']),
  'add2' => mysqli_real_escape_string($conn, $_POST['add2']),
  'add3' => mysqli_real_escape_string($conn, $_POST['add3'])
);

settype($fil['id'], 'integer');

// print_r($fil);

$addCheck1 = "
  select count(*) from customer
  where
    user_id={$_SESSION['id']} and name = '{$fil['name']}' and
    id <> {$fil['id']}
    ";
// echo $addCheck1;
$result_addCheck1 = mysqli_query($conn, $addCheck1);
$row_addCheck1 = mysqli_fetch_array($result_addCheck1);

if((int)$row_addCheck1[0]>0){
  echo "<script>alert('중복된 이름이 존재합니다. 중복된 이름은 저장이 안돼요.');
        location.href = 'm_c_edit.php?id=".$fil['id']."';</script>";
  exit();
}

$addCheck2 = "
  select count(*) from customer
  where
    user_id={$_SESSION['id']} and
    contact1 = '{$fil['contact1']}' and
    contact2 = '{$fil['contact2']}' and
    contact3 = '{$fil['contact3']}' and
    id <> {$fil['id']}
    ";
// echo $addCheck2;
$result_addCheck2 = mysqli_query($conn, $addCheck2);
$row_addCheck2 = mysqli_fetch_array($result_addCheck2);

if((int)$row_addCheck2[0]>0){
  echo "<script>alert('중복된 연락처가 존재합니다. 중복된 연락처는 저장이 안돼요.');
        location.href = 'm_c_edit.php?id=".$fil['id']."';</script>";
  exit();
}

$sql = "
  UPDATE customer
  SET
    qDate = '{$fil['qDate']}',
    name = '{$fil['name']}',
    contact1 = '{$fil['contact1']}',
    contact2 = '{$fil['contact2']}',
    contact3 = '{$fil['contact3']}',
    gender = '{$_POST['gender']}',
    email = '{$fil['email']}',
    div3 = '{$_POST['div3']}',
    div4 = '{$_POST['div4']}',
    div5 = '{$_POST['div5']}',
    companyname = '{$fil['companyname']}',
    cNumber1 = '{$fil['cNumber1']}',
    cNumber2 = '{$fil['cNumber2']}',
    cNumber3 = '{$fil['cNumber3']}',
    zipcode = '{$fil['postcode']}',
    add1 = '{$fil['add1']}',
    add2 = '{$fil['add2']}',
    add3 = '{$fil['add3']}',
    etc = '{$fil['etc']}',
    updated = now(),
    updatePerson = {$_SESSION['id']}
  WHERE id = {$fil['id']}
";

// echo $sql;
$result = mysqli_query($conn, $sql);
if($result){
  echo "<script>alert('수정하였습니다.');
  location.href = 'm_c_edit.php?id=".$fil['id']."';
  </script>";
} else {
  echo "<script>alert('수정 과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
  location.href = 'customer.php';
  </script>";
  error_log(mysqli_error($conn));
}
?>
