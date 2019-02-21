<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">고객리스트 화면입니다!</h1>
    <p class="lead">고객이란 입주한 세입자 및 문의하는 예비고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
  </div>

  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <div class="row">
    <div class="col-sm">
      <div class="d-flex flex-row">
        <label>등록일자</label>
      </div>
      <div class="d-flex flex-row">
        <div class="float-left">
          <button type="button" class="btn btn-sm btn-info" name="button">전월</button>
          <button type="button" class="btn btn-sm btn-info" name="button">당월</button>
          <button type="button" class="btn btn-sm btn-info" name="button">익월</button>
        </div>
      </div>

    </div>
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
      One of three columns
    </div>
  </div>
  </div>
  <div class="d-flex flex-row-reverse">
    <div class="float-right">
      <button type="button" class="btn btn-secondary" name="button">삭제</button>
      <a href="m_c_add.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
    </div>
  </div>
  <div class="mt-3">
    <table class="table">
      <thead>
        <th scope="col"></th>
        <th scope="col">순번</th>
        <th scope="col">구분</th>
        <th scope="col">고객명</th>
        <th scope="col">연락처</th>
        <th scope="col">이메일</th>
        <th scope="col">특이사항</th>
        <th scope="col"></th>
      </thead>

    </table>
  </div>

</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
