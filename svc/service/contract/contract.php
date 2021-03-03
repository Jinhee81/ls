<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>임대계약</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include "building.php";

$sql_sms = "select
          screen, title, description
        from sms
        where
          user_id={$_SESSION['id']} and
          screen='임대계약화면'";
// echo $sql_sms;

$result_sms = mysqli_query($conn, $sql_sms);
$rowsms = array();
while($row_sms = mysqli_fetch_array($result_sms)){
  $rowsms[] = $row_sms;
}

// print_r($_SESSION);
?>

<!-- 제목 -->
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">계약목록이에요.(#201)</h2>
    <p class="lead">
      (1) 상태(<span class="badge badge-info text-wrap" style="width: 3rem;">현재</span>, <span class="badge badge-warning text-wrap" style="width: 3rem;">대기</span>, <span class="badge badge-danger text-wrap" style="width: 3rem;">종료</span>, <span class="badge badge-danger text-wrap" style="width: 5rem;">중간종료</span>)로 계약을 구분해요.<br>
      (2) 임대료를 클릭하면 해당 계약의 상세페이지를 볼 수 있어요.<br>
      (3) 계약만 등록된 상태 (clear)는 따로 조회 가능합니다 (현재, 종료, 대기, 중간종료 뒤 clear 선택함)
    </p>
  </div>
</section>


<!-- 조회조건 -->
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <form>
      <div class="row justify-content-md-center">
        <table>
          <tr>
            <td width="6%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="dateDiv">
                <option value="startDate">시작일자</option>
                <option value="endDate">종료일자</option>
                <option value="contractDate">계약일자</option>
                <option value="registerDate">등록일자</option>
              </select><!--codi1-->
            </td>
            <td width="6%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="periodDiv">
                <option value="allDate">--</option>
                <option value="nowMonth">당월</option>
                <option value="pastMonth">전월</option>
                <option value="nextMonth">익월</option>
                <option value="1pastMonth">1개월전</option>
                <option value="nownextMonth">당월익월</option>
                <option value="nowYear">당년</option>
              </select><!--codi2-->
            </td>
            <td width="8%" class="mobile">
              <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType yyyymmdd"><!--codi3-->
            </td>
            <td width="1%" class="mobile">~</td>
            <td width="8%" class="mobile">
              <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType yyyymmdd"><!--codi4-->
            </td>
            <td width="5%" class="">
              <select class="form-control form-control-sm selectCall" name="progress">
                <option value="pAll">전체</option>
                <option value="pIng" selected>현재</option>
                <option value="pEnd">종료</option>
                <option value="pWaiting">대기</option>
                <option value="middleEnd">중간종료</option>
                <option value="clear">clear</option>
              </select><!--codi5-->
            </td>
            <td width="6%" class="">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!--building-->
            </td>
            <td width="6%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="group">
                <option value="groupAll">그룹전체</option>
              </select><!--group-->
            </td>
            <td width="8%" class="">
              <select class="form-control form-control-sm selectCall" name="etcCondi">
                <option value="customer">성명/사업자명</option>
                <option value="contact">연락처</option>
                <option value="contractId">계약번호</option>
                <option value="roomId">관리호수</option>
              </select><!--codi8-->
            </td>
            <td width="12%" class="">
              <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</section>

<!-- 문자 및 세금계산서발행 섹션 -->
<section class="container mb-2">
    <div class="row">
        <div class="col col-md-7">
          <div class="row ml-0">
            <table>
              <tr>
                <td>
                  <select class="form-control form-control-sm" id="smsTitle" name="">
                    <option value="상용구없음">상용구없음</option>
                    <?php for ($i=0; $i < count($rowsms); $i++) {
                      echo "<option value='".$rowsms[$i]['title']."'>".$rowsms[$i]['title']."</option>";
                    } ?>
                  </select>
                </td>
                <td>
                  <button class="btn btn-sm btn-block btn-outline-primary" id="smsBtn" data-toggle="modal" data-target="#smsModal1"><i class="far fa-envelope"></i> 보내기</button>
                </td>
                <td>
                  <a href="/svc/service/sms/smsSetting.php">
                  <button class="btn btn-sm btn-block btn-dark mobile" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 상용구설정</button></a>
                </td>
                <td>
                  <a href="/svc/service/sms/sent.php">
                  <button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 보낸문자목록</button></a>
                </td>
                <td>
                  <button type="button" class="btn btn-info btn-sm" id="excelbtn"><i class="far fa-file-excel"></i>엑셀양식</button>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col col-md-5 mobile">
          <div class="row justify-content-end mr-0">
            <a href="contract_add2.php" role="button" class="btn btn-sm btn-primary mr-1">신규등록</a>
            <button type="button" class="btn btn-sm btn-danger mr-1" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="임대료 숫자 뒤 'c'표시된것만 삭제 가능합니다">선택삭제</button>
          </div>
        </div>
    </div>
    <div class="row justify-content-end mr-0 mobile">
        <label class="mb-0" style=""><span id="aa"></span></label><!--글자 기본&-->
    </div>
    <div class="row justify-content-end mr-0 mobile">
      <label class="mb-0" style="color:#007bff;"> 체크 : <span id="countchecked">0</span>건, 임대료 <span id="aa1">0</span>원, 보증금 <span id="bb1">0</span>원</label><!--글자 파란색-->
    </div>
