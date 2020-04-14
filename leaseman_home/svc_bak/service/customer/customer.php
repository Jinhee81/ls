<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>세입자리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/main/condition.php";
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
            <option value="1pastMonth">1개월전</option>
            <option value="3pastMonth">당년</option>
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
            <option value="customerAll">구분전체</option>
            <option value="세입자">세입자</option>
            <option value="문의">문의</option>
            <option value="거래처">거래처</option>
            <option value="기타">기타</option>
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
        <!-- <div class="col-sm-1 pl-0 pr-0">
          <button type="button" name="btnLoad" class="btn btn-info btn-sm">조회</button>
        </div> -->
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

<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>
<script src="/js/jquery-ui-timepicker-addon.js"></script>
<script src="/js/etc/newdate5.js?v=<%=System.currentTimeMillis()%"></script>

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

      $('.dateType').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        // showOn: "button",
        buttonImage: "/img/calendar.svg",
        buttonImageOnly: false
      })
})

$('select[name=periodDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=fromDate]').on('change', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=toDate]').on('change', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=customerDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=etcCondi]').on('change', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=cText]').on('keyup', function(){
    $.ajax({
      url: 'ajax_customerLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

})
//---------조회버튼클릭평션 end and 증빙일자 펑션 시작--------------//


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



</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
