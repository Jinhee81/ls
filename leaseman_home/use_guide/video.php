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
				<div class="video">
					<ul>
						<li>
							<a href="../use_guide/video_view.php">
								<div class="video_box">
								</div>
								<div class="video_txt">
									<b>리스맨 사용법</b>
									<p>리스맨 어디까지 사용해 봤니?</p>
									<span>2017.06.26</span>
								</div>
							</a>
						</li>
						<li>
							<a href="#!">
								<div class="video_box">
								</div>
								<div class="video_txt">
									<b>리스맨 사용법</b>
									<p>리스맨 어디까지 사용해 봤니?</p>
									<span>2017.06.26</span>
								</div>
							</a>
						</li>
						<li>
							<a href="#!">
								<div class="video_box">
								</div>
								<div class="video_txt">
									<b>리스맨 사용법</b>
									<p>리스맨 어디까지 사용해 봤니?</p>
									<span>2017.06.26</span>
								</div>
							</a>
						</li>
						<li>
							<a href="#!">
								<div class="video_box">
								</div>
								<div class="video_txt">
									<b>리스맨 사용법</b>
									<p>리스맨 어디까지 사용해 봤니?</p>
									<span>2017.06.26</span>
								</div>
							</a>
						</li>
						<li>
							<a href="#!">
								<div class="video_box">
								</div>
								<div class="video_txt">
									<b>리스맨 사용법</b>
									<p>리스맨 어디까지 사용해 봤니?</p>
									<span>2017.06.26</span>
								</div>
							</a>
						</li>
						<li>
							<a href="#!">
								<div class="video_box">
								</div>
								<div class="video_txt">
									<b>리스맨 사용법</b>
									<p>리스맨 어디까지 사용해 봤니?</p>
									<span>2017.06.26</span>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="paging">
					<ul>
						<li><a href="#!"><img src="../img/btn/prev_left.png"></a></li>
						<li class="left_paging"><a href="#!"><img src="../img/btn/prev.png"></a></li>
						<li><a href="#!"  class="active">1</a></li>
						<li><a href="#!">2</a></li>
						<li><a href="#!">3</a></li>
						<li><a href="#!">4</a></li>
						<li class="right_paging"><a href="#!"><img src="../img/btn/next.png"></a></li>
						<li><a href="#!"><img src="../img/btn/next_right.png"></a></li>
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
