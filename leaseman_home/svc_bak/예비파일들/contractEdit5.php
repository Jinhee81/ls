<!-- 계약별 입금예정스케쥴화면, 곧 지울예정 -->
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
      <div class="col">
        <label class="mb-0">고객정보</label><br>
          <a href="/service/customer/m_c_edit.php?id=<?=$row[2]?>">
            <input type="text" class="form-control form-control-sm" name="" value="<?php if($row['etc']) {
              echo $cName.', '.$cContact.', ('.$row['etc'].')';
            } else {
              echo $cName.', '.$cContact;
            }?>" disabled>
          </a>
      </div>
      <div class="col">
        <label class="mb-0">물건정보</label><br>
        <input type="text" class="form-control form-control-sm" value="<?=$row[12].','.$row[14].','.$row[16]?>" disabled>
      </div>
      <div class="col">
        <label class="mb-0">기간정보</label><br>
        <input type="text" class="form-control form-control-sm" value="<?=$row['monthCount'].'개월, '.$row['startDate'].'~'.$row['endDate']?>" disabled>
      </div>
    </div>
    <div class="form-row mb-2">
      <div class="col">
        <label class="mb-0">월이용료</label>
        <input type="text" class="form-control form-control-sm" name="" value="공급가액 <?=$row['mAmount']?>원, 세액 <?=$row['mvAmount']?>원, 합계 <?=$row['mtAmount']?>원" disabled>
      </div>
      <div class="col">
        <label class="mb-0">기타정보</label>
        <input type="text" class="form-control form-control-sm" name="" value="계약일 <?=$row['contractDate']?>, 수납구분 <?=$row['payOrder']?>, 계약번호 <?=$row['0']?>" disabled>
      </div>
    </div>
</section>
<hr>

<!-- 청구스케쥴표섹션 -->
<section class="container-fluid">
    <div class="p-3 mb-2 text-dark border border-info rounded">
      <div class="d-flex justify-content-center bd-highlight mb-3">
          <button type="button" name="button" class="btn btn-outline-info btn-sm mr-1">추가</button>
          <button type="button" name="button" class="btn btn-outline-info btn-sm mr-3">삭제</button>
          <!-- <span style="display:inline-block; width:100px;"></span> -->
          <span class="mr-1">예정일</span>
          <input type="text" size="15" class="dateType text-center mr-1" name="" style="border-radius:.25rem;border:1px solid #ced4da;">
          <select class="mr-3">
            <option value="">계좌</option>
            <option value="">현금</option>
            <option value="">카드</option>
          </select>
          <!-- <span style="display:inline-block; width:100px;"></span> -->
          <button type="submit" id="button1" class="btn btn-outline-info btn-sm mr-1">청구설정</button>
          <button type="button" id="button2" class="btn btn-outline-info btn-sm mr-1">청구취소</button>
          <button type="button" id="button3" class="btn btn-outline-info btn-sm mr-1">일괄입금</button>
          <button type="button" id="button4" class="btn btn-outline-info btn-sm">일괄입금취소</button>
      </div>

      <table class="table table-striped table-bordered" style="width:100%" id="checkboxTestTbl">
        <thead>
          <tr class="table-info">
            <td scope="col" class="mobile"><input type="checkbox" id="checkAll"></td>
            <td scope="col">순번</td>
            <td scope="col">시작일</td>
            <td scope="col">종료일</td>
            <td scope="col">공급가액/세액</td>
            <!-- <td scope="col" class="mobile">세액</td> -->
            <td scope="col" class="mobile">합계</td>
            <td scope="col">입금예정일
              <!-- <input type="text" class="form-control form-control-sm text-center" name="" value="" placeholder="예정일변경"> 이거할려다가 안했다-->
            </td>
            <td scope="col" class="mobile">입금구분</td>
            <td scope="col" class="mobile">청구번호</td>
            <td scope="col">입금일</td>
            <td scope="col" class="mobile">입금액</td>
            <td scope="col" class="mobile">수납구분</td>
            <td scope="col" class="mobile">미납액</td>
            <td scope="col" class="mobile">연체일수</td>
            <td scope="col" class="mobile">연체이자</td>
            <!-- <td scope="col" class="mobile">세금계산서</td> -->
          </tr>
        </thead>
        <form class="" action="p_scheduleAdd.php" method="post">
          <input type="hidden" name="contractId" value="<?=$row[0]?>">
          <tbody id="schedule">

          </tbody>
        </form>

      </table>
    </div>
</section>


<hr>
<!-- 최하단 계약정보작성자보여주기세션 -->
<section>
    <small class="form-text text-muted text-center">계약번호[<?=$row[0]?>] 계약상태[<?=$row['status']?>] 등록자명[<?=$row['32']?>] 등록일시[<?=$row['createTime']?>] 수정자명[<?=$row['35']?>] 수정일시[<?=$row['updateTime']?>] </small>
