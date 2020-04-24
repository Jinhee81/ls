<!-- 표에 내용이 너무 많아서 단계를 빼기로 함 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_SESSION);
// print_r($_POST);
// echo '111';

$currentDate = date('Y-m-d');

if($_POST['dateDiv']==='startDate'){
  $dateDiv = 'startDate';
} elseif($_POST['dateDiv']==='endDate'){
  $dateDiv = 'endDate2';
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

if($_POST['progress']==='pIng'){
  $etcIng = " and getStatus(startDate, endDate2) = 'present'";
} elseif($_POST['progress']==='pWaiting'){
  $etcIng = " and getStatus(startDate, endDate2) = 'waiting'";
} elseif($_POST['progress']==='pEnd'){
  $etcIng = " and getStatus(startDate, endDate2) = 'the_end'";
} elseif($_POST['progress']==='pAll'){
  $etcIng = "";
}

if($_POST['group']==='groupAll'){
  $groupCondi = "";
} else {
  $groupCondi = " and (realContract.group_in_building_id = {$_POST['group']})";
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



$sql = "
  select
      realContract.id as rid,
      customer.id as cid,
      customer.name as cname,
      customer.companyname as ccomname,
      customer.div2,
      customer.div3,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      building.bName,
      group_in_building.gName,
      r_g_in_building.rName,
      startDate,
      endDate2,
      mtAmount,
      getStatus(startDate, endDate2) as status2,
      count2
  from
      realContract
  left join customer
      on realContract.customer_id = customer.id
  left join building
      on realContract.building_id = building.id
  left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
  left join r_g_in_building
      on realContract.r_g_in_building_id = r_g_in_building.id
  where realContract.user_id = {$_SESSION['id']} and
        realContract.building_id = {$_POST['building']}
        $etcDate $etcIng $groupCondi $etcCondi
  order by
      group_in_building.id asc, r_g_in_building.id asc";
echo $sql;
$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
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
    $allRows[$i]['ccnn'] = $allRows[$i]['cname'].'('.$allRows[$i]['ccomname'].')';
  } else if($allRows[$i]['div2']==='법인사업자'){
    $allRows[$i]['ccnn'] = $allRows[$i]['cdiv3'].$allRows[$i]['ccomname'].'('.$allRows[$i]['cname'].')';
  } else if($allRows[$i]['div2']==='개인'){
    $allRows[$i]['ccnn'] = $allRows[$i]['cname'];
  }

  $allRows[$i]['contact'] = $allRows[$i]['contact1'].'-'.$allRows[$i]['contact2'].'-'.$allRows[$i]['contact3'];

  $sql_step = "select idpaySchedule2 from paySchedule2 where realContract_id = {$allRows[$i]['rid']}";
  // echo $sql_step;
  $result_step = mysqli_query($conn, $sql_step);
  if ($result_step->num_rows === 0) {
    $allRows[$i]['step'] = 'clear';
  } else {
    $sql_step2 = "select getAmount from paySchedule2 where realContract_id = {$allRows[$i]['rid']}";
    // echo $sql_step2;
    $result_step2 = mysqli_query($conn, $sql_step2);
    $getAmount = 0;
    while($row_step2 = mysqli_fetch_array($result_step2)){
      $getAmount = $getAmount + (int)$row_step2[0];
    }
    // echo $getAmount;

    if($getAmount > 0) {
      $allRows[$i]['step'] = 'recieved';
    } else {
        $allRows[$i]['step'] = 'recieving';
    }
  }

  $sql_file_c = "select count(*) from upload_file where realContract_id={$allRows[$i]['rid']}";
  // echo $sql_file_c;
  $result_file_c = mysqli_query($conn, $sql_file_c);
  $row_file_c = mysqli_fetch_array($result_file_c);

  $allRows[$i]['filecount'] = (int)$row_file_c[0];


  $sql_memo_c = "select count(*) from realContract_memo where realContract_id={$allRows[$i]['rid']}";
  $result_memo_c = mysqli_query($conn, $sql_memo_c);
  $row_memo_c = mysqli_fetch_array($result_memo_c);

  $allRows[$i]['memocount'] = (int)$row_memo_c[0];


} //for문closing

// print_r($allRows);
?>
  <table class="table table-hover text-center mt-2" id="checkboxTestTbl">
    <thead>
      <tr class="table-info">
        <th scope="col" class="mobile"><input type="checkbox"></th>
        <th scope="col">순번</th>
        <th scope="col">상태</th>
        <th scope="col">세입자</th>
        <th scope="col">연락처</th>
        <th scope="col" class="mobile">그룹명</th>
        <th scope="col">방번호<i class="fas fa-sort"></i></th>
        <th scope="col" class="mobile">시작일<i class="fas fa-sort"></i></th>
        <th scope="col" class="mobile">종료일<i class="fas fa-sort"></i></th>
        <th scope="col" class="mobile">기간<i class="fas fa-sort"></i></th>
        <th scope="col">월세<i class="fas fa-sort"></i></th>
        <!-- <th scope="col" class="mobile">단계<i class="fas fa-sort"></i></th> -->
        <th scope="col" class="mobile">
          <span class="badge badge-light">파일</span>
          <span class="badge badge-dark">메모</span>
        </th>
      </tr>
    </thead>
