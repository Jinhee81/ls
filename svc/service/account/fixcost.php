<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>고정비</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php";
?>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        .grey{
          color: #848484;
        }

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }

}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">고정비관리 화면입니다!</h1>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>
<section class="container" style="max-width:1000px;">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
      <form name="building">
        <div class="form-group row justify-content-md-center">
            <div class="col-sm-2 pl-0 pr-1">
              <select class="form-control form-control-sm selectCall" id="select1" name="select1">
              </select><!---->
            </div>
            <div class="col-sm-2 pl-0 pr-0">
              <button type="button" class="btn btn-primary btn-sm" name="btnAdd" data-toggle="modal" data-target="#exampleModal">고정비추가</button>
            </div>
        </div>
      </form>
  </div>
  <div class="" id="allVals">

  </div>
</section>

<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">고정비 추가하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="p_fixcost_add.php">
        <div class="modal-body">
          <div class="container">
              <div class="form-row">
                  <div class="form-group col-md-4 mb-2">
                      <label>관리물건</label>
                  </div>
                  <div class="form-group col-md-8 mb-2">
                      <select class="form-control form-control-sm" id="select2" name="building">
                      </select>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-4 mb-2">
                      <label>내역</label>
                  </div>
                  <div class="form-group col-md-8 mb-2">
                      <input type="text" class="form-control form-control-sm text-left grey" name="title" value="" required>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-4 mb-2">
                      <label>금액</label>
                  </div>
                  <div class="form-group col-md-8 mb-2">
                      <input type="text" class="form-control form-control-sm text-left amountNumber grey numberComma" name="amount1" value="0" numberOnly required>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="vatYes" checked>
                        <label class="form-check-label" for="inlineRadio1"><small>부가세 포함</small></label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="vatNo">
                        <label class="form-check-label" for="inlineRadio2"><small>부가세 별도</small></label>
                      </div>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-4 mb-0">
                      <p class="text-right"><small>공급가액</small></p>
                  </div>
                  <div class="form-group col-md-8 mb-0">
                      <input type="text" class="form-control form-control-sm text-right grey numberComma" name="amount2" value="0" numberOnly required>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-4 mb-0">
                      <p class="text-right"><small>세액</small></p>
                  </div>
                  <div class="form-group col-md-8 mb-0">
                      <input type="text" class="form-control form-control-sm text-right grey numberComma" name="amount3" value="0" numberOnly required>
                  </div>
              </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
          <button type="submit" class="btn btn-primary">추가하기</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal End-->

<!-- <script src="/js/etc/date.js"></script> -->

<script>

$(document).ready(function(){
  $(".numberComma").number(true);

  $.ajax({
    url: 'ajax_fixcostLoad.php',
    method: 'post',
    data: $('form[name=building]').serialize(),
    success: function(data){
      $('#allVals').html(data);
    }
  })
})

$('#select1').on('change', function(){
  $.ajax({
    url: 'ajax_fixcostLoad.php',
    method: 'post',
    data: $('form[name=building]').serialize(),
    success: function(data){
      $('#allVals').html(data);
    }
  })
})

var select1option, select2option, buildingIdx, groupIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#select1').append(select1option);
}
buildingIdx = $('#select1').val();

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select2option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#select2').append(select2option);
}
buildingIdx2 = $('#select2').val();

$("input:text[numberOnly]").on('click', function(){
  $(this).select();
})

$('input[name=amount1]').on('keyup', function(){
  var amount1 = Number($(this).val());

  var vat = $(':input:radio[name=inlineRadioOptions]:checked').val();

  if(vat === 'vatYes'){
    var amount2 = amount1 / 1.1;
    var amount3 = amount1 - amount2;
  } else {
    var amount2 = amount1;
    var amount3 = amount1 - amount2;
  }

  $('input[name=amount2]').val(amount2);
  $('input[name=amount3]').val(amount3);
})//금액이 키업될 때


$(':input:radio[id=inlineRadio1]').on('click', function(){
  var amount1 = Number($('input[name=amount1]').val());

  var amount2 = amount1 / 1.1;
  var amount3 = amount1 - amount2;

  $('input[name=amount2]').val(amount2);
  $('input[name=amount3]').val(amount3);
}) //라디오버튼 부가세포함이 클릭될때

$(':input:radio[id=inlineRadio2]').on('click', function(){
  var amount1 = Number($('input[name=amount1]').val());

  var amount2 = amount1;
  var amount3 = amount1 - amount2;

  $('input[name=amount2]').val(amount2);
  $('input[name=amount3]').val(amount3);
}) //라디오버튼 부가세별도가 클릭될때






</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
