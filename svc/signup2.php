<!-- 고민하다가 회원가입시 휴대폰번호인증은 없애기로함, 이메일인증만 있으면 될것같음 -->
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/header.php";
 ?>
 <div class="jumbotron">
   <h3 class="display-4">회원가입해주세요!</h3>
   <hr class="my-4">
   <p>회원가입 후 30일 무료이용 가능합니다. 그리고 1000코인이 무료로 지급됩니다.</p>
   <!-- <a class="btn btn-primary btn-sm" href="#" role="button">비밀번호변경 클릭</a> -->
 </div>
<div class="container" style="max-width:500px;">
  <form method="post" action ="signup_proccess2.php" class="form-signin" id="signup_form">
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-8 mb-0">
          <input type="email" name="email" id="chk_email1" class="form-control" placeholder="이메일주소" required="" autofocus="">
        </div>
        <div class="form-group col-md-4 mb-0">
          <input type="button" class="form-control" value="중복체크" onclick="email_check();">
          <input type=hidden id="chk_email2" name="chk_email2" value="0">
          <!-- hidden 이건 중복체크했는지 안했는지 판단하는 bool변수 -->
        </div>
      </div>
      <div class="form-group">
        <small>사용하는 이메일 계정을 넣어주세요(휴면 또는 미사용중인 이메일은 넣지 말아주세요)</small>
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
        <div class="form-group col-md-3">
          <select name="user_div" class="form-control" onclick="tocheckpw2();">
            <option value="개인">개인</option>
            <option value="사업자">사업자</option>
            <!-- <option value="개인사업자">개인사업자</option>
            <option value="법인사업자">법인사업자</option> -->
          </select>
        </div>
        <div class="form-group col-md-9" id="user_div_content">
          <input type="text" name="user_name" class="form-control"    placeholder="성명" required="" onclick="final_check();">
          <!-- <div class="form-row">
            <div class="form-group col">
              <input type="text" class="form-control" name="user_name" placeholder="사업자명" onclick="final_check();">
            </div>
            <div class="form-group col">
              <input type="text" class="form-control" name="manager_name" placeholder="담당자" onclick="final_check();">
            </div>
          </div> -->
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>연락처</label><br>
      <input type="text" name="cellphone" class="form-control"      placeholder="휴대폰번호" required>
      <button type="button" name="cellphone_auth" class="btn btn-sm btn-primary btn-block">휴대폰번호인증</button>
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
      <div name="lease_etc">

      </div>
    </div>

    <div class="form-group" name="">
      <label>가입경로</label>
      <select name="regist_channel" class="form-control">
        <option value="메일수신">메일수신</option>
        <option value="문자메시지">문자메시지</option>
        <option value="지인권유">지인권유</option>
        <option value="인터넷검색">인터넷검색</option>
        <option value="기타">기타</option>
      </select>
      <div name="regist_etc">

      </div>
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
     return false;
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

 // function isNumber(event){
 //   var keycode = event.keyCode;
 //   if(keycode > 48 && keycode < 57){
 //     return true;
 //   } else {
 //     return false;
 //   }
 // }
 //
 // $('input[name=cellphone]').on('keypress', function(){
 //   isNumber(event);
 // }) //이거를 했는데 잘 안되네 ㅠ

 function final_check(){
   var button_signup = document.getElementById('button_signup');
   if(document.getElementById("chk_email2").value===1 && document.getElementById('password_check_id').value===1) {
     button_signup.disabled = true;
   } else {
     return false;
   }
 }

 $('select[name=user_div]').on('change', function(){
   // if($(this).val()==='사업자'){
   //   $('input[name=user_name]').attr('placeholder', '사업자명');
   // } else {
   //   $('input[name=user_name]').attr('placeholder', '성명');
   // }

   if($(this).val()==='사업자'){
     $('#user_div_content').html('<div class="form-row"><div class="form-group col"><input type="text" class="form-control" name="user_name" placeholder="사업자명" onclick="final_check();"></div><div class="form-group col"><input type="text" class="form-control" name="manager_name" placeholder="담당자명" onclick="final_check();"></div></div>');
   } else {
     $('#user_div_content').html('<input type="text" name="user_name" class="form-control" placeholder="성명" required="" onclick="final_check();">');
   }
 })

 $('select[name=lease_type]').on('change', function(){
   // console.log($(this).val());

   if($(this).val() === '기타'){
     var etc_lease = "<input type='text' class='form-control' name='lease_type_text' required>";
     $('div[name=lease_etc]').html(etc_lease);
   } else {
     $('div[name=lease_etc]').empty();
   }

 })

 $('select[name=regist_channel]').on('change', function(){
   // console.log($(this).val());

   if($(this).val() === '기타'){
     var etc_regist = "<input type='text' class='form-control' name='regist_channel_text' required>";
     $('div[name=regist_etc]').html(etc_regist);
   } else {
     $('div[name=regist_etc]').empty();
   }

 })


</script>

<?php
include("./view/service_footer.php");
?>
