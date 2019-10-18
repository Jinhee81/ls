<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
// print_r($_SESSION);
// print_r($_POST);
include "ajax_getexpectedCondi.php";

?>

<?php if(count($allRows)===0){
   echo "조회값이 없습니다.";
 } else {?>
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
        <th scope="col" class="mobile">시작일</th>
        <th scope="col" class="mobile">종료일</th>
        <th scope="col">예정일</th>
        <th scope="col" class="mobile">공급가액</th>
        <th scope="col" class="mobile">세액</th>
        <th scope="col">합계</th>
        <th scope="col" class="mobile">입금구분</th>
        <th scope="col" class="mobile">연체일수</th>
        <th scope="col" class="mobile">연체이자</th>
      </tr>
    </thead>
    <tbody>

    <?php for ($i=0; $i < count($allRows); $i++) {?>
      <tr>
        <td><input type="checkbox" value="<?=$allRows[$i]['idpaySchedule2']?>"></td>
        <td><?=$allRows[$i]['num']?></td><!--순번-->
        <td class="mobile"><?=$allRows[$i]['gName']?></td><!--그룹명-->
        <td><?=$allRows[$i]['rName']?></td><!--방번호-->
        <td>
          <a href="/service/customer/m_c_edit.php?id=<?=$allRows[$i]['customer_id']?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['cname'].', '.$allRows[$i]['contact']?>">
            <?=mb_substr($allRows[$i]['cname'].', '.$allRows[$i]['contact'],0,5)?>
          </a>
        </td><!--세입자-->
        <!-- <td>
          <p class='text-primary modalAsk font-weight-light' data-toggle='modal' data-target='#pPay'>
            <u><?=$allRows[$i]['idpaySchedule2']?></u>
          </p>

        </td> -->
        <!--청구번호-->
        <td class="mobile"><?=$allRows[$i]['monthCount']?></td><!--개월수-->
        <td class="mobile"><?=$allRows[$i]['pStartDate']?></td><!--시작일-->
        <td class="mobile"><?=$allRows[$i]['pEndDate']?></td><!--종료일-->
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
        <td class="mobile">
          <label class="numberComma mb-0">
            <?=$allRows[$i]['pvAmount']?>
          </label>
        </td><!--세액-->
        <td>
          <a href="/service/contract/contractEdit3.php?id=<?=$allRows[$i]['realContract_id']?>" style="color:
        #04B486;">
            <label class="numberComma mb-0">
              <?=$allRows[$i]['ptAmount']?>
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
              echo "<p class='text-center font-weight-light green'>0</p>";
            } else {
              $notGetDayCount = date_diff($currentDateDate, $expectedDate);
              echo "<p class='text-center numberComma font-weight-light' style='color:#F7819F;'>";echo $notGetDayCount->days."</p>";
            }
             ?>
        </td><!--연체일수-->
        <td class="mobile">
          <?php
          $expectedDate = new DateTime($allRows[$i]['pExpectedDate']);
          $currentDateDate = new DateTime($currentDate);
          if($expectedDate >= $currentDateDate) {
            echo "<p class='text-center font-weight-light green'>0</p>";
          } else {
            $notGetDayCountAmount = $allRows[$i]['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
            echo "<p class='text-center numberComma font-weight-light' style='color:#F7819F;'>";echo (int)$notGetDayCountAmount."</p>";
          }
           ?>
        </td><!--연체이자-->
      </tr>
    <?php
  }
} ?>


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

var contractArray = [];

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  contractArray = [];

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var contractArrayEle = [];
      var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text();
      var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
      contractArrayEle.push(colOrder, colid);
      contractArray.push(contractArrayEle);
    }
  } else {
    contractArray = [];
  }
  // console.log(contractArray);
})

$(":checkbox:not(:first)",table).click(function(){
var contractArrayEle = [];

if($(this).is(":checked")){
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());
  var colid = currow.find('td:eq(0)').children('input').val();
  contractArrayEle.push(colOrder, colid);
  contractArray.push(contractArrayEle);
} else {
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());
  var colid = currow.find('td:eq(0)').children('input').val();
  var dropReady = contractArrayEle.push(colOrder, colid);
  var index = contractArray.indexOf(dropReady);
  contractArray.splice(index, 1);
}
// console.log(contractArray);
// console.log(typeof(contractArray[3]));
})

$(".numberComma").number(true);

$('.modalAsk').on('click', function(){ //청구번호클릭하는거(모달클릭)

  var currow2 = $(this).closest('tr');
  var payNumber = currow2.find('td:eq(8)').children('input:eq(1)').val();
  // console.log(payNumber);
  var filtered_id = currow2.find('td:eq(8)').children('input:eq(0)').val();;
  // console.log(filtered_id);

    $.ajax({
      url: '/service/contract/ajax_paySchedule2_payid.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.payid').html(data);
      }
    })

    $.ajax({
      url: '/service/contract/ajax_paySchedule2_search.php',
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
}) //청구번호클릭하는거(모달클릭) closing}

var ptAmountArray = [];
var ptAmountMoney = 0;

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  console.log(allCnt);

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var ptAmountArrayEle = [];
      var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
      var colptAmount = table.find("tr:eq("+i+")").find("td:eq(11)").children('a').children('label').text();
      // console.log(colptAmount);
      var colptAmount2 = colptAmount.replace(/,/gi,'');
      var colptAmount3 = Number(colptAmount2);
      ptAmountArrayEle.push(colid, colptAmount3);
      ptAmountArray.push(ptAmountArrayEle);
      ptAmountMoney += colptAmount3;
    }
    $('#ptAmountSelectCount').html(allCnt);
    $('#ptAmountSelectAmount').html(ptAmountMoney);
  } else {
    ptAmountArray = [];
    ptAmountMoney = 0;
    $('#ptAmountSelectCount').html('0');
    $('#ptAmountSelectAmount').html(ptAmountMoney);
  }
  // console.log(ptAmountArray);
})

$(":checkbox:not(:first)",table).click(function(){
    var ptAmountArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colid = currow.find('td:eq(0)').children('input').val();
      var colptAmount = currow.find("td:eq(11)").children('a').children('label').text();
      var colptAmount2 = colptAmount.replace(/,/gi,'');
      var colptAmount3 = Number(colptAmount2);
      ptAmountArrayEle.push(colid, colptAmount3);
      ptAmountArray.push(ptAmountArrayEle);
      ptAmountMoney += colptAmount3;

      $('#ptAmountSelectCount').html(ptAmountArray.length);
      $('#ptAmountSelectAmount').html(ptAmountMoney);
      // console.log(ptAmountArray);
    } else {
      var currow = $(this).closest('tr');
      var colid = currow.find('td:eq(0)').children('input').val();
      var colptAmount = currow.find("td:eq(11)").children('a').children('label').text();
      var colptAmount2 = colptAmount.replace(/,/gi,'');
      var colptAmount3 = Number(colptAmount2);
      var dropReady = ptAmountArrayEle.push(colid, colptAmount3);
      var index = ptAmountArray.indexOf(dropReady);
      ptAmountArray.splice(index, 1);
      ptAmountMoney -= colptAmount3;

      $('#ptAmountSelectCount').html(ptAmountArray.length);
      $('#ptAmountSelectAmount').html(ptAmountMoney);
      // console.log(ptAmountArray);
    }
})

</script>
