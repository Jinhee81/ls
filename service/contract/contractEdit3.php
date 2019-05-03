<!-- 계약수정화면 위가 최대한 짧은거가 나을것같아서 수정한것 -->
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
          building.id,
          building.bName,
          group_in_building.id,
          group_in_building.gName,
          r_g_in_building.id,
          r_g_in_building.rName,
          payOrder,
          monthCount,
          startDate,
          endDate,
          contractDate,
          mAmount,
          mvAmount,
          mtAmount,
          depositAmount,
          depositInDate,
          createTime,
          user.damdangga_name,
          updateTime,
          updatePerson
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
      left join user
          on realContract.createPerson = user.id
      where realContract.id = {$filtered_id}
";
// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

// print_r($row);

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
</style>

<section class="container">
  <div class="head pt-3 pb-3 pl-3 mb-5">
    <h1 class="display-4">임대계약 보기 화면입니다!</h1>
  </div>


  <!-- <div class="jumbotron">
    <h1 class="display-4">임대계약 보기 화면입니다!</h1> -->
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <!-- <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[고객정보]</b>에는 진행고객만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4">
  </div> -->
</section>
<section class="container">
  <form method="post" action="">
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[고객정보]</b></label>
      </div>
      <div class="form-group col-md-10">
        <label>
          <a href="/service/customer/m_c_edit.php?id=<?=$row[2]?>">
            <?php if($row['etc']) {
              echo $cName.', '.$cContact.', ('.$row['etc'].')';
            } else {
              echo $cName.', '.$cContact;
            }?>
            <!-- <?=$cName.', '.$cContact.', ('.$row['etc'].')'?> -->
          </a>
        </label>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[물건,기간정보]</b></label>
      </div>
      <div class="form-group col-md-10" id="mulgunInfo">
        <div class="form-row">
          <div class="form-group col-md-2">
            <label>물건명</label>
            <select id="select2" name="building_id" class="form-control"><!--물건목록-->
              <option value="<?=$row[11]?>"><?=$row[12]?></option>
            </select>
          </div>
          <div class="form-group col-md-2"><!--그룹목록-->
            <label>그룹명</label>
            <select id="select3" name="group_id" class="form-control">
              <option value="<?=$row[13]?>"><?=$row[14]?></option>
            </select>
          </div>
          <div class="form-group col-md-2"><!--관리번호목록-->
            <label>관리호수</label>
            <select id="select4" name="room_id" class="form-control">
              <option value="<?=$row[15]?>"><?=$row[16]?></option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label><span id='star' style='color:#F7BE81;'>* </span>기간(개월수)</label>
            <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="72" value="<?=$row['monthCount']?>">
          </div>
          <div class="form-group col-md-2">
            <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
            <input type="text" id="startDate" class="form-control dateType" name="startDate" value="<?=$row['startDate']?>" placeholder="" required>
          </div>
          <div class="form-group col-md-2">
            <label>종료일자</label>
            <input type="text" id="endDate" class="form-control" name="endDate" value="<?=$row['endDate']?>">
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label><b>[월이용료정보]</b></label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">

          <div class="form-group col-md-2"><!--선불,후불체크-->
            <label>수납정보</label>
            <select id="select5" name="payOrder" class="form-control">
              <!-- <option value="<?=$row['payOrder']?>"><?=$row['payOrder']?></option> -->
              <option value="선불"<?php if($row['payOrder']==='후불'){echo "selected";}?>>선불</option>
              <option value="후불"<?php if($row['payOrder']==='후불'){echo "selected";}?>>후불</option>
            </select>
          </div>

          <div class="form-group col-md-2">
            <label>계약일자</label>
            <input type="text" id="contractDate" class="form-control dateType" name="contractDate" value="<?=$row['contractDate']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
            <input type="text" class="form-control text-right amountNumber" name="mAmount" value="<?=$row['mAmount']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label>세액</label>
            <input type="text" class="form-control text-right amountNumber" name="mvAmount" value="<?=$row['mvAmount']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label>합계</label>
            <input type="text" class="form-control text-right amountNumber" name="mtAmount" value="<?=$row['mtAmount']?>">
          </div>
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label><b>[보증금]</b></label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-2 mb-0">
            <label>입금액</label>
            <input type="text" class="form-control text-right amountNumber" name="depositAmount" value="<?=$row['depositAmount']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label>입금일자</label>
            <input type="text" class="form-control dateType" name="depositInDate" id="depositInDate" value="<?=$row['depositInDate']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label>출금액</label>
            <input type="text" class="form-control text-right amountNumber" name="depositAmount" value="<?=$row['depositAmount']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label>출금일자</label>
            <input type="text" class="form-control dateType" name="depositInDate" id="depositInDate" value="<?=$row['depositInDate']?>">
          </div>
          <div class="form-group col-md-2 mb-0">
            <label>잔액</label>
            <input type="text" class="form-control text-right amountNumber" name="depositAmount" value="<?=$row['depositAmount']?>">
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">보증금 입금액과 출금액을 입력하세요. 잔액은 자동 계산됩니다.</small>
      </div>
    </div>
    <hr>
  </section>
