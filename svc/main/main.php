<?php
session_start();

if(!isset($_SESSION['is_login'])){
  echo "<meta http-equiv='refresh' content='0; url=/svc/login.php'>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>리스맨홈</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
?>

<div class="alert alert-primary alert-dismissible fade show" role="alert">
리스맨은 '크롬브라우저'에서 최적으로 작동합니다. 크롬브라우저에서 실행해주세요 ^__^ <a href="https://www.google.com/intl/ko/chrome/" class="alert-link" target="_blank">다운로드 바로가기</a>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include "condition.php";
include "m_schedule.php";
?>
<!-- <section class="container">
  <div class="row">
    <div class="col bg-light text-dark border border-info rounded">
      <h5>건물현황</h5>
    </div>
    <div class="col bg-light text-dark border border-info rounded">
      <h5>보낸문자리스</h5>
    </div>
  </div>
</section> -->

<section class="container">
  <div class="card-deck mt-3">
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">관계자</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">임대계약</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
  <div class="" style="height:20px;">

  </div>
  <div class="card-deck">
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">입금예정</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">입금완료</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
</body>
</html>
