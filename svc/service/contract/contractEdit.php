<!-- 입금완료인거는 처음부터 숨기기처리하게 할것, 예전거는 예비파일 contractEdit30으로 저장되었7 -->
<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>임대계약상세</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include "building.php";
include "contractEdit_condi.php";

 ?>

<div class="container jumbotron pt-3 pb-3 mb-2">
  <h2 class="">계약상세내용입니다.(#202)</h2>
</div>
<div class="container">
  <?php include "contractEdit_button.php";?>
  <?php include "contractEdit_ci.php";?>
  <?php
  include "contractEdit_cs.php";
  include "contractEdit_cs_modal_nadd.php";//n개월추가모달
  include "contractEdit_cs_modal_regist.php";//청구설정모달
  ?>
  <?php include "contractEdit_deposit.php";?>
  <?php include "contractEdit_file.php";?>
  <?php include "contractEdit_memo.php";?>
</div>


   <div class="d-flex justify-content-center">
     <small class="form-text text-muted text-center">계약번호[<?=$row[0]?>] 등록일시[<?=$row['createTime']?>] 수정일시[<?=$row['updateTime']?>] </small>
   </div><!-- 최하단 계약정보작성자보여주기세션 -->

   <div class="d-flex justify-content-center mt-3">
     <a class="btn btn-secondary mr-1" href="contract.php" role="button">계약목록 바로가기</a>
     <a class="btn btn-outline-secondary mr-1" href="contractAll.php" role="button">일괄계약등록</a>
     <a class="btn btn-outline-secondary mr-1" href="contract_add2.php" role="button">계약등록</a>
   </div><!-- 버튼모음 섹션 -->
 </div>

 <?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


 <script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
 <script src="/svc/inc/js/jquery-ui.min.js"></script>
 <script src="/svc/inc/js/popper.min.js"></script>
 <script src="/svc/inc/js/bootstrap.min.js"></script>
 <script src="/svc/inc/js/datepicker-ko.js"></script>
 <script src="/svc/inc/js/jquery.number.min.js"></script>
 <script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
 <script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>
 <script src="/svc/inc/js/etc/uploadfile.js?<?=date('YmdHis')?>"></script>

 <script type="text/javascript">
   var buildingArray = <?php echo json_encode($buildingArray); ?>;
   var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
   var roomArray = <?php echo json_encode($roomArray); ?>;
//    console.log(buildingArray);
//    console.log(groupBuildingArray);
//    console.log(roomArray);
 </script>

<script>

$(document).ready(function(){
  var step = '<?=$step?>';
  if(step ==! 'clear'){
    $('button[name="contractEdit"]').attr('disabled', true);
    $('button[name="contractDelete"]').attr('disabled', true);
  }

  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })


  $('.modalAsk').on('click', function(){ //청구번호클릭하는거(모달클릭)

    var currow2 = $(this).closest('tr');
    var payNumber = currow2.find('td:eq(7)').children('label').children('u').text();
    // console.log(payNumber);
    var filtered_id = '<?=$filtered_id?>';
    // console.log(filtered_id);

      $.ajax({
        url: 'ajax_paySchedule2_payid.php',
        method: 'post',
        data: {payNumber : payNumber, filtered_id:filtered_id},
        success: function(data){
          $('.payid').html(data);
        }
      })

      $.ajax({
        url: 'ajax_paySchedule2_search.php',
        method: 'post',
        data: {payNumber : payNumber, filtered_id:filtered_id},
        success: function(data){
          $('.modal-body').html(data);
        }
      })

      $.ajax({
        url: 'ajax_paySchedule2_modalfooter.php',
        method: 'post',
        data: {payNumber : payNumber, filtered_id:filtered_id},
        success: function(data){
          $('.modal-footer').html(data);
        }
      })
  }) //청구번호클릭하는거(모달클릭) closing}

  var allCnt = $(":checkbox:not(:first)", table).length;

  for (var i = 1; i <= allCnt; i++) {
    var executiveDateIs = table.find("tr:eq("+i+")").children("td:eq(9)").children('label').text();
    // console.log(executiveDateIs);
    if(executiveDateIs){
      table.find("tr:eq("+i+")").css('display', 'none');
    }
  }//이거는 처음에 로딩할때 입금완료상태이면 안보이게하려고 하는거임


  $(".amountNumber").click(function(){
    $(this).select();
  });

  $("input:text[numberOnly]").number(true);

  $(".numberComma").number(true);

  $('#groupExpecteDay').keydown(function (event) {
   var key = event.charCode || event.keyCode || 0;
   $text = $(this);
   if (key !== 8 && key !== 9) {
       if ($text.val().length === 4) {
           $text.val($text.val() + '-');
       }
       if ($text.val().length === 7) {
           $text.val($text.val() + '-');
       }
   }

   return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
  // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
  // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
  })

  var tbl = $("#checkboxTestTbl");

  // 테이블 헤더에 있는 checkbox 클릭시
  $(":checkbox:first", tbl).change(function(){
    if($(":checkbox:first", tbl).is(":checked")){
      $(":checkbox", tbl).prop('checked',true);
      $(":checkbox").parent().parent().addClass("selected");
    } else {
      $(":checkbox", tbl).prop('checked',false);
      $(":checkbox").parent().parent().removeClass("selected");
    }
  })
  // 헤더에 있는 체크박스외 다른 체크박스 클릭시
  $(":checkbox:not(:first)", tbl).change(function(){
    var allCnt = $(":checkbox:not(:first)", tbl).length;
    var checkedCnt = $(":checkbox:not(:first)", tbl).filter(":checked").length;
    if($(this).prop("checked")==true){
      $(this).parent().parent().addClass("selected");
    } else {
      $(this).parent().parent().removeClass("selected");
    }
    if( allCnt==checkedCnt ){
      $(":checkbox:first", tbl).prop("checked", true);
    }
  })

  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    currentText: '오늘', // 오늘 날짜로 이동하는 버튼 패널
    closeText: '닫기'  // 닫기 버튼 패널
  })

}) //document.ready function closing}



