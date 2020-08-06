<!-- 여기는 편집버튼이 있을때 파일임 (편집버튼은 헷갈려서 없앴음) -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>지출입력</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
include $_SERVER['DOCUMENT_ROOT']."/service/account/flexCost/yearMonth.php";
?>
<style>
        #modalTable tr.selected{background-color: #A9D0F5;}
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
    <h1 class="display-4">지출입력 화면입니다!</h1>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>


<section class="container"><!--style="max-width:1000px;"-->
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
      <form name="building">
        <div class="form-group row justify-content-md-center">
            <div class="col-sm-2 pl-0 pr-1">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!---->
            </div>
            <div class="col-sm-2 pl-0 pr-1">
              <select class="form-control form-control-sm selectCall" name="year">
                <option value="<?=$yearArray[0]?>">
                  <?=$yearArray[0].'년'?>
                </option>
                <option value="<?=$yearArray[1]?>">
                  <?=$yearArray[1].'년'?>
                </option>
                <option value="<?=$yearArray[2]?>" selected>
                  <?=$yearArray[2].'년'?>
                </option>
                <option value="<?=$yearArray[3]?>">
                  <?=$yearArray[3].'년'?>
                </option>
              </select><!---->
            </div>
            <div class="col-sm-2 pl-0 pr-1">
              <select class="form-control form-control-sm selectCall" name="month">
                <option value="01"<?php if($currentMonth=="01"){echo "selected";}?>>1월</option>
                <option value="02"<?php if($currentMonth=="02"){echo "selected";}?>>2월</option>
                <option value="03"<?php if($currentMonth=="03"){echo "selected";}?>>3월</option>
                <option value="04"<?php if($currentMonth=="04"){echo "selected";}?>>4월</option>
                <option value="05"<?php if($currentMonth=="05"){echo "selected";}?>>5월</option>
                <option value="06"<?php if($currentMonth=="06"){echo "selected";}?>>6월</option>
                <option value="07"<?php if($currentMonth=="07"){echo "selected";}?>>7월</option>
                <option value="08"<?php if($currentMonth=="08"){echo "selected";}?>>8월</option>
                <option value="09"<?php if($currentMonth=="09"){echo "selected";}?>>9월</option>
                <option value="10"<?php if($currentMonth=="10"){echo "selected";}?>>10월</option>
                <option value="11"<?php if($currentMonth=="11"){echo "selected";}?>>11월</option>
                <option value="12"<?php if($currentMonth=="12"){echo "selected";}?>>12월</option>
              </select><!---->
            </div>
            <div class="col-sm-1 pl-0 pr-0 mr-1">
              <button type="button" name="button" class="btn btn-sm btn-primary btn-block" id="btnSave">저장</button>


            </div>
            <!-- <div class="col-sm-1 pl-0 pr-0 mr-1">
              <button type="button" name="button" class="btn btn-sm btn-outline-primary btn-block" id="btnEdit">편집</button>
            </div> -->
            <div class="col-sm-1 pl-0 pr-0">
              <button type="button" name="button" class="btn btn-sm btn-danger btn-block" id="btnDeleteAll">전체삭제</button>
            </div>
        </div>
      </form>
  </div>
  <div class="container" id="allVals" style="">
    <!-- style="max-width:800px;" 이거를 햇다가 input type=form-control이 나오니깐 넘 좁아져서 없앴음-->
    <div class="">
      <div class="row">
        <div class="col">
          <h5 class="display-5"># 고정비 <span class="badge badge-success" id="badge1" data-toggle="modal" data-target="#exampleModal">고정비입력</span></h5>
        </div>
        <div class="col">
          <!-- <div class="row justify-content-end mr-0">
            <button type="button" id="btnSave" class="btn btn-sm btn-primary mr-1">저장</button>
            <button type="button" id="btnEdit" class="btn btn-sm btn-outline-primary">편집</button>
          </div> -->
        </div>
      </div>

      <div class="" id="fixcostList">

      </div>
    </div>
    <hr>
    <div class="">
      <h5 class="display-5"># 변동비 <span class="badge badge-success" id="badge2" data-toggle="modal" data-target="#modal2">변동비입력</span></h5>
      <div class="" id="flexcostList">

      </div>
    </div>
    <hr>
  </div>
