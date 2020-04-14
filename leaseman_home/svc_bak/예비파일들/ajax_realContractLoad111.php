<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_SESSION);
// print_r($_POST);
// echo '111';

date_default_timezone_set('Asia/Seoul'); //이거있어야지 시간대가 맞게설정됨, 없으면 시간대가 안맞아짐
$currentDate = date('Y-m-d');
$etcIng = "";
if($_POST['progress']==='pIng'){
  $etcIng = " and (startDate <= '{$currentDate}' and endDate >= '{$currentDate}')";
} elseif($_POST['progress']==='pWaiting'){
  $etcIng = " and (startDate > '{$currentDate}')";
} elseif($_POST['progress']==='pEnd'){
  $etcIng = " and (endDate < '{$currentDate}')";
}

$etcCondi = "";
if($_POST['cText']){
  if($_POST['etcCondi']==='customer'){
    $etcCondi = " and (name like '%".$_POST['cText']."%' or companyname like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contact'){
    $etcCondi = " and (contact1 like '%".$_POST['cText']."%' or contact2 like '%".$_POST['cText']."%' or contact3 like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contractId'){
    $etcCondi = " and (realContract.id like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='roomId'){
    $etcCondi = " and (r_g_in_building.rName like '%".$_POST['cText']."%')";
  }
}


if($_POST['dateDiv']==='startDate'){
  $dateDiv = 'startDate';
} elseif($_POST['dateDiv']==='endDate'){
  $dateDiv = 'endDate';
} elseif($_POST['dateDiv']==='contractDate'){
  $dateDiv = 'contractDate';
} elseif($_POST['dateDiv']==='registerDate'){
  $dateDiv = 'createTime';
}

$etcDate = "";

if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) BETWEEN '{$_POST['fromDate']}' and '{$_POST['toDate']}')";
} elseif($_POST['fromDate']){
  $etcDate = " and (DATE($dateDiv) >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and (DATE($dateDiv) <= '{$_POST['toDate']}')";
}

if($_POST['select2']==='groupAll'){
  $groupCondi = "";
} else {
  $groupCondi = " and (realContract.group_in_building_id = {$_POST['select2']})";
}


$sql = "
  select
      @num := @num + 1 as num,
      realContract.id as rid,
      customer.id as cid,
      customer.name as cname,
      customer.companyname,
      customer.div2,
      customer.div3,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      building.bName,
      group_in_building.gName,
      r_g_in_building.rName,
      startDate,
      mtAmount,
      (select count(*) from contractschedule where realcontract_id=rid) as count,
      (select menddate from contractschedule where realcontract_id=rid and ordered=count) as duedate
  from
      (select @num :=0)a,realContract
  left join customer
      on realContract.customer_id = customer.id
  left join building
      on realContract.building_id = building.id
  left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
  left join r_g_in_building
      on realContract.r_g_in_building_id = r_g_in_building.id
  where realContract.user_id = {$_SESSION['id']} and
        realContract.building_id = {$_POST['select1']}
        $groupCondi $etcCondi $etcDate $etcIng
  order by
      num desc";
// echo $sql;
$result = mysqli_query($conn, $sql);
$total_rows = mysqli_num_rows($result);