<?php
if(count($allRows)===0){
echo "<tr><td colspan='12'>조회값이 없습니다.</td></tr>";
} else { ?>
      <?php
      $j = count($allRows);
      for ($i=0; $i < count($allRows); $i++) {
        ?>
      <tr>
        <td class="mobile"><input type="checkbox" name="chk[]" value="<?=$allRows[$i]['rid']?>"></td>
        <td>
          <label data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['rid']?>"><?=$j?>
          </label>
        </td><!--순번-->
        <td>
        <?php
        if($allRows[$i]['status2']==='present'){
          echo '<div class="badge badge-info text-wrap" style="width: 3rem;">
          현재</div>';
        } elseif ($allRows[$i]['status2']==='waiting') {
          echo '<div class="badge badge-warning text-wrap" style="width: 3rem;">
          대기</div>';
        } elseif ($allRows[$i]['status2']==='the_end') {
          echo '<div class="badge badge-danger text-wrap" style="width: 3rem;">
          종료</div>';
        }
         ?>
        </td><!--상태-->
        <td class='text-center'>
          <a href="/service/customer/m_c_edit.php?id=<?=$allRows[$i]['cid']?>" data-toggle="tooltip" data-placement="top" title="<?=$allRows[$i]['ccnn']?>">
            <!-- <u> -->
            <?=mb_substr($allRows[$i]['ccnn'],0,8)?>
            <!-- </u> -->
          </a>
        </td><!--세입자-->
        <td class='text-center'>
          <?=$allRows[$i]['contact']?>
        </td><!--연락처-->
        <td><?=$allRows[$i]['gName']?></td><!--그룹명-->
        <td><?=$allRows[$i]['rName']?></td><!--방번호-->
        <td class="mobile"><?=$allRows[$i]['startDate']?></td><!--시작일-->
        <td class="mobile"><?=$allRows[$i]['endDate2']?></td><!--종료일-->
        <td class="mobile"><?=$allRows[$i]['count2']?></td><!--기간-->
        <td>
          <a href="contractEdit3.php?id=<?=$allRows[$i]['rid']?>" style="color:
        #04B486;">
            <label class="numberComma mb-0">
              <?=$allRows[$i]['mtAmount']?>
            </label>
            <?php
            if($allRows[$i]['step']==='clear'){
              echo "<div class='badge badge-warning text-light' style='width: 1rem;'>
              c</div>";
            }
             ?>
          </a>
        </td><!--월이용료-->
        <!-- <td class="mobile"></td> 입금액넣었다가 뺐음-->
        <!-- <td class="mobile">
          <?php
          if($allRows[$i]['step']==='clear'){
            echo "<div class='badge badge-warning text-light' style='width: 3rem;'>
            clear</div>";
          } elseif ($allRows[$i]['step']==='recieved') {
            echo "<div class='badge badge-warning text-info' style='width: 3rem;'>
            입금</div>";
          } elseif ($allRows[$i]['step']==='recieving') {
            echo "<div class='badge badge-warning text-primary' style='width: 3rem;'>
            청구</div>";
          }
           ?>
        </td> -->
        <!--단계-->
        <td class="mobile">
          <?php
          if($allRows[$i]['filecount'] > 0){
            echo '<a href="contractEdit3.php?id='.$allRows[$i]['rid'].'" class="badge badge-light">'.$allRows[$i]['filecount'].'</a>';
          }

          if($allRows[$i]['memocount'] > 0){
             echo '<a href="contractEdit3.php?id='.$allRows[$i]['rid'].'" class="badge badge-dark">'.$allRows[$i]['memocount'].'</a>';
          }
           ?>
        </td><!--파일,메모-->
      </tr>
      <?php
      $j -= 1;
    } ?>
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
      var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text().trim();
      var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
      var colStep = table.find("tr:eq("+i+")").find("td:eq(10)").children().children('div').text();
      var colFile = table.find("tr:eq("+i+")").find("td:eq(11)").children('a:eq(0)').text();
      var colMemo = table.find("tr:eq("+i+")").find("td:eq(11)").children('a:eq(1)').text();
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
  var colStep = currow.find('td:eq(10)').children().children('div').text();
  var colFile = currow.find("td:eq(11)").children('a:eq(0)').text();
  var colMemo = currow.find("td:eq(11)").children('a:eq(1)').text();
  contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
  contractArray.push(contractArrayEle);
} else {
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());
  var colid = currow.find('td:eq(0)').children('input').val();
  var colStep = currow.find('td:eq(10)').children().children('div').text();
  var colFile = currow.find("td:eq(11)").children('a:eq(0)').text();
  var colMemo = currow.find("td:eq(11)").children('a:eq(1)').text();
  var dropReady = contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
  var index = contractArray.indexOf(dropReady);
  contractArray.splice(index, 1);
}
console.log(contractArray);
// console.log(typeof(contractArray[3]));
})



$(".numberComma").number(true);
</script>