</section>
<script>
    $(document).ready(function(){

      $('#checkboxTestTbl').DataTable({
        responsive: true
      });

      var period = '<?=$row['monthCount']?>';
      var startDate = '<?=$row['startDate']?>';
      var endDate = '<?=$row['endDate']?>';
      var payOrder = '<?=$row['payOrder']?>';

      var arr1 = startDate.split('-');
      var startDateInline = new Date(arr1[0], arr1[1]-1, arr1[2]);

      var checkbox = "<input type='checkbox' class='checkSelect' name='chk[]' value='<?=$row[0]?>'>";
      // var mAmount = "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='<?=$row['mAmount']?>'>";
      // var mvAmount ="<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mvAmount' value='<?=$row['mvAmount']?>'>";
      // var mtAmount = "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mtAmount' value='<?=$row['mtAmount']?>' disabled>";
      // var mtAmount = "<label><?=$row['mtAmount']?></label>";

      var scheduleTable;
      // console.log(payOrder);

      for (var i = 1; i <= Number(period); i++) {

        function dateFormat(date){
          var yyyy = date.getFullYear().toString();
          var mm = (date.getMonth()+1).toString();
          var dd = date.getDate().toString();

          return yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
        }

        var endDateInline = new Date(startDateInline.getFullYear(), startDateInline.getMonth()+1, startDateInline.getDate()-1);

        if(payOrder==='선불'){
          var expecteDay = "<input type='text' size='10' class='form-control form-control-sm text-center dateType' name='' value='"+dateFormat(startDateInline)+"'>";
        } else if (payOrder==='후불') {
          var expecteDay = "<input type='text' size='10' class='form-control form-control-sm text-center dateType' name='' value='"+dateFormat(endDateInline)+"'>";
        }

        scheduleTable += "<tr><td>"+checkbox+"</td><td>"+i+"</td><td>"+dateFormat(startDateInline)+"</td><td>"+dateFormat(endDateInline)+"</td>"+"<td>"+"<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount"+i+"' value='<?=$row['mAmount']?>' onclick='getMAmount();'>"+"<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mvAmount"+i+"' value='<?=$row['mvAmount']?>' onclick='getMtAmount();'>"+"</td>"+"<td>"+"<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mtAmount"+i+"' value='<?=$row['mtAmount']?>'>"+"</td>"+"<td>"+expecteDay+"</td>"+"<td></td>"+"<td></td>"+"<td></td>"+"<td></td>"+"<td></td>"+"<td></td>"+"<td></td>"+"<td></td>"+"</tr>";

        startDateInline = new Date(endDateInline.getFullYear(), endDateInline.getMonth(), endDateInline.getDate()+1);
      }

      $('#schedule').html(scheduleTable);
    })

    $('.table').on('click','.check', function(){
      var currow = $(this).closest('tr');
      var colId = currow.find('td:eq(0)').children('input').val();
      var colOrder = currow.find('td:eq(1)').text();
      var colStartdate = currow.find('td:eq(2)').text();
      var colEnddate = currow.find('td:eq(3)').text();
      var colmAmount = currow.find('td:eq(4)').children('input:eq(0)').val();
      var colmvAmount = currow.find('td:eq(4)').children('input:eq(1)').val();
      var colmtAmount = currow.find('td:eq(5)').children('input').val();
      var colexpectDate = currow.find('td:eq(6)').children('input').val();

      console.log(colId, colOrder, colStartdate, colEnddate, colmAmount, colmvAmount, colmtAmount, colexpectDate);
    })

    var table = $('#checkboxTestTbl');

    $(":checkbox:first", table).click(function(){
      var currow = $(this).closest('tr');
      var colId = currow.find('td:eq(0)').children('input').val();
      var colOrder = currow.find('td:eq(1)').text();
      var colStartdate = currow.find('td:eq(2)').text();
      var colEnddate = currow.find('td:eq(3)').text();
      var colmAmount = currow.find('td:eq(4)').children('input:eq(0)').val();
      var colmvAmount = currow.find('td:eq(4)').children('input:eq(1)').val();
      var colmtAmount = currow.find('td:eq(5)').children('input').val();
      var colexpectDate = currow.find('td:eq(6)').children('input').val();

      console.log(colId, colOrder, colStartdate, colEnddate, colmAmount, colmvAmount, colmtAmount, colexpectDate);
    })

    // $('#button1').on('click', function(){
    //   var a = 'scheduleAdd';
    //   var b = 'p_scheduleAdd.php';
    //   var c = 'id';
    //   var d = '<?=$row[0]?>';
    //
    //   var frm = formCreate(a, 'post', b,'');
    //   frm = formInput(frm, c, d);
    //   formSubmit(frm);
    // })

    // function getMAmount(){
    //   // var a = Number($(this).val());
    //   // console.log(a);
    //   // console.log($(this).val());
    //   var a = Number($(this).val());
    //   var c = a + b;
    //   console.log(a);
    //   console.log('hello');
    // }
    //
    // function getMtAmount(){
    //   // console.log($(this).val());
    //   console.log('hi');
    // }

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
