<?php
   $basename=basename($_SERVER["PHP_SELF"]); //현재 실행되고 있는 페이지명만 구합니다.
?>
<div class="sub_visual">	
	<div class="wrap_1000">
		<ul class="visual_tab">
			<li>
				<img src="../img/ico/home_icon.png" alt="홈이미지">
			</li>
			<li>
				솔루션
			</li>
			<li class="loc_active"></li>
		</ul>
		<h1></h1>
		<b>다양한 화면분활 및 디스플레이의 효율적 관리 시스템
		<br />윈도우형 컨텐츠 관리 프로그램</b>
		<? if($basename == "window.php"){?>
		<a href="and.php" class="sub_pagelink rightlink">안드로이드 지원</a>
		<?} else if($basename == "and.php"){?>
		<a href="window.php" class="sub_pagelink leftlink">윈도우 지원</a>
		<?}?>
	</div>
</div>
<!-- <div class="sub_tab">	
	<ul class="sub_tab_menu">
		<li><a href="#" class="active"></a></li>
		<li><a href="#" ></a></li>
	</ul>
</div> -->

<script type="text/javascript">
$(document).ready(function(){
	$("#gnb .gnb_list > li").eq(1).addClass("active");
	var tit = $(".sub_tit h2").text();
	$(".sub_visual h1").text(tit);
	$(".loc_active").text(tit);
	//console.log(tit);
});
</script>
<link href="solution.css" rel="stylesheet" type="text/css"/>