var step = '<?=$step?>';
// console.log(step);
if(step === 'clear'){
  $('button[name="contractEdit"]').attr('disabled', false);
  $('button[name="contractDelete"]').attr('disabled', false);
} else {
  $('button[name="contractEdit"]').attr('disabled', true);
  $('button[name="contractDelete"]').attr('disabled', true);
}


var table = $("#checkboxTestTbl");

var expectedDayArray = [];

$(":checkbox:first", table).click(function(){

    var allCnt = $(":checkbox:not(:first)", table).length;
    expectedDayArray = [];

    if($(":checkbox:first", table).is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var expectedDayEle = [];
        expectedDayEle.push(i);
        expectedDayEle.push(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());
        expectedDayEle.push(table.find("tr:eq("+i+")").find("td:eq(6)").children('input').val());
        expectedDayArray.push(expectedDayEle);
      }
      // console.log(expectedDayArray);
    } else {
      expectedDayArray = [];
      // console.log(expectedDayArray);
    }
})

// $('.table').on('click',$(':checkbox:not(:first).is(":checked")'),function()

$(":checkbox:not(:first)",table).click(function(){
  var expectedDayEle = [];

  if($(this).is(":checked")){
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colexpectDate = currow.find('td:eq(6)').children('input').val();
    expectedDayEle.push(colOrder, colid, colexpectDate);
    expectedDayArray.push(expectedDayEle);
    // console.log(expectedDayArray);
    // console.log('체크됨');
  } else {
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colexpectDate = currow.find('td:eq(6)').children('input').val();
    var dropReady = expectedDayEle.push(colOrder, colid, colexpectDate);
    // console.log(dropReady);
    // console.log('체크해제됨');
    var index = expectedDayArray.indexOf(dropReady);
    expectedDayArray.splice(index, 1);
    // console.log(expectedDayArray);
  }
})

$('.table').on('keyup', '.amountNumber:input[type="text"]', function(){
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());

  // console.log(colOrder);

  var colmAmount = Number(currow.find('td:eq(3)').children('input:eq(0)').val());
  var colmvAmount = Number(currow.find('td:eq(3)').children('input:eq(1)').val());

  var colmtAmount = colmAmount + colmvAmount;
  currow.find('td:eq(4)').children('input').val(colmtAmount);
  // console.log(colmAmount);
})



$('#groupExpecteDay').change(function(){ //입금예정일 변경버튼 이벤트
  var expectedDayGroup = $('#groupExpecteDay').val();
  if(expectedDayArray.length >= 1) {
    for (var i in expectedDayArray) {
       table.find("tr:eq("+expectedDayArray[i][0]+")").find("td:eq(5)").children('input').val(expectedDayGroup);
      // console.log(expectedDayArray[i][0], a);
    }
  }
})

