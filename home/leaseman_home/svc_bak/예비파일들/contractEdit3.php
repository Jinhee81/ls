<!-- 이거엄청나게중요한 파일 -->
<!-- 계약별 입금예정스케쥴화면, 데이터테이블 라이브러리로 본격 시작해봄 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
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
          realContract.createTime,
          realContract.createPerson,
          (select damdangga_name from user where id=realContract.createPerson),
          realContract.updateTime,
          realContract.updatePerson,
          (select damdangga_name from user where id=realContract.updatePerson)
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

$sql_period = "select count(*) from contractSchedule where realContract_id={$filtered_id}";
// echo $sql_period;
$result_period = mysqli_query($conn, $sql_period);
$row_period = mysqli_fetch_array($result_period);
// print_r($row_period);

$sql_startDate = "select mStartDate from contractSchedule where realContract_id={$filtered_id} and ordered=1";
// echo $sql_startDate;
$result_startDate = mysqli_query($conn, $sql_startDate);
$row_startDate = mysqli_fetch_array($result_startDate);

$sql_endDate = "select mEndDate from contractSchedule where realContract_id={$filtered_id} and ordered={$row_period[0]}";
// echo $sql_endDate;
$result_endDate = mysqli_query($conn, $sql_endDate);
$row_endDate = mysqli_fetch_array($result_endDate);

$edited_period = [$row_period[0], $row_startDate[0], $row_endDate[0]];
$original_period = [$row['monthCount'], $row['startDate'], $row['endDate']];

// print_r($edited_period);
// print_r($original_period);

$difference = count(array_diff_assoc($edited_period, $original_period));

