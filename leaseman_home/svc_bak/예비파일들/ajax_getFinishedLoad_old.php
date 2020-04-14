<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include "ajax_getFinishedCondi.php";

?>

<?php if(count($allRows)===0){
   echo "조회값이 없습니다.";
 } else {?>
  <table class="table table-hover text-center mt-2 table-sm" id="checkboxTestTbl">
    <thead>
      <tr class="table-info">
        <th scope="col"><input type="checkbox"></th>
        <th scope="col">순번</th>
        <!-- <th scope="col" class="mobile">청구번호</th> -->
        <th scope="col">입금일</th>
        <th scope="col" class="mobile">공급가액</th>
        <!-- <th scope="col">청구번호</th> -->
        <th scope="col" class="mobile">세액</th>
        <th scope="col" class="">합계</th>
        <th scope="col" class="mobile">입금구분</th>
        <th scope="col">세입자</th>
        <th scope="col" class="mobile">계약(상품)</th>
        <th scope="col" class="mobile">증빙</th>
      </tr>
    </thead>
    <tbody>

    <?php
    $j = count($allRows);
    for ($i=0; $i < count($allRows); $i++) {
      ?>
      <tr>
        <td><input type="checkbox" value="<?=$allRows[$i]['idpaySchedule2']?>"></td>
        <td><?=$j?></td><!--순번-->
        <!--<td class="mobile"><?=$allRows[$i]['idpaySchedule2']?></td>--><!--청구번호-->
        <td><p style="color:#F7819F;" class="mb-0"><?=$allRows[$i]['executiveDate']?></p></td><!--입금일-->
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
            echo "<a href='/service/contract/contractEdit3.php?id=".$allRows[$i][1]."' style='color:
          #04B486'>";} else if($allRows[$i]['roomdiv']==='기타계약'){
            echo "<a href='/service/contractetc/contractetc_edit.php?id=".$allRows[$i][1]."' style='color:
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
          <a href="/service/customer/m_c_edit.php?id=<?=$allRows[$i]['customer_id']?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['cname'].', '.$allRows[$i]['contact']?>">
            <?=mb_substr($allRows[$i]['cname'].', '.$allRows[$i]['contact'],0,5)?>
          </a>
          <input type="hidden" name="name" value="<?=$allRows[$i]['cname']?>">
          <input type="hidden" name="contact" value="<?=$allRows[$i]['contact']?>">
          <input type="hidden" name="email" value="<?=$allRows[$i]['email']?>">
          <input type="hidden" name="email" value="<?=$allRows[$i]['customer_id']?>">
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
            if($allRows[$i]['taxSelect']==='세금계산서'){
              echo "<div class='badge badge-warning text-light' style='width: 1.5rem;'>
              세</div> <label class='mb-0'>".$allRows[$i]['taxDate']."</label>";
            } elseif($allRows[$i]['taxSelect']==='현금영수증'){
              echo "<div class='badge badge-info text-light' style='width: 1.5rem;'>
              현</div> <label class='mb-0'>".$allRows[$i]['taxDate']."</label>";
            }
           ?>
        </td><!--세금계산서-->
      </tr>
    <?php
    $j = $j-1; //순번을 내림차순으로 하기위해서 이거가 필요함
  } ?>
  <tr class="table-secondary">
    <td colspan="3">Total</td>
    <td><?=$amountTotalArray[0]?></td>
    <td><?=$amountTotalArray[1]?></td>
    <td><?=$amountTotalArray[2]?></td>
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


var ptAmountArray = [];
var ptAmountMoney = 0;

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  // console.log(allCnt);

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var ptAmountArrayEle = [];
      var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();//청구번5
      var colptAmount = table.find("tr:eq("+i+")").find("td:eq(5)").children('a').children('label').text();
      // console.log(colptAmount);
      var colptAmount2 = colptAmount.replace(/,/gi,'');
      var colptAmount3 = Number(colptAmount2);
      ptAmountArrayEle.push(colid, colptAmount3);
      ptAmountArray.push(ptAmountArrayEle);
      ptAmountMoney += colptAmount3;
    }
    $('#ptAmountSelectCount').html(allCnt);
    $('#ptAmountSelectAmount').html(ptAmountMoney);
    $('#ptAmountSelectAmount').number(true);
    // console.log('solmi');

  } else {
    ptAmountArray = [];
    ptAmountMoney = 0;
    $('#ptAmountSelectCount').html('0');
    $('#ptAmountSelectAmount').html(ptAmountMoney);
    $('#ptAmountSelectAmount').number(true);
  }

  // console.log('solmi');
  // console.log(ptAmountArray);
})