$('#button1').click(function(){ //청구설정버튼 클릭시
  var paykind = $('#paykind option:selected').text();
  // console.log(paykind);

  var paySchedule = [];

  for (var i = 0; i < expectedDayArray.length; i++) {
    table.find("tr:eq("+expectedDayArray[i][0]+")").find("td:eq(6)").text(paykind);
    // console.log(expectedDayArray[i][0], a);
    // 입금구분을 변경시키는 것
    var payScheduleEle = [];
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val()); //계약번호
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(1)').text()); //순번
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(2)').children('label:eq(0)').text()); //시작일
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(2)').children('label:eq(1)').text()); //종료일
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(3)').children('input:eq(0)').val()); //공급가액
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(3)').children('input:eq(1)').val()); //세액
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(4)').children('input:eq(0)').val()); //합계금액
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(5)').children('input:eq(0)').val()); //예정일
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(6)').text()); //입금구분

    paySchedule.push(payScheduleEle);
  }
  // console.log(paySchedule);

  var paySchedule11 = JSON.stringify(paySchedule);

  var contractId = '<?=$filtered_id?>';
  var buildingId = $('input[name=building]').val();

  if(expectedDayArray.length === 0){
    alert('한개 이상을 선택해야 청구가 됩니다.');
    return false;

  } else if (expectedDayArray.length <= 72) {

    goCategoryPage(paySchedule11, contractId, buildingId);

    function goCategoryPage(a, b, c){
      var frm = formCreate('payScheduleAdd', 'post', 'p_payScheduleAdd.php','');
      frm = formInput(frm, 'scheduleArray', a);
      frm = formInput(frm, 'contractId', b);
      frm = formInput(frm, 'buildingId', c);
      formSubmit(frm);
    }

  }
})

$('#button2').click(function(){ //청구취소버튼 클릭시

  var contractScheduleArray = [];

  for (var i = 0; i < expectedDayArray.length; i++) {

    var csId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val();
    var csCheck = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(7)').text();
    // console.log(csCheck);

    if(csCheck ==!'계좌' || csCheck ==!'현금' || csCheck ==!'카드'){
      alert('청구설정된것만 청구취소가 가능합니다.');
      return false;
    }

    contractScheduleArray.push(csId, csCheck);
  }
  // console.log(contractScheduleArray);

  var aa = 'payScheduleDrop';
  var bb = 'p_payScheduleDropFor.php';
  var cc = 'scheduleArray';
  var dd = 'contractId';
  var contractId = '<?=$filtered_id?>';

  goCategoryPage(aa, bb, cc, contractScheduleArray, dd, contractId);

  function goCategoryPage(a, b, c, d, e, f){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, c, d);
    frm = formInput(frm, e, f);
    formSubmit(frm);
  }


})


$('#button3').click(function(){ //일괄입금버튼 클릭시

  var contractScheduleArray = [];

  // console.log(expectedDayArray);

  if(expectedDayArray.length===0){
    alert('청구설정된것을 선택해야 일괄입금처리가 가능합니다.');
    return false;
  }

  for (var i = 0; i < expectedDayArray.length; i++) {

    // var csId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val(); 계약스케줄을 가져오려다가 안가져옴, 왜냐면 필요가없음

    var psId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(7)').children('label').children('u').text();
    // console.log(psId); //제이쿼리로 트림을 하니 더 이상해져서 안하기로함

    if(psId.trim()===""){ //trim()이거를 안넣으니 빈문자열로 인식이 안되어서 이거넣음
      alert('청구번호가 존재해야 일괄입금처리가 가능합니다.');
      return false;
    }

    contractScheduleArray.push(psId);
  }
  // console.log(contractScheduleArray);

  var aa = 'getAmountInput';
  var bb = 'p_payScheduleGetAmountInputFor.php';
  var cc = 'scheduleArray';
  var dd = 'contractId';
  var contractId = '<?=$filtered_id?>';

  goCategoryPage(aa, bb, cc, contractScheduleArray, dd, contractId);

  function goCategoryPage(a, b, c, d, e, f){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, c, d);
    frm = formInput(frm, e, f);
    formSubmit(frm);
  }

})