date_default_timezone_set('Asia/Seoul'); //이거있어야지 시간대가 맞게설정됨, 없으면 시간대가 안맞아짐
$currentDate = date('Y-m-d');
// echo $currentDate;
if($currentDate >= $row['startDate'] && $currentDate <= $edited_period[2]){
  $status = '진행';
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

<!-- 제목섹션 -->
<section class="container">
  <!-- <div class="head pt-3 pb-3 pl-3 mb-5">
    <h1 class="font-weight-light">>>> 임대계약의 스케쥴 화면입니다!</h1>
  </div> -->


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



    <p class="lead">(1)계약기간은 최대 72개월(6년)까지 가능합니다.<small class="font-weight-light">(A고객의 A물건(예,201호)을 1개의 계약으로 봅니다. A고객이 B물건(예, 202호)으로 변경하면 새로운 계약을 생성합니다)</small><br>
    (2)청구설정후 입금처리가 가능합니다.<br>
    (3)<span class='badge badge-warning text-light'>clear</span> 단계(청구번호 생성된것 없음)에서만 계약수정, 삭제 가능합니다.<br>
    (4)상태는 (진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다(위 녹색상자안 글씨).<br>
    (5)단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다(위 노란색상자안 글씨).<br>
    </p>
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
</section>

<!-- 계약정보세션 -->
<section class="container">
    <div class="form-row mb-2">
      <div class="form-group col-md-4">
        <label class="mb-0">고객정보</label><br>
          <a href="/service/customer/m_c_edit.php?id=<?=$row[1]?>">
            <input type="text" class="form-control form-control-sm" name="" style="color:#2E9AFE;" value="<?php if($row['etc']) {
              echo $cName.', '.$cContact.', ('.$row['etc'].')';
            } else {
              echo $cName.', '.$cContact;
            }?>" disabled>
          </a>
      </div>
      <div class="form-group col-md-4">
        <label class="mb-0">물건정보</label><br>
        <input type="text" class="form-control form-control-sm" value="<?=$row[11].','.$row[13].','.$row[15]?>" disabled>
      </div>
      <div class="form-group col-md-4">
        <label class="mb-0">기간정보
          <?php if(!($difference===0)) {
            echo "<span class='font-weight-light sky'>[최초 ".$row['monthCount']."개월, " .$row['startDate']."~".$row['endDate']."]</span>";
          }?>
        </label><br>
        <input type="text" class="form-control form-control-sm" value="<?=$row_period[0].'개월, '.$row_startDate[0].'~'.$row_endDate[0]?>" disabled>
      </div>
    </div>
    <div class="form-row mb-2">
      <div class="form-group col-md-5">
        <label class="mb-0">월이용료</label>
        <input type="text" class="form-control form-control-sm" name="" value="공급가액 <?=$row['mAmount']?>원, 세액 <?=$row['mvAmount']?>원, 합계 <?=$row['mtAmount']?>원" disabled>
      </div>
      <div class="form-group col-md-5">
        <label class="mb-0">기타정보</label>
        <input type="text" class="form-control form-control-sm" name="" value="최초 계약일 <?=$row['contractDate']?>, 수납구분 <?=$row['payOrder']?>" disabled>
      </div>
      <div class="form-group col-md-2">
        <label class="mb-0">상태&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;단계</label><br>
          <?php
          if($status==="진행"){
            echo '<div class="badge badge-info text-wrap mr-1" style="width: 3rem;">진행</div>';
          } elseif($status==="대기"){
            echo '<div class="badge badge-warning text-wrap mr-1" style="width: 3rem;">대기</div>';
          } elseif($status==="종료"){
            echo '<div class="badge badge-danger text-wrap mr-1" style="width: 3rem;">종료</div>';
          }

          if($step === "clear"){
            echo "<div class='badge badge-warning text-light' style='width: 3rem;'>clear</div>";
          } elseif($step === "청구"){
            echo "<div class='badge badge-warning text-primary' style='width: 3rem;'>청구</div>";
          } elseif($step === "입금"){
            echo "<div class='badge badge-warning text-info' style='width: 3rem;'>입금</div>";
          }
          ?>
      </div>
    </div>
</section>
<hr>

<!-- 청구스케쥴표섹션 -->
<section class="container-fluid">
    <div class="p-3 mb-2 text-dark border border-info rounded">
      <!-- <div class="d-flex justify-content-center bd-highlight mb-3"> -->
      <div class="form-row">
          <div class="form-group col-md-4">
                <button type="button" id="button5" class="btn btn-outline-info btn-sm mobile">1개월 추가</button>
                <button type="button" class="btn btn-outline-info btn-sm mobile" data-toggle="modal" data-target="#nAddBtn">n개월 추가</button>

<!-- 모달시작============================================================== -->
<div class="modal fade bd-example-modal-sm" id="nAddBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">n개월 추가</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>추가개월수</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right" name="addMonth" value="" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>공급가액</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount1" value="<?=$row['mAmount']?>" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>세액</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount2" value="<?=$row['mvAmount']?>" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>합계</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount3" value="<?=$row['mtAmount']?>" numberOnly required disabled>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" id="button6">추가하기</button>
      </div>
    </div>
  </div>
</div>
<!-- 모달끝================================================================== -->
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
              <button type="button" id="button8" class="btn btn-outline-danger btn-sm mobile">입금완료숨기기</button>
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
              <td scope="col">시작일</td>
              <td scope="col">종료일</td>
              <td scope="col">공급가액/세액</td>
              <!-- <td scope="col" class="mobile">세액</td> -->
              <td scope="col" class="">합계</td>
              <td scope="col">입금예정일</td>
              <td scope="col" class="">입금구분</td>
              <td scope="col" class="">청구번호</td>
              <td scope="col" class="">수납구분</td>
              <td scope="col">입금일</td>
              <td scope="col" class="">입금(미납)액</td>
              <td scope="col" class="">연체일수</td>
              <td scope="col" class="">연체이자</td>
              <!-- <td scope="col" class="mobile">세금계산서</td> -->
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
  <td><p class="font-weight-light"><?=$row2['mStartDate']?></p></td>
  <td><p class="font-weight-light"><?=$row2['mEndDate']?></p></td>
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
      echo "<label class='text-right font-weight-light numberComma'>".$row3['mMamount']."</label><br><label class='text-right font-weight-light numberComma'>".$row3['mVmAmount']."</label>";
      // echo "exists";
    } else {
      echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$row2['mMamount']."' numberOnly><input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$row2['mVmAmount']."' numberOnly>";
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
    <?php
    if($row3['payId']){
      // echo "<script>document.write(payNumber);</script>";
      // echo $payNumber;
      $sql4 = "select * from paySchedule2 where idpaySchedule2={$row3['payId']}";
      // echo $sql4;
      $result4 = mysqli_query($conn, $sql4);
      $row4 = mysqli_fetch_array($result4) ?>
        <!-- 모달시작================================================================ -->

              <div class="modal fade" id="pPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">

                  <div class="modal-content">
                    <!-- <input type="hidden" name="payid" value=""> -->

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

              <!-- 모달끝================================================================== -->
    <?php
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
          echo "<p class='text-center font-weight-light green'>0</p>";
        } else {
          $notGetDayCount = date_diff($executiveDate, $expectedDate);
          echo "<p class='text-center numberComma font-weight-light green'>";echo $notGetDayCount->days."</p>";
        }
      } else {
        if($row3['pExpectedDate'] >= $currentDate) {
          echo "<p class='text-center font-weight-light sky'>0</p>";
        } else {
          $notGetDayCount = date_diff($currentDateDate, $expectedDate);
          echo "<p class='text-center numberComma font-weight-light pink'>";echo $notGetDayCount->days."</p>";
        }
      }
    }
    ?>
  </td>
  <td><!--연체이자-->
    <?php
    if($row3['payId'] && $row3['payIdOrder']==='0'){
      if($row3['executiveDate']) {
        if($row3['executiveDate'] <= $row3['pExpectedDate']) {
          echo "<p class='text-center font-weight-light green'>0</p>";
        } else {
          $notGetDayCountAmount = $row3['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
          echo "<p class='text-center numberComma font-weight-light green'>".(int)$notGetDayCountAmount."</p>";
        }
      } else {
        if($row3['pExpectedDate'] >= $currentDate) {
          echo "<p class='text-center font-weight-light sky'>0</p>";
        } else {
          $notGetDayCountAmount = $row3['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
          echo "<p class='text-center numberComma font-weight-light pink'>".(int)$notGetDayCountAmount."</p>";
        }
      }
    }
    ?>
  </td>
</tr>
<?php } ?>
            </tbody>

        </table>
      </div>

    </div>
</section>

<hr>
<section class="container-fluid"> <!--보증금등록 섹션-->
<?php
$sql_deposit = "
      select
            *
      from realContract_deposit where realContract_id={$filtered_id}";
// echo $sql_deposit;
$result_deposit = mysqli_query($conn, $sql_deposit);
$row_deposit = mysqli_fetch_array($result_deposit);
?>
    <div class="p-3 mb-2 text-dark border border-info rounded">
        <div class="container">
        <h3>보증금 현황<span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info btn-sm" name="depositSaveBtn">저장</button></span></h3>
            <div class="form-row d-flex justify-content-center">
                <div class="form-group col-md-2">
                  <label class="mb-0 text-center">입금일</label><br>
                  <input type="text" name="depositInDate" class="form-control form-control-sm dateType text-center" value="<?=$row_deposit['inDate']?>">
                </div>
                <div class="form-group col-md-2">
                  <label class="mb-0 text-center">입금액</label><br>
                  <input type="text" name ="depositInAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['inMoney']?>" numberOnly>
                </div>
                <div class="form-group col-md-2">
                  <label class="mb-0 text-center">출금일</label><br>
                  <input type="text" name="depositOutDate" class="form-control form-control-sm dateType text-center" value="<?=$row_deposit['outDate']?>">
                </div>
                <div class="form-group col-md-2">
                  <label class="mb-0 text-center">출금액</label><br>
                  <input type="text" name="depositOutAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['outMoney']?>" numberOnly>
                </div>
                <div class="form-group col-md-2">
                  <label class="mb-0 text-center">잔액</label><br>
                  <input type="text" name="depositMoney" class="form-control form-control-sm amountNumber text-center green" value="<?=$row_deposit['remainMoney']?>" disabled numberOnly>
                </div>
                <div class="form-group col-md-2">
                  <label class="mb-0 text-center">저장일시</label><br>
                  <input type="text" class="form-control form-control-sm text-center" value="<?=$row_deposit['saved']?>" disabled>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>
<section class="container-fluid"> <!--파일등록 섹션-->
  <div class="p-3 mb-2 text-dark border border-secondary rounded">
        <!-- <div class="row justify-content-md-center">
              <div class="col col-sm-5">
                <form action="p_file_upload.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                        <label class="custom-file-label" for="inputGroupFile02">파일선택</label>
                      </div>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon02">등록</button>
                      </div>
                    </div>
                </form>
              </div>
          </div> -->

          <form name="uploadForm" id="uploadForm" method="post" action="p_file_upload.php" enctype="multipart/form-data">
            <label for="">첨부파일</label>
            <input type="file" name="upfile" id="upfile">
            <input type="hidden" name="contract" value="<?=$filtered_id?>">
            <input type="button" name="uploadBtn" value="업로드" onclick="fnUpload()">
          </form>
          <div class="container mt-3">
            <table class="table table-sm table-hover text-center">
              <tr class="table-secondary">
                <td>순번</td>
                <td>파일명</td>
                <td>용량</td>
                <td>등록일시</td>
                <td>관리</td>
              </tr>
              <?php
              $sql_file_c = "
                select count(*) FROM upload_file
                WHERE
                  realContract_id = {$filtered_id}";
              $result_file_c = mysqli_query($conn, $sql_file_c);
              $row_file_c = mysqli_fetch_array($result_file_c);
              // print_r($row_file_c);
              if((int)$row_file_c[0] === 0){
                echo "<tr><td colspan='5'>등록된 파일이 없습니다.</td></tr>";
              } else {
                $sql_file = "
                    select
                      @num := @num + 1 as num,
                      file_id,
                      name_orig,
                      size,
                      reg_time
                    FROM
                      (select @num := 0)a,
                      upload_file
                    WHERE
                      realContract_id = {$filtered_id}
                    ORDER BY
                      reg_time asc";
                // echo $sql_file;
                $result_file = mysqli_query($conn, $sql_file);
                while($row_file = mysqli_fetch_array($result_file)){
                  ?>
              <tr>
                    <td>
                      <?=$row_file['num']?>
                      <input type="hidden" name="fileid" value="<?=$row_file['file_id']?>">
                    </td>
                    <td>
                      <a href="download.php?file_id=<?=$row_file['file_id']?>" target="_blank"><?=$row_file['name_orig']?></a>
                    </td>
                    <td>
                      <?php
                      if($row_file['size'] >= 1073741824){
                        $bytes = number_format($row_file['size'] / 1073741824, 2) . ' GB';
                      } elseif($row_file['size'] >= 1048576){
                        $bytes = number_format($row_file['size'] / 1048576, 2) . ' MB';
                      } elseif($row_file['size'] >= 1024){
                        $bytes = number_format($row_file['size'] / 1024, 2) . ' kB';
                      } elseif($row_file['size'] > 1){
                        $bytes = $row_file['size'] . ' bytes';
                      } elseif($row_file['size'] == 1){
                        $bytes = $row_file['size'] . ' byte';
                      }
                      echo $bytes;
                       ?>
                    </td>
                    <td><?=$row_file['reg_time']?></td>
                    <td>
                      <button type="submit" name="fileDelete" class="btn btn-default grey">
                        <i class='far fa-trash-alt'></i>
                      </button>
                    </td>
                    <?php
                  }?>
                </tr>
                <?php
              }?>
            </table>
            <small>(1)파일등록할수 있는 확장자는 'hwp', 'xls', 'xlsx', 'doc', 'docx', 'pdf', 'jpg', 'gif', 'png', 'txt', 'ppt', 'pptx', 'tiff'입니다. <br>
              (2)파일은 5MB까지만 업로드 가능합니다.<br>
            </small>
          </div>
  </div>
</section>

<hr>
<section class="container-fluid"> <!--메모입력 섹션-->
  <div class="p-3 mb-2 text-dark border border-secondary rounded">
        <div class="container">
              <div class="form-row">
                    <div class="col col-sm-2">
                      <input type="text" class="form-control form-control-sm text-center" id="memoInputer" value="<?=$_SESSION['damdangga_name']?>">
                    </div>
                    <div class="col col-sm-8">
                      <input type="text" class="form-control form-control-sm text-center" id="memoContent" value="" placeholder="계약의 메모를 입력하세요.">
                    </div>
                    <div class="col col-sm-2">
                      <button type="button" id="memoButton" class="btn btn-outline-secondary btn-sm btn-block">등록</button>
                    </div>
              </div>
        </div>
        <div class="container mt-3">
            <table class="table table-sm table-hover text-center">
                  <tr class="table-secondary">
                        <td style="width:5%">순번</td>
                        <td style="width:10%">작성자</td>
                        <td style="width:35%">내용</td>
                        <td style="width:20%">등록일시</td>
                        <td style="width:20%">수정일시</td>
                        <td style="width:10%">관리</td>
                  </tr>
<?php
$sql_memoC = "select count(*) from realContract_memo where realContract_id={$filtered_id}";
// echo $sql_memoS;
$result_memoC = mysqli_query($conn, $sql_memoC);
$row_memoC = mysqli_fetch_array($result_memoC);
if((int)$row_memoC[0]===0){
  echo "<tr><td colspan='6'>등록된 메모가 없습니다.</td></tr>";
}
// print_r($row_memoC[0]);

if((int)$row_memoC[0]>0) {
  $sql_memoS = "select
                  @num := @num + 1 as num,
                  idrealContract_memo,
                  memoCreator,
                  memoContent,
                  created,
                  updated
                from
                  (select @num :=0)a,
                  realContract_memo
                where realContract_id={$filtered_id}
                order by
                  num asc";
  // echo $sql_memoS;
  $result_memoS = mysqli_query($conn, $sql_memoS);
  while($row_memoS=mysqli_fetch_array($result_memoS)) {
?>
<tr>
   <td>
     <label class="grey"><?=$row_memoS['num']?></label>
     <input type="hidden" name="memoid" value="<?=$row_memoS['idrealContract_memo']?>">
   </td>
   <td><input class="form-control form-control-sm text-center" name="memoCreator" value="<?=$row_memoS['memoCreator']?>" disabled></td>
   <td><input class="form-control form-control-sm text-center" name="memoContent" value="<?=$row_memoS['memoContent']?>" disabled></td>
   <td><label class="grey"><?=$row_memoS['created']?></label></td>
   <td><label class="grey"><?=$row_memoS['updated']?></label></td>
   <td>
     <button type="submit" name="memoEdit" class="btn btn-default grey">
       <i class='far fa-edit'></i>
     </button>
     <button type="submit" name="memoDelete" class="btn btn-default grey">
       <i class='far fa-trash-alt'></i>
     </button>
   </td>
</tr>
<?php }}?>
            </table>
        </div>
  </div>
</section>

<hr>
<!-- 최하단 계약정보작성자보여주기세션 -->
<section>
    <small class="form-text text-muted text-center">계약번호[<?=$row[0]?>] 등록자명[<?=$row['26']?>] 등록일시[<?=$row['createTime']?>] 수정자명[<?=$row['29']?>] 수정일시[<?=$row['updateTime']?>] </small>
</section>

<hr>
<!-- 버튼모음 섹션 -->
<section>
  <div class="d-flex justify-content-center">
    <a class="btn btn-secondary mr-1" href="contract.php" role="button">계약리스트 화면으로</a>
    <a class="btn btn-outline-secondary mr-1" href="contractAll.php" role="button">일괄계약등록</a>
    <a class="btn btn-outline-secondary mr-1" href="contract_add2.php" role="button">계약등록</a>
  </div>

</section>

<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>
<script>

var allexecutiveDateHide = true; //입금완료숨기기버튼

$(document).ready(function(){
  var step = '<?=$step?>';
  if(step ==! 'clear'){
    $('button[name="contractEdit"]').attr('disabled', true);
    $('button[name="contractDelete"]').attr('disabled', true);
  }

  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })


  $('.modalAsk').on('click', function(){ //청구번호클릭하는거(모달클릭)

    var currow2 = $(this).closest('tr');
    var payNumber = currow2.find('td:eq(8)').children('p').children('u').text();
    // console.log(payNumber);
    var filtered_id = '<?=$filtered_id?>';
    // console.log(filtered_id);

      $.ajax({
        url: 'ajax_paySchedule2_payid.php',
        method: 'post',
        data: {payNumber : payNumber, filtered_id:filtered_id},
        success: function(data){
          $('.payid').html(data);
        }
      })

      $.ajax({
        url: 'ajax_paySchedule2_search.php',
        method: 'post',
        data: {payNumber : payNumber, filtered_id:filtered_id},
        success: function(data){
          $('.modal-body').html(data);
        }
      })

      $.ajax({
        url: 'ajax_paySchedule2_modalfooter.php',
        method: 'post',
        data: {payNumber : payNumber, filtered_id:filtered_id},
        success: function(data){
          $('.modal-footer').html(data);
        }
      })
  }) //청구번호클릭하는거(모달클릭) closing}

  var allCnt = $(":checkbox:not(:first)", table).length;

  if(allexecutiveDateHide == false){
    for (var i = 1; i <= allCnt; i++) {
      var executiveDateIs = table.find("tr:eq("+i+")").children("td:eq(10)").children('p').text();
      console.log(executiveDateIs);
      if(executiveDateIs){
        table.find("tr:eq("+i+")").css('display', 'none');
      }
    }
    $('#button8').text('입금완료보이기');
    allexecutiveDateHide = true;
  } else {
    for (var i = 1; i <= allCnt; i++) {
      var executiveDateIs = table.find("tr:eq("+i+")").find("td:eq(10)").children('p').text();
      if(executiveDateIs){
        table.find("tr:eq("+i+")").css('display', '');
      }
    }
    $('#button8').text('입금완료숨기기');
    allexecutiveDateHide = false;
  }

  $(".amountNumber").click(function(){
    $(this).select();
  });

  $("input:text[numberOnly]").number(true);

  $(".numberComma").number(true);

  var tbl = $("#checkboxTestTbl");

  // 테이블 헤더에 있는 checkbox 클릭시
  $(":checkbox:first", tbl).change(function(){
    if($(":checkbox:first", tbl).is(":checked")){
      $(":checkbox", tbl).prop('checked',true);
      $(":checkbox").parent().parent().addClass("selected");
    } else {
      $(":checkbox", tbl).prop('checked',false);
      $(":checkbox").parent().parent().removeClass("selected");
    }
  })
  // 헤더에 있는 체크박스외 다른 체크박스 클릭시
  $(":checkbox:not(:first)", tbl).change(function(){
    var allCnt = $(":checkbox:not(:first)", tbl).length;
    var checkedCnt = $(":checkbox:not(:first)", tbl).filter(":checked").length;
    if($(this).prop("checked")==true){
      $(this).parent().parent().addClass("selected");
    } else {
      $(this).parent().parent().removeClass("selected");
    }
    if( allCnt==checkedCnt ){
      $(":checkbox:first", tbl).prop("checked", true);
    }
  })

  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    // showOn: "button",
    buttonImage: "/img/calendar.svg",
    buttonImageOnly: false
  })

}) //document.ready function closing}



