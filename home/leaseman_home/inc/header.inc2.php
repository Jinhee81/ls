<body>
	<div id="wrap" class="gnbOn">
		<header id="header">
				<div class="top_menu">
					<div class="wrap_1000">
						<!-- <ul>
							<?if(!$check_login){?>
							<li><a href="../membership/login.php">로그인</a></li>
							<li><a href="../membership/membership.php">회원가입</a></li>
							<?}else{?>
							<li><a href="../membership/logout.php">로그아웃</a></li>
							<li><a href="../membership/re_member.php">정보수정</a></li>
							<?}?>
							<li><a href="https://blog.naver.com/leaseman_ad" target="_blank">블로그</a></li>
							<li><a href="http://as82.kr/leaseman/" target="_blank">원격지원</a></li>
						</ul> -->
						<ul>
							<li><a href="../membership/login.php">로그인</a></li>
							<li><a href="../membership/membership.php">회원가입</a></li>
							<li><a href="http://as82.kr/leaseman/" target="_blank">원격지원</a></li>
						</ul>
					</div>
				</div>
			<a href="#!" class="gnb_menu">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</a>
			<div class="header_body clearfix">
				<div class="wrap_1000">
					<h1 class="logo"><a href="../index.php"><img src="../img/ico/logo.png" alt="리스맨 로고" /></a></h1>
					<h1 class="m_logo"><a href="../index.php"><img src="../img/ico/m_logo.png" alt="리스맨 로고" /></a></h1>
					<nav id="gnb">
						<? include('../inc/gnb_inc2.php');?>
					</nav>
					<nav id="gnb_mo">
						<a href="../index.php" class="gnb_logo"><img src="../img/ico/m_logo2.png" alt="리스맨 로고" /></a>
						<? include('../inc/m_gnb_inc2.php');?>
					</nav>
				</div>
			</div>
		<div class="layer_bg"></div>
		</header><!--header_end-->