$('#button4').click(function(){ //일괄입금취소버튼 클릭시

var contractScheduleArray = [];

for (var i = 0; i < expectedDayArray.length; i++) {

var psId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(7)').children('label').children('u').text();

if(psId===""){ //trim()이거를 안넣으니 빈문자열로 인식이 안되어서 이거넣음
  alert('청구번호가 존재해야 일괄입금취소 처리가 가능합니다.');
  return false;
}

contractScheduleArray.push(psId);
}
// console.log(contractScheduleArray);

var aa = 'getAmountDrop';
var bb = 'p_payScheduleGetAmountCanselFor.php';
var cc = 'scheduleArray';
var dd = 'contractId';
var contractId = '<?=$filtered_id?>';

goCategoryPage(aa, bb, cc, contractScheduleArray, dd, contractId);

function goCategoryPage(a, b, c, d, e, f){
var frm = formCreate(a, 'post', b,'');
frm = formInput(frm, c, d);
frm = formInput(frm, e, f);
formSubmit(frm);
}

})

$('#button7').click(function(){ //삭제버튼 클릭시

    var contractScheduleArray = [];
    var allCnt = $(":checkbox:not(:first)", table).length;
    // console.log(allCnt);

    for (var i = 0; i < expectedDayArray.length; i++) {

    contractScheduleArray[i] = [];

    var csId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val();

    var csOrder = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(1)').children('p').text();

    var psId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(8)').children('p').children('u').text();

    if(psId){
      alert('청구번호가 존재하면 삭제할수 없습니다.');
      return false;
    }

    contractScheduleArray[i].push(csId, csOrder, psId);
    }
    // console.log(contractScheduleArray);

    var selectedOrderArray = [];
      for (var i = 0; i < expectedDayArray.length; i++) {
        selectedOrderArray.push(expectedDayArray[i][0]);
      }
      selectedOrderArray.sort(function(a,b) {
        return a-b;
      }); //선택한순번들을 오름차순으로 정렬해주는것
      // console.log(selectedOrderArray);

    var regularOrderArray=[];
      for (var i = 0; i < contractScheduleArray.length; i++) {
        var ele = allCnt - i;
        regularOrderArray.push(ele);
      }
      regularOrderArray.sort(function(a,b) {
        return a-b;
      }); //정해진순번들을 오름차순으로 정렬해주는것
      // console.log(regularOrderArray);
    if(selectedOrderArray.length===0){
    alert('한개 이상을 선택해야 삭제 가능합니다.');
    return false;
    }

    if(!selectedOrderArray.includes(allCnt)){
    alert('스케줄 중간을 삭제할 수 없습니다.');
    return false;
    }

    if(selectedOrderArray.includes(1)){
    alert('순번1은 삭제할 수 없습니다. 1개이상의 스케쥴은 존재해야 합니다.');
    return false;
    }

    for (var i = 0; i < regularOrderArray.length; i++) {
        if(!((regularOrderArray[i]-selectedOrderArray[i])===0)){
        alert('스케줄은 순차적으로 삭제되어야 합니다.');
        return false;
        }
        // console.log(regularOrderArray[i]);
        // console.log(selectedOrderArray[i]);
    }

    var contractScheduleIdArray = [];
    for (var i = 0; i < contractScheduleArray.length; i++) {
    contractScheduleIdArray.push(contractScheduleArray[i][0]);
    }
    // console.log(contractScheduleIdArray);

    var aa = 'contractScheduleDrop';
    var bb = 'p_contractScheduleDrop.php';
    var contractId = '<?=$filtered_id?>';

    goCategoryPage(aa, bb, contractId, contractScheduleIdArray);

    function goCategoryPage(a, b, c, d){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'contractId', c);
    frm = formInput(frm, 'contractScheduleIdArray', d);
    formSubmit(frm);
    }
}) //삭제버튼 클릭시

$('#button5').click(function(){ //1개월추가 버튼클릭
var allCnt = $(":checkbox:not(:first)", table).length;
var aa = 'contractScheduleAppend';
var bb = 'p_contractScheduleAppend.php';
var contractId = '<?=$filtered_id?>';

if(allCnt===72){
alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
return false;
}

goCategoryPage(aa,bb,contractId);

function goCategoryPage(a,b,c){
var frm = formCreate(a, 'post', b,'');
frm = formInput(frm, 'contractId', c);
formSubmit(frm);
}
}); //1개월추가 버튼

