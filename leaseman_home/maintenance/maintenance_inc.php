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
				유지보수         
			</li>
			<li class="loc_active"></li>
		</ul>
		<h1></h1>
		<b>A/S center <br />전국각지의 서비스센터 상세정보를 손쉽게 찾아보실 수 있습니다.   </b>
		<? if($basename == "store.php" or $basename == "store_view.php"){?>		
		<a href="repair.php" class="sub_pagelink leftlink">통합유지보수</a>
		<?} else if($basename == "repair.php"){?>
		<a href="store.php" class="sub_pagelink rightlink">지역별 서비스 센터</a>
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
	$("#gnb .gnb_list > li").eq(4).addClass("active");
	var tit = $(".sub_tit h2").text();
	$(".sub_visual h1").text(tit);
	$(".loc_active").text(tit);
	//console.log(tit);
});
</script>
<link href="maintenance.css" rel="stylesheet" type="text/css"/>
