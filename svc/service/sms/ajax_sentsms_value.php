<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
header('Content-Type: text/html; charset=UTF-8');
include "ajax_sentsms_sql.php";

$result = mysqli_query($conn, $sql);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

// $smsResult = array(
//   '01' => '시스템장애',
//   '02' => '인증실패',
//   '03' => 'BIND실패',
//   '06' => '전송성공',
//   '07' => '비가입자/결번',
//   '08' => '단말기전원꺼짐',
//   '09' => '음영',
//   '10' => '단말기메시지FULL',
//   '11' => '타임아웃',
//   '13' => '번호이동',
//   '14' => '무선망에러',
//   '17' => 'callBack URL 사용자 아님',
//   '18' => '메시지중복발송',
//   '19' => '월송신건수초과',
//   '20' => '기타에러',
//   '21' => '착신번호에러(자릿수에러)',
//   '22' => '착신번호에러(없는국번)',
//   '23' => '수신거부메시지',
//   '24' => '21시이후광고',
//   '25' => '기타제한',
//   '26' => '데이콤스팸필터링',
//   '27' => '야간발송차단',
//   '40' => '단말기착신거부',
//   '70' => '기타오류',
//   '80' => '결번',
//   '81' => '정지고객',
//   '82' => '조회불가',
//   '83' => '번호이동',
//   '84' => '타임아웃',
//   '85' => '전송실패',
//   '91' => '발송실패',
//   '99' => '중복실패'
// )
//
// $mmsResult = array(
//   '1000' => '성공',
//   '2000' => '포맷에러',
//   '2001' => '잘못된번호',
//   '2002' => '사이즈초과',
//   '2003' => '오류컨텐츠',
//   '3000' => '미지원단말기',
//   '3001' => '단말기메시지저장개수초과',
//   '3002' => '전송시간초과',
//   '3004' => '전원꺼짐',
//   '3005' => '음영지역',
//   '3006' => '기타',
//   '4000' => '서버에러',
//   '4001' => '단말기일시정지',
//   '4002' => '서버에러',
//   '4003' => '일시에러',
//   '4101' => '계정차단',
//   '4102' => '허용되지않은IP',
//   '4104' => '건수부족',
//   '4201' => '국제MMS',
//   '5000' => '번호이동에러',
//   '5001' => '발송건수초과',
//   '5003' => '스팸',
//   '5201' => '중복키차단',
//   '9001' => '발송미허용시간',
//   '9002' => '번호오류',
//   '9003' => '스팸번호',
//   '9004' => '이통사에러',
//   '9005' => '파일크기오류',
//   '9006' => '지원되지않는파일',
//   '9007' => '파일오류',
//   '9008' => '타입오류',
//   '9009' => '중복발송',
//   '9010' => '전송횟수초과',
//   '9011' => '발송지연'
// );

for ($i=0; $i < count($allRows); $i++) {
  // $yearMonth = date("Y-m", strtotime($allRows[$i]['sendtime']));
  //
  // if($allRows[$i]['type']==='sms'){
  //   $sql = "select TR_RSLTSTAT
  //           from SC_LOG_.$yearMonth.
  //           where TR_ETC2 = {$allRows[$i]['id']}";
  //   $result = mysqli_query($conn, $sql);
  //   $row = mysqli_fetch_array($result);
  //
  //   if($row['TR_RSLTSTAT']==='06'){
  //     $allRows[$i]['result'] = '전송성공';
  //   }
  // }
  $allRows[$i]['customermb'] =  mb_substr($allRows[$i]['customer'],0,10,'utf-8');
  $allRows[$i]['descriptionmb'] =  mb_substr($allRows[$i]['description'],0,10,'utf-8');
}

echo json_encode($allRows);
?>
