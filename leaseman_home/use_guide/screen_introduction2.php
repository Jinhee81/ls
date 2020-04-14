<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc2.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<? include('../use_guide/sub_nav_021.php');?>
			<div class="wrap_1000">
				<div class="sub_visual four">
					<h2>화면 소개</h2>
					<b>화면소개 및 다양한 기능 소개</b>
					<p>사용자를 최우선으로 고려한 리스맨의
					<br />다양한 기능을 확인하세요!</b>
				</div>
				<div class="introduction">
					<ul>
						<li>
							<b>1.고객리스트</b>
							<img src="../img/sub/introduction_img01.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>2.계약등록</b>
							<img src="../img/sub/introduction_img02.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>3.계약관리</b>
							<img src="../img/sub/introduction_img03.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>4.계약 리스트</b>
							<img src="../img/sub/introduction_img04.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>5.기타계약 리스트</b>
							<img src="../img/sub/introduction_img05.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>6.입금예정 리스트</b>
							<img src="../img/sub/introduction_img06.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>7.입금 리스트</b>
							<img src="../img/sub/introduction_img07.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>8.보증금 조회</b>
							<img src="../img/sub/introduction_img08.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>9.월별회계 조회</b>
							<img src="../img/sub/introduction_img09.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>10.연도별회계 조회</b>
							<img src="../img/sub/introduction_img10.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>11.월간스케줄</b>
							<img src="../img/sub/introduction_img11.png" alt="고객리스트 화면 이미지">
						</li>
						<li>
							<b>12.방좌석현황</b>
							<img src="../img/sub/introduction_img12.png" alt="고객리스트 화면 이미지">
						</li>
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
	$("#gnb > ul > li").eq(1).addClass("active");
});
</script>
