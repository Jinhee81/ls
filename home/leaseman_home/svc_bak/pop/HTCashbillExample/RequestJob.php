<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
  /**
  * 현금영수증 매출/매입 내역 수집을 요청합니다
  * - 매출/매입 연계 프로세스는 "[홈택스 현금영수증 연계 API 연동매뉴얼]
  *   > 1.2. 프로세스 흐름도" 를 참고하시기 바랍니다.
  * - 수집 요청후 반환받은 작업아이디(JobID)의 유효시간은 1시간 입니다.
  */

	include 'common.php';

  // 팝빌회원 사업자번호, '-'제외 10자리
	$testCorpNum = '1234567890';

  // 현금영수증, SELL-매출, BUY-매입
  $CBType = KeyType::BUY;

  // 시작일자, 형식(yyyyMMdd)
  $SDate = '20170101';

  // 종료일자, 형식(yyyyMMdd)
  $EDate = '20170301';

	try {
		$jobID = $HTCashbillService->RequestJob( $testCorpNum, $CBType, $SDate, $EDate);
	}
	catch (PopbillException $pe) {
    $code = $pe->getCode();
		$message = $pe->getMessage();
	}
?>
	<body>
		<div id="content">
			<p class="heading1">Response</p>
			<br/>
			<fieldset class="fieldset1">
				<legend>수집 요청</legend>
				<ul>
					<?php
						if ( isset ( $code ) ) {
					?>
						<li>Response.code : <?php echo $code ?> </li>
						<li>Response.message : <?php echo $message ?></li>
					<?php
						} else {
					?>
						<li>jobID(작업아이디) : <?php echo $jobID ?></li>
					<?php
						}
					?>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>