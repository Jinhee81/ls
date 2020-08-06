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
				<div class="login one">
					<h2>비밀번호 찾기</h2>
					<form name="frm" id="frm" method="POST" action="./find_password_view.php">
						<div class="login_box">
							<h3><span>아이디와 이메일을 입력해주세요!</h3>
							<div class="login_form">
								<div>	
									<input type="text" placeholder="아이디" name="user_id" id="user_id">
									<input type="email" placeholder="이메일" name="user_email" id="user_email">
								</div>
								<b class="go_btn">
									<a href="#!" class="submit_btn">조회하기</a>
								</b>
							</div>
							<div class="link_box">	
								<b class="on_btn">
									<a href="../membership/membership.php">회원가입</a>
								</b>
								<b class="on_btn">
									<a href="../membership/find_id.php">아이디 찾기</a>
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
		$(".submit_btn").click(function(){
			if($("#user_id").val() ==""){
				alert("아이디를 입력해주세요.");
				$("#user_id").focus();
				return false;
			}
			if($("#user_email").val() ==""){
				alert("E-mail를  입력해주세요.");
				$("#user_email").focus();
				return false;
			}
			var user_id =$("#user_id").val();
			var user_email =$("#user_email").val();
			find_user_pw(user_id,user_email);
		});
	});
	function find_user_pw(id,email){
		$.ajax({
			type: "POST", // GET, POST
			dataType: "text", // json, text
			url: "/ajax/find_user_pw.php",
			data: "user_id="+id+"&user_email="+email,
			success: function(data, textStatus){
				data = JSON.parse(data); // text -> json
				if(data.check =="Y"){
					//$("#c_idx").val(data.c_idx);
					//$("#user_id").val(data.user_id);
					$("#frm").submit();
				}else{
					alert(data.msg);
				}
				
			},
			error: function(xhr, textStatus, Thrown){ // ajax 오류
				console.log("error : "+textStatus+" -> "+Thrown);
			}
		});
	}
</script>