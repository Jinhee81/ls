<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>기타계약리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contractetc/good.php";
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
    <h1 class="display-4">기타계약리스트 화면입니다!</h1>
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
              <option value="executiveDate">입금일자</option>
              <option value="createTime">등록일자</option>
              <option value="updateTime">수정일자</option>
            </select><!--codi1-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="periodDiv" name="periodDiv">
              <option value="allDate">--</option>
              <option value="nowMonth" selected>당월</option>
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
            <select class="form-control form-control-sm selectCall" id="building" name="building">
            </select><!--codi6-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="good" name="good">
              <option value="goodAll">상품전체</option>
            </select><!--codi7-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
              <option value="customer">성명/사업자명</option>
              <option value="contact">연락처</option>
              <option value="contractId">계약번호</option>
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
          <button type="button" class="btn btn-secondary" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="단계가 clear인 것들만 삭제가 가능합니다">삭제</button>
          <a href="contractetc_add.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
        </div>
    </div>

    <div class="" id="allVals">
    <!-- isright 6666? -->
    </div>
</section>

<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>
<script src="/js/etc/newdate5.js?v=<%=System.currentTimeMillis()%"></script>
<script src="/js/etc/sms_noneparase3.js?v=<%=System.currentTimeMillis()%>"></script>
<script src="/js/etc/sms_existparase10.js?v=<%=System.currentTimeMillis()%>"></script>
<script src="/js/etc/sms1.js?v=<%=System.currentTimeMillis()%>"></script>

<script>

var buildingoption, goodoption, buildingIdx, goodIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  buildingoption = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#building').append(buildingoption);
}
buildingIdx = $('#building').val();

for(var key2 in goodBuildingArray[buildingIdx]){ //상품목록출력(빔,회의실)
  goodoption = "<option value='"+key2+"'>"+goodBuildingArray[buildingIdx][key2]+"</option>";
  // console.log(select3option);
  $('#good').append(goodoption);
}
goodIdx = $('#good').val();

$('#building').on('change', function(event){
  buildingIdx = $('#building').val();
  $('#good').empty();
  $('#good').append('<option value="goodAll">상품전체</option>');
  for(var key2 in goodBuildingArray[buildingIdx]){ //상품목록출력(빔,회의실)
    goodoption = "<option value='"+key2+"'>"+goodBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#good').append(goodoption);
  }
  goodIdx = $('#good').val();
})
//------------------------------------------------건물,상품출력 끝------//

$(document).ready(function(){

    $('input[name="fromDate"]').val(todayMonthFirst);
    $('input[name="toDate"]').val(todayMonthLast);

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $.ajax({
      url: 'ajax_etcContractLoad.php',
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
}) //==================document.ready function end and the other load start!


$('select[name=periodDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_etcContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=fromDate]').on('change', function(){
    $.ajax({
      url: 'ajax_etcContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=toDate]').on('change', function(){
    $.ajax({
      url: 'ajax_etcContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=building]').on('change', function(){
    $.ajax({
      url: 'ajax_etcContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=good]').on('change', function(){
    $.ajax({
      url: 'ajax_etcContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})


$('input[name=cText]').on('keyup', function(){
    $.ajax({
      url: 'ajax_etcContractLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

})
//---------조회버튼클릭평션 end and 증빙일자 펑션 시작--------------//


</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