var step = '<?=$step?>';
// console.log(step);
if(step === 'clear'){
  $('button[name="contractEdit"]').attr('disabled', false);
  $('button[name="contractDelete"]').attr('disabled', false);
} else {
  $('button[name="contractEdit"]').attr('disabled', true);
  $('button[name="contractDelete"]').attr('disabled', true);
}


var table = $("#checkboxTestTbl");

var expectedDayArray = [];

$(":checkbox:first", table).click(function(){

    var allCnt = $(":checkbox:not(:first)", table).length;
    expectedDayArray = [];

    if($(":checkbox:first", table).is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var expectedDayEle = [];
        expectedDayEle.push(i);
        expectedDayEle.push(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());
        expectedDayEle.push(table.find("tr:eq("+i+")").find("td:eq(6)").children('input').val());
        expectedDayArray.push(expectedDayEle);
      }
      // console.log(expectedDayArray);
    } else {
      expectedDayArray = [];
      // console.log(expectedDayArray);
    }
})

// $('.table').on('click',$(':checkbox:not(:first).is(":checked")'),function()

$(":checkbox:not(:first)",table).click(function(){
  var expectedDayEle = [];

  if($(this).is(":checked")){
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colexpectDate = currow.find('td:eq(6)').children('input').val();
    expectedDayEle.push(colOrder, colid, colexpectDate);
    expectedDayArray.push(expectedDayEle);
    // console.log(expectedDayArray);
    // console.log('체크됨');
  } else {
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colexpectDate = currow.find('td:eq(6)').children('input').val();
    var dropReady = expectedDayEle.push(colOrder, colid, colexpectDate);
    // console.log(dropReady);
    // console.log('체크해제됨');
    var index = expectedDayArray.indexOf(dropReady);
    expectedDayArray.splice(index, 1);
    // console.log(expectedDayArray);
  }
})

