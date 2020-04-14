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
				<div class="login">
					<h2>로그인</h2>
					<form>
						<div class="login_box">
							<h3><span>리스맨</span>에 오신것을 환영합니다!</h3>
							<p>리스맨 홈페이지를 방문해 주셔서 감사합니다.
							<br />항상 고객을 위해 노력하는 리스맨이 되도록 하겠습니다.</p>
							<div class="login_form">
								<input type="text" placeholder="아이디">
								<b class="go_btn">
									<a href="#!">로그인</a>
								</b>
								<input type="password" placeholder="비밀번호">
							</div>
							<span class="id_save"><input type="checkbox" class="id_check">아이디 저장</span>
							<div class="link_box">	
								<b class="on_btn">
									<a href="../inc/membership.php">회원가입</a>
								</b>
								<b class="on_btn">
									<a href="../inc/find_id.php">아이디 찾기</a>
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
