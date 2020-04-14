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
				<div class="sub_visual seven">
					<h2>문의게시판</h2>
					<b>리스맨에 질문하세요!</b>
					<p>리스맨에 대해서 궁금하신 점이 있으시면
					<br />언제든지 문의해주세요. 빠르게 도와드리겠습니다!</b>
				</div>
				<div class="inquiry">
					<form>	
						<table>
							<legend>문의 게시판</legend>
							<thead>
								<tr>
									<th>상담유형</th>
									<td>
										<select>선택해주세요
										<option>선택해주세요</option>
										<option>선택해주세요</option></select>
									</td>
								</tr>
								<tr>
									<th>글쓴이</th>
									<td>
										<input type="text">
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td>
										<input type="text" class="title_input">
									</td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea>
										</textarea>
									</td>
								</tr>
								<tr>
									<th>이메일</th>
									<td>
										<input type="email" placeholder="crazy830727@naver.com">
									</td>
								</tr>
								<tr>
									<th>연락처</th>
									<td>
										<select><option>010</option>
												<option>070</option>
												<option>02</option>
										</select>
										 <span> -  </span>
										<input type="number">
										 <span> -  </span>
										<input type="number">
									</td>
								</tr>
							</thead>
						</table>
					<form>
					<b class="on_btn">
						<a href="#!">문의하기</a>
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
