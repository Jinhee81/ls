<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>세입자등록</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
?>


<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">입주자 등록 화면입니다!</h1>
    <p class="lead">
      (1)입주한 사람(또는 법인) 뿐만아니라 거래처를 등록할 수 있습니다.<br>
      (2)<a href="m_c_adds.php" target="_blank">'일괄등록'</a>화면에서 여러명의 입주자를 등록하세요.
    </p>
    <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다.(2) 구분(대)의 값이 '입주자'이어야 임대계약 등록이 가능합니다. (3)'일괄등록','csv등록'은 데스크탑 디스플레이에서 사용가능 </small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm mobile" href="m_c_adds.php" role="button">일괄등록</a>
    <a class="btn btn-primary btn-sm mobile" href="m_c_add_csv1.php" role="button">csv등록</a>
    <button type="button" class="btn btn-primary btn-sm mobile" href="#" data-toggle="tooltip" data-placement="top" title="곧 구현할예정입니다">문의고객등록</button>
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action ="p_m_c_add.php">
    <div class="form-row" id="section1">
      <div class="form-group col-md-3">
        <p>구분</p>
      </div>
      <div class="form-group col-md-4">
        <select name="div1" class="form-control">
          <option value="입주자">입주자</option>
          <option value="거래처">거래처</option>
          <option value="기타">기타</option>
        </select>
      </div>
    </div>
    <div id="section3">
      <div class="form-row">
        <div class="form-group col-md-3">
          <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>성명</p>
          <input type='text' name='name' class='form-control' required maxlength='9'>
        </div>
        <div class="form-group col-md-5">
          <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>연락처</p>
          <div class='form-row'>
            <div class='form group col-md-4'>
              <input type='number' name='contact1' id='contact1' class='form-control' maxlength='3' value='010' required>
            </div>
            <div class='form group col-md-4'>
              <input type='number' name='contact2' id='contact2' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);'>
            </div>
            <div class='form group col-md-4'>
              <input type='number' name='contact3' id='contact3' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </div>
        <div class="form-group col-md-3">
          <p class="mb-1">성별</p>
          <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' name='gender' id='inlineRadio1' value='남'>
            <label class='form-check-label'>남</label>
          </div>
          <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' name='gender' id='inlineRadio2' value='여'>
            <label class='form-check-label'>여</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <p class="mb-1">사업자구분</p>
          <select name="div3" class="form-control">
            <option value=""></option>
            <option value="주식회사">주식회사</option>
            <option value="유한회사">유한회사</option>
            <option value="합자회사">합자회사</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <p class="mb-1">사업자명</p>
          <input type='text' name='companyname' class='form-control' maxlength='14'>
        </div>
        <div class="form-group col-md-5">
          <p class="mb-1">사업자번호</p>
          <div class='form-row'>
            <div class='form group col-md-4'>
              <input type='number' name='cNumber1' class='form-control' maxlength='3' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form group col-md-3'>
              <input type='number' name='cNumber2' class='form-control' maxlength='2' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form group col-md-5'>
              <input type='number' name='cNumber3' class='form-control' maxlength='5' oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <p class="mb-1">업태</p>
          <input type='text' name='div4' class='form-control' maxlength='9'>
        </div>
        <div class="form-group col-md-3">
          <p class="mb-1">종목</p>
          <input type='text' name='div5' class='form-control' maxlength='9'>
        </div>
        <div class="form-group col-md-6">
          <p class="mb-1">이메일</p>
          <input type='email' name='email' class='form-control' maxlength='40'>
        </div>
      </div>
      <div class='form-group'>
        <div class='form-row'>
          <p class="mb-1">주소</p>
        </div>
        <div class='form-row'>
          <div class='form-group col-md-3'>
            <input type='text' id='sample2_postcode' name='zipcode' placeholder='우편번호' class='form-control' disabled>
          </div>
          <div class='form-group col-md-3'>
            <input type='button' onclick='sample2_execDaumPostcode()' value='우편번호 찾기' class='btn btn-outline-secondary btn-sm'><br>
          </div>
        </div>
        <div class='form-row'>
          <div class='form-group col-md-6'>
            <input type='text' id='sample2_address' placeholder='주소' name='add1' class='form-control'>
          </div>
          <div class='form-group col-md-6'>
            <input type='text' id='sample2_detailAddress' name='add2' placeholder='상세주소' class='form-control'>
          </div>
        </div>
        <div class='form-row'>
          <div class='form-group col'>
            <input type='text' id='sample2_extraAddress' name='add3' placeholder='참고항목' class='form-control'>
          </div>
        </div>
      </div>
      <div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'>
        <img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'>
      </div>
      <div class='form-group'>
        <div class='form-row'>
          <p class="mb-1">특이사항</p>
          <input type='text' name='etc' class='form-control' maxlength='47'>
        </div>
      </div>
    </div>


    <div class="row justify-content-md-center">
      <button type='submit' class='btn btn-primary mr-1'>저장</button>
      <a href='customer.php'><button type='button' class='btn btn-secondary'>입주자리스트화면으로</button></a>
    </div>
  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer_script.php";?>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="/svc/inc/js/daumAddressAPI3.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
  })
</script>
</body>
</html>
