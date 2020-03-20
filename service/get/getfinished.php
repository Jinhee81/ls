<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>입금완료리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php"; //이거빼면큰일남, 조회안됨
// print_r($_SESSION);

$sql_sms = "select
          screen, title, description
        from sms
        where
          user_id={$_SESSION['id']} and
          screen='입금완료화면'";
// echo $sql_sms;

$result_sms = mysqli_query($conn, $sql_sms);
while($row_sms = mysqli_fetch_array($result_sms)){
  $rowsms[] = $row_sms;
}

// print_r($rowsms);
?>

<script type="text/javascript">
  var smsSettingArray = <?php echo json_encode($rowsms); ?>;
  // console.log(smsSettingArray);
</script>

<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        #thead2 tr.selected{background-color: #A9D0F5;}
        #tbody2 tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4"><span id="screenName">입금완료화면</span>입니다!(#501)</h1>
    <p class="lead">

    </p>
  </div>
</section>
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <!-- <div class="row justify-content-md-center"> -->
      <form>
        <div class="form-group row justify-content-md-center mb-2">
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="dateDiv" name="dateDiv">
              <option value="executiveDate">입금일자</option>
              <option value="taxDate">증빙일자</option>
            </select><!--codi1-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="periodDiv" name="periodDiv">
              <option value="allDate">--</option>
              <option value="nowMonth" selected>당월</option>
              <option value="pastMonth">전월</option>
              <option value="1pastMonth">1개월전</option>
              <!-- <option value="3pastMonth">3개월전</option> -->
              <option value="nowYear">당년</option>
            </select><!--codi2-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType"><!--fromDate-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType"><!--toDate-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="building" name="building">
            </select><!--관리물건-->
          </div>
          <!-- <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="group" name="group">
            </select>
          </div> --><!--임대/상품, 이거는 넣으려다가 안넣기로 함-->
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="taxDiv" name="taxDiv">
              <option value="alltax">세액전체</option>
              <option value="taxYes">0원초과</option>
              <option value="taxNone">0원</option>
            </select><!--부가세유무-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="payKind" name="payKind">
              <option value="payall">입금구분전체</option>
              <option value="계좌">계좌</option>
              <option value="현금">현금</option>
              <option value="카드">카드</option>
            </select><!--입금구분-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="taxKind" name="taxKind">
              <option value="taxall">증빙전체</option>
              <option value="taxExist">있음</option>
              <option value="taxNone">없음</option>
            </select><!--증빙구분-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
              <option value="customer">세입자명</option>
              <option value="contact">연락처</option>
              <!-- <option value="contractId">계약번호</option> -->
              <option value="gName">그룹명</option>
              <option value="rName">방번호</option>
              <option value="goodName">상품</option>
            </select><!--codi8-->
          </div>
          <div class="col-sm-2 pl-0 pr-0">
            <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
          </div>
          <!-- <div class="col-sm-1 pl-0 pr-0">
            <button type="button" name="btnLoad" class="btn btn-info btn-sm btn-block">조회</button>
          </div> -->
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
              <select class="form-control form-control-sm" id="smsTitle">
                <option value="상용구없음">상용구없음</option>
                <?php for ($i=0; $i < count($rowsms); $i++) {
                  echo "<option value='".$rowsms[$i]['title']."'>".$rowsms[$i]['title']."</option>";
                } ?>
              </select>
            </div>
            <div class="col-sm-2 pl-1 pr-0">
              <button class="btn btn-sm btn-block btn-outline-primary" id="smsBtn" data-toggle="modal" data-target="#smsModal1"><i class="far fa-envelope"></i> 보내기</button>
            </div>
            <div class="col-sm-3 pl-1">
              <a href="/service/sms/smsSetting.php" target="_blank"><button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn">상용구설정</button></a>
            </div>
          </div>

        </div>
        <div class="col">
          <div class="row justify-content-end mr-0">
            <div class="col col-md-3 pl-0 pr-1">
              <input type="text" name="taxDate" value="" class="form-control form-control-sm dateType text-center" placeholder="발행일자">
            </div>
            <div class="col col-md-3 pl-0 pr-1">
              <select class="form-control form-control-sm" name="taxSelect">
                <option value="세금계산서">세금계산서</option>
                <!-- <option value="현금영수증">현금영수증</option> -->
              </select>
            </div>
            <div class="col col-md-2 pl-0 pr-1">
              <button type="button" class="btn btn-primary btn-sm btn-block" id="btnTaxDateInput">발행</button>
            </div>
            <!-- <div class="col col-md-2 pl-0">
              <button type="button" class="btn btn-outline-primary btn-sm btn-block" id="btnTaxDateCancel">발행취소</button>
            </div> 발행취소넣으려다가 안넣었음-->
          </div>
        </div>
    </div>
    <div class="row justify-content-end mr-0">
      <label class="mb-0" style="color:#007bff;"> 체크 : <span id="ptAmountSelectCount">0</span>건, 공 <span id="pAmountSelectAmount">0</span>원, 세 <span id="pvAmountSelectAmount">0</span>원, 합 <span id="ptAmountSelectAmount">0</span>원</label><!--글자 파란색-->
    </div>
    <div class="" id="allVals">
    <!-- isright 6666? -->
    </div>
</section>


<?php
include $_SERVER['DOCUMENT_ROOT']."/service/sms/modal_sms1.php";
include $_SERVER['DOCUMENT_ROOT']."/service/sms/modal_sms2.php";
 ?>


