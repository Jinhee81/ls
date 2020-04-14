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
				<div class="sub_visual four">
					<h2>리스맨 동영상</h2>
					<b>리스맨의 사용법을 동영상으로 쉽게!</b>
					<p>사용자를 최우선으로 고려한 리스맨의  
					<br />다양한 기능을 확인하세요!</b>
				</div>
				<div class="video_view">
					<table>
						<thead>
							<tr>
								<th>글쓴이</th>
								<td>관리자</td>
								<th>이메일</th>
								<td>3333@naver.com</td>
							</tr>
							<tr>
								<th>작성일</th>
								<td>2017.07.18</td>
								<th>조회수</th>
								<td>10</td>
							</tr>
							<tr>
								<th>제목</th>
								<td colspan="3">리스맨 어디까지 써봤니?</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="4">리스맨의 장점을 소개합니다</td>
							</tr>
						</tbody>
					</table>
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