$('.table').on('keyup', '.amountNumber:input[type="text"]', function(){
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());

  // console.log(colOrder);

  var colmAmount = Number(currow.find('td:eq(4)').children('input:eq(0)').val());
  var colmvAmount = Number(currow.find('td:eq(4)').children('input:eq(1)').val());

  var colmtAmount = colmAmount + colmvAmount;
  currow.find('td:eq(5)').children('input').val(colmtAmount);
  console.log(colmAmount);
})



$('#groupExpecteDay').change(function(){ //입금예정일 변경버튼 이벤트
  var expectedDayGroup = $('#groupExpecteDay').val();
  if(expectedDayArray.length >= 1) {
    for (var i in expectedDayArray) {
       table.find("tr:eq("+expectedDayArray[i][0]+")").find("td:eq(6)").children('input').val(expectedDayGroup);
      // console.log(expectedDayArray[i][0], a);
    }
  }
})

$('#button1').click(function(){ //청구설정버튼 클릭시
  var paykind = $('#paykind option:selected').text();
  // console.log(paykind);

  var paySchedule = [];

  for (var i = 0; i < expectedDayArray.length; i++) {
    table.find("tr:eq("+expectedDayArray[i][0]+")").find("td:eq(7)").text(paykind);
    // console.log(expectedDayArray[i][0], a);
    // 입금구분을 변경시키는 것
    var payScheduleEle = [];
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val()); //계약번호
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(1)').text()); //순번
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(2)').text()); //시작일
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(3)').text()); //종료일
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(4)').children('input:eq(0)').val()); //공급가액
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(4)').children('input:eq(1)').val()); //세액
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(5)').children('input:eq(0)').val()); //합계금액
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(6)').children('input:eq(0)').val()); //예정일
    payScheduleEle.push(table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(7)').text()); //입금구분

    paySchedule.push(payScheduleEle);
  }
  // console.log(paySchedule);

  var paySchedule11 = JSON.stringify(paySchedule);

  var aa = 'payScheduleAdd';
  var bb = 'p_payScheduleAdd.php';
  var cc = 'scheduleArray';
  var dd = 'contractId';
  var contractId = '<?=$filtered_id?>';

  if(expectedDayArray.length === 0){
    alert('한개 이상을 선택해야 청구가 됩니다.');
    return false;

  } else if (expectedDayArray.length <= 72) {

    goCategoryPage(aa, bb, cc, paySchedule11, dd, contractId);

    function goCategoryPage(a, b, c, d, e, f){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, c, d);
      frm = formInput(frm, e, f);
      formSubmit(frm);
    }

  }
})

