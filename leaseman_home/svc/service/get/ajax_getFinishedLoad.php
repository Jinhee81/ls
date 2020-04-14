<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

// error_reporting(E_ALL);

// ini_set("display_errors", 1);

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include "ajax_getFinishedCondi.php";

?>
<table class="table table-hover text-center mt-2 table-sm" id="checkboxTestTbl">
  <thead>
    <tr class="table-info">
      <th scope="col"><input type="checkbox"></th>
      <th scope="col">순번</th>
      <!-- <th scope="col" class="mobile">청구번호</th> -->
      <th scope="col">입금일</th>
      <th scope="col" class="mobile">공급가액</th>
      <!-- <th scope="col"></th> -->
      <th scope="col" class="mobile">세액</th>
      <th scope="col" class="">합계</th>
      <th scope="col" class="mobile">입금구분</th>
      <th scope="col">세입자</th>
      <th scope="col" class="mobile">계약(상품)</th>
      <th scope="col" class="mobile">증빙</th>
    </tr>
  </thead>
<?php if(count($allRows)===0){
  echo "<tr><td colspan='10'>조회값이 없습니다.</td></tr>";
  } else {
    $j = count($allRows);
    for ($i=0; $i < count($allRows); $i++) {
      ?>
      <tr>
        <td><input type="checkbox" value="<?=$allRows[$i]['idpaySchedule2']?>"></td>
        <td><?=$j?></td><!--순번-->
        <!--<td class="mobile"><?=$allRows[$i]['idpaySchedule2']?></td>--><!--청구번호-->
        <td>
          <p style="color:#F7819F;" class="mb-0">
            <?=$allRows[$i]['executiveDate']?>
          </p>
          <input type="hidden" name="pStartDate" value="<?=$allRows[$i]['pStartDate']?>">
          <input type="hidden" name="pEndDate" value="<?=$allRows[$i]['pEndDate']?>">
          <input type="hidden" name="monthCount" value="<?=$allRows[$i]['monthCount']?>">
          <input type="hidden" name="invoicerMgtKey" id="invoicerMgtKey" value="<?=$allRows[$i]['invoicerMgtKey']?>">
        </td><!--입금일-->
        <td class="mobile">
          <label class="numberComma mb-0">
            <?=$allRows[$i]['pAmount']?>
          </label>
        </td><!--공급가액-->
        <td class="mobile">
          <label class="numberComma mb-0">
            <?=$allRows[$i]['pvAmount']?>
          </label>
        </td><!--세액-->
        <td>
          <?php if($allRows[$i]['roomdiv']==='방계약'){
            echo "<a href='/svc/service/contract/contractEdit3.php?id=".$allRows[$i][1]."' style='color:
          #04B486'>";} else if($allRows[$i]['roomdiv']==='기타계약'){
            echo "<a href='/svc/service/contractetc/contractetc_edit.php?id=".$allRows[$i][1]."' style='color:
          #04B486'>";}
          ?>
            <label class="numberComma mb-0">
              <?=$allRows[$i]['ptAmount']?>
            </label>
          </a>
        </td><!--합계-->
        <td class="mobile">
            <?=$allRows[$i]['payKind']?>
        </td><!--입금구분-->
        <td>
          <a href="/svc/service/customer/m_c_edit.php?id=<?=$allRows[$i]['customer_id']?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['cname'].', '.$allRows[$i]['contact']?>">
          <?=iconv_substr($allRows[$i]['cname'].', '.$allRows[$i]['contact'],0,5, "utf-8")?>
          </a>
          <input type="hidden" name="cname" value="<?=$allRows[$i]['cname']?>">
          <input type="hidden" name="contact" value="<?=$allRows[$i]['contact']?>">
          <input type="hidden" name="email" value="<?=$allRows[$i]['email']?>">
          <input type="hidden" name="customer_id" id="customer_id" value="<?=$allRows[$i]['customer_id']?>">
          <input type="hidden" name="name" value="<?=$allRows[$i]['name']?>">
          <input type="hidden" name="companynumber" value="<?=$allRows[$i]['companynumber']?>">
          <input type="hidden" name="companyname" value="<?=$allRows[$i]['companyname']?>">
          <input type="hidden" name="address" value="<?=$allRows[$i]['address']?>">
          <input type="hidden" name="div4" value="<?=$allRows[$i]['div4']?>">
          <input type="hidden" name="div5" value="<?=$allRows[$i]['div5']?>">
        </td><!--세입자-->
        <td class="mobile">
          <?php if($allRows[$i]['roomdiv']==='방계약'){
            echo $allRows[$i]['roomdiv']."(".$allRows[$i]['gName'].",".$allRows[$i]['rName'].")";
          } elseif ($allRows[$i]['roomdiv']==='기타계약') {
            echo $allRows[$i]['roomdiv']."(".$allRows[$i]['gName'].")";
          }?>
          <input type="hidden" name="roomdiv" value="<?=$allRows[$i]['roomdiv']?>">
          <input type="hidden" name="group" value="<?=$allRows[$i]['gName']?>">
          <input type="hidden" name="rName" value="<?=$allRows[$i]['rName']?>">
        </td><!--방번호-->
        <td class="mobile">
          <?php
          $idx = $allRows[$i]['customer_id'];
          $invoicerMgtKey = $allRows[$i]['invoicerMgtKey'];
            if($allRows[$i]['taxSelect']==='세금계산서' && $allRows[$i]['invoicerMgtKey']!= null){
              echo "<div onclick=taxInfo($idx,'$invoicerMgtKey')><div class='badge badge-warning text-light' style='width: 1.5rem;'>
              세</div> <label class='mb-0'>".$allRows[$i]['taxDate']."</label></div>";
            } elseif($allRows[$i]['taxSelect']==='현금영수증'){
              echo "<div class='badge badge-info text-light' style='width: 1.5rem;'>
              현</div> <label class='mb-0'>".$allRows[$i]['taxDate']."</label>";
            }
           ?>
        </td><!--증빙일자-->
      </tr>
    <?php
    $j = $j-1; //순번을 내림차순으로 하기위해서 이거가 필요함
  } ?>
  <tr class="table-secondary">
    <td colspan="3">Total</td>
    <td><label class="numberComma mb-0"><?=$amountTotalArray[0]?></label></td>
    <td><label class="numberComma mb-0"><?=$amountTotalArray[1]?></label></td>
    <td><label class="numberComma mb-1"><?=$amountTotalArray[2]?></label></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
<?php } ?>


<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(".numberComma").number(true);

var table = $("#checkboxTestTbl");

// 테이블 헤더에 있는 checkbox 클릭시
$(":checkbox:first", table).change(function(){
  if($(":checkbox:first", table).is(":checked")){
    $(":checkbox", table).prop('checked',true);
    $(":checkbox").parent().parent().addClass("selected");
  } else {
    $(":checkbox", table).prop('checked',false);
    $(":checkbox").parent().parent().removeClass("selected");
  }
})

// 헤더에 있는 체크박스외 다른 체크박스 클릭시
$(":checkbox:not(:first)", table).change(function(){
  var allCnt = $(":checkbox:not(:first)", table).length;
  var checkedCnt = $(":checkbox:not(:first)", table).filter(":checked").length;

  if($(this).prop("checked")==true){
    $(this).parent().parent().addClass("selected");
  } else {
    $(this).parent().parent().removeClass("selected");
  }

  if( allCnt==checkedCnt ){
    $(":checkbox:first", table).prop("checked", true);
  }
})



var AmountArray = [];
var amountMoney = [0,0,0];
$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  amountMoney = [0,0,0];
  // console.log(allCnt);

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var colpAmount = table.find("tr:eq("+i+")").find("td:eq(3)").children('label').text();
      var colpvAmount = table.find("tr:eq("+i+")").find("td:eq(4)").children('label').text();
      var colptAmount = table.find("tr:eq("+i+")").find("td:eq(5)").children('a').children('label').text();
      // console.log(colptAmount);
      colpAmount = colpAmount.replace(/,/gi,'');
      colpvAmount = colpvAmount.replace(/,/gi,'');
      colptAmount = colptAmount.replace(/,/gi,'');
      colpAmount = Number(colpAmount);
      colpvAmount = Number(colpvAmount);
      colptAmount = Number(colptAmount);
      amountMoney[0] += colpAmount;
      amountMoney[1] += colpvAmount;
      amountMoney[2] += colptAmount;
    }
    $('#ptAmountSelectCount').html(allCnt);
    $('#pAmountSelectAmount').html(amountMoney[0]);
    $('#pAmountSelectAmount').number(true);
    $('#pvAmountSelectAmount').html(amountMoney[1]);
    $('#pvAmountSelectAmount').number(true);
    $('#ptAmountSelectAmount').html(amountMoney[2]);
    $('#ptAmountSelectAmount').number(true);
    // console.log('solmi');

  } else {
    AmountArray = [];
    amountMoney = [0,0,0];
    $('#ptAmountSelectCount').html(AmountArray.length);
    $('#pAmountSelectAmount').html(amountMoney[0]);
    $('#pvAmountSelectAmount').html(amountMoney[1]);
    $('#ptAmountSelectAmount').html(amountMoney[2]);
  }

  // console.log('solmi');
  // console.log(ptAmountArray);
})

