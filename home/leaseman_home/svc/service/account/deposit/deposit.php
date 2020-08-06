<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php";
?>

<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">보증금조회 화면입니다!</h2>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>


!-- 조회조건 -->
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <form>
      <div class="row justify-content-md-center">
        <table>
          <tr>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="dateDiv">
                <option value="startDate">시작일자</option>
                <option value="endDate">종료일자</option>
                <option value="contractDate">계약일자</option>
                <option value="registerDate">등록일자</option>
              </select><!--codi1-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="periodDiv">
                <option value="allDate">--</option>
                <option value="nowMonth">당월</option>
                <option value="pastMonth">전월</option>
                <option value="nextMonth">익월</option>
                <option value="1pastMonth">1개월전</option>
                <option value="nowYear">당년</option>
              </select><!--codi2-->
            </td>
            <td width="8%">
              <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType"><!--codi3-->
            </td>
            <td width="1%">~</td>
            <td width="8%">
              <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType"><!--codi4-->
            </td>
            <td width="5%">
              <select class="form-control form-control-sm selectCall" name="progress">
                <option value="pAll">전체</option>
                <option value="pIng" selected>현재</option>
                <option value="pEnd">종료</option>
                <option value="pWaiting">대기</option>
              </select><!--codi5-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!--building-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="group">
                <option value="groupAll">그룹전체</option>
              </select><!--group-->
            </td>
            <td width="8%">
              <select class="form-control form-control-sm selectCall" name="etcCondi">
                <option value="customer">성명/사업자명</option>
                <option value="contact">연락처</option>
                <option value="contractId">계약번호</option>
                <option value="roomId">방번호</option>
              </select><!--codi8-->
            </td>
            <td width="12%">
              <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</section>

<!-- 표내용 -->
<section class="container">
  <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
    <thead>
      <tr class="table-secondary">
        <th class="mobile">
          <input type="checkbox" id="allselect">
        </th>
        <th class="">순번</th>
        <th class="">상태</th>
        <th class="">입주자</th>
        <th class="">연락처</th>
        <th class="">방번호</th>
        <th class="">임대료</th>
        <!-- <th scope="col" class="mobile">단계<i class="fas fa-sort"></i></th> -->
        <th scope="col" class="mobile">입금일</th>
        <th scope="col" class="mobile">입금액</th>
        <th scope="col" class="mobile">출금일</th>
        <th scope="col" class="mobile">출금액</th>
        <th scope="col">잔액</th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>


<!-- sql senction -->
<section id="allVals2">

</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>

<script>

$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $.ajax({
      url: 'ajax_depositLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

    $.ajax({
      url: 'ajax_depositAmount.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#depositTotal').html(data);
      }
    })
})

$('button[name="btnLoad"]').on('click', function(){
    $.ajax({
      url: 'ajax_depositLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

    $.ajax({
      url: 'ajax_depositAmount.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#depositTotal').html(data);
      }
    })
})

$('select[name="periodDiv"]').on('change', function(){

    var periodVal = $(this).val();
    // console.log(periodVal);
    if(periodVal === 'allDate'){
      $('input[name="fromDate"]').val("");
      $('input[name="toDate"]').val("");
    }
    if(periodVal === 'nowMonth'){
      var fromDate = yyyy + '-' + mm + '-01';
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }
    if(periodVal === 'pastMonth'){
      var pastMonth = Number(mm)-1;
      // console.log(pastMonth);
      var pastMonthDate = new Date(yyyy,pastMonth,0).getDate();
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-01';
      var toDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(toDate);
    }
    if(periodVal === '1pastMonth'){
      var pastMonth = Number(mm)-1;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }
    if(periodVal === '3pastMonth'){
      var pastMonth = Number(mm)-3;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }

}) ////select periodDiv function closing

</script>

</body>
</html>
