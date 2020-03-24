<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php";
	if($login_ckeck){
		alert_msg("","./login_check2.php?login_check=".$login_ckeck);
	}
	if ($_SESSION[customer][id])
	{
		header('Location:/main/main.php');
		exit();
	}


//	echo $_SESSION[customer][level];
?>

<!DOCTYPE html>
<html lang="ko">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no, address=no, email=no" />

	<meta property="og:title" content="LEASEMAN"  />
	<meta property="og:description" content="임대관리 전문시스템 리스맨"  />
	<meta property="og:image" content="http://sv.leaseman.co.kr/img/main/meta_logo.png" />
	<meta property="og:url" content="http://sv.leaseman.co.kr/" />

	<link href="../css/common.css" rel="stylesheet" type="text/css"/>
	<link href="../css/login.css" rel="stylesheet" type="text/css"/>
	<script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="../js/jquery-ui.min.js" type="text/javascript"></script>
	<link href="../img/ico/leaseman.ico" rel="icon" type="image/x-icon">

	<script src="/js/notifIt.js" type="text/javascript"></script>
	<link href="/js/notifIt.css" type="text/css" rel="stylesheet">
	<!--notice 스크립트끝-->
	<script src="/js/common.js"></script>
	<script src="/js/jquery.form.js"></script>
	<!--[if lt IE 9]>
		<script src="../js/html5shiv.js"></script>
		<script src="../js/html5shiv-printshiv.js"></script>
	<![endif]-->
	<title>로그인</title>
</head>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header_inner">
				<h1><img src="../img/index/tit_txt.png" alt="임대관리 전문시스템v1.0" /></h1>
			</div>
		</header>
		<section id="index_main">
			<div class="login_form">
				<form action="login_check.php" method="post" name="loginForm">
					<fieldset>
						<div class="login_form_inner">
							<h2><img src="../img/index/logo_txt.png" alt="" /></h2>

							<div class="input_id input_set">
								<input type="text" placeholder="ID" onfocus="this.placeholder=''" onblur="this.placeholder='ID'"  name="user_id" id="user_id" value="" onkeyup="javascript:press_it()" style="ime-mode:disabled" >
							</div>
							<div class="input_pw input_set">
								<input type="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" name="user_pw" value=""  onkeyup="javascript:press_it()">
							</div>
							<!-- <div class="agree">
								<span><input type="checkbox" name="saveId" value="Y"  class="input_checkbox"  onkeypress="javascript:press_it()" /> <label for="">아이디 저장</label></span>
								<span><a href="#">아이디패스워드찾기</a></span>
							</div> -->

							<div class="check_list">
								<label for="saveId"><input type="checkbox" name="saveId" id="saveId" value="Y"  class="input_checkbox"  onkeypress="javascript:press_it()" /> <span></span>아이디 저장</label>

								<label for="saveId2"><input type="checkbox" name="saveId2" id="saveId2" value="Y"  class="input_checkbox"  onkeypress="javascript:press_it()" /> <span></span>자동 로그인</label>
							</div>
							<div class="log_in">
								<ul>
									<li><a href="http://www.leaseman.co.kr/membership/login.php" target="blank_" alt="리스맨 홍보페이지로 이동">회원가입</a></li>
									<li><a href="http://www.leaseman.co.kr/membership/find_id.php" target="blank_" alt="리스맨 홍보페이지로 이동">아이디 찾기</a></li>
									<li><a href="http://www.leaseman.co.kr/membership/find_password.php" target="blank_" alt="리스맨 홍보페이지로 이동">비밀번호 찾기</a></li>
								</ul>
							</div>

							<div class="btn_wrap">
								<button type="button" onClick="loginSendit();"><img src="../img/index/login_btn.png" alt="로그인 버튼"></button>
							</div>
							<div class="login_cont">

								<p class="mb5">
									본 사이트는 권한을 가진 회원분들만 접근이 가능합니다. <br />본인의 아이디와 비밀번호를 입력하신 후 로그인하시기 바랍니다.
								</p>
								<p>
									문의전화 : 031-879-8003 <br />
									이메일 : info@leaseman.co.kr
								</p>
							</div>

							<div class="copy">
								<p>COPYRIGHT ⓒ 2017 BIZFFICE CORPRATION ALL RIGHT RESERVED.</p>
							</div>
						</div>
					</fieldset>
				</form>
				<div class="login_cont_mo">
					<ul class="f_txt">
						<li>본 사이트는 권한을 가진 회원분들만 접근이 가능합니다.</li>
						<li>본인의 아이디와 비밀번호를 입력하신 후 로그인하시기 바랍니다.</li>
					</ul>
				</div>
			</div>
		</section>
	</div>
</body>
</html>



<script>
function loginSendit()
{
	var form=document.loginForm;
	if(form.user_id.value=="" || form.user_id.value=="아이디" ){
		alert_("아이디를 입력해 주십시오.");
		form.user_id.value = "";
		form.user_id.focus();
		return ;
	}
	if(form.user_pw.value=="" || form.user_pw.value=="비밀번호" ){
		alert_("비밀번호를 입력해 주십시오.");
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

	if(form.saveId2.checked)
	{
		saveLogin2(form.user_pw.value);
	} else {
		saveLogin2("");
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
   var pw = getCookie("user_pw");

   // 가져온 쿠키값이 있으면
   if(id != "")
   {
     form.user_id.value = id;
     form.saveId.checked = true;
   }

   if(pw != "")
   {
     form.user_pw.value = pw;
     form.saveId2.checked = true;
   }

   if(id != "" && pw != ""){
		form.submit();
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
 function saveLogin(id){

   if(id != "")
   {
     // user_id 쿠키에 id 값을 70일간 저장
     setCookie("user_id", id, 700);
   }
   else
   {
     // user_id 쿠키 삭제
     setCookie("user_id", id, -1);
   }

 }


 function saveLogin2(pw){


   if(pw != "")
   {
     // user_pw 쿠키에 id 값을 70일간 저장
     setCookie("user_pw", pw, 700);
   }
   else
   {
     // user_id 쿠키 삭제
     setCookie("user_pw", pw, -1);
   }
 }


getLogin();



$(document).ready(function(){
	var saveId = getCookie("saveId");

	if(saveId != ""){
		//$("#saveId").prop("checked",true);
		$("#user_id").val(saveId);
	}

});
</script>
