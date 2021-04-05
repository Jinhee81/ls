
var tbl = $("table[name=tableAmount]");
var expectedDayArray = [];

$('#allselect2').click(function(){

    var allCnt = $(":checkbox:not(:first)", tbl).length;
    var table = tbl.find('tbody');
    expectedDayArray = [];


    if($(this).is(":checked")){
      for (var i = 0; i < allCnt; i++) {
        var expectedDayEle = [];
        var rowid = i;//system order
        var colOrder = table.find("tr[name=contractRow]:eq("+i+")").find("td[name=order]").children('span[name=ordered]').text();//order
        var colid = table.find("tr[name=contractRow]:eq("+i+")").find("td[name=checkbox]").children('input[name=csId]').val();//csId
        var colexpectDate = table.find("tr[name=contractRow]:eq("+i+")").find("td[name=detail]").find('input[name=mExpectedDate]').val();

        expectedDayEle.push(rowid, colOrder, colid, colexpectDate);
        expectedDayArray.push(expectedDayEle);
      }
      // console.log(expectedDayArray);
    } else {
      expectedDayArray = [];
      // console.log(expectedDayArray);
    }
    console.log(expectedDayArray);
})

// $('.table').on('click',$(':checkbox:not(:first).is(":checked")'),function()

$(document).on('click', '.tbodycheckbox2', function(){

  var expectedDayEle = [];

  if($(this).is(":checked")){
    var currow = $(this).closest('tr');
    var rowid = currow.find('td[name=order]').children('input[name=rowid]').val();
    rowid = Number(rowid);
    var colOrder = currow.find('td[name=order]').children('span[name=ordered]').text();
    var colid = currow.find('td[name=checkbox]').children('input[name=csId]').val();
    var colexpectDate = currow.find('td[name=detail]').find('input[name=mExpectedDate]').val();
    expectedDayEle.push(rowid, colOrder, colid, colexpectDate);
    expectedDayArray.push(expectedDayEle);
    // console.log(expectedDayArray);
  } else {
    var currow = $(this).closest('tr');
    var colOrder = currow.find('td[name=order]').children('span[name=ordered]').text();

    for (var i = 0; i < expectedDayArray.length; i++) {
      if(expectedDayArray[i][1]===colOrder){
        var index = i;
        break;
      }
    }

    expectedDayArray.splice(index, 1);
  }
  // console.log(expectedDayArray);
})


$(document).on('click', '.contractEdit', function(){
  var cid = $(this).siblings('.contractNumber').text();
//   console.log(cid);
  window.open('about:blank').location.href='contractEdit6.php?id='+cid;
})

$('#button7').click(function(){ //삭제버튼 클릭시
  let contractId = $('.contractNumber:eq(0)').text();
  let buildingId = $('#buildingId_m').val();  
  var contractScheduleArray = [];
  var allCnt = $(":checkbox:not(:first)", tbl).length;
  var table = tbl.find('tbody');
  // console.log(allCnt, expectedDayArray.length);
  // console.log(expectedDayArray);

  if(expectedDayArray.length===0){
    alert('한개 이상을 선택해야 삭제 가능합니다.');
    return false;
  }

  for (var i = 0; i < expectedDayArray.length; i++) {

    contractScheduleArray[i] = [];

    var csId = table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=checkbox]').children('input[name=csId]').val();

    var csOrder = table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=order]').children('span[name=ordered]').text();

    var psId = table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=checkbox]').children('input[name=payId]').val();

    if(psId != 'null'){
      alert('청구번호는 '+psId+' 입니다. 청구번호가 존재하면 삭제할수 없습니다.');
      return false;
    }

    contractScheduleArray[i].push(csId, csOrder, psId);
  }
  // console.log(contractScheduleArray);

  var selectedOrderArray = [];
  for (var i = 0; i < expectedDayArray.length; i++) {
    selectedOrderArray.push(Number(expectedDayArray[i][1]));
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

  if(!selectedOrderArray.includes(allCnt)){
    console.log(selectedOrderArray);
    console.log(allCnt);
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
  }

  var contractScheduleIdArray = [];
  for (var i = 0; i < contractScheduleArray.length; i++) {
    contractScheduleIdArray.push(contractScheduleArray[i][0]);
  }

  contractScheduleIdArray = JSON.stringify(contractScheduleIdArray);

  // console.log(contractScheduleIdArray);

  let url = '/svc/service/contract/process/pp_contractScheduleDrop.php';

  amountlist2(contractId, contractScheduleIdArray, url);

}) //삭제버튼 클릭시

