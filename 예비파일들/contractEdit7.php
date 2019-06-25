<!-- 지울예정임, 게약스케줄 쿼리에서 조금 차이가 있음-->
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
</style>

<!-- 제목섹션 -->
<section class="container">
  <!-- <div class="head pt-3 pb-3 pl-3 mb-5">
    <h1 class="font-weight-light">>>> 임대계약의 스케쥴 화면입니다!</h1>
  </div> -->


  <div class="jumbotron">
    <h1 class="display-4">>>임대 계약 스케쥴 화면입니다!</h1>
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
              <td scope="col">입금일</td>
              <td scope="col" class="">입금액</td>
              <td scope="col" class="">수납구분</td>
              <td scope="col" class="">미납액</td>
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
  <td><?=$row2['ordered']?></td>
  <td><?=$row2['mStartDate']?></td>
  <td><?=$row2['mEndDate']?></td>
  <td>
    <?php
    $sql3 = "Select * from paySchedule2 where contractId={$filtered_id}";
    // 계약스케줄번호로 조회하는걸로 변경예정인거
    echo $sql3;
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    // print_r($row3);
    $row3Array = explode(',', $row3['orderArray']);
    print_r($row3Array);
    if(in_array($row2['ordered'], $row3Array)){
      echo "<label class='text-right'>".$row2['mMamount']."<br>".$row2['mVmAmount']."</label>";
      // echo "exists";
    } else {
      echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$row2['mMamount']."' numberOnly><input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$row2['mVmAmount']."' numberOnly>";
    }
    ?>
  </td>
  <td>
    <?php
    if(in_array($row2['ordered'], $row3Array)){
      echo "<label class='text-right'>".$row2['mTmAmount']."</label>";
      // echo "exists";
    } else {
      echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$row2['mTmAmount']."' numberOnly>";
    }
    ?>
  </td>
  <td>
    <?php
    if(in_array($row2['ordered'], $row3Array)){
      echo "<label class='text-center'>".$row3['pExpectedDate']."</label>";
      // echo "exists";
    } else {
      echo "<input type='text' size='10' class='form-control form-control-sm text-center dateType' name='expecteDay' value='".$row2['mExpectedDate']."'>";
    }
    ?>
  </td>
  <td>
    <?php
    if(in_array($row2['ordered'], $row3Array)){
      echo "<label class='text-center'>".$row3['payKind']."</label>";
    }
    ?>
  </td>
  <td>
    <?php
    if(in_array($row2['ordered'], $row3Array)){
      echo "<label class='text-center'>".$row3['idpaySchedule2']."</label>";
    }
    ?>
  </td><!--청구번호-->
  <td></td><!--입금일-->
  <td></td><!--입금액-->
  <td>
    <?php
    if(in_array($row2['ordered'], $row3Array)){
      echo "<label class='text-center'>".$row3['getOrNot']."</label>";
    }
    ?>
  </td><!--수납구분-->
  <td></td><!--미납액-->
  <td></td><!--연체일수-->
  <td></td><!--연체이자-->
</tr>
<?php } ?>
            </tbody>
          </form>

        </table>
        <?php echo '3'; ?>
      </div>

    </div>
</section>


<hr>
<!-- 최하단 계약정보작성자보여주기세션 -->
<section>
    <small class="form-text text-muted text-center">계약번호[<?=$row[0]?>] 계약상태[<?=$row['status']?>] 등록자명[<?=$row['32']?>] 등록일시[<?=$row['createTime']?>] 수정자명[<?=$row['35']?>] 수정일시[<?=$row['updateTime']?>] </small>
</section>


<!-- <script type="text/javascript" src="/js/dataTable.js"></script> -->
<script>
    $(document).ready(function(){
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

      console.log(colOrder);

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
      console.log(paykind);

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
      console.log(paySchedule);

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
