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
          screen='납부예정화면'";
// echo $sql_sms;

$result_sms = mysqli_query($conn, $sql_sms);
$rowsms = array();
while($row_sms = mysqli_fetch_array($result_sms)){
  $rowsms[] = $row_sms;
}

// print_r($rowsms);
?>

<!-- 제목섹션 -->
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">납부예정 목록이에요.(#401)</h2>
    <p class="warningg">
      <i class="fas fa-exclamation-circle"></i> 문자메시지 발송후 반드시 보낸문자목록에서 확인하세요. 가끔 발송이 안되는 경우가 있어요(상대방 전화해지, 또는 해외 출국 등 사유)
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
                <option value="groupAll">그룹전체</option>
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
                  <a href="/svc/service/sms/smsSetting.php" target="_blank">
                  <button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 상용구설정</button></a>
                </td>
                <td>
                  <a href="/svc/service/sms/sent.php" target="_blank">
                  <button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 보낸문자목록</button></a>
                </td>
                <td><button class="btn btn-sm btn-block btn-danger" name="button1" data-toggle="tooltip" data-placement="top" title="작업중입니다^^;">청구취소</button></td>
                <td><button class="btn btn-sm btn-block btn-warning" name="button2" data-toggle="tooltip" data-placement="top" title="작업중입니다^^;">납부처리</button></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col col-md-5">
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

    <div class="row justify-content-end mr-0 mobile">
        <label class="mb-0" style=""> 전체 : <span id="ptAmountTotalCount">0</span>건, 공 <span id="pAmountTotalAmount">0</span>원, 세 <span id="pvAmountTotalAmount">0</span>원, 합 <span id="ptAmountTotalAmount">0</span>원</label><!--글자 기본&-->
    </div>
    <div class="row justify-content-end mr-0 mobile">
      <label class="mb-0" style="color:#007bff;"> 체크 : <span id="ptAmountSelectCount">0</span>건, 공 <span id="pAmountSelectAmount">0</span>원, 세 <span id="pvAmountSelectAmount">0</span>원, 합 <span id="ptAmountSelectAmount">0</span>원</label><!--글자 파란색-->
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
        <th scope="col" class="mobile">개월</th>
        <th scope="col" class="mobile">시작일/종료일</th>
        <th scope="col">예정일</th>
        <th scope="col" class="mobile">공급가액/세액</th>
        <th scope="col">합계</th>
        <th scope="col" class="mobile">구분</th>
        <th scope="col" class="mobile">연체일수/이자</th>
        <th scope="col" class="mobile">증빙</th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>

<!-- sql 섹션 -->
<section id="allVals2">
</section>


<?php
include "modal_pay.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms1.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms2.php";
 ?>

 <?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/jquery-ui-timepicker-addon.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_noneparase3.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_existparase10.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  var smsSettingArray = <?php echo json_encode($rowsms); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);

</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>
<script type="text/javascript" src="j_checksum.js?<?=date('YmdHis')?>"></script>
<script type="text/javascript" src="j_sms_array.js?<?=date('YmdHis')?>"></script>
<script type="text/javascript" src="j_taxarray.js?<?=date('YmdHis')?>"></script>

<script>
var taxDiv = 'charge'; //입금예정리스트여서 청구라는 뜻의 charge 사용, 입금완료리스트에서는 영수라는 뜻의 accept 사용 예정

