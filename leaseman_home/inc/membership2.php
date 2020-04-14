<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="wrap_1000">	
				<div class="membership">
					<h2>회원가입</h2>
					<ul class="tab_menu">
						<li>
							<p>step01</p>
							<b>이용약관 동의</b>
						</li>
						<li  class="active">
							<p>step02</p>
							<b>상세정보 입력</b>
						</li>
						<li>
							<p>step03</p>
							<b>가입완료</b>
						</li>
					</ul>
					<form>
						<div class="membership2">
							<h3>상세정보 입력</h3>
							<table>
								<legend>상세정보 입력</legend>
								<thead>
									<tr>
										<th><span class="span_star">*</span>아이디</th>
										<td>
											<input type="text">
											<button type="button"><a href="#!">중복확인</a></button>
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>비밀번호</th>
										<td>
											<input type="password">
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>비밀번호 확인</th>
										<td>
											<input type="password">
										</td>
									</tr>
									<tr>
										<th>성명</th>
										<td>
											<input type="text">
										</td>
									</tr>
									<tr>
										<th>생년월일</th>
										<td>
											<select>
												<option>2000</option>
												<option>2000</option>
												<option>2000</option>
											</select>
											<p>년</p>
											<select>
												<option>12</option>
												<option>11</option>
												<option>10</option>
											</select>
											<p>월</p>
											<select>
												<option>30</option>
												<option>29</option>
												<option>28</option>
											</select>
											<p>일</p>
										</td>
									</tr>
									<tr>
										<th>주소</th>
										<td>
											<input type="text" class="input_address">
											<input type="text" class="input_address">
										</td>
									</tr>
									<tr>
										<th>연락처</th>
										<td>
											<select>
												<option>02</option>
												<option>031</option>
												<option>030</option>
											</select>
											<span>-</span>
											<input type ="number" class="input_number">
											<span>-</span>
											<input type ="number" class="input_number">
										</td>
									</tr>
									<tr>
										<th>휴대폰</th>
										<td>
											<select>
												<option>010</option>
											</select>
											<span>-</span>
											<input text="number" class="input_number">
											<span>-</span>
											<input text="number" class="input_number">
										</td>
									</tr>
									<tr>
										<th>이메일</th>
										<td>
											<input type="email" placeholder="예) crazy830727@naver.com">
										</td>
									</tr>
									<tr>
										<th>추천인 아이디</th>
										<td>
											<input type="text">
										</td>
									</tr>
									<tr>
										<th>가입경로</th>
										<td>
											<select>
												<option>인터넷</option>
												<option>신문</option>
											</select>
										</td>
									</tr>
								</thead>
							</table>
							<div class="btn_box">
							<b class="blue on_btn">
								<a href="../inc/membership3.php">회원가입</a>
							</b>
							<b class="on_btn">
								<a href="../main/main.php">취소</a>
							</b>
						</div>
						</div>
					</form>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->
</body>
</html>
