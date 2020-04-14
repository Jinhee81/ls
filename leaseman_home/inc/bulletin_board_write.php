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
				<div class="sub_visual six">
					<h2>문의게시판</h2>
					<b>리스맨 후기 게시판</b>
					<p>리스맨 사용 후 후기를 올려 주시는 게시판 입니다. 
					<br />당신의 경험을 공유해 주세요.</b>
				</div>
				<div class="inquiry">
					<form>	
						<table>
							<legend>문의 게시판</legend>
							<thead>
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