function maketable(){
  var mtable = $.ajax({
    url: 'ajax_getexpectedCondi_value.php',
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
          returns += '<td class="mobile">'+value.gname+'</td>';
          returns += '<td>'+value.roomname+'</td>';
          returns += '<td><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="tooltip" data-placement="top" title="'+value.cname+'" class="cnameclass">'+value.cnamemb+'</a>';
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
          returns += '<td class="mobile">'+value.monthCount+'</td>';
          returns += '<td class="mobile"><label class="mb-0">' + value.pStartDate+'</label><br>';
          returns += '<label class="mb-0">' + value.pEndDate+'</label></td>';
          returns += '<td><p class="modalAsk" data-toggle="modal" data-target="#pPay">'+value.pExpectedDate+'</p>';
          returns += '<input type="hidden" name="rid" value="'+value.rid+'">';
          returns += '<input type="hidden" name="payid" value="'+value.idpaySchedule2+'"></td>';
          returns += '<td class="text-right pr-3 mobile"><label class="mb-0">'+value.pAmount+'</label><br>';
          returns += '<label class="mb-0">'+value.pvAmount+'</label></td>';
          returns += '<td><a href="/svc/service/contract/contractEdit.php?id='+value.rid+'" name="ptamount" data-toggle="tooltip" data-placement="top" title="계약상세보기">'+value.ptAmount+'</a></td>';
          returns += '<td class="mobile">'+value.payKind+'</td>';//입금구분
          returns += '<td class="mobile"><label class="mb-0">'+value.delaycount+'</label><br>';
          returns += '<label class="mb-0">' + value.delayinterest+'</label></td>';//연체일수,연체이자

          if(value.taxSelect==='세금계산서'){
            returns += '<td class="mobile"><span class="badge badge-warning text-light" style="width: 1.5rem;">세</span>'+value.taxDate+'</td>';
          } else if(value.taxSelect==='현금영수증'){
            returns += '<td class="mobile"><span class="badge badge-info text-light" style="width: 1.5rem;">현</span>'+value.taxDate+'</td>';
          } else {
            returns += '<td class="mobile"></td>';
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

  // $(document).on('blur', '.cnameclass', function(){
  //   $(this).tooltip({
  //     sanitizeFn: function (content) {
  //     return DOMPurify.sanitize(content)
  //     }
  //   });
  // })
  //
  // $(document).on('blur', 'a[name=ptamount]', function(){
  //   $(this).tooltip('show');
  // })

  // $('#button1').tooltip('show');
  // $('#button2').tooltip('show');

    // $('a[name=cname]').tooltip('show');
    // $('a[name=ptamount]').tooltip('show');

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
        location.href='/svc/service/sms/smsSetting.php';
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


      $('.getExecute').on('click', function(){ //납부완료버튼(모달안버튼) 클릭

        var aa1 = 'payScheduleInput';
        var bb1 = '/svc/service/contract/p_payScheduleGetAmountInput.php';


        var ppayKind = $('#payKind').val(); //납부구분

        var pgetDate = $('input[name=modalexecutivedate]').val(); //납부일

        var pgetAmount = $('input[name=modalexecutiveamount]').val(); //납부액

        var pExpectedAmount = $('input[name=modalpayamount]').val(); //예정금액

        // console.log(pExpectedAmount);

        if(pgetAmount != pExpectedAmount){
          alert('납부액과 예정금액은 같아야 합니다.');
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
    var buildingkey = $('select[name=building]').val();
    // console.log(buildingkey);

    //문자발송에 필요한 번호
    var sendphonenumber = buildingArray[buildingkey][3] + buildingArray[buildingkey][4] + buildingArray[buildingkey][5];


    $('input[name=sendphonenumber]').val(sendphonenumber);

    $('input[name=sendphonenumber]').val(sendphonenumber);
    maketable();
})

$('select[name=group]').on('change', function(){
    maketable();
})

$('select[name=etcCondi]').on('change', function(){
    maketable();

    // $.ajax({
    //     url: 'ajax_getexpectedCondi_sql2.php',
    //     method: 'post',
    //     data: $('form').serialize(),
    //     success: function(data){
    //       $('#allVals2').html(data);
    //     }
    // })
})

$('input[name=cText]').on('keyup', function(){
    maketable();

    // $.ajax({
    //     url: 'ajax_getexpectedCondi_sql2.php',
    //     method: 'post',
    //     data: $('form').serialize(),
    //     success: function(data){
    //       $('#allVals2').html(data);
    //     }
    // })
})
</script>

<script type="text/javascript" src="js_sms_tax.js?<?=date('YmdHis')?>">
</script>

</body>
</html>