</section>

<!-- Modal 고정비 넣기 -->
<div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">고정비 넣기 <span class="badge badge-danger" id="href_fixcost">new 생성하기</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="form-group row justify-content-md-center">
                <div class="form-group col-md-2 mb-2">
                    <p class="text-right">관리물건</p>
                </div>
                <div class="form-group col-md-3 mb-2">
                    <select class="form-control form-control-sm selectCall" name="modalbuilding" disabled>
                    </select><!---->
                </div>
            </div>
            <div id="fixcostListModal">

            </div>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
        <button type="button" class="btn btn-primary" id="btn1">넣기</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 고정비 넣기 End-->

<!-- Modal 변동비 넣기 -->
<div class="modal fade bd-example-modal-sm" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">변동비 입력하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="p_costlist_add_flex.php">
        <div class="modal-body">
          <div class="container">
              <div class="form-group row justify-content-md-center">
                  <div class="form-group col-md-3 mb-2 pr-1">
                    <select class="form-control form-control-sm" name="modalbuilding" readonly>
                    </select>
                  </div>
                  <div class="form-group col-md-3 mb-2 pl-0 pr-1">
                    <select class="form-control form-control-sm" name="modalyear" readonly>
                    </select>
                  </div>
                  <div class="form-group col-md-3 mb-2 pl-0">
                    <select class="form-control form-control-sm" name="modalmonth" readonly>
                    </select>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-3 mb-0">
                      <p class="text-center mb-1">내역</p>
                  </div>
                  <div class="form-group col-md-3 mb-0">
                      <p class="text-center mb-1">금액</p>
                  </div>
                  <div class="form-group col-md-3 mb-0">
                      <p class="text-center mb-1">지출일자</p>
                  </div>
                  <div class="form-group col-md-3 mb-0">
                      <p class="text-center mb-1">증빙일자</p>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-3 mb-0">
                      <input type="text" class="form-control form-control-sm text-center grey" name="title" value="" required>
                      <p class="text-right mb-0"><small>공급가액</small></p>
                      <p class="text-right"><small>세액</small></p>
                  </div>
                  <div class="form-group col-md-3 mb-0">
                      <input type="text" class="form-control form-control-sm text-center amountNumber grey numberComma" name="amount1" value="0" numberOnly required>
                      <input type="text" class="form-control form-control-sm text-right grey numberComma" name="amount2" value="0" numberOnly required>
                      <input type="text" class="form-control form-control-sm text-right grey numberComma" name="amount3" value="0" numberOnly required>
                  </div>
                  <div class="form-group col-md-3 mb-0">
                    <input type="text" class="form-control form-control-sm text-center dateType" name="payDate" value="" required>
                  </div>
                  <div class="form-group col-md-3 mb-0">
                    <input type="text" class="form-control form-control-sm text-center dateType" name="taxDate" value="">
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6 mb-0">
                    <div class="row justify-content-end mr-0">
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

              </div>
              <div class="form-row">
                  <p class="mb-1">특이사항</p>
                  <input type="text" class="form-control form-control-sm text-center" name="etc" value="">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
          <button type="submit" class="btn btn-primary" id="">넣기</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal 변동비 넣기 End-->


<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>

<script>
var select1option;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('select[name=building]').append(select1option);//문서위건물목록
  // $('#select2').append(select1option);//변동비등록모달의 건물목록
}
//---- ^ 건물출력 ^------//

var buildingIdx = $('select[name=building]').val();
var building = $('select[name=building] option:selected').text();
var year = $('select[name=year]').val();
var yearText = $('select[name=year] option:selected').text();
var month = $('select[name=month]').val();
var monthText = $('select[name=month] option:selected').text();

var modalbuildingOption = "<option value='"+buildingIdx+"'>"+building+"</option>";
var modalyearOption = "<option value='"+year+"'>"+yearText+"</option>";
var modalmonthOption = "<option value='"+month+"'>"+monthText+"</option>";
var modalDate = year + '-' + month + '-01';
$('select[name=modalbuilding]').html(modalbuildingOption);
$('select[name=modalyear]').html(modalyearOption);
$('select[name=modalmonth]').html(modalmonthOption);
$('input[name=payDate]').val(modalDate);

