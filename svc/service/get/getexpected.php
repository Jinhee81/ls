<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>납부예정</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php";

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

<!-- 제목섹션 -->
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">납부예정 목록이에요.(#401)</h2>
    <p class="lead">

    </p>
  </div>
</section>

<!-- 조회조건 섹션 -->
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <form>
      <div class="row justify-content-md-center">
        <table>
          <tr>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="dateDiv">
                <option value="pExpectedDate">예정일자</option>
              </select><!--codi1-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="periodDiv">
                <option value="allDate">--</option>
                <option value="nowMonth">당월</option>
                <option value="pastMonth">전월</option>
                <option value="1pastMonth">1개월전</option>
                <option value="nowYear">당년</option>
              </select><!--시간구분-->
            </td>
            <td width="8%">
              <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType"><!--codi3-->
            </td>
            <td width="1%">~</td>
            <td width="8%">
              <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType"><!--codi4-->
            </td>
            <td width="7%">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!--건물-->
            </td>
            <td width="7%">
              <select class="form-control form-control-sm selectCall" name="group">
              </select><!--그룹-->
            </td>
            <td width="7%">
              <select class="form-control form-control-sm selectCall" name="etcCondi">
                <option value="customer">성명/사업자명</option>
                <option value="contact">연락처</option>
                <option value="contractId">계약번호</option>
                <option value="roomId">방번호</option>
              </select><!--codi8-->
            </td>
            <td width="12%">
              <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</section>

<!-- 문자 및 세금계산서발행 섹션 -->
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
              <a href="/svc/service/sms/smsSetting.php">
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
                <!-- <option value="현금영수증">현금영수증</option> 이건 지금당장 구축하는게 아니어서 주석처리, 곧 할거라서 코드는 냅둠-->
              </select>
            </div>
            <div class="col col-md-2 pl-0">
              <button type="button" class="btn btn-primary btn-sm btn-block" id="btnTaxDateInput">발행</button>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col col-md-6">
        <label class="mb-0" style=""> 전체 : <span id="ptAmountTotalCount">0</span>건, 공 <span id="pAmountTotalAmount">0</span>원, 세 <span id="pvAmountTotalAmount">0</span>원, 합 <span id="ptAmountTotalAmount">0</span>원</label><br><!--글자 기본&-->
        <label class="mb-0" style="color:#007bff;"> 체크 : <span id="ptAmountSelectCount">0</span>건, 공 <span id="pAmountSelectAmount">0</span>원, 세 <span id="pvAmountSelectAmount">0</span>원, 합 <span id="ptAmountSelectAmount">0</span>원</label><!--글자 파란색-->
      </div>
      <div class="col col-md-6">

      </div>
    </div>
</section>

<!-- 표 섹션 -->
<section class="container">
  <table class="table table-sm table-bordered table-hover text-center mt-2 table-sm" id="checkboxTestTbl">
    <thead>
      <tr class="table-secondary">
        <th scope="col"><input type="checkbox" id="allselect"></th>
        <th scope="col">순번</th>
        <th scope="col" class="mobile">그룹명</th>
        <th scope="col">방번호</th>
        <th scope="col">세입자</th>
        <th scope="col">연락처</th>
        <!-- <th scope="col">청구번호</th> -->
        <th scope="col" class="mobile">개월</th>
        <th scope="col" class="mobile">시작일/종료일</th>
        <!-- <th scope="col" class="mobile">종료일</th> -->
        <th scope="col">예정일</th>
        <th scope="col" class="mobile">공급가액/세액</th>
        <th scope="col">합계</th>
        <th scope="col" class="mobile">입금구분</th>
        <th scope="col" class="mobile">연체일수/이자</th>
        <!-- <th scope="col" class="mobile">연체이자</th> -->
        <th scope="col" class="mobile">증빙</th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>



<?php
include "modal_pay.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms1.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms2.php";
 ?>

 <?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/jquery-ui-timepicker-addon.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_noneparase3.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_existparase10.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms1.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>
<script type="text/javascript" src="jchecksum.js?<?=date('YmdHis')?>"></script>
<script type="text/javascript" src="jsmsarray.js?<?=date('YmdHis')?>"></script>

<script>

