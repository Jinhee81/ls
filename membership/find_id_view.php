<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
	if(!$_POST['c_idx']){
		alert_msg("잘못된 접근입니다.","/");
	}
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="wrap_1000">	
				<div class="login two">
					<h2>아이디 확인</h2>
					<div class="login_box">
						<h3>'<?=$_POST['user_name']?>님' 의 아이디는
						<br /><span><?=$_POST['user_id']?></span> 입니다.</h3>
						<p>잠시 후 리스맨 로그인 페이지로 이동됩니다.
						<br />[바로가기] 버튼을 클릭하시면 바로 이동됩니다.</p>
						<b class="on_btn"><a href="../membership/login.php">바로가기</a></b>
					</div>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->
</body>
</html>
