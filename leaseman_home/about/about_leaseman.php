<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style>
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="wrap_1000">
				<? include('../about/sub_nav_01.php');?>
				<div class="sub_visual">
					<h2>리스맨이란?</h2>
					<b>임대관리의 새로운 패러다임</b>
					<p>최적의 임대관리전문시스템 리스맨으로
					<br />더욱 쉽게 임대관리를 시작하세요!</b>
				</div>
				<h3 class="sub_tit">임대관리에도 시스템이 필요합니다!</h3>
				<div class="about_leaseman">
					<div class="about_leaseman_tit">
						<p>임대사업자에 대한 시선, 동경과 시샘이 공존합니다. 쉽고 편하게 돈 번다고 생각합니다.
						<br />하지만 임대관리종사자들은 말합니다. 생각보다 만만치 않고, 연체고객으로 인해 스트레스 받고,
						<br />착하고 인정 많은 성격은 임대관리 못한다고 말합니다.</p>

						<p>세입자는 월세를 연체해도 미안해하지 않습니다. 오히려 월세를 독촉하는 임대인이 미안해합니다.
						<br />뿐만 아니라 누가 몇 일 임대료를 납부하는지, 몇 일에 누가 퇴실하고 입실하는지에 대해
						<br />각자의 종이장부, 다이어리, 또는 컴퓨터 엑셀에 기록합니다.
						<br /><span>이는 휴대하기 어렵고 분실의 위험이 있으며, 실시간 변화하는 데이터를 반영하지 못합니다.</span></p>

						<p>통신사, 카드사, 정부기관, 대기업에도 시스템이 있습니다.
						<br />주변 작은 마트, 편의점, 헬스장에도 고객관리 시스템이 있습니다.</p>

						<b>이제는 임대사업자도 그러한 시스템이 필요합니다.
						<br /><span>리스맨이 당신의 충성스럽고 착하고
						<br />똑똑한 직원의 역할을 할 것을 약속합니다.</span>
						</b>
					</div>
					<div class="about_leaseman_table">
						<ul>
							<h4>리스맨이란?</h4>
							<li>
								<b>01</b>
								<p>
									LEASE MANAGEMENT의<span> 합성어로써, 임대관리 전문 시스템입니다!</span>
								</p>
							</li>
							<li>
								<b>02</b>
								<p>
									소호사무실/고시원/원룸사업자/<span>창고사업자/상가임대인 등</span>
									<br />각종 임대업에 종사하는 사람들이 <span>사용하는 소프트웨어입니다!</span>
								</p>
							</li>
							<li>
								<b>03</b>
								<p>
									기존 엑셀, 장부의 기록들을 <span>PC/모바일에서 </span>
									<br />고객관리/계약관리/회계관리의 <span>업무를 처리합니다. </span>
								</p>
							</li>
							<li>
								<b>04</b>
								<p>
									통신사 문자메시지 및 국세청 홈택스 <span>사이트와의 인터페이스를 제공합니다.</span>
								</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
	$("#gnb > ul > li").eq(0).addClass("active");
});
</script>