if($total_rows===0){
  echo "조회값이 없습니다.";
} else { ?>
  <table class="table table-hover text-center mt-2" id="checkboxTestTbl">
    <thead>
      <tr class="table-info">
        <th scope="col" class="mobile"><input type="checkbox"></th>
        <th scope="col">순번</th>
        <th scope="col">상태</th>
        <th scope="col">세입자</th>
        <!-- <th scope="col">연락처</th> -->
        <!-- <th scope="col" class="mobile">물건명</th> -->
        <!-- <th scope="col" class="mobile">그룹명</th>-->
        <th scope="col">방번호
          <!-- <span>
            <button type="button" class="btn btn-default pl-0 pr-0 pt-0 pb-0">
              <i class="fas fa-sort-up"></i>
            </button><br>
            <button type="button" class="btn btn-default pl-0 pr-0 pt-0 pb-0">
              <i class="fas fa-sort-down"></i>
            </button>
          </span> -->
          <i class="fas fa-sort"></i>
        </th>
        <th scope="col" class="mobile">시작일</th>
        <th scope="col" class="mobile">종료일</th>
        <th scope="col">월세</th>
        <th scope="col" class="mobile">단계</th>
        <th scope="col" class="mobile">
          <span class="badge badge-light">파일</span>
          <span class="badge badge-dark">메모</span>
        </th>
      </tr>
    </thead>
    <tbody>
  <?php
  // echo $sql;
    while($row = mysqli_fetch_array($result)){
      $cContact = $row['contact1'].'-'.$row['contact2'].'-'.$row['contact3'];

      if($row['div3']==='주식회사'){
        $cDiv3 = '(주)';
      } elseif($row['div3']==='유한회사'){
        $cDiv3 = '(유)';
      } elseif($row['div3']==='합자회사'){
        $cDiv3 = '(합)';
      } elseif($row['div3']==='기타'){
        $cDiv3 = '(기타)';
      }

      if($row['div2']==='개인사업자'){
        $cName = $row['name'].'('.$row['companyname'].')';
      } else if($row['div2']==='법인사업자'){
        $cName = $cDiv3.$row['companyname'].'('.$row['name'].')';
      } else if($row['div2']==='개인'){
        $cName = $row['name'];
      }
      // print_r($row);
      ?>
    <tr>
      <td class="mobile"><input type="checkbox" name="chk[]" value="<?=$row[1]?>"></td>
      <td><?=$row['num']?></td>
      <td>
      <?php
      date_default_timezone_set('Asia/Seoul'); //이거있어야지 시간대가 맞게설정됨, 없으면 시간대가 안맞아짐
      $currentDate = date('Y-m-d');
      // echo $currentDate;

      $sql_getOrder = "select count(*) from contractSchedule where realContract_id={$row[1]}";
      $result_getOrder = mysqli_query($conn, $sql_getOrder);
      $row_getOrder = mysqli_fetch_array($result_getOrder);

      $sql_getEnd = "select mEndDate from contractSchedule where realContract_id={$row[1]} and ordered={$row_getOrder[0]}";
      $result_getEnd = mysqli_query($conn, $sql_getEnd);
      $row_getEnd = mysqli_fetch_array($result_getEnd);
      // echo $row_getEnd;

      if($currentDate >= $row['startDate'] && $currentDate <= $row_getEnd[0]){
        echo '<div class="badge badge-info text-wrap" style="width: 3rem;">
        진행
      </div>';
      } elseif ($currentDate < $row['startDate']) {
        echo '<div class="badge badge-warning text-wrap" style="width: 3rem;">
        대기
      </div>';
      } elseif ($currentDate > $row_getEnd[0]) {
        echo '<div class="badge badge-danger text-wrap" style="width: 3rem;">
        종료
      </div>';
      }
      ?>
      </td>
      <td class='text-center'>
        <a href="/service/customer/m_c_edit.php?id=<?=$row[2]?>" data-toggle="tooltip" data-placement="top" title="<?=$cName.', '.$cContact?>">
          <!-- <u> -->
          <?=mb_substr($cName.', '.$cContact,0,20)?>
          <!-- </u> -->
        </a>
      </td><!--고객정보-->
      <!-- <td class='text-center'><?=$cContact?></td> -->
      <!-- <td><?=$row[4]?></td>
      <td class="mobile"><?=$row[5]?></td> -->
      <td><?=$row['rName']?></td><!--방정보-->
      <td class="mobile"><?=$row['startDate']?></td><!--시작일-->
      <td class="mobile"><?=$row_getEnd[0]?></td><!--종료일-->
      <td>
        <a href="contractEdit3.php?id=<?=$row[1]?>" style="color:
      #04B486;">
          <label class="numberComma mb-0">
            <?=$row['mtAmount']?>
          </label>
        </a>
      </td><!--월이용료-->
      <!-- <td class="mobile"></td> 입금액넣었다가 뺐음-->
      <td class="mobile">
      <?php
      $sql_step = "select idpaySchedule2 from paySchedule2 where realContract_id={$row[1]}";
      // echo $sql_step;
      $result_step = mysqli_query($conn, $sql_step);
      if ($result_step->num_rows === 0) {
        echo "<div class='badge badge-warning text-light' style='width: 3rem;'>
        clear</div>";
      } else {
        $sql_step2 = "select getAmount from paySchedule2 where realContract_id={$row[1]}";
        // echo $sql_step2;
        $result_step2 = mysqli_query($conn, $sql_step2);
        $getAmount = 0;
        while($row_step2 = mysqli_fetch_array($result_step2)){
          $getAmount = $getAmount + (int)$row_step2[0];
        }
        // echo $getAmount;

        if($getAmount > 0) {
          echo "<div class='badge badge-warning text-info' style='width: 3rem;'>
          입금</div>";
        } else {
          echo "<div class='badge badge-warning text-primary' style='width: 3rem;'>
          청구</div>";
        }
      }?>
      </td><!--단계-->
      <td class="mobile">
        <?php
        $sql_file_c = "select count(*) from upload_file where realContract_id={$row[1]}";
        // echo $sql_file_c;
        $result_file_c = mysqli_query($conn, $sql_file_c);
        $row_file_c = mysqli_fetch_array($result_file_c);
        if((int)$row_file_c[0] > 0){
          echo '<a href="contractEdit3.php?id='.$row[1].'" class="badge badge-light">'.$row_file_c[0].'</a>';
        }

         $sql_memo_c = "select count(*) from realContract_memo where realContract_id={$row[1]}";
         $result_memo_c = mysqli_query($conn, $sql_memo_c);
         $row_memo_c = mysqli_fetch_array($result_memo_c);
         if((int)$row_memo_c[0] > 0){
           echo '<a href="contractEdit3.php?id='.$row[1].'" class="badge badge-dark">'.$row_memo_c[0].'</a>';
         }
         ?>
      </td><!--첨부파일-->
    </tr>
  <?php } ?>
    </tbody>
  </table>

  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>

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

$(".numberComma").number(true);
</script>