$(document).on('click', '#button5', function(){ //1개월추가 버튼클릭
  let contractId = $('.contractNumber:eq(0)').text();
  let buildingId = $('#buildingId_m').val();
  let allCnt = $(":checkbox:not(:first)", tbl).length;
  let url = '/svc/service/contract/process/pp_contractScheduleAppend.php';

//   console.log(allCnt, contractId, url);

  if(allCnt===72){
    alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
    return false;
  }

  amountlist(contractId, url);

}); //1개월추가 버튼


$('#button6').click(function(){ //n개월추가 버튼, 모달클릭으로 바뀜
  let contractId = $('.contractNumber:eq(0)').text();
  let buildingId = $('#buildingId_m').val();

  let mAmount = $(this).parents('div.modal-body').siblings('div.modal-header').find('#mAmount_m').val();
  let mvAmount = $(this).parents('div.modal-body').siblings('div.modal-header').find('#mvAmount_m').val();
  let mtAmount = $(this).parents('div.modal-body').siblings('div.modal-header').find('#mtAmount_m').val();
  let payOrder = $(this).parents('div.modal-body').siblings('div.modal-header').find('#payOrder_m').val();
  let lastDate = $(this).parents('div.row').siblings('div.mainTable').find('tr:eq(1)').find('span[name=mEndDate]').text();

  lastDate2 = new Date(lastDate);
  let nextDate = new Date(lastDate2.getFullYear(), lastDate2.getMonth(), lastDate2.getDate()+1);
  let oneMonthLater = new Date(nextDate.getFullYear(), nextDate.getMonth()+1, nextDate.getDate()-1);
  let oneMonthLater1 = new Date(oneMonthLater.getFullYear(), oneMonthLater.getMonth(), oneMonthLater.getDate()+1);

  nextDate = nextDate.getFullYear() + '-' + (nextDate.getMonth()+1) + '-' + nextDate.getDate();

  oneMonthLater = oneMonthLater.getFullYear() + '-' + (oneMonthLater.getMonth()+1) + '-' + oneMonthLater.getDate();

  oneMonthLater1 = oneMonthLater1.getFullYear() + '-' + (oneMonthLater1.getMonth()+1) + '-' + oneMonthLater1.getDate();

  // console.log(nextDate, oneMonthLater, oneMonthLater1);


  $("input[name='modalAmount1']").val(mAmount);
  $("input[name='modalAmount2']").val(mvAmount);
  $("input[name='modalAmount3']").val(mtAmount);

  if(payOrder==='선납'){
    $("#mpExpectedDate2").val(lastDate);
    $("#mexecutiveDate2").val(lastDate);
  } else {
    $("#mpExpectedDate2").val(oneMonthLater1);
    $("#mexecutiveDate2").val(oneMonthLater1);
  }

  $('input[name=addMonth]').on('keyup', function(){
    var monthCount = Number($(this).val());
    var mtAmount = $("input[name='modalAmount3']").val();
    mtAmount = parseInt(mtAmount.replace(",", ""));
    var executiveAmount = monthCount * mtAmount;
    
    executiveAmount = executiveAmount.toLocaleString();
  
    // console.log(monthCount, executiveAmount);
  
    $('#mexecutiveAmount2').val(executiveAmount);
  })

  $("input[name='modalAmount1']").on('keyup', function(){
    var changeAmount1 = Number($(this).val());
    var changeAmount2 = Number($("input[name='modalAmount2']").val());
    var changeAmount3 = changeAmount1 + changeAmount2;
    var monthCount = Number($('input[name=addMonth]').val());
    var executiveAmount = monthCount * changeAmount3;

    $("input[name='modalAmount3']").val(changeAmount3);
    $('#mexecutiveAmount2').val(executiveAmount);
  });
    
  $("input[name='modalAmount2']").on('keyup', function(){
    var changeAmount2 = Number($(this).val());
    var changeAmount1 = Number($("input[name='modalAmount1']").val());
    var changeAmount3 = changeAmount1 + changeAmount2;
    var monthCount = Number($('input[name=addMonth]').val());
    var executiveAmount = monthCount * changeAmount3;
    $("input[name='modalAmount3']").val(changeAmount3);
    $('#mexecutiveAmount2').val(executiveAmount);
  });
    //
    

  $('#buttonm3').on('click', function(){//추가하기 버튼
    let allCnt = $(":checkbox:not(:first)", tbl).length;
    let addMonth = Number($("input[name='addMonth']").val());
    let mAmount = $("input[name='modalAmount1']").val();
    let mvAmount = $("input[name='modalAmount2']").val();
    let mtAmount = $("input[name='modalAmount3']").val();
    

    if(!addMonth){
        alert('추가개월수가 비어있습니다. 개월수를 입력해야 합니다.');
        return false;
    }

    if(Number(addMonth)+allCnt > 72){
        alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
        return false;
    }

    let url = '/svc/service/contract/process/pp_contractScheduleAppendM.php';

    amountlist3(contractId, url, addMonth, mAmount, mvAmount, mtAmount);

    $('#nAddBtn').modal('hide');

  })//1.추가하기



  $('#buttonm2').on('click', function(){//청구설정 버튼
    let allCnt = $(":checkbox:not(:first)", tbl).length;
    let addMonth = Number($("input[name='addMonth']").val());
    let mAmount = $("input[name='modalAmount1']").val();
    let mvAmount = $("input[name='modalAmount2']").val();
    let mtAmount = $("input[name='modalAmount3']").val();
    var expectedDate = $('#mpExpectedDate2').val();
    var payKind = $('#executiveDiv2').val();
    

    if(!addMonth){
        alert('추가개월수가 비어있습니다. 개월수를 입력해야 합니다.');
        return false;
    }

    if(Number(addMonth)+allCnt > 72){
        alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
        return false;
    }

    let url = '/svc/service/contract/process/pp_payScheduleAdd2.php';

    // console.log(contractId, url, addMonth, mAmount, mvAmount, mtAmount, expectedDate, payKind, buildingId);

    amountlist4(contractId, url, addMonth, mAmount, mvAmount, mtAmount, expectedDate, payKind, buildingId);

    $('#nAddBtn').modal('hide');

  })//2.청구설정

  $('#buttonm1').on('click', function(){//입금완료 버튼
    let allCnt = $(":checkbox:not(:first)", tbl).length;
    let addMonth = Number($("input[name='addMonth']").val());
    let mAmount = $("input[name='modalAmount1']").val();
    let mvAmount = $("input[name='modalAmount2']").val();
    let mtAmount = $("input[name='modalAmount3']").val();
    var expectedDate = $('#mpExpectedDate2').val();
    var payKind = $('#executiveDiv2').val();
    var executiveDate = $('#mexecutiveDate2').val();
    var executiveAmount = $('#mexecutiveAmount2').val();

    if(!addMonth){
        alert('추가개월수가 비어있습니다. 개월수를 입력해야 합니다.');
        return false;
    }

    if(Number(addMonth)+allCnt > 72){
        alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
        return false;
    }

    if(!(expectedDate && executiveDate)){
        alert('입금예정일 또는 입금완료일을 둘다 넣어주거나 아니면 둘다 넣지 않아야 합니다. 둘 중 한개만 넣으면 처리되지 않습니다.');
        return false;
    }

    let url = '/svc/service/contract/process/pp_payScheduleGetAmountInputFor2.php';

    // console.log(contractId, url, addMonth, mAmount, mvAmount, mtAmount, expectedDate, payKind, buildingId, executiveDate, executiveAmount);

    amountlist5(contractId, url, addMonth, mAmount, mvAmount, mtAmount, expectedDate, payKind, buildingId, executiveDate, executiveAmount);

    $('#nAddBtn').modal('hide');

  })//3.입금완료

}); //n개월추가버튼누를때

