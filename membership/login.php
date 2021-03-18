<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
if($check_login){
	alert_msg("이미로그인 중입니다.","/");
}
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="wrap_1000">	
				<div class="login">
					<h2>로그인</h2>
					<form action="login_check.php" method="post" name="loginForm">
						<div class="login_box">
							<h3><span>리스맨</span>에 오신것을 환영합니다!</h3>
							<p>리스맨 홈페이지를 방문해 주셔서 감사합니다.
							<br />항상 고객을 위해 노력하는 리스맨이 되도록 하겠습니다.</p>
							<div class="login_form">
								<div>	
									<input type="text" placeholder="아이디" name="user_id" value="" onkeyup="javascript:press_it()" >
									<input type="password" placeholder="비밀번호" name="user_pw" value=""  onkeyup="javascript:press_it()">
								</div>
								<b class="go_btn">
									<a href="#!" onClick="loginSendit();">로그인</a>
								</b>
							</div>
							<span class="id_save"><input type="checkbox" class="id_check" name="saveId" value="Y">아이디 저장</span>
							<div class="link_box">	
								<b class="on_btn">
									<a href="../membership/membership.php">회원가입</a>
								</b>
								<b class="on_btn">
									<a href="../membership/find_id.php">아이디 찾기</a>
								</b>
								<b class="on_btn">
									<a href="../membership/find_password.php">비밀번호 찾기</a>
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
function loginSendit()
{
	var form=document.loginForm;
	if(form.user_id.value=="" || form.user_id.value=="아이디" ){
		alert("아이디를 입력해 주십시오.");
		form.user_id.value = "";
		form.user_id.focus();
		return ;
	}
	if(form.user_pw.value=="" || form.user_pw.value=="비밀번호" ){
		alert("비밀번호를 입력해 주십시오.");
		form.user_pw.value = "";
		form.user_pw.focus();
		return ;
	}

	if(form.saveId.checked) 
	{
		saveLogin(form.user_id.value);
	} else {
		saveLogin("");
	}

	form.submit();
}


function press_it()
{
	if(event.keyCode == 13)
	{
		loginSendit();
	}
 }


function focusin() {
	document.loginForm.user_id.focus();
}

 // 쿠키값 가져오기
 function getCookie(key)
 {
    var cook = document.cookie + ";";
    var idx =  cook.indexOf(key, 0);
    var val = "";

    if(idx != -1)
    {
      cook = cook.substring(idx, cook.length);
      begin = cook.indexOf("=", 0) + 1;
      end = cook.indexOf(";", begin);
      val = unescape( cook.substring(begin, end) );
    }

    return val;
 }

 // 쿠키값 설정
 function setCookie(name, value, expiredays)
 {
    var today = new Date();
    today.setDate( today.getDate() + expiredays );
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";"
 }

 // 쿠키에서 로그인 정보 가져오기
 function getLogin()
 {
   var form = document.loginForm;

   // user_id 쿠키에서 id 값을 가져온다.
   var id = getCookie("user_id");

   // 가져온 쿠키값이 있으면
   if(id != "")
   {
     form.user_id.value = id;
     form.saveId.checked = true;
   }
 }
 //암호화
 function Encrypt(theText)
 {
  output = new String;
  Temp = new Array();
  Temp2 = new Array();
  TextSize = theText.length;
  for (i = 0; i < TextSize; i++)
  {
   rnd = Math.round(Math.random() * 122) + 68;
   Temp[i] = theText.charCodeAt(i) + rnd;
   Temp2[i] = rnd;
  }
  for (i = 0; i < TextSize; i++)
  {
   output += String.fromCharCode(Temp[i], Temp2[i]);
  }
  return output;
 }

 //복호화
 function unEncrypt(theText)
 {
  output = new String;
  Temp = new Array();
  Temp2 = new Array();
  TextSize = theText.length;
  for (i = 0; i < TextSize; i++)
  {
   Temp[i] = theText.charCodeAt(i);
   Temp2[i] = theText.charCodeAt(i + 1);
  }
  for (i = 0; i < TextSize; i = i+2)
  {
   output += String.fromCharCode(Temp[i] - Temp2[i]);
  }
  return output;
 }

 // 쿠키에 로그인 정보 저장
 function saveLogin(id)
 {

   if(id != "")
   {
     // user_id 쿠키에 id 값을 7일간 저장
     setCookie("user_id", id, 70);
   }
   else
   {
     // user_id 쿠키 삭제
     setCookie("user_id", id, -1);
   }
 }
getLogin();
</script>