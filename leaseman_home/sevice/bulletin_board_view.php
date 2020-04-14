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
			<? include('../sevice/sub_nav_03.php');?>
			<div class="wrap_1000">
				<div class="sub_visual six">
					<h2>후기게시판</h2>
					<b>리스맨 후기 게시판</b>
					<p>리스맨 사용 후 후기를 올려 주시는 게시판 입니다. 
					<br />당신의 경험을 공유해 주세요.</b>
				</div>
				<div class="notice_view one">	
					<table>
						<legend>공지사항_뷰</legend>
						<thead>
							<tr>
								<th>제목</th>
								<td>리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.</td>
								<th>작성일</th>
								<td>2017.06.25</td>
							</tr>
						</thead>	
						<tbody>	
							<tr>
								<th>글쓴이</th>
								<td>박지애</td>
								<th>조회수</th>
								<td>205</td>
							</tr>
							<tr>
								<td colspan="4">	
									<br />리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.
									<br />리스맨 이용약관 변동 안내
									<br />리스맨 우수회원들을 위한 2017년 7월 프로모션 
									<br /> 서비스 개선 안내 17.03.10(금) 00:00 ~ 04:00
									<br />리스맨 시스템 점검안내 17.02.21(화) 04:00 ~ 05:00
									<br />리스맨우수회원들을 위한 한달무료 프로모션" 할인 안내
									<br />리스맨 우수회원들을 위한 2017년 7월 프로모션 
									<br />리스맨 서비스 개선 안내 17.03.10(금) 00:00 ~ 04:00
									<br />리스맨 시스템 점검안내 17.02.21(화) 04:00 ~ 05:00
									<br />리스맨우수회원들을 위한 한달무료 프로모션" 할인 안내
								<td>
							</tr>
						</tbody>	
					</table>
					<b class="on_btn">
						<a href="../sevice/notice.php">목록으로</a>
					</b>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$("#gnb > ul > li").eq(3).addClass("active");
});
</script>
