<?php
header('Content-Type: text/html; charset=UTF-8');
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
// include "password.php";

$password = $_POST['password'];
$hash = md5($password);

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

$sms = array(
  $sms[0] = array(
    '입주자화면', '추석인사', '{입주자}님, 즐거운 추석 보내세요.'
  ),
  $sms[1] = array(
    '납부예정화면', '입금안내(부가세포함)', ' 안녕하세요 ㅇㅇㅇ입니다. {예정일}까지 {시작일}~{종료일} {개월수}개월 이용료 {합계}원(부가세포함) 국민 123-123 예금주 ㅇㅇㅇ계좌로 입금하여주시기 바랍니다. 이용해주셔서 감사합니다. ㅇㅇㅇ드림'
  ),
  $sms[2] = array(
    '납부예정화면', '연체안내', ' 안녕하세요 ㅇㅇㅇ입니다. {입주자}님, 임대료가 연체되었습니다. 현재 연체일수는 {연체일수}일, 연체이자는 {연체이자}원입니다. 빠른 납부 요청드립니다. ㅇㅇㅇ드림'
  ),
  $sms[3] = array(
    '납부완료화면', '세금계산서발행', '{입주자}님, 안녕하세요. {발행일}에 전자세금계산서 발행 완료하였으며 이메일 {이메일}로 발송하였습니다. 즐거운 하루 보내세요. ㅇㅇㅇ드림'
  )
)

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
  echo $sql;
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
  echo $sql;
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
  echo $sql2;

  $result2 = mysqli_query($conn, $sql2);

  $sql3 = "insert into coin
           (user_id, date, description, payAmount, coinAmount)
           values
           ({$id}, '{$currentDate}', '회원가입축하', 0, 3000)
           ";
  echo $sql3;

  $result3 = mysqli_query($conn, $sql3);

  for ($i=0; $i < count($sms); $i++) {
    $sql4 = "insert into sms
            (screen, title, description, user_id)
            VALUES
            ('{$sms[$i][0]}',
            '{$sms[$i][1]}',
            '{$sms[$i][2]}',
            {$id}
            )";
    $result4 = mysqli_query($conn $sql4);

    if(!$result4){
      echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(3)');
      location.href = 'signup.php';
      </script>";
      exit();
    }
  }

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