$('#button2').click(function(){ //청구취소버튼 클릭시

  var contractScheduleArray = [];

  for (var i = 0; i < expectedDayArray.length; i++) {

    var csId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val();
    var csCheck = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(7)').text();
    // console.log(csCheck);

    if(csCheck ==!'계좌' || csCheck ==!'현금' || csCheck ==!'카드'){
      alert('청구설정된것만 청구취소가 가능합니다.');
      return false;
    }

    contractScheduleArray.push(csId, csCheck);
  }
  // console.log(contractScheduleArray);

  var aa = 'payScheduleDrop';
  var bb = 'p_payScheduleDropFor.php';
  var cc = 'scheduleArray';
  var dd = 'contractId';
  var contractId = '<?=$filtered_id?>';

  goCategoryPage(aa, bb, cc, contractScheduleArray, dd, contractId);

  function goCategoryPage(a, b, c, d, e, f){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, c, d);
    frm = formInput(frm, e, f);
    formSubmit(frm);
  }


})


$('#button3').click(function(){ //일괄입금버튼 클릭시

  var contractScheduleArray = [];

  // console.log(expectedDayArray);

  if(expectedDayArray.length===0){
    alert('청구설정된것을 선택해야 일괄입금처리가 가능합니다.');
    return false;
  }

  for (var i = 0; i < expectedDayArray.length; i++) {

    // var csId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val(); 계약스케줄을 가져오려다가 안가져옴, 왜냐면 필요가없음

    var psId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(8)').children('p').children('u').text();
    // console.log(psId); //제이쿼리로 트림을 하니 더 이상해져서 안하기로함

    if(psId.trim()===""){ //trim()이거를 안넣으니 빈문자열로 인식이 안되어서 이거넣음
      alert('청구번호가 존재해야 일괄입금처리가 가능합니다.');
      return false;
    }

    contractScheduleArray.push(psId);
  }
  // console.log(contractScheduleArray);

  var aa = 'getAmountInput';
  var bb = 'p_payScheduleGetAmountInputFor.php';
  var cc = 'scheduleArray';
  var dd = 'contractId';
  var contractId = '<?=$filtered_id?>';

  goCategoryPage(aa, bb, cc, contractScheduleArray, dd, contractId);

  function goCategoryPage(a, b, c, d, e, f){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, c, d);
    frm = formInput(frm, e, f);
    formSubmit(frm);
  }

})

