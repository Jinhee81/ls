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
include $_SERVER['DOCUMENT_ROOT']."/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";

$sql_sms = "select
          screen, title, description
        from sms
        where
          user_id={$_SESSION['id']} and
          screen='입금예정화면'";
// echo $sql_sms;

$result_sms = mysqli_query($conn, $sql_sms);
while($row_sms = mysqli_fetch_array($result_sms)){
  $rowsms[] = $row_sms;
}

// print_r($rowsms);
?>

<script type="text/javascript">
  var smsSettingArray = <?php echo json_encode($rowsms); ?>;
  console.log(smsSettingArray);
</script>

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
    <h1 class="display-4">입금예정리스트 화면입니다!(#401)</h1>
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
            <select class="form-control form-control-sm selectCall" id="building" name="building">
            </select><!--codi6-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="group" name="group">
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
          <!-- <div class="col-sm-1 pl-0 pr-0">
            <button type="button" name="btnLoad" class="btn btn-info btn-sm">조회</button>
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
              <select class="form-control form-control-sm" id="smsTitle" name="">
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
<script src="/js/etc/sms_noneparase3.js?v=<%=System.currentTimeMillis()%"></script>
<script src="/js/etc/sms_existparase10.js?v=<%=System.currentTimeMillis()%"></script>
<script src="/js/etc/sms1.js?v=<%=System.currentTimeMillis()%"></script>

<script>

// var buildingoption = "<option value='all'>전체</option>";
// $('#building').append(buildingoption); //관리물건 전체를 넣으려다가 안넣-
var buildingoption;

var groupoption = "<option value='all'>전체</option>";
$('#group').append(groupoption);

var buildingIdx, groupIdx;

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
  var groupoption = "<option value='all'>전체</option>";
  $('#group').append(groupoption);
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
      url: 'ajax_getexpectedLoad1.php',
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

//---------document.ready function end & 각종 조회 펑션 시작--------------//

$('select[name=periodDiv]').on('change', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=fromDate]').on('change', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=toDate]').on('change', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=building]').on('change', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=group]').on('change', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('select[name=etcCondi]').on('change', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })
})

$('input[name=cText]').on('keyup', function(){
    $.ajax({
      url: 'ajax_getexpectedLoad1.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

})

//---------조회버튼클릭평션 end and 증빙일자 펑션 시작--------------//

var taxDate = $('input[name="taxDate"]').val();
var taxSelect = $('select[name="taxSelect"]').val();

$('input[name="taxDate"]').on('propertychange change keyup paste input', function(){
  taxDate = $('input[name="taxDate"]').val();
  console.log(taxDate);
})

$('select[name="taxSelect"]').on('propertychange change keyup', function(){
  taxSelect = $('select[name="taxSelect"]').val();
  console.log(taxSelect);
})

$('#btnTaxDateInput').on('click', function(){

  if(taxDate.length===0){
    alert('날짜가 입력되어야합니다.');
    return false;
  }

  if(taxArray.length >= 1) {
    for (var i in taxArray) {
      if(taxArray[i][3]==='카드'){
        alert("입금구분이 '카드'이면 세금계산서, 현금영수증 발행이 불가합니다.");
        return false;
      }
    }
  }

  if(taxArray.length >= 1) {
    for (var i in taxArray) {
      if(taxArray[i][2]==='0'){
        alert("세액이 '0'원이면 세금계산서, 현금영수증 발행이 불가합니다.");
        return false;
      }
    }
  }

  var taxArrayTo = JSON.stringify(taxArray);
  var aa = 'taxSave';
  var bb = 'p_payScheduleTaxInput.php';

  goCategoryPage(aa, bb, taxArrayTo, taxDate, taxSelect);

  function goCategoryPage(a,b,c,d,e){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'taxArray', c);
      frm = formInput(frm, 'taxDate', d);
      frm = formInput(frm, 'taxSelect', e);
      formSubmit(frm);
  }

})

//---------증빙일자펑션 end--------------//


</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
