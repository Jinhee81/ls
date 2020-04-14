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
				고객지원         
			</li>
		</ul>
		<h1>고객지원</h1>
		<b>감각적인 홍보매체! 성공적인 비즈니스! <br />JBDID의 다양한 DID시스템을 확인하세요.</b>
		
	</div>
</div>

<div class="sub_tab">	
	<ul class="sub_tab_menu">
		<li><a href="/cs/notice.php">공지사항</a></li>
		<li><a href="/cs/news.php" >뉴스</a></li>
		<li><a href="/cs/file.php" >자료실</a></li>
	</ul>
</div>


<script type="text/javascript">
$(document).ready(function(){
	//$("#gnb .gnb_list > li").eq(0).addClass("active");
	var tit = $(".sub_tit h2").text();
	//$(".sub_visual h1").text(tit);
	$(".loc_active").text(tit);
	//console.log(tit);
});
</script>
