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
						<li class="active">
							<p>step01</p>
							<b>이용약관 동의</b>
						</li>
						<li>
							<p>step02</p>
							<b>상세정보 입력</b>
						</li>
						<li>
							<p>step03</p>
							<b>가입완료</b>
						</li>
					</ul>
					<form>
						<div class="membership_form">
							<h3>이용약관 동의</h3>
							<div class="agreement">
								
							</div>
							<span><input type="checkbox">이용약관에 동의합니다.</span>
						</div>
						<div class="membership_form">
							<h3>개인정보수집 및 이용</h3>
							<div class="agreement">
								
							</div>
							<span><input type="checkbox">수집하는 개인정보 정택에 동의합니다.</span>
						</div>
						<div class="btn_box">
							<b class="blue on_btn">
								<a href="../inc/membership2.php">동의</a>
							</b>
							<b class="on_btn">
								<a href="../main/main.php">취소</a>
							</b>
						</div>
					</form>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->
</body>
</html>