//---- ^ buildingIdx 전역변수 선언 ^------//


$(document).ready(function(){
      $.ajax({
        url: 'ajax_fixcostLoad.php',
        method: 'post',
        data: {buildingIdx:buildingIdx, year:year, month:month},
        success: function(data){
          $('#fixcostList').html(data);
        }
      })  //------ ^모달밖 고정비 출력 ^------//

      $.ajax({
        url: 'ajax_flexcostLoad.php',
        method: 'post',
        data: {buildingIdx:buildingIdx, year:year, month:month},
        success: function(data){
          $('#flexcostList').html(data);
        }
      })  //------ ^모달밖 변동비 출력 ^------//

      $.ajax({
        url: 'ajax_modalfixcostLoad.php',
        method: 'post',
        data: {building:building, buildingIdx:buildingIdx},
        success: function(data){
          $('#fixcostListModal').html(data);
        }
      })//고정비입력 모달 출력

})//------------ ^ document.reay ^------//

function load() {
  var buildingIdx = $('select[name=building]').val();
  var building = $('select[name=building] option:selected').text();
  var year = $('select[name=year]').val();
  var yearText = $('select[name=year] option:selected').text();
  var month = $('select[name=month]').val();
  var monthText = $('select[name=month] option:selected').text();

  var modalbuildingOption = "<option value='"+buildingIdx+"'>"+building+"</option>";
  var modalyearOption = "<option value='"+year+"'>"+yearText+"</option>";
  var modalmonthOption = "<option value='"+month+"'>"+monthText+"</option>";
  var modalDate = year + '-' + month + '-01';
  $('select[name=modalbuilding]').html(modalbuildingOption);
  $('select[name=modalyear]').html(modalyearOption);
  $('select[name=modalmonth]').html(modalmonthOption);
  $('input[name=payDate]').val(modalDate);

  $.ajax({
    url: 'ajax_fixcostLoad.php',
    method: 'post',
    data: {buildingIdx:buildingIdx, year:year, month:month},
    success: function(data){
      $('#fixcostList').html(data);
    }
  })//------ ^모달밖 고정비 출력 ^------//


  $.ajax({
    url: 'ajax_flexcostLoad.php',
    method: 'post',
    data: {buildingIdx:buildingIdx, year:year, month:month},
    success: function(data){
      $('#flexcostList').html(data);
    }
  })//------ ^모달밖 변동비 출력 ^------//

  $.ajax({
    url: 'ajax_modalfixcostLoad.php',
    method: 'post',
    data: {building:building, buildingIdx:buildingIdx},
    success: function(data){
      $('#fixcostListModal').html(data);
    }
  })


}//load function end}



$('select[name=building]').on('change', function(){
  load();
})

$('select[name=year]').on('change', function(){
  load();
})

$('select[name=month]').on('change', function(){
  load();
})

$('#href_fixcost').on('click', function(){
  var moveCheck = confirm('고정비관리 화면으로 이동합니다. 이동하시겠습니까?');
  if(moveCheck){
    location.href='/service/account/fixcost.php';
  }
})

//------------------------------------------------ ^ 모달안 고정비출력 ^------//

