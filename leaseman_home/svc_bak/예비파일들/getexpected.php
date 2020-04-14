<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>입금예정리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
?>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
        .green{
          color: #04B486;
        }

        .pink{
          color: #F7819F;
        }
        .appi{
          color:#F7819F;
        }
}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">입금예정리스트 화면입니다!</h1>
    <p class="lead">

    </p>
  </div>
</section>
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <!-- <div class="row justify-content-md-center"> -->
      <form>
        <div class="form-group row justify-content-md-center">
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="dateDiv" name="dateDiv">
              <option value="pExpectedDate">예정일자</option>
            </select><!--codi1-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="periodDiv" name="periodDiv">
              <option value="allDate">--</option>
              <option value="nowMonth">당월</option>
              <option value="pastMonth">전월</option>
              <option value="1pastMonth">1개월</option>
              <option value="3pastMonth">3개월</option>
              <option value="nowYear">당년</option>
            </select><!--codi2-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType" id=""><!--codi3-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType" id=""><!--codi4-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="select1" name="select1">
            </select><!--codi6-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="select2" name="select2">
            </select><!--codi6-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
              <option value="customer">성명/사업자명</option>
              <option value="contact">연락처</option>
              <option value="contractId">계약번호</option>
              <option value="roomId">방번호</option>
            </select><!--codi8-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <button type="button" name="btnLoad" class="btn btn-info btn-sm">조회</button>
          </div>
        </div>
      </form>

    <!-- </div> -->

</div>
</section>

<section class="container">
    <div class="row mobile">
        <div class="col">
          <div class="row">
            <div class="col-sm-3 pr-0">
              <select class="form-control form-control-sm" id="" name="">
                <option value="">상용구없음</option>
              </select>
            </div>
            <div class="col-sm-2 pl-1 pr-0">
              <button class="btn btn-sm btn-block btn-outline-primary" id="smsBtn"><i class="far fa-envelope"></i> 보내기</button>
            </div>
            <div class="col-sm-3 pl-1">
              <a href="/service/sms/smsSetting.php">
              <button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn">상용구설정</button></a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="row justify-content-end">
            <div class="col col-md-3 pl-0 pr-1">
              <input type="text" name="taxDate" value="" class="form-control form-control-sm dateType text-center">
            </div>
            <div class="col col-md-3 pl-0 pr-1">
              <select class="form-control form-control-sm" name="taxSelect">
                <option value="세금계산서">세금계산서</option>
                <option value="현금영수증">현금영수증</option>
              </select>
            </div>
            <div class="col col-md-2 pl-0">
              <button type="button" class="btn btn-primary btn-sm btn-block" id="btnTaxDateInput">발행</button>
            </div>
          </div>
        </div>
    </div>
    <div class="row justify-content-end mr-0">
        <label>전체 TOTAL : <span id="ptAmountTotal"></span>원</label>
        <label style="color:#007bff;font-style:italic;"> 체크 : <span id="ptAmountSelectCount">0</span>건, <span id="ptAmountSelectAmount">0</span>원</label>
    </div>
    <div class="" id="allVals">
    <!-- isright 6666? -->
    </div>
</section>



<script>

// var select1option = "<option value='all'>전체</option>";
// $('#select1').append(select1option); //관리물건 전체를 넣으려다가 안넣-
var select1option;

var select2option = "<option value='all'>전체</option>";
$('#select2').append(select2option);

var buildingIdx, groupIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#select1').append(select1option);
}
buildingIdx = $('#select1').val();

for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
  select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
  // console.log(select3option);
  $('#select2').append(select2option);
}
groupIdx = $('#select2').val();

$('#select1').on('change', function(event){
  buildingIdx = $('#select1').val();
  $('#select2').empty();
  var select2option = "<option value='all'>전체</option>";
  $('#select2').append(select2option);
  for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select2').append(select2option);
  }
  groupIdx = $('#select2').val();
})
//------------------------------------------------건물,그룹출력 끝------//

$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $.ajax({
      url: 'ajax_getexpectedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

    $.ajax({
      url: 'ajax_getexpectedAmount.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#ptAmountTotal').html(data);
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

$('button[name="btnLoad"]').on('click', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

    $.ajax({
      url: 'ajax_getexpectedAmount.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#ptAmountTotal').html(data);
      }
    })
})
//=====================================================================//

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
    if(periodVal === 'nowYear'){
      var pastMonth = Number(1);
      // console.log(pastMonth);
      var pastMonthDate = Number(1);
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

$('#smsBtn').on('click', function(){

if(smsReadyArray.length===0){
  alert('1개 이상을 선택해야 문자메시지 보내기가 가능합니다.');
  return false;
}

var aa = 'smsSend';
var bb = '/service/sms/sms.php';
var cc = JSON.stringify(smsReadyArray);

goCategoryPage(aa, bb, cc);

function goCategoryPage(a, b, c){
  var frm = formCreate(a, 'post', b,'');
  frm = formInput(frm, 'smsReadyArray', c);
  formSubmit(frm);
}

}) //smsBtn function closing
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
