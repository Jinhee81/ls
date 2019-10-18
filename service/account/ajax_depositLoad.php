<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/account/ajax_depositCondi.php";//조회조건파일

date_default_timezone_set('Asia/Seoul'); //이거있어야지 시간대가 맞게설정됨, 없으면 시간대가 안맞아짐
$currentDate = date('Y-m-d');
// echo $currentDate;

for ($i=0; $i < count($allRows); $i++) {
  if($allRows[$i]['div3']==='주식회사'){
    $allRows[$i]['cdiv3'] = '(주)';
  } elseif($allRows[$i]['div3']==='유한회사'){
    $allRows[$i]['cdiv3'] = '(유)';
  } elseif($allRows[$i]['div3']==='합자회사'){
    $allRows[$i]['cdiv3'] = '(합)';
  } elseif($allRows[$i]['div3']==='기타'){
    $allRows[$i]['cdiv3'] = '(기타)';
  }

  if($allRows[$i]['div2']==='개인사업자'){
    $allRows[$i]['cname'] = $allRows[$i]['name'].'('.$allRows[$i]['companyname'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i]['name'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['cname'] = $allRows[$i]['name'];
  }

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];


  $sql_getOrder = "select count(*) from contractSchedule where realContract_id={$allRows[$i][1]}";
  $result_getOrder = mysqli_query($conn, $sql_getOrder);
  $row_getOrder = mysqli_fetch_array($result_getOrder);

  $sql_getEnd = "select mEndDate from contractSchedule where realContract_id={$allRows[$i][1]} and ordered={$row_getOrder[0]}";
  $result_getEnd = mysqli_query($conn, $sql_getEnd);
  $allRows[$i]['row_getend'] = mysqli_fetch_array($result_getEnd);
  // echo $row_getEnd;

  if($currentDate >= $allRows[$i]['startDate'] && $currentDate <= $allRows[$i]['row_getend'][0]){
    $allRows[$i]['status'] = '<div class="badge badge-info text-wrap" style="width: 3rem;">진행</div>';
  } elseif ($currentDate < $allRows[$i]['startDate']) {
    $allRows[$i]['status'] = '<div class="badge badge-warning text-wrap" style="width: 3rem;">대기</div>';
  } elseif ($currentDate > $allRows[$i]['row_getend'][0]) {
    $allRows[$i]['status'] = '<div class="badge badge-danger text-wrap" style="width: 3rem;">종료</div>';
  }


} //for문closing

// print_r($allRows);
?>

<?php if(count($allRows)===0){
   echo "조회값이 없습니다.";
 } else {?>
  <table class="table table-hover text-center mt-2" id="checkboxTestTbl">
    <thead>
      <tr class="table-info">
        <th scope="col"><input type="checkbox"></th>
        <th scope="col">순번</th>
        <th scope="col">상태</th>
        <th scope="col">세입자</th>
        <th scope="col">방번호</th>
        <th scope="col">월세</th>
        <th scope="col" class="mobile">입금일</th>
        <th scope="col" class="mobile">입금액</th>
        <th scope="col" class="mobile">출금일</th>
        <th scope="col" class="mobile">출금액</th>
        <th scope="col">잔액</th>
      </tr>
    </thead>
    <tbody>

    <?php for ($i=0; $i < count($allRows); $i++) {?>
      <tr>
        <td><input type="checkbox" value="<?=$allRows[$i][1]?>"></td>
        <td><?=$allRows[$i]['num']?></td><!--순번-->
        <td><?=$allRows[$i]['status']?></td><!--상태-->
        <td>
          <a href="/service/customer/m_c_edit.php?id=<?=$allRows[$i][2]?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['cname'].', '.$allRows[$i]['contact']?>">
            <?=mb_substr($allRows[$i]['cname'].', '.$allRows[$i]['contact'],0,20)?>
          </a>
        </td><!--세입자-->
        <td><?=$allRows[$i]['rName']?></td><!--방번호-->
        <td>
          <a href="/service/contract/contractEdit3.php?id=<?=$allRows[$i][1]?>" style="color:#04B486;">
            <label class="numberComma mb-0">
              <?=$allRows[$i]['mtAmount']?>
            </label>
          </a>
        </td><!--월세-->
        <td class="mobile"><?=$allRows[$i]['inDate']?></td><!--입금일-->
        <td class="mobile">
          <label class="numberComma">
            <?=$allRows[$i]['inMoney']?>
          </label>
        </td><!--입금액-->
        <td class="mobile"><?=$allRows[$i]['outDate']?></td><!--출금일-->
        <td class="mobile">
          <label class="numberComma">
            <?=$allRows[$i]['outMoney']?>
          </label>
        </td><!--출금액-->
        <td>
          <label class="numberComma" style="color:#F781F3;">
            <?=$allRows[$i]['remainMoney']?>
          </label>
        </td><!--잔액-->
      </tr>
    <?php
  }
} ?>

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

  var depositArray = [];
  var depositMoney = 0;

  $(":checkbox:first", table).click(function(){

    var allCnt = $(":checkbox:not(:first)", table).length;

    if($(":checkbox:first", table).is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var depositArrayEle = [];
        var colremainMoney = table.find("tr:eq("+i+")").find("td:eq(10)").children('label').text();
        var colremainMoney2 = colremainMoney.replace(/,/gi,'');
        var colremainMoney3 = Number(colremainMoney2);
        depositArrayEle.push(colremainMoney3);
        depositArray.push(depositArrayEle);
        depositMoney += colremainMoney3;
      }
      $('#depositSelectCount').html(allCnt);
      $('#depositSelectAmount').html(depositMoney);
    } else {
      depositArray = [];
      depositMoney = 0;
      $('#depositSelectCount').html('0');
      $('#depositSelectAmount').html(depositMoney);
    }
    // console.log(depositArray);
  })

  $(":checkbox:not(:first)",table).click(function(){
      var depositArrayEle = [];

      if($(this).is(":checked")){
        var currow = $(this).closest('tr');
        var colid = currow.find('td:eq(0)').children('input').val();
        var colremainMoney = currow.find('td:eq(10)').children('label').text();
        var colremainMoney2 = colremainMoney.replace(/,/gi,'');
        var colremainMoney3 = Number(colremainMoney2);
        depositArrayEle.push(colid, colremainMoney3);
        depositArray.push(depositArrayEle);
        depositMoney += colremainMoney3;

        $('#depositSelectCount').html(depositArray.length);
        $('#depositSelectAmount').html(depositMoney);
        // console.log(depositArray);
      } else {
        var currow = $(this).closest('tr');
        var colid = currow.find('td:eq(0)').children('input').val();
        var colremainMoney = currow.find('td:eq(10)').children('label').text();
        var colremainMoney2 = colremainMoney.replace(/,/gi,'');
        var colremainMoney3 = Number(colremainMoney2);
        var dropReady = depositArrayEle.push(colid, colremainMoney3);
        var index = depositArray.indexOf(dropReady);
        depositArray.splice(index, 1);
        depositMoney -= colremainMoney3;

        $('#depositSelectCount').html(depositArray.length);
        $('#depositSelectAmount').html(depositMoney);
        // console.log(depositArray);
      }
  })

</script>