$(document).on('click', '.modalpay', function(){ //청구번호클릭하는거(모달클릭)
  var currow2 = $(this).closest('tr');
  var payNumber = $(this).text();
  var filtered_id = $(this).parents('div.modal-body').siblings('div.modal-header').find('span.contractNumber:eq(0)').text();//계약번호
  var expectedAmount = $(this).parent().siblings('input[name=ptAmount]').val();
  var expectedDate = $(this).parent().siblings('input[name=pExpectedDate]').val();
  var executiveDiv = $(this).parent().siblings('input[name=payKind]').val();//입금구분
  var executiveDate = $(this).parent().siblings('input[name=executiveDate]').val();
  var executiveAmount = $(this).parent().siblings('input[name=getAmount]').val();
  var payDiv = $(this).parent().siblings('span[name=payDiv]').text();
  var taxMun = $(this).parent().siblings('input[name=taxMun]').val();
  // alert(taxMun);

  // console.log(filtered_id, payNumber, expectedAmount, expectedDate, executiveDiv, executiveDate, executiveAmount, payDiv, taxMun);

  var footer1 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button><button type='button' id='mpayBack' class='btn btn-warning btn-sm mr-0'>청구취소</button><button type='button' id='mgetExecute' class='btn btn-primary btn-sm'>입금완료</button>";//입금대기이고 증빙이 없을때
  var footer11 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button><button type='button' id='mpayBack' class='btn btn-warning btn-sm mr-0' disabled>청구취소</button><button type='button' id='mgetExecute' class='btn btn-primary btn-sm'>입금완료</button>";//입금대기이고 증빙있을때
  var footer2 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button><button type='button' id='mModify' class='btn btn-warning btn-sm mr-0'>수정</button><button type='button' id='mExecuteBack' class='btn btn-warning btn-sm mr-0'>입금취소</button>";//입금완료이고 증빙일자 없을때
  var footer22 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button><button type='button' id='mExecuteBack' class='btn btn-warning btn-sm mr-0' disabled>입금취소</button>";//입금완료이고 증빙일자 있을때

  // console.log(expectedAmount, expectedDate, executiveDiv, executiveDate, executiveAmount);

  $('#payId').text(payNumber);
  $('#expectedAmount').val(expectedAmount);
  $('#expectedDate').val(expectedDate);
  if(executiveDiv==='계좌'){
    $('#executiveDiv').val('계좌').prop('selected', true);
  } else if(executiveDiv==='현금'){
    $('#executiveDiv').val('현금').prop('selected', true);
  } else if(executiveDiv==='카드'){
    $('#executiveDiv').val('카드').prop('selected', true);
  }

  if(payDiv==='완납' || payDiv==='완납(연체)'){

    $('#expectedDate').val(expectedDate).prop('disabled', true);
    $('#expectedAmount').val(expectedAmount).prop('disabled', true);
    // $('#executiveDiv').val(executiveDiv).prop('disabled', true);
    // $('#executiveDate').val(executiveDate).prop('disabled', true);
    $('#executiveAmount').val(expectedAmount).prop('disabled', true);//하다보니 입금수단과 입금일은 좀 수정을 하고싶어짐
    $('#executiveDiv').val(executiveDiv);
    $('#executiveDate').val(executiveDate);
    if(taxMun){
      $('#modalfooter11').html(footer22);
    } else {
      $('#modalfooter11').html(footer2);
    }
  } else if(payDiv==='입금대기' || payDiv==='미납'){
    $('#executiveDiv').prop('disabled', false);
    $('#executiveDate').val(expectedDate).prop('disabled', false);
    $('#executiveAmount').val(expectedAmount).prop('disabled', false);
    if(taxMun){
      $('#modalfooter11').html(footer11);
    } else {
      $('#modalfooter11').html(footer1);
    }
  }

  $('#mModify').on('click', function(){ //수정버튼(모달안버튼) 클릭

    var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호
    let contractId = $('.contractNumber:eq(0)').text();
    var payDiv2 = $('#executiveDiv').val(); //입금수단, 계좌/현금/카드
    var executiveDate2 = $('#executiveDate').val(); //입금금액
    let url = '/svc/service/contract/process/pp_payScheduleGetAmountModify.php';

    if(executiveDiv===payDiv2 && executiveDate===executiveDate2){
        alert('수정내역이 없습니다.');
        // $('#pPay').modal('hide');
        return false;
    }
  
    amountlist22(pid, payDiv2, executiveDate2, contractId, url);
    alert('수정했습니다.');
    $('#pPay').modal('hide');
  })

}) //청구번호클릭하는거(모달클릭) closing}

    
// $(document).on('click', 'u.taxDate', function(){
//     let conrfirm = ('전체화면에서 확인r')
// })

