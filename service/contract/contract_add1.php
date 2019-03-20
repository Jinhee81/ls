<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$sql = "select * from building where user_id = {$_SESSION['id']}";
// echo $sql;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
  $buildingArray[$row['id']] = $row['name'];
}

foreach ($buildingArray as $key => $value) { //key는 건물아이디, value는 건물이름
  $sql2 = "select * from group_in_building where building_id={$key}"; //건물아이디로 그룹조회
  // echo $sql2;
  $result2 = mysqli_query($conn, $sql2);
  $groupBuildingArray[$key] = array();
  while($row2 = mysqli_fetch_array($result2)){
    $groupBuildingArray[$key][$row2['id']]=$row2['gName'];//그룹아이디
  }
}

foreach ($groupBuildingArray as $key => $value) {
  $sql3 = "select id from group_in_building where building_id={$key}"; //건물아이디로 그룹조회 (건물아이디가 키값)
  // echo $sql3;
  $result3 = mysqli_query($conn, $sql3);
  while($row3 = mysqli_fetch_array($result3)){
    $sql4 = "select ordered, rName from r_g_in_building where group_in_building_id={$row3['id']}";
    // echo $sql4;다시 그룹아이디로 방번호조회
    $result4 = mysqli_query($conn, $sql4);
    while($row4 = mysqli_fetch_array($result4)){
      $roomArray[$row3['id']][$row4['ordered']]=$row4['rName'];
    }
  }
}
// echo "building Array : "; print_r($buildingArray);
// echo "group Array : "; print_r($groupBuildingArray);
// echo "room Array : "; print_r($roomArray);
?>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">임대계약 등록 화면입니다!</h1>
    <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
    <small>(1) * 표시는 필수입력값입니다. (2) 구분(대)의 값이 '고객'이어야 임대계약 등록이 가능합니다. (3) '고객'이란 단어는 세입자 또는 입주자를 의미합니다. (4)'일괄등록'은 데스크탑화면에서 가능합니다 (모바일화면 사용불가)</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="m_c_adds.php" role="button">일괄등록</a>
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action ="p_m_c_add.php">
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[고객정보]</b></label>
      </div>
      <div class="form-group col-md-5">
        <input type="text" class="form-control" name="" value="">
      </div>
      <div class="form-group col-md-5">
        <input type="text" class="form-control" name="" value="">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[물건정보]</b></label>
      </div>
      <div class="form-group col-md-10">
        <div class="form-row">
          <div class="form-group col-md-2">
            <select id="" name="" class="form-control" onchange="div2Get();">
              <option value="">전체</option>
              <option value="개인사업자" selected>공실</option>
              <option value="법인사업자">만실</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <select id="buildingValue" name="" class="form-control"><!--물건목록-->
<?php foreach ($buildingArray as $key => $value) {
  echo "<option value='$key'>$value</option>";
}?>
            </select>
          </div>
          <div class="form-group col-md-3"><!--그룹목록-->
            <select id="" name="" class="form-control" onchange="div2Get();">
<?php
foreach ($groupBuildingArray[25] as $key => $value) {
  echo "<option value='$key'>$value</option>";
}?>
            </select>
          </div>
          <div class="form-group col-md-3"><!--관리번호목록-->
            <select id="" name="" class="form-control" onchange="div2Get();">
<?php
foreach ($roomArray[219] as $key => $value) {
  echo "<option value='$key'>$value</option>";
}?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <select id="" name="" class="form-control" onchange="div2Get();">
              <option value="">선불</option>
              <option value="">후불</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label><b>[기간정보]</b></label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-3">
            <label>기간(개월수)</label>
            <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="60">
          </div>
          <div class="form-group col-md-3">
            <label>시작일자</label>
            <input type="text" id="startDate" class="form-control dateType" name="startDate" value="" placeholder="" onmouseout="getEndDate();">
          </div>
          <div class="form-group col-md-3">
            <label>종료일자</label>
            <input type="text" id="endDate" class="form-control" name="endDate" placeholder="" disabled>
          </div>
          <div class="form-group col-md-3">
            <label>계약일자</label>
            <input type="text" id="contractDate" class="form-control dateType" name="contractDate" placeholder="">
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <label><b>[금액정보]</b></label>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(1)월이용료</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>공급가액</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">매월 받아야하는 임대료(월세)를 입력합니다.</small>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(2)기타금액</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>공급가액</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">매월 받아야하는 관리비 등의 비용을 입력합니다.</small>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label>(3)보증금</label>
      </div>
      <div class="form-group col-md-10">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>금액</label>
            <input type="text" class="form-control" name="" value="" placeholder="">
          </div>
          <div class="form-group col-md-4">
            <label>입금일자</label>
            <input type="text" class="form-control dateType" name="depositDate" id="depositDate" value="" placeholder="">
          </div>
          <div class="form-group col-md-4">

          </div>
        </div>
      </div>
    </div>
    <div class="">
      <button type='submit' class='btn btn-primary'>저장</button>
      <a href='contract.php'><button type='button' class='btn btn-secondary'>계약리스트화면으로</button></a>
    </div>
  </form>
</section>

<script>
function getEndDate(){
  var a = Number($("input[name='monthCount']").val());
  var b = $("input[name='startDate']").val();
  var arr1 = b.split('-');
  var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
  // console.log(sDate);
  // var eDate = new Date(arr1[0], arr1[1]-1+a, arr1[2]-1);
  var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + a, sDate.getDate()-1);
  console.log(eDate);
  // console.log(a);
  function dateFormat(){
    var yyyy = eDate.getFullYear().toString();
    var mm = (eDate.getMonth()+1).toString();
    var dd = eDate.getDate().toString();

    return yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
  }
  dateFormat();
  $('#endDate').attr('value', dateFormat());
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
