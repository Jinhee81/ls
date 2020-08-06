<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2"  data-type="환경설정" data-title="관리자관리">관리자관리</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">가입일</label>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>
					</fieldset>
				</form>
			</div>
			<div class="com_btn_box">				
				<div class="right">
					<button type="button" class="blue_btn" onClick="pops_04btn();">관리자 추가</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>관리자관리 표</caption>
					<colgroup>
						
					</colgroup>
					<thead>
						<tr>
							<th>아이디</th>
							<th>이름</th>
							<th>연락처</th>
							<th>권한</th>
							<th>가입일</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">AdmMasterin</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리, 환경설정</td>
							<td>2017-03-22</td>
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리, 환경설정</td>
							<td>2017-03-22</td>							
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리, 환경설정</td>
							<td>2017-03-22</td>
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리, 환경설정</td>
							<td>2017-03-22</td>
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리</td>
							<td>2017-03-22</td>							
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리</td>
							<td>2017-03-22</td>							
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리, 정산관리</td>
							<td>2017-03-22</td>							
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리</td>
							<td>2017-03-22</td>							
						</tr>
						<tr>
							<td><a href="list02_mod.php" class="a_color01">store</a></td>
							<td><a href="list02_mod.php" class="a_color01">관리자</a></td>
							<td><a href="list02_mod.php" class="a_color01">010-9999-9999</a></td>
							<td>회원관리, 데이터조회,  게시판관리</td>
							<td>2017-03-22</td>							
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
