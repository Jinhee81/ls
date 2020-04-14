
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?=$subject?></title>
</head>
<body>

<section id="container">
	<div class="wrap_1000" style="width:600px; margin:0 auto;">	
		<div class="id_find" style="padding:20px; margin-top:30px; padding-bottom:0;">
			<h3 style="margin-bottom:15px;"><img src="http://leaseman.co.kr/img/sub/service_logo.png"></h3>
			<div class="mail_form"  style=" border:1px solid #bbbbbb;">
				<div class="mail_form_tit" style="text-align:center;">	
					<img src="http://leaseman.co.kr/img/sub/password_change.png" style="vertical-align:middle; display:inline-block; margin-top:20px;">
					<b style="display:block; font-size:16px; font-weight:normal; color:#666666; margin-top:40px; line-height:22px;"> <span style="font-weight:bold"><?php echo $user_name ?></span>님 비밀번호는 <span style="font-weight:bold"><?=$return_pass?></span>입니다.
					<br />사이트 방문 후 임시비밀번호는 재설정 후 이용바랍니다.
					<br />감사합니다.</b>
					<div class="button_box" style="display:table; margin:0 auto; margin-top:40px; overflow:hidden;">
						<b type="button" class="blue" style="width:180px; line-height:38px; float:left; height:38px; background:#2b506f;color:#fff;
						display:block; margin-bottom:40px;">
							<a href="http://leaseman.co.kr/membership/login.php" target="blank_" style="color:white; display:block; text-decoration:none;
							font-size:16px;" target="blank_">비밀번호 재설정하기</a>
						</b>
						<b style="float:left; display:block; height:36px; line-height:36px; border:1px solid #dfdfdf;margin-left:10px;
						width:120px; text-align:center; margin-bottom:40px;">
							<a href="http://www.leaseman.co.kr/main/main.php" style="color:#333333; display:block;text-decoration:none;
							font-size:16px;" target="blank_">
							홈으로</a>
						</b>
					</div>
				</div>
				<div class="mail_form_txt" style="margin:0 20px; border-top:1px solid #eaeaea;padding:20px 0;">
					<b><img src="http://leaseman.co.kr/img/sub/leaman_txt.png" alt=""></b>
					<p class="etc" style="font-size:14px; display:block; margin-top:12px; color:#777777;"><img src="http://leaseman.co.kr/img/sub/leaman_tit.png" alt=""></p>
					<p style="font-size:14px; line-height:24px; display:block; margin-top:12px; color:#777777;">· 고객센터  :  <span style="color:#2b506f; font-weight:bold;">031-879-8003</span>
					<br />· 운영시간  :  <span style="color:#2b506f; font-weight:bold;">평일 09:00 ~ 18:00 (토,일, 공휴일 휴무)</span></p>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="serviece_footer" style="width:600px; margin:0 auto; margin-top:20px; overflow:hidden;">
	<div style="padding:0 20px;">	
		<img src="http://leaseman.co.kr/img/sub/service_footer.png" style="float:left;" >
		<div class="tit" style="float:left; width:390px; margin-left:20px;">
			<p style="margin-top:0; font-size:13px; line-height:18px; display:block; color:#888888; letter-spacing:-0.2px;">본 메일은 발신 전용 메일로써 회신이 불가능합니다.
			<br />COPYRIGHT ⓒ 2017 BIZFFICE CORPRATION ALL RIGHT RESERVED.
			<br />사업자등록번호: 190-86-00646   
			<br />통신판매업신고번호: 제2017-경기의정부-0155호</p>
		</div>
	</div>
</section>

</body>
</html>

