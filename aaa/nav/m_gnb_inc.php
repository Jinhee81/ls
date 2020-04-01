<?
	if($_SESSION['member']['id']){
		$login_id ="?login_ckeck=".$_SESSION['member']['id'];
	}else
		$login_id ="";
		
?>


<ul class="gnb_wrap">
	<?if(!$check_login){?>
	<li>
		<div class="login_wrap">
			<p>로그인 해주세요!</p>
			<div>	
				<b><a href="../membership/login.php">로그인</a></b>
				<b><a href="../membership/membership.php">회원가입</a></b>
			</div>	
		</div>
	</li>
	<?}else{?>
	<li>
		<div class="login_wrap">
			<p>리스맨에 오신것을 환영합니다!</p>
			<div>	
				<b><a href="../membership/logout.php">로그아웃</a></b>
				<b><a href="../membership/re_member.php">정보수정</a></b>
			</div>	
		</div>
	</li>
	<?}?>
	<li>
		<a href="#!">ABOUT 리스맨</a>	
			<ul class="depth02_list one">
				<li><a href="../about/about_leaseman.php">- 리스맨이란?</a></li>
				<li><a href="../about/leaseman_effect.php">- 리스맨 효과</a></li>
				<li><a href="../about/company_introduction.php">- 회사소개</a></li>
			</ul>
	</li>
	<li>
		<a href="#!">이용안내</a>
			<ul class="depth02_list two">
				<li><a href="../use_guide/fare_guide.php">- 요금 안내</a></li>
				<li><a href="../use_guide/screen_introduction.php">- 화면 소개</a></li>
				<li><a href="/_bbs/board_list.php?code=h_faq">- 리스맨 매뉴얼</a></li>
				<li><a href="/_bbs/board_list.php?code=h_movie">- 동영상 매뉴얼</a></li>
			</ul>
	</li>
	<li>
		<a href="#!">체험하기</a>
		<ul class="depth02_list two">
			<li><a href="http://sv.leaseman.co.kr" target="_blank">- 체험하기</a></li>
		</ul>
	</li>
	<li>
		<a href="#!">고객센터</a>
			<ul class="depth02_list three">
				<li><a href="/_bbs/board_list.php?code=h_notice">- 공지사항</a></li>
				<li><a href="/_bbs/board_list.php?code=h_after">- 후기게시판</a></li>
				<li><a href="/_bbs/board_write.php?code=h_qna">- 문의게시판</a></li>
			</ul>
	</li>
	<!--<li>
		<p id="<?if(!$is_member){echo "open_on";}else{echo "open_out";}?>"><?if(!$is_member){echo "LOGIN";}else{echo "LOG OUT";}?> <img src="../img/ico/log_on.png"></p>
	</li>-->
</ul>