$(":checkbox:not(:first)",table).click(function(){
    var AmountArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colid = currow.find('td:eq(0)').children('input').val();
      var colpAmount = currow.find("td:eq(3)").children('label').text();
      var colpvAmount = currow.find("td:eq(4)").children('label').text();
      var colptAmount = currow.find("td:eq(5)").children('a').children('label').text();
      colpAmount = colpAmount.replace(/,/gi,'');
      colpAmount = Number(colpAmount);
      colpvAmount = colpvAmount.replace(/,/gi,'');
      colpvAmount = Number(colpvAmount);
      colptAmount = colptAmount.replace(/,/gi,'');
      colptAmount = Number(colptAmount);
      AmountArrayEle.push(colid, colpAmount, colpvAmount, colptAmount);
      AmountArray.push(AmountArrayEle);
      amountMoney[0] += colpAmount;
      amountMoney[1] += colpvAmount;
      amountMoney[2] += colptAmount;

      $('#ptAmountSelectCount').html(AmountArray.length);
      $('#pAmountSelectAmount').html(amountMoney[0]);
      $('#pAmountSelectAmount').number(true);
      $('#pvAmountSelectAmount').html(amountMoney[1]);
      $('#pvAmountSelectAmount').number(true);
      $('#ptAmountSelectAmount').html(amountMoney[2]);
      $('#ptAmountSelectAmount').number(true);
      // console.log(ptAmountArray);
    } else {
      var currow = $(this).closest('tr');
      var colid = currow.find('td:eq(0)').children('input').val();
      var colpAmount = currow.find("td:eq(3)").children('label').text();
      var colpvAmount = currow.find("td:eq(4)").children('label').text();
      var colptAmount = currow.find("td:eq(5)").children('a').children('label').text();
      colpAmount = colpAmount.replace(/,/gi,'');
      colpAmount = Number(colpAmount);
      colpvAmount = colpvAmount.replace(/,/gi,'');
      colpvAmount = Number(colpvAmount);
      colptAmount = colptAmount.replace(/,/gi,'');
      colptAmount = Number(colptAmount);
      var dropReady = AmountArrayEle.push(colid, colpAmount, colpvAmount, colptAmount);
      var index = AmountArray.indexOf(dropReady);
      AmountArray.splice(index, 1);
      amountMoney[0] -= colpAmount;
      amountMoney[1] -= colpvAmount;
      amountMoney[2] -= colptAmount;

      $('#ptAmountSelectCount').html(AmountArray.length);
      $('#pAmountSelectAmount').html(amountMoney[0]);
      $('#pAmountSelectAmount').number(true);
      $('#pvAmountSelectAmount').html(amountMoney[1]);
      $('#pvAmountSelectAmount').number(true);
      $('#ptAmountSelectAmount').html(amountMoney[2]);
      $('#ptAmountSelectAmount').number(true);
      // console.log(ptAmountArray);
    }
})
//======================================================smsReadyArray start
var smsReadyArray = [];

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  smsReadyArray = [];

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var smsReadyArrayEle = [];
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());
      var colgroup = table.find("tr:eq("+i+")").find("td:eq(8)").children('input:eq(1)').val();
      var colroom = table.find("tr:eq("+i+")").find("td:eq(8)").children('input:eq(2)').val();
      var colcustomerName = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(0)').val();
      var colcustomerContact = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(1)').val();
      var colcustomerEmail = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(2)').val();
      var colcustomerId = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(3)').val();
      var colexecutiveDate = table.find("tr:eq("+i+")").find("td:eq(2)").children().text();
      var coltaxDate = table.find("tr:eq("+i+")").find("td:eq(9)").children('label').text();
      var colamount1 = table.find("tr:eq("+i+")").find("td:eq(3)").children().text();
      var colamount2 = table.find("tr:eq("+i+")").find("td:eq(4)").children().text();
      var colamount3 = table.find("tr:eq("+i+")").find("td:eq(5)").children().children().text();

      // console.log(colOrder, colid, colgroup, colroom, colcustomerName, colcustomerContact, colexectutiveDate, coltaxDate, colamount1, colamount2,colamount3);

      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'상품':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId});
      smsReadyArray.push(smsReadyArrayEle);

    }
  } else {
    smsReadyArray = [];
  }
  // console.log(smsReadyArray);
})

