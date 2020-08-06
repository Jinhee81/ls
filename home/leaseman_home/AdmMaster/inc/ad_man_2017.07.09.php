<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
?>
<section class="pops_wrap">	
	<div class="pops_box pops_04">
		<div class="pops_h">
			<h2>관리자 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>관리자 추가 / 수정</legend>
						<table class="ta_write01">
							<caption>관리자</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<!-- <tr>
									<th>사용여부</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">사용</label></span>
											<span><input type="radio" id="" name="" /> <label for="">숨김</label></span>
											<span><input type="radio" id="" name="" /> <label for="">삭제</label></span>
										</div>
									</td>
								</tr> -->
								<tr>
									<th>이름(실명)</th>
									<td><input type="text" id="" name="" value="운영자2"  /></td>
								</tr>
								<tr>
									<th>아이디</th>
									<td><input type="text" id="" name="" value="store03"  /></td>
								</tr>
								<!-- <tr>
									<th>비밀번호 재설정</th>
									<td><input type="password" id="" name=""   /></td>
								</tr> -->
								<tr>
									<th>비밀번호</th>
									<td><input type="password" id="" name=""   /></td>
								</tr>
								<tr>
									<th>이메일</th>
									<td><input type="email" id="" name="" value=" "  /></td>
								</tr>
								<tr>
									<th>휴대폰</th>
									<td class="ph">
										<input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  />
									</td>
								</tr>
								<tr>
									<th>권한설정</th>
									<td>
										<ul class="adm_setting">
											<li>
												<strong>회원관리</strong>
												<ul class="depth02">
													<li><input type="checkbox" id="" name="" /> <label for="">회원리스트</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">탈퇴회원리스트</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">이벤트조회</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">보낸문자리스트</label></li>
												</ul>
											</li>
											<li>
												<strong>데이터관리</strong>
												<ul class="depth02">
													<li><input type="checkbox" id="" name="" /> <label for="">건물리스트</label></li>
												</ul>
											</li>
											<li>
												<strong>게시판관리</strong>
												<ul class="depth02">
													<li><input type="checkbox" id="" name="" /> <label for="">공지사항</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">FAQ</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">1:1질문관리</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">자유게시판</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">자료실관리</label></li>
												</ul>
											</li>
											<li>
												<strong>정산관리</strong>
												<ul class="depth02">
													<li><input type="checkbox" id="" name="" /> <label for="">입금리스트</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">서비스사용내역</label></li>
												</ul>
											</li>
											<li>
												<strong>환경설정</strong>
												<ul class="depth02">
													<li><input type="checkbox" id="" name="" /> <label for="">관리자관리</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">푸쉬메시지관리</label></li>
													<li><input type="checkbox" id="" name="" /> <label for="">팝업관리</label></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">저장</button>
							<button type="button" class="gray">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>