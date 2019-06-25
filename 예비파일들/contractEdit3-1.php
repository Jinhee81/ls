<!-- 계약별 입금예정스케쥴화면, 데이터테이블 라이브러리로 본격 시작해봄
공급가액,세액을 다른셀에 하려다가안하기로 함 미리복사해놓음
 -->
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

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//계약아이디
settype($filtered_id, 'integer');

$sql = "
      select
          realContract.id,
          status,
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
          depositInAmount,
          depositInDate,
          depositOutAmount,
          depositOutDate,
          depositMoney,
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
      where realContract.id = {$filtered_id}
";
// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

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

?>

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

  .appi{
    color:#F7819F;
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
</style>

<!-- 제목섹션 -->
<section class="container">
  <!-- <div class="head pt-3 pb-3 pl-3 mb-5">
    <h1 class="font-weight-light">>>> 임대계약의 스케쥴 화면입니다!</h1>
  </div> -->


  <div class="jumbotron">
    <h1 class="display-4">>>임대 계약 상세 화면입니다!</h1>
    <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
    <!-- <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[고객정보]</b>에는 진행고객만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4"> -->
  </div>
</section>

<!-- 계약정보세션 -->
<section class="container">
    <div class="form-row mb-2">
      <div class="form-group col-md-4">
        <label class="mb-0">고객정보</label><br>
          <a href="/service/customer/m_c_edit.php?id=<?=$row[2]?>">
            <input type="text" class="form-control form-control-sm" name="" value="<?php if($row['etc']) {
              echo $cName.', '.$cContact.', ('.$row['etc'].')';
            } else {
              echo $cName.', '.$cContact;
            }?>" disabled>
          </a>
      </div>
      <div class="form-group col-md-4">
        <label class="mb-0">물건정보</label><br>
        <input type="text" class="form-control form-control-sm" value="<?=$row[12].','.$row[14].','.$row[16]?>" disabled>
      </div>
      <div class="form-group col-md-4">
        <label class="mb-0">기간정보</label><br>
        <input type="text" class="form-control form-control-sm" value="<?=$row['monthCount'].'개월, '.$row['startDate'].'~'.$row['endDate']?>" disabled>
      </div>
    </div>
    <div class="form-row mb-2">
      <div class="form-group col-md-6">
        <label class="mb-0">월이용료</label>
        <input type="text" class="form-control form-control-sm" name="" value="공급가액 <?=$row['mAmount']?>원, 세액 <?=$row['mvAmount']?>원, 합계 <?=$row['mtAmount']?>원" disabled>
      </div>
      <div class="form-group col-md-6">
        <label class="mb-0">기타정보</label>
        <input type="text" class="form-control form-control-sm" name="" value="계약일 <?=$row['contractDate']?>, 수납구분 <?=$row['payOrder']?>, 계약번호 <?=$row['0']?>" disabled>
      </div>
    </div>
</section>
<hr>

<!-- 청구스케쥴표섹션 -->
<section class="container-fluid">
    <div class="p-3 mb-2 text-dark border border-info rounded">
      <!-- <div class="d-flex justify-content-center bd-highlight mb-3"> -->
      <form class="" action="p_scheduleAdd.php" method="post">
      <div class="container form-row">
          <div class="form-group col-md-4">
                <button type="button" name="button" class="btn btn-outline-info btn-sm mobile">1개월 추가</button>
                <button type="button" name="button" class="btn btn-outline-info btn-sm mobile">n개월 추가</button>
                <button type="button" name="button" class="btn btn-outline-info btn-sm mobile">삭제</button>
          </div>
          <div class="form-group col-md-4">
            <div class="form-row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control form-control-sm dateType text-center" name="" value="" placeholder="입금예정일변경" id="groupExpecteDay">
              </div>
              <div class="form-group col-md-4">
                <select class="form-control form-control-sm" id="paykind">
                  <option value="">계좌</option>
                  <option value="">현금</option>
                  <option value="">카드</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group col-md-4 text-right">
              <button type="button" id="button1" class="btn btn-outline-info btn-sm">청구설정</button>
              <button type="button" id="button2" class="btn btn-outline-info btn-sm">청구취소</button>
              <button type="button" id="button3" class="btn btn-outline-info btn-sm mobile">일괄입금</button>
              <button type="button" id="button4" class="btn btn-outline-info btn-sm mobile">일괄입금취소</button>
          </div>
      </div>

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
              <td scope="col">입금예정일
                <!-- <input type="text" class="form-control form-control-sm text-center" name="" value="" placeholder="예정일변경"> 이거할려다가 안했다-->
              </td>
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
                      <!-- <?php if($row['executiveDate']) {
                        echo "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button>
                        <button type='button' class='btn btn-warning btn-sm mr-0 getExecuteBack'>입금취소</button>";
                      } else {
                        echo "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button>
                        <button type='button' class='btn btn-warning btn-sm mr-0 getExecuteBack'>청구취소</button>
                        <button type='button' class='btn btn-primary btn-sm getExecute'>입금완료</button>";
                      }?> -->
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
          </form>

        </table>
        <?php echo '5'; ?>
      </div>

    </div>