$(":checkbox:not(:first)",table).click(function(){
var smsReadyArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var colgroup = currow.find("td:eq(8)").children('input:eq(1)').val();
      var colroom = currow.find("td:eq(8)").children('input:eq(2)').val();
      var colcustomerName = currow.find("td:eq(7)").children('input:eq(0)').val();
      var colcustomerContact = currow.find("td:eq(7)").children('input:eq(1)').val();
      var colcustomerEmail = currow.find("td:eq(7)").children('input:eq(2)').val();
      var colcustomerId = currow.find("td:eq(7)").children('input:eq(3)').val();
      var colexecutiveDate = currow.find("td:eq(2)").children().text();
      var coltaxDate = currow.find("td:eq(9)").children('label').text();
      var colamount1 = currow.find("td:eq(3)").children().text();
      var colamount2 = currow.find("td:eq(4)").children().text();
      var colamount3 = currow.find("td:eq(5)").children().children().text();
      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'상품':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId});
      smsReadyArray.push(smsReadyArrayEle);
      // console.log('smsReadyArray :',smsReadyArray);
    } else {
      var dropReady = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var colgroup = currow.find("td:eq(8)").children('input:eq(1)').val();
      var colroom = currow.find("td:eq(8)").children('input:eq(2)').val();
      var colcustomerName = currow.find("td:eq(7)").children('input:eq(0)').val();
      var colcustomerContact = currow.find("td:eq(7)").children('input:eq(1)').val();
      var colcustomerEmail = currow.find("td:eq(7)").children('input:eq(2)').val();
      var colcustomerId = currow.find("td:eq(7)").children('input:eq(3)').val();
      var colexecutiveDate = currow.find("td:eq(2)").children().text();
      var coltaxDate = currow.find("td:eq(9)").children('label').text();
      var colamount1 = currow.find("td:eq(3)").children().text();
      var colamount2 = currow.find("td:eq(4)").children().text();
      var colamount3 = currow.find("td:eq(5)").children().children().text();
      dropReady.push({'순번':colOrder}, {'청구번호':colid}, {'상품':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId});

      for (var i = 0; i < smsReadyArray.length; i++) {
        var join1 = smsReadyArray[i].join(',');
        var join2 = dropReady.join(',');

        if(join1===join2){
          var index = i;
        }
      }

      smsReadyArray.splice(index, 1);
      // console.log(index);
      // console.log(smsReadyArray);
    }

