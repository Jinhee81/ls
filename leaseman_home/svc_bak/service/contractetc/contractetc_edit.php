<!-- 계약리스트화면에서 등록버튼누르면 나오는 거 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contractetc/good.php";

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//기타계약번호
settype($filtered_id, 'integer');

$sql = "
    select
      etcContract.id,
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
      good_in_building_id,
      (select name from good_in_building where
      id=good_in_building_id),
      startTime,
      endTime,
      payKind,
      executiveDate,
      pAmount,
      pvAmount,
      ptAmount,
      etcContract.etc,
      etcContract.createTime,
      etcContract.createPerson,
      (select damdangga_name from user where id=etcContract.createPerson),
      etcContract.updateTime,
      etcContract.updatePerson,
      (select damdangga_name from user where id=etcContract.updatePerson),
      etcContract.user_id
    from etcContract
    left join customer
        on etcContract.customer_id = customer.id
    where
      etcContract.id = {$filtered_id} and
      etcContract.user_id = {$_SESSION['id']}
    ";

// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// print_r($row);

if ($result->num_rows === 0) {
  echo "<script>
          alert('세션에 포함된 계약이 아니어서 조회 불가합니다.');
          location.href = 'contractetc.php';
        </script>";
  error_log(mysqli_error($conn));
}

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
  .inputWithIcon input[type=search]{
    padding-left: 40px;
  }
  .inputWithIcon {
    position: relative;
  }
  .inputWithIcon i{
    position: absolute;
    left: 4px;
    top: 4px;
    padding: 9px 8px;
    color: #aaa;
    transition: .3s;
  }
  .inputWithIcon input[type=search]:focus+i{
    color: dodgerBlue;
  }
  #customerList ul {
    background-color: #eee;
    cursor: pointer;
  }
  #customerList li {
    padding: 12px;
  }
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">기타계약 수정 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <!-- <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[세입자정보]</b>에는 세입자만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) <b>[세입자정보]</b>의 제일우측 숫자는 고객번호로써 시스템데이터임을 참고하여주세요. (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small> -->
    <hr class="my-4">
    <!-- <a class="btn btn-primary btn-sm" href="/service/customer/m_c_add.php" role="button">성명등록</a>
    <a class="btn btn-primary btn-sm" href="/service/setting/building.php" role="button">상품추가</a> -->
  </div>
