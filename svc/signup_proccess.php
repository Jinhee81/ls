<?php
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include "password.php";

$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

// print_r($_POST);

$currentDate = date('Y-m-d');
$month1later = date('Y-m-d', strtotime($currentDate.'+1 month -1 days'));

$filtered = array(
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'user_name' => mysqli_real_escape_string($conn, $_POST['user_name']),
  'manager_name' => mysqli_real_escape_string($conn, $_POST['manager_name']),
  'lease_etc' => mysqli_real_escape_string($conn, $_POST['lease_type_text']),
  'regist_etc' => mysqli_real_escape_string($conn, $_POST['regist_channel_text'])
);

if($_POST['user_div']==='개인'){
  $sql  = "
      INSERT INTO user (
          email,
          password,
          user_div,
          user_name,
          manager_name,
          cellphone,
          lease_type,
          lease_etc,
          regist_channel,
          regist_etc,
          created,
          gradename,
          emailauth,
          coin
      ) VALUES (
          '{$filtered['email']}',
          '{$hash}',
          '{$_POST['user_div']}',
          '{$filtered['user_name']}',
          '{$filtered['user_name']}',
          '{$_POST['cellphone']}',
          '{$_POST['lease_type']}',
          '{$filtered['lease_etc']}',
          '{$_POST['regist_channel']}',
          '{$filtered['regist_etc']}',
          NOW(),
          'feefree',
          'no',
          3000
      )";
  // echo $sql;
} else {
  $sql  = "
      INSERT INTO user (
          email,
          password,
          user_div,
          user_name,
          manager_name,
          cellphone,
          lease_type,
          lease_etc,
          regist_channel,
          regist_etc,
          created,
          gradename,
          emailauth,
          coin
      ) VALUES (
          '{$filtered['email']}',
          '{$hash}',
          '{$_POST['user_div']}',
          '{$filtered['user_name']}',
          '{$filtered['manager_name']}',
          '{$_POST['cellphone']}',
          '{$_POST['lease_type']}',
          '{$filtered['lease_etc']}',
          '{$_POST['regist_channel']}',
          '{$filtered['regist_etc']}',
          NOW(),
          'feefree',
          'no',
          3000
      )";
  // echo $sql;
}

$result = mysqli_query($conn, $sql);
if($result === false){
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(1)');
  location.href = 'signup.php';
  </script>";
  error_log(mysqli_error($conn));
  exit();

} else {
  $id = mysqli_insert_id($conn); //방금넣은 아이디를 가져오는거

  $sql2 = "insert into grade
           (user_id, gradename, executiveDate, startdate, enddate, formonth, payamount, ordered)
           values
           ({$id}, 'feefree', '{$currentDate}', '{$currentDate}', '{$month1later}', 1, 0, 1)
           ";
  // echo $sql2;

  $result2 = mysqli_query($conn, $sql2);

  $sql3 = "insert into coin
           (user_id, date, description, payAmount, coinAmount)
           values
           ({$id}, '{$currentDate}', '회원가입축하', 0, 3000)
           ";
  // echo $sql3;

  $result3 = mysqli_query($conn, $sql3);

  if($result2 && $result3){
    echo "<script>alert('축하합니다. 리스맨 회원가입이 되었습니다. 리스맨 임대관리시스템으로 새로운 임대관리를 경험해보세요!');
    location.href = 'login.php';
    </script>";
  } else {
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
    location.href = 'signup.php';
    </script>";
    exit();
  }
}
?>
