<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="데이터조회" data-title="고객리스트">사용건수팝업</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>
						<select name="" id="" class="wd_03 mar_r10">
							<option value="20">20개씩</option>
							<option value="50">50개씩</option>
							<option value="100">100개씩</option>
						</select>
						<select name="" id="" class="wd_03 mar_r10">
							<option value="전체">전체</option>	
							<option value="사업자">사업자</option>	
							<option value="개인">개인</option>	
						</select>
						<select name="" id="" class="wd_04 mar_r10">
							<option value="아이디">아이디</option>
							<option value="사업자명/이름">사업자명/이름</option>
							<option value="휴대폰">휴대폰</option>
						</select>
						<input type="text" class="wd_200 mar_r10">
						<button type="button" class="lookup_btn">검색</button>
					</fieldset>
				</form>
			</div>

			<div class="com_tb01">
				<table class="ta_list01">
					<caption>회원리스트 표</caption>
					<colgroup>
					</colgroup>
					<thead>
						<tr>
							<th>고객(명)<br /><span class="stxt">전체(진행/종료)</span></th>
							<th>스케줄계약(건)<br /><span class="stxt">전체(진행/종료)</span></th>
							<th>기타계약(건)<br /><span class="stxt">전체(진행/종료)</span></th>
							<th>세금계산서 발행수</th>
							<th>상용구수</th>
							<th>상품건수</th>
							<th>상품</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
						<tr>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">1(1/0)</a></td>
							<td><a href="view01.php">3(1/2)</a></td>
							<td></td>
							<td></td>
							<td>5</td>
							<td>기본</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
