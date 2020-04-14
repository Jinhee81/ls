<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
  /**
  * 세금계싼서 발행안내 메일을 재전송합니다.
  */

	include 'common.php';

  // 팝빌 회원 사업자번호, '-' 제외 10자리
	$testCorpNum = $_POST['testCorpNum'];
	$testCorpNum = str_replace("-","",$testCorpNum);

  // 발행유형, ENumMgtKeyType::SELL:매출, ENumMgtKeyType::BUY:매입, ENumMgtKeyType::TRUSTEE:위수탁
  $mgtKeyType = ENumMgtKeyType::SELL;

  // 문서관리번호
	//$mgtKey = '20170302-05';
	$mgtKey = $_POST['invoicerMgtKey'];

  // 수신이메일주소
	$receiver = $_POST['receiver'];


	if($testCorpNum == "" || $mgtKey == "" || $receiver == ""){
	?>
		<script type="text/javascript">
			alert("오류!");
		</script>
	<?	
		exit;
	}

	try {
		$result = $TaxinvoiceService->SendEmail($testCorpNum, $mgtKeyType, $mgtKey, $receiver);
		$code = $result->code;
		$message = $result->message;
	}
	catch(PopbillException $pe) {
		$code = $pe->getCode();
		$message = $pe->getMessage();
	}
?>
	<!--
	<body>
		<div id="content">
			<p class="heading1">Response</p>
			<br/>
			<fieldset class="fieldset1">
				<legend>알림메일 재전송</legend>
				<ul>
					<li>Response.code : <?php echo $code ?></li>
					<li>Response.message : <?php echo $message ?></li>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>
-->

<script type="text/javascript">
	var code = "<?=$code?>";
	var message = "<?=$message?>";
	
	if(code!=1){
		alert(code);
	}
	if(code==1){
		alert("발급되었습니다.");
		parent.location.reload();
	}else{
		alert(message);
		parent.location.reload();
	}
	
</script>