<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>	
<?
	if (get_device() == "P") { 
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
		<section id="container">		
			<div class="sub_visual">		
				<ul>
					<li>
						<img src="../img/main/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">		
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>인증샷 올리기</h1>
					<span>아빠 엄마 이벤트 안내입니다.</span>
				</div>
				<div class="notice_view_one">
					<div class="notice_hbox">
						<h3>
							아빠 엄마 이벤트 안내입니다.
						</h3>
						<p>등록일: 2016.03.09</p>
					</div>
					<div class="notice_content">
					</div>
						<div class="notice_list">
							<ul>
								<li>
									<p class="left">다음</p>
									<a href="" class="right"></a>
								</li>
								<li>
									<p class="left">이전</p>
									<a href="" class="right"></a>
								</li>
							</ul>
						</div>
					<ul class="btn_wrap2">
						<li><a href="../sub/proof_shot.php">목록으로</a></li>
					</ul>
				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->	
	
</body>
</html>