function taxInfo2(bid,mun,ccid) {
    var tmps = "<iframe name='ifm_pops_21' id='ifm_pops_21' class='popup_iframe'   scrolling='no' src=''></iframe>";
    // $("body").append(tmps);
    $('#modal_amount').prepend(tmps);
    //alert( "/inc/tax_invoice2.php?chkId="+chkId+"&callnum="+subIdx );

    $("#ifm_pops_21").attr("src","/svc/service/get/tax_invoice.php?building_idx="+bid+"&mun="+mun+"&id="+ccid+"&flag=expected");
    $('#ifm_pops_21').show();
    $('.pops_wrap, .pops_21').show();

}

$(document).on('click', 'u.taxDate', function(){
    var mun = $(this).parents().siblings('input[name=taxMun]').val();
    var bid = $(this).parents('div.modal-body').siblings('div.modal-header').find('#buildingId_m').val();
    var cid = $(this).parents('div.modal-body').siblings('div.modal-header').find('#customerId_m').val();

    // console.log(mun, bid, cid);

    taxInfo2(bid, mun, cid);
})

$(document).on('change', '#groupExpecteDay', function(){ //입금예정일 변경버튼 이벤트
  var expectedDayGroup = $('#groupExpecteDay').val();
  var table = tbl.find('tbody');

  if(expectedDayArray.length >= 1) {
    for (var i in expectedDayArray) {
       table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find("td[name=detail]").find('input[name=mExpectedDate]').val(expectedDayGroup);
      // console.log(expectedDayArray[i][0], a);
    }
  } else {
    alert('변경해야할 행이 없습니다.');
  }
})

