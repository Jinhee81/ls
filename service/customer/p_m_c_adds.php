<?php //고객생성 파일
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);
print_r($_SESSION);

// $fil = array(
//   'qDate' => mysqli_real_escape_string($conn, $_POST['qDate']),
//   'name' => mysqli_real_escape_string($conn, $_POST['name']),
//   'email' => mysqli_real_escape_string($conn, $_POST['email']),
//   'etc' => mysqli_real_escape_string($conn, $_POST['etc']),
//   'companyname' => mysqli_real_escape_string($conn, $_POST['companyname']),
//   'contact1' => mysqli_real_escape_string($conn, $_POST['contact1']),
//   'contact2' => mysqli_real_escape_string($conn, $_POST['contact2']),
//   'contact3' => mysqli_real_escape_string($conn, $_POST['contact3']),
//   'cNumber1' => mysqli_real_escape_string($conn, $_POST['cNumber1']),
//   'cNumber2' => mysqli_real_escape_string($conn, $_POST['cNumber2']),
//   'cNumber3' => mysqli_real_escape_string($conn, $_POST['cNumber3']),
//   'add1' => mysqli_real_escape_string($conn, $_POST['add1']),
//   'add2' => mysqli_real_escape_string($conn, $_POST['add2']),
//   'add3' => mysqli_real_escape_string($conn, $_POST['add3'])
// );
//
// print_r($fil);
//
// $sql = "
//   INSERT INTO customer (
//     div1, qDate, div2, name, contact1, contact2, contact3,
//     gender, email, div3, div4, div5, companyname, cNumber1, cNumber2, cNumber3, zipcode, add1, add2, add3, etc, created, user_id
//     ) VALUES (
//     '{$_POST['div1']}', '{$fil['qDate']}', '{$_POST['div2']}', '{$fil['name']}', '{$fil['contact1']}', '{$fil['contact2']}', '{$fil['contact3']}', '{$_POST['gender']}', '{$fil['email']}', '{$_POST['div3']}', '{$_POST['div4']}', '{$_POST['div5']}', '{$fil['companyname']}',
//     '{$fil['cNumber1']}', '{$fil['cNumber2']}','{$fil['cNumber3']}', '{$_POST['zipcode']}', '{$fil['add1']}','{$fil['add2']}', '{$fil['add3']}', '{$fil['etc']}', now(), {$_SESSION['id']}
//     )
// ";
//
// echo $sql;
// $result = mysqli_query($conn, $sql);
// if($result){
//   echo "<script>alert('저장되었습니다.');
//   location.href = 'customer.php';
//   </script>";
// } else {
//   echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
//   location.href = 'customer.php';
//   </script>";
//   error_log(mysqli_error($conn));
// }



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