<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>
<script src="/js/jquery-ui-timepicker-addon.js"></script>
<script src="/js/etc/newdate5.js?v=<%=System.currentTimeMillis()%"></script>
<script src="/js/etc/sms_noneparase3.js?v=<%=System.currentTimeMillis()%>"></script>
<script src="/js/etc/sms_existparase10.js?v=<%=System.currentTimeMillis()%>"></script>
<script src="/js/etc/sms1.js?v=<%=System.currentTimeMillis()%>"></script>
<script>

//------------------------------------------------건물,그룹출력 시작------//
var buildingoption, select2option, buildingIdx, groupIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  buildingoption = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#building').append(buildingoption);
}
buildingIdx = $('#building').val();

for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
  select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
  // console.log(select3option);
  $('#select2').append(select2option);
}
groupIdx = $('#select2').val();

$('#building').on('change', function(event){
  buildingIdx = $('#building').val();
  $('#select2').empty();
  for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select2').append(select2option);
  }
  groupIdx = $('#select2').val();
})
//------------------------------------------------건물,그룹출력 끝------//

$(document).ready(function(){
    $('input[name="fromDate"]').val(todayMonthFirst);
    $('input[name="toDate"]').val(todayMonthLast);


    $.ajax({
      url: 'ajax_getFinishedLoad.php',
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

    $('#smsDiv').html('<span class="badge badge-primary">sms</span>');


})

//---------document.ready function end & 각종 조회 펑션 시작--------------//

$('select[name=periodDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=fromDate]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=toDate]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=building]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=taxDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=payKind]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=etcCondi]').on('change', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=cText]').on('keyup', function(){
    $.ajax({
      url: 'ajax_getFinishedLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

})
//---------조회버튼클릭평션 end and 증빙일자 펑션 시작--------------//

// var taxDate = $('input[name="taxDate"]').val();
// var taxSelect = $('select[name="taxSelect"]').val();
//
// $('input[name="taxDate"]').on('propertychange change keyup paste input', function(){
//   taxDate = $('input[name="taxDate"]').val();
//   console.log(taxDate);
// })
//
// $('select[name="taxSelect"]').on('propertychange change keyup', function(){
//   taxSelect = $('select[name="taxSelect"]').val();
//   console.log(taxSelect);
// })

$('#btnTaxDateInput').on('click', function(){

  var taxDate = $('input[name="taxDate"]').val();
  var taxSelect = $('select[name="taxSelect"]').val(); //세금계산서인지 현금영수증인지 구분
  var taxDiv = 'accept'; //입금예정리스트여서 청구라는 뜻의 charge 사용, 입금완료리스트에서는 영수라는 뜻의 accept 사용 예정

  var buildingId = $('#building :selected').val();
  var buildingText = $('#building :selected').text();
  var buildingPopbill = buildingArray[buildingId][2];
  var buildingCompanynumber = buildingArray[buildingId][3];

  // console.log(buildingId, buildingPopbill, buildingCompanynumber);

  if(taxArray.length===0){
    alert('세금계산서 발행할 것들을 먼저 체크박스로 선택해주세요.');
    return false;
  }


  if(buildingPopbill === 'popbillno'){
    alert(buildingText+' 물건은 팝빌 전자세금계산서 설정이 되어있지 않습니다. 전자세금계산서 설정을 확인해주세요 (환경설정->물건명클릭)');
    return false;
  }

  if(buildingCompanynumber.length === 0){
    alert(buildingText+'물건의 사업자번호등록이 되어있지 않습니다. 사업자번호가 등록되어야 합니다 (환경설정->물건명클릭)');
    return false;
  }

  if(buildingCompanynumber.length != 12){
    alert(buildingText+'물건의 사업자번호 형식이 올바르지 않습니다. 사업자번호를 확인하세요. (환경설정->물건명클릭)');
    return false;
  }

  if(taxDate.length===0){
    alert('세금계산서 발행일자가 입력되어야합니다.');
    return false;
  }

  if(taxArray.length >= 1) {
    for (var i in taxArray) {
      if(taxArray[i][14]['입금구분']==='카드'){
        alert("입금구분이 '카드'이면 세금계산서 발행이 불가합니다.");
        return false;
      }

      if(taxArray[i][11]['세액']==='0'){
            alert("세액이 '0'원이면 세금계산서 발행이 불가합니다.");
            return false;
      }

      if(taxArray[i][15]['증빙일자']){
            alert("이미 증빙일자가 존재하므로 세금계산서 발행이 불가합니다.");
            return false;
      }

      if(taxArray[i][2]['사업자번호'].length != 12){
            alert(taxArray[i][4]['성명']+"의 사업자번호가 비어있어 세금계산서 발행이 불가합니다.");
            return false;
      }

      if(!taxArray[i][3]['사업자명']){
            alert(taxArray[i][4]['성명']+"의 사업자명이 비어있어 세금계산서 발행이 불가합니다.");
            return false;
      }
    }
  }

  var taxArrayTo = JSON.stringify(taxArray);
  var aa = 'taxSave';
  var bb = 'p_payScheduleTaxInput.php';

  goCategoryPage(aa, bb, buildingId, buildingText, buildingPopbill, buildingCompanynumber, taxArrayTo, taxDate, taxSelect, taxDiv);

  function goCategoryPage(a,b,c,d,e,f,g,h,i,j){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'buildingId', c);
      frm = formInput(frm, 'buildingText', d);
      frm = formInput(frm, 'buildingPopbill', e);
      frm = formInput(frm, 'buildingCompanynumber', f);
      frm = formInput(frm, 'taxArray', g);
      frm = formInput(frm, 'taxDate', h);
      frm = formInput(frm, 'taxSelect', i);
      frm = formInput(frm, 'taxDiv', j);
      formSubmit(frm);
  }

})

//---------증빙일자펑션 end--------------//


</script>


<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
