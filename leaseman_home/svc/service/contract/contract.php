<?php

session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>임대계약리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include "building.php";
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
    <h1 class="display-4">임대계약 리스트 화면입니다!(#201)</h1>
    <p class="lead">
      (1) 상태(현재 - 현재 계약), (대기 - 대기중 계약), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다.
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
              <option value="startDate">시작일자</option>
              <option value="endDate">종료일자</option>
              <option value="contractDate">계약일자</option>
              <option value="registerDate">등록일자</option>
            </select><!--codi1-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="periodDiv" name="periodDiv">
              <option value="allDate">--</option>
              <option value="nowMonth">당월</option>
              <option value="pastMonth">전월</option>
              <option value="nextMonth">익월</option>
              <option value="1pastMonth">1개월전</option>
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
            <select class="form-control form-control-sm selectCall" id="progress" name="progress">
              <option value="pAll">전체</option>
              <option value="pIng" selected>현재</option>
              <option value="pEnd">종료</option>
              <option value="pWaiting">대기</option>
            </select><!--codi5-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="building" name="building">
            </select><!--building-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="group" name="group">
              <option value="groupAll">그룹전체</option>
            </select><!--group-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
              <option value="customer">성명/사업자명</option>
              <option value="contact">연락처</option>
              <option value="contractId">계약번호</option>
              <option value="roomId">방번호</option>
            </select><!--codi8-->
          </div>
          <div class="col-sm-2 pl-0 pr-0">
            <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
          </div>
          <!-- <div class="col-sm-1 pl-0 pr-0">
            <button type="button" name="btnLoad" class="btn btn-info btn-sm">조회</button>
          </div> -->
        </div>
      </form>

    <!-- </div> -->

</div>
</section>

<section class="container">
    <div class="d-flex flex-row-reverse">
        <div class="float-right">
          <button type="button" class="btn btn-secondary" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="'c'표시된것만 삭제 가능합니다">삭제</button>
          <a href="contract_add2.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
          <button type="button" class="btn btn-warning" name="cAppend" data-toggle="modal" data-target="#nAddBtn">연장</button>
        </div>
    </div>

    <div class="" id="allVals">
    <!-- isright 6666? -->
    </div>
</section>

<!-- n개월추가 모달 시작  -->
<div class="modal fade bd-example-modal-sm" id="nAddBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">n개월 추가</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>추가개월수</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right" name="addMonth" value="" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>공급가액</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount1" value="<?=$row['mAmount']?>" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>세액</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount2" value="<?=$row['mvAmount']?>" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>합계</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount3" value="<?=$row['mtAmount']?>" numberOnly required disabled>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" id="button6">추가하기</button>
      </div>
    </div>
  </div>
</div>
<!-- n개월추가 모달 끝  -->

<script src="/admin/js/jquery-ui.min.js"></script>
<script src="/admin/js/datepicker-ko.js"></script>
<script src="/admin/js/jquery-ui-timepicker-addon.js"></script>
<script src="/admin/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>

<script>

var buildingoption, groupoption, buildingIdx, groupIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  buildingoption = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#building').append(buildingoption);
}
buildingIdx = $('#building').val();

for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
  groupoption = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
  // console.log(select3option);
  $('#group').append(groupoption);
}
groupIdx = $('#group').val();

$('#building').on('change', function(event){
  buildingIdx = $('#building').val();
  $('#group').empty();
  $('#group').append('<option value="groupAll">그룹전체</option>');
  for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    groupoption = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#group').append(groupoption);
  }
  groupIdx = $('#group').val();
})
//------------------------------------------------건물,그룹출력 끝------//

$(document).ready(function(){

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $.ajax({
      url: 'ajax_realContractLoad.php',
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
//===========document.ready function end and the other load start!


$('select[name=periodDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=fromDate]').on('change', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=toDate]').on('change', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=progress]').on('change', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=building]').on('change', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=group]').on('change', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})


$('input[name=cText]').on('keyup', function(){
    $.ajax({
      url: 'ajax_realContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

})
//---------조회버튼클릭평션 end and 삭제버툰 펑션 시작--------------//


$('button[name="rowDeleteBtn"]').on('click', function(){
// console.log(contractArray);
for (var i = 0; i < contractArray.length; i++) {
  if(!(contractArray[i][2] === 'c')){
    alert("'c'표시된것만 삭제 가능합니다.");
    return false;
  }
  if(!(contractArray[i][3]==="")){
    alert('메모 또는 파일이 존재하면 삭제 불가합니다.');
    return false;
  }
  if(!(contractArray[i][4]==="")){
    alert('메모 또는 파일이 존재하면 삭제 불가합니다.');
    return false;
  }
}

var aa = 'realContractDelete';
var bb = 'p_realContract_delete_for.php';
var cc = JSON.stringify(contractArray);

goCategoryPage(aa, bb, cc);

function goCategoryPage(a, b, c){
  var frm = formCreate(a, 'post', b,'');
  frm = formInput(frm, 'contractArray', c);
  formSubmit(frm);
}

}) //rowDeleteBtn function closing



$('#button6').click(function(){ //n개월추가 버튼, 모달클릭으로 바뀜
    var allCnt = $(":checkbox:not(:first)", table).length;
    var addMonth = Number($("input[name='addMonth']").val());
    var changeAmount1 = $("input[name='modalAmount1']").val()
    var changeAmount2 = $("input[name='modalAmount2']").val()
    var changeAmount3 = $("input[name='modalAmount3']").val()


    if(Number(addMonth) > 12){
        alert('최대계약기간은 12개월(1년)입니다. 더이상 기간연장은 불가합니다.');
        return false;
    }

    var aa = 'contractScheduleAppendM';
    var bb = 'p_contractScheduleAppendM.php';
    var contractId = '<?=$filtered_id?>';

    goCategoryPage(aa,bb,contractId,addMonth,changeAmount1,changeAmount2,changeAmount3);

    function goCategoryPage(a,b,c,d,e,f,g){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'addMonth', d);
        frm = formInput(frm, 'changeAmount1', e);
        frm = formInput(frm, 'changeAmount2', f);
        frm = formInput(frm, 'changeAmount3', g);
        formSubmit(frm);
    }
}); //n개월추가

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
