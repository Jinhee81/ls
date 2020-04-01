<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
if($_POST['agree_check'] !="Y"){
		alert_msg("이용약관/개인정보수집 동의해 주세요","./membership.php");
}
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}

	$lease_type_array =array("공유오피스","원룸","빌딩","고시원","창고","임대관리회사","기타");

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
					<!-- <input type="hidden" id="id_check" value="N" >
					<input type="hidden" id="Approval_num" value="123456" > -->
						<div class="membership2">
							<h3>상세정보 입력</h3>
							<table>
								<legend>상세정보 입력</legend>
								<thead>
									<tr>
										<th>이메일</th>
										<td>
											<input type="email" name="email1" class="onlyeng" required>
											<button type="button" id="check_email">중복체크</button>
											<input type=hidden id="chk_email2" name="chk_email2" value="0">
						          <!-- hidden 이건 중복체크했는지 안했는지 판단하는 bool변수 -->
										</td>
									</tr>
									<tr>
										<th>비밀번호</th>
										<td>
											<input type="password" name="password" id="password" value="" required>
										</td>
									</tr>
									<tr>
										<th>비밀번호 확인</th>
										<td>
											<input type="password" name="password_again" value="" required>
											<span><label name="password_again"></label></span>
										</td>
									</tr>
									<tr>
										<th>회원구분</th>
										<td>
											<select name="user_div" id="user_div" value="">
												<option value="개인">개인</option>
												<option value="사업자">사업자</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>회원명</th>
										<td id="user_name_div">
											<input type="text" name="user_name" placeholder="성명" required>
										</td>
									</tr>
									<tr>
										<th>연락처</th>
										<td>
											<input type="text" name="cellphone" required><button type="button">인증하기</button>
										</td>
									</tr>
									<tr>
										<th>임대유형</th>
										<td>
											<select name="lease_type" id="lease_type" value="">
												<?
													for($i=0;$i<count($lease_type_array);$i++){
												?>
												<option value="<?=$lease_type_array[$i]?>"><?=$lease_type_array[$i]?></option>
												<?}?>
											</select>
											<span name='leasespan'></span>
										</td>
									</tr>
									<tr>
										<th>가입경로</th>
										<td name="registtd">
											<select name="regist_channel" id="regist_channel" value="">
												<?
													for($i=0;$i<count($sign_up_array);$i++){
												?>
												<option value="<?=$sign_up_array[$i]?>"><?=$sign_up_array[$i]?></option>
												<?}?>
											</select>
											<span name='registspan'></span>
										</td>
									</tr>
								</thead>
							</table>
							<div class="btn_box">
							<b class="blue on_btn">
								<a href="./signup_proccess2.php" class="submit_btn">회원가입</a>
							</b>
							<b class="on_btn">
								<a href="../main/main.php">취소</a>
							</b>
						</div>
						</div>
					</form>
					<iframe src="" id="ifrm1" scrolling=no frameborder=no width=100 height=100 name="ifrm1"></iframe>
					<!-- 중복검사하는 눈에 안보이는 iframe만든것 -->
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->
</body>
</html>
<script>
	$('#check_email').on('click', function(){
		var email = $('input[name=email1]').val().trim();

		if(email==''){
			alert('이메일을 입력하세요');
			return false;
		}

		ifrm1.location.href="signup_check.php?email="+email;
	})

	$('input[name=password]').on('click', function(){
		if($('chk_email2')=="0"){
			alert("이메일중복체크를 하세요");
      return false;
		}
	})

	var passcheck = false;

	$('input[name=password_again]').on('blur', function(){
		var password1 = $('input[name=password]').val().trim();
		var password2 = $(this).val().trim();

		if(password1 === password2){
			$('label[name=password_again]').text('비밀번호가 일치합니다.');
			passcheck = true;
		} else {
			$('label[name=password_again]').text('비밀번호와 비밀번호확인 값이 다릅니다.');
		}
	})

	$('#user_div').on('click', function(){
		if(passcheck==false){
			alert('비밀번호가 일치해야 진행됩니다.');
		}
	})

	$('#user_div').on('change', function(){
		var user_div = $(this).val();

		if(user_div==="개인"){
			$('#user_name_div').html("<input type='text' name='user_name' placeholder='성명'>");
		} else if(user_div==="사업자"){
			$('#user_name_div').html("<input type='text' name='user_name' placeholder='사업자명'><input type='text' name='manager_name' placeholder='담당자명'>");
		}
	})

	$('#lease_type').on('change', function(){
		var lease_etc = "<input type='text' name='lease_etc' required>";
		if($(this).val()==='기타'){
			$('span[name=leasespan]').append(lease_etc);
		} else {
			$('span[name=leasespan]').empty();
		}
	})

	$('#regist_channel').on('change', function(){
		var regist_etc = "<input type='text' name='regist_etc' required>";
		if($(this).val()==='기타'){
			$('span[name=registspan]').append(regist_etc);
		} else {
			$('span[name=registspan]').empty();
		}
	})

	$(function(){
		$(".submit_btn").click(function(e){
			e.preventDefault();
			var link =$(this).attr("href");

			$("#frm_from").attr("action",link);
			$("#frm_from").submit();

		});
	});
</script>