</section>
<section class="container">
  <form method="post" action="p_etcContract_edit.php">
    <div class="form-row">
        <div class="form-group col-md-2">
              <label><b>[성명]</b></label>
        </div>
        <div class="form-group col-md-10 inputWithIcon">
              <a href="/service/customer/m_c_edit.php?id=<?=$row[1]?>">
                <input type="text" class="form-control form-control-sm" name="" value="<?php if($row[9]) {
                  echo $cName.', '.$cContact.', ('.$row[9].')';
                } else {
                  echo $cName.', '.$cContact;
                }?>" disabled>
              </a>
              <input type="hidden" name="etcContract_id" value="<?=$filtered_id?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label><b>[물건,금액]</b></label>
        </div>
        <div class="form-group col-md-10" id="mulgunInfo">
              <div class="form-row">
                <div class="form-group col-md-2"><!--물건목록-->
                    <label>물건명</label>
                    <select id="select2" name="building_id" class="form-control">
                    <?php
                    $sql_building = "select id, bName from building where user_id={$_SESSION['id']}";
                    $result_building = mysqli_query($conn, $sql_building);
                    while($row_building = mysqli_fetch_array($result_building)){?>
                      <option value="<?=$row_building['id']?>"
                        <?php if ($row_building['id']===$row['building_id']) {
                          echo "selected";
                        }?>
                        ><?=$row_building['bName']?>
                      </option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2"><!--상품목록-->
                    <label>상품명</label>
                    <select id="select3" name="good_in_building_id" class="form-control">
                      <?php
                      $sql_group = "select id, name from good_in_building where building_id={$row['building_id']}";
                      $result_group = mysqli_query($conn, $sql_group);
                      while($row_group = mysqli_fetch_array($result_group)){?>
                        <option value="<?=$row_group['id']?>"
                          <?php if ($row_group['id']===$row['good_in_building_id']) {
                            echo "selected";
                          }?>
                          ><?=$row_group['name']?>
                        </option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2 mb-0">
                      <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
                      <input type="text" class="form-control text-right amountNumber" name="pAmount" value="<?=$row['pAmount']?>" numberOnly required>
                </div>
                <div class="form-group col-md-2 mb-0">
                      <label>세액</label>
                      <input type="text" class="form-control text-right amountNumber" name="pvAmount" value="<?=$row['pvAmount']?>" numberOnly required>
                </div>
                <div class="form-group col-md-2 mb-0">
                      <label>합계</label>
                      <input type="text" class="form-control text-right amountNumber" name="ptAmount" value="<?=$row['ptAmount']?>" numberOnly readonly>
                </div>
              </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
            <label><b>[날짜]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
          <div class="form-row">
              <div class="form-group col-md-2 mb-10">
                    <label><span id='star' style='color:#F7BE81;'>* </span>입금일자</label>
                    <input type="text" class="form-control dateType" name="executiveDate" value="<?=$row['executiveDate']?>" placeholder="" required>
              </div>
              <div class="form-group col-md-2 mb-10">
                    <label>입금구분</label>
                    <select class="form-control" name="payKind">
                      <option value="계좌">계좌</option>
                      <option value="현금">현금</option>
                      <option value="카드">카드</option>
                    </select>
              </div>
              <div class="form-group col-md-4 mb-0">
                    <label>시작일시</label>
                    <input type="text" class="form-control timeType" name="startTime" value="<?=$row['startTime']?>">
              </div>
              <div class="form-group col-md-4 mb-0">
                    <label>종료일시</label>
                    <input type="text" class="form-control timeType" name="endTime" value="<?=$row['endTime']?>">
              </div>
        </div>
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
            <label><b>[특이사항]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
          <input type="text" id="" class="form-control" name="etc" value="<?=$row[21]?>">
      </div>
    </div>

    <div class="form-row mt-3">
      <div class="form-group col-md-2">
        <label>등록자명</label>
        <input type="text" class="form-control form-control-sm" name="" value="<?=$row[24]?>" disabled>
      </div>
      <div class="form-group col-md-4">
        <label>등록일시</label>
        <input type="text" class="form-control form-control-sm" name="" value="<?=$row['createTime']?>" disabled>
      </div>
      <div class="form-group col-md-2">
        <label>수정자명</label>
        <input type="text" class="form-control form-control-sm" name="" value="<?=$row[27]?>" disabled>
      </div>
      <div class="form-group col-md-4">
        <label>수정일시</label>
        <input type="text" class="form-control form-control-sm" name="" value="<?=$row['updateTime']?>" disabled>
      </div>
    </div>


    <div class="mt-3">
      <button type='submit' class='btn btn-primary' id='saveBtn'>수정</button>
      <a href='contractetc.php'><button type='button' class='btn btn-secondary'>기타계약리스트화면으로</button></a>
    </div>
  </form>
</section>
<script>

var select2option, select3option, buildingIdx, goodIdx;

$('#select2').on('change', function(event){
  buildingIdx = $('#select2').val();
  $('#select3').empty();
  for(var key2 in goodBuildingArray[buildingIdx]){ //상품목록출력(빔,회의실)
    select3option = "<option value='"+key2+"'>"+goodBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select3').append(select3option);
  }
  goodIdx = $('#select3').val();
})
// console.log(buildingIdx, goodIdx);


$("input[name='pAmount']").on('keyup', function(){
  var amount1 = Number($(this).val());
  var amount2 = Number($("input[name='pvAmount']").val());
  var amount12 = amount1 + amount2;
  $("input[name='ptAmount']").val(amount12);
})

$("input[name='pvAmount']").on('keyup', function(){
  var amount1 = Number($("input[name='pAmount']").val());
  var amount2 = Number($(this).val());
  var amount12 = amount1 + amount2;
  $("input[name='ptAmount']").val(amount12);
})

$('#saveBtn').on('click', function(){
  var amount1 = Number($("input[name='pAmount']").val());
  if(amount1 === 0){
    alert('공급가액은 0보다 커야 저장됩니다.');
    return false;
  }
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
