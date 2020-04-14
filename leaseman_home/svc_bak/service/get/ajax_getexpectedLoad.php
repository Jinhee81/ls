<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
// print_r($_SESSION);
// print_r($_POST);
include "ajax_getexpectedCondi.php";

?>
<table class="table table-hover text-center mt-2 table-sm" id="checkboxTestTbl">
  <thead>
    <tr class="table-info">
      <th scope="col"><input type="checkbox"></th>
      <th scope="col">순번</th>
      <th scope="col" class="mobile">그룹명</th>
      <th scope="col">방번호</th>
      <th scope="col">세입자</th>
      <!-- <th scope="col">청구번호</th> -->
      <th scope="col" class="mobile">개월</th>
      <th scope="col" class="mobile">시작일/종료일</th>
      <!-- <th scope="col" class="mobile">종료일</th> -->
      <th scope="col">예정일</th>
      <th scope="col" class="mobile">공급가액</th>
      <th scope="col" class="mobile">세액</th>
      <th scope="col">합계</th>
      <th scope="col" class="mobile">입금구분</th>
      <th scope="col" class="mobile">연체일수/이자</th>
      <!-- <th scope="col" class="mobile">연체이자</th> -->
      <th scope="col" class="mobile">증빙</th>
    </tr>
  </thead>

<?php
  if(count($allRows)===0){
    echo "<tr><td colspan='14'>조회값이 없습니다.</td></tr>";
  } else { ?>
    <?php
    $j = count($allRows);
    for ($i=0; $i < count($allRows); $i++) {?>
      <tr>
        <td><input type="checkbox" value="<?=$allRows[$i]['idpaySchedule2']?>"></td>
        <td><?=$j?></td><!--순번-->
        <td class="mobile"><?=$allRows[$i]['gName']?></td><!--그룹명-->
        <td><?=$allRows[$i]['rName']?></td><!--방번호-->
        <td>
          <a href="/svc/service/customer/m_c_edit.php?id=<?=$allRows[$i]['customer_id']?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['cname'].', '.$allRows[$i]['contact']?>">
            <?=mb_substr($allRows[$i]['cname'].', '.$allRows[$i]['contact'],0,5)?>
          </a>
          <input type="hidden" name="cname" value="<?=$allRows[$i]['cname']?>">
          <input type="hidden" name="contact" value="<?=$allRows[$i]['contact']?>">
          <input type="hidden" name="email" value="<?=$allRows[$i]['email']?>">
          <input type="hidden" name="customer_id" value="<?=$allRows[$i]['customer_id']?>">
          <input type="hidden" name="name" value="<?=$allRows[$i]['name']?>">
          <input type="hidden" name="companynumber" value="<?=$allRows[$i]['companynumber']?>">
          <input type="hidden" name="companyname" value="<?=$allRows[$i]['companyname']?>">
          <input type="hidden" name="address" value="<?=$allRows[$i]['address']?>">
          <input type="hidden" name="div4" value="<?=$allRows[$i]['div4']?>">
          <input type="hidden" name="div5" value="<?=$allRows[$i]['div5']?>">
        </td><!--세입자-->
        <!-- <td>
          <p class='text-primary modalAsk font-weight-light' data-toggle='modal' data-target='#pPay'>
            <u><?=$allRows[$i]['idpaySchedule2']?></u>
          </p>

        </td> -->
        <!--청구번호-->
        <td class="mobile"><?=$allRows[$i]['monthCount']?></td><!--개월수-->
        <td class="mobile">
          <label class="mb-0"><?=$allRows[$i]['pStartDate']?></label><br><!--시작일-->
          <label class="mb-0"><?=$allRows[$i]['pEndDate']?></label><!--종료일-->
        </td>
        <td>
          <p style="color:#F7819F;" class="modalAsk" data-toggle='modal' data-target='#pPay'>
            <?=$allRows[$i]['pExpectedDate']?>
          </p>
          <input type="hidden" value="<?=$allRows[$i]['realContract_id']?>">
          <input type="hidden" value="<?=$allRows[$i]['idpaySchedule2']?>">
          <!--모달시작-->
          <div class="modal fade" id="pPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">

              <div class="modal-content">

                <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLabel">입금처리 - 청구번호 <span class='payid'></span></h6>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">

                </div>
                <div class="modal-footer">
                </div>
              </div>

            </div>
          </div>
          <!--모달끝-->
        </td><!--입금예정일-->
        <td class="mobile">
          <label class="numberComma mb-0">
            <?=$allRows[$i]['pAmount']?>
          </label>
        </td><!--공급가액-->
        <td>
          <label class="numberComma mb-0">
            <?=$allRows[$i]['pvAmount']?>
          </label><!--세액-->
        </td>
        <td>
          <a href="/svc/service/contract/contractEdit3.php?id=<?=$allRows[$i]['realContract_id']?>" style="color:
        #04B486;">
            <label class="numberComma mb-0" data-toggle="tooltip" data-placement="top" title="계약보기">
              <u><?=$allRows[$i]['ptAmount']?></u>
            </label>
          </a>
        </td><!--합계-->
        <td class="mobile">
            <?=$allRows[$i]['payKind']?>
        </td><!--입금구분-->
        <td class="mobile">
            <?php
            $expectedDate = new DateTime($allRows[$i]['pExpectedDate']);
            $currentDateDate = new DateTime($currentDate);
            if($expectedDate >= $currentDateDate) {
              echo "<label class='text-center font-weight-light mb-0' style='color:#04B486;'>0</label><br>";
            } else {
              $notGetDayCount = date_diff($currentDateDate, $expectedDate);
              echo "<label class='text-center numberComma font-weight-light mb-0' style='color:#F7819F;'>";echo $notGetDayCount->days."</label><br>";
            }
             ?><!--연체일수-->
           <?php
           $expectedDate = new DateTime($allRows[$i]['pExpectedDate']);
           $currentDateDate = new DateTime($currentDate);
           if($expectedDate >= $currentDateDate) {
             echo "<label class='text-center font-weight-light mb-0' style='color:#04B486;'>0</label>";
           } else {
             $notGetDayCountAmount = $allRows[$i]['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
             echo "<label class='text-center numberComma font-weight-light mb-0' style='color:#F7819F;'>";echo (int)$notGetDayCountAmount."</label>";
           }
            ?><!--연체이자-->
        </td>
        <td class="mobile">
          <?php
            if($allRows[$i]['taxSelect']==='세금계산서'){
              echo "<button onclick='fn_test();'><div class='badge badge-warning text-light' style='width: 1.5rem;'>
              세</div> <label class='mb-0'>".$allRows[$i]['taxDate']."</label></button>";
            } elseif($allRows[$i]['taxSelect']==='현금영수증'){
              echo "<div class='badge badge-info text-light' style='width: 1.5rem;'>
              현</div> <label class='mb-0'>".$allRows[$i]['taxDate']."</label>";
            }
           ?>
        </td><!--증빙일자-->
      </tr>
    <?php
    $j -= 1;
  } ?> <!--for closing } -->
    <tr class="table-secondary">
      <td colspan="8">Total</td>
      <td><label class="numberComma mb-0"><?=$amountTotalArray[0]?></label></td>
      <td><label class="numberComma mb-0"><?=$amountTotalArray[1]?></label></td>
      <td><label class="numberComma mb-1"><?=$amountTotalArray[2]?></label></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
<?php } ?>


