<?php
include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
?>
<div class="text-center container mt-5" style="max-width:350px;">
  <form method="post" action ="login_check.php" class="form-signin">
    <img class="mb-4" src="/img/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">로그인</h1>
    <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="이메일주소" required="" autofocus="">
      <input type="password" name="password" class="form-control" placeholder="비밀번호" required="">
    </div>
    <div class="check-box mb-3">
      <input type="checkbox" value="remember-me">&nbsp;이메일 기억하기<span>&nbsp;&nbsp;</span>
      <input type="checkbox" value="remember-me">&nbsp;비밀번호 기억하기
    </div>

    <div class="top_margin"></div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
  </form>
  <div class="form-row mt-2">
    <div class="form-group col-md-4">
      <a class="btn btn-sm btn-outline-success btn-block" href="#" role="button">이메일찾기</a>
    </div>
    <div class="form-group col-md-4">
      <a class="btn btn-sm btn-outline-success btn-block" href="#" role="button">비밀번호찾기</a>
    </div>
    <div class="form-group col-md-4">
      <a class="btn btn-sm btn-outline-success btn-block" href="signup.php" role="button">회원가입하기</a>
    </div>
  </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>