// console.log(smsReadyArray);
})

// console.log(smsReadyArray.length);
//=================================================smsReadyArray end, taxArray start

var taxArray = [];

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  taxArray = [];

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var taxArrayEle = [];
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());//순번
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());//청구번호

      Number(table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(3)').val());//세입자번호
      var companynumber = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(5)').val();//사업자번호
      var companyname = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(6)').val();//사업자명
      var name = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(4)').val();//성명
      var address = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(7)').val();//주소
      var div4 = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(8)').val();//업태
      var div5 = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(9)').val();//종목
      var contact = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(1)').val();//연락처
      var email = table.find("tr:eq("+i+")").find("td:eq(7)").children('input:eq(2)').val();//이메일
      var supplyamount = table.find("tr:eq("+i+")").find("td:eq(3)").children().text();//공급가액
      var vatamount = table.find("tr:eq("+i+")").find("td:eq(4)").children().text();//세액
      var totalamount = table.find("tr:eq("+i+")").find("td:eq(5)").children().children().text();//합계
      var startdate = table.find("tr:eq("+i+")").find("td:eq(2)").children('input:eq(0)').val();//청구시작일
      var enddate = table.find("tr:eq("+i+")").find("td:eq(2)").children('input:eq(1)').val();//청구종료일
      var monthcount = table.find("tr:eq("+i+")").find("td:eq(2)").children('input:eq(2)').val();//청구개월
      var contractDiv = table.find("tr:eq("+i+")").find("td:eq(8)").children('input:eq(0)').val();//계약구분,방계약인지기타계약인지

      var comment;//비고

      if(contractDiv==='방계약'){
        comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
      }

      var acceptdiv = table.find("tr:eq("+i+")").find("td:eq(6)").text().trim();//입금구분
      var evidencedate = table.find("tr:eq("+i+")").find("td:eq(9)").children('label').text();//증빙일자

      taxArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'사업자번호':companynumber}, {'사업자명':companyname}, {'성명':name}, {'주소':address}, {'업태':div4}, {'종목':div5}, {'연락처':contact}, {'이메일':email}, {'공급가액':supplyamount}, {'세액':vatamount}, {'합계':totalamount}, {'비고':comment}, {'입금구분':acceptdiv}, {'증빙일자':evidencedate});

      taxArray.push(taxArrayEle);

    }
  } else {
    taxArray = [];
  }
  console.log(taxArray);
})

