<body>

	<div id="ajax_loader" class="wrap-loading display-none">
		<div><img src="/js/ajax-loader.gif"/></div>
	</div>


	<div id="wrap">
		<header>
			<div class="header_wrap">
				<div class="pc_header">
					<h1><a href="../index.php"><img src="/img/ico/logo.png" alt="리스맨 로고"></a></h1>
					<div class="header_right">
						<div class="header_tp">
							<div class="login_on">
								<p class="hi_text"><?=$_SESSION[member][name]?> 님 안녕하세요</p>
								<a href="/AdmMaster/logout.php" class="logout_a">로그아웃</a>
							</div>
						</div>
						<nav class="header_nav">
							<ul class="nav_ul">
								<!-- <li class="nav_1dp">
									<a href="../member/list01.php">회원관리</a>
									<ul class="nav_ul2">
										<li><a href="../member/list01.php">회원리스트</a></li>
										<li><a href="../member/outmember.php">탈퇴회원리스트</a></li>
										<li><a href="../member/list02.php">이벤트조회</a></li>
										<li><a href="../sms/list.php">보낸문자리스트</a></li>
									</ul>
								</li> -->
								<li class="nav_1dp">
									<a href="../_bbs/board_list.php?code=h_faq">리스맨매뉴얼</a>
									<ul class="nav_ul2">
										<li><a href="../_bbs/board_list.php?code=h_faq">리스맨매뉴얼</a></li>
										<li><a href="../_bbs/board_list.php?code=h_movie">동영상매뉴얼</a></li>
									</ul>
								</li>
								<li class="nav_1dp">
									<a href="../_bbs/board_list.php?code=h_notice">게시판관리</a>
									<ul class="nav_ul2">
										<li><a href="../_bbs/board_list.php?code=h_notice">공지사항</a></li>
										<li><a href="../_bbs/board_list.php?code=h_qna">문의게시판</a></li>
										<li><a href="../_bbs/board_list.php?code=h_after">후기게시판</a></li>
									</ul>
								</li>
								<li class="nav_1dp">
									<a href="../setting/list02.php">환경설정</a>
									<ul class="nav_ul2">
										<li><a href="../setting/list04.php">팝업관리</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header><!--header_end-->