$('#memoButton').click(function(){
    var memoInputer = $('#memoInputer').val();
    var memoContent = $('#memoContent').val();

    if(!memoContent){
        alert('내용을 입력해야 합니다.');
        return false;
    }
    // console.log(memoInputer, memoContent);

    var aa = 'memoAppend';
    var bb = 'p_memoAppend.php';
    var contractId = '<?=$filtered_id?>';

    goCategoryPage(aa,bb,contractId,memoInputer,memoContent);

    function goCategoryPage(a,b,c,d,e){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'memoInputer', d);
        frm = formInput(frm, 'memoContent', e);
        formSubmit(frm);
    }

});

$("button[name='memoEdit']").click(function(){
    var memoid = $(this).parent().parent().children().children('input:eq(1)');
    var memoCreator = $(this).parent().parent().children().children('input:eq(0)');
    var memoContent = $(this).parent().parent().children().children('input:eq(2)');
    // console.log(memoid, memoCreator, memoContent);
    var smallEditButton = "<button type='button' name='smallEditButton' class='btn btn-secondary btn-sm'>수정</button><button type='button' name='smallEditButtonCancel' class='btn btn-secondary btn-sm'>취소</button>";

    memoCreator.removeAttr("disabled");
    memoContent.removeAttr("disabled");
    // $(this).hide();//편집버튼을 누르면 편집아이콘 및 휴지통아이콘은 없어져야한다.
    // $(this).next().hide();
    var memo = $(this).attr('id');
    $('#'+memo).hide();
    var del = 'del'+memo.replace('edit','');
    $('#'+del).hide();
    $('#'+memo).after(smallEditButton);
    // console.log('solmi');

    $("button[name='smallEditButton']").click(function(){
        // console.log('작은버튼클릭');
        var aa = 'memoEdit';
        var bb = 'p_memoEdit.php';
        var contractId = '<?=$filtered_id?>';
        var memoid = $(this).parent().parent().children().children('input:eq(1)').val();
        var memoCreator = $(this).parent().parent().children().children('input:eq(0)').val();
        var memoContent = $(this).parent().parent().children().children('input:eq(2)').val();
        // console.log(contractId, memoid, memoCreator, memoContent);

        goCategoryPage(aa,bb,contractId,memoid,memoCreator,memoContent);

        function goCategoryPage(a,b,c,d,e,f){
            var frm = formCreate(a, 'post', b,'');
            frm = formInput(frm, 'contractId', c);
            frm = formInput(frm, 'memoid', d);
            frm = formInput(frm, 'memoCreator', e);
            frm = formInput(frm, 'memoContent', f);
            formSubmit(frm);
        }
    });

    $("button[name='smallEditButtonCancel']").click(function(){
      // var memoid = $(this).parent().parent().children().children('input:eq(0)').val();
      // var memoCreator = $(this).parent().parent().children().children('input:eq(1)').val();
      // var memoContent = $(this).parent().parent().children().children('input:eq(2)').val();

      var memoid = $(this).parent().parent().children().children('input:eq(1)');
      var memoCreator = $(this).parent().parent().children().children('input:eq(0)');
      var memoContent = $(this).parent().parent().children().children('input:eq(2)');

      // console.log(memoid, memoCreator, memoContent);
      //var smallsubmitButton = "<button type='submit' name='memoEdit' class='btn btn-default grey'><i class='far fa-edit'></i></button><button type='submit' name='memoDelete' class='btn btn-default grey'><i class='far fa-trash-alt'></i></button>";

      memoCreator.attr("disabled", true);
      memoContent.attr("disabled", true);
      $(this).hide();
      $(this).prev().hide();
      //$(this).parent().parent().find('td:eq(5)').html(smallsubmitButton)
      $('#'+memo).show();
      $('#'+del).show();
    });


});

$("button[name='memoDelete']").click(function(){
    var memoid = $(this).parent().parent().children().children('input:eq(1)').val();

    // console.log('메모삭제', memoid);

    var contractId = '<?=$filtered_id?>';
    var aa = 'memoDelete';
    var bb = 'p_memoDelete.php';
    //
    goCategoryPage(aa,bb,contractId,memoid);

    function goCategoryPage(a,b,c,d){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'memoid', d);
        formSubmit(frm);
    }
});

