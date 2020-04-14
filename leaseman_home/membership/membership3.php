<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="wrap_1000">
				<div class="membership">
					<h2>회원가입</h2>
					<ul class="tab_menu">
						<li>
							<p>step01</p>
							<b>이용약관 동의</b>
						</li>
						<li>
							<p>step02</p>
							<b>상세정보 입력</b>
						</li>
						<li  class="active">
							<p>step03</p>
							<b>가입완료</b>
						</li>
					</ul>
					<div class="membership3">
						<img src="../img/sub/membership_img.png">
						<h3>짝짝짝! 환영합니다!</h3>
						<p>리스맨 임대관리프로그램에서
						<br />새로운 임대관리를 경험해보세요!</p>
						<div class="btn_box">
							<b class="blue on_btn"><a href="../svc/login.php" target="blank_">리스맨 프로그램 이용하기</a></b>
							<b class="on_btn"><a href="../main/main.php">홈으로</a></b>
						</div>
					</div>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->
</body>
</html>