<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

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

$(".numberComma").number(true);

$('.modalAsk').on('click', function(){ //청구번호클릭하는거(모달클릭)

  var currow2 = $(this).closest('tr');
  var payNumber = currow2.find('td:eq(7)').children('input:eq(1)').val();
  // console.log(payNumber);
  var filtered_id = currow2.find('td:eq(7)').children('input:eq(0)').val();;
  // console.log(filtered_id);

    $.ajax({
      url: '/svc/service/contract/ajax_paySchedule2_payid.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.payid').html(data);
      }
    })

    $.ajax({
      url: '/svc/service/contract/ajax_paySchedule2_search.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.modal-body').html(data);
      }
    })

    $.ajax({
      url: 'ajax_paySchedule2_modalfooter2.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.modal-footer').html(data);
      }
    })
}) //

//===^청구번호클릭하는거(모달클릭) closing}^ ===============

var AmountArray = [];
var amountMoney = [0,0,0];
$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  amountMoney = [0,0,0];
  // console.log(allCnt);

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var colpAmount = table.find("tr:eq("+i+")").find("td:eq(8)").children('label').text();
      var colpvAmount = table.find("tr:eq("+i+")").find("td:eq(9)").children('label').text();
      var colptAmount = table.find("tr:eq("+i+")").find("td:eq(10)").children('a').children('label').text();
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
      var colpAmount = currow.find("td:eq(8)").children('label').text();
      var colpvAmount = currow.find("td:eq(9)").children('label').text();
      var colptAmount = currow.find("td:eq(10)").children('a').children('label').text();
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
      var colpAmount = currow.find("td:eq(8)").children('label').text();
      var colpvAmount = currow.find("td:eq(9)").children('label').text();
      var colptAmount = currow.find("td:eq(10)").children('a').children('label').text();
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
//============ check sum end & smsReadyArray start


