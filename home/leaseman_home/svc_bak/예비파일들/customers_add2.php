<!-- 이 파일은 예비복사본, 곧 지울예정임 -->

<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<script src="csadd.js"></script>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">일괄 고객등록 화면입니다!</h1>
    <p class="lead">이 화면에서는 한꺼번에 많은 고객들을 등록하기에 좋아요~</p>
    <!-- <small>(1) * 표시는 필수입력값입니다. (2) 구분(대)의 값이 '고객'이어야 임대계약 등록이 가능합니다. (3) '고객'이란 단어는 세입자 또는 입주자를 의미합니다.</small> -->
    <hr class="my-4">
  </div>
</section>
<section class="container" style="max-width:1200px;">
  <form method="post" action ="p_m_c_add.php"> <!--문의고객 입력-->
    <table class="table table-borderless text-center">
      <tr>
        <td style='width:10%'></td>
        <td style='width:10%'><label>구분(대)</label></td>
        <td style='width:30%'>
          <select id="div1" name="div1" class="form-control" onchange="div1Get();">
            <option value="문의고객">문의고객</option>
            <option value="진행고객" selected>고객</option>
            <option value="거래처">거래처</option>
          </select>
        </td>
        <td style='width:10%'><label>구분(소)</label></td>
        <td style='width:30%'>
          <select id="div2" name="div2" class="form-control" onchange="div2Get();">
            <option value=""></option>
            <option value="개인">개인</option>
            <option value="개인사업자">개인사업자</option>
            <option value="법인사업자">법인사업자</option>
          </select>
        </td>
        <td style='width:10%'></td>
      </tr>
    </table>
    <table id="centerSection" class='table table-bordered text-center'>
    </table>

    <h3>개인</h3>
    <table class="table table-bordered text-center">
      <tr>
        <td style='width:6%'>순번</td>
        <td style='width:20%'>성명</td>
        <td style='width:30%'>연락처</td>
        <td style='width:19%'>이메일</td>
        <td style='width:19%'>특이사항</td>
        <td style='width:6%'></td>
      </tr>
      <tr>
        <td style='padding-top: 18px;'>1</td>
        <td>
          <input type='text' name='name' class='form-control text-center' maxlength='9'>
        </td>
        <td>
          <div class='form-row'>
            <div class='form-group col mb-0'>
              <input type='number' name='contact1' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col mb-0'>
              <input type='number' name='contact2' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col mb-0'>
              <input type='number' name='contact3' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </td>
        <td>
          <input type='email' name='email' class='form-control text-center' maxlength='40'>
        </td>
        <td>
          <input type='text' name='etc' class='form-control text-center' maxlength='40'>
        </td>
        <td>
          <button type='submit' class='btn btn-default'>
            <i class='far fa-trash-alt'></i>
          </button>
        </td>
      </tr>
    </table>

    <h3>개인사업자</h3>
    <table class='table table-bordered text-center'>
      <tr>
        <td style='width:5%'>순번</td>
        <td style='width:15%'>성명</td>
        <td style='width:15%'>사업자명</td>
        <td style='width:25%'>연락처</td>
        <td style='width:25%'>사업자번호</td>
        <td style='width:15%'>이메일</td>
        <td style='width:5%'></td>
      </tr>
      <tr>
        <td style='padding-top: 18px;'>1</td>
        <td>
          <input type='text' name='name' class='form-control text-center' maxlength='9'>
        </td>
        <td>
          <input type='text' name='companyname' class='form-control text-center' maxlength='14'>
        </td>
        <td>
          <div class='form-row'>
            <div class='form-group col mb-0'>
              <input type='number' name='contact1' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col mb-0'>
              <input type='number' name='contact2' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col mb-0'>
              <input type='number' name='contact3' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </td>
        <td>
          <div class='form-row'>
            <div class='form-group col-md-4 mb-0'>
              <input type='number' name='cNumber1' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col-md-3 mb-0'>
              <input type='number' name='cNumber2' class='form-control text-center' maxlength='2' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col-md-5 mb-0'>
              <input type='number' name='cNumber3' class='form-control text-center' maxlength='5' oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </td>
        <td>
          <input type='email' name='email' class='form-control text-center' maxlength='40'>
        </td>
        <td>
          <button type='submit' class='btn btn-default'>
            <i class='far fa-trash-alt'></i>
          </button>
        </td>
      </tr>
    </table>

    <h3>법인사업자</h3>
    <table class='table table-bordered text-center'>
      <tr>
        <td style='width:5%'>순번</td>
        <td style='width:8%'>구분</td>
        <td style='width:20%'>사업자명</td>
        <td style='width:25%'>연락처</td>
        <td style='width:12%'>대표자명</td>
        <td style='width:25%'>사업자번호</td>
        <td style='width:5%'></td>
      </tr>
      <tr>
        <td style='padding-top: 18px;'>1</td>
        <td>
          <select name='div3' class='form-control' onchange='div1Get();'>
            <option value='주식회사' selected>(주)</option>
            <option value='유한회사'>(유)</option>
            <option value='합자회사'>(합)</option>
            <option value='기타'>(기)</option>
          </select>
        </td>
        <td>
          <input type='text' name='companyname' class='form-control text-center' maxlength='14'>
        </td>
        <td>
          <div class='form-row'>
            <div class='form-group col mb-0'>
              <input type='number' name='contact1' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col mb-0'>
              <input type='number' name='contact2' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col mb-0'>
              <input type='number' name='contact3' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </td>
        <td>
          <input type='text' name='name' class='form-control text-center' maxlength='9'>
        </td>
        <td>
          <div class='form-row'>
            <div class='form-group col-md-4 mb-0'>
              <input type='number' name='cNumber1' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col-md-3 mb-0'>
              <input type='number' name='cNumber2' class='form-control text-center' maxlength='2' oninput='maxlengthCheck(this);'>
            </div>
            <div class='form-group col-md-5 mb-0'>
              <input type='number' name='cNumber3' class='form-control text-center' maxlength='5' oninput='maxlengthCheck(this);'>
            </div>
          </div>
        </td>
        <td>
          <button type='submit' class='btn btn-default'>
            <i class='far fa-trash-alt'></i>
          </button>
        </td>
      </tr>
    </table>

</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