</section>


<!-- 표내용 -->
<section class="row justify-content-center">
  <div class="col-10">
    <div class="mainTable">
      <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
        <thead>
          <tr class="table-secondary">
            <th class="fixedHeader">
              <input type="checkbox" id="allselect">
            </th>
            <th class="fixedHeader">순번</th>
            <th class="fixedHeader">상태</th>
            <th class="fixedHeader">입주자</th>
            <th class="fixedHeader">연락처</th>
            <th class="mobile fixedHeader">물건명</th>
            <th class="mobile fixedHeader">그룹명</th>
            <th class="fixedHeader">관리호수</th>
            <th class="mobile fixedHeader">시작일</th>
            <th class="mobile fixedHeader">종료일</th>
            <th class="mobile fixedHeader">기간</th>
            <th class="fixedHeader">임대료</th>
            <th class="mobile fixedHeader">보증금</th>
            <th class="mobile fixedHeader">
              <span class="badge badge-light">파일</span>
              <span class="badge badge-dark">메모</span>
            </th>
          </tr>
        </thead>
        <tbody id="allVals">

        </tbody>
      </table>
    </div>
  </div>

</section>

<!-- 페이지 -->
<section class="container mt-2" id="page">

</section>

<!-- <section class="container" id="sql">

</section> -->

<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/service/customer/modal_customer.php";

include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms1.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms2.php";
 ?>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/jquery-ui-timepicker-addon.js"></script>
<script src="/svc/inc/js/autosize.min.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_noneparase3.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_existparase10.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  var lease_type = <?php echo json_encode($_SESSION['lease_type']); ?>;
  var cellphone = <?php echo json_encode($_SESSION['cellphone']); ?>;
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  var smsSettingArray = <?php echo json_encode($rowsms); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript" src="js_sms_array_rcontract.js?<?=date('YmdHis')?>"></script>
<script type="text/javascript" src="j_checksum_c.js?<?=date('YmdHis')?>"></script>


<script>

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function sql(x,y){


  var getCid = getParameterByName('customerId');
  var getProgress = getParameterByName('progress');
  var getDateDiv = getParameterByName('dateDiv');

  if(getProgress==='pAll'){
    $('select[name=progress]').val('pAll').prop('selected', true);
  }

  if(getDateDiv==='endDate'){
    $('select[name=dateDiv]').val('endDate').prop('selected', true);
    $('select[name=periodDiv]').val('nownextMonth').prop('selected', true);
    $('select[name=progress]').val('pAll').prop('selected', true);
    $('input[name="fromDate"]').val(todayMonthFirst);
    $('input[name="toDate"]').val(nextMonthLast);
  }

  var form = $('form').serialize();

  var sql = $.ajax({
    url: 'ajax_realContractSql2.php',
    method: 'post',
    data: {'form' : form,
           'pagerow' : x,
           'getPage' : y,
           'customerId' : getCid
          },
    success: function(data){
      $('#sql').html(data);
    }
  })
  return sql;
}


