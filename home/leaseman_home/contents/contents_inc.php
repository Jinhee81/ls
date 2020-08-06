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
				콘텐츠제작         
			</li>
			<li class="loc_active"></li>
		</ul>
		<h1></h1>
		<? if($basename == "solution.php"){?>
		<b>다양한 화면분활 및 디스플레이의 효율적 관리 시스템
		<br />윈도우형 컨텐츠 관리 프로그램</b>
		<a href="touch.php" class="sub_pagelink rightlink">터치 프로그램</a>
		<?} else if($basename == "touch.php"){?>
		<b>제품을 터치로 쓰실 경우는
		<br />별도로 인터렉티브한 프로그램이 필요합니다.</b>
		<a href="solution.php" class="sub_pagelink leftlink">솔루션</a>
		<a href="imageM.php" class="sub_pagelink rightlink">이미지제작</a>
		<?} else if($basename == "imageM.php"){?>
		<b>제품을 터치로 쓰실 경우는
		<br />별도로 인터렉티브한 프로그램이 필요합니다.</b>
		<a href="touch.php" class="sub_pagelink leftlink">터치 프로그램</a>
		<a href="customized.php" class="sub_pagelink rightlink">맞춤형 콘텐츠</a>
		<?} else if($basename == "customized.php"){?>
		<b>제품을 터치로 쓰실 경우는
		<br />별도로 인터렉티브한 프로그램이 필요합니다.</b>
		<a href="solution.php" class="sub_pagelink leftlink">솔루션</a>
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
	$("#gnb .gnb_list > li").eq(2).addClass("active");
	var tit = $(".sub_tit h2").text();
	$(".sub_visual h1").text(tit);
	$(".loc_active").text(tit);
	//console.log(tit);
});
</script>
<link href="contents.css" rel="stylesheet" type="text/css"/>