<section class="container-fluid">
    <div class="p-3 mb-2 text-dark border border-info rounded">
      <div class="row justify-content-md-center">
          <div class="col col-sm-2">
            <button type="button" name="button" class="btn btn-outline-info btn-sm">추가</button>
            <button type="button" name="button" class="btn btn-outline-info btn-sm">삭제</button>
          </div>
          <div class="col col-sm-5">
            예정일묶음
            <input type="text" size="15" class="dateType" name="" style="border-radius:.25rem;border:1px solid #ced4da;">
            <!-- <p class="font-weight-lighter mb-0">입금구분</p> -->
            입금구분
            <select class="">
              <option value="">계좌</option>
              <option value="">현금</option>
              <option value="">카드</option>
            </select>
          </div>
          <div class="col col-sm-5">
            <button type="button" name="button" class="btn btn-outline-info btn-sm">청구설정</button>
            <button type="button" name="button" class="btn btn-outline-info btn-sm">청구취소</button>
            <button type="button" name="button" class="btn btn-outline-info btn-sm">일괄입금</button>
            <button type="button" name="button" class="btn btn-outline-info btn-sm">일괄입금취소</button>
          </div>
      </div>
    </div>

    <table class="table table-hover text-center" id="checkboxTestTbl">
      <thead>
        <tr class="table-info">
          <td scope="col" class="mobile"><input type="checkbox"></td>
          <td scope="col">순번</td>
          <td scope="col">시작일</td>
          <td scope="col">종료일</td>
          <td scope="col">공급가액</td>
          <td scope="col" class="mobile">세액</td>
          <td scope="col" class="mobile">합계</td>
          <td scope="col">예정일</td>
          <td scope="col" class="mobile">입금구분</td>
          <td scope="col" class="mobile">청구번호</td>
          <td scope="col">입금일</td>
          <td scope="col" class="mobile">입금액</td>
          <!-- <td scope="col" class="mobile">수납구분</td> -->
          <!-- <td scope="col" class="mobile">미납액</td> -->
          <!-- <td scope="col" class="mobile">연체일수</td> -->
          <!-- <td scope="col" class="mobile">연체이자</td> -->
          <!-- <td scope="col" class="mobile">세금계산서</td> -->
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="mobile"><input type="checkbox" name="chk[]" value=""></td>
          <td>1</td><!--순번-->
          <td><?=$row['startDate']?></td><!--시작일-->
          <td>2019-05-18</td><!--종료일-->
          <td><input type="text" size="10" class="form-control form-control-sm text-right amountNumber" name="depositAmount" value="<?=$row['mAmount']?>"></td><!--공급가액-->
          <td class="mobile"><input type="text" size="10" class="form-control form-control-sm text-right amountNumber" name="depositAmount" value="<?=$row['mvAmount']?>"></td><!--세액-->
          <td class="mobile"><input type="text" size="10" class="form-control form-control-sm text-right amountNumber" name="depositAmount" value="<?=$row['mtAmount']?>"></td><!--합계-->
          <td><input type="text" size="10" class="form-control form-control-sm text-center dateType" name="" value="2029-01-01"></td><!--예정일-->
          <td class="mobile">
            <select class="form-control form-control-sm selectCall">
              <option value="">계좌</option>
              <option value="">현금</option>
              <option value="">카드</option>
            </select>
          </td><!--입금구분-->
          <td class="mobile">1</td><!--청구번호-->
          <td class="mobile"><input type="text" size="10" class="form-control form-control-sm text-center dateType" name="depositAmount" value=""></td><!--입금일-->
          <td class="mobile"><input type="text" size="10" class="form-control form-control-sm text-right amountNumber" name="depositAmount" value=""></td><!--입금액-->
          <!-- <td class="mobile">입금대기</td>수납구분-->
          <!-- <td class="mobile">55,000</td>
          <td class="mobile">0</td>
          <td class="mobile"></td> -->
        </tr>
      </tbody>
    </table>

    <hr>
    <div>
      <small class="form-text text-muted text-center">계약번호[<?=$row[0]?>] 계약상태[<?=$row['status']?>] 등록자명[<?=$row['damdangga_name']?>] 등록일시[<?=$row['createTime']?>] 수정자명[<?=$row['updatePerson']?>] 수정일시[<?=$row['updateTime']?>] </small>
    </div>
  </form>
</section>
<script>

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
