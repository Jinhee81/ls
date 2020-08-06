<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="환경설정">건물관리</h2>
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
							<option value="20">단문</option>
							<option value="50">장문</option>
							<option value="100">멀티</option>
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
			<div class="com_btn_box">
				<div class="left">
					<button type="button" class="btn_arrow"><i class="fa fa-caret-up" aria-hidden="true"></i></button>
					<button type="button" class="btn_arrow"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
				</div>
				<div class="right">
					<button type="button" class="blue_btn">추가</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>건물관리 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>형태</th>
							<th>건물별명</th>
							<th>우편번호</th>
							<th>소재지</th>
							<th><span class="color01">방/좌석(개)</span></th>
							<th><span class="color01">선불후불</span></th>
							<th><span class="color01">보안시설</span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>2</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>3</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>4</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>5</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>6</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>7</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>8</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>9</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>10</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
