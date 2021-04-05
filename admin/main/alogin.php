<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/view/admin_header.php";
?>
<div class="text-center container mt-5" style="max-width:800px;">

    <img class="mb-4" src="/admin/inc/img/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">임대관리시스템 리스맨 관리자페이지 입니다!</h1>


    <div class="text-center container mt-5" style="max-width:350px;">
      <form method="post" action ="alogin_check.php" class="form-signin">
        <div class="form-group">
          <input type="text" name="id" class="form-control" placeholder="아이디" required="" autofocus="">
          <input type="password" name="password" class="form-control" placeholder="비밀번호" required="">
        </div>
          <div class="top_margin"></div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
      </form>

    </div>




</div>

<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/view/footer.php";
?>
