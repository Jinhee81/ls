<!-- 레이아웃을 변경해서 다시 만들어봄 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>임대계약상세</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_SESSION);
// print_r($_GET['id']);

$currentDate = date('Y-m-d');
// echo $currentDate;

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//계약번호
settype($filtered_id, 'integer');

$sql = "
      select
          realContract.id,
          customer.id,
          customer.name,
          customer.companyname,
          customer.div2,
          customer.div3,
          customer.contact1,
          customer.contact2,
          customer.contact3,
          customer.etc,
          building_id,
          (select bName from building where id=building_id),
          group_in_building_id,
          (select gName from group_in_building where id=group_in_building_id),
          r_g_in_building_id,
          (select rName from r_g_in_building where id=r_g_in_building_id),
          payOrder,
          monthCount,
          startDate,
          endDate,
          contractDate,
          mAmount,
          mvAmount,
          mtAmount,
          count2,
          endDate2,
          realContract.createTime,
          realContract.updateTime
      from
          realContract
      left join customer
          on realContract.customer_id = customer.id
      where realContract.id = {$filtered_id} and
            realContract.user_id = {$_SESSION['id']}
";
// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($result->num_rows === 0) {
  echo "<script>
          alert('세션에 포함된 계약이 아니어서 조회 불가합니다.');
          location.href = 'contract.php';
        </script>";
  error_log(mysqli_error($conn));
}

// print_r($row);
// print_r($_SESSION);

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

// $sql_period = "select count(*) from contractSchedule where realContract_id={$filtered_id}";
// // echo $sql_period;
// $result_period = mysqli_query($conn, $sql_period);
// $row_period = mysqli_fetch_array($result_period);
// // print_r($row_period);
//
// $sql_startDate = "select mStartDate from contractSchedule where realContract_id={$filtered_id} and ordered=1";
// // echo $sql_startDate;
// $result_startDate = mysqli_query($conn, $sql_startDate);
// $row_startDate = mysqli_fetch_array($result_startDate);
//
// $sql_endDate = "select mEndDate from contractSchedule where realContract_id={$filtered_id} and ordered={$row_period[0]}";
// // echo $sql_endDate;
// $result_endDate = mysqli_query($conn, $sql_endDate);
// $row_endDate = mysqli_fetch_array($result_endDate);
//

$original_period = [$row['monthCount'], $row['startDate'], $row['endDate']];
$edited_period = [$row['count2'], $row['startDate'], $row['endDate2']];

// print_r($edited_period);
// print_r($original_period);

$difference = count(array_diff_assoc($edited_period, $original_period));

$currentDate = date('Y-m-d');
// echo $currentDate;
if($currentDate >= $row['startDate'] && $currentDate <= $row['endDate2']){
  $status = '현재';
} elseif ($currentDate < $row['startDate']) {
  $status = '대기';
} elseif ($currentDate > $edited_period[2]) {
  $status = '종료';
}
// print_r($status);

$sql_step = "select count(*) from paySchedule2 where realContract_id={$filtered_id}";
$result_step = mysqli_query($conn, $sql_step);
$row_step = mysqli_fetch_array($result_step);

if((int)$row_step[0]===0){
  $step = "clear";
} else {
  $sql_step2 = "select getAmount from paySchedule2 where realContract_id={$filtered_id}";
  // echo $sql_step2;
  $result_step2 = mysqli_query($conn, $sql_step2);
  $getAmount = 0;
  while($row_step2 = mysqli_fetch_array($result_step2)){
    $getAmount = $getAmount + (int)$row_step2[0];
  }

  if($getAmount > 0) {
    $step = "입금";
  } else {
    $step = "청구";
  }
}
 ?>

<script type="text/javascript">
function fnUpload(){
  var extArray = new Array('hwp', 'xls', 'xlsx', 'doc', 'docx', 'pdf', 'jpg', 'gif', 'png', 'txt', 'ppt', 'pptx', 'tiff');
  var path = $('#upfile').val();
  console.log(path);

  if(path===""){
    alert('파일을 선택해주세요.');
    return false;
  }

  var pos = path.lastIndexOf(".");
  if(pos < 0){
    alert('확장자가 없는 파일입니다.');
    return false;
  }

  var ext = path.slice(path.lastIndexOf(".")+1).toLowerCase();
  var checkExt = false;
  for (var i = 0; i < extArray.length; i++) {
    if(ext === extArray[i]){
      checkExt = true;
      break;
    }
  }
  // console.log(ext, checkExt);

  if(checkExt === false){
    alert('업로드할수있는 확장자가 아닙니다.');
    return false;
  }

  var f = $('#uploadForm');
  f.submit();

}  //uploadBtn function closing}
</script>

