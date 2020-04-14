<?php
session_start();
// if(!isset($_SESSION['is_login'])){
//   header('Location: /user/login.php');
// }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>리스맨홈</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."svc/view/service_header1_meta.php";
?>

<div class="alert alert-primary alert-dismissible fade show" role="alert">
리스맨은 '크롬브라우저'에서 최적으로 작동합니다. 크롬브라우저에서 실행해주세요 ^__^ <a href="https://www.google.com/intl/ko/chrome/" class="alert-link" target="_blank">다운로드 바로가기</a>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT']."svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."svc/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."svc/main/m_schedule.php";
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
  <div class="card-deck">
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">관리물건</h4>
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
          <h4 class="my-0 font-weight-normal">일정</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">오늘 일정 : <?=$row_today[0]?>건
          <?php
            if(mb_strlen($todayScheduleStr) > 10){
              echo "(".mb_substr($todayScheduleStr,0,10)."...)";
            } else {
              echo "(".$todayScheduleStr.")";
            }
           ?>
        </h5>
        <p class="card-text">내일 일정 : <?=$row_tomorrow[0]?>건
          <?php
            // echo mb_strlen($tomorrowScheduleStr);
            if(mb_strlen($tomorrowScheduleStr) > 10){
              echo "(".mb_substr($tomorrowScheduleStr,0,10)."...)";
            } else {
              echo "(".$tomorrowScheduleStr.")";
            }
           ?>
        </p>
        <!-- <p class="card-text"><small class="text-muted">3분전 업데이트</small></p> -->
        <a href="svc/service/schedule/schedule.php" class="btn btn-primary btn-sm" target="_blank">상세보기</a>
      </div>
    </div>
  </div>
  <div class="" style="height:20px;">

  </div>
  <div class="card-deck">
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">보낸문자</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        <a href="/service/sms/sent.php" class="btn btn-primary btn-sm" target="_blank">상세보기</a>
      </div>
    </div>
    <div class="card">
      <!-- <img src="" class="card-img-top" alt="..."> -->
      <div class="card-header">
          <h4 class="my-0 font-weight-normal">입금예정</h4>
        </div>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
