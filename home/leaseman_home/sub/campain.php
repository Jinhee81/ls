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
						<img src="../img/main/main_visual_img01.png">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">		
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="main_tit">
					<h1>이벤트 소개</h1>
					<span>아빠 엄마 이벤트 안내입니다.</span>
				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->	
	
</body>
</html>
