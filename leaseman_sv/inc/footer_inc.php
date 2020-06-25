		<link href="/preference/preference.css" rel="stylesheet" type="text/css">

		<?
			$sql_gui = " select * from tbl_guide where idx='1' ";
			$result_gui = mysql_query($sql_gui) or die (mysql_error());
			$row_gui=mysql_fetch_array($result_gui);

		?>

		<section id="footer">
			<div class="footer_tit">
				<div class="footer_site_link">
					<ul>
						<li>
							<a href="http://as82.kr/leaseman/" target="blank_" alt="원격지원 바로가기">원격지원</a>
						</li>
						<li>
							<a href="https://open.kakao.com/o/sZsgqby" target="blank_" alt="카톡문의 바로가기">카톡문의</a>
						</li>
						<!-- <li>
							<a href="https://www.leaseman.co.kr/about/company_introduction.php" target="blank_" alt="회사소개 바로가기">회사소개</a>
						</li> -->
						<li>
							<!--
							<a href="/include/dn_guide.php?mode=home&ufile=<?=$row_gui['logos']?>&rfile=<?=$row_gui['logos']?>" target="_blank" alt="이용가이드(PDF) 바로가기">이용가이드(PDF)</a>
							-->
							<a href="/data/home/<?=$row_gui['logos']?>" target="_blank" alt="이용가이드(PDF) 바로가기">이용가이드(PDF)</a>
						</li>
						<!-- <li>
							<a href="http://leaseman.co.kr/_bbs/board_list.php?code=h_movie" target="blank_" alt="이용가이드(동영상) 바로가기">이용가이드(동영상)</a>
						</li> -->
					</ul>
				</div>
				<p class="adress">Copyright (c) 2016 bizffice. All Rights Reserved.</p>
			</div>
		</section><!--footer_end-->

		<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pops_inc.php";?><!-- 팝업창 모음 -->
	</div><!--wrap_end-->
</body>
</html>
