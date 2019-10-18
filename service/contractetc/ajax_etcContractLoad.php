<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_SESSION);
// print_r($_POST);
// echo '111';

if($_POST['dateDiv']==='executiveDate'){
  $dateDiv = 'executiveDate';
} elseif($_POST['dateDiv']==='createTime'){
  $dateDiv = 'createTime';
} elseif($_POST['dateDiv']==='updateTime'){
  $dateDiv = 'updateTime';
}
$etcDate = "";
$toDate1 = strtotime($_POST['toDate']);
$toDate2 = date('Y-m-d', $toDate1);
$toDate3 = date('Y-m-d', strtotime($toDate2.'+1 days'));

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and ($dateDiv >= '{$_POST['fromDate']}' and $dateDiv <= '{$toDate3}')";
} elseif($_POST['fromDate']){
  $etcDate = " and ($dateDiv >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and ($dateDiv <= '{$toDate3}')";
}

$etcCondi = "";
if($_POST['cText']){
  if($_POST['etcCondi']==='customer'){
    $etcCondi = " and (name like '%".$_POST['cText']."%' or companyname like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contact'){
    $etcCondi = " and (contact1 like '%".$_POST['cText']."%' or contact2 like '%".$_POST['cText']."%' or contact3 like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contractId'){
    $etcCondi = " and (etcContract.id like '%".$_POST['cText']."%')";
  }
}

$sql = "
  select
      @num := @num + 1 as num,
      etcContract.id,
      customer.id,
      customer.name,
      customer.companyname,
      customer.div2,
      customer.div3,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      building.bName,
      good_in_building.name,
      pAmount,
      pvAmount,
      ptAmount,
      executiveDate,
      payKind,
      etcContract.etc
  from
      (select @num :=0)a,etcContract
  left join customer
      on etcContract.customer_id = customer.id
  left join building
      on etcContract.building_id = building.id
  left join good_in_building
      on etcContract.good_in_building_id = good_in_building.id
  where etcContract.user_id = {$_SESSION['id']} and
        etcContract.building_id = {$_POST['select1']} and
        etcContract.good_in_building_id = {$_POST['select2']}
        $etcCondi $etcDate
  order by
      num desc";
// echo $sql;

$result = mysqli_query($conn, $sql);
// $total_rows = mysqli_num_rows($result);
$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

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
    $allRows[$i]['cname'] = $allRows[$i][3].'('.$allRows[$i]['companyname'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['cname'] = $allRows[$i]['cdiv3'].$allRows[$i]['companyname'].'('.$allRows[$i][3].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['cname'] = $allRows[$i][3];
  }

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

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
        <th scope="col">성명</th>
        <th scope="col">입금일</th>
        <th scope="col">공급가액</th>
        <th scope="col">세액</th>
        <th scope="col">합계</th>
        <th scope="col">입금구분</th>
        <th scope="col">특이사항</th>
      </tr>
    </thead>
    <tbody>

    <?php for ($i=0; $i < count($allRows); $i++) {?>
      <tr>
        <td><input type="checkbox" value="<?=$allRows[$i][1]?>"></td>
        <td><?=$allRows[$i]['num']?></td><!--순번-->
        <td>
          <a href="/service/customer/m_c_edit.php?id=<?=$allRows[$i][2]?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['cname'].', '.$allRows[$i]['contact']?>">
            <?=mb_substr($allRows[$i]['cname'].', '.$allRows[$i]['contact'],0,20)?>
          </a>
        </td><!--성명-->
        <td><?=$allRows[$i]['executiveDate']?></td><!--입금일-->
        <td>
          <?=$allRows[$i]['pAmount']?>
        </td><!--공급가액-->
        <td>
          <?=$allRows[$i]['pvAmount']?>
        </td><!--세액-->
        <td>
          <a href="contractetc_edit.php?id=<?=$allRows[$i][1]?>" style="color:
        #04B486;">
            <label class="numberComma mb-0">
              <?=$allRows[$i]['ptAmount']?>
            </label>
          </a>
        </td><!--합계-->
        <td class="mobile"><?=$allRows[$i]['payKind']?></td><!--입금구분-->
        <td>
            <?=$allRows[$i]['etc']?>
        </td><!--특이사항-->
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
      var colStep = table.find("tr:eq("+i+")").find("td:eq(8)").children('div').text();
      var colFile = table.find("tr:eq("+i+")").find("td:eq(9)").children('a:eq(0)').text();
      var colMemo = table.find("tr:eq("+i+")").find("td:eq(9)").children('a:eq(1)').text();
      contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
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
  var colStep = currow.find('td:eq(8)').children('div').text();
  var colFile = currow.find("td:eq(9)").children('a:eq(0)').text();
  var colMemo = currow.find("td:eq(9)").children('a:eq(1)').text();
  contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
  contractArray.push(contractArrayEle);
} else {
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());
  var colid = currow.find('td:eq(0)').children('input').val();
  var colStep = currow.find('td:eq(8)').children('div').text();
  var colFile = currow.find("td:eq(9)").children('a:eq(0)').text();
  var colMemo = currow.find("td:eq(9)").children('a:eq(1)').text();
  var dropReady = contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
  var index = contractArray.indexOf(dropReady);
  contractArray.splice(index, 1);
}
// console.log(contractArray);
// console.log(typeof(contractArray[3]));
})

$('button[name="rowDeleteBtn"]').on('click', function(){
// console.log(contractArray);
for (var i = 0; i < contractArray.length; i++) {
  if(contractArray[i][2] === '청구' || contractArray[i][2] === '입금'){
    alert('단계가 clear 이어야만 삭제 가능합니다.');
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

var aa = 'etcContractDelete';
var bb = 'p_etcContract_delete_for.php';
var cc = JSON.stringify(contractArray);

goCategoryPage(aa, bb, cc);

function goCategoryPage(a, b, c){
  var frm = formCreate(a, 'post', b,'');
  frm = formInput(frm, 'contractArray', c);
  formSubmit(frm);
}

}) //rowDeleteBtn function closing

$(".numberComma").number(true);
</script>
