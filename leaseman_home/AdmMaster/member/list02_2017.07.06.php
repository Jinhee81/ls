<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리" data-title="이벤트조회">이벤트조회</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<span class="csb_tit">발생일 From ~ To</span>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>
						<select name="" id="" class=" mar_r10">
							<option value="">이벤트명콤보</option>
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
			
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>이벤트조회 표</caption>
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
							<th>이벤트발생일</th>
							<th>이벤트명</th>
							<th>등급</th>
							<th>내용</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>40</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>등급변경</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>39</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>회원가입</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>38</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>등급변경</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>37</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>회원가입</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>36</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>등급변경</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>35</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>회원가입</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>34</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>등급변경</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>33</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>회원가입</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>32</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>등급변경</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>31</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>회원가입</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
						<tr>
							<td>30</td>
							<td>sale01</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a><!-- 8자리 --></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>2017-02-23</td>
							<td>등급변경</td>
							<td>골드</td>
							<td>개인->사업자</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