$(document).on('keydown', '#groupExpecteDay', function(event){
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

 $(document).on('change', '#paykind', function(){ //입금수단 변경버튼 이벤트
  var a = $(this).val();
  var table = tbl.find('tbody');

  if(expectedDayArray.length >= 1) {
    for (var i in expectedDayArray) {
       table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find("td[name=detail]").find('select[name=payKind]').val(a).prop('selected', true);
      // console.log(expectedDayArray[i][0], a);
    }
  }
})

$(document).on('click', '#button1', function(){ //청구설정버튼 클릭시
  var paykind = $('#paykind option:selected').text();
  let contractId = $('.contractNumber:eq(0)').text();
  let buildingId = $('#buildingId_m').val();


  expectedDayArray = expectedDayArray.sort(function(a,b){
    return a[0] - b[0];
  })//순번대로 정렬함(오름차순), 이거 중요함, 그런데 이거하고나니 엄청 느려짐 ㅠㅠ

  var contractScheduleArray = [];

  for (var i = 0; i < expectedDayArray.length; i++) {
    var table = tbl.find('tbody');
    var payId = table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=checkbox]').children('input[name=payId]').val(); //청구번호

    // console.log(payId);
    if(!(payId==='null')){
      alert('청구번호가 존재하여, 청구설정을 못합니다. 다시 확인해주세요.');
      return false;
    }

    // table.find("tr:eq("+expectedDayArray[i][0]+")").find("td:eq(7)").text(paykind);이게 왜있지? 20.11.12
    // console.log(expectedDayArray[i][0], a);
    // 입금구분을 변경시키는 것
    var contractScheduleEle = [];
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=checkbox]').children('input[name=csId]').val()); //계약번호
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=order]').children('span[name=ordered]').text()); //순번
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=date]').find('span[name=mStartDate]').text()); //시작일
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=date]').find('span[name=mEndDate]').text()); //종료일
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mAmount]').val()); //공급가액
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mvAmount]').val()); //세액
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mtAmount]').val()); //합계금액
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mExpectedDate]').val()); //예정일
    contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('select[name=payKind]').val()); //입금구분

    contractScheduleArray.push(contractScheduleEle);
  }
  // console.log(contractSchedule);

  contractScheduleArray = JSON.stringify(contractScheduleArray);

  if(expectedDayArray.length === 0){
    alert('한개 이상을 선택해야 청구가 됩니다.');
    return false;
  } else if (expectedDayArray.length <= 120) {

    let url = '/svc/service/contract/process/pp_payScheduleAdd.php';
    // console.log(contractId, buildingId,contractScheduleArray, url);
    amountlist21(contractId, buildingId,contractScheduleArray, url);

  } else {
    alert('계약기간은 120개월, 10년으로 제안됩니다. 그 이상인경우 새로운 계약을 생성해주세요.');
    return false;
  }

})