$(":checkbox:not(:first)",table).click(function(){
    var ptAmountArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colid = currow.find('td:eq(0)').children('input').val();
      var colptAmount = currow.find("td:eq(5)").children('a').children('label').text();
      var colptAmount2 = colptAmount.replace(/,/gi,'');
      var colptAmount3 = Number(colptAmount2);
      ptAmountArrayEle.push(colid, colptAmount3);
      ptAmountArray.push(ptAmountArrayEle);
      ptAmountMoney += colptAmount3;

      $('#ptAmountSelectCount').html(ptAmountArray.length);
      $('#ptAmountSelectAmount').html(ptAmountMoney);
      $('#ptAmountSelectAmount').number(true);
      // console.log(ptAmountArray);
    } else {
      var currow = $(this).closest('tr');
      var colid = currow.find('td:eq(0)').children('input').val();
      var colptAmount = currow.find("td:eq(5)").children('a').children('label').text();
      var colptAmount2 = colptAmount.replace(/,/gi,'');
      var colptAmount3 = Number(colptAmount2);
      var dropReady = ptAmountArrayEle.push(colid, colptAmount3);
      var index = ptAmountArray.indexOf(dropReady);
      ptAmountArray.splice(index, 1);
      ptAmountMoney -= colptAmount3;

      $('#ptAmountSelectCount').html(ptAmountArray.length);
      $('#ptAmountSelectAmount').html(ptAmountMoney);
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
      var colexectutiveDate = table.find("tr:eq("+i+")").find("td:eq(2)").children().text();
      var coltaxDate = table.find("tr:eq("+i+")").find("td:eq(9)").children('label').text();
      var colamount1 = table.find("tr:eq("+i+")").find("td:eq(3)").children().text();
      var colamount2 = table.find("tr:eq("+i+")").find("td:eq(4)").children().text();
      var colamount3 = table.find("tr:eq("+i+")").find("td:eq(5)").children().children().text();

      // console.log(colOrder, colid, colgroup, colroom, colcustomerName, colcustomerContact, colexectutiveDate, coltaxDate, colamount1, colamount2,colamount3);

      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'상품':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexectutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId});
      smsReadyArray.push(smsReadyArrayEle);

    }
  } else {
    smsReadyArray = [];
  }
  console.log(smsReadyArray);
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
      var colexectutiveDate = currow.find("td:eq(2)").children().text();
      var coltaxDate = currow.find("td:eq(9)").children('label').text();
      var colamount1 = currow.find("td:eq(3)").children().text();
      var colamount2 = currow.find("td:eq(4)").children().text();
      var colamount3 = currow.find("td:eq(5)").children().children().text();
      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'상품':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexectutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId});
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
      var colexectutiveDate = currow.find("td:eq(2)").children().text();
      var coltaxDate = currow.find("td:eq(9)").children('label').text();
      var colamount1 = currow.find("td:eq(3)").children().text();
      var colamount2 = currow.find("td:eq(4)").children().text();
      var colamount3 = currow.find("td:eq(5)").children().children().text();
      dropReady.push({'순번':colOrder}, {'청구번호':colid}, {'상품':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexectutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId});

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

console.log(smsReadyArray);
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
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());
      var coltax = table.find("tr:eq("+i+")").find("td:eq(4)").children('label').text();
      var colpay = table.find("tr:eq("+i+")").find("td:eq(6)").text().trim();
      var coltaxdate = table.find("tr:eq("+i+")").find("td:eq(9)").text().trim();
      taxArrayEle.push(colOrder, colid, coltax, colpay, coltaxdate)
      taxArray.push(taxArrayEle);
    }
  } else {
    taxArray = [];
  }
  // console.log(taxArray);
})

$(":checkbox:not(:first)",table).click(function(){
var taxArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var coltax = currow.find("td:eq(4)").children('label').text();
      var colpay = currow.find("td:eq(6)").text().trim();
      var coltaxdate = currow.find("td:eq(9)").text().trim();
      taxArrayEle.push(colOrder, colid, coltax, colpay, coltaxdate);
      taxArray.push(taxArrayEle);
    } else {
      var dropReady = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var coltax = currow.find("td:eq(4)").children('label').text();
      var colpay = currow.find("td:eq(6)").text().trim();
      var coltaxdate = currow.find("td:eq(9)").text().trim();
      dropReady.push(colOrder, colid, coltax, colpay, coltaxdate);

      for (var i = 0; i < taxArray.length; i++) {
        var join1 = taxArray[i].join(',');
        var join2 = dropReady.join(',');

        if(join1===join2){
          var index = i;
        }
      }

      taxArray.splice(index, 1);

    }
// console.log(taxArray);
})

</script>
