<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
  /**
  * 팝빌 관련 URL을 반환합니다.
  * 반환된 URL은 보안정책에 따라 30초의 유효시간을 갖습니다.
  */

	include 'common.php';

  // 팝빌 회원 사업자 번호, "-"제외 10자리
	$testCorpNum = '1908600646';

  // 팝빌 회원 아이디
	//$testUserID = 'testkorea';
	$testUserID = 'bizffice';
	

  // [LOGIN] : 팝빌 로그인 URL
  // [CHRG] : 포인트충전 URL
  // [CERT] : 공인인증서 등록 URL
  // [SEAL] : 인감 및 첨부문서 등록 URL
	//$TOGO = 'CHRG';
	$TOGO = 'CERT';
	

	try {
		$url = $TaxinvoiceService->GetPopbillURL($testCorpNum, $testUserID, $TOGO);
	}
	catch(PopbillException $pe) {
		$code = $pe->getCode();
		$message = $pe->getMessage();
	}
?>
	<body>
		<div id="content">
			<p class="heading1">Response</p>
			<br/>
			<fieldset class="fieldset1">
				<legend>팝빌 기본 URL 확인</legend>
				<ul>
					<?php
						if ( isset($url) ) {
					?>
							<li>url : <?php echo $url ?></li>
					<?php
						} else {
					?>
							<li>Response.code : <?php echo $code ?> </li>
							<li>Response.message : <?php echo $message ?></li>
					<?php
						}
					?>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>