<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리" data-title="보낸문자리스트">보낸문자리스트</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">전송일시</label>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>
						<select name="" id="" class=" mar_r10">
							<option value="">전체</option>
							<option value="">단문</option>
							<option value="">장문</option>
							<option value="">멀티</option>
						</select>
						<select name="" id="" class=" mar_r10">
							<option value="">전체</option>
							<option value="">성공</option>
							<option value="">실패</option>
						</select>
						<select name="" id="" class=" mar_r10">
							<option value="">회원명</option>
							<option value="">아이디</option>
							<option value="">휴대폰</option>
						</select>
						<input type="text" class="wd_200 mar_r10">
						<button type="button" class="lookup_btn">검색</button>
					</fieldset>
				</form>
			</div>
			<!-- <div class="com_btn_box">
				<div class="right">
					<button type="button" class="gray_btn" onclick="pops_01btn();">문자메시지</button>
				</div>
			</div> -->
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>문자리스트 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>유형</th>
							<th>전송일시</th>
							<th>회원번호</th>
							<th>회원구분</th>
							<th>회원명</th>
							<th>아이디</th>
							<th>휴대폰</th>
							<th>내용</th>
							<th>메시지</th>
							<th>상태</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>2</td>
							<td>장문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>실패</td>
						</tr>
						<tr>
							<td>3</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>4</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>5</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>6</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>7</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>8</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>9</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
						<tr>
							<td>10</td>
							<td>단문</td>
							<td>16-12-1 9:00</td>
							<td>100001</td>
							<td>사업자</td>
							<td>비즈피스</td>
							<td>Charm19</td>
							<td>010-0000-0010</td>
							<td>첫줄 내용... </td>
							<td><a href="javascript:pops_01btn();">보기</a></td>
							<td>성공</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
