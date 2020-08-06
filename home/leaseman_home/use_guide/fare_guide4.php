<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
	if($_SESSION['member']['id']){
		$link_url ="<a href='http://sv.leaseman.co.kr/preference/payment.php' target='_blank'>결제하기</a>";
	}else{
		$link_url="결제하기";
	}

	$payAmount = array(
		array(1, 20, 0, 0, 0),
		array(2, 40, 14900, 11900, 9900),
		array(3, 60, 24900, 17900, 14900),
		array(4, 80, 29900, 23900, 19900),
		array(5, 120, 44900, 35900, 29900),
		array(6, 200, 59900, 47900, 39900),
		array(7, 300, 74900, 59900, 49900)
 	);

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
								<th>건수</th>
								<th>1개월구매하기</th>
								<th>1개월구독하기</th>
								<th>이벤트가(~5/31)</th>
								<th>결제하기</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>스타1</td>
								<td>20건</td>
								<td>0월</td>
								<td>0원</td>
								<td>0원</td>
								<td>-</td>
							</tr>
							<tr>
								<td>스타2</td>
								<td>40건</td>
								<td>14,900원</td>
								<td>11,900원</td>
								<td>9,900원</td>
								<td><b class="on_btn" href="#pop_up" title="알림"><?=$link_url?></td>
							</tr>
							<tr>
								<td>스타3</td>
								<td><?=$payAmount[2][1]?>건</td>
								<td><?=number_format($payAmount[2][2])?>원</td>
								<td><?=number_format($payAmount[2][3])?>원</td>
								<td><?=number_format($payAmount[2][4])?>원</td>
								<td><b class="on_btn" href="#pop_up" title="알림"><?=$link_url?></td>
							</tr>
							<tr>
								<td>스타4</td>
								<td><?=$payAmount[3][1]?>건</td>
								<td><?=number_format($payAmount[3][2])?>원</td>
								<td><?=number_format($payAmount[3][3])?>원</td>
								<td><?=number_format($payAmount[3][4])?>원</td>
								<td><b class="on_btn" href="#pop_up" title="알림"><?=$link_url?></td>
							</tr>
							<tr>
								<td>스타5</td>
								<td><?=$payAmount[4][1]?>건</td>
								<td><?=number_format($payAmount[4][2])?>원</td>
								<td><?=number_format($payAmount[4][3])?>원</td>
								<td><?=number_format($payAmount[4][4])?>원</td>
								<td><b class="on_btn" href="#pop_up" title="알림"><?=$link_url?></td>
							</tr>
							<tr>
								<td>스타6</td>
								<td><?=$payAmount[5][1]?>건</td>
								<td><?=number_format($payAmount[5][2])?>원</td>
								<td><?=number_format($payAmount[5][3])?>원</td>
								<td><?=number_format($payAmount[5][4])?>원</td>
								<td><b class="on_btn" href="#pop_up" title="알림"><?=$link_url?></td>
							</tr>
							<tr>
								<td>스타7</td>
								<td><?=$payAmount[6][1]?>건</td>
								<td><?=number_format($payAmount[6][2])?>원</td>
								<td><?=number_format($payAmount[6][3])?>원</td>
								<td><?=number_format($payAmount[6][4])?>원</td>
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
								<th>계약건수</th>
								<td>20</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td>0원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td>0원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
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
								<th>계약건수</th>
								<td><?=$payAmount[1][1]?>건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td><?=number_format($payAmount[1][2])?>원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td><?=number_format($payAmount[1][2])?>원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
								<td><?=number_format($payAmount[1][2])?>원</td>
							</tr>
							<tr>
								<th>결제하기</th>
								<td><b class="on_btn m" href="#pop_up" title="알림"><?=$link_url?></b></td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타3</h4>
					<span>(단위 원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>계약건수</th>
								<td><?=$payAmount[2][1]?>건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td><?=number_format($payAmount[2][2])?>원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td><?=number_format($payAmount[2][2])?>원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
								<td><?=number_format($payAmount[2][2])?>원</td>
							</tr>
							<tr>
								<th>결제하기</th>
								<td><b class="on_btn m" href="#pop_up" title="알림"><?=$link_url?></b></td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타4</h4>
					<span>(단위 원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>계약건수</th>
								<td><?=$payAmount[3][1]?>건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td><?=number_format($payAmount[3][2])?>원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td><?=number_format($payAmount[3][2])?>원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
								<td><?=number_format($payAmount[3][2])?>원</td>
							</tr>
							<tr>
								<th>결제하기</th>
								<td><b class="on_btn m" href="#pop_up" title="알림"><?=$link_url?></b></td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타5</h4>
					<span>(단위 원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>계약건수</th>
								<td><?=$payAmount[4][1]?>건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td><?=number_format($payAmount[4][2])?>원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td><?=number_format($payAmount[4][2])?>원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
								<td><?=number_format($payAmount[4][2])?>원</td>
							</tr>
							<tr>
								<th>결제하기</th>
								<td><b class="on_btn m" href="#pop_up" title="알림"><?=$link_url?></b></td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타6</h4>
					<span>(단위:원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>계약건수</th>
								<td><?=$payAmount[5][1]?>건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td><?=number_format($payAmount[5][2])?>원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td><?=number_format($payAmount[5][2])?>원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
								<td><?=number_format($payAmount[5][2])?>원</td>
							</tr>
							<tr>
								<th>결제하기</th>
								<td><b class="on_btn m" href="#pop_up" title="알림"><?=$link_url?></b></td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="fare_guide_mo">
					<h4>스타7</h4>
					<span>(단위:원, 부가세 포함)</span>
					<table>
						<thead>
							<tr>
								<th>계약건수</th>
								<td><?=$payAmount[6][1]?>건</td>
							</tr>
							<tr>
								<th>1개월구매하기</th>
								<td><?=number_format($payAmount[6][2])?>원</td>
							</tr>
							<tr>
								<th>구독하기</th>
								<td><?=number_format($payAmount[6][2])?>원</td>
							</tr>
							<tr>
								<th>이벤트가(~5/31)</th>
								<td><?=number_format($payAmount[6][2])?>원</td>
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
					<br />· 계약건수 20건 이하(스타1 등급)는 영구적으로 무료 이용 가능합니다.
					<br />	· 구매하신 상품은 '결제문의' 페이지에서 결제 수단 변경 또는 상품해지를 신청할 수 있습니다.
					<br />	· 자동결제 상품을 해지한 경우 해당 서비스 만료일까지 사용하실 수 있습니다.</b>
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