$('#btn1').on('click', function(){
  var year = $('select[name=year]').val();
  var month = $('select[name=month]').val();
  var payDate = year + '-' + month + '-01';
  var allCnt = $("#modalTable tbody :checkbox").length;
  var fixcostArray = [];
  console.log(allCnt);

  if($("#modalTable thead :checkbox").is(':checked')){
      for (var i = 0; i < allCnt; i++) {
        var fixcostArrayEle = [];
        var colfixcostId = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(0)").children('input').val();//고정비아이디
        var colfixcostTitle = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(3)").text();//타이틀
        var colfixcostAmount1 = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(4)").text();//금액
        var colfixcostAmount2 = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(5)").text();//공급가액
        var colfixcostAmount3 = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(6)").text();//세액
        fixcostArrayEle.push(colfixcostId, colfixcostTitle, colfixcostAmount1, colfixcostAmount2, colfixcostAmount3);
        fixcostArray.push(fixcostArrayEle);
      }
  } else {
    for (var i = 0; i <= allCnt; i++) {
      var checkboxCheck = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(0)").children('input').is(':checked');//체크인지 아닌지 확인
      console.log(checkboxCheck);

      if(checkboxCheck===true){
        var fixcostArrayEle = [];
        var colfixcostId = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(0)").children('input').val();//고정비아이디
        var colfixcostTitle = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(3)").text();//타이틀
        var colfixcostAmount1 = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(4)").text();//금액
        var colfixcostAmount2 = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(5)").text();//공급가액
        var colfixcostAmount3 = $("#modalTable tbody").find("tr:eq("+i+")").find("td:eq(6)").text();//세액
        fixcostArrayEle.push(colfixcostId, colfixcostTitle, colfixcostAmount1, colfixcostAmount2, colfixcostAmount3);
        fixcostArray.push(fixcostArrayEle);
      }
    }
  }
  //
  console.log(fixcostArray);

  if(fixcostArray.length===0){
    alert('1개이상을 선택해야합니다.');
    return false;
  }

  function goCategoryPage(a,b,c,d,e,f,g){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'fixcostArray', c);
      frm = formInput(frm, 'buildingIdx', d);
      frm = formInput(frm, 'year', e);
      frm = formInput(frm, 'month', f);
      frm = formInput(frm, 'payDate', g);
      formSubmit(frm);
  }

  var fixcostArrayjson = JSON.stringify(fixcostArray);
  var aa = 'fixcostArray';
  var bb = 'p_costlist_add_fix.php';

  goCategoryPage(aa, bb, fixcostArrayjson, buildingIdx, year, month, payDate);

})
//------- ^ 모달안 넣기버튼 클릭 ^------//