var smsReadyArray = [];

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  smsReadyArray = [];

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var smsReadyArrayEle = [];
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());
      var colgroup = table.find("tr:eq("+i+")").find("td:eq(2)").text();
      var colroom = table.find("tr:eq("+i+")").find("td:eq(3)").text();
      var colcustomerName = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(0)').val();
      var colcustomerContact = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(1)').val();
      var colcustomerEmail = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(2)').val();
      var colcustomerId = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(3)').val();
      var colexecutiveDate = "";
      var coltaxDate = table.find("tr:eq("+i+")").find("td:eq(13)").children('label').text();
      var colamount1 = table.find("tr:eq("+i+")").find("td:eq(8)").children().text();
      var colamount2 = table.find("tr:eq("+i+")").find("td:eq(9)").children().text();
      var colamount3 = table.find("tr:eq("+i+")").find("td:eq(10)").children().children().text();
      var colexpectedDate = table.find("tr:eq("+i+")").find("td:eq(7)").children('p:eq(0)').text().trim();
      var colstartDate = table.find("tr:eq("+i+")").find("td:eq(6)").children('label:eq(0)').text();
      var colendDate = table.find("tr:eq("+i+")").find("td:eq(6)").children('label:eq(1)').text();
      var colmonthcount = table.find("tr:eq("+i+")").find("td:eq(5)").text();
      var coldelaydays = table.find("tr:eq("+i+")").find("td:eq(12)").children('label:eq(0)').text();
      var coldelayinterest = table.find("tr:eq("+i+")").find("td:eq(12)").children('label:eq(1)').text();

      // console.log(colOrder, colid, colgroup, colroom, colcustomerName, colcustomerContact, colexectutiveDate, coltaxDate, colamount1, colamount2,colamount3);

      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'그룹':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId}, {'합계':colamount3}, {'예정일':colexpectedDate}, {'시작일':colstartDate}, {'종료일':colendDate}, {'개월수':colmonthcount}, {'연체일수':coldelaydays}, {'연체이자':coldelayinterest});
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
      var colgroup = currow.find("td:eq(2)").text();
      var colroom = currow.find("td:eq(3)").text();
      var colcustomerName = currow.find("td:eq(4)").children('input:eq(0)').val();
      var colcustomerContact = currow.find("td:eq(4)").children('input:eq(1)').val();
      var colcustomerEmail = currow.find("td:eq(4)").children('input:eq(2)').val();
      var colcustomerId = currow.find("td:eq(4)").children('input:eq(3)').val();
      var colexecutiveDate = "";
      var coltaxDate = currow.find("td:eq(13)").children('label').text();
      var colamount1 = currow.find("td:eq(8)").children().text();
      var colamount2 = currow.find("td:eq(9)").children().text();
      var colamount3 = currow.find("td:eq(10)").children().children().text();
      var colexpectedDate = currow.find("td:eq(7)").children('p:eq(0)').text().trim();
      var colstartDate = currow.find("td:eq(6)").children('label:eq(0)').text();
      var colendDate = currow.find("td:eq(6)").children('label:eq(1)').text();
      var colmonthcount = currow.find("td:eq(5)").text();
      var coldelaydays = currow.find("td:eq(12)").children('label:eq(0)').text();
      var coldelayinterest = currow.find("td:eq(12)").children('label:eq(1)').text();
      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'그룹':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId}, {'예정일':colexpectedDate}, {'시작일':colstartDate}, {'종료일':colendDate}, {'개월수':colmonthcount}, {'연체일수':coldelaydays}, {'연체이자':coldelayinterest});
      smsReadyArray.push(smsReadyArrayEle);
      // console.log('smsReadyArray :',smsReadyArray);
    } else {
      var dropReady = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var colgroup = currow.find("td:eq(2)").text();
      var colroom = currow.find("td:eq(3)").text();
      var colcustomerName = currow.find("td:eq(4)").children('input:eq(0)').val();
      var colcustomerContact = currow.find("td:eq(4)").children('input:eq(1)').val();
      var colcustomerEmail = currow.find("td:eq(4)").children('input:eq(2)').val();
      var colcustomerId = currow.find("td:eq(4)").children('input:eq(3)').val();
      var colexecutiveDate = "";
      var coltaxDate = currow.find("td:eq(13)").children('label').text();
      var colamount1 = currow.find("td:eq(8)").children().text();
      var colamount2 = currow.find("td:eq(9)").children().text();
      var colamount3 = currow.find("td:eq(10)").children().children().text();
      var colexpectedDate = currow.find("td:eq(7)").children('p:eq(0)').text().trim();
      var colstartDate = currow.find("td:eq(6)").children('label:eq(0)').text();
      var colendDate = currow.find("td:eq(6)").children('label:eq(1)').text();
      var colmonthcount = currow.find("td:eq(5)").text();
      var coldelaydays = currow.find("td:eq(12)").children('label:eq(0)').text();
      var coldelayinterest = currow.find("td:eq(12)").children('label:eq(1)').text();
      dropReady.push({'순번':colOrder}, {'청구번호':colid}, {'그룹':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId}, {'예정일':colexpectedDate}, {'시작일':colstartDate}, {'종료일':colendDate}, {'개월수':colmonthcount}, {'연체일수':coldelaydays}, {'연체이자':coldelayinterest});

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
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());//순번,이건굳이왜넣었을까? 빼도되지 않을까?
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());//paySchedule2id 청구번호
      var companynumber = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(5)').val();//사업자번호
      var companyname = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(6)').val();//사업자명
      var name = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(4)').val();//성명
      var address = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(7)').val();//주소
      var div4 = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(8)').val();//업태
      var div5 = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(9)').val();//종목
      var contact = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(1)').val();//연락처
      var email = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(2)').val();//이메일
      var supplyamount = table.find("tr:eq("+i+")").find("td:eq(8)").children().text();//공급가액
      var vatamount = table.find("tr:eq("+i+")").find("td:eq(9)").children().text();//세액
      var totalamount = table.find("tr:eq("+i+")").find("td:eq(10)").children().children().text();//합계
      var startdate = table.find("tr:eq("+i+")").find("td:eq(6)").children('label:eq(0)').text();//청구시작일
      var enddate = table.find("tr:eq("+i+")").find("td:eq(6)").children('label:eq(1)').text();//청구종료일
      var monthcount = table.find("tr:eq("+i+")").find("td:eq(5)").text();//청구개월
      var comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
      var acceptdiv = table.find("tr:eq("+i+")").find("td:eq(11)").text().trim();//입금구분
      var evidencedate = table.find("tr:eq("+i+")").find("td:eq(13)").children('label').text();//증빙일자


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
      var colid = Number(currow.find("td:eq(0)").children('input').val());

      var companynumber = currow.find("td:eq(4)").children('input:eq(5)').val();//사업자번호
      var companyname = currow.find("td:eq(4)").children('input:eq(6)').val();//사업자명
      var name = currow.find("td:eq(4)").children('input:eq(4)').val();//성명
      var address = currow.find("td:eq(4)").children('input:eq(7)').val();//주소
      var div4 = currow.find("td:eq(4)").children('input:eq(8)').val();//업태
      var div5 = currow.find("td:eq(4)").children('input:eq(9)').val();//종목
      var contact = currow.find("td:eq(4)").children('input:eq(1)').val();//연락처
      var email = currow.find("td:eq(4)").children('input:eq(2)').val();//이메일
      var supplyamount = currow.find("td:eq(8)").children().text();//공급가액
      var vatamount = currow.find("td:eq(9)").children().text();//세액
      var totalamount = currow.find("td:eq(10)").children().children().text();//합계
      var startdate = currow.find("td:eq(6)").children('label:eq(0)').text();//청구시작일
      var enddate = currow.find("td:eq(6)").children('label:eq(1)').text();//청구종료일
      var monthcount = currow.find("td:eq(5)").text();//청구개월
      var comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
      var acceptdiv = currow.find("td:eq(11)").text().trim();//입금구분
      var evidencedate = currow.find("td:eq(13)").children('label').text();//증빙일자

      taxArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'사업자번호':companynumber}, {'사업자명':companyname}, {'성명':name}, {'주소':address}, {'업태':div4}, {'종목':div5}, {'연락처':contact}, {'이메일':email}, {'공급가액':supplyamount}, {'세액':vatamount}, {'합계':totalamount}, {'비고':comment}, {'입금구분':acceptdiv}, {'증빙일자':evidencedate});

      taxArray.push(taxArrayEle);

    } else {
      var dropReady = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());

      var companynumber = currow.find("td:eq(4)").children('input:eq(5)').val();//사업자번호
      var companyname = currow.find("td:eq(4)").children('input:eq(6)').val();//사업자명
      var name = currow.find("td:eq(4)").children('input:eq(4)').val();//성명
      var address = currow.find("td:eq(4)").children('input:eq(7)').val();//주소
      var div4 = currow.find("td:eq(4)").children('input:eq(8)').val();//업태
      var div5 = currow.find("td:eq(4)").children('input:eq(9)').val();//종목
      var contact = currow.find("td:eq(4)").children('input:eq(1)').val();//연락처
      var email = currow.find("td:eq(4)").children('input:eq(2)').val();//이메일
      var supplyamount = currow.find("td:eq(8)").children().text();//공급가액
      var vatamount = currow.find("td:eq(9)").children().text();//세액
      var totalamount = currow.find("td:eq(10)").children().children().text();//합계
      var startdate = currow.find("td:eq(6)").children('label:eq(0)').text();//청구시작일
      var enddate = currow.find("td:eq(6)").children('label:eq(1)').text();//청구종료일
      var monthcount = currow.find("td:eq(5)").text();//청구개월
      var comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
      var acceptdiv = currow.find("td:eq(11)").text().trim();//입금구분
      var evidencedate = currow.find("td:eq(13)").children('label').text();//증빙일자

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


</script>
