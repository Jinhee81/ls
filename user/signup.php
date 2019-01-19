<?php
include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
 ?>
 <div class="jumbotron">
   <h3 class="display-4">회원가입해주세요!</h3>
   <hr class="my-4">
   <!-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
   <a class="btn btn-primary btn-sm" href="#" role="button">비밀번호변경 클릭</a> -->
 </div>
<div class="container" style="max-width:500px;">
  <form method="post" action ="signup_proccess.php" class="form-signin" id="signup_form">
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-8">
          <input type="email" name="email" id="chk_email1" class="form-control" placeholder="이메일주소" required="" autofocus="">
        </div>
        <div class="form-group col-md-4">
          <input type="button" class="form-control" value="중복체크" onclick="email_check();">
          <input type=hidden id="chk_email2" name="chk_email2" value="0">
          <!-- hidden 이건 중복체크했는지 안했는지 판단하는 bool변수 -->
        </div>
      </div>

      <!-- <script>
      if(getElementById("chk_id2").value === "1"){
        getElementById("chk_id1").value
      }
      </script> -->

      <input type="password" name="password" id="password" class="form-control" placeholder="비밀번호" required="" onclick="email_check_re();">
      <input type="password" name="password_again" id="password_again" class="form-control" placeholder="비밀번호 확인" required="" onblur="tocheckpw1();">
      <label id="password_check_id"></label>
    </div>

    <div class="form-group">
      <label>회원구분</label>
      <div class="form-row">
        <div class="form-group col-md-4">
          <select name="user_div" class="form-control" onclick="tocheckpw2();">
            <option value="개인">개인</option>
            <option value="개인사업자">개인사업자</option>
            <option value="법인사업자">법인사업자</option>
          </select>
        </div>
        <div class="form-group col-md-8">
          <input type="text" name="user_name" class="form-control"      placeholder="회원명" required="" autofocus="" onclick="final_check();">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>담당자 정보</label>
      <div class="form-row">
        <div class="form-group col-md-4 mb-1">
          <input type="text" name="damdangga_name" class="form-control" placeholder="담당자명">
        </div>
        <div class="form-group col-md-8 mb-1">
          <input type="text" name="cellphone" class="form-control"      placeholder="담당자 휴대폰번호" required="" autofocus="">
        </div>
      </div>
      <button type="submit" name="cellphone_auth" class="btn btn-sm btn-primary btn-block">휴대폰번호인증</button>
    </div>

    <div class="form-group">
      <label>임대유형</label>
      <select name="lease_type" class="form-control">
        <option value="공유오피스">공유오피스</option>
        <option value="원룸">원룸</option>
        <option value="빌딩">빌딩</option>
        <option value="고시원">고시원</option>
        <option value="창고">창고</option>
        <option value="임대관리회사">임대관리회사</option>
        <option value="기타">기타</option>
      </select>
    </div>

    <div class="form-group">
      <label>가입경로</label>
      <select name="regist_channel" class="form-control">
        <option value="메일수신">메일수신</option>
        <option value="문자메시지">문자메시지</option>
        <option value="지인권유">지인권유</option>
        <option value="인터넷검색">인터넷검색</option>
        <option value="기타">기타</option>
      </select>
    </div>

    <div class="form-group">
      <input type="hidden" name="created" value="">
    </div>

    <div class="top_margin"></div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="button_signup" disabled="">회원가입</button>
  </form>
  <iframe src="" id="ifrm1" scrolling=no frameborder=no width=100 height=100 name="ifrm1"></iframe>
  <!-- 중복검사하는 눈에 안보이는 iframe만든것 -->
</div>

<script>
 function email_check(){ //이메일중복체크
  document.getElementById("chk_email2").value=0;
  var email = document.getElementById("chk_email1").value;

  if(email==""){
  alert("빈칸 안되요!");
  exit();
  }

  ifrm1.location.href="signup_check.php?email="+email;
 }
 function email_check_re(){ //이메일중복체크 다시
   if(document.getElementById("chk_email2").value != "1"){
     alert("이메일중복체크를 하세요");
     exit();
   }
 }
 function tocheckpw1() { //비밀번호체크
     var pw = document.getElementById("password").value;
     var pwck = document.getElementById("password_again").value;
     document.getElementById('password_check_id').value=0;
     // bool_pass = 0;

     if (pw != pwck) {
       document.getElementById('password_check_id').innerHTML="비밀번호와 비밀번호확인 값이 다릅니다.";
     } else {
       document.getElementById('password_check_id').innerHTML="비밀번호가 일치합니다.";
       document.getElementById('password_check_id').value=1;
       document.getElementById('button_signup').disabled = false;
     }
 }
 function tocheckpw2(){
   if(document.getElementById('password_check_id').value===0){
     alert('비밀번호가 일치해야 진행됩니다.');
   }
 }

 function final_check(){
   var button_signup = document.getElementById('button_signup');
   if(document.getElementById("chk_email2").value===1 && document.getElementById('password_check_id').value===1) {
     button_signup.disabled = true;
   } else {
     return false;
   }
 }
</script>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>

<form>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
          <label class="form-check-label" for="gridRadios1">
            First radio
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
          <label class="form-check-label" for="gridRadios2">
            Second radio
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
          <label class="form-check-label" for="gridRadios3">
            Third disabled radio
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-2">Checkbox</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Example checkbox
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>
