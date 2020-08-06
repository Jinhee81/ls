<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="viewPage">
				<div class="com_hbox">
					<h2 class="com_h2" data-type="데이터조회" data-title="고객리스트">고객리스트</h2>
					<ul class="right">
						<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
						<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
					</ul>
				</div>
				<div class="com_btn_box">
					<div class="right">
						<button type="button" class="gray_btn" onClick="pops_07btn();">회원정보 삭제</button>
					</div>
				</div>
				<div class="com_tb01">
					<table class="ta_view01">
						<caption>고객리스트 상세정보</caption>
						<colgroup>
							<col width="13%">	
							<col width="37%">	
							<col width="13%">	
							<col width="37%">	
						</colgroup>
						<tbody>
							<tr>
								<th>회원코드</th>
								<td>1004</td>
								<th>아이디</th>
								<td>sales14</td>
							</tr>
							<tr>
								<th>사업자/개인</th>
								<td>
									<select name="" id="" class="wh100">
										<option value="개인">개인</option>	
										<option value="사업자">사업자</option>	
									</select>
								</td>
								<th>가입일</th>
								<td>2016-05-10</td>
							</tr>
						</tbody>
					</table>
					<br />
					<div class="view_box">
						<h3>고객</h3>
						<table class="ta_list01">
							<caption>고객</caption>
							<colgroup>
							</colgroup>
							<thead>
								<tr>
									<th>상태</th>
									<th>고객명</th>
									<th>계약회차</th>
									<th>상품</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="view_box">
						<h3>스케줄 계약</h3>
						<table class="ta_list01">
							<caption>스케줄 계약</caption>
							<colgroup>
							</colgroup>
							<thead>
								<tr>
									<th>상태</th>
									<th>고객명</th>
									<th>계약회차</th>
									<th>상품</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="view_box">
						<h3>기타 계약</h3>
						<table class="ta_list01">
							<caption>기타 계약</caption>
							<colgroup>
							</colgroup>
							<thead>
								<tr>
									<th>상태</th>
									<th>고객명</th>
									<th>계약회차</th>
									<th>상품</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
								<tr>
									<td>종료</td>
									<td>박세현</td>
									<td>1회차</td>
									<td>기본</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="list01.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