$('#button4').click(function(){ //일괄입금취소버튼 클릭시

var contractScheduleArray = [];

for (var i = 0; i < expectedDayArray.length; i++) {

var psId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(8)').children('p').children('u').text();

if(psId===""){ //trim()이거를 안넣으니 빈문자열로 인식이 안되어서 이거넣음
  alert('청구번호가 존재해야 일괄입금취소 처리가 가능합니다.');
  return false;
}

contractScheduleArray.push(psId);
}
console.log(contractScheduleArray);

var aa = 'getAmountDrop';
var bb = 'p_payScheduleGetAmountCanselFor.php';
var cc = 'scheduleArray';
var dd = 'contractId';
var contractId = '<?=$filtered_id?>';

goCategoryPage(aa, bb, cc, contractScheduleArray, dd, contractId);

function goCategoryPage(a, b, c, d, e, f){
var frm = formCreate(a, 'post', b,'');
frm = formInput(frm, c, d);
frm = formInput(frm, e, f);
formSubmit(frm);
}

})

$('#button7').click(function(){ //삭제버튼 클릭시

var contractScheduleArray = [];
var allCnt = $(":checkbox:not(:first)", table).length;
// console.log(allCnt);

for (var i = 0; i < expectedDayArray.length; i++) {

contractScheduleArray[i] = [];

var csId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(0)').children('input').val();

var csOrder = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(1)').children('p').text();

var psId = table.find("tr:eq("+expectedDayArray[i][0]+")").find('td:eq(8)').children('p').children('u').text();

if(psId){
  alert('청구번호가 존재하면 삭제할수 없습니다.');
  return false;
}

contractScheduleArray[i].push(csId, csOrder, psId);
}
// console.log(contractScheduleArray);

var selectedOrderArray = [];
  for (var i = 0; i < expectedDayArray.length; i++) {
    selectedOrderArray.push(expectedDayArray[i][0]);
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
if(selectedOrderArray.length===0){
alert('한개 이상을 선택해야 삭제 가능합니다.');
return false;
}

if(!selectedOrderArray.includes(allCnt)){
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
    // console.log(regularOrderArray[i]);
    // console.log(selectedOrderArray[i]);
}

var contractScheduleIdArray = [];
for (var i = 0; i < contractScheduleArray.length; i++) {
contractScheduleIdArray.push(contractScheduleArray[i][0]);
}
// console.log(contractScheduleIdArray);

var aa = 'contractScheduleDrop';
var bb = 'p_contractScheduleDrop.php';
var contractId = '<?=$filtered_id?>';

goCategoryPage(aa, bb, contractId, contractScheduleIdArray);

function goCategoryPage(a, b, c, d){
var frm = formCreate(a, 'post', b,'');
frm = formInput(frm, 'contractId', c);
frm = formInput(frm, 'contractScheduleIdArray', d);
formSubmit(frm);
}
}) //삭제버튼 클릭시

$('#button5').click(function(){ //1개월추가 버튼클릭
var allCnt = $(":checkbox:not(:first)", table).length;
var aa = 'contractScheduleAppend';
var bb = 'p_contractScheduleAppend.php';
var contractId = '<?=$filtered_id?>';

if(allCnt===72){
alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
return false;
}

goCategoryPage(aa,bb,contractId);

function goCategoryPage(a,b,c){
var frm = formCreate(a, 'post', b,'');
frm = formInput(frm, 'contractId', c);
formSubmit(frm);
}
}); //1개월추가 버튼

$('#memoButton').click(function(){
    var memoInputer = $('#memoInputer').val();
    var memoContent = $('#memoContent').val();

    if(!memoContent){
        alert('내용을 입력해야 합니다.');
        return false;
    }
    // console.log(memoInputer, memoContent);

    var aa = 'memoAppend';
    var bb = 'p_memoAppend.php';
    var contractId = '<?=$filtered_id?>';

    goCategoryPage(aa,bb,contractId,memoInputer,memoContent);

    function goCategoryPage(a,b,c,d,e){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'memoInputer', d);
        frm = formInput(frm, 'memoContent', e);
        formSubmit(frm);
    }

});

