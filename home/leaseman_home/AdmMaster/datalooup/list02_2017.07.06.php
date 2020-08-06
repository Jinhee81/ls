<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="데이터관리" data-title="건물리스트">건물리스트</h2>
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
						<select name="" id="" class="mar_r10">
							<option value="">회원번호</option>
							<option value="">회원명</option>
							<option value="">아이디</option>
							<option value="">주소</option>
						</select>
						<input type="text" class="wd_200 mar_r10">
						<button type="button" class="lookup_btn">검색</button>
					</fieldset>
				</form>
			</div>

			<div class="com_tb01">
				<table class="ta_list01">
					<caption>건물리스트 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>아이디</th>
							<th>회원번호</th>
							<th>회원구분</th>
							<th>회원명</th>
							<th>가입일</th>
							<th>형태</th>
							<th></th>
							<th>건물별명</th>
							<th>우편번호</th>
							<th>주소</th>
							<th>방/좌석개수</th>
							<th>선불/후불</th>
							<th>보안시설</th>
							<th>사업자정보</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>40</td>
							<td>sales29</td>
							<td>100019</td>
							<td>사업자</td>
							<td>비즈피스(유진희)</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>39</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>38</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>37</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>36</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>35</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>34</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>33</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>32</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>31</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
						<tr>
							<td>30</td>
							<td>sales29</td>
							<td>100019</td>
							<td>개인</td>
							<td>유진희</td>
							<td>2016-01-20</td>
							<td>주택</td>
							<td>1/6</td>
							<td>비즈피스룸</td>
							<td>11726</td>
							<td>경기도 의정부시 장암동 160-9</td>
							<td>10개</td>
							<td>선불</td>
							<td>ADT</td>
							<td><a href="javascript:pops_03btn();">보기</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
