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
				<div class="login one">
					<h2>아이디 찾기</h2>
					<form>
						<div class="login_box">
							<h3><span>이름과 이메일을 입력해주세요!</h3>
							<div class="login_form">
								<input type="text" placeholder="이름">
								<b class="go_btn">
									<a href="../inc/find_id_view.php">조회하기</a>
								</b>
								<input type="email" placeholder="이메일">
							</div>
							<div class="link_box">	
								<b class="on_btn">
									<a href="../inc/membership.php">회원가입</a>
								</b>
								<b class="on_btn">
									<a href="../inc/find_password.php">비밀번호 찾기</a>
								</b>
							</div>
						</div>
					</form>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>
