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
				<? include('../about/sub_nav_01.php');?>
				<div class="sub_visual two">
					<h2>리스맨 효과</h2>
					<b>리스맨으로 부터 기대되는 효과</b>
					<p>최적의 임대관리전문시스템 리스맨으로
					<br />더욱 쉽게 임대관리를 시작하세요!</b>
				</div>
				<h3 class="sub_tit">이러한 당신에게 리스맨이 필요합니다!</h3>
				<div class="leaseman_effect">
					<ul>
						<li>
							<div class="leaseman_effect_txt">
								<h3>몇호에 누가 있는지, 계약종료가 언제인지 헷갈리시나요?</h3>
								<b>리스맨은 똑똑한 시스템입니다!</b>
								<p>계약만 입력하면 리스맨이 월별/연도별 회계레포트를 출력하고,
								<br />언제 고객에게 요금청구를 해야할지 알려드립니다.</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>외부에서 계약내용을 확인하고 싶으신가요?</h3>
								<b>간편하게 휴대폰으로 다양한 자료를 확인하실 수 있습니다.</b>
								<p>안드로이드 어플 '리스맨' 앱을 설치하세요!</p>
								<br/>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>연체고객으로 어려움을 겪으시나요?</h3>
								<b>리스맨에서는 연체일수, 연체이자를 자동으로 계산합니다.</b>
								<p>리스맨에서는 연체관련 시스템이 자동으로 계산되는데,
								<br />이는 상습 체납 고객을 응대할 때 효과적인 자료가 됩니다.</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>여러 개의 건물을 관리하시는 분! </h3>
								<b>리스맨에서 각 건물별 계약/회계/고객을 관리합니다.</b>
								<p>매월 수금이 아니라 2개월치, 3개월치 수금이 많은 분!
								<br />또한 매월 임대료 수금이 아니라 원하는 개월수에 맞추어 수금처리 가능합니다!</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>다양한 상품의 매출 계약이 있으신 분!</h3>
								<b>촘촘하면서도 유연한 시스템 리스맨!</b>
								<p>리스맨에서는 전세/월세의 상품을 설정하거나 임대계약 매출 외에도 기타 매출로 인한 계약
								<br />(1회성 매출발생건)이 발생했을때 매출등록이 가능합니다.</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>보다 편리하고 빠르게 세금계산서를 발행하고 싶으신 분!</h3>
								<b>리스맨에서 세금계산서 발행 가능합니다.</b>
								<p>리스맨은 한꺼번에 여러 개의 세금계산서를 일괄 발급 가능합니다!
								<br />세금계산서 발행이 더욱 빨라집니다.</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>단체문자를 보내고 싶으시다고요?</h3>
								<b>리스맨에서 문자를 보내세요! </b>
								<p>리스맨에서는 더욱 쉽고 간편하게
								<br />고객별 맞춤 문자메시지를 작성해서 문자를 보낼수 있습니다</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>핸드폰에 업무관련 전화번호를 따로 저장하고 싶으신 분!</h3>
								<b>개인용 핸드폰, 업무용 핸드폰 두개 가지고 다니기 불편합니다.</b>
								<p>하지만 본인 핸드폰에 업무에 관련된 사람을 저장을 원치 않으실경우,
								<br />리스맨 사용만으로 업무처리가 가능합니다!</p>
							</div>
						</li>
						<li>
							<div class="leaseman_effect_txt">
								<h3>내부통제 기능을 향상시키고자 하는 분!</h3>
								<b>더욱 체계적이고 투명한 선진화 기업문화를 만들어 드립니다.</b>
								<p>리스맨은 보다 체계적인 내부질서를 확립시키고
								<br />투명하고 선진화된 기업문화를 만들어냅니다.</p>
							</div>
						</li>
						<!-- <li>
							<div class="leaseman_effect_end">
								<p>홈회사로고와 상호의 사용을 원하는 기업고객이라면
								<br /><span>  홈페이지의 고객센터->문의게시판->기업고객문의로 문의사항을 남겨주시거나
								<br />하단 전화 또는 이메일로 연락주시기 바랍니다.
								</p>
								<b><a href="../_bbs/board_write.php?code=h_qna" target="_blank">문의하기 바로가기</a></b>
							</div>
						</li> -->
					</ul>
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
