<?
echo G5_POSTCODE_JS;    //다음 주소 js
?>

<section class="pops_wrap" style="display:none;">
	<!-- 문자메시지 -->
	<div class="pops_box pops_01" style="display:none;">
		<div class="pops_h">
			<h2>문자메시지</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01 com_pdv">
				<form action="">
					<fieldset>
						<legend>문자메시지 입력 양식</legend>
						<div class="sms_view">
							
							<div class="sms_viewbox">
								<form action="">
									<fieldset>
										<legend>메시지 보기 창</legend>
										<textarea name="" id=""></textarea>
										<p class="right_byte">0 / 90bytes</p>
										<ul class="sms_viewul">
											<li><p>이름</p><input type="text" value="박지애"></li>
											<li><p>수신번호</p><input type="text" value="010-9787-5168"></li>
											<li><p>발신번호</p><input type="text" value="010-9787-5168"></li>
										</ul>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">재전송</button>
							<button type="button" class="gray">닫기</button>
						</div>
					</fieldset>	
				</form>
			</div>
		</div>
	</div>
	<!-- 문자메시지 -->
	<div class="pops_box pops_01_1" style="display:none;">
		<div class="pops_h">
			<h2>문자메시지</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01 com_pdv">
				<form action="">
					<fieldset>
						<legend>문자메시지 입력 양식</legend>
						<div class="sms_view">
							
							<div class="sms_viewbox">
								<form action="">
									<fieldset>
										<legend>메시지 보기 창</legend>
										<textarea name="" id=""></textarea>
										<p class="right_byte">0 / 90bytes</p>
										<div class="sms_txt">
											<p class="tit01">회원명/건수</p>
											<p class="txt01">아무개1,아무개2,아무개3</p>
											<p class="txt02">총 3건</p>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">전송</button>
							<button type="button" class="gray">닫기</button>
						</div>
					</fieldset>	
				</form>
			</div>
		</div>
	</div>
	<!-- 공지사항 추가 -->
	<div class="pops_box pops_02" style="display:none;">
		<div class="pops_h">
			<h2>공지사항 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>공지사항 추가</legend>
						<table class="ta_write01">
							<caption>공지사항</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name=""> <label for="">사용</label></span>
											<span><input type="radio" id="" name=""> <label for="">숨김</label></span>
											<span><input type="radio" id="" name=""> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td>정우성</td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td>2016-11-30 17:00</td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text"  value="[공지] 비즈피스휴무" id="" name="" class="wd_full"></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="" id="" cols="40" rows="20"  class="wd_full">에디터는 추후 개발 작업 중에 들어갈예정입니다</textarea>
									</td>
								</tr>
								<tr>
									<th>첨부파일</th>
									<td><input type="file" id="" name="" /></td>
								</tr>
							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">등록</button>
							<button type="button" class="gray">닫기</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<!-- FAQ 추가 -->
	<div class="pops_box pops_02_1" style="display:none;">
		<div class="pops_h">
			<h2>FAQ 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>FAQ 추가</legend>
						<table class="ta_write01">
							<caption>FAQ</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name=""> <label for="">사용</label></span>
											<span><input type="radio" id="" name=""> <label for="">숨김</label></span>
											<span><input type="radio" id="" name=""> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td><input type="text"  value="admin" id="" name="" class="wd_200"></td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td><input type="text"  value="2016-11-30 17:00" id="" name="" class="wd_200"></td>
								</tr>
								<tr>
									<th>질문</th>
									<td><input type="text"  value="" id="" name="" class="wd_full"></td>
								</tr>
								<tr>
									<th>답변</th>
									<td>
										<textarea name="" id="" cols="40" rows="20"  class="wd_full"></textarea>
									</td>
								</tr>
								<tr>
									<th>첨부파일</th>
									<td><input type="file" id="" name="" /></td>
								</tr>
							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">등록</button>
							<button type="button" class="gray">닫기</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<!-- 자료 추가 -->
	<div class="pops_box pops_02_2" style="display:none;">
		<div class="pops_h">
			<h2>자료 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>자료 추가</legend>
						<table class="ta_write01">
							<caption>자료</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용</th>
									<td colspan="3">
										<div class="radio_list">
											<span><input type="radio" id="" name=""> <label for="">사용</label></span>
											<span><input type="radio" id="" name=""> <label for="">숨김</label></span>
											<span><input type="radio" id="" name=""> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td colspan="3">정우성</td>
								</tr>
								<tr>
									<th>분류</th>
									<td>
										<select name="" id="">
											<option value="">문서</option>
											<option value="">가이드</option>
											<option value="">기타</option>
										</select>
									</td>
									<th>첨부파일</th>
									<td><input type="file" id="" name="" class="wd_full" /></td>
								</tr>
								<tr>
									<th>제목</th>
									<td colspan="3"><input type="text"  value="" id="" name="" class="wd_full"></td>
								</tr>
								<tr>
									<th>내용</th>
									<td colspan="3">
										<textarea name="" id="" cols="40" rows="20"  class="wd_full"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">등록</button>
							<button type="button" class="gray">닫기</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<!-- 고객 계약조회 ppt 팝업 3 -->
	<div class="pops_box pops_03" style="display:none;">
		<div class="pops_h">
			<h2>사업자정보 팝업</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_hbox2">
				<h2>사업자정보(국세청전자세금계산서)</h2>
			</div>
			<div class="com_tb01  mar_b click_tb">
				<table class="ta_list01">
					<caption>사업자정보(국세청전자세금계산서)</caption>
					<thead>
						<tr>
							<th>구분</th>
							<th>사업자명</th>
							<th>사업자번호</th>
							<th>업태</th>
							<th>종목</th>
							<th>전화번호</th>
							<th>이메일</th>
							<th>부가세</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>법인개인사업자</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>간이,일반</td>
						</tr>
						<tr>
							<td>법인개인사업자</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>간이,일반</td>
						</tr>
						<tr>
							<td>법인개인사업자</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>간이,일반</td>
						</tr>
						<tr>
							<td>법인개인사업자</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>간이,일반</td>
						</tr><tr>
							<td>법인개인사업자</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>간이,일반</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- 관리자 추가 / 수정-->
	<div class="pops_box pops_04" style="display:none;">
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
													<li><input type="checkbox" id="" name="" /> <label for="">자료실관리</label></li>
												</ul>
											</li>
											<li>
												<strong>정산관리</strong>
												<ul class="depth02">
													<li><input type="checkbox" id="" name="" /> <label for="">입금리스트</label></li>
												</ul>
											</li>
											<li>
												<strong>환경설정</strong>
												<ul class="depth02">
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

	<!-- 푸쉬메시지 추가-->
	<div class="pops_box pops_04_1" style="display:none;">
		<div class="pops_h">
			<h2>푸쉬메시지 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>푸쉬메시지 추가</legend>
						<table class="ta_write01">
							<caption>푸쉬메시지</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용여부</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">사용</label></span>
											<span><input type="radio" id="" name="" /> <label for="">숨김</label></span>
											<span><input type="radio" id="" name="" /> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td>store03</td>
								</tr>
								<tr>
									<th>발송일시</th>
									<td class="date_list">
										<input type="text" class="calendar" readonly>
									</td>
								</tr>
								<tr>
									<th>발송대상</th>
									<td>
										<input type="text" id="" name="" class="wd_200"/>
										<button type="button" class="blue_btn">업로드</button>
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text" id="" name="" class="wd_full" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="" id="" cols="40" rows="20" readonly="" class="wd_full" ></textarea>
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

	<!-- 팝업 추가-->
	<div class="pops_box pops_04_2" style="display:none;">
		<div class="pops_h">
			<h2>팝업 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>팝업 추가</legend>
						<table class="ta_write01">
							<caption>팝업 추가</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용여부</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">사용</label></span>
											<span><input type="radio" id="" name="" /> <label for="">숨김</label></span>
											<span><input type="radio" id="" name="" /> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td>store03</td>
								</tr>
								<tr>
									<th>게시기간</th>
									<td class="date_list">
										<input type="text" class="calendar" readonly>
										<input type="text" id="" name="" class="wd_140" placeholder="시간입력 예)15:00" />
										<p class="and_txt">~</p>
										<input type="text" class="calendar mar_r10" readonly>
										<input type="text" id="" name=""  class="wd_140" placeholder="시간입력 예)16:00" />
									</td>
								</tr>
								<tr>
									<th>이미지 업로드</th>
									<td>
										<input type="file" id="" name="" class="wd_full" />
									</td>
								</tr>
								<tr>
									<th>팝업위치</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">웹</label></span>
											<span><input type="radio" id="" name="" /> <label for="">서비스</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>좌표값</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">기본값</label></span>
											<span><input type="radio" id="" name="" /> <label for="">직접입력</label></span>
											<span>
												<label for="">TOP</label>
												<input type="text" id="" name=""  class="wd_60"/>
											</span>
											<span>
												<label for="">LEFT</label>
												<input type="text" id="" name=""  class="wd_60" />
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text" id="" name="" class="wd_full" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="" id="" cols="40" rows="20" readonly="" class="wd_full" ></textarea>
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
	
	<!-- 회원 추가-->
	<div class="pops_box pops_05" style="display:none;">
		<div class="pops_h">
			<h2>회원추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form name="add_customer" method="post" action="">
					<input type="text" name="id_chk" id="id_chk" value="" />
					<fieldset>
						<legend>관리자 추가</legend>
						<table class="ta_write01">
							<caption>관리자</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>회원코드</th>
									<td><input type="text"id="" name="" value="" readonly placeholder="자동 생성됩니다"  /><!-- 8자리 --></td>
									<th>우편번호</th>
									<td><input type="text" id="zipcode" name="zipcode" value="" readonly  /> <button type="button" class="gray_btn" onclick="win_zip_item('add_customer', 'zipcode', 'addr', 'addr2');" >찾기</button></td>
								</tr>
								<tr>
									<th>아이디</th>
									<td><input type="text" id="user_id" name="user_id" value="" class="onlyeng"   /> <button type="button" class="gray_btn" onclick="chk_userid();">중복확인</button>
										<p class="idTxt01">아이디 중복체크버튼을 눌러주세요</p> <!-- 버튼입력전 -->

										<p class="idTxt01 chk_true" style="display:none;" >사용가능한 ID입니다.</p> <!-- 버튼입력후 아이디사용가능할때 -->
										<p class="idTxt02 chk_false" style="display:none;" >이미 사용중인 ID 입니다.</p> <!-- 버튼입력전 아이디사용불가능할때-->
									</td>
									<th>주소</th>
									<td class="address_input">
										<div class="box"><input type="text" id="addr" name="addr" value="" readonly  /></div>
										<div class="box"><input type="text" id="addr2" name="addr2" value=""  /></div>
									</td>
								</tr>
								<tr>
									<th>사업자/개인</th>
									<td>
										<select name="" id="" class="wh100">
											<?foreach($_admin_com_type as $key => $value){?>
												<option value="<?=$key?>"><?=$value?></option>
											<?}?>
										</select>
									</td>
									<th>등급</th>
									<td>
										<select name="" id="" class="wh100">
											<?foreach($_admin_level as $key => $value){?>
												<option value="<?=$key?>"><?=$value?></option>
											<?}?>
										</select>
									</td>
								</tr>
								<tr>
									<th>생년월일</th>
									<td><input type="text"id="" name="" value="" class="calendar2" readonly  /></td>
									<th>추천인아이디</th>
									<td><input type="text"id="" name="" value=""  />  <button type="button" class="gray_btn" onClick="btn_id_layer();">검색</button></td>
								</tr>
								<tr>
									<th>사업자명</th>
									<td><input type="text"id="" name="" value="비즈피스"  /></td>
									<th>수납방법</th>
									<td>
										<select name="" id="">
											<option value="">휴대폰청구서</option>
											<option value="">자동이체</option>
											<option value="">신용카드</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>대표자명(개인명)</th>
									<td><input type="text"id="" name="" value="유진희"  /></td>
									<th>일반전화</th>
									<td class="ph">
										<input type="text"id="" name="" value="" class="onlynum" maxlength="4"  /><span>-</span><input type="text"id="" name="" value=""  class="onlynum" maxlength="4" /><span>-</span><input type="text"id="" name="" value=""  class="onlynum" maxlength="4" />
									</td>
								</tr>
								<tr>
									<th>휴대폰</th>
									<td class="ph">
										<input type="text"id="" name="" value=""  class="onlynum" maxlength="4" /><span>-</span><input type="text"id="" name="" value=""  class="onlynum" maxlength="4" /><span>-</span><input type="text"id="" name="" value=""  class="onlynum" maxlength="4" />
									</td>
									<th>이메일</th>
									<td class="email">
										<input type="text" id="email1" name="email1" value=""  /> @ <input type="text" id="email2" name="email2" value=""  />
										<select onchange="chg_email(this);">
											<option value="">직접입력</option>
											<?
											foreach($_email_list as $value)
												echo "<option value='".$value."'>".$value."</option>";
											?>
										</select>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="id_layer">
							<div class="top">
								<h3>추천인 아이디 검색</h3>
								<a href="#!" class="layer_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
							</div>
							<div class="con">
								<div class="id_list_con">
									<input type="text" /> <button type="button" class="gray_btn">확인</button>
									<ul class="id_list">
										<li>lili01</li>
										<li>lili02</li>
										<li>lili03</li>
									</ul>
								</div>
							</div>
						</div>
						<script type="text/javascript">
						function btn_id_layer(){
							$(".id_layer").show();
						};
						$(function(){
							$(".layer_close").on("click",function(){
								$(this).parent().parent(".id_layer").hide();
							});
							$(".id_list_con").keydown(function(){
								$(".id_list").show();
							});
						});
						</script>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">저장</button>
							<button type="button" class="gray pops_close">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<!-- 회원수정-->
	<div class="pops_box pops_05_4" style="display:none;">
		<div class="pops_h">
			<h2>회원수정</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>관리자 추가</legend>
						<table class="ta_write01">
							<caption>관리자</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>회원코드</th>
									<td><input type="text"id="" name="" value="10001000"  /><!-- 8자리 --></td>
									<th>우편번호</th>
									<td><input type="text"id="" name="" value=""  /> <button type="button" class="gray_btn">찾기</button></td>
								</tr>
								<tr>
									<th>아이디</th>
									<td><input type="text"id="" name="" value=""  /> <button type="button" class="gray_btn">중복확인</button>
										<p class="idTxt01">아이디 중복체크버튼을 눌러주세요</p> <!-- 버튼입력전 -->
										<p class="idTxt01">사용가능한 ID입니다.</p> <!-- 버튼입력후 아이디사용가능할때 -->
										<p class="idTxt02">이미 사용중인 ID 입니다.</p> <!-- 버튼입력전 아이디사용불가능할때-->
									</td>
									<th>주소</th>
									<td class="address_input">
										<div class="box"><input type="text"id="" name="" value=""  /></div>
										<div class="box"><input type="text"id="" name="" value=""  /></div>
									</td>
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
									<td>
										<select name="" id="">
											<option value="">무료</option>
											<option value="">일반</option>
											<option value="">화이트</option>
											<option value="">실버</option>
											<option value="">골드</option>
											<option value="">VIP</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>생년월일</th>
									<td><input type="text"id="" name="" value=""  /></td>
									<th>추천인아이디</th>
									<td><input type="text"id="" name="" value=""  />  <button type="button" class="gray_btn" onClick="btn_id_layer();">검색</button></td>
								</tr>
								<tr>
									<th>사업자명</th>
									<td><input type="text"id="" name="" value="비즈피스"  /></td>
									<th>수납방법</th>
									<td>
										<select name="" id="">
											<option value="">휴대폰청구서</option>
											<option value="">자동이체</option>
											<option value="">신용카드</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>대표자명(개인명)</th>
									<td><input type="text"id="" name="" value="유진희"  /></td>
									<th>일반전화</th>
									<td class="ph">
										<input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  />
									</td>
								</tr>
								<tr>
									<th>휴대폰</th>
									<td class="ph">
										<input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  />
									</td>
									<th>이메일</th>
									<td><input type="text"id="" name="" value=""  /></td>
								</tr>
							</tbody>
						</table>
						<div class="id_layer">
							<div class="top">
								<h3>추천인 아이디 검색</h3>
								<a href="#!" class="layer_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
							</div>
							<div class="con">
								<div class="id_list_con">
									<input type="text" /> <button type="button" class="gray_btn">확인</button>
									<ul class="id_list">
										<li>lili01</li>
										<li>lili02</li>
										<li>lili03</li>
									</ul>
								</div>
							</div>
						</div>
						<script type="text/javascript">
						function btn_id_layer(){
							$(".id_layer").show();
						};
						$(function(){
							$(".layer_close").on("click",function(){
								$(this).parent().parent(".id_layer").hide();
							});
						});
						</script>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">저장</button>
							<button type="button" class="gray">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	
	<!-- 회원 정보-->
	<div class="pops_box pops_05_1" style="display:none;">
		<div class="pops_h">
			<h2>회원정보</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_btn_box">
				<div class="left pxel">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</div>
				<div class="right">
					<button type="button" class="gray_btn" onClick="pops_07btn();">탈퇴처리</button>
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_write01">
					<caption>관리자</caption>
					<colgroup>
					</colgroup>
					<tbody>
						<tr>
							<th>회원코드</th>
							<td><input type="text"id="" name="" value="10001000"  /><!-- 8자리 --></td>
							<th>우편번호</th>
							<td><input type="text"id="" name="" value=""  /> <button type="button" class="gray_btn">찾기</button></td>
						</tr>
						<tr>
							<th>아이디</th>
							<td><input type="text"id="" name="" value=""  /> <button type="button" class="gray_btn">중복확인</button>
								<p class="idTxt01">아이디 중복체크버튼을 눌러주세요</p> <!-- 버튼입력전 -->
								<p class="idTxt01">사용가능한 ID입니다.</p> <!-- 버튼입력후 아이디사용가능할때 -->
								<p class="idTxt02">이미 사용중인 ID 입니다.</p> <!-- 버튼입력전 아이디사용불가능할때-->
							</td>
							<th>주소</th>
							<td class="address_input">
								<div class="box"><input type="text"id="" name="" value=""  /></div>
								<div class="box"><input type="text"id="" name="" value=""  /></div>
							</td>
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
							<td>
								<select name="" id="">
									<option value="">무료</option>
									<option value="">일반</option>
									<option value="">화이트</option>
									<option value="">실버</option>
									<option value="">골드</option>
									<option value="">VIP</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>생년월일</th>
							<td><input type="text"id="" name="" value=""  /></td>
							<th>추천인아이디</th>
							<td><input type="text"id="" name="" value=""  />  <button type="button" class="gray_btn" onClick="btn_id_layer();">검색</button></td>
						</tr>
						<tr>
							<th>사업자명</th>
							<td><input type="text"id="" name="" value="비즈피스"  /></td>
							<th>수납방법</th>
							<td>
								<select name="" id="">
									<option value="">휴대폰청구서</option>
									<option value="">자동이체</option>
									<option value="">신용카드</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>대표자명(개인명)</th>
							<td><input type="text"id="" name="" value="유진희"  /></td>
							<th>일반전화</th>
							<td class="ph">
								<input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  />
							</td>
						</tr>
						<tr>
							<th>휴대폰</th>
							<td class="ph">
								<input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  /><span>-</span><input type="text"id="" name="" value=""  />
							</td>
							<th>이메일</th>
							<td><input type="text"id="" name="" value=""  /></td>
						</tr>
					</tbody>
				</table>
				<div class="id_layer">
					<div class="top">
						<h3>추천인 아이디 검색</h3>
						<a href="#!" class="layer_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
					</div>
					<div class="con">
						<div class="id_list_con">
							<input type="text" /> <button type="button" class="gray_btn">확인</button>
							<ul class="id_list">
								<li>lili01</li>
								<li>lili02</li>
								<li>lili03</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="com_btn_box">
					<div class="center">
						<a href="#" class="blue_btn">수정</a>
						<a href="list.php" class="gray_btn">리스트 이동</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	


	<!-- 건물관리-->
	<div class="pops_box pops_05_2" style="display:none;">
		<div class="pops_h">
			<h2>건물관리</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_hbox">
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_btn_box">
				<div class="left">
					<button type="button" class="btn_arrow"><i class="fa fa-caret-up" aria-hidden="true"></i></button>
					<button type="button" class="btn_arrow"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
				</div>
				<div class="right">
					<button type="button" class="blue_btn">추가</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>건물관리 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>형태</th>
							<th>건물별명</th>
							<th>우편번호</th>
							<th>소재지</th>
							<th><span class="color01">방/좌석(개)</span></th>
							<th><span class="color01">선불후불</span></th>
							<th><span class="color01">보안시설</span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>2</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>3</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>4</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>5</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>6</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>7</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>8</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>9</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>10</td>
							<td>소호사무실</td>
							<td><a href="#">비즈피스</a></td>
							<td>11715</td>
							<td>의정부시 동일로 119-1</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="pops_box pops_05_3" style="display:none;">
		<div class="pops_h">
			<h2>사용건수</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_hbox">
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<br />
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>회원리스트 표</caption>
					<colgroup>
					</colgroup>
					<thead>
						<tr>
							<th>고객(명)<br /><span class="stxt">전체(진행/종료)</span></th>
							<th>스케줄계약(건)<br /><span class="stxt">전체(진행/종료)</span></th>
							<th>기타계약(건)<br /><span class="stxt">전체(진행/종료)</span></th>
							<th>세금계산서 발행수</th>
							<th>문자상용구수</th>
							<th>문자발송건수</th>
							<th>상품건수</th>
							<th>상품</th>
							<th>문자메시지 발송내역</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>단문</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>장문</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>멀티</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>단문</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>장문</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>멀티</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>단문</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>장문</td>
						</tr>
						<tr>
							<td>1(1/0)</td>
							<td>1(1/0)</td>
							<td>3(1/2)</td>
							<td></td>
							<td></td>
							<td>총5건(단문1건,장문2건,멀티3건)</td>
							<td>5</td>
							<td>기본</td>
							<td>멀티</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- 회원정보 삭제   -->
	<div class="pops_box pops_07" style="display:none;">
		<div class="pops_h">
			<h2>회원정보 삭제</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<form action="">
				<fieldset>
					<p class="ta_center txt01">회원을 삭제하시겠습니까?</p>
					<div class="buttom_btnbox">
						<button type="button" class="blue">확인</button>
						<button type="button" class="gray">취소</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</section>

<!-- 제목은 위에 해당 팝업은 아래에... '잦은 수정과 변경으로 인해 ppt 팝업 넘버링은 의미가 없게 되었습니다. ~_~;;' -->



<script type="text/javascript">

$(document).ready(function(){
	$("#user_id").keyup(function(){
		$("#id_chk").val("");
		$(".chk_true").hide();
		$(".chk_false").hide();
	});

});

function chg_email(obj){
	$(obj).parent().find("input").eq(1).val($(obj).val());
}


function chk_userid(){
	var user_id = $("#user_id").val().trim();

	if(user_id==""){
		alert("아이디를 입력해주세요.");
		return false;
	}

	$.ajax({
	  url     : "/ajax/adm/id_check.php",
	  data    : "user_id="+user_id,
	  cache   : false,
	  success : function(data) {  
		data = parseInt(data);

		if(data>0){
			$(".chk_true").hide();
			$(".chk_false").show();
			$("#id_chk").val("");
		}else{
			$(".chk_true").show();
			$(".chk_false").hide();
			$("#id_chk").val("y");
		}
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});



}
</script>