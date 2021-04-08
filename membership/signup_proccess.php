<?php
header('Content-Type: text/html; charset=UTF-8');
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

// $hash = md5($password);

// print_r($_POST);

$currentDate = date('Y-m-d');
$month1later = date('Y-m-d', strtotime($currentDate.'+1 month -1 days'));

$filtered = array(
  'email' => mysqli_real_escape_string($conn, $_POST['email1']),
  'password' => mysqli_real_escape_string($conn, $_POST['password']),
  'user_name' => mysqli_real_escape_string($conn, $_POST['user_name'])
);


$query = "select count(*) from user where cellphone='{$_POST['cellphone']}'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if($row[0] >=1 ){
  echo "<script>alert('이미 등록된 전화번호입니다. 비밀번호 찾기를 해주세요.');
  location.href = '../svc/password_find2.php';
  </script>";
  error_log(mysqli_error($conn));
  exit();
}


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
          '{$filtered['password']}',
          '{$_POST['user_div']}',
          '{$filtered['user_name']}',
          '{$filtered['user_name']}',
          '{$_POST['cellphone']}',
          '{$_POST['lease_type']}',
          '{$_POST['lease_etc']}',
          '{$_POST['regist_channel']}',
          '{$_POST['regist_etc']}',
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
          '{$filtered['password']}',
          '{$_POST['user_div']}',
          '{$filtered['user_name']}',
          '{$_POST['manager_name']}',
          '{$_POST['cellphone']}',
          '{$_POST['lease_type']}',
          '{$_POST['lease_etc']}',
          '{$_POST['regist_channel']}',
          '{$_POST['regist_etc']}',
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
  location.href = 'membership1.php';
  </script>";
  error_log(mysqli_error($conn));
  exit();
}

$id = mysqli_insert_id($conn); //방금넣은 아이디를 가져오는거

$sql2 = "insert into grade
         (user_id,gradename, executiveDate, startdate, enddate, formonth, payamount, payhow, ordered)
         values
         ({$id}, 'feefree', '{$currentDate}', '{$currentDate}', '{$month1later}', 1, 0, '-',1)
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

$sms = array();

$sms[0] = array("관계자화면", "추석인사", "{받는사람}님, 즐거운 추석 보내세요.");
$sms[1] = array("임대계약화면", "설인사", "{받는사람}님, 즐거운 설 명절 보내시고, 새해 복 많이 받으세요.");
$sms[2] = array("임대계약화면", "종료안내", "{받는사람}님, {종료일}에 계약이 종료됩니다. 재계약여부를 회신해주세요.");
$sms[3] = array("납부예정화면", "입금안내(부가세포함)", " 안녕하세요 ㅇㅇㅇ입니다. {예정일}까지 {시작일}~{종료일} {개월수}개월 이용료 {합계}원(부가세포함) 국민 123-123 예금주 ㅇㅇㅇ계좌로 입금하여주시기 바랍니다. 이용해주셔서 감사합니다. ㅇㅇㅇ드림");
$sms[4] = array("납부예정화면", "연체안내", " 안녕하세요 ㅇㅇㅇ입니다. {받는사람}님, 임대료가 연체되었습니다. 현재 연체일수는 {연체일수}일, 연체이자는 {연체이자}원입니다. 빠른 납부 요청드립니다. ㅇㅇㅇ드림");
$sms[5] = array("납부예정화면", "세금계산서발행", "{받는사람}님, 안녕하세요. {증빙일}에 전자세금계산서 발행 완료하였으며 이메일 {이메일}로 발송하였습니다. 확인 후 입금 요청드립니다. ㅇㅇㅇ드림");
$sms[6] = array("납부완료화면", "세금계산서발행", "{받는사람}님, 안녕하세요. {증빙일}에 전자세금계산서 발행 완료하였으며 이메일 {이메일}로 발송하였습니다. 즐거운 하루 보내세요. ㅇㅇㅇ드림");

for ($i=0; $i < count($sms); $i++) {
  $sql_sms = "insert into sms
          (screen, title, description, user_id)
          VALUES
          ('{$sms[$i][0]}',
          '{$sms[$i][1]}',
          '{$sms[$i][2]}',
          {$id}
          )";

  // echo $sql_sms;
  $result_sms = mysqli_query($conn, $sql_sms);

  if(!$result_sms){
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(3)');
    history.back();
    </script>";
    exit();
  }
}

$content = "이메일 : ".$filtered['email']."\n"
           ."user_div : ".$_POST['user_div']."\n"
           ."user_name : ".$filtered['user_name']."\n"
           ."manager_name : ".$filtered['manager_name']."\n"
           ."cellphone : ".$_POST['cellphone']."\n"
           ."lease_type : ".$_POST['lease_type']."\n"
           ."lease_etc : ".$_POST['lease_etc']."\n"
           ."regist_channel : ".$_POST['regist_channel']."\n"
           ."regist_etc : ".$_POST['regist_etc']."\n";

//리스맨에게 받는 메일
$to      = 'info@leaseman.co.kr';
$subject = '[리스맨시스템]회원가입';
$headers = 'From: '.$filtered['email'];

mail($to, $subject, $content, $headers);


if($result2 && $result3){
  echo "<script>
  location.href = 'membership3.php';
  </script>";
} else {
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
  history.back();
  </script>";
  error_log(mysqli_error($conn));
  exit();
}
?>