</section>


<hr>
<!-- 최하단 계약정보작성자보여주기세션 -->
<section>
    <small class="form-text text-muted text-center">계약번호[<?=$row[0]?>] 계약상태[<?=$row['status']?>] 등록자명[<?=$row['32']?>] 등록일시[<?=$row['createTime']?>] 수정자명[<?=$row['35']?>] 수정일시[<?=$row['updateTime']?>] </small>
</section>


<!-- <script type="text/javascript" src="/js/dataTable.js"></script> -->
<script src="/js/jquery.number.min.js"></script>
<script>
    $(document).ready(function(){
      $('.modalAsk').on('click', function(){ //청구번호클릭하는거(모달클릭)

        var currow2 = $(this).closest('tr');
        var payNumber = currow2.find('td:eq(8)').children('p').children('u').text();
        console.log(payNumber);

          $.ajax({
            url: 'ajax_paySchedule2_payid.php',
            method: 'post',
            data: {payNumber : payNumber},
            success: function(data){
              $('.payid').html(data);
            }
          })

          $.ajax({
            url: 'ajax_paySchedule2_search.php',
            method: 'post',
            data: {payNumber : payNumber},
            success: function(data){
              $('.modal-body').html(data);
            }
          })

          $.ajax({
            url: 'ajax_paySchedule2_modalfooter.php',
            method: 'post',
            data: {payNumber : payNumber},
            success: function(data){
              $('.modal-footer').html(data);
            }
          })

      })





    })




    var table = $("#checkboxTestTbl");

    var expectedDayArray = [];

    $(":checkbox:first", table).click(function(){

        var allCnt = $(":checkbox:not(:first)", table).length;
        expectedDayArray = [];

        if($(":checkbox:first", table).is(":checked")){
          for (var i = 1; i <= allCnt; i++) {
            var expectedDayEle = [];
            expectedDayEle.push(i);
            expectedDayEle.push(table.find("tr:eq("+i+")").find("td:eq(6)").children('input').val());
            expectedDayArray.push(expectedDayEle);
          }
          console.log(expectedDayArray);
        } else {
          expectedDayArray = [];
          console.log(expectedDayArray);
        }
    })

    $('.table').on('click',':checkbox:not(:first)',function(){

      var expectedDayEle = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colexpectDate = currow.find('td:eq(6)').children('input').val();

      expectedDayEle.push(colOrder, colexpectDate);
      expectedDayArray.push(expectedDayEle);
      console.log(expectedDayArray);
    })

    $('.table').on('keyup', '.amountNumber:input[type="text"]', function(){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());

      // console.log(colOrder);

      var colmAmount = Number(currow.find('td:eq(4)').children('input:eq(0)').val());
      var colmvAmount = Number(currow.find('td:eq(4)').children('input:eq(1)').val());

      var colmtAmount = colmAmount + colmvAmount;
      currow.find('td:eq(5)').children('input').val(colmtAmount);
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

      var aa = 'payScheduleAdd';
      var bb = 'p_scheduleAdd.php';
      var cc = 'scheduleArray';
      var dd = 'contractId';
      var contractId = '<?=$filtered_id?>';

      if(expectedDayArray.length === 0){
        alert('한개 이상을 선택해야 청구가 됩니다.');
      } else if (expectedDayArray.length <= 72) {

        goCategoryPage(aa, bb, cc, paySchedule, dd, contractId);

        function goCategoryPage(a, b, c, d, e, f){
          var frm = formCreate(a, 'post', b,'contractId');
          frm = formInput(frm, c, d);
          frm = formInput(frm, e, f);
          formSubmit(frm);
        }

      }
    })





</script>


<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