$(":checkbox:not(:first)",table).click(function(){
var taxArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());//청구번호

      Number(currow.find("td:eq(7)").children('input:eq(3)').val());//세입자번호
      var companynumber = currow.find("td:eq(7)").children('input:eq(5)').val();//사업자번호
      var companyname = currow.find("td:eq(7)").children('input:eq(6)').val();//사업자명
      var name = currow.find("td:eq(7)").children('input:eq(4)').val();//성명
      var address = currow.find("td:eq(7)").children('input:eq(7)').val();//주소
      var div4 = currow.find("td:eq(7)").children('input:eq(8)').val();//업태
      var div5 = currow.find("td:eq(7)").children('input:eq(9)').val();//종목
      var contact = currow.find("td:eq(7)").children('input:eq(1)').val();//연락처
      var email = currow.find("td:eq(7)").children('input:eq(2)').val();//이메일
      var supplyamount = currow.find("td:eq(3)").children().text();//공급가액
      var vatamount = currow.find("td:eq(4)").children().text();//세액
      var totalamount = currow.find("td:eq(5)").children().children().text();//합계
      var startdate = currow.find("td:eq(2)").children('input:eq(0)').val();//청구시작일
      var enddate = currow.find("td:eq(2)").children('input:eq(1)').val();//청구종료일
      var monthcount = currow.find("td:eq(2)").children('input:eq(2)').val();//청구개월
      var contractDiv = currow.find("td:eq(8)").children('input:eq(0)').val();//계약구분,방계약인지기타계약인지

      var comment;//비고

      if(contractDiv==='방계약'){
        comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
      }

      var acceptdiv = currow.find("td:eq(6)").text().trim();//입금구분
      var evidencedate = currow.find("td:eq(9)").children('label').text();//증빙일자

      taxArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'사업자번호':companynumber}, {'사업자명':companyname}, {'성명':name}, {'주소':address}, {'업태':div4}, {'종목':div5}, {'연락처':contact}, {'이메일':email}, {'공급가액':supplyamount}, {'세액':vatamount}, {'합계':totalamount}, {'비고':comment}, {'입금구분':acceptdiv}, {'증빙일자':evidencedate});

      taxArray.push(taxArrayEle);

    } else {
      var dropReady = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());

      Number(currow.find("td:eq(7)").children('input:eq(3)').val());//세입자번호
      var companynumber = currow.find("td:eq(7)").children('input:eq(5)').val();//사업자번호
      var companyname = currow.find("td:eq(7)").children('input:eq(6)').val();//사업자명
      var name = currow.find("td:eq(7)").children('input:eq(4)').val();//성명
      var address = currow.find("td:eq(7)").children('input:eq(7)').val();//주소
      var div4 = currow.find("td:eq(7)").children('input:eq(8)').val();//업태
      var div5 = currow.find("td:eq(7)").children('input:eq(9)').val();//종목
      var contact = currow.find("td:eq(7)").children('input:eq(1)').val();//연락처
      var email = currow.find("td:eq(7)").children('input:eq(2)').val();//이메일
      var supplyamount = currow.find("td:eq(3)").children().text();//공급가액
      var vatamount = currow.find("td:eq(4)").children().text();//세액
      var totalamount = currow.find("td:eq(5)").children().children().text();//합계
      var startdate = currow.find("td:eq(2)").children('input:eq(0)').val();//청구시작일
      var enddate = currow.find("td:eq(2)").children('input:eq(1)').val();//청구종료일
      var monthcount = currow.find("td:eq(2)").children('input:eq(2)').val();//청구개월
      var contractDiv = currow.find("td:eq(8)").children('input:eq(0)').val();//계약구분,방계약인지기타계약인지

      var comment;//비고

      if(contractDiv==='방계약'){
        comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
      }

      var acceptdiv = currow.find("td:eq(6)").text().trim();//입금구분
      var evidencedate = currow.find("td:eq(9)").children('label').text();//증빙일자

      dropReady.push({'순번':colOrder}, {'청구번호':colid}, {'사업자번호':companynumber}, {'사업자명':companyname}, {'성명':name}, {'주소':address}, {'업태':div4}, {'종목':div5}, {'연락처':contact}, {'이메일':email}, {'공급가액':supplyamount}, {'세액':vatamount}, {'합계':totalamount}, {'비고':comment}, {'입금구분':acceptdiv}, {'증빙일자':evidencedate});

      for (var i = 0; i < taxArray.length; i++) {
        var join1 = taxArray[i].join(',');
        var join2 = dropReady.join(',');

        if(join1===join2){
          var index = i;
        }
      }

      taxArray.splice(index, 1);

    }
console.log(taxArray);
})
