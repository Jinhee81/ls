<?php
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="viewPage">
				<div class="com_hbox">
					<h2 class="com_h2" data-type="회원관리" data-title="회원리스트">개인회원 상세정보</h2>
					<ul class="right">
						<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
						<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
					</ul>
				</div>
				<div class="com_btn_box">
					<div class="right">
						<button type="button" class="blue_btn" >사업자/개인변경</button>
						<button type="button" class="gray_btn" >탈퇴처리</button>
					</div>
				</div>
				<div class="com_tb01">
					<table class="ta_view01">
						<caption>개인회원 상세정보</caption>
						<colgroup>
							<col width="13%">	
							<col width="37%">	
							<col width="13%">	
							<col width="37%">	
						</colgroup>
						<tbody>
							<tr>
								<th>회원코드</th>
								<td>10001000<!-- 8자리 --></td>
								<th>우편번호</th>
								<td></td>
							</tr>
							<tr>
								<th>아이디</th>
								<td></td>
								<th>주소</th>
								<td></td>
							</tr>
							<tr>
								<th>사업자/개인</th>
								<td>
									<select name="" id="" class="wh100">
										<option value="법인">법인</option>	
										<option value="개인사업자">개인사업자</option>	
									</select>
								</td>
								<th>등급</th>
								<td>무료</td>
							</tr>
							<tr>
								<th>사업자번호(생년월일)</th>
								<td>111-11-1111</td>
								<th>추천아이디</th>
								<td></td>
							</tr>
							<tr>
								<th>사업자명</th>
								<td>비즈피스</td>
								<th>수납방법</th>
								<td></td>
							</tr>
							<tr>
								<th>대표자명(개인명)</th>
								<td>유진희</td>
								<th>건물수</th>
								<td><span class="td_un">1개</span></td>
							</tr>
							<tr>
								<th>일반전화</th>
								<td>00-0000-0000</td>
								<th>아이디수</th>
								<td><span class="td_un">1개</span></td>
							</tr>
							<tr>
								<th>휴대폰</th>
								<td>000-000-0000</td>
								<th>가입일</th>
								<td></td>
							</tr>
							<tr>
								<th>이메일</th>
								<td></td>
								<th>탈퇴일</th>
								<td></td>
							</tr>
						</tbody>
					</table>
					<div class="com_btn_box">
						<div class="center">
							<a href="list.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/adm/inc/footer_inc.php";?>