function maketable(x,y){
  var getCid;

  var a = getParameterByName('customerId');
  var b = getParameterByName('progress');
  var c = getParameterByName('dateDiv');

  if(a!=''){
    getCid = a;
  }
  if(b==='pAll'){
    $('select[name=progress]').val('pAll').prop('selected', true);
  }

  if(c==='endDate'){
    $('select[name=dateDiv]').val('endDate').prop('selected', true);
    $('select[name=dateDiv]').attr('readonly', true);
    $('select[name=periodDiv]').val('nownextMonth').prop('selected', true);
    $('select[name=periodDiv]').attr('readonly', true);
    $('select[name=progress]').val('pAll').prop('selected', true);
    $('select[name=progress]').attr('readonly', true);
    $('input[name="fromDate"]').val(todayMonthFirst);
    $('input[name="fromDate"]').attr('readonly', true);
    $('input[name="toDate"]').val(nextMonthLast);
    $('input[name="toDate"]').attr('readonly', true);
    $('select[name=building]').attr('readonly', true);
    $('select[name=group]').attr('readonly', true);
    $('select[name=etcCondi]').attr('readonly', true);
    $('input[name="cText"]').attr('readonly', true);
  }

  var form = $('form').serialize();
  // console.log(form);

  var mtable = $.ajax({
    url: 'ajax_realContractLoad.php',
    method: 'post',
    data: {'form' : form,
           'pagerow' : x,
           'getPage' : y,
           'customerId' : getCid
          },
    success: function(data){
      data = JSON.parse(data);
      datacount = data.length;
      // console.log(datacount);

      var returns = '';
      var countall;
      var monthlyAmount = 0;
      var depositAmount = 0;

      // console.log(typeof(x), x);
      // console.log(typeof(y), y);

      if(datacount===0){
        returns ="<tr><td colspan='14'>조회값이 없어요. 조회조건을 다시 확인하거나 서둘러 입력해주세요!</td></tr>";
        countall = 0;
      } else {
        $.each(data, function(key, value){
          countall = value.count;
          var ordered = Number(value.num) - ((y-1)*x);
          returns += '<tr>';
          returns += '<td class=""><input type="checkbox" name="rid" value="'+value.rid+'" class="tbodycheckbox"></td>';
          returns += '<td class="" data-toggle="tooltip" data-placement="top" title="'+value.rid+'">'+ordered+'</td>';

          if(value.status2==='present'){
            returns += '<td class=""><div class="badge badge-info text-wrap" style="width: 3rem;">현재</div></td>';
          } if(value.status2==='waiting'){
            returns += '<td class=""><div class="badge badge-warning text-wrap" style="width: 3rem;">대기</div></td>';
          } if(value.status2==='the_end'){
            returns += '<td class=""><div class="badge badge-danger text-wrap" style="width: 3rem;">종료</div></td>';
          } if(value.status2==='middle_end'){
            returns += '<td class=""><div class="badge badge-danger text-wrap" style="width: 3rem;">중간종료</div></td>';
          }

          // returns += '<td class=""><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="tooltip" data-placement="top" title="'+value.ccnn+'" target="_blank">'+value.ccnnmb+'</a>';

          returns += '<td class=""><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="modal" data-target="#eachpop" class="eachpop">'+value.ccnnmb+'</a>';
          returns += '<input type="hidden" name="customername" value="'+value.cname+'">';
          returns += '<input type="hidden" name="customercompanyname" value="'+value.ccomname2+'">';
          returns += '<input type="hidden" name="email" value="'+value.email+'">';
          returns += '<input type="hidden" name="etc" value="'+value.etc+'">';
          returns += '<input type="hidden" name="customerId" value="'+value.cid+'">';

          returns += '<input type="hidden" name="companyname" value="'+value.ccomname+'">';
          returns += '<input type="hidden" name="div2" value="'+value.div2+'">';

          returns += '</td>';

          returns += '<td class=""><a href="tel:'+value.contact+'">'+value.contact+'</a>';

          returns += '</td>';
          returns += '<td class="mobile">'+value.bName+'</td>';
          returns += '<td class="mobile">'+value.gName+'</td>';
          returns += '<td class="">'+value.rName+'</td>';
          returns += '<td class="mobile">'+value.startDate+'</td>';
          returns += '<td class="mobile">'+value.endDate2+'</td>';
          returns += '<td class="mobile">'+value.count2+'</td>';
          returns += '<td class=""><a href="contractEdit.php?page=schedule&id='+value.rid+'" class="green">'+value.mtAmount+'</a>';

          returns += '<input type="hidden" name="mAmount" value="'+value.mAmount+'">';
          returns += '<input type="hidden" name="mvAmount" value="'+value.mvAmount+'">';

          if(value.step==='clear'){
            returns += '<div class="badge badge-warning text-light" style="width: 1rem;">c</div></td>';
          } else {
            returns += '</td>';
          }

          returns += '<td class="mobile"><a href="contractEdit.php?page=deposit&id='+value.rid+'" class="green">'+value.deposit+'</a></td>';

          returns += '<td class="mobile">';

          if(value.filecount > 0){
            returns += '<a href="contractEdit.php?page=file&id='+value.rid+'" class="badge badge-light">'+value.filecount+'</a>';
          }

          if(value.memocount > 0){
            returns += '<a href="contractEdit.php?page=memo&id='+value.rid+'" class="badge badge-dark">'+value.memocount+'</a>';
          }

          // returns += value.stepped + '</td>';
          returns += '</td>';
          returns += '</tr>';

          var pMonthlyAmount = value.mtAmount.replace(/,/gi,'');
          var pDepositAmount = value.deposit.replace(/,/gi,'');

          // monthlyAmount += Number(pMonthlyAmount);
          // depositAmount += Number(pDepositAmount);
          var monthlyAmount = value.amount1;
          var depositAmount = value.amount2;

        })
      }
      $('#allVals').html(returns);
      $('#countall').text(countall);
      $('#aa').text(monthlyAmount);
      $('#aa').number(true);
      $('#bb').text(depositAmount);
      $('#bb').number(true);

      var totalpage = Math.ceil(Number(countall)/Number(x));

      var totalpageArray = [];

      for (var i = 1; i <= totalpage; i++) {
        totalpageArray.push(i);
      }

      var paging = '<nav aria-label="..."><ul class="pagination pagination-sm justify-content-center">';

      for (var i = 1; i <= totalpageArray.length; i++) {
        paging += '<li class="page-item"><a class="page-link">'+i+'</a></li>';
      }

      paging += '</ul></nav>';

      $('#page').html(paging);
    }//success}
  })//ajax }

  return mtable;
}//function }