$("button[name='fileDelete']").click(function(){
    var fileid = $(this).parent().parent().children().children('input:eq(0)').val();

    // console.log('메모삭제', memoid);

    var contractId = '<?=$filtered_id?>';
    var aa = 'fileDelete';
    var bb = 'p_fileDelete.php';
    //
    goCategoryPage(aa,bb,contractId,fileid);

    function goCategoryPage(a,b,c,d){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'fileid', d);
        formSubmit(frm);
    }
});


$("input[name='depositInAmount']").on('keyup', function(){
    var depositInAmount = Number($(this).val());
    var depositOutAmount = Number($("input[name='depositOutAmount']").val());
    var depositMoney = depositInAmount - depositOutAmount;
    $("input[name='depositMoney']").val(depositMoney);
});

$("input[name='depositOutAmount']").on('keyup', function(){
    var depositInAmount = Number($("input[name='depositInAmount']").val());
    var depositOutAmount = Number($(this).val());
    var depositMoney = depositInAmount - depositOutAmount;
    $("input[name='depositMoney']").val(depositMoney);
});

$("button[name='depositSaveBtn']").on('click', function(){
    var depositInDate = $("input[name='depositInDate']").val();
    var depositInAmount = Number($("input[name='depositInAmount']").val());
    var depositOutDate = $("input[name='depositOutDate']").val();
    var depositOutAmount = Number($("input[name='depositOutAmount']").val());
    var depositMoney = Number($("input[name='depositMoney']").val());

    var contractId = '<?=$filtered_id?>';
    var aa = 'depositSave';
    var bb = 'p_depositSave.php';

    goCategoryPage(aa,bb,contractId,depositInDate,depositInAmount,depositOutDate,depositOutAmount,depositMoney);

    function goCategoryPage(a,b,c,d,e,f,g,h){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'depositInDate', d);
        frm = formInput(frm, 'depositInAmount', e);
        frm = formInput(frm, 'depositOutDate', f);
        frm = formInput(frm, 'depositOutAmount', g);
        frm = formInput(frm, 'depositMoney', h);
        formSubmit(frm);
    }
})

$("button[name='contractDelete']").on('click', function(){
  var contractId = '<?=$filtered_id?>';
  var memocount = '<?=count($memoRows)?>';
  var filecount = '<?=count($fileRows)?>';

  if(Number(memocount)>0){
    alert('메모를 삭제해야 계약삭제 가능합니다.');
    return false;
  }

  if(Number(filecount)>0){
    alert('파일을 삭제해야 계약삭제 가능합니다.');
    return false;
  }

  var aa = 'contractDelete';
  var bb = 'p_realContract_delete.php';

  var deleteCheck = confirm('정말 삭제하겠습니까?');
  if(deleteCheck){
    goCategoryPage(aa,bb,contractId);

    function goCategoryPage(a,b,c){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'contractId', c);
      formSubmit(frm);
    }
  }
})//메모개수와 파일개수가 0이어야 삭제가 됨

$("input[name='modalAmount1']").on('keyup', function(){
    var changeAmount1 = Number($(this).val());
    var changeAmount2 = Number($("input[name='modalAmount2']").val());
    var changeAmount3 = changeAmount1 + changeAmount2;
    $("input[name='modalAmount3']").val(changeAmount3);
});

$("input[name='modalAmount2']").on('keyup', function(){
    var changeAmount2 = Number($(this).val());
    var changeAmount1 = Number($("input[name='modalAmount1']").val());
    var changeAmount3 = changeAmount1 + changeAmount2;
    $("input[name='modalAmount3']").val(changeAmount3);
});

$('#button6').click(function(){ //n개월추가 버튼, 모달클릭으로 바뀜
    var allCnt = $(":checkbox:not(:first)", table).length;
    var addMonth = Number($("input[name='addMonth']").val());
    var changeAmount1 = $("input[name='modalAmount1']").val()
    var changeAmount2 = $("input[name='modalAmount2']").val()
    var changeAmount3 = $("input[name='modalAmount3']").val()


    if(Number(addMonth)+allCnt > 72){
        alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
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



$('#button8').on('click', function(){
  var allCnt = $(":checkbox:not(:first)", table).length;

  for (var i = 1; i <= allCnt; i++) {
    var executiveDateIs = table.find("tr:eq("+i+")").find("td:eq(9)").children('label').text();
    if(executiveDateIs){
      table.find("tr:eq("+i+")").css('display', '');
    }
  }
})

</script>


</body>
</script>