$("button[name='memoEdit']").click(function(){
    var memoid = $(this).parent().parent().children().children('input:eq(0)');
    var memoCreator = $(this).parent().parent().children().children('input:eq(1)');
    var memoContent = $(this).parent().parent().children().children('input:eq(2)');
    // console.log(memoid, memoCreator, memoContent);
    var smallEditButton = "<button type='button' name='smallEditButton' class='btn btn-secondary btn-sm'>수정</button><button type='button' name='smallEditButtonCancel' class='btn btn-secondary btn-sm'>취소</button>";

    memoCreator.removeAttr("disabled");
    memoContent.removeAttr("disabled");
    $(this).hide();//편집버튼을 누르면 편집아이콘 및 휴지통아이콘은 없어져야한다.
    $(this).next().hide();
    memoContent.after(smallEditButton);
    // console.log('solmi');

    $("button[name='smallEditButton']").click(function(){
        // console.log('작은버튼클릭');
        var aa = 'memoEdit';
        var bb = 'p_memoEdit.php';
        var contractId = '<?=$filtered_id?>';
        var memoid = $(this).parent().parent().children().children('input:eq(0)').val();
        var memoCreator = $(this).parent().parent().children().children('input:eq(1)').val();
        var memoContent = $(this).parent().parent().children().children('input:eq(2)').val();
        // console.log(contractId, memoid, memoCreator, memoContent);

        goCategoryPage(aa,bb,contractId,memoid,memoCreator,memoContent);

        function goCategoryPage(a,b,c,d,e,f){
            var frm = formCreate(a, 'post', b,'');
            frm = formInput(frm, 'contractId', c);
            frm = formInput(frm, 'memoid', d);
            frm = formInput(frm, 'memoCreator', e);
            frm = formInput(frm, 'memoContent', f);
            formSubmit(frm);
        }
    });

    $("button[name='smallEditButtonCancel']").click(function(){
      // var memoid = $(this).parent().parent().children().children('input:eq(0)').val();
      // var memoCreator = $(this).parent().parent().children().children('input:eq(1)').val();
      // var memoContent = $(this).parent().parent().children().children('input:eq(2)').val();

      var memoid = $(this).parent().parent().children().children('input:eq(0)');
      var memoCreator = $(this).parent().parent().children().children('input:eq(1)');
      var memoContent = $(this).parent().parent().children().children('input:eq(2)');

      // console.log(memoid, memoCreator, memoContent);
      var smallsubmitButton = "<button type='submit' name='memoEdit' class='btn btn-default grey'><i class='far fa-edit'></i></button><button type='submit' name='memoDelete' class='btn btn-default grey'><i class='far fa-trash-alt'></i></button>";

      memoCreator.attr("disabled", true);
      memoContent.attr("disabled", true);
      $(this).hide();
      $(this).prev().hide();
      $(this).parent().parent().find('td:eq(5)').html(smallsubmitButton)
    });


});

