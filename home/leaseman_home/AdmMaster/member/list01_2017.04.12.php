<?php
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리" data-title="회원리스트">회원리스트</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<select name="" id="" class="mar_r10">
							<option value="">가입일</option>
							<option value="">탈퇴일</option>
						</select>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>
						<select name="" id="" class="mar_r10">
							<option value="">등급</option>
						</select>
						<select name="" id="" class="mar_r10">
							<option value="">수납방법</option>
						</select>
						<select name="" id="" class="mar_r10">
							<option value="">회원번호</option>
							<option value="">회원명</option>
							<option value="">추천인아이디</option>
						</select>
						<input type="text" class="wd_200 mar_r10">
						<button type="button" class="lookup_btn">검색</button>
					</fieldset>
				</form>
			</div>
			<div class="com_btn_box">
				<div class="right">
					<!-- <button type="button" class="blue_btn">사업자/개인변경</button> -->
					<button type="button" class="blue_btn" onClick="pops_05btn();">회원추가</button>
					<button type="button" class="gray_btn" onClick="pops_01_1btn();">문자메시지</button>
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>회원리스트 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" id="cklist_00" class="all_check"><label for="cklist_00"></label></th>
							<th>순번</th>
							<th>회원번호</th>
							<!-- <th>아이디</th>
							<th>사업자/개인</th>-->
							<th>회원명</th>
							<th>회원구분</th>
							<th>사업자번호(생년월일)</th>
							<th>일반전화</th>	
							<th>휴대폰</th>	
							<th>우편번호</th>	
							<th>주소</th>
							<th>이메일</th>
							<th>추천인아이디</th>
							<th>등급</th>
							<th>수납방법</th>
							<th>건물수</th>
							<!-- <th>아이디수</th> -->
							<th>사용정보</th>
							<th>가입일</th>
							<th>탈퇴일</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" id="cklist_01"><label for="cklist_01"></label></td>
							<td>40</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_02"><label for="cklist_02"></label></td>
							<td>39</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_03"><label for="cklist_03"></label></td>
							<td>38</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_04"><label for="cklist_04"></label></td>
							<td>37</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_05"><label for="cklist_05"></label></td>
							<td>36</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_06"><label for="cklist_06"></label></td>
							<td>35</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_07"><label for="cklist_07"></label></td>
							<td>34</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_08"><label for="cklist_08"></label></td>
							<td>33</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_09"><label for="cklist_09"></label></td>
							<td>32</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_10"><label for="cklist_10"></label></td>
							<td>31</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="cklist_11"><label for="cklist_11"></label></td>
							<td>30</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/adm/inc/footer_inc.php";?>