function maketable(){
  var mtable = $.ajax({
    url: 'ajax_getexpectedCondi-1.php',
    method: 'post',
    data: $('form').serialize(),
    success: function(data){
      data = JSON.parse(data);
      datacount = data.length;

      var returns = '';
      var totalpAmount = 0;
      var totalpvAmount = 0;
      var totalptAmount = 0;

      if(datacount===0){
        returns ="<tr><td colspan='14'>조회값이 없어요. 조회조건을 다시 확인하거나 서둘러 입력해주세요!</td></tr>";
      } else {
        $.each(data, function(key, value){
          returns += '<tr>';
          returns += '<td><input type="checkbox" value="'+value.idpaySchedule2+'" class="tbodycheckbox"></td>';
          returns += '<td>'+datacount+'</td>';
          returns += '<td>'+value.gname+'</td>';
          returns += '<td>'+value.roomname+'</td>';
          returns += '<td><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="tooltip" data-placement="top" title="'+value.cname+'">'+value.cnamemb+'</a>';
          returns += '<input type="hidden" name="cname" value="'+value.cname+'">';
          returns += '<input type="hidden" name="contact" value="'+value.contact+'">';
          returns += '<input type="hidden" name="email" value="'+value.email+'">';
          returns += '<input type="hidden" name="customer_id" value="'+value.cid+'">';
          returns += '<input type="hidden" name="name" value="'+value.ccname+'">';
          returns += '<input type="hidden" name="companynumber" value="'+value.companynumber+'">';
          returns += '<input type="hidden" name="companyname" value="'+value.companyname+'">';
          returns += '<input type="hidden" name="address" value="'+value.address+'">';
          returns += '<input type="hidden" name="div4" value="'+value.div4+'">';
          returns += '<input type="hidden" name="div5" value="'+value.div5+'">';
          returns += '</td>';
          returns += '<td>'+value.contact+'</td>';
          returns += '<td>'+value.monthCount+'</td>';
          returns += '<td><label class="mb-0">' + value.pStartDate+'</label><br>';
          returns += '<label class="mb-0">' + value.pEndDate+'</label></td>';
          returns += '<td><p class="modalAsk" data-toggle="modal" data-target="#pPay">'+value.pExpectedDate+'</p>';
          returns += '<input type="hidden" name="rid" value="'+value.rid+'">';
          returns += '<input type="hidden" name="payid" value="'+value.idpaySchedule2+'"></td>';
          returns += '<td class="text-right pr-3"><label class="mb-0">'+value.pAmount+'</label><br>';
          returns += '<label class="mb-0">'+value.pvAmount+'</label></td>';
          returns += '<td><a href="/svc/service/contract/contractEdit.php?id='+value.rid+'">'+value.ptAmount+'</a></td>';
          returns += '<td>'+value.payKind+'</td>';//입금구분
          returns += '<td><label class="mb-0">'+value.delaycount+'</label><br>';
          returns += '<label class="mb-0">' + value.delayinterest+'</label></td>';//연체일수,연체이자

          if(value.taxSelect==='세금계산서'){
            returns += '<td><span class="badge badge-warning text-light" style="width: 1.5rem;">세</span>'+value.taxDate+'</td>';
          } else if(value.taxSelect==='현금영수증'){
            returns += '<td><span class="badge badge-info text-light" style="width: 1.5rem;">현</span>'+value.taxDate+'</td>';
          } else {
            returns += '<td></td>';
          }

          returns += '</tr>';

          datacount -= 1;
          var pamount = value.pAmount.replace(/,/gi,'');
          var pvamount = value.pvAmount.replace(/,/gi,'');
          var ptamount = value.ptAmount.replace(/,/gi,'');
          totalpAmount += Number(pamount);
          totalpvAmount += Number(pvamount);
          totalptAmount += Number(ptamount);

        }) //$.each closing}
      } //if else closing}
      $('#allVals').html(returns);
      $('#ptAmountTotalCount').text(data.length);
      $('#pAmountTotalAmount').text(totalpAmount);
      $('#pAmountTotalAmount').number(true);
      $('#pvAmountTotalAmount').text(totalpvAmount);
      $('#pvAmountTotalAmount').number(true);
      $('#ptAmountTotalAmount').text(totalptAmount);
      $('#ptAmountTotalAmount').number(true);
  }//ajax success closing}

})//ajax closing }

return mtable;

}//function maketable closing}