function makesum(x,y){
  var getCid;

  var a = getParameterByName('customerId');
  var b = getParameterByName('progress');
  var c = getParameterByName('dateDiv');

  if(a!=''){
    getCid = a;
  }
  if(b==='pAll'){
    $('select[name=progress]').val('pAll').prop('selected', true);
  }

  if(c==='endDate'){
    $('select[name=dateDiv]').val('endDate').prop('selected', true);
    $('select[name=periodDiv]').val('nownextMonth').prop('selected', true);
    $('select[name=progress]').val('pAll').prop('selected', true);
    $('input[name="fromDate"]').val(todayMonthFirst);
    $('input[name="toDate"]').val(nextMonthLast);
  }

  var form = $('form').serialize();

  var sumvalue = $.ajax({
    url: 'ajax_realContractLoad_sum.php',
    method: 'post',
    data: {'form' : form,
           'pagerow' : x,
           'getPage' : y,
           'customerId' : getCid
          },
    success: function(data){
      $('#aa').html(data);
    }
  })

  return sumvalue;
}

// $(document).on('blur', '[data-toggle="tooltip"]', function(){
//   $(this).tooltip();
// })

$('[data-toggle="tooltip"]').tooltip();

$(document).ready(function(){

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    var periodDiv = $('select[name=periodDiv]').val();
    dateinput2(periodDiv);

    var pagerow = 50;
    var getPage = 1;

    maketable(pagerow, getPage);
    sql(pagerow, getPage);
    makesum(pagerow, getPage);

    $('#href_smsSetting').on('click', function(){
      var moveCheck = confirm('문자상용구설정 화면으로 이동합니다. 이동하시겠습니까?');
      if(moveCheck){
        location.href='/svc/service/sms/smsSetting.php';
      }
    })


    $('.dateType').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      currentText: '오늘',
      closeText: '닫기'
    })

    $('.yyyymmdd').keydown(function (event) {
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

    $(document).on('click', '.page-link', function(){
      // $(this).parent('li').attr('class','active');
      var pagerow = 50;
      var getPage = $(this).text();
      // console.log(getPage);
      maketable(pagerow, getPage);
      makesum(pagerow, getPage);
      // sql(pagerow, getPage);
    })


})
//===========document.ready function end and the other load start!


