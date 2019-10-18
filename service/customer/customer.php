<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">세입자리스트 화면입니다!</h1>
    <p class="lead">
      <!-- (1) 정확한 표현은 이해관계자리스트라고 보아도 무방합니다. 세입자(고객) 뿐만 아니라, 문의하는 사람 및 자주 거래하는 거래처도 저장할 수 있어요.<br> -->
    (1) 방계약이 발생하면 숫자가 표시됩니다. (2)'기타' 분류는 방계약 외의 일회성매출에 대한 고객을 분류할 수 있습니다.
    </p>
  </div>

  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <form>
      <div class="form-group row justify-content-md-center">
        <div class="col-sm-1 pl-0 pr-0" style="">
          <select class="form-control form-control-sm selectCall" name="dateDiv" id="dateDiv">
            <option value="registerDate">등록일자</option>
            <option value="updateDate">수정일자</option>
          </select>
        </div>
        <div class="col-sm-1 pl-0 pr-0" style="">
          <select class="form-control form-control-sm selectCall" name="periodDiv" id="periodDiv">
            <option value="allDate">--</option>
            <option value="nowMonth">당월</option>
            <option value="pastMonth">전월</option>
            <option value="1pastMonth">1개월</option>
            <option value="3pastMonth">3개월</option>
          </select>
        </div>
        <div class="col-sm-2 pl-0 pr-0">
          <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType" id="">
        </div>
        <div class="col-sm-2 pl-0 pr-0">
          <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType" id="">
        </div>
        <div class="col-sm-1 pl-0 pr-0">
          <select name="customerDiv" class="form-control form-control-sm selectCall">
            <option value="queryCustomer">문의</option>
            <option value="ingCustomer" selected>세입자</option>
            <option value="etcCustomer">거래처</option>
            <option value="etcCustomer2">기타</option>
          </select>
        </div>
        <div class="col-sm-1 pl-0 pr-0">
          <select class="form-control form-control-sm selectCall" name="etcCondi">
            <option value="customer">성명/사업자명</option>
            <option value="contact">연락처</option>
            <option value="email">이메일</option>
            <option value="etc">특이사항</option>
          </select>
        </div>
        <div class="col-sm-2 pl-0 pr-0">
          <input type="text" name="cText" value="" class="form-control form-control-sm text-center">
        </div>
        <div class="col-sm-1 pl-0 pr-0">
          <button type="button" name="btnLoad" class="btn btn-info btn-sm">조회</button>
        </div>
      </div>
    </form>
  </div>

  <div class="d-flex flex-row-reverse">
    <div class="float-right">
      <button type="button" class="btn btn-secondary" name="rowDeleteBtn">삭제</button>
      <a href="m_c_add.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
    </div>
  </div>
  <div class="mt-3" id="allVals">
  </div>

</section>

<script>
$(document).ready(function(){
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })

      $.ajax({
        url: 'ajax_customerLoad.php',
        method: 'post',
        data: $('form').serialize(),
        success: function(data){
          $('#allVals').html(data);
        }
      })
})

$('button[name="btnLoad"]').on('click', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})


$('button[name="rowDeleteBtn"]').on('click', function(){
  console.log(customerArray);
  for (var i = 0; i < customerArray.length; i++) {
    if(Number(customerArray[i][2])>0){
      alert('계약등록된 고객이 포함될 경우 삭제 불가능합니다.');
      return false;
    }
  }

  var aa = 'customerDelete';
  var bb = 'p_m_c_delete_for.php';

  goCategoryPage(aa, bb, customerArray);

  function goCategoryPage(a, b, c){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'customerArray', c);
    formSubmit(frm);
  }

})

var today = new Date();
var yyyy = today.getFullYear();
var mm = today.getMonth() + 1;
var dd = today.getDate();

if(mm<10){
  mm = '0'+mm;
}
if(dd<10){
  dd = '0'+dd;
}

today = yyyy + '-' + mm + '-' + dd;
//-------------------------------------------오늘날짜생성 끝 --------//

$('select[name="periodDiv"]').on('change', function(){

    var periodVal = $(this).val();
    // console.log(periodVal);
    if(periodVal === 'allDate'){
      $('input[name="fromDate"]').val("");
      $('input[name="toDate"]').val("");
    }
    if(periodVal === 'nowMonth'){
      var fromDate = yyyy + '-' + mm + '-01';
      var nowMonth = Number(mm);
      var nowMonthDate = new Date(yyyy,nowMonth,0).getDate();
      var toDate = yyyy + '-' + nowMonth + '-' + nowMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(toDate);
    }
    if(periodVal === 'pastMonth'){
      var pastMonth = Number(mm)-1;
      // console.log(pastMonth);
      var pastMonthDate = new Date(yyyy,pastMonth,0).getDate();
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-01';
      var toDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(toDate);
    }
    if(periodVal === '1pastMonth'){
      var pastMonth = Number(mm)-1;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }
    if(periodVal === '3pastMonth'){
      var pastMonth = Number(mm)-3;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }

}) ////select periodDiv function closing

$('input[name="cText"]').click(function(){
  $(this).select();
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
