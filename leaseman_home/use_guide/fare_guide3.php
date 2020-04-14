<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
	if($_SESSION['member']['id']){
		$link_url ="<a href='http://sv.leaseman.co.kr/preference/payment.php' target='_blank'>결제하기</a>";
	}else
		$link_url="결제하기";
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<? include('../use_guide/sub_nav_02.php');?>
			<div class="wrap_1000">
				<div class="sub_visual three">
					<h2>요금 안내</h2>
					<b>리스맨의 언제나 합리적인 가격</b>
					<p>최적의 임대관리전문시스템 리스맨으로
					<br />더욱 쉽게 임대관리를 시작하세요!</b>
				</div>
				<h3 class="sub_tit fare_guide">언제나 합리적인 가격, 리스맨</h3>
				<b class="sub_title">30일 무료 이용 가능합니다!</b>
				<div class="fare_guide">
					<span>(단위:원,부가세 포함)</span>
					<legend>리스맨 요금안내</legend>
					<table>
						<thead>
							<tr>
								<th>등급</th>
								<th>계약건수</th>
								<th>1개월 구매</th>
								<th>1개월 구독</th>
								<th>결제하기</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>스타1</td>
								<td>20건</td>
								<td>0원</td>
								<td>0원</td>
								<td>-</td>
							</tr>
							<tr>
								<td>스타2</td>
								<td>40건</td>
								<td>14,900원</td>
								<td>11,900원</td>
								<td><b class="on_btn" href="#pop_up" title="알림"><?=$link_url?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타1</h4>
					<span>(단위:원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>건수</th>
								<td>20건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td>0원</td>
							</tr>
							<tr>
								<th>1개월구독하기</th>
								<td>0원</td>
							</tr>
							<tr>
								<th><?=$link_url?></th>
								<td>-</td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타2</h4>
					<span>(단위:원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>건수</th>
								<td>40건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td>14900원</td>
							</tr>
							<tr>
								<th>1개월구독하기</th>
								<td>11900원</td>
							</tr>
							<tr>
								<th>결제하기</th>
								<td><b class="on_btn m" href="#pop_up" title="알림"><?=$link_url?></b></td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_txt">
					<b>· 회원가입후 요금 결제가 가능합니다
					<br />· 무료등급은 30일 이용이 가능합니다.
					<br />	· 문자제공은 단문건수 기준입니다.
					<br />	· 구매하신 상품은 '1:1질문관리'페이지에서 상세내용 및 결제방법, 상품해지를 신청할 수 있습니다.
					<br />	· 자동결제 상품을 해지하신 경우 해당 서비스 만료일까지 사용하실 수 있습니다.</b>
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
	var is_member ="<?=$_SESSION['member']['id']?>";
	$(function(){
		if(!is_member){
			$(".on_btn").colorbox({ inline:true, width:"540", height:"220", transition:"none"});
			//모바일 일떼
			var windowWidth = $( window ).width();
			if(windowWidth < 500) {
				$(".on_btn.m").colorbox({ inline:true, width:"93.75%", height:"auto", transition:"none"});
			}
			$(".cancle_btn").click(function(){
				$("#cboxClose").trigger("click");
			});
		}
	});
</script>


<div style="display:none;">
	<div id="pop_up">
		<b>로그인 후 요금 결제가 가능합니다</b>
		<div class="button_box">
			<a href="http://www.leaseman.co.kr/membership/login.php"><button type="button" class="gray">로그인 바로가기</button></a>
			<button type="button" class="cancle_btn">취소</button>
		</div>
	</div>
</div>
