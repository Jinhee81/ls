<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
if($_POST['agree_check'] !="Y"){
		alert_msg("이용약관/개인정보수집 동의해 주세요","./membership.php");
}
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}

	//지역번호 배열
	$tel_array =array("02","031","032","033","041","042","043","044","051","052","053","054","055","061","062","063","064","070","075","080","1544","1599","0504","0505");
	//휴대폰 앞번호 배열
	$phone_array =array("010","011","016","017","019","070");
	//가입경로 배열
	$sign_up_array =array("메일수신","문자메시지","지인권유","인터넷검색","기타");
echo G5_POSTCODE_JS;    //다음 주소 js
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
					<form name="frm_from" id="frm_from" method="post">
					<input type="hidden" id="id_check" value="N" >
					<input type="hidden" id="Approval_num" value="123456" >
						<div class="membership2">
							<h3>상세정보 입력</h3>
							<table>
								<legend>상세정보 입력</legend>
								<thead>
									<tr>
										<th><span class="span_star">*</span>아이디</th>
										<td>
											<input type="text" name="user_id" id="user_id" value="" class="onlyeng">
											<a href="#!" id="check_id" onclick="chk_userid();"><button type="button">중복확인</button></a>
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>비밀번호</th>
										<td>
											<input type="password" name="user_pw" id="user_pw" value="">
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>비밀번호 확인</th>
										<td>
											<input type="password" name="check_pw" id="check_pw" value="">
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>성명</th>
										<td>
											<input type="text" name="user_name" id="user_name" value="">
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>생년월일</th>
										<input type="hidden" name="birthday" id="birthday" >
										<td>
										<?
											$year  = date('Y');
											$month = date('m');
											$day   = date('d');
										?>
											<select name="year" id="year" value="">
												<option value="">선택</option>
												<?
													for($i=$year;$i >$year-100;$i--){
												?>
												<option value="<?=$i?>"><?=$i?></option>
												<?}?>
												<!-- <option>2000</option>
												<option>2000</option> -->
											</select>
											<p>년</p>
											<select name="month" id="month" value="">
												<option value="">선택</option>
												<?
													for($i=1;$i <= 12;$i++){
												?>
												<option value="<?=$i?>"><?=$i?></option>
												<?}?>
											</select>
											<p>월</p>
											<select name="day" id="day" value="">
												<option value="">선택</option>
												<?
													for($i=1;$i <= 31; $i++){
												?>
												<option value="<?=$i?>"><?=$i?></option>
												<?}?>
											</select>
											<p>일</p>
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>주소</th>
										<input type="hidden" name="zipcode" id="zipcode" value=""/>
										<td>
											<input type="text" class="input_address" name="addr" id="addr" value="" readonly>
											<button type="button" class="gray_btn" onclick="win_zip_item('frm_from', 'zipcode', 'addr', 'addr2');" >찾기</button>
											<input type="text" class="input_address" name="addr2" id="addr2" value="">
										</td>
									</tr>
									<tr>
									<input type="hidden" name="tel" id="tel" value="">
										<th>연락처</th>
										<td>
											<select name="tel1" id="tel1" value="">
												<?
													for($i=0;$i<count($tel_array);$i++){
												?>
												<option value="<?=$tel_array[$i]?>"><?=$tel_array[$i]?></option>
												<?}?>
												<!-- <option>031</option>
												<option>030</option> -->
											</select>
											<span>-</span>
											<input type ="number" class="input_number onlynum" name="tel2" id="tel2" value="" maxlength='4'>
											<span>-</span>
											<input type ="number" class="input_number onlynum" name="tel3" id="tel3" value="" maxlength='4'>
										</td>
									</tr>
									<tr>
									<input type="hidden" name="mobile" id="mobile" value="">
										<th><span class="span_star">*</span>휴대폰</th>
										<td>
											<select name="mobile1" id="mobile1" value="">
												<?
													for($i=0;$i<count($phone_array);$i++){
												?>
												<option value="<?=$phone_array[$i]?>"><?=$phone_array[$i]?></option>
												<?}?>
											</select>
											<span>-</span>
											<input text="number" class="input_number onlynum" name="mobile2" id="mobile2" value="" maxlength='4'>
											<span>-</span>
											<input text="number" class="input_number onlynum" name="mobile3" id="mobile3" value="" maxlength='4'>
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>이메일</th>
										<td>
											<input type="email" placeholder="예) crazy830727@naver.com" name="user_email" id="user_email" value="">
										</td>
									</tr>
									<tr>
										<th>추천인 아이디</th>
										<td>
											<input type="text" class="onlyeng" name="reco_id" id="reco_id" value="">
										</td>
									</tr>
									<tr>
										<th>가입경로</th>
										<td>
											<select name="sign_up_path" id="sign_up_path" value="">
												<?
													for($i=0;$i<count($sign_up_array);$i++){
												?>
												<option value="<?=$sign_up_array[$i]?>"><?=$sign_up_array[$i]?></option>
												<?}?>
											</select>
										</td>
									</tr>
								</thead>
							</table>
							<div class="btn_box">
							<b class="blue on_btn">
								<a href="./member_ok.php" class="submit_btn">회원가입</a>
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
				$("#id_check").val("N");
				alert("이미사용중인 아이디입니다.");
				return false;
			}else{
				alert("사용가능한 아이디입니다.");
				$("#id_check").val("Y");
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}
	$(function(){
		$(".submit_btn").click(function(e){
			e.preventDefault();
			var link =$(this).attr("href");
			if($("#user_id").val() ==""){
				alert("아이디를 입력해 주세요.");
				$("#user_id").focus();
				return false;
			}
			if($("#id_check").val() =="N"){
				alert("아이디 중복확인해 주세요.");
				$("#user_id").focus();
				return false;
			}
			if($("#user_pw").val() ==""){
				alert("비밀번호를 입력해 주세요.");
				$("#user_pw").focus();
				return false;
			}
			if($("#check_pw").val() ==""){
				alert("비밀번호확인을 입력해 주세요.");
				$("#check_pw").focus();
				return false;
			}
			if($("#user_pw").val() !=$("#check_pw").val()){
				alert("비밀번호가 일치하지 않습니다.");
				$("#check_pw").focus();
				return false;
			}
			if($("#user_name").val() ==""){
				alert("이름을 입력해 주세요.");
				$("#user_name").focus();
				return false;
			}
			if($("#year").val() ==""){
				alert("생년월일 년도를 입력해 주세요.");
				$("#year").focus();
				return false;
			}
			if($("#month").val() ==""){
				alert("생년월일 월을 입력해 주세요.");
				$("#month").focus();
				return false;
			}
			if($("#day").val() ==""){
				alert("생년월일 일을 입력해 주세요.");
				$("#day").focus();
				return false;
			}
			if($("#addr").val() ==""){
				alert("주소를 입력해 주세요.");
				$("#addr").focus();
				return false;
			}
			if($("#addr2").val() ==""){
				alert("상세주소를 입력해 주세요.");
				$("#addr2").focus();
				return false;
			}
			if($("#mobile1").val() ==""){
				alert("휴대폰번호를 입력해 주세요.");
				$("#mobile1").focus();
				return false;
			}
			if($("#mobile2").val() ==""){
				alert("휴대폰번호를 입력해 주세요.");
				$("#mobile2").focus();
				return false;
			}
			if($("#mobile3").val() ==""){
				alert("휴대폰번호를 입력해 주세요.");
				$("#mobile3").focus();
				return false;
			}
			if($("#user_email").val() ==""){
				alert("E-mail를 입력해 주세요.");
				$("#user_email").focus();
				return false;
			}
		
			$("#frm_from").attr("action",link);
			$("#frm_from").submit();
		});
	});
</script>