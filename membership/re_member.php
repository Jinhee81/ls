<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');
echo G5_POSTCODE_JS;    //다음 주소 js

$c_idx = $_SESSION['member']['idx'];

$sql_m = "select * from tbl_customer where c_idx = '".$c_idx."' ";
$result_m = mysql_query($sql_m);
$row_m = mysql_fetch_array($result_m);

//지역번호 배열
	$tel_array =array("02","031","032","033","041","042","043","044","051","052","053","054","055","061","062","063","064","070","075","080","1544","1599","0504","0505");
	//휴대폰 앞번호 배열
	$phone_array =array("010","011","016","017","019","070");
	//가입경로 배열
	$sign_up_array =array("메일수신","문자메시지","지인권유","인터넷검색","기타");

	$hp = explode("-",$row_m['mobile']);
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="wrap_1000">	
				<div class="membership modify">
					<h2>회원정보수정</h2>
					<form name="mod_customer" id="mod_customer" action="./member_mod_ok.php"  method="post">
					<input type="hidden" name="c_idx" id="c_idx" value="<?=$c_idx?>" />
					<input type="hidden" id="check_pass" value="N">
					<input type="hidden" id="member_check" value="N">
						<div class="membership2 modify">
							<h3>상세정보 수정</h3>
							<table id="mod_member">
								<legend>상세정보 수정</legend>
								<thead>
									<tr>
										<th>아이디</th>
										<td>
											<?=$row_m['user_id']?>
										</td>
									</tr>
									<tr>
										<th>비밀번호</th>
										<td>
											<input type="password" id="user_pw" name="user_pw" value=""><br/><span style="color:red;">(비밀번호 변경 시에만 입력하세요.)</span>
										</td>
									</tr>
									<!-- <tr>
										<th>새 비밀번호</th>
										<td>
											<input type="password">
										</td>
									</tr>
									<tr>
										<th>새 비밀번호확인</th>
										<td>
											<input type="password">
										</td>
									</tr> -->
									<tr class="hidden_class">
										<th>휴대전화인증</th>
										<td>
											<select id="con_hp1">
												<?
													for($i=0;$i<count($phone_array);$i++){
												?>
												<option value="<?=$phone_array[$i]?>" <?if($phone_array[$i] ==$hp[0])echo "selected";?>><?=$phone_array[$i]?></option>
												<?}?>
											</select>
											<span>-</span>
											<input text="number" class="input_number" id="con_hp2" value="<?=$hp[1]?>" >
											<span>-</span>
											<input text="number" class="input_number" id="con_hp3" value="<?=$hp[2]?>">
											<button type="button" onclick="certSend()">인증하기</button>
										</td>
									</tr>
									<tr class="hidden_class">
										<th>인증확인</th>
										<td>
											<input type="text" name="cert"><button type="button" onclick="certChk()" name="certCheck">인증확인</button>
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>생년월일</th>
										<input type="hidden" name="birthday" id="birthday" value="<?=$row_m['birthday']?>" >
										<td>
										<?
											$birthday =explode("-",$row_m['birthday']);
											
											$year  = date('Y');
											$month = date('m');
											$day   = date('d');
										?>
											<select name="year" id="year" value="" disabled >
												<option value="">선택</option>
												<?
													for($i=$year;$i >$year-100;$i--){
												?>
												<option value="<?=$i?>" <?if($i ==$birthday[0])echo "selected";?>><?=$i?></option>
												<?}?>
												<!-- <option>2000</option>
												<option>2000</option> -->
											</select>
											<p>년</p>
											<select name="month" id="month" value="" disabled >
												<option value="">선택</option>
												<?
													for($i=1;$i <= 12;$i++){
												?>
												<option value="<?=$i?>" <?if($i ==$birthday[1])echo "selected";?>><?=$i?></option>
												<?}?>
											</select>
											<p>월</p>
											<select name="day" id="day" value="" disabled >
												<option value="">선택</option>
												<?
													for($i=1;$i <= 31; $i++){
												?>
												<option value="<?=$i?>" <?if($i ==$birthday[2])echo "selected";?>><?=$i?></option>
												<?}?>
											</select>
											<p>일</p>
										</td>
									</tr>
									<tr>
										<th>주소</th>
										<input type="hidden" name="zipcode" id="zipcode" value="<?=$row_m['zipcode']?>">
										<td>
											<input type="text" class="input_address" name="addr" id="addr" value="<?=$row_m['addr']?>">
											<button type="button" class="gray_btn" onclick="win_zip_item('mod_customer', 'zipcode', 'addr', 'addr2');" >찾기</button>
											<input type="text" class="input_address" name="addr2" id="addr2" value="<?=$row_m['addr2']?>">
										</td>
									</tr>
									<tr>
									<input type="hidden" name="tel" id="tel" value="<?=$row_m['tel']?>">
										<th>연락처</th>
										<?
											$tel = explode("-",$row_m['tel']);
										?>
										<td>
											<select name="tel1" id="tel1" value="">
												<?
													for($i=0;$i<count($tel_array);$i++){
												?>
												<option value="<?=$tel_array[$i]?>" <?if($tel_array[$i] ==$tel[0])echo "selected";?>><?=$tel_array[$i]?></option>
												<?}?>
												<!-- <option>031</option>
												<option>030</option> -->
											</select>
											<span>-</span>
											<input type ="number" class="input_number onlynum" name="tel2" id="tel2" value="<?=$tel[1]?>" maxlength='4'>
											<span>-</span>
											<input type ="number" class="input_number onlynum" name="tel3" id="tel3" value="<?=$tel[2]?>" maxlength='4'>
										</td>
									</tr>
									<tr>
									<input type="hidden" name="mobile" id="mobile" value="<?=$row_m['mobile']?>">
										<th><span class="span_star">*</span>휴대폰</th>
										
										<td>
											<select name="mobile1" id="mobile1" value="">
												<?
													for($i=0;$i<count($phone_array);$i++){
												?>
												<option value="<?=$phone_array[$i]?>" <?if($phone_array[$i] ==$hp[0])echo "selected";?>><?=$phone_array[$i]?></option>
												<?}?>
											</select>
											<span>-</span>
											<input text="number" class="input_number onlynum" name="mobile2" id="mobile2" value="<?=$hp[1]?>" maxlength='4'>
											<span>-</span>
											<input text="number" class="input_number onlynum" name="mobile3" id="mobile3" value="<?=$hp[2]?>" maxlength='4'>
										</td>
									</tr>
									<tr>
										<th>이메일</th>
										<td>
											<input type="email" placeholder="예) crazy830727@naver.com"  name="user_email" id="user_email" value="<?=$row_m['user_email']?>">
										</td>
									</tr>
									<tr>
										<th>추천인 아이디</th>
										<td>
											<input type="text" class="onlyeng" name="reco_id" id="reco_id" value="<?=$row_m['reco_id']?>" readonly>
										</td>
									</tr>
									<tr>
										<th>가입경로</th>
										<td>
											<select name="sign_up_path" id="sign_up_path" value="" disabled >
												<?
													for($i=0;$i<count($sign_up_array);$i++){
												?>
												<option value="<?=$sign_up_array[$i]?>" <?if($sign_up_array[$i]==$row_m['sign_up_path'])echo "selected";?>><?=$sign_up_array[$i]?></option>
												<?}?>
											</select>
										</td>
									</tr>
								</thead>
							</table>
							<div class="btn_box">
							<b class="blue on_btn submit_btn">
								<a href="#!">회원정보 수정</a>
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
<script>
	$(function(){
		//$("#mod_member input, .submit_btn").on("keypress click",function(e){
		$(".submit_btn").on("keypress click",function(e){
			var confirm_check =$("#check_pass").val();
			if(confirm_check =="N"){
				e.preventDefault();
				var change_pw_confirm =confirm("인증후 수정이 가능합니다.인증하시겠습니까?");
				if(change_pw_confirm){
					$(".hidden_class").removeClass().addClass("confirm_class");
					$("#check_pass").val("Y");
				}
			}else{
				var member_check =$("#member_check").val();
				if(member_check =="N"){
					alert("인증후 사용 가능합니다.");
					return;
				}else{
					$("#mod_customer").submit();
				}
			}
		});
	});
	
	var _mnq = _mnq || [];
	_mnq.push(['_setUid', 'MN-1500008869-6674']);//※ 수정
	(function(s,o,m,a,g) {a=s.createElement(o),g=s.getElementsByTagName(o)[0];a.async = 1;a.src = 'http://'+m+'/API/mn2.js';g.parentNode.insertBefore(a, g);})
	(document,'script','www.munjanote.com');
	
	// 인증번호 발송 함수
	function certSend() {
		if($("#member_check").val() =="Y"){
			alert("이미 인증되었습니다.");
			return;
		}
		hp =$("#con_hp1").val()+$("#con_hp2").val()+$("#con_hp3").val();
		_mnq.push(['_send', {
			msg:"{NUM} 인증번호를 입력해 주세요.",// {NUM} 부분이 인증번호로 변경되어 발송 됩니다.(내용 수정 가능)
			phone:hp, // ex)휴대폰번호값 ※ 수정
			callback:"0318798003" // ex)021112222 ※ 수정
		}]);
	}
	
	// 발송된 인증번호를 확인 합니다.
	function certChk() {
		_mnq.push(['_sendCertChk', document.mod_customer.cert.value]); // ex)인증번호입력값  ※ 수정
	}
	// 인증번호 발송(certSend()) & 인증번호 확인(certChk()) 시 자동 호출 됩니다.
	// 필요에 따라 수정하세요
	function MUNJANOTE_CallBack(obj) {
		if (obj.rslt=="true") {
			if (obj.msg == "cert")	{ alert("인증성공");$("#member_check").val("Y") } // certChk() 함수 호출 이후 발생됨.
			else { alert("인증번호가 발송 되었습니다."); }
		} else {
			var failMsg = (obj.msg)?obj.msg:"";
			if (obj.msg == "cert") { alert("잘못된 인증번호 입니다."); } 
			else { alert("fail : "+failMsg); }
		}
	}
</script>