$("button[name='memoDelete']").click(function(){
    var memoid = $(this).parent().parent().children().children('input:eq(0)').val();

    // console.log('메모삭제', memoid);

    var contractId = '<?=$filtered_id?>';
    var aa = 'memoDelete';
    var bb = 'p_memoDelete.php';
    //
    goCategoryPage(aa,bb,contractId,memoid);

    function goCategoryPage(a,b,c,d){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'memoid', d);
        formSubmit(frm);
    }
});

$("button[name='fileDelete']").click(function(){
    var fileid = $(this).parent().parent().children().children('input:eq(0)').val();

    // console.log('메모삭제', memoid);

    var contractId = '<?=$filtered_id?>';
    var aa = 'fileDelete';
    var bb = 'p_fileDelete.php';
    //
    goCategoryPage(aa,bb,contractId,fileid);

    function goCategoryPage(a,b,c,d){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'fileid', d);
        formSubmit(frm);
    }
});


$("input[name='depositInAmount']").on('keyup', function(){
    var depositInAmount = Number($(this).val());
    var depositOutAmount = Number($("input[name='depositOutAmount']").val());
    var depositMoney = depositInAmount - depositOutAmount;
    $("input[name='depositMoney']").val(depositMoney);
});

$("input[name='depositOutAmount']").on('keyup', function(){
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

    var contractId = '<?=$filtered_id?>';
    var aa = 'depositSave';
    var bb = 'p_depositSave.php';

    goCategoryPage(aa,bb,contractId,depositInDate,depositInAmount,depositOutDate,depositOutAmount,depositMoney);

    function goCategoryPage(a,b,c,d,e,f,g,h){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'depositInDate', d);
        frm = formInput(frm, 'depositInAmount', e);
        frm = formInput(frm, 'depositOutDate', f);
        frm = formInput(frm, 'depositOutAmount', g);
        frm = formInput(frm, 'depositMoney', h);
        formSubmit(frm);
    }
})

$("button[name='contractDelete']").on('click', function(){
  var contractId = '<?=$filtered_id?>';
  var memocount = '<?=$row_memoC[0]?>';
  var filecount = '<?=$row_file_c[0]?>';

  if(Number(memocount)>0){
    alert('메모를 삭제해야 계약삭제 가능합니다.');
    return false;
  }

  if(Number(filecount)>0){
    alert('파일을 삭제해야 계약삭제 가능합니다.');
    return false;
  }

  var aa = 'contractDelete';
  var bb = 'p_realContract_delete.php';

  var deleteCheck = confirm('정말 삭제하겠습니까?');
  if(deleteCheck){
    goCategoryPage(aa,bb,contractId);

    function goCategoryPage(a,b,c){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'contractId', c);
      formSubmit(frm);
    }
  }
})//메모개수와 파일개수가 0이어야 삭제가 됨

$("input[name='modalAmount1']").on('keyup', function(){
    var changeAmount1 = Number($(this).val());
    var changeAmount2 = Number($("input[name='modalAmount2']").val());
    var changeAmount3 = changeAmount1 + changeAmount2;
    $("input[name='modalAmount3']").val(changeAmount3);
});

$("input[name='modalAmount2']").on('keyup', function(){
    var changeAmount2 = Number($(this).val());
    var changeAmount1 = Number($("input[name='modalAmount1']").val());
    var changeAmount3 = changeAmount1 + changeAmount2;
    $("input[name='modalAmount3']").val(changeAmount3);
});

$('#button6').click(function(){ //n개월추가 버튼, 모달클릭으로 바뀜
    var allCnt = $(":checkbox:not(:first)", table).length;
    var addMonth = Number($("input[name='addMonth']").val());
    var changeAmount1 = $("input[name='modalAmount1']").val()
    var changeAmount2 = $("input[name='modalAmount2']").val()
    var changeAmount3 = $("input[name='modalAmount3']").val()


    if(Number(addMonth)+allCnt > 72){
        alert('최대계약기간은 72개월(6년)입니다. 더이상 기간연장은 불가합니다.');
        return false;
    }

    var aa = 'contractScheduleAppendM';
    var bb = 'p_contractScheduleAppendM.php';
    var contractId = '<?=$filtered_id?>';

    goCategoryPage(aa,bb,contractId,addMonth,changeAmount1,changeAmount2,changeAmount3);

    function goCategoryPage(a,b,c,d,e,f,g){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'addMonth', d);
        frm = formInput(frm, 'changeAmount1', e);
        frm = formInput(frm, 'changeAmount2', f);
        frm = formInput(frm, 'changeAmount3', g);
        formSubmit(frm);
    }
}); //n개월추가



$('#button8').on('click', function(){
  var allCnt = $(":checkbox:not(:first)", table).length;

  if(allexecutiveDateHide == false){
    for (var i = 1; i <= allCnt; i++) {
      var executiveDateIs = table.find("tr:eq("+i+")").children("td:eq(10)").children('p').text();
      console.log(executiveDateIs);
      if(executiveDateIs){
        table.find("tr:eq("+i+")").css('display', 'none');
      }
    }
    $('#button8').text('입금완료보이기');
    allexecutiveDateHide = true;
  } else {
    for (var i = 1; i <= allCnt; i++) {
      var executiveDateIs = table.find("tr:eq("+i+")").find("td:eq(10)").children('p').text();
      if(executiveDateIs){
        table.find("tr:eq("+i+")").css('display', '');
      }
    }
    $('#button8').text('입금완료숨기기');
    allexecutiveDateHide = false;
  }
})



</script>


<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
