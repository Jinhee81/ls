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
			<? include('../use_guide/sub_nav_02.php');?>
			<div class="wrap_1000">
				<div class="sub_visual eight">
					<h2>리스맨 매뉴얼</h2>
					<b>리스맨 매뉴얼 가이드</b>
					<p>최적의 임대관리전문시스템 리스맨으로
					<br />더욱 쉽게 임대관리를 시작하세요!</b>
				</div>
				<form>	
					<div class="qna_list_box">
						<div class="qna_list_wrap">
							<div class="qna_list_content" style="display:block;">
								<ul class="qna_list">
									<li class="">
										<p class="qna_subject">리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.</p>
										<p class="qna_cont"> 리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.  리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 회원분들께서
										 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 
										 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. </p>
									</li>
								</ul>
							</div>
						</div>
						<div class="qna_list_wrap">
							<div class="qna_list_content" style="display:block;">
								<ul class="qna_list">
									<li class="">
										<p class="qna_subject">리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.</p>
										<p class="qna_cont"> 리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.  리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 회원분들께서
										 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 
										 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. </p>
									</li>
								</ul>
							</div>
						</div>
						<div class="qna_list_wrap">
							<div class="qna_list_content" style="display:block;">
								<ul class="qna_list">
									<li class="">
										<p class="qna_subject">리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.</p>
										<p class="qna_cont"> 리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.  리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 회원분들께서
										 반드시 숙지 부탁드립니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 
										 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. 리스맨 회원제 약관이 변동되었습니다. </p>
									</li>
								</ul>
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
<script type="text/javascript">
$(document).ready(function(){
	$("#gnb > ul > li").eq(1).addClass("active");
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".qna_list>li .qna_subject").click(function(){
		var $con = $(this).parent("li").find(".qna_cont");
		if($con.is(":visible")) {
			$con.slideUp();
			$(".qna_list>li").removeClass("active");
			$(".qna_subject").removeClass("on");
		} else {
			$(".qna_list>li .qna_cont:visible").slideUp();
			$(".qna_list>li").removeClass("active");
			$(".qna_subject").addClass("on");
			$(this).parent("li").addClass("active");
			$con.slideDown();
			}
		});
	});
</script>
