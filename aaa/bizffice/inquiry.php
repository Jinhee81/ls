<? include $_SERVER[DOCUMENT_ROOT]."/common.php"?>
<? $pgMNo = "4"; ?>


<?
	if($_GET[act]=="1"){
		//print_r($_POST);
		$name = $_POST[name];
		$tel1 = $_POST[tel1];
		$tel2 = $_POST[tel2];
		$tel3 = $_POST[tel3];



//		$to      = 'yoshikix1982@naver.com';
		$to      = 'bizffice@naver.com';
//		$subject = '[비즈피스]'.$name.'님 입주문의';
		$subject =  $name ."님 입주문의"." [".$_POST[branch]." :". $tel1."-".$tel2."-".$tel3."]";
		$message = $_POST[content];

		$message.="\r\n 연락처 : ".$tel1."-".$tel2."-".$tel3;


		$headers = 'From: bizffice@bizffice.com' . "\r\n" .
	    'Reply-To: webmaster@example.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

		$result = mail($to, $subject, $message, $headers);



		//### 문자 셋팅. 

		$send_number = "01068135825";

		if($_POST[branch]=="의정부 장암점"){
			$receive_number = "01068135825";

//			$receive_number = "01039593397";
			

		}else if($_POST[branch]=="구로점"){
			$receive_number = "01098009885";
//			$receive_number = "01039593397";



		}
		$subject				=		$tools->strCut($_POST[content], 40);

		$subject = iconv("UTF-8" ,"EUC-KR", $subject);

		$name = iconv("UTF-8","EUC-KR", $name);

		$subject = $tel1."-".$tel2."-".$tel3.",".$name.",".$subject;



?>

<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">

<form name="form2" action="http://biz.xonda.net/biz/biz_newV2/SMSASP_WEBV4_s.asp" method="post" style="display:none"> <?//sms 전송 Xonda URL ?>

<input type="text" name="send_number" value="<?=$send_number?>">						<?//발송자 핸드폰 번호(숫자만기입) 15자이내 ?>
<input type="text" name="receive_number" value="<?=$receive_number?>">				<?//수신자 핸드폰 번호(동보일 경우 0123456789,0123456789 / 단문일경우 15자 이내 ) ?>
<input type="text" name="biz_id" value="bizffice">							<?//Xonda/Biz ID ?>

<input type="text" name="smskey" value="24558A6D-2232-44B5-9C96-5F5CDADBE7B0">							<?//보안키 ?>


<input type="text" name="return_url" value="http://www.bizffice.co.kr/inquiry/inquiry.php?Act=2">			<?//sms 전송후 돌아올 URL ?>
<textarea name="sms_contents" cols="16" rows="5"><?=$subject?></textarea>		<?//전송할 메세지 80자 이내 ?>

<input type="text" name="reserved_flag" value="false">				<?// true : 예약, false : 즉시 ?>
<input type="text" name="usrdata1" value="a">								<?//기타 되돌려받을값 ?>
<input type="text" name="usrdata2" value="b">								<?//기타 되돌려받을값 ?>
<input type="text" name="usrdata3" value="c">								<?//기타 되돌려받을값 ?>


<!--<input type="submit" value="보내기" id="submit1" name="submit1">-->



</form>
<script>
	document.form2.submit();
</script>

<?

/*
		if($result){
			echo "<script>alert('성공적으로 문의 신청을 하였습니다.');location.href='./inquiry.php';</script>";
		}else{
			echo "<script>alert('문의 신청중 문제가 발생하였습니다. 관리자에게 연락 바랍니다..');location.href='./inquiry.php';</script>";
		}
*/
		exit;

	}

	if($_GET[Act]=="2"){
		if($_POST[return_value]=="1"){
			echo "<script>alert('성공적으로 문의 신청을 하였습니다.');location.href='./inquiry.php';</script>";
		}else{
			echo "<script>alert('문의 신청중 문제가 발생하였습니다. 관리자에게 연락 바랍니다..');location.href='./inquiry.php';</script>";
//			echo "<PRE>";
//			print_r($_POST);
//			print_r($_GET);
//			echo "<script>alert('성공적으로 문의 신청을 하였습니다.');location.href='./inquiry.php';</script>";

		}
	}
?>

<? include("../common/inc/header.php"); ?>

<script>
	function sendit(){
		var f = document.form1;
		if(f.name.value==""){
				alert("이름을 입력해주세요");
				f.name.focus();
				return;
			}
			if(f.tel1.value==""){
				alert("휴대전화 번호를  입력해주세요");
				f.tel1.focus();
				
				return;
			}
			if(f.tel2.value==""){
				alert("휴대전화 번호를  입력해주세요");
				f.tel2.focus();
				return;
			}
			if(f.tel3.value==""){
				alert("휴대전화 번호를  입력해주세요");
				f.tel3.focus();
				return;
			}

			if(f.content.value==""){
				alert("문의내용을 입력해주세요");
				return;
			}

			if(confirm("입주문의를 하시겠습니까?")){

				f.submit();
			}
	}

	function isNum(){ 
	   var key = event.keyCode;
//	   alert(key);
	 //  var messageArea = document.getElementById("ssnMessage"); 
	   if(!(key==8||key==9||key==13||key==46||key==144||(key>=48&&key<=57)||key==110)){ 
			alert('숫자만 입력 가능합니다'); 
			return false;
			event.returnValue = false; 
	   } 
	}



</script>
<form name="form1" method="POST" action="?act=1">		
		<!-- Contents -->
		<div id="container">
		
			<section class="inquiry">
				<div class="contents">
					<div class="tit-sec">
						<h2>입주문의</h2>
						<span>비즈피스에 입주문의를 하실 수 있습니다.</span>
					</div>
					<div class="inquiry-form">
						<form id="" name="" action="">
						<dl>
							<dt><label for="name">이름</dt>
							<dd>
								<span style="width:466px"><input type="text" name="name" id="name"></span>
							</dd>
							<dt><label for="phone">휴대전화</dt>
							<dd class="phone">
								<span style="width:135px"><input type="tel" id="phone" name="tel1" maxlength="4" title="휴대전화 첫자리" onkeydown="return isNum()"></span>
								<span style="width:135px"><input type="tel" id="phone" name="tel2" maxlength="4" title="휴대전화 중간자리" onkeydown="return isNum()"></span>
								<span style="width:135px"><input type="tel" id="phone" name="tel3" maxlength="4" title="휴대전화 끝자리" onkeydown="return isNum()"></span>
							</dd>
							<dt><label for="branch">문의지점</dt>
							<dd>
								<span style="width:466px">
									<select id="branch" name="branch">
										<option>의정부 장암점</option>
										<option>구로점</option>
									</select>
								</span>
							</dd>
							<dt><label for="cont">문의내용</dt>
							<dd>
								<span style="width:95%">
									<textarea id="cont" name="content" style="height:300px" placeholder="내용입력"></textarea>
								</span>
							</dd>
						</dl>
						<div class="btn-sec tc">
							<!--
							<input type="submit" value="확인" class="btn-ok">
							<input type="reset" value="취소">
							-->
							<a href="#" class="btn-ok" onclick="sendit()">확인</a>
							<a href="#" onclick="document.form1.reset()">취소</a>
						</div>
						</form>
					</div>
				</div>
			</section>
			
		</div>
		<!-- Contents //-->
</form>		
		<? include("../common/inc/footer.php"); ?>
		