$(document).on('click', '#mpayBack', function(){ //청구취소버튼(모달안버튼) 클릭

  let contractId = $('.contractNumber:eq(0)').text();
  let buildingId = $('#buildingId_m').val();
  var payId = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호

  // console.log(pid, contractId);

  let url = '/svc/service/contract/process/pp_payScheduleDrop.php';

  amountlist20(contractId, payId, url);
  $('#pPay').modal('hide');
})

$(document).on('click', '#mgetExecute', function(){ //입금완료버튼(모달안버튼) 클릭

  // console.log('solmi');
  let contractId = $('.contractNumber:eq(0)').text();

  var pExpectedDate = $('#expectedDate').val(); //입금예정일

  var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호

  var ppayKind = $(this).parent().prev().children().children(':eq(2)').children(':eq(1)').children().val(); //입금구분

  var pgetDate = $(this).parent().prev().children().children(':eq(3)').children(':eq(1)').children().val(); //입금일

  var pgetAmount = $(this).parent().prev().children().children(':eq(4)').children(':eq(1)').children().val(); //입금액

  var pExpectedAmount = $(this).parent().prev().children().children(':eq(0)').children(':eq(1)').children().val(); //예정금액

  let url = '/svc/service/contract/process/pp_payScheduleGetAmountInput.php';

  // console.log(pid, ppayKind, pgetDate, pgetAmount, pExpectedDate);

  if(pgetAmount != pExpectedAmount){
    alert('입금액과 예정금액은 같아야 합니다.');
    return false;
  }

  amountlist31(contractId, pid, ppayKind, pgetDate, pgetAmount, pExpectedDate, url);

  $('#pPay').modal('hide');
})

//=======================
$(document).on('click', '#mExecuteBack', function(){ //입금취소버튼(모달안버튼) 클릭
  
  let contractId = $('.contractNumber:eq(0)').text();
  var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호
  let url = '/svc/service/contract/process/pp_payScheduleGetAmountCansel.php';

  // console.log(pid, contractId);

  amountlist20(contractId, pid, url);
  $('#pPay').modal('hide');
})

