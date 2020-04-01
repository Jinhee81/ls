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
					<input type="hidden" id="id_check" value="N" >
					<input type="hidden" id="Approval_num" value="123456" >
						<div class="membership2">
							<h3>상세정보 입력</h3>
							<table>
								<legend>상세정보 입력</legend>
								<thead>
									<tr>
										<th><span class="span_star">*</span>이메일</th>
										<td>
											<input type="text" name="email" id="email" value="" class="onlyeng">
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
										<th><span class="span_star">*</span>회원구분</th>
										<td>
											<select name="user_div" id="user_div" value="">
												<option value="개인">개인</option>
												<option value="사업자">사업자</option>
											</select>
										</td>
									</tr>
									<tr>
										<th><span class="span_star">*</span>회원명</th>
										<td id="user_name_div">
											<input type="text" name="user_name" placeholder="성명">
										</td>
									</tr>
									<tr>
									<input type="hidden" name="tel" id="tel" value="">
										<th>연락처</th>
										<td>
											<input type="text" name="cellphone" id="cellphone"><button type="button">인증하기</button>
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
			alert("이메일을 입력해주세요.");
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



			$("#frm_from").attr("action",link);
			$("#frm_from").submit();
		});
	});
</script>