$('select[name=dateDiv]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  // history.replaceState({}, null, location.pahtname);
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=periodDiv]').on('change', function(){
  // history.replaceState({}, null, location.pahtname);
  var pagerow = 50;
  var getPage = 1;
  var periodDiv = $('select[name=periodDiv]').val();
  // console.log(periodDiv);
  dateinput2(periodDiv);
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('input[name=fromDate]').on('change', function(){
  // history.replaceState({}, null, location.pahtname);이게 안되네 ㅠㅠ
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('input[name=toDate]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=progress]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=building]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=group]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=etcCondi]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})


$('input[name=cText]').on('keyup', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  makesum(pagerow, getPage);
  // sql(pagerow, getPage);
})
//---------조회버튼클릭평션 end and contractArray 펑션 시작--------------//

var contractArray = [];

$(document).on('change', '#allselect', function(){

    var allCnt = $(".tbodycheckbox", table).length;
    contractArray = [];

    if($("#allselect").is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var contractArrayEle = [];
        var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text().trim();
        var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
        var colStep = table.find("tr:eq("+i+")").find("td:eq(11)").children('div').text();
        var colFile = table.find("tr:eq("+i+")").find("td:eq(13)").children('a:eq(0)').text();
        var colMemo = table.find("tr:eq("+i+")").find("td:eq(13)").children('a:eq(1)').text();
        contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
        contractArray.push(contractArrayEle);
      }
    } else {
      contractArray = [];
    }
//   console.log(contractArray);
})

$(document).on('change', '.tbodycheckbox', function(){
    var contractArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = currow.find('td:eq(0)').children('input').val();
      var colStep = currow.find('td:eq(11)').children('div').text();
      var colFile = currow.find("td:eq(13)").children('a:eq(0)').text();
      var colMemo = currow.find("td:eq(13)").children('a:eq(1)').text();
      contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
      contractArray.push(contractArrayEle);
    } else {
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());

      for (var i = 0; i < contractArray.length; i++) {
        if(contractArray[i][0]===colOrder){
          var index = i;
          break;
        }
      }
      contractArray.splice(index, 1);
    }
    // console.log(contractArray);
    // console.log(typeof(contractArray[3]));
})



//---------contractArray펑션 end 삭제버튼펑션 시작--------------//
$('button[name="rowDeleteBtn"]').on('click', function(){
// console.log(contractArray);

if(contractArray.length === 0){
  alert('1개 이상을 선택하여 주세요.');
  return false;
}

for (var i = 0; i < contractArray.length; i++) {
  if(!(contractArray[i][2] === 'c')){
    alert("'c'표시된것만 삭제 가능합니다."+contractArray[i][0]+"행 확인하세요");
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

$('#excelbtn').on('click', function(){
  var a = $('form').serialize();

  goCategoryPage(a);

  function goCategoryPage(a){
    var frm = formCreate('exceldown', 'post', 'p_exceldown_contract.php','_blank');
    frm = formInput(frm, 'form', a);
    formSubmit(frm);
  }
})

$(document).on('click', '.eachpop', function(){

  var cid = $(this).siblings('input[name=customerId]').val();
  $.ajax({
    url: '../customer/ajax_customer.php',
    method: 'post',
    data: {'cid' : cid},
    success: function(data){
      data = JSON.parse(data);
      // console.log(data.name);
      $('input[name=id_m]').val(cid);
      $('input[name=name_m]').val(data.name);
      $('input[name=contact1_m]').val(data.contact1);
      $('input[name=contact2_m]').val(data.contact2);
      $('input[name=contact3_m]').val(data.contact3);
      $('input[name=companyname_m]').val(data.companyname);
      $('input[name=cNumber1_m]').val(data.cNumber1);
      $('input[name=cNumber2_m]').val(data.cNumber2);
      $('input[name=cNumber3_m]').val(data.cNumber3);
      $('input[name=email_m]').val(data.email);
      $('input[name=div4_m]').val(data.div4);
      $('input[name=div5_m]').val(data.div5);
      $('textarea[name=etc_m]').val(data.etc);
      $('span[name=id_m]').text(cid);
      $('span[name=created_m]').text(data.created);
      $('span[name=updated_m]').text(data.updated);

      if(data.div2==='개인'){
        $('option[name=kind1]').attr('selected',true);
      } else if(data.div2==='개인사업자'){
        $('option[name=kind2]').attr('selected',true);
      } else if(data.div2==='법인사업자'){
        $('option[name=kind3]').attr('selected',true);
      }

      if(data.div3==='주식회사'){
        $('option[name=a2]').attr('selected',true);
      } else if(data.div3==='유한회사'){
        $('option[name=a3]').attr('selected',true);
      } else if(data.div3==='합자회사'){
        $('option[name=a4]').attr('selected',true);
      } else if(data.div3==='기타'){
        $('option[name=a5]').attr('selected',true);
      } else {
        $('option[name=a1]').attr('selected',true);
      }
    }
  })//ajax}

})

autosize($('textarea[name=etc_m]'));


</script>

<script type="text/javascript" src="/svc/service/get/js_sms_tax.js?<?=date('YmdHis')?>">
</script>

</body>
</html>