$(document).on('click', '#buttonDirect', function(){
    var paykind = $('#paykind option:selected').text();
    var table = tbl.find('tbody');
    let contractId = $('.contractNumber:eq(0)').text();
    let buildingId = $('#buildingId_m').val();
  
    if(expectedDayArray.length === 0){
      alert('한개 이상을 선택해야 즉시입금 가능합니다.');
      return false;
    }
  
    expectedDayArray = expectedDayArray.sort(function(a,b){
      return a[0] - b[0];
    })//순번대로 정렬함(오름차순), 이거 중요함, 그런데 이거하고나니 엄청 느려짐 ㅠㅠ
  
    var contractSchedule = [];
  
    for (var i = 0; i < expectedDayArray.length; i++) {
      var psId = table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=checkbox]').children('input[name=payId]').val(); //청구번호
      if(psId != 'null'){
        alert('청구번호가 있는경우 즉시입금이 불가합니다. 청구번호없는 아무것도 없는 상태에서 청구와 입금처리가 동시에 되는거에요.');
        return false;
      }
  
      // table.find("tr:eq("+expectedDayArray[i][0]+")").find("td:eq(7)").text(paykind);이게왜있나??
      // console.log(expectedDayArray[i][0], a);
      // 입금구분을 변경시키는 것
      var contractScheduleEle = [];
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=checkbox]').children('input[name=csId]').val()); //계약번호
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=order]').children('span[name=ordered]').text()); //순번
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=date]').find('span[name=mStartDate]').text()); //시작일
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=date]').find('span[name=mEndDate]').text()); //종료일
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mAmount]').val()); //공급가액
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mvAmount]').val()); //세액
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mtAmount]').val()); //합계금액
      contractScheduleEle.push(table.find("tr[name=contractRow]:eq("+expectedDayArray[i][0]+")").find('td[name=detail]').find('input[name=mExpectedDate]').val()); //예정일
  
      contractSchedule.push(contractScheduleEle);
    }
  
    // console.log(contractSchedule);
  
    var contractSchedule11 = JSON.stringify(contractSchedule);
    let url = '/svc/service/contract/process/pp_payScheduleGetAmountInputFor.php';
  
    amountlist23(contractSchedule11, contractId, buildingId, paykind, url);
  
})

//========================

$(document).on('keyup', "input[name='depositInAmount']", function(){
    var depositInAmount = Number($(this).val());
    var depositOutAmount = Number($("input[name='depositOutAmount']").val());
    var depositMoney = depositInAmount - depositOutAmount;
    $("input[name='depositMoney']").val(depositMoney);
});

$(document).on('keyup', "input[name='depositOutAmount']", function(){
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

    let contractId = $('.contractNumber:eq(0)').text();
    var aa = 'depositSave';
    let url = '/svc/service/contract/process/pp_depositSave.php';

    amountlist32(contractId,depositInDate,depositInAmount,depositOutDate,depositOutAmount,depositMoney, url);

    alert('저장했습니다.');

})

$(document).on('click', 'input[name=depositInAmount]', function(){
   $(this).select();
})

$(document).on('click', 'input[name=depositOutAmount]', function(){
    $(this).select();
 })

//===================================
$(document).on('click', '#memoButton', function(){
    var memoInputer = $('#memoInputer').val();
    var memoContent = $('#memoContent').val();

    if(!memoContent){
        alert('내용을 입력해야 합니다.');
        return false;
    }
    // console.log(memoInputer, memoContent);

    var url = '/svc/service/contract/process/pp_memoAppend.php';
    let contractId = $('.contractNumber:eq(0)').text();

    memoInput(contractId,memoInputer,memoContent, url);

});

$(document).on('click', 'label[name=memoEdit]', function(){
    let contractId = $('.contractNumber:eq(0)').text();
    var memoid = $(this).parent().parent().find('td:eq(0)').children('input[name=memoid]').val();
    var memoCreator = $(this).parent().parent().find('td:eq(1)').children('input').val();
    var memoContent = $(this).parent().parent().children().children('textarea').val();
    // console.log(memoid, memoCreator, memoContent);
    var url = '/svc/service/contract/process/pp_memoEdit.php';

    // console.log(contractId,memoid,memoCreator,memoContent,url);

    memoEdit(contractId,memoid,memoCreator,memoContent,url);
    alert('수정했습니다.');
});


$(document).on('click', 'label[name=memoDelete]', function(){

  var c = confirm('정말 삭제하시겠습니까?');

  if(c){
    var memoid = $(this).parent().parent().children().children('input:eq(0)').val();
    let contractId = $('.contractNumber:eq(0)').text();
    var url = '/svc/service/contract/process/pp_memoDelete.php';

    memoDelete(contractId,memoid,url);
  }

});
//=============================

$(document).on('click', 'button[name=fileDelete]', function(){
  var fileid = $(this).parent().parent().children().children('input:eq(0)').val();

  let contractId = $('.contractNumber:eq(0)').text();
  let url = '/svc/service/contract/process/pp_fileDelete.php';

  console.log(url, contractId, fileid);
  deletefile(url, contractId, fileid);
})