$('#btnSave').on('click', function(){
    var fixrow = $('#fixcostTable tbody tr').length;
    var flexrow = $('#flexcostTable tbody tr').length;

    // var editableArray = [];
    var costlistArray1 = [];
    for (var i = 0; i < fixrow; i++) {
      var editable = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(0)").children('input:eq(1)').val();
      if(editable==='yes'){
        var costlistArray1ele = [];

        var costlistid = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(0)").children('input').val(); //아이디
        var costlistTitle = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(1)").text(); //내역
        var costlistAmount1 = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(2)").children('input').val(); //금액
        var costlistAmount2 = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(3)").children('input').val(); //공급가액
        var costlistAmount3 = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(4)").children('input').val(); //세액
        var costlistPaydate = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(5)").children('input').val(); //지출일자
        var costlistTaxdate = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(6)").children('input').val(); //증빙일자
        var costlistEtc = $('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(7)").children('input').val(); //특이사항

        var costlistAmount11 = Number(costlistAmount2) + Number(costlistAmount3);


        if(Number(costlistAmount1) != costlistAmount11){
          console.log(costlistAmount11, Number(costlistAmount1));
          alert(costlistTitle + '의 공급가액,세액의 합계가 금액과 맞지 않습니다.');
          return false;

        }

        costlistArray1ele.push(costlistid, costlistTitle, costlistAmount1, costlistAmount2, costlistAmount3, costlistPaydate, costlistTaxdate, costlistEtc);

        costlistArray1.push(costlistArray1ele);
      }
    }//costlistArray1 making for end

    var costlistArray2 = [];
    for (var i = 0; i < fixrow; i++) {
      var editable = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(0)").children('input:eq(1)').val();
      if(editable==='yes'){
        var costlistArray2ele = [];

        var costlist2id = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(0)").children('input').val(); //아이디
        var costlist2Title = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(1)").text(); //내역
        var costlist2Amount1 = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(2)").children('input').val(); //금액
        var costlist2Amount2 = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(3)").children('input').val(); //공급가액
        var costlist2Amount3 = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(4)").children('input').val(); //세액
        var costlist2Paydate = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(5)").children('input').val(); //지출일자
        var costlist2Taxdate = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(6)").children('input').val(); //증빙일자
        var costlist2Etc = $('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(7)").children('input').val(); //특이사항

        var costlist2Amount11 = Number(costlist2Amount2) + Number(costlist2Amount3);


        if(Number(costlist2Amount1) != costlist2Amount11){
          console.log(costlist2Amount11, Number(costlist2Amount1));
          alert(costlist2Title + '의 공급가액,세액의 합계가 금액과 맞지 않습니다.');
          return false;

        }

        costlistArray2ele.push(costlist2id, costlist2Title, costlist2Amount1, costlist2Amount2, costlist2Amount3, costlist2Paydate, costlist2Taxdate, costlist2Etc);

        costlistArray2.push(costlistArray2ele);
      } //editable이 no이면 배열에 추가를 안한다

    }//costlistArray2 making for end

    if(costlistArray1.length > 0 || costlistArray2.length > 0){
      function goCategoryPage(a,b,c,d,e,f,g){
          var frm = formCreate(a, 'post', b,'');
          frm = formInput(frm, 'costlistArray1', c);
          frm = formInput(frm, 'costlistArray2', d);
          frm = formInput(frm, 'buildingIdx', e);
          frm = formInput(frm, 'year', f);
          frm = formInput(frm, 'month', g);
          formSubmit(frm);
      }

      var costlistArray1json = JSON.stringify(costlistArray1);
      var costlistArray2json = JSON.stringify(costlistArray2);
      var aa = 'costlist';
      var bb = 'p_costlist_update.php'; //저장버튼이지만 실제행위는 업데이트이므로 업데이트파일이 맞다.

      goCategoryPage(aa, bb, costlistArray1json, costlistArray2json, buildingIdx, year, month);

    } else {
      alert('저장할 대상이 존재하지 않습니다.');
      return false;
    }
})
//------ ^전체 저장버튼 클릭 ^------//

// $('#btnEdit').on('click', function(){
//   var fixrow = $('#fixcostTable tbody tr').length - 1;//하단 소계tr때문에 -1처리
//   var flexrow = $('#flexcostTable tbody tr').length - 1;//하단 소계tr때문에 -1처리
//
//   var editableArray1 = [];
//   var editableArray2 = [];
//
//   for (var i = 0; i < fixrow; i++) {
//     editableArray1.push($('#fixcostTable tbody').find("tr:eq("+i+")").find("td:eq(0)").children('input').val()); //아이디)
//   }
//   for (var i = 0; i < flexrow; i++) {
//     editableArray2.push($('#flexcostTable tbody').find("tr:eq("+i+")").find("td:eq(0)").children('input').val()); //아이디)
//   }
//   // console.log(editableArray1, editableArray2);
//
//   function goCategoryPage(a,b,c,d,e,f,g){
//       var frm = formCreate(a, 'post', b,'');
//       frm = formInput(frm, 'editableArray1', c);
//       frm = formInput(frm, 'editableArray2', d);
//       frm = formInput(frm, 'buildingIdx', e);
//       frm = formInput(frm, 'year', f);
//       frm = formInput(frm, 'month', g);
//       formSubmit(frm);
//   }
//
//   var aa = 'editableArray';
//   var bb = 'p_costlist_editable.php';
//
//   goCategoryPage(aa, bb, editableArray1, editableArray2, buildingIdx, year, month);
//
// })
// //------ ^전체 편집 버튼 클릭 ^------//이게 있엇다가 삭제되었음

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

$('#btnDeleteAll').on('click', function(){
  var buildingIdx = $('select[name=building]').val();
  var year = $('select[name=year]').val();
  var month = $('select[name=month]').val();

  var deleteCheck = confirm('정말 전체 삭제하시겠습니까?');
  if(deleteCheck){
    function goCategoryPage(a,b,c,d,e){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'buildingIdx', c);
        frm = formInput(frm, 'year', d);
        frm = formInput(frm, 'month', e);
        formSubmit(frm);
    }

    var aa = 'costlist_delete_all';
    var bb = 'p_costlist_delete_all.php';

    goCategoryPage(aa, bb, buildingIdx, year, month);
  }

})//상단 전체삭제버튼 클릭시

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