<style>
  .head{
    /* border: solid; */
    background-color: #e9ecef;
    border-radius:.3rem;
  }
  #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
  select .selectCall{background-color: #A9D0F5;}

  @media (max-width: 990px) {
        .mobile {
          display: none;
        }
  }

  .green{
    color: #04B486;
  }

  .pink{
    color: #F7819F;
  }

  .sky{
    color:#2E9AFE;
  }

  .grey{
    color: #848484;
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="jumbotron">
            <h1 class="display-4">>>방계약 상세 화면입니다!
              <small>
            <?php
            if($status==="진행"){
              echo '<span class="badge badge-info text-wrap mr-1" style="width: 6rem;">진행</span>';
            } elseif($status==="대기"){
              echo '<span class="badge badge-warning text-wrap mr-1" style="width: 6rem;">대기</span>';
            } elseif($status==="종료"){
              echo '<span class="badge badge-danger text-wrap mr-1" style="width: 6rem;">종료</span>';
            }

            if($step === "clear"){
              echo "<span class='badge badge-warning text-light' style='width: 6rem;'>clear</span>";
            } elseif($step === "청구"){
              echo "<span class='badge badge-warning text-primary' style='width: 6rem;'>청구</span>";
            } elseif($step === "입금"){
              echo "<span class='badge badge-warning text-info' style='width: 6rem;'>입금</span>";
            }
            ?></small>
          </h1>



        <!-- <p class="lead">(1)계약기간은 최대 72개월(6년)까지 가능합니다.<small class="font-weight-light">(A고객의 A물건(예,201호)을 1개의 계약으로 봅니다. A고객이 B물건(예, 202호)으로 변경하면 새로운 계약을 생성합니다)</small><br>
        (2)청구설정후 입금처리가 가능합니다.<br>
        (3)<span class='badge badge-warning text-light'>clear</span> 단계(청구번호 생성된것 없음)에서만 계약수정, 삭제 가능합니다.<br>
        (4)상태는 (진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다(위 녹색상자안 글씨).<br>
        (5)단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다(위 노란색상자안 글씨).<br>
        </p> -->
        <!-- <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[고객정보]</b>에는 진행고객만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
        <hr class="my-4"> -->
        <a class="btn btn-secondary" href="contract.php" role="button">계약리스트 화면으로</a>
        <a class="btn btn-secondary" href="/service/account/deposit.php" role="button">보증금리스트 화면으로</a>
        <a href="contract_add1_edit.php?id=<?=$filtered_id?>">
          <button name="contractEdit" class="btn btn-warning">계약수정</button>
        </a>
        <button type="button" name="contractDelete" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="청구정보가 없어야 삭제가능합니다">삭제하기</button>
        <a class="btn btn-outline-primary btn-sm" href="contract_add2.php" role="button">계약등록</a>
        <a class="btn btn-outline-primary btn-sm" href="contractAll.php" role="button">일괄계약등록(1)</a>
        <a class="btn btn-outline-primary btn-sm" href="contractAll2.php" role="button">일괄계약등록(2)</a>
      </div>
      
    </div><!--왼쪽 그리드-->


    <div class="col">
      <section class="container-fluid">
          <div class="p-3 mb-2 text-dark border border-info rounded">
            <!-- <div class="d-flex justify-content-center bd-highlight mb-3"> -->
            <div class="form-row">
                <div class="form-group col-md-4">
                      <button type="button" id="button5" class="btn btn-outline-info btn-sm mobile">1개월 추가</button>
                      <button type="button" class="btn btn-outline-info btn-sm mobile" data-toggle="modal" data-target="#nAddBtn">n개월 추가</button>


                      <button type="button" id="button7" class="btn btn-outline-info btn-sm mobile">삭제</button>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control form-control-sm dateType text-center" name="" value="" placeholder="입금예정일변경" id="groupExpecteDay" data-toggle="tooltip" data-placement="left" title="체크된것의 입금예정일을 변경합니다">
                    </div>
                    <div class="form-group col-md-4">
                      <select class="form-control form-control-sm" id="paykind">
                        <option value="계좌">계좌</option>
                        <option value="현금">현금</option>
                        <option value="카드">카드</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                    <button type="button" id="button1" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="체크된것을 청구설정합니다">청구설정</button>
                    <button type="button" id="button2" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="체크된것의 청구정보를 취소합니다">청구취소</button>
                    <button type="button" id="button3" class="btn btn-outline-info btn-sm mobile" data-toggle="tooltip" data-placement="top" title="체크된것들을 입금처리합니다(청구번호가있어야 입금처리 가능해요.)">일괄입금</button>
                    <button type="button" id="button4" class="btn btn-outline-info btn-sm mobile" data-toggle="tooltip" data-placement="top" title="체크된것의 입금내역을 취소합니다">일괄입금취소</button>
                    <button type="button" id="button8" class="btn btn-outline-danger btn-sm mobile">입금완료보이기</button>
                </div>
            </div> <!--<div class="container form-row"> closing div-->
            <!-- <div class="">
              <span><small>순번 ~ , 0개선택</small></span>
            </div> -->
            <div class="table-responsive">
              <table class="table table-sm table-hover text-center" style="width:100%" cellspacing="0" id="checkboxTestTbl">
                <thead>
                  <tr class="table-info">
                    <td scope="col" class=""><input type="checkbox" id="checkAll"></td>
                    <td scope="col">순번</td>
                    <td scope="col">시작일/종료일</td>
                    <!-- <td scope="col">종료일</td> -->
                    <td scope="col">공급가액/세액</td>
                    <!-- <td scope="col" class="mobile">세액</td> -->
                    <td scope="col" class="">합계</td>
                    <td scope="col">입금예정일</td>
                    <td scope="col" class="">입금구분</td>
                    <td scope="col" class="">청구번호</td>
                    <td scope="col" class="">수납구분</td>
                    <td scope="col">입금일</td>
                    <td scope="col" class="">입금(미납)액</td>
                    <td scope="col" class="">연체일수/이자</td>
                    <!-- <td scope="col" class="">연체이자</td> -->
                    <td scope="col" class="mobile">증빙</td>
                  </tr>
                </thead>

                  <!-- <input type="hidden" name="contractId" value="<?=$row[0]?>"> -->
                  <tbody id="schedule">
      <?php
      $sql2 = "
              SELECT * FROM contractSchedule WHERE realContract_id = {$filtered_id}
              ";
      // echo $sql2;
      $result2 = mysqli_query($conn, $sql2);
      while($row2 = mysqli_fetch_array($result2)){
      ?>
      <tr>
        <td><input type='checkbox' class='checkSelect' name='chk[]' value='<?=$row2['idcontractSchedule']?>'>
        </td>
        <td><p class="font-weight-light"><?=$row2['ordered']?></p></td>
        <td>
          <label class="font-weight-light mb-0"><?=$row2['mStartDate']?></label><br>
          <label class="font-weight-light mb-0"><?=$row2['mEndDate']?></label>
        </td>
        <!-- <td><p class="font-weight-light"><?=$row2['mEndDate']?></p></td> -->
        <td><!--공급가액,세액-->
          <?php
          $sql3 = "Select * from contractSchedule left join paySchedule2
                  on contractSchedule.payId = paySchedule2.idpaySchedule2
                  where idcontractSchedule={$row2['idcontractSchedule']}";
          // echo $sql3;
          $result3 = mysqli_query($conn, $sql3);
          $row3 = mysqli_fetch_array($result3);
          // print_r($row3);
          if($row3['payId']){
            echo "<label class='text-right font-weight-light numberComma mb-0'>".$row3['mMamount']."</label><br><label class='text-right font-weight-light numberComma mb-0'>".$row3['mVmAmount']."</label>";
            // echo "exists";
          } else {
            echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber mb-0' name='mAmount' value='".$row2['mMamount']."' numberOnly><input type='text' size='10' class='form-control form-control-sm text-right amountNumber mb-0' name='mAmount' value='".$row2['mVmAmount']."' numberOnly>";
          }
          ?>
        </td>
        <td><!--합계-->
          <?php
          if($row3['payId']){
            echo "<label class='text-right font-weight-light numberComma'>".$row3['mTmAmount']."</label>";
            // echo "exists";
          } else {
            echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$row2['mTmAmount']."' numberOnly>";
          }
          ?>
        </td>
        <td><!--입금예정일-->
         <?php
         if($row3['payId']){
           echo "<p class='text-center font-weight-light'>".$row3['pExpectedDate']."</p>";
           // echo "exists";
         } else {
           echo "<input type='text' size='10' class='form-control form-control-sm text-center dateType' name='expecteDay' value='".$row2['mExpectedDate']."'>";
         }
         ?>
        </td>
        <td><!--입금구분 계좌/현금/카드-->
          <?php
          if($row3['payId']){
            echo "<p class='text-center'>".$row3['payKind']."</p>";
          }
          ?>
        </td>
        <td><!--청구번호-->
          <?php
          // var_dump($row3['payIdOrder']);
          if($row3['payId'] && $row3['payIdOrder']==='0'){
            echo "<p class='text-primary modalAsk font-weight-light' data-toggle='modal' data-target='#pPay'><u>".$row3['payId']."</u></p>";
          }
          ?>
        </td>

        <td><!--수납구분 getOrNot, 완납, 완납(연체), 미납, 입금대기-->
          <?php
          if($row3['payId'] && $row3['payIdOrder']==='0'){

            $executiveDate = new DateTime($row3['executiveDate']);
            $expectedDate = new DateTime($row3['pExpectedDate']);
            $currentDateDate = new DateTime($currentDate);

            if($row3['executiveDate']) {
                $notGetDayCount = date_diff($executiveDate, $expectedDate);
                // $notGetDayCount = ($executiveDate - $expectedDate);
                // var_dump($notGetDayCount->invert);
                if(($notGetDayCount->invert) === 1) {
                  echo "<p class='text-center green'>완납(연체)</p>";
                } else {
                  echo "<p class='text-center green'>완납</p>";
                }
            } else {
              // $notGetDayCount = ($currentDateDate - $expectedDate);
              $notGetDayCount = date_diff($currentDateDate, $expectedDate);
              // var_dump($notGetDayCount->invert);
              if(($notGetDayCount->invert) === 1) {
                echo "<p class='text-center pink'>미납</p>";
              } else {
                echo "<p class='text-center sky'>입금대기</p>";
              }
            }
          }
          ?>
        </td>
        <td><!--입금일-->
          <?php
          if($row3['payId']){
            echo "<p class='text-center font-weight-light green'>".$row3['executiveDate']."</p>";
          }?>
        </td>
        <td><!--입금액,미납액-->
          <?php
          if($row3['payId'] && $row3['payIdOrder']==='0'){
              if($row3['executiveDate']) {
                echo "<p class='text-center numberComma font-weight-light green'>".$row3['getAmount']."</p>";
              } else {
                if($row3['pExpectedDate'] >= $currentDate){
                  echo "<p class='text-center numberComma font-weight-light sky'>"."&#40;".$row3['ptAmount'].")"."</p>";
                } else {
                  echo "<p class='text-center numberComma font-weight-light pink'>"."&#40;".$row3['ptAmount'].")"."</p>";
                }
              }
          }
          ?>
        </td>
        <td><!--연체일수-->
          <?php
          if($row3['payId'] && $row3['payIdOrder']==='0'){
            if($row3['executiveDate']) {
              if($row3['executiveDate'] <= $row3['pExpectedDate']) {
                echo "<label class='text-center font-weight-light green mb-0'>0</label><br>";
              } else {
                $notGetDayCount = date_diff($executiveDate, $expectedDate);
                echo "<label class='text-center numberComma font-weight-light green mb-0'>";echo $notGetDayCount->days."</label><br>";
              }
            } else {
              if($row3['pExpectedDate'] >= $currentDate) {
                echo "<label class='text-center font-weight-light sky mb-0'>0</label><br>";
              } else {
                $notGetDayCount = date_diff($currentDateDate, $expectedDate);
                echo "<label class='text-center numberComma font-weight-light pink mb-0'>";echo $notGetDayCount->days."</label><br>";
              }
            }
          }
          ?><!--연체일수-->
          <?php
          if($row3['payId'] && $row3['payIdOrder']==='0'){
            if($row3['executiveDate']) {
              if($row3['executiveDate'] <= $row3['pExpectedDate']) {
                echo "<p class='text-center font-weight-light green mb-0'>0</p>";
              } else {
                $notGetDayCountAmount = $row3['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
                echo "<p class='text-center numberComma font-weight-light green mb-0'>".(int)$notGetDayCountAmount."</p>";
              }
            } else {
              if($row3['pExpectedDate'] >= $currentDate) {
                echo "<p class='text-center font-weight-light sky mb-0'>0</p>";
              } else {
                $notGetDayCountAmount = $row3['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
                echo "<p class='text-center numberComma font-weight-light pink mb-0'>".(int)$notGetDayCountAmount."</p>";
              }
            }
          }
          ?><!--연체이자-->
        </td>
        <td>

        </td><!--증빙-->
      </tr>
      <?php } ?>
                  </tbody>

              </table>
            </div>

          </div>
      </section>
    </div>

  </div>
</div>
