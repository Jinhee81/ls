<?php //고객생성 파일
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);
print_r($_SESSION);

$fil = array(
  'qStory' => mysqli_real_escape_string($conn, $_POST['qStory']),
  'qDate' => mysqli_real_escape_string($conn, $_POST['qDate']),
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'etc' => mysqli_real_escape_string($conn, $_POST['etc']),
  'companyname' => mysqli_real_escape_string($conn, $_POST['companyname'])
);

$fil['contact'] = $_POST['contact1'].'-'.$_POST['contact2']. '-'.$_POST['contact3'];
$fil['companynumber'] = $_POST['companynumber1'].'-'.$_POST['companynumber2']. '-'.$_POST['companynumber3'];

$sql = "
  INSERT INTO customer (
    div1, qStory, qDate, div2, name, contact, gender, email, div3, div4, div5, etc, companyname, companynumber, created, user_id
    ) VALUES (
    '{$_POST['div1']}', '{$fil['qStory']}', '{$fil['qDate']}', '{$_POST['div2']}', '{$fil['name']}', '{$fil['contact']}', '{$_POST['gender']}', '{$fil['email']}', '{$_POST['div3']}', '{$_POST['div4']}', '{$_POST['div5']}', '{$fil['etc']}', '{$fil['companyname']}', '{$fil['companynumber']}', now(), {$_SESSION['id']}
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



// $query = "
//   select count(*) from building
//   where
//     user_id={$_SESSION['id']} and name = '{$filtered['name']}'
//     ;";
//
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_array($result);
// $r_count = (int)$row['count(*)'];


// if ($r_count === 0) {
//   $sql  = "
//       INSERT INTO building (
//           name,
//           pay,
//           user_id,
//           created
//       ) VALUES (
//           '{$filtered['name']}',
//           '{$_POST['pay']}',
//           {$_SESSION['id']},
//           now()
//       )";
// } else {
//   echo "<script>alert('같은 명칭이 이미 존재합니다.');
//   location.href='building.php';
//   </script>";
// }
//
// $result = mysqli_query($conn, $sql);
// // echo $result;
// if($result === false){
//     echo mysqli_error($conn);
// } else {
//   echo
//   "<script>
//   alert('저장되었습니다.');
//   window.location.href='building.php';
//   </script>";
// }

?>
