<body>
	<div id="wrap" class="gnbOn">
		<header id="header">
				<div class="top_menu">
					<div class="wrap_1000">
						<ul>
							<li><a href="#!">로그인</a></li>
							<li><a href="#!">회원가입</a></li>
							<li><a href="#!">원격지원</a></li>
						</ul>
					</div>
				</div>
			</div>
			<a href="#!" class="gnb_menu">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</a>
			<div class="header_body clearfix">
				<div class="wrap_1000">
					<h1 class="logo"><a href="../index.php"><img src="../img/ico/logo.png" alt="리스맨 로고" /></a></h1>
					<p id="open_on" class="log_in">LOGIN<img src="../img/ico/log_on.png"></p>
					<nav id="gnb">
						<? include('../inc/gnb_inc.php');?>
					</nav>
					<nav id="gnb_mo">
						<a href="../index.php" class="gnb_logo"><img src="../img/mobile/logo.png" alt="리스맨 로고" /></a>
						<? include('../inc/gnb_inc.php');?>
					</nav>
				</div>
			</div>
		<div class="layer_bg"></div>
		</header><!--header_end-->

		<div class="bg" id="modal_content">
			<div class="login" >
				<h2>로그인
					<b class="close_btn" id="close">
						<img src="../img/btn/close_btn.png">
					</b>
				</h2>
				<div class="login_box">
					<b>아이디와 비밀번호를 입력해주세요</b>
					<p>로그인을 하시면 다양한 김차장의 혜택을 받으실 수 있습니다.</p>
					<div class="input_box">
						<input type="text" name="on_id" id="on_id" placeholder="admin">
						<b class="log_on"><a href="#">로그인</a></b>
						<input type="password" name="on_pw" id="on_pw">

					</div>
					<span>회원이 아니세요?</span>
					<b class="go_join_membership" id="open">회원가입</b>
				</div>
			</div>
		</div>
		<div class="bg2" id="modal_content2">
			<div class="join_membership">
				<h2>회원가입
					<b class="close_btn" id="close">
						<img src="../img/btn/close_btn.png">
					</b>
				</h2>
				<p>회원가입을 하시면 이벤트에 참여하실 수 있습니다.</p>
				<input type="email" name="user_email" id="user_email" placeholder = "이메일을 입력해주세요 ex)555@naver.com" class="join_first">
				<input type="text" name="user_name" id="user_name" placeholder = "이름을 입력해주세요">
				<input type="tel" name="mobile" id="mobile" placeholder = "휴대전화를 입력해주세요 ex) 000-0000-0000">
				<input type="password" name="user_pw" autocomplete="new-password" id="user_pw" placeholder = "비밀번호를 입력해주세요 ">
				<b class="join_on"><a href="#!"  id="join_on_btn">가입완료</a></b>
			</div>
		</div>
		<script type="text/javascript" src="../js/jquery.simplemodal.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var check_login ='<?=$is_member?>'; //회원 로그인인지 확인 
				if(check_login ==""){ //비로그인 일때
					$("#open_on , #open_on2").click(function(){
						$("#modal_content").modal(); 
					 });

					$("#close , #open").click(function(){
						$.modal.close();
					});
					
					$("#open").click(function(){
						$("#modal_content2").modal(); 
					});

					$("#close").click(function(){
						$.modal.close();
					});
				}else{ //로그아웃
					$("#open_out").click(function(){
						log_out();
					 });
				}
			}); 

			//로그인 하기
			$(".log_on").click(function(){
				if($("#on_id").val()==""){
					alert("ID를 입력해주세요.");
					$("#on_id").focus();
					return false;
				}
				if($("#on_pw").val()==""){
					alert("비밀번호를 입력해주세요.");
					$("#on_pw").focus();
					return false;
				}
				var user_id =$("#on_id").val();
				var user_pw =$("#on_pw").val();
				login_check(user_id,user_pw);
			});

			//회원가입 하기
			$("#join_on_btn").click(function(){
				if($("#user_email").val() ==""){
					alert("이메일을 입력해주세요.");
					$("#user_email").focus();
					return false;
				}
				if($("#user_name").val() ==""){
					alert("이름을 입력해주세요.");
					$("#user_name").focus();
					return false;
				}
				if($("#mobile").val() ==""){
					alert("휴대폰번호를 입력해주세요.");
					$("#mobile").focus();
					return false;
				}
				if($("#user_pw").val() ==""){
					alert("비밀번호를 입력해주세요.");
					$("#user_pw").focus();
					return false;
				}
				
				check_email(user_email);
				
				
			});

			function login_check(user_id, user_pw){ //log in
				$.ajax({
					url: "/inc/login_check.php",
					type: "POST",
					data: "user_id="+user_id+"&user_pw="+user_pw,
					error : function(request, status, error) {
					 //통신 에러 발생시 처리
						alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
						$("#ajax_loader").addClass("display-none");
					}
					,complete: function(request, status, error) {
						$("#ajax_loader").addClass("display-none");
					}
					, success : function(response, status, request) {
						data =JSON.parse(response);
						
						if(data.stat ==1){
							alert(data.msg);
						}else{
							alert(data.msg);
							location.reload();
						}

					}
				});
			}
			function log_out(){ //log out
				$.ajax({
					url: "/inc/logout.php",
					type: "POST",
					data: "check=1",
					error : function(request, status, error) {
					 //통신 에러 발생시 처리
						alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
						$("#ajax_loader").addClass("display-none");
					}
					,complete: function(request, status, error) {
						$("#ajax_loader").addClass("display-none");
					}
					, success : function(response, status, request) {
						location.reload();
					}
				});
			}
			function add_join(user_email,user_name,mobile, user_pw){ //add member (회원 가입)
				$.ajax({
					url: "/inc/join_member.php",
					type: "POST",
					data: "user_email="+user_email+"&user_pw="+user_pw+"&user_name="+user_name+"&mobile="+mobile+"&mode=add",
					error : function(request, status, error) {
					 //통신 에러 발생시 처리
						alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
						$("#ajax_loader").addClass("display-none");
					}
					,complete: function(request, status, error) {
						$("#ajax_loader").addClass("display-none");
					}
					, success : function(response, status, request) {
						data2 =JSON.parse(response);
						
						if(data2.stat ==1){
							alert(data2.msg);
						}else{
							alert(data2.msg);
							location.reload();
						}

					}
				});
			}
			function check_email(user_email){ //check email (회원 가입 메일 체크)
				//메일 확인 체크 및 id체크
				var user_email =$("#user_email").val();
				var user_name =$("#user_name").val();
				var mobile =$("#mobile").val();
				var user_pw =$("#user_pw").val();
				$.ajax({
					url: "/inc/check_email.php",
					type: "POST",
					data: "user_email="+user_email,
					error : function(request, status, error) {
					 //통신 에러 발생시 처리
						alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
						$("#ajax_loader").addClass("display-none");
					}
					,complete: function(request, status, error) {
						$("#ajax_loader").addClass("display-none");
					}
					, success : function(response, status, request) {
						data =JSON.parse(response);
						
						if(data.stat ==1){
							alert(data.msg);
							$("#user_email").val("");
							$("#user_email").focus();
							return false;
						}else{
						
							add_join(user_email,user_name,mobile,user_pw);
						}
					}
				});
			}

		</script>