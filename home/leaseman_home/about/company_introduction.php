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
				<div class="sub_visual nine">
					<h2>회사소개</h2>
					<b>임대관리의 새로운 패러다임</b>
					<p>최적의 임대관리전문시스템 리스맨으로
					<br />더욱 쉽게 임대관리를 시작하세요!</b>
				</div>
				<div class="company_introduction">
					<h3>흔히 시스템은 어렵고 대기업에만 <span class="block"></span>필요하다고 생각합니다.
					<br />하지만 영화예매시스템, 열차예약시스템 등 <span class="block"></span>시스템은 우리의 삶과 밀접한 관련이 있습니다.</h3>
					<div class="company_introduction_txt">
						<p>더군다나 부동산 임대관리분야에서 그러한 시스템은 매우 필요하며, 절실합니다.
						<br />당사 역시 '비즈피스'소호사무실이라는 상호의 임대관리업을 운영하면서,
						<br />임대관리의 경험과 IT분야의 전문가와 협업하여 임대관리시스템 '리스맨'을 제작하였습니다.
						<br /><span class="bold">직원이 자주 바뀌나요? 직원교육이 어려우신가요? 리스맨이 커다란 도움이 될 것입니다.
						<br />외부에서 계약을 확인하고 싶으신지요? 모바일에서 확인이 가능합니다.</span>
						<br />고객들에게 단체로 공지사항을 보내고 싶으신가요? 리스맨에서 단체 문자 메시지를 보내기가 매우 편리합니다.</p>
						<br /><b>리스맨은 당신에게 자유와 신뢰를 선물할 것입니다.
						<br />리스맨은 사람의 실수를 보완하고 보다 체계적인 관리가 가능하게 합니다.</b>
						<br /><b>오늘의 리스맨은 어제보다 발전하였으며, 계속, 끊임없이 진화할 것입니다.
						<br />임대관리의 혁신과 표준, 리스맨을 만나 신세계를 누리시기 바랍니다.</b>
						<div class="right">
							<p>대표이사</p>
							<b><img src="../img/sub/ceo_name.png"></b>
						</div>
					</div>
					<div class="leaseman_volition">
						<ul>
							<li>
								<b>[우리의 꿈]</b>
								<p>임대관리시스템 리스맨으로 글로벌부동산테크 기업이 되기를 꿈꿉니다.</p>
							</li>
							<li>
								<b>[우리의 가치]</b>
								<p>우리는 누구보다 부지런하고 치열하게 연구합니다. 게으름과 나태함을 지양합니다.
								<br />우리는 열정을 가지고 묵묵히 열심히 일합니다. 인생은 마라톤이라고 생각합니다.
								<br />우리는 오픈마인드로 개방적입니다. 다양성을 존중하고 융합하려고 합니다.</p>
							</li>
							<li>
								<b>[로고소개]</b>
								<p>리스맨의 로고는 매출/수익이 상승하여 비약적으로 발전한다는 의지를 표현하였습니다.
								<br />리스맨을 사용하는 순간, 공실률은 감소하고 수익률은 높아질 것입니다.</p>
							</li>
							<li>
								<b>[정보보안]</b>
								<p>리스맨은 보안서버 인증을 획득하였으며 모든 데이터는 암호화 처리되어 저장됩니다.
								<br />서버에는 방화벽 및 바이러스 프로그램이 설치되었으며 Dairy Backup으로 인하여 정보가 안전하게 보관됩니다.</p>
							</li>
							<li>
								<b>[관계사]</b>
								<p>비즈피스 <span class="hide">(</span>홈페이지 <a href="http://www.bizffice.co.kr" target="blank_">www.bizffice.co.kr</a>
								<span class="hide">|</span>
								<span class="block"></span>
								<span class="mspan">비즈피스</span> 블로그 <a href="http://blog.naver.com/charm3007" target="blank_">blog.naver.com/charm3007<span class="hide">)</span></a></p>
							</li>
							<li>
								<b>[대표자 인터뷰]</b>
								<div>
									<iframe width="300" height="200" src="https://www.youtube.com/embed/DTUxHh3YND0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
								<p>2018년 8월 8일, 한국직업방송 업업스타트업_1부 출연</p>
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
