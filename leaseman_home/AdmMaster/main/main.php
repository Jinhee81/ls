<?php
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리">회원리스트</h2>
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
					<caption>고객리스트 표</caption>
					<colgroup>
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>회원코드</th>
							<th>아이디</th>
							<th>사업자/개인</th>
							<th>형태</th>
							<th>사업자명/이름</th>
							<th>휴대폰</th>	
							<th><span class="color01">유/무료</span></th>
							<th>회원등급</th>
							<th>수납방법</th>
							<th>가입일</th>
							<th>탈퇴일</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>40</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>39</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>38</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>37</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>36</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>35</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>34</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>33</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>무료회원</td>
							<td>무료</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>-</td>
						</tr>
						<tr>
							<td>32</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>유료회원</td>
							<td>VIP</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>2017-03-19</td>
						</tr>
						<tr>
							<td>31</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>유료회원</td>
							<td>VIP</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>2017-03-19</td>
						</tr>
						<tr>
							<td>30</td>
							<td>100019</td>
							<td>sales29</td>
							<td>개인</td>
							<td>주택</td>
							<td>홍길동29</td>
							<td>010-0000-0019</td>
							<td>유료회원</td>
							<td>VIP</td>
							<td>자동이체</td>
							<td>2016-01-20</td>
							<td>2017-03-19</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/adm/inc/footer_inc.php";?>