$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    var periodDiv = $('select[name=periodDiv]').val();
    dateinput2(periodDiv);

    maketable();

    $('.dateType').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      currentText: '오늘',
      closeText: '닫기'
    })

    $(".numberComma").number(true);

    $('#href_smsSetting').on('click', function(){
      var moveCheck = confirm('문자상용구설정 화면으로 이동합니다. 이동하시겠습니까?');
      if(moveCheck){
        location.href='/service/sms/smsSetting.php';
      }
    })

    $(document).on('click', '.modalAsk', function(){ //청구번호클릭하는거(모달클릭)

      var currow2 = $(this).closest('tr');
      var payid = currow2.find('td:eq(8)').children('input:eq(1)').val();
      // console.log(payNumber);
      var rid = currow2.find('td:eq(8)').children('input:eq(0)').val();

      var payamount = currow2.find('td:eq(10)').children('a').text();
      var paykind = currow2.find('td:eq(11)').text();
      var pExpectedDate = $(this).text();

      console.log(payid, payamount, paykind, pExpectedDate);

      $('.payid').html(payid);
      $('input[name=modalpaydate]').val(pExpectedDate);
      $('input[name=modalexecutivedate]').val(pExpectedDate);
      $('input[name=modalpayamount]').val(payamount);
      $('input[name=modalexecutiveamount]').val(payamount);

      if(paykind==='계좌'){
        $('option[name=kind1]').attr('selected',true);
      } else if(paykind==='현금'){
        $('option[name=kind2]').attr('selected',true);
      } else if(paykind==='카드'){
        $('option[name=kind3]').attr('selected',true);
      }


      $('.getExecute').on('click', function(){ //입금완료버튼(모달안버튼) 클릭

        var aa1 = 'payScheduleInput';
        var bb1 = 'p_payScheduleGetAmountInput2.php';


        var ppayKind = $('#payKind').val(); //입금구분

        var pgetDate = $('input[name=modalexecutivedate]').val(); //입금일

        var pgetAmount = $('input[name=modalexecutiveamount]').val(); //입금액

        var pExpectedAmount = $('input[name=modalpayamount]').val(); //예정금액

        // console.log(pExpectedAmount);

        if(pgetAmount != pExpectedAmount){
          alert('입금액과 예정금액은 같아야 합니다.');
          return false;
        }

        goCategoryPage(aa1, bb1, payid, ppayKind, pgetDate, pgetAmount, rid);

        function goCategoryPage(a, b, c, d, e, f, g){
          var frm = formCreate(a, 'post', b,'');
          frm = formInput(frm, 'realContract_id', g);
          frm = formInput(frm, 'payid', c);
          frm = formInput(frm, 'paykind', d);
          frm = formInput(frm, 'pgetdate', e);
          frm = formInput(frm, 'pgetAmount', f);
          formSubmit(frm);
        }
      })


      $('.getExecuteBack').on('click', function(){ //청구취소(삭제)버튼(모달안버튼) 클릭
        var aa1 = 'payScheduleDrop';
        var bb1 = '/svc/service/contract/p_payScheduleDrop.php';

        // console.log(pid, contractId);

        goCategoryPage(aa1, bb1, rid, payid);

        function goCategoryPage(a, b, c, d){
          var frm = formCreate(a, 'post', b,'');
          frm = formInput(frm, 'realContract_id', c);
          frm = formInput(frm, 'payid', d);
          formSubmit(frm);
        }

      })

    })


})//---------document.ready function end & 각종 조회 펑션 시작--------------//
$('select[name=dateDiv]').on('change', function(){
    maketable();
})

$('select[name=periodDiv]').on('change', function(){
  var periodDiv = $('select[name=periodDiv]').val();
  // console.log(periodDiv);
  dateinput2(periodDiv);
  maketable();
})

$('input[name=fromDate]').on('change', function(){
    maketable();
})

$('input[name=toDate]').on('change', function(){
    maketable();
})

$('select[name=building]').on('change', function(){
    maketable();
})

$('select[name=group]').on('change', function(){
    maketable();
})

$('select[name=etcCondi]').on('change', function(){
    maketable();
})

$('input[name=cText]').on('keyup', function(){
    maketable();
})

//---------조회버튼클릭평션 end and 증빙일자 펑션 시작--------------//


$('#btnTaxDateInput').on('click', function(){
  var taxDate = $('input[name="taxDate"]').val();
  var taxSelect = $('select[name="taxSelect"]').val(); //세금계산서인지 현금영수증인지 구분
  var taxDiv = 'charge'; //입금예정리스트여서 청구라는 뜻의 charge 사용, 입금완료리스트에서는 영수라는 뜻의 accept 사용 예정

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

//---------증빙일자펑션 end 문자보내기펑션시 시작--------------//

//---------문자보내기펑션시 끝 & 체크박스클래스추가 시작 --------------//

//---------체크박스클래스 끝--------------//


</script>

</body>
</html>
