<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>	
	
	<section id="container" class="sub qna">
		<? include('community.inc.php');?>	
		<div class="sub_content">
			<div class="wrap_1200">
				<div class="sc_top">
					<h2 class="sc_tit">고객의 소리</h2>
					<p class="sc_txt">고객님의 모든 이야기를 듣겠습니다.</p>
				</div>
				<div class="bo_write">
				<form action="qna_ok.php" method="post" name="frm" onsubmit="return send_it();">
					<table class="ta_write">								
						<tbody>
							<tr>
								<th><label for="subject">제목</label></th>
								<td><input type="text" id="subject" name="subject" class="wr_wh03" value="" maxlength="200"></td>
							</tr>
							<tr>
								<th><label for="user_name">글쓴이</label></th>
								<td><input type="text" id="user_name" name="user_name" class="wr_wh01" value=""  maxlength="20"></td>
							</tr>
							<tr>
								<th>분류</th>
								<td class="radio_list">
									<span><input type="radio" id="gubun_1" name="gubun" value="01"/> <label for="gubun_1">칭찬합니다</label></span>
									<span><input type="radio" id="gubun_2" name="gubun" value="02"/> <label for="gubun_2">불만있습니다</label></span>
									<span><input type="radio" id="gubun_3" name="gubun" value="03"/> <label for="gubun_3">창업희망</label></span>
									<span><input type="radio" id="gubun_4" name="gubun" value="04"/> <label for="gubun_4">기타</label></span>
								</td>
							</tr>
							<tr>
								<th><label for="">연락처</label></th>
								<td class="ph">
									<select name="user_phone_1" id="user_phone_1">
										<option value="">번호선택</option>
										<option value="010">010</option>
										<option value="011">011</option>
										<option value="016">016</option>
										<option value="017">017</option>
										<option value="018">018</option>
										<option value="019">019</option>
										<option value="010">010</option>
										<option value="02">02</option>
										<option value="031">031</option>
										<option value="032">032</option>
										<option value="033">033</option>
										<option value="041">041</option>
										<option value="042">042</option>
										<option value="043">043</option>
										<option value="044">044</option>
										<option value="051">051</option>
										<option value="052">052</option>
										<option value="053">053</option>
										<option value="054">054</option>
										<option value="055">055</option>
										<option value="061">061</option>
										<option value="062">062</option>
										<option value="063">063</option>
										<option value="064">064</option>
									</select>
									-
									<input type="text" id="user_phone_2" name="user_phone_2"  maxlength="4" numberOnly="true"/>
									-
									<input type="text" id="user_phone_3" name="user_phone_3"  maxlength="4" numberOnly="true"/>
								</td>
							</tr>
							<tr>
								<th><label for="user_email">이메일</label></th>
								<td><input type="text" id="user_email" name="user_email" class="wr_wh02" placeholder="예) snrfood@naver.com" style="ime-mode:disabled"/></td>
							</tr>
							<tr>
								<th><label for="visit_date">방문일자</label></th>
								<td><input type="text" id="visit_date" name="visit_date" class="wr_wh01" maxlength="25"></td>
							</tr>
							<tr>
								<th><label for="visit_store">방문매장</label></th>
								<td><input type="text" id="visit_store" name="visit_store" class="wr_wh01" value="" maxlength="25"></td>
							</tr>
							<tr>
								<th><label for="contents">내용</label></th>
								<td><textarea name="contents" id="contents" cols="40" rows="20"></textarea></td>
							</tr>
						</tbody>
					</table>
					<div class="btn_wrap ta_right">
						<button type="submit" class="btn_st03 bcolr01">글쓰기</button>
						<a href="javascript:history.back();" class="btn_st03 bcolr02">취소</a>
					</div>
				</div>
				</form>
			</div>
		</div>
	</section>
	<script>
		function send_it()
		{
			var frm = document.frm;
			if (frm.subject.value == "")
			{
				alert("제목을 입력하셔야 합니다.");
				frm.subject.focus();
				return false;
			}
			if (frm.user_name.value == "")
			{
				alert("글쓴이를 입력하셔야 합니다.");
				frm.user_name.focus();
				return false;
			}
			if (frm.gubun[0].checked == false && frm.gubun[1].checked == false && frm.gubun[2].checked == false && frm.gubun[3].checked == false)
			{
				alert("분류를 선택하셔야 합니다.");
				frm.gubun[0].focus();
				return false;
			}
			if (frm.user_phone_1.value == "")
			{
				alert("연락처 앞자리를 입력하셔야 합니다.");
				frm.user_phone_1.focus();
				return false;
			}
			if (frm.user_phone_2.value == "")
			{
				alert("연락처 중간자리를 입력하셔야 합니다.");
				frm.user_phone_2.focus();
				return false;
			}
			if (frm.user_phone_3.value == "")
			{
				alert("연락처 끝자리를 입력하셔야 합니다.");
				frm.user_phone_3.focus();
				return false;
			}
			if (mail_chk(frm.user_email.value) == false)
			{
				alert("이메일을 바르게 입력하셔야 합니다.");
				frm.user_email.focus();
				return false;
			}
			if (frm.visit_date.value == "")
			{
				alert("방문일자를 입력하셔야 합니다.");
				frm.visit_date.focus();
				return false;
			}
			if (frm.visit_store.value == "")
			{
				alert("방문매장을 입력하셔야 합니다.");
				frm.visit_store.focus();
				return false;
			}
			if (frm.contents.value == "")
			{
				alert("내용을 입력하셔야 합니다.");
				frm.contents.focus();
				return false;
			}
			//return false;
		}
	</script>
<? include('../inc/footer.inc.php');?>	