<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<script src="m_c_add_element.js"></script>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">고객등록 화면입니다!</h1>
    <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
    <hr class="my-4">
    <small>(1) * 표시는 필수입력값입니다. (2) 구분(대)의 값이 '고객'이어야 임대계약 등록이 가능합니다. (3) '고객'이란 단어는 세입자 또는 입주자를 의미합니다.</small>
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action ="p_m_c_add.php"> <!--문의고객 입력-->
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>구분(대)</label>
      </div>
      <div class="form-group col-md-8">
        <select id="customer_div1" name="div1" class="form-control" onchange="div1Get();">
          <option value="문의고객">문의고객</option>
          <option value="진행고객" selected>고객</option>
          <option value="거래처">거래처</option>
        </select>
      </div>
    </div>
    <div class="form-row" id="idDiv2Large">
      <div class="form-group col-md-4">
        <label>구분(소)</label>
      </div>
      <div class="form-group col-md-8 text-center">
        <select id="idDiv2" name="div2" class="form-control" onchange="div2Get();">
          <option value="개인">개인</option>
          <option value="개인사업자">개인사업자</option>
          <option value="법인사업자">법인사업자</option>
        </select>
      </div>
    </div>
    <div id="gubun2Id">
    </div>
    <div id="centerSection">
    </div>
    <div class="">
      <button type='submit' class='btn btn-primary'>저장</button>
      <a href='customer.php'><button type='button' class='btn btn-secondary'>취소/돌아가기</button></a>
    </div>
  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
