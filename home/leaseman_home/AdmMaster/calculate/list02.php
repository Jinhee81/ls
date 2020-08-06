<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="정산관리" data-title="입금리스트">입금리스트</h2>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">입금일</label>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>
						<select name="" id="" class=" mar_r10">
							<option value="">등급</option>
							<option value="">일반</option>
							<option value="">화이트</option>
							<option value="">실버</option>
							<option value="">골드</option>
							<option value="">VIP</option>
						</select>
						<select name="" id="" class=" mar_r10">
							<option value="">증빙구분</option>
						</select>
						<select name="" id="" class=" mar_r10">
							<option value="">결제방법</option>
						</select>
						<select name="" id="" class=" mar_r10">
							<option value="">회원번호</option>
							<option value="">회원명</option>
							<option value="">아이디</option>
						</select>
						<input type="text" class="wd_200 mar_r10">
						<button type="button" class="lookup_btn">검색</button>
					</fieldset>
				</form>
			</div>
			<div class="com_info_tb">
				<ul>
					<li>
						<strong class="blue">총 0건</strong> / 금액 00원
					</li>
				</ul>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>정산관리</caption>
					<colgroup>
						<col  width="50px;"/>
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>입금일</th>
							<th>회원번호</th>
							<th>회원구분</th>
							<th>회원명</th>
							<th>아이디</th>
							<th>사업자번호<br />(생년월일)</th>
							<th>일반전화</th>
							<th>휴대폰</th>
							<th>등급</th>
							<th>증빙구분</th>
							<th>결제방법</th>
							<th>추천인아이디</th>
							<th>금액</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>110</td>
							<td>2017-03-24</td>
							<td>100009</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>일반</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>109</td>
							<td>2017-03-24</td>
							<td>100008</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>화이트</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>108</td>
							<td>2017-03-24</td>
							<td>100007</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>실버</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>107</td>
							<td>2017-03-24</td>
							<td>100006</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>골드</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>106</td>
							<td>2017-03-24</td>
							<td>100005</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>VIP</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>105</td>
							<td>2017-03-24</td>
							<td>100004</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>골드</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>104</td>
							<td>2017-03-24</td>
							<td>100003</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>VIP</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>103</td>
							<td>2017-03-24</td>
							<td>100002</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>화이트</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
						<tr>
							<td>102</td>
							<td>2017-03-24</td>
							<td>100001</td>
							<td></td>
							<td>비즈피스(유진희)</td>
							<td>sales01</td>
							<td>60000-20-100000</td>							
							<td>02-0000-0000</td>
							<td>010-0000-0000</td>
							<td>VIP</td>
							<td>현금영수증</td>
							<td>자동이체</td>
							<td></td>
							<td>